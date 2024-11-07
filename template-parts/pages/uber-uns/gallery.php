<section class="section-gallery py-24 md:pt-32 xl:py-56">
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
				<!-- Pagination Controls -->
				<div class="gallery-pagination flex justify-center items-center space-x-4 mt-6 md:mt-20 xl:mt-32">
					<button class="arrow-left border border-darker-blue-shade py-[0.45rem] px-[1.55rem] rounded-xl"><</button>
					<div class="pagination-info text-body max-w-16 text-center"></div>
					<button class="arrow-right border border-darker-blue-shade py-[0.45rem] px-[1.55rem] rounded-xl">></button>
				</div>
				<?php
			endif;
			?>
		</div>
	</div>
</section>
