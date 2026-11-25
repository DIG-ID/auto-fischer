/**
 * Compiles the Contact Form 7 email templates from MJML to HTML.
 *
 *   src/<lang>/<form>/<email>.mjml  ->  html/<lang>/<form>/<email>.html
 *
 * Files in src/partials/ are only included by the templates
 * (<mj-include>), never compiled on their own.
 *
 * Usage:
 *   npm run mail          compile every template once
 *   npm run mail:watch    compile again whenever an .mjml file is saved
 */

import fs from 'node:fs';
import path from 'node:path';
import { fileURLToPath } from 'node:url';
import mjml2html from 'mjml';

const root = path.dirname(fileURLToPath(import.meta.url));
const srcDir = path.join(root, 'src');
const outDir = path.join(root, 'html');
const partialsDir = path.join(srcDir, 'partials');

/**
 * Lists the .mjml templates to compile (partials excluded).
 *
 * @returns {string[]} Absolute paths.
 */
function templates() {
  return fs
    .readdirSync(srcDir, { recursive: true })
    .filter((file) => file.endsWith('.mjml'))
    .map((file) => path.join(srcDir, file))
    .filter((file) => !file.startsWith(partialsDir + path.sep))
    .sort();
}

/**
 * Compiles one template. Returns false (and prints why) on any MJML error,
 * leaving the previous HTML untouched.
 *
 * @param {string} file Absolute path of the .mjml template.
 * @returns {boolean}
 */
function compile(file) {
  const relative = path.relative(srcDir, file);
  const target = path.join(outDir, relative.replace(/\.mjml$/, '.html'));

  let result;
  try {
    result = mjml2html(fs.readFileSync(file, 'utf8'), {
      filePath: file,
      validationLevel: 'strict',
    });
  } catch (error) {
    // Strict validation throws with the list of errors.
    const details = error.details?.map((e) => e.formattedMessage) ?? [error.message];
    console.error(`✗ ${relative}\n  ${details.join('\n  ')}`);
    return false;
  }

  fs.mkdirSync(path.dirname(target), { recursive: true });
  fs.writeFileSync(target, result.html);
  console.log(`✓ ${relative} -> ${path.relative(root, target)}`);
  return true;
}

/**
 * Compiles every template. Returns true when all of them compiled.
 *
 * @returns {boolean}
 */
function compileAll() {
  return templates().map(compile).every(Boolean);
}

const ok = compileAll();

if (process.argv.includes('--watch')) {
  console.log('\nWatching src/ for changes (Ctrl+C to stop)…');
  let timer;
  fs.watch(srcDir, { recursive: true }, (event, file) => {
    if (!file || !file.endsWith('.mjml')) {
      return;
    }
    // Editors fire several events per save; a partial change affects every
    // template, so simply rebuild everything once things settle.
    clearTimeout(timer);
    timer = setTimeout(() => {
      console.log(`\n${file} changed`);
      compileAll();
    }, 100);
  });
} else if (!ok) {
  process.exit(1);
}
