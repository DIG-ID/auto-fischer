<section class="section-gallery py-56 hidden invisible xl:block xl:visible">
	<div class="theme-container">
		<div class="swiper gallerySwiper">
			<?php
			$images = get_field( 'gallery' );
			if ( $images ) :
				?>
				<ul class="swiper-wrapper">
					<?php foreach ( $images as $image_id ) : ?>
						<li class="swiper-slide">
							<?php echo wp_get_attachment_image( $image_id, 'full', false, array( 'class' => 'max-w-full w-full object-cover' ) ); ?>
						</li>
					<?php endforeach; ?>
				</ul>
				<?php
			endif;
			?>
		</div>
	</div>
</section>
