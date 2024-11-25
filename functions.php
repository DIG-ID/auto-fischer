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
 * Optimize and validate Contact Form 7 uploaded images before submitting.
 *
 * @param WPCF7_Validation $result
 * @param array $tag
 * @return WPCF7_Validation
 */
function fischer_theme_optimize_and_validate_uploaded_images($result, $tag) {
	$name = $tag['name']; // Field name

	// Allowed fields and total size limit (5MB per field)
	$allowed_fields = ['your-image-file', 'file-auto-innen', 'file-fahrzeugausweis'];
	$max_total_size = 5 * 1024 * 1024; // 5MB in bytes

	if (in_array($name, $allowed_fields)) {
			$uploaded_files = isset($_FILES[$name]) ? $_FILES[$name] : null;

			if ($uploaded_files && is_array($uploaded_files['name'])) {
					$valid_files = [];
					$total_size = 0;

					foreach ($uploaded_files['tmp_name'] as $index => $tmp_name) {
							$file_name = $uploaded_files['name'][$index];
							$file_type = $uploaded_files['type'][$index];
							$file_error = $uploaded_files['error'][$index];
							$file_tmp = $tmp_name;

							if ($file_error === UPLOAD_ERR_OK) {
									// Validate file type
									$allowed_types = ['image/jpeg', 'image/png'];
									if (!in_array($file_type, $allowed_types)) {
											$result->invalidate($tag, sprintf(__('The file "%s" is not a valid image type. Only JPEG and PNG are allowed.', 'auto-fischer'), $file_name));
											continue;
									}

									// Resize and optimize image
									$image = wp_get_image_editor($file_tmp);
									if (!is_wp_error($image)) {
											$image->resize(720, 480, true); // Resize to 720x480px
											$image->set_quality(85); // Set initial quality to 85%
											$image->save($file_tmp);

											// Further reduce quality if the file is too large (>1MB)
											if (filesize($file_tmp) > 1048576) {
													$image->set_quality(70);
													$image->save($file_tmp);
											}

											// Add optimized file size to total size
											$file_size = filesize($file_tmp);
											$total_size += $file_size;

											// Check total size limit for the field
											if ($total_size > $max_total_size) {
													$result->invalidate($tag, __('The total size of all uploaded files exceeds 5MB. Please reduce the size of your files.', 'auto-fischer'));
													break;
											}

											// Collect valid files
											$valid_files[] = [
													'tmp_name' => $file_tmp,
													'name' => $file_name,
													'type' => $file_type,
													'size' => $file_size,
											];
									} else {
											$result->invalidate($tag, sprintf(__('The file "%s" could not be processed. Please try again.', 'auto-fischer'), $file_name));
									}
							} else {
									// Handle upload errors
									$error_messages = [
											UPLOAD_ERR_INI_SIZE   => __('The uploaded file exceeds the server\'s upload size limit.', 'auto-fischer'),
											UPLOAD_ERR_FORM_SIZE  => __('The uploaded file exceeds the form\'s allowed size limit.', 'auto-fischer'),
											UPLOAD_ERR_PARTIAL    => __('The file was only partially uploaded. Please try again.', 'auto-fischer'),
											UPLOAD_ERR_NO_FILE    => __('No file was uploaded.', 'auto-fischer'),
											UPLOAD_ERR_NO_TMP_DIR => __('Missing a temporary folder on the server.', 'auto-fischer'),
											UPLOAD_ERR_CANT_WRITE => __('Failed to write file to disk.', 'auto-fischer'),
											UPLOAD_ERR_EXTENSION  => __('A PHP extension stopped the file upload.', 'auto-fischer'),
									];
									$error_message = $error_messages[$file_error] ?? __('An unknown error occurred during the file upload.', 'auto-fischer');
									$result->invalidate($tag, sprintf(__('Error with file "%s": %s', 'auto-fischer'), $file_name, $error_message));
							}
					}

					// If no valid files remain after processing, invalidate the field
					if (empty($valid_files)) {
							$result->invalidate($tag, __('No valid files were uploaded.', 'auto-fischer'));
					} else {
							// Rebuild the $_FILES array with valid files only
							$_FILES[$name]['tmp_name'] = array_column($valid_files, 'tmp_name');
							$_FILES[$name]['name'] = array_column($valid_files, 'name');
							$_FILES[$name]['type'] = array_column($valid_files, 'type');
							$_FILES[$name]['size'] = array_column($valid_files, 'size');

							// Clean up unused temporary files
							register_shutdown_function(function () use ($valid_files) {
									foreach ($valid_files as $file) {
											if (file_exists($file['tmp_name'])) {
													unlink($file['tmp_name']);
											}
									}
							});
					}
			}
	}

	return $result;
}
add_filter('wpcf7_validate_file', 'fischer_theme_optimize_and_validate_uploaded_images', 20, 2);
add_filter('wpcf7_validate_file*', 'fischer_theme_optimize_and_validate_uploaded_images', 20, 2);
