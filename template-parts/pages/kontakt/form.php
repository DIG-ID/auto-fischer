<section class="section-form bg-transparent pb-16 xl:pb-12">
	<div class="theme-container theme-grid">
		<div class="col-span-2 md:col-span-6 xl:col-span-12">
			<h2 class="title-secondary !font-normal mb-7"><?php the_field( 'intro_subtitle' ); ?></h2>
			<p class="text-body mb-7 xl:mb-12"><?php the_field( 'intro_description' ); ?></p>
			<div class="contact-form-wrapper gap-x-7 mb-20 md:md-0">
				<?php
				$form = get_field( 'contact_form' );
				if ( $form ) :
					echo do_shortcode( $form );
				endif;
				?>
			</div>
		</div>
	</div>
</section>
