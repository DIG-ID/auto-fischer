<section class="section-reviews bg-[#F9FBFC] relative pt-16 md:pt-20 xl:pt-32 pb-28 overflow-hidden">
        <div class="theme-container theme-grid">
            <div class="col-span-2 md:col-span-3 xl:col-span-5">
                <p class="title-secondary !text-[40px] text-darker-blue-shade max-w-[304px] md:max-w-[342px]  xl:max-w-full !leading-[45px] mb-10"><?php echo get_field( 'reviews_title' ); ?></p>
            </div>
            <div class="col-span-2 md:col-span-3 xl:col-span-3 col-start-1 md:col-start-4 xl:col-start-10 text-right">
                <?php
                $button_reviews = get_field( 'reviews_source' );
                if ( $button_reviews ) :
                    $link_url    = $button_reviews['url'];
                    $link_title  = $button_reviews['title'];
                    $link_target = $button_reviews['target'] ? $button_reviews['target'] : '_self';
                    ?>
                    <a class="btn-main btn-main--transparent max-w-[310px]" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                <?php
                    endif;
                ?>
            </div>
        </div>
        <div class="theme-container overflow-hidden">
			<?php
			$args = array(
				'post_type' => 'review',
				'posts_per_page' => -1, // Adjust the number as needed
			);

			$query = new WP_Query($args);

			if ($query->have_posts()) : ?>
				<div class="reviews-swiper swiper-container">
					<div class="swiper-wrapper">
						<?php while ($query->have_posts()) : $query->the_post(); ?>
							<?php
							// Get custom fields
							$name = get_field('name'); // Text field for reviewer's name
							$quote = get_field('quote'); // Textarea for the quote
							?>
							<div class="swiper-slide">
								<div class="p-10 lg:h-[250px] lg:max-h-[250px] bg-white rounded-2xl flex flex-col relative text-left">
									<h3 class="title-smallest text-blue-shade mb-12"><?php echo esc_html($name); ?></h3>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/quoteMarks.svg" class="absolute top-10 right-10" alt="quotation marks" title="quotation marks" />
									<p class="text-body !leading-[30px] line-clamp-4">&ldquo;<?php echo esc_html($quote); ?><span class="whitespace-nowrap">&rdquo;</span></p>
								</div>
							</div>
						<?php endwhile; ?>
					</div>
					<!-- Pagination Controls -->
					<div class="reviews-pagination flex items-center justify-start space-x-4 mt-4">
						<button class="arrow-left border border-darker-blue-shade py-[0.45rem] px-[1.55rem] rounded-xl"><</button>
						<div class="pagination-info text-body max-w-16 text-center"></div>
						<button class="arrow-right border border-darker-blue-shade py-[0.45rem] px-[1.55rem] rounded-xl">></button>
					</div>
				</div>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
        </div>
</section>
