<?php
/**
 * Template Name: Uber Uns Template
 */

get_header();
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		do_action( 'before_main_content' );
			get_template_part( 'template-parts/pages/uber-uns/intro' );
			get_template_part( 'template-parts/pages/uber-uns/photos' );
			get_template_part( 'template-parts/components/boxes-why-us' );
			get_template_part( 'template-parts/pages/uber-uns/contact' );
			get_template_part( 'template-parts/pages/uber-uns/gallery' );
			get_template_part( 'template-parts/components/reviews' );
		do_action( 'after_main_content' );
	endwhile;
endif;
get_footer();
