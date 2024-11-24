<div class="section-post-intro pt-20">
	<div class="theme-container theme-grid">
			<div class="col-span-2 md:col-span-6 xl:col-span-12 pb-8">
				<?php do_action( 'breadcrumbs' ); ?>
			</div>
			<?php 
			// Get the gallery field from ACF
			$gallery = get_field('gallery');
			if ($gallery): 
			?>
				<!-- Slider Section -->
				<div class="col-span-2 md:col-span-6 xl:col-span-8">
					<div class="swiper highlights-slider">
						<div class="swiper-wrapper max-h-[566px]">
							<?php foreach ($gallery as $image_id): 
								// Get image URL and alt text
								$image_url = wp_get_attachment_image_src($image_id, 'highlights-slider')[0];
								$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
							?>
								<div class="swiper-slide">
									<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" class="w-full h-auto rounded-2xl">
								</div>
							<?php endforeach; ?>
						</div>
						<!-- Optional Navigation -->
						<div class="swiper-button-next"></div>
						<div class="swiper-button-prev"></div>
					</div>
				</div>

				<div class="col-span-2 md:col-span-6 xl:col-span-4 hidden xl:block">
					<div class="swiper thumbnail-slider">
						<div class="swiper-wrapper">
							<?php foreach ($gallery as $image_id): 
								// Get image URL and alt text
								$image_url = wp_get_attachment_image_src($image_id, 'highlights-slider-thumbs')[0];
								$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
							?>
								<div class="swiper-slide">
									<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" class="w-full h-auto rounded-lg">
								</div>
							<?php endforeach; ?>
						</div>
						<div class="swiper-pagination"></div>
					</div>
				</div>


			<?php endif; ?>
	</div>
</div>
