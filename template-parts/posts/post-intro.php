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
        let isHoveringThumbnails = false;
        let scrollLockPosition = 0;

        // Mouse enter and leave events to toggle hover state
        thumbnailContainer.addEventListener('mouseenter', () => {
            isHoveringThumbnails = true;
            // Lock the scroll position of the page
            scrollLockPosition = window.scrollY;
        });

        thumbnailContainer.addEventListener('mouseleave', () => {
            isHoveringThumbnails = false;
        });

        // Prevent page scrolling while hovering the thumbnail container
        document.addEventListener('scroll', (event) => {
            if (isHoveringThumbnails) {
                // Lock the scroll position to the stored value
                window.scrollTo(0, scrollLockPosition);
            }
        });

        // Handle wheel scrolling for the thumbnail container
        document.addEventListener('wheel', (event) => {
            if (isHoveringThumbnails) {
                const scrollTop = thumbnailContainer.scrollTop;
                const scrollHeight = thumbnailContainer.scrollHeight;
                const offsetHeight = thumbnailContainer.offsetHeight;
                const isAtTop = scrollTop === 0;
                const isAtBottom = scrollTop + offsetHeight >= scrollHeight;

                if (
                    (event.deltaY < 0 && !isAtTop) || // Scrolling up and not at the top
                    (event.deltaY > 0 && !isAtBottom) // Scrolling down and not at the bottom
                ) {
                    event.preventDefault(); // Prevent page scroll
                    thumbnailContainer.scrollBy({
                        top: event.deltaY * 1.5, // Adjust scroll speed
                        behavior: 'smooth',
                    });
                }
            }
        });

        // Prevent touch scrolling on the page
        document.addEventListener('touchmove', (event) => {
            if (isHoveringThumbnails) {
                event.preventDefault(); // Prevent page scroll
            }
        }, { passive: false });

        // Drag support for mouse
        let isDragging = false;
        let startX = 0;
        let scrollLeft = 0;

        thumbnailContainer.addEventListener('mousedown', (event) => {
            isDragging = true;
            startX = event.pageX - thumbnailContainer.offsetLeft;
            scrollLeft = thumbnailContainer.scrollLeft;
            thumbnailContainer.classList.add('is-dragging');
            event.preventDefault();
        });

        thumbnailContainer.addEventListener('mousemove', (event) => {
            if (isDragging) {
                const x = event.pageX - thumbnailContainer.offsetLeft;
                const deltaX = x - startX;
                thumbnailContainer.scrollLeft = scrollLeft - deltaX;
            }
        });

        thumbnailContainer.addEventListener('mouseup', () => {
            isDragging = false;
            thumbnailContainer.classList.remove('is-dragging');
        });

        thumbnailContainer.addEventListener('mouseleave', () => {
            isDragging = false;
            thumbnailContainer.classList.remove('is-dragging');
        });

        // Touch drag support
        thumbnailContainer.addEventListener('touchstart', (event) => {
            startX = event.touches[0].clientX;
            scrollLeft = thumbnailContainer.scrollLeft;
        });

        thumbnailContainer.addEventListener('touchmove', (event) => {
            if (isHoveringThumbnails) {
                const x = event.touches[0].clientX;
                const deltaX = startX - x;
                thumbnailContainer.scrollLeft = scrollLeft + deltaX; // Scroll horizontally
                event.preventDefault(); // Prevent page scroll
            }
        }, { passive: false });
    }
});






</script>