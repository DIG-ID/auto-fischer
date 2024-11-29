<div class="section-post-intro pt-20">
	<div class="theme-container grid grid-cols-2 md:grid-cols-6 xl:grid-cols-12 gap-x-[10px]">
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
				<div class="col-span-2 md:col-span-6 xl:col-span-4 hidden xl:block max-h-[556px] overflow-hidden">
					<div class="thumbnails-container grid grid-cols-2 gap-x-[10px] max-h-[556px] overflow-y-auto scrollbar-hidden">
						<?php 
						$min_slots = 6; // Set the minimum number of thumbnails to display
						$gallery_count = count($gallery); // Number of images in the gallery

						// Initialize a counter for total displayed slots
						$slot_count = 0;

						// Display thumbnails for existing images
						foreach ($gallery as $index => $image_id):
							$thumbnail_url = wp_get_attachment_image_src($image_id, 'highlights-slider-thumbs')[0];
							$thumbnail_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
							$slot_count++;
						?>
							<div class="swiper-slide-thumbnail relative w-full" style="padding-top: 75%;"> <!-- 4:3 aspect ratio -->
								<img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo esc_attr($thumbnail_alt); ?>" 
									class="absolute inset-0 w-full object-cover cursor-pointer rounded-2xl"
									data-swiper-slide-index="<?php echo $index; ?>">
							</div>
						<?php endforeach; ?>

						<!-- Add placeholders for remaining slots to ensure a minimum of 6 thumbnails -->
						<?php 
						// If there are fewer than 6 thumbnails, add placeholders
						while ($slot_count < $min_slots): 
							$slot_count++;
						?>
							<div class="swiper-slide-thumbnail thumbnail-placeholder relative w-full" style="padding-top: 75%;"> <!-- 4:3 aspect ratio -->
								<img class=" hidden absolute inset-0 w-full object-cover rounded-2xl" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/image-placeholder-highlights.jpg" alt="" title="" />
								<span class=" absolute inset-0 flex items-center justify-center text-gray-500"><img class="absolute inset-0 w-full object-cover rounded-2xl" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/image-placeholder-highlights.jpg" alt="" title="" /></span>
							</div>
						<?php endwhile; ?>
					</div>
				</div>

			<?php endif; ?>
	</div>
</div>
<script>
	document.addEventListener("DOMContentLoaded", () => {
    const thumbnailContainer = document.querySelector('.thumbnails-container');

    if (thumbnailContainer) {
        // Disable page scroll while hovering over the thumbnails
        let isHoveringThumbnails = false;

        // Prevent page scroll when hovering over the container
        thumbnailContainer.addEventListener('mouseenter', () => {
            isHoveringThumbnails = true;
        });

        thumbnailContainer.addEventListener('mouseleave', () => {
            isHoveringThumbnails = false;
        });

        // Handle wheel events
        document.addEventListener('wheel', (event) => {
            if (isHoveringThumbnails) {
                const scrollTop = thumbnailContainer.scrollTop;
                const scrollHeight = thumbnailContainer.scrollHeight;
                const offsetHeight = thumbnailContainer.offsetHeight;
                const isAtTop = scrollTop === 0;
                const isAtBottom = scrollTop + offsetHeight >= scrollHeight;

                // Allow scrolling the thumbnails but block page scroll
                if (
                    (event.deltaY < 0 && !isAtTop) || // Scrolling up and not at the top
                    (event.deltaY > 0 && !isAtBottom) // Scrolling down and not at the bottom
                ) {
                    event.preventDefault(); // Prevent page scroll

                    // Adjust the scroll speed (increase the scroll distance by a factor of 2 here)
                    thumbnailContainer.scrollBy({
                        top: event.deltaY * 2, // Multiply the deltaY to make scrolling faster
                        behavior: 'smooth',
                    });
                }
            }
        });

        // Handle touch scrolling (mobile)
        let touchStartY = 0;

        thumbnailContainer.addEventListener('touchstart', (event) => {
            touchStartY = event.touches[0].clientY;
        });

        thumbnailContainer.addEventListener('touchmove', (event) => {
            if (isHoveringThumbnails) {
                const touchMoveY = event.touches[0].clientY;
                const deltaY = touchStartY - touchMoveY;
                thumbnailContainer.scrollBy({
                    top: deltaY * 2, // Multiply the deltaY to make scrolling faster on touch devices as well
                    behavior: 'smooth',
                });
                touchStartY = touchMoveY;
                event.preventDefault(); // Prevent page scroll on touch devices
            }
        });
    }
});



</script>