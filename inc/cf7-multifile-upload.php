<?php
add_action('wpcf7_init', function () {
	wpcf7_add_form_tag(
			'multifile',
			'handle_multifile_shortcode',
			['name-attr' => true]
	);
});

function handle_multifile_shortcode($tag) {
	$tag = new WPCF7_FormTag($tag);
	
	// Attributes
	$id = $tag->get_option('id', 'string', true) ?: 'multifile-' . uniqid();
	$total_limit = $tag->get_option('total-limit', 'string', true) ?: '10mb';
	$file_limit = $tag->get_option('file-limit', 'string', true) ?: '1mb';
	$max_files = $tag->get_option('max', 'int', true) ?: 10;
	$min_files = $tag->get_option('min', 'int', true) ?: 1;
	$filetypes = $tag->get_option('filetypes', 'string', true) ?: 'jpg|jpeg|png';
	$width = $tag->get_option('w', 'int', true) ?: null;
	$height = $tag->get_option('h', 'int', true) ?: null;
	$required = $tag->is_required() ? 'required' : '';

	// Field markup
	$html = sprintf(
			'<div class="cf7-multifile-wrapper" id="%s-wrapper" data-total-limit="%s" data-file-limit="%s" data-max="%d" data-min="%d" data-filetypes="%s" data-width="%d" data-height="%d">',
			esc_attr($id),
			esc_attr($total_limit),
			esc_attr($file_limit),
			esc_attr($max_files),
			esc_attr($min_files),
			esc_attr($filetypes),
			esc_attr($width),
			esc_attr($height)
	);

	$html .= '<div class="cf7-multifile-dropzone" data-id="' . esc_attr($id) . '">';
	$html .= '<p>Drag and drop files here or <button type="button" class="cf7-multifile-add-button">Add Files</button></p>';
	$html .= '</div>';
	$html .= '<div class="cf7-multifile-previews" id="' . esc_attr($id) . '-previews"></div>';
	$html .= '<input type="file" name="' . esc_attr($tag->name) . '[]" id="' . esc_attr($id) . '" ' . $required . ' multiple hidden>';
	$html .= '</div>';

	return $html;
}

add_filter('wpcf7_validate_multifile', 'validate_multifile_field', 10, 2);
function validate_multifile_field($result, $tag) {
	$tag = new WPCF7_FormTag($tag);
	$name = $tag->name;

	if (empty($_FILES[$name])) {
			if ($tag->is_required()) {
					$result->invalidate($tag, __('This field is required.', 'contact-form-7'));
			}
			return $result;
	}

	$uploaded_files = $_FILES[$name];
	$total_size = array_sum($uploaded_files['size']);
	$max_total_size = parse_file_size($tag->get_option('total-limit', 'string', true) ?: '10mb');
	$max_file_size = parse_file_size($tag->get_option('file-limit', 'string', true) ?: '1mb');
	$allowed_types = explode('|', $tag->get_option('filetypes', 'string', true) ?: 'jpg|jpeg|png');
	$min_files = $tag->get_option('min', 'int', true) ?: 1;

	// Validate file count
	if (count($uploaded_files['name']) < $min_files) {
			$result->invalidate($tag, sprintf(__('You must upload at least %d file(s).', 'contact-form-7'), $min_files));
	}

	// Validate file size
	foreach ($uploaded_files['size'] as $size) {
			if ($size > $max_file_size) {
					$result->invalidate($tag, sprintf(__('Each file must be smaller than %s.', 'contact-form-7'), format_file_size($max_file_size)));
			}
	}

	// Validate total size
	if ($total_size > $max_total_size) {
			$result->invalidate($tag, __('The total file size exceeds the allowed limit.', 'contact-form-7'));
	}

	// Validate file types
	foreach ($uploaded_files['type'] as $type) {
			$extension = pathinfo($uploaded_files['name'], PATHINFO_EXTENSION);
			if (!in_array(strtolower($extension), $allowed_types)) {
					$result->invalidate($tag, sprintf(__('Only the following file types are allowed: %s', 'contact-form-7'), implode(', ', $allowed_types)));
			}
	}

	return $result;
}

// Helper functions
function parse_file_size($size) {
	$units = ['b', 'kb', 'mb', 'gb', 'tb'];
	$unit = strtolower(preg_replace('/[^a-z]/i', '', $size));
	$value = (int) preg_replace('/[^0-9]/i', '', $size);
	$factor = array_search($unit, $units);

	return $factor !== false ? $value * pow(1024, $factor) : $value;
}

function format_file_size($size) {
	$units = ['B', 'KB', 'MB', 'GB', 'TB'];
	$factor = floor((strlen($size) - 1) / 3);
	return sprintf("%.2f", $size / pow(1024, $factor)) . ' ' . $units[$factor];
}


add_action(
	'admin_enqueue_scripts',
	function ( $hook ) {
		// Only load the script on the CF7 form edit screen.
		if ( 'toplevel_page_wpcf7' === $hook ) :
			wp_enqueue_script(
				'cf7-multifile-button',
				get_template_directory_uri() . '/assets/js/cf7/cf7-multifile-button.js', // Adjust the path as needed.
				array( 'jquery' ),
				'1.0',
				true
			);
			// Enqueue custom styles.
			wp_enqueue_style(
				'cf7-multifile-style',
				get_template_directory_uri() . '/assets/css/cf7-multifile-style.css', // Adjust the path if needed.
				array(),
				'1.0'
			);
		endif;
	}
);
