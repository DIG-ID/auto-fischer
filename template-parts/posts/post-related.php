<div class="lg:flex lg:flex-col lg:justify-between lg:h-full pt-28 lg:pt-0 pb-28 lg:pb-0">
	<h2 class="text-title-h3 mb-6"><?php esc_html_e( 'Related News', 'aare' ); ?></h2>
	<?php
	$args = array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'post__not_in'        => array( get_the_ID() ),
		'posts_per_page'      => 3,
		'order'               => 'DESC',
		'ignore_sticky_posts' => true,

	);
	$news_query = new WP_Query( $args );
	if ( $news_query->have_posts() ) :
		echo '<ul class="flex flex-col justify-between h-full">';
		while( $news_query->have_posts() ) :
			$news_query->the_post();
			?>
			<li>
				<a class="bg-blue-shade-3 transition-all duration-500 ease-in-out hover:bg-blue-shade-4 block rounded-[20px] overflow-hidden mb-6 lg:mb-0" href="<?php echo esc_url( get_the_permalink() ); ?>">
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'card-news card-news--related p-3   flex ' ); ?>>
						<?php
						if ( has_post_thumbnail() ) :
							the_post_thumbnail( 'full', array( 'class' => 'w-[108px] lg:w-[135px] object-cover h-[108px] lg:h-[135px] rounded-[12px]' ) );
						else :
							?><span class="min-w-[108px] lg:min-w-[135px] h-[108px] lg:h-[135px] bg-blue-shade-1 text-blue-shade-2 flex flex-col justify-center items-center rounded-[12px] font-poppins text-xs text-center">no featured image</span> <?php
						endif;
						?>
						<div class="ml-4 pr-6 flex flex-col justify-between">
							<h3 class="text-title-h3"><?php the_title(); ?></h3>
							<p class="text-body line-clamp-3"><?php echo esc_html( get_the_excerpt() ); ?></p>
						</div>
					</article>
				</a>
			</li>
			<?php
		endwhile;
		echo '</ul>';
		wp_reset_postdata();
	endif;
	?>
</div>
