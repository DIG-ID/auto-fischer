<?php
/**
 * Template Name: Fahrzeuge Template
 */

get_header();
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		do_action( 'before_main_content' );
			get_template_part( 'template-parts/pages/fahrzeuge/intro' );
			get_template_part( 'template-parts/pages/fahrzeuge/iframe' );
			get_template_part( 'template-parts/pages/fahrzeuge/why-choose' );
			get_template_part( 'template-parts/pages/fahrzeuge/info' );
		do_action( 'after_main_content' );
	endwhile;
endif;
get_footer();
