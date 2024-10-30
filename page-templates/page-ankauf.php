<?php
/**
 * Template Name: Ankauf Template
 */

get_header();
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		do_action( 'before_main_content' );
			get_template_part( 'template-parts/pages/ankauf/intro' );
			get_template_part( 'template-parts/pages/ankauf/form' );
		do_action( 'after_main_content' );
	endwhile;
endif;
get_footer();
