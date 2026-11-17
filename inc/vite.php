<?php
/**
 * Vite integration: resolves compiled assets from dist/.vite/manifest.json
 * in production and serves them from the Vite dev server (with HMR) locally.
 *
 * Entries are referenced by their source path, exactly as listed in
 * vite.config.mjs (e.g. 'assets/js/main.js', 'assets/sass/main.sass').
 *
 * @package Auto_Fischer
 * @subpackage Functionality
 * @since 1.3.0
 */

if ( ! function_exists( 'fischer_vite_dev_server' ) ) :
	/**
	 * Returns the Vite dev server origin when it is running, or an empty string.
	 *
	 * The dev server writes its origin to dist/hot on start and removes it on
	 * exit. The file is only honoured on local/development environments, so a
	 * stray hot file can never make a live site load assets from localhost,
	 * and only while the server actually answers — a hot file left behind by
	 * a killed process falls back to the dist/ build instead of breaking.
	 *
	 * @since 1.3.0
	 *
	 * @return string Dev server origin (e.g. 'https://project.digid:5173') or ''.
	 */
	function fischer_vite_dev_server() {
		static $origin = null;

		if ( null !== $origin ) {
			return $origin;
		}

		$origin   = '';
		$hot_file = get_theme_file_path( '/dist/hot' );

		if ( in_array( wp_get_environment_type(), array( 'local', 'development' ), true ) && file_exists( $hot_file ) ) {
			$contents = file_get_contents( $hot_file ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- Local theme file, not a remote request.
			$origin   = $contents ? untrailingslashit( trim( $contents ) ) : '';
		}

		if ( $origin ) {
			$host = wp_parse_url( $origin, PHP_URL_HOST );
			$port = wp_parse_url( $origin, PHP_URL_PORT );

			// Probe the IPv4 address: Local maps the host to ::1 first in the hosts
			// file, but the dev server only listens on 127.0.0.1.
			$ip = $host ? gethostbyname( $host ) : '';

			// Silenced: "connection refused" is the expected not-running case.
			$socket = ( $ip && $port ) ? @fsockopen( $ip, $port, $errno, $errstr, 0.1 ) : false; // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_fsockopen, WordPress.PHP.NoSilencedErrors.Discouraged -- Local TCP probe to the dev server.

			if ( $socket ) {
				fclose( $socket ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_fclose -- Closes the probe socket.
			} else {
				$origin = '';
			}
		}

		return $origin;
	}
endif;

if ( ! function_exists( 'fischer_vite_manifest' ) ) :
	/**
	 * Returns the decoded Vite build manifest (empty array if missing).
	 *
	 * @since 1.3.0
	 *
	 * @return array Manifest keyed by entry source path.
	 */
	function fischer_vite_manifest() {
		static $manifest = null;

		if ( null !== $manifest ) {
			return $manifest;
		}

		$manifest      = array();
		$manifest_path = get_theme_file_path( '/dist/.vite/manifest.json' );

		if ( file_exists( $manifest_path ) ) {
			$contents = file_get_contents( $manifest_path ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- Local theme file, not a remote request.
			$decoded  = $contents ? json_decode( $contents, true ) : null;

			if ( is_array( $decoded ) ) {
				$manifest = $decoded;
			}
		}

		return $manifest;
	}
endif;

if ( ! function_exists( 'fischer_vite_module_handle' ) ) :
	/**
	 * Registers a script handle to be printed as an ES module, or returns
	 * the list of registered module handles when called without arguments.
	 *
	 * @since 1.3.0
	 *
	 * @param string $handle Optional. Script handle to flag as module.
	 * @return array List of module handles.
	 */
	function fischer_vite_module_handle( $handle = '' ) {
		static $handles = array();

		if ( $handle ) {
			$handles[ $handle ] = true;
		}

		return array_keys( $handles );
	}
endif;

if ( ! function_exists( 'fischer_vite_enqueue_client' ) ) :
	/**
	 * Enqueues the Vite HMR client (dev server only).
	 *
	 * @since 1.3.0
	 *
	 * @return string Client script handle.
	 */
	function fischer_vite_enqueue_client() {
		$handle = 'fischer-vite-client';

		if ( ! wp_script_is( $handle, 'enqueued' ) ) {
			wp_enqueue_script( $handle, fischer_vite_dev_server() . '/@vite/client', array(), null, false ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion -- Served by the dev server, never cached.
			fischer_vite_module_handle( $handle );
		}

		return $handle;
	}
endif;

if ( ! function_exists( 'fischer_vite_modulepreload' ) ) :
	/**
	 * Registers a module URL to preload, or returns the registered URLs when
	 * called without arguments.
	 *
	 * @since 1.3.0
	 *
	 * @param string $url Optional. Module URL to preload.
	 * @return array List of URLs to preload.
	 */
	function fischer_vite_modulepreload( $url = '' ) {
		static $urls = array();

		if ( $url ) {
			$urls[ $url ] = true;
		}

		return array_keys( $urls );
	}
endif;

if ( ! function_exists( 'fischer_vite_print_modulepreload' ) ) :
	/**
	 * Prints <link rel="modulepreload"> tags for the registered shared chunks.
	 *
	 * @since 1.3.0
	 *
	 * @return void
	 */
	function fischer_vite_print_modulepreload() {
		foreach ( fischer_vite_modulepreload() as $url ) {
			printf( '<link rel="modulepreload" href="%s" />' . PHP_EOL, esc_url( $url ) );
		}
	}
endif;

add_action( 'wp_head', 'fischer_vite_print_modulepreload', 5 );

if ( ! function_exists( 'fischer_vite_enqueue_script' ) ) :
	/**
	 * Enqueues a Vite JS entry (plus any CSS it imports) as an ES module.
	 *
	 * @since 1.3.0
	 *
	 * @param string $handle Script handle.
	 * @param string $entry  Entry source path, as in vite.config.mjs.
	 * @param array  $deps   Optional. Script dependencies (e.g. 'jquery').
	 * @return bool True if the entry was enqueued.
	 */
	function fischer_vite_enqueue_script( $handle, $entry, $deps = array() ) {
		$dev_server = fischer_vite_dev_server();

		if ( $dev_server ) {
			$deps[] = fischer_vite_enqueue_client();
			wp_enqueue_script( $handle, $dev_server . '/' . $entry, $deps, null, true ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion -- Served by the dev server, never cached.
			fischer_vite_module_handle( $handle );

			return true;
		}

		$manifest = fischer_vite_manifest();

		if ( empty( $manifest[ $entry ]['file'] ) ) {
			return false;
		}

		// File names carry a content hash, so no ?ver= query is needed.
		wp_enqueue_script( $handle, get_theme_file_uri( '/dist/' . $manifest[ $entry ]['file'] ), $deps, null, true ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion -- Cache-busting via hashed file name.
		fischer_vite_module_handle( $handle );

		// Shared chunks imported statically by this entry (e.g. helpers used by
		// both main.js and animations.js) are preloaded to avoid a request waterfall.
		if ( ! empty( $manifest[ $entry ]['imports'] ) ) {
			foreach ( $manifest[ $entry ]['imports'] as $import ) {
				if ( ! empty( $manifest[ $import ]['file'] ) ) {
					fischer_vite_modulepreload( get_theme_file_uri( '/dist/' . $manifest[ $import ]['file'] ) );
				}
			}
		}

		if ( ! empty( $manifest[ $entry ]['css'] ) ) {
			foreach ( $manifest[ $entry ]['css'] as $index => $css_file ) {
				wp_enqueue_style( $handle . '-' . $index, get_theme_file_uri( '/dist/' . $css_file ), array(), null ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion -- Cache-busting via hashed file name.
			}
		}

		return true;
	}
endif;

if ( ! function_exists( 'fischer_vite_style_url' ) ) :
	/**
	 * Returns the URL of a Vite stylesheet entry (Sass/CSS): the entry on the
	 * dev server (Vite answers a stylesheet request with the compiled CSS),
	 * or the hashed file in production. For pages WordPress doesn't enqueue
	 * on (wp_die()) and for fischer_vite_enqueue_style().
	 *
	 * @since 1.3.1
	 *
	 * @param string $entry Entry source path, as in vite.config.mjs.
	 * @return string The URL, or '' when the entry isn't built.
	 */
	function fischer_vite_style_url( $entry ) {
		$dev_server = fischer_vite_dev_server();

		if ( $dev_server ) {
			return $dev_server . '/' . $entry;
		}

		$manifest = fischer_vite_manifest();

		return empty( $manifest[ $entry ]['file'] ) ? '' : get_theme_file_uri( '/dist/' . $manifest[ $entry ]['file'] );
	}
endif;

if ( ! function_exists( 'fischer_vite_enqueue_style' ) ) :
	/**
	 * Enqueues a Vite stylesheet entry (Sass/CSS) as a regular <link>.
	 *
	 * On the dev server the <link> points to the entry (Vite answers with the
	 * compiled CSS) and the Vite client swaps it on every change, without a
	 * reload; in production it points to the hashed file. Either way it keeps
	 * WordPress' stylesheet order, so dependencies apply in both modes.
	 *
	 * @since 1.3.0
	 *
	 * @param string $handle Style handle.
	 * @param string $entry  Entry source path, as in vite.config.mjs.
	 * @param array  $deps   Optional. Style dependencies (e.g. 'login').
	 * @return bool True if the entry was enqueued.
	 */
	function fischer_vite_enqueue_style( $handle, $entry, $deps = array() ) {
		$url = fischer_vite_style_url( $entry );

		if ( ! $url ) {
			return false;
		}

		if ( fischer_vite_dev_server() ) {
			fischer_vite_enqueue_client(); // Hot updates for the <link>.
		}

		wp_enqueue_style( $handle, $url, $deps, null ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion -- Dev server (never cached) or hashed file name (cache-busting).

		return true;
	}
endif;

if ( ! function_exists( 'fischer_vite_module_tag' ) ) :
	/**
	 * Prints Vite scripts as ES modules (type="module").
	 *
	 * @since 1.3.0
	 *
	 * @param string $tag    The <script> tag.
	 * @param string $handle Script handle.
	 * @return string
	 */
	function fischer_vite_module_tag( $tag, $handle ) {
		if ( ! in_array( $handle, fischer_vite_module_handle(), true ) ) {
			return $tag;
		}

		// Only the external tag becomes a module — inline before/after scripts
		// (e.g. wp_localize_script data) stay classic. `src` may be the first
		// attribute (as current WordPress prints it) or come after others;
		// it must be its own attribute, not the end of `data-src`.
		return preg_replace_callback(
			'/<script\s(?:[^>]*\s)?src=[^>]*>/',
			function ( $matches ) {
				$script = preg_replace( '/\stype=([\'"])[^\'"]*\1/', '', $matches[0] );

				return str_replace( '<script ', '<script type="module" ', $script );
			},
			$tag
		);
	}
endif;

add_filter( 'script_loader_tag', 'fischer_vite_module_tag', 10, 2 );
