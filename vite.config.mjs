// vite.config.mjs

import fs from 'node:fs';
import net from 'node:net';
import os from 'node:os';
import path from 'node:path';
import { defineConfig, loadEnv } from 'vite';
import tailwindcss from 'tailwindcss';
import autoprefixer from 'autoprefixer';

// Entry points — each one is resolved by key in dist/.vite/manifest.json
// from inc/vite.php (e.g. fischer_vite_enqueue_style( 'x', 'assets/sass/main.sass' )).
const entries = [
  'assets/js/main.js',
  'assets/sass/main.sass',
  'assets/sass/admin-login.sass',
];

const outDir = 'dist';

// File the dev server writes on start (and removes on exit) so WordPress
// knows to load assets from it instead of the build. Never committed.
const hotFile = path.resolve(outDir, 'hot');

// Local by WPEngine certificates, reused so the dev server runs on HTTPS
// with the same trusted cert as the site (no mixed-content errors).
const certPath = path.join(
  os.homedir(),
  os.platform() === 'win32'
    ? 'AppData/Roaming/Local/run/router/nginx/certs'
    : 'Library/Application Support/Local/run/router/nginx/certs'
);

/**
 * Returns the HTTPS options for the dev server, or false when the Local
 * certificates for the host are not found (falls back to plain HTTP).
 *
 * @param {string} host Local dev hostname (e.g. project-name.digid).
 * @returns {{key: Buffer, cert: Buffer}|false}
 */
function localHttps(host) {
  const key = path.join(certPath, `${host}.key`);
  const cert = path.join(certPath, `${host}.crt`);

  if (!fs.existsSync(key) || !fs.existsSync(cert)) {
    console.warn(`\n[vite] Local certificates for "${host}" not found in ${certPath} — dev server falls back to HTTP.\n`);
    return false;
  }

  return { key: fs.readFileSync(key), cert: fs.readFileSync(cert) };
}

/**
 * WordPress integration: writes/removes the hot file and triggers a full
 * page reload whenever a PHP template changes (replaces BrowserSync).
 *
 * @returns {import('vite').Plugin}
 */
function wordpress() {
  return {
    name: 'fischer-wordpress',
    apply: 'serve',
    configureServer(server) {
      const { origin } = server.config.server;

      server.httpServer?.once('listening', () => {
        fs.mkdirSync(path.dirname(hotFile), { recursive: true });
        fs.writeFileSync(hotFile, origin);
      });

      const clean = () => {
        if (fs.existsSync(hotFile)) {
          fs.rmSync(hotFile);
        }
      };

      process.on('exit', clean);
      ['SIGINT', 'SIGTERM', 'SIGHUP'].forEach((signal) => {
        process.on(signal, () => {
          clean();
          process.exit();
        });
      });

      server.watcher.on('change', (file) => {
        if (file.endsWith('.php')) {
          server.ws.send({ type: 'full-reload', path: '*' });
        }
      });
    },
  };
}

/**
 * Keeps the dev server's hot file through a production build: the build
 * empties the output folder (emptyOutDir), hot file included, and with
 * `npm run dev` still running WordPress would silently switch to the build.
 * Reads the hot file before the build, and writes it back at the end if
 * the dev server still answers on its port.
 *
 * @returns {import('vite').Plugin}
 */
function keepHotFile() {
  let origin = '';

  return {
    name: 'keep-hot-file',
    apply: 'build',
    buildStart() {
      origin = fs.existsSync(hotFile) ? fs.readFileSync(hotFile, 'utf8').trim() : '';
    },
    async closeBundle() {
      if (!origin) {
        return;
      }
      const { port } = new URL(origin);
      // IPv4 on purpose: the dev server listens on 127.0.0.1 (see the PHP loader).
      const alive = await new Promise((resolve) => {
        const socket = net.connect({ host: '127.0.0.1', port: Number(port) || 443 });
        socket.setTimeout(500);
        socket.once('connect', () => { socket.destroy(); resolve(true); });
        socket.once('timeout', () => { socket.destroy(); resolve(false); });
        socket.once('error', () => resolve(false));
      });
      if (alive) {
        fs.mkdirSync(path.dirname(hotFile), { recursive: true });
        fs.writeFileSync(hotFile, origin);
      }
    },
  };
}

export default defineConfig(({ mode }) => {
  // Local dev hostname and port — override per machine in an untracked
  // .env.local (gitignored):  DEV_HOST=my-site.digid  DEV_PORT=5174
  // A different port per project lets two dev servers run at the same time.
  const env = loadEnv(mode, process.cwd(), '');
  const host = env.DEV_HOST || 'auto-fischer.digid';
  const port = Number(env.DEV_PORT) || 5173;

  const https = localHttps(host);
  const origin = `${https ? 'https' : 'http'}://${host}:${port}`;

  return {
    // Relative base so url() references inside the compiled CSS resolve
    // against the build folder wherever the theme lives.
    base: './',
    publicDir: false,

    plugins: [wordpress(), keepHotFile()],

    css: {
      devSourcemap: true,
      preprocessorOptions: {
        // Same options for .sass and .scss files.
        sass: {
          // @import is deprecated in Dart Sass but still used by most themes.
          silenceDeprecations: ['import'],
          // Hide deprecation warnings coming from node_modules (e.g. Bootstrap).
          quietDeps: true,
        },
        scss: {
          silenceDeprecations: ['import'],
          quietDeps: true,
        },
      },
      postcss: {
        plugins: [tailwindcss('./tailwind.config.js'), autoprefixer()],
      },
    },

    server: {
      host: '127.0.0.1',
      port,
      strictPort: true,
      https,
      origin,
      cors: { origin: [`https://${host}`, `http://${host}`] },
      allowedHosts: [host],
      hmr: { host },
      watch: {
        ignored: ['**/vendor/**', '**/php-stubs/**', `**/${outDir}/**`],
      },
    },

    build: {
      outDir,
      emptyOutDir: true,
      manifest: true,
      sourcemap: mode !== 'production',
      // Keep SVGs as separate (cached) files instead of data URIs: icons used
      // as CSS masks would otherwise be inlined into the render-blocking CSS.
      assetsInlineLimit: (file) => (file.endsWith('.svg') ? false : undefined),
      rolldownOptions: {
        input: entries,
        output: {
          entryFileNames: 'js/[name]-[hash].js',
          chunkFileNames: 'js/[name]-[hash].js',
          assetFileNames: ({ names }) =>
            names.some((name) => name.endsWith('.css'))
              ? 'css/[name]-[hash][extname]'
              : 'assets/[name]-[hash][extname]',
        },
      },
    },
  };
});
