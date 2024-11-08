<section class="section-contact bg-white pt-28 relative overflow-hidden">
	<div class="xl:px-0 lg:px-0 mx-auto w-full lg:max-w-[1700px] theme-grid bg-dark-blue-shade rounded-2xl">
			<div class="col-span-2 md:col-span-6 xl:col-span-6">
				<?php
				$contactImg = get_field( 'contact_image' );
				if ( $contactImg ) :
					echo wp_get_attachment_image( $contactImg, 'full', false, array( 'class' => 'w-full object-cover rounded-2xl' ) );
				endif;
				?>
			</div>
			<div class="col-span-2 md:col-span-6 xl:col-span-4 col-start-1 md:col-start-1 xl:col-start-8 flex flex-col justify-center px-7 xl:px-0 pt-10 md:pt-14 xl:pt-0 pb-14 md:pb-20 xl:pb-0">
				<h2 class="title-secondary text-light-blue-shade"><?php the_field( 'contact_title' ); ?></h2>
				<p class="text-body text-light-blue-shade my-10"><?php the_field( 'contact_text' ); ?></p>
				<?php
				$contactf = get_field( 'contact_contact_form' );
				if ( $contactf ) :
					echo do_shortcode( $contactf );
				endif;
				?>
			</div>
	</div>
</section>
