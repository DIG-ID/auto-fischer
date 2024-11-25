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


add_action('wp', function() {
if ( is_page_template( 'page-templates/page-ankauf.php' ) ) :
	echo '<h1>YES YES YES</h1>';
	/**
	 * Optimize and validate Contact Form 7 uploaded images.
	 *
	 * @param WPCF7_Validation $result
	 * @param array $tag
	 * @return WPCF7_Validation
	 */
	function fischer_theme_optimize_and_validate_uploaded_image( $result, $tag ) {
		$name = $tag['name']; // Field name

		// Target specific file upload fields
		$allowed_fields = ['your-image-file', 'file-auto-innen', 'file-fahrzeugausweis'];
		if ( in_array( $name, $allowed_fields ) ) {
			$uploaded_file = isset( $_FILES[$name] ) ? $_FILES[$name] : null;

			if ( $uploaded_file && $uploaded_file['error'] === UPLOAD_ERR_OK ) {
				$image_types = [ 'image/jpeg', 'image/png' ];

				// Check file type
				if ( in_array( $uploaded_file['type'], $image_types ) ) {
					$file_path = $uploaded_file['tmp_name'];
					$image     = wp_get_image_editor( $file_path );

					if ( ! is_wp_error( $image ) ) {
						// Resize image to 330x300
						$image->resize( 330, 300, true );

						// Compress image
						$image->set_quality( 85 );
						$image->save( $file_path );

						// Check if file size exceeds 1MB
						if ( filesize( $file_path ) > 1048576 ) {
							// Further reduce quality
							$image->set_quality( 70 );
							$image->save( $file_path );
						}
					} else {
						$result->invalidate( $tag, sprintf( 'The uploaded image for field "%s" could not be processed. Please try again with a different image.', $name ) );
					}
				} else {
					$result->invalidate( $tag, sprintf( 'The uploaded file for field "%s" must be a JPEG or PNG image.', $name ) );
				}
			} elseif ( $uploaded_file ) {
				// Handle upload errors
				$error_messages = [
					UPLOAD_ERR_INI_SIZE   => 'The uploaded file exceeds the server\'s upload size limit.',
					UPLOAD_ERR_FORM_SIZE  => 'The uploaded file exceeds the form\'s allowed size limit.',
					UPLOAD_ERR_PARTIAL    => 'The file was only partially uploaded. Please try again.',
					UPLOAD_ERR_NO_FILE    => 'No file was uploaded.',
					UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder on the server.',
					UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.',
					UPLOAD_ERR_EXTENSION  => 'A PHP extension stopped the file upload.',
				];

				$error_message = $error_messages[$uploaded_file['error']] ?? 'An unknown error occurred during the file upload.';
				$result->invalidate( $tag, sprintf( 'Error for field "%s": %s', $name, $error_message ) );
			}
		}

		return $result;
	}

	add_filter( 'wpcf7_validate_file', 'fischer_theme_optimize_and_validate_uploaded_image', 20, 2 );
	add_filter( 'wpcf7_validate_file*', 'fischer_theme_optimize_and_validate_uploaded_image', 20, 2 );
else :

	echo '<h1>NO NO NO!</h1>';
endif;
});