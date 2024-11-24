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

				<!-- Thumbnails Section -->
				<div class="col-span-2 md:col-span-6 xl:col-span-4 hidden xl:grid grid-cols-2 gap-3 max-h-[566px] overflow-y-hidden">
					<?php 
					$total_slots = 6; // Total number of slots to display
					$gallery_count = count($gallery); // Number of images in the gallery

					// Initialize a counter for total displayed slots
					$slot_count = 0;

					// Display thumbnails for existing images
					foreach ($gallery as $index => $image_id):
						if ($slot_count >= $total_slots) break; // Stop loop after 6 slots
						$thumbnail_url = wp_get_attachment_image_src($image_id, 'highlights-slider-thumbs')[0];
						$thumbnail_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
						$slot_count++;
					?>
						<div class="swiper-slide-thumbnail relative w-full" style="padding-top: 75%;"> <!-- 4:3 aspect ratio -->
							<img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo esc_attr($thumbnail_alt); ?>" 
								class="absolute inset-0 w-full h-full object-cover cursor-pointer rounded-2xl"
								data-swiper-slide-index="<?php echo $index; ?>">
						</div>
					<?php endforeach; ?>

					<!-- Add placeholders for remaining slots -->
					<?php 
					while ($slot_count < $total_slots): 
						$slot_count++;
					?>
						<div class="swiper-slide-thumbnail relative w-full bg-gray-200 flex items-center justify-center rounded-2xl" style="padding-top: 75%;"> <!-- 4:3 aspect ratio -->
							<span class="absolute inset-0 flex items-center justify-center text-gray-500">No Image</span>
						</div>
					<?php endwhile; ?>
				</div>



			<?php endif; ?>
	</div>
</div>
