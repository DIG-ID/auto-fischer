<section class="section-team">
	<div class="theme-container theme-grid">
		<div class="col-span-12">
			<div class="swiper gallerySwiper">

			
				<?php
				$images = get_field( 'gallery' );
				if ( $images ) :
					$i = 0;
					?>
					<ul class="swiper-wrapper">
						<?php foreach ( $images as $image_id ) : ?>
							<li class="swiper-slide">
								<?php echo $image_id; var_dump($i);?>
								<?php echo wp_get_attachment_image( $image_id, 'full' ); ?>
							</li>
						<?php $i++; endforeach; ?>
					</ul>
					<?php
				endif;
				?>
			</div>
		</div>
	</div>
</section>
