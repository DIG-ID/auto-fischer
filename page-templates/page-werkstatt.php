<?php
/**
 * Template Name: Werkstatt Template
 */

get_header();
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		do_action( 'before_main_content' );
			get_template_part( 'template-parts/pages/werkstatt/hero' );
			get_template_part( 'template-parts/pages/werkstatt/intro' );
			get_template_part( 'template-parts/pages/werkstatt/services' );
			get_template_part( 'template-parts/pages/werkstatt/why-us' );
			get_template_part( 'template-parts/pages/werkstatt/form' );
			get_template_part( 'template-parts/pages/werkstatt/pre-footer' );
		do_action( 'after_main_content' );
	endwhile;
endif;
get_footer();