<?php
/**
 * Template Name: Home Template
 */

get_header();
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		do_action( 'before_main_content' );
			get_template_part( 'template-parts/pages/home/hero' );
			get_template_part( 'template-parts/pages/home/intro' );
			get_template_part( 'template-parts/pages/home/why-choose' );
			get_template_part( 'template-parts/pages/home/buy_sell' );
			get_template_part( 'template-parts/pages/home/gut-zu-wissen' );
			get_template_part( 'template-parts/pages/home/contact' );
			get_template_part( 'template-parts/pages/home/highlight' );
			get_template_part( 'template-parts/pages/home/team' );
			get_template_part( 'template-parts/components/reviews' );
		do_action( 'after_main_content' );
	endwhile;
endif;
get_footer();
