<?php
/**
 * Template Name: Gut zu Wissen Template
 */

get_header();
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		do_action( 'before_main_content' );
			get_template_part( 'template-parts/pages/gut-zu-wissen/intro' );
			get_template_part( 'template-parts/pages/gut-zu-wissen/good_to_know' );
			get_template_part( 'template-parts/pages/gut-zu-wissen/faq' );
		do_action( 'after_main_content' );
	endwhile;
endif;
get_footer();
