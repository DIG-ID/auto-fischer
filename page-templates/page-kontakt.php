<?php
/**
 * Template Name: Kontakt Template
 */

get_header();
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		do_action( 'before_main_content' );
			get_template_part( 'template-parts/pages/kontakt/intro' );
			get_template_part( 'template-parts/pages/kontakt/form' );
			get_template_part( 'template-parts/pages/kontakt/map' );
		do_action( 'after_main_content' );
	endwhile;
endif;
get_footer();
