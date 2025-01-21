<section class="section-highlight relative overflow-hidden mt-40">
	<?php
	$args = array(
		'post_type'      => 'unser-highlight',
		'post_status'    => 'publish',
		'order'          => 'ASC',
		'orderby'        => 'date',
		'posts_per_page' => -1,
	);
	$highlight_query = new WP_Query( $args ); ?>
	<div class="theme-container theme-grid">
		<div class="col-span-2 md:col-span-6 lg:col-span-12 text-center">
			<h2 class="title-secondary dark-blue-shade"><?php esc_html_e( 'Unsere Highglights', 'auto-fischer' ); ?></h2>
			<p class="text-body dark-blue-shade pt-5 pb-7"><?php esc_html_e( 'Entdecken Sie unsere aktuellen Highlight-Fahrzeuge.', 'auto-fischer' ); ?></p>
		</div>

	</div>
	<div class="highlights-swiper relative">
		<div class="swiper-wrapper">
			<?php
			if ( $highlight_query->have_posts() ) :
				while ( $highlight_query->have_posts() ) :
					$highlight_query->the_post();
					
					// Get featured image
					$highlightImg = get_the_post_thumbnail_url( get_the_ID(), 'full' );
					?>
					<div class="swiper-slide relative">
						<!-- Background image -->
						<div class="relative inset-0 z-10">
							<img src="<?php echo $highlightImg; ?>" alt="" class="w-full h-full object-cover min-w-full md:min-w-[743px] lg:w-[1920px] min-h-[361px] max-h-[361px] md:max-h-[616px] md:min-h-[616px] lg:min-h-[850px] lg:max-h-[850px]">
						</div>
						<!-- Content -->
						<div class="theme-container theme-grid absolute bottom-0 left-1/2 -translate-x-1/2 pb-4 md:pb-10 lg:pb-[60px] z-20">
							<div class="col-span-2 md:col-span-6 xl:col-span-12 flex flex-col text-center justify-end items-center relative">

								<div class="flex items-center justify-center gap-4 relative">
									<!-- Previous Arrow -->
									<div class="swiper-button-prev cursor-pointer"></div>
									<!-- Button -->
									<a class="btn-main btn-main--full-blue-darkbg max-w-[210px]" href="<?php the_permalink(); ?>">
										<?php esc_html_e( 'Mehr erfahren', 'auto-fischer' ); ?>
									</a>
									<!-- Next Arrow -->
									<div class="swiper-button-next cursor-pointer"></div>
								</div>
							</div>
						</div>
					</div>
				<?php
				endwhile;
				wp_reset_postdata();
			endif;
			?>
		</div>
		<!-- Thumbnails -->
		<div class="theme-container absolute top-[31px] md:top-[40px] lg:top-[74px] left-0 right-0 z-20">
			<div class="swiper swiper-thumbnails">
				<div class="swiper-wrapper grid grid-cols-2 md:grid-cols-6 lg:grid-cols-12 gap-x-6 lg:gap-x-7">
					<?php
					if ( $highlight_query->have_posts() ) :
						while ( $highlight_query->have_posts() ) :
							$highlight_query->the_post();
							?>
							<div class="swiper-slide px-1 border-b-2 pb-6 border-blue-shade cursor-pointer !w-full col-span-1 md:col-span-2 lg:col-span-3 z-20 relative">
								<span class="swiper-thumbnail-title text-white block">
									<?php the_title(); ?>
								</span>
								<span class="font-sans text-xs md:text-xs xl:text-lg font-light text-white inline-block text-nowrap">
									<?php the_field( 'info_model' ); ?>
								</span>
							</div>
						<?php
						endwhile;
						wp_reset_postdata();
					endif;
					?>
				</div>
			</div>
		</div>
	</div>
</section>
