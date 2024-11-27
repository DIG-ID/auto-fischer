<?php
/**
 * Setup theme
 */
function fischer_theme_setup() {

	register_nav_menus(
		array(
			'main-menu'      => __( 'Main Menu', 'auto-fischer' ),
			'footer-menu-left' => __( 'Footer Menu Left', 'auto-fischer' ),
			'footer-menu-right' => __( 'Footer Menu Right', 'auto-fischer' ),
			'copyright-menu' => __( 'Copyright Menu', 'auto-fischer' ),
		)
	);

	add_theme_support( 'menus' );

	add_theme_support( 'custom-logo' );

	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );

	add_image_size( 'zimmer-image', 1400, 770, array( 'center', 'center' ) );

	add_image_size( 'long-term-image', 975, 650, array( 'center', 'center' ) );

	add_image_size( 'highlights-slider', 950, 566, array( 'center', 'center' ) );

	add_image_size( 'highlights-slider-thumbs', 245, 186, array( 'center', 'center' ) );

}

add_action( 'after_setup_theme', 'fischer_theme_setup' );

/**
 * Register our sidebars and widgetized areas.
 */
function fischer_theme_footer_widgets_init() {

	register_sidebar(
		array(
			'name'          => 'Footer',
			'id'            => 'footer',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		),
	);

	register_sidebar(
		array(
			'name'          => 'Header Language Switcher',
			'id'            => 'header_ls',
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

}

add_action( 'widgets_init', 'fischer_theme_footer_widgets_init' );

function add_adobe_fonts() {
    wp_enqueue_style( 'adobe-fonts', 'https://use.typekit.net/cfj8kzo.css' );
}
add_action( 'wp_enqueue_scripts', 'add_adobe_fonts' );


/**
 * Enqueue styles and scripts
 */
function fischer_theme_enqueue_styles() {

	//Get the theme data
	$the_theme     = wp_get_theme();
	$theme_version = $the_theme->get( 'Version' );

	// Register Theme main style.
	wp_register_style( 'theme-styles', get_template_directory_uri() . '/dist/css/main.css', array(), $theme_version );
	// Enqueue theme stylesheet.
	wp_enqueue_style( 'theme-styles' );
	//https://use.typekit.net/evg0ous.css first loaded fonts library backup
	//wp_enqueue_style( 'theme-fonts', 'https://use.typekit.net/buy6qwo.css', array(), $theme_version );

	wp_enqueue_script( 'jquery', false, array(), $theme_version, true );
	wp_enqueue_script( 'theme-scripts', get_stylesheet_directory_uri() . '/dist/js/main.js', array( 'jquery' ), $theme_version, true );
	if ( is_page_template( 'page-templates/page-kontakt.php' ) || is_admin() ) :
		wp_enqueue_script( 'google-map-settings', get_stylesheet_directory_uri() . '/assets/js/google-maps.js', array( 'jquery' ), $theme_version, true );
		wp_enqueue_script( 'google-map-api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCB2RShyxiN7xPsQy1QI_SbqXXjW5p08S0&callback=initMap', array(), $theme_version, true );
	endif;
	if ( is_page_template( 'page-templates/page-ankauf.php' ) ) { // Adjust condition to your specific template
		wp_enqueue_script( 'file-upload-optimization', get_template_directory_uri() . '/assets/js/file-upload-optimization.js', array(), null, true );
}
}

add_action( 'wp_enqueue_scripts', 'fischer_theme_enqueue_styles' );

//Google Map Init
function fischer_theme_google_map_init() {
	if ( is_admin() ) :
		acf_update_setting( 'google_api_key', 'AIzaSyCB2RShyxiN7xPsQy1QI_SbqXXjW5p08S0' );
	endif;
}

add_action( 'acf/init', 'fischer_theme_google_map_init' );

/**
 * Remove <p> Tag From Contact Form 7.
 */
add_filter( 'wpcf7_autop_or_not', '__return_false' );



/**
 * Lowers the metabox priority to 'core' for Yoast SEO's metabox.
 *
 * @param string $priority The current priority.
 *
 * @return string $priority The potentially altered priority.
 */
function fischer_theme_lower_yoast_metabox_priority( $priority ) {
	return 'core';
}

add_filter( 'wpseo_metabox_prio', 'fischer_theme_lower_yoast_metabox_priority' );


// Theme custom template tags.
require get_template_directory() . '/inc/theme-template-tags.php';

// The theme admin settings.
require get_template_directory() . '/inc/theme-admin-settings.php';

// The theme custom menu walker settings.
require get_template_directory() . '/inc/theme-custom-menu-walker.php';

function my_console_log(...$data) {
	$json = json_encode($data);
	add_action('shutdown', function() use ($json) {
		 echo "<script>console.log({$json})</script>";
	});
} 



/**
 * Validate Contact Form 7 uploaded images before submitting.
 *
 * @param WPCF7_Validation $result
 * @param array $tag
 * @return WPCF7_Validation
 */
function fischer_theme_optimize_and_validate_uploaded_images( $result, $tag ) {
	$name = $tag['name']; // Field name

	// Allowed file upload fields
	$allowed_fields = ['your-image-file', 'file-auto-innen', 'file-fahrzeugausweis'];
	if ( in_array( $name, $allowed_fields ) ) {
			if ( isset( $_FILES[$name] ) && is_array( $_FILES[$name]['name'] ) ) {
					$uploaded_files = $_FILES[$name]; // All files in this field
					$uploaded_paths = [];
					$max_total_size = 10 * 1024 * 1024; // 10MB total size for all files in this field
					$total_size = 0;
					$min_images = 2; // Minimum images required
					$max_images = 10; // Maximum images allowed
					$valid_image_count = 0;

					foreach ( $uploaded_files['name'] as $index => $filename ) {
							if ( $uploaded_files['error'][$index] === UPLOAD_ERR_OK ) {
									$file_type = $uploaded_files['type'][$index];
									$file_tmp = $uploaded_files['tmp_name'][$index];
									$file_size = $uploaded_files['size'][$index];
									$total_size += $file_size;

									// Check if total size exceeds the limit
									if ( $total_size > $max_total_size ) {
											$result->invalidate( $tag, 'Die Gesamtgröße der hochgeladenen Dateien überschreitet das Limit von 10 MB.' );
											return $result;
									}

									// Validate file type
									if ( ! in_array( $file_type, ['image/jpeg', 'image/png'] ) ) {
											$result->invalidate( $tag, 'Nur JPEG- und PNG-Bildformate sind erlaubt.' );
											return $result;
									}

									// Resize and optimize image
									$image = wp_get_image_editor( $file_tmp );
									if ( ! is_wp_error( $image ) ) {
											$image->resize( 720, 480, true );
											$image->set_quality( 85 );
											$image->save( $file_tmp );

											// Further reduce quality if file size exceeds 1MB
											if ( filesize( $file_tmp ) > 1048576 ) {
													$image->set_quality( 70 );
													$image->save( $file_tmp );
											}

											$uploaded_paths[] = $file_tmp; // Store the optimized file path
											$valid_image_count++; // Increment the valid image count
									} else {
											$result->invalidate( $tag, 'Ein Bild konnte nicht verarbeitet werden. Bitte versuchen Sie es erneut.' );
											return $result;
									}
							} else {
									// Handle file upload errors
									$error_messages = [
											UPLOAD_ERR_INI_SIZE   => 'Die hochgeladene Datei überschreitet das Server-Upload-Limit.',
											UPLOAD_ERR_FORM_SIZE  => 'Die hochgeladene Datei überschreitet das zulässige Formulargröße-Limit.',
											UPLOAD_ERR_PARTIAL    => 'Die Datei wurde nur teilweise hochgeladen. Bitte versuchen Sie es erneut.',
											UPLOAD_ERR_NO_FILE    => 'Es wurde keine Datei hochgeladen.',
											UPLOAD_ERR_NO_TMP_DIR => 'Es fehlt ein temporärer Ordner auf dem Server.',
											UPLOAD_ERR_CANT_WRITE => 'Fehler beim Schreiben der Datei auf die Festplatte.',
											UPLOAD_ERR_EXTENSION  => 'Eine PHP-Erweiterung hat den Datei-Upload gestoppt.',
									];
									$result->invalidate( $tag, $error_messages[$uploaded_files['error'][$index]] ?? 'Ein unbekannter Fehler ist aufgetreten.' );
									return $result;
							}
					}

					// Check if the number of images is within the allowed range
					if ( $valid_image_count < $min_images ) {
							$result->invalidate( $tag, 'Sie müssen mindestens 2 Bilder hochladen.' );
							return $result;
					} elseif ( $valid_image_count > $max_images ) {
							$result->invalidate( $tag, 'Sie können maximal 10 Bilder hochladen.' );
							return $result;
					}

					// Attach all processed files to the email
					foreach ( $uploaded_paths as $path ) {
							wpcf7_add_file( $tag->name, $path );
					}

					// Clean up temporary files after sending email
					register_shutdown_function( function () use ( $uploaded_paths ) {
							foreach ( $uploaded_paths as $path ) {
									if ( file_exists( $path ) ) {
											unlink( $path ); // Delete temporary files
									}
							}
					});
			}
	}

	return $result;
}
add_filter( 'wpcf7_validate_file', 'fischer_theme_optimize_and_validate_uploaded_images', 20, 2 );
add_filter( 'wpcf7_validate_file*', 'fischer_theme_optimize_and_validate_uploaded_images', 20, 2 );
