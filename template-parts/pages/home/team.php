<section class="section-team bg-white relative pt-16 md:pt-20 xl:pt-40 pb-12 md:pb-20 xl:pb-40 overflow-hidden">
	<div class="theme-container theme-grid">
		<div class="col-span-2 md:col-span-3 xl:col-span-5">
			<p class="title-secondary text-darker-blue-shade mb-10"><?php echo get_field( 'team_title' ); ?></p>
		</div>
		<div class="col-span-2 md:col-span-3 xl:col-span-3 col-start-1 md:col-start-4 xl:col-start-10 text-right">
			<?php
			$button_team = get_field( 'team_call_to_action' );
			if ( $button_team ) :
				$link_url    = $button_team['url'];
				$link_title  = $button_team['title'];
				$link_target = $button_team['target'] ? $button_team['target'] : '_self';
				?>
				<a class="btn-main btn-main--transparent max-w-[210px]" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
			<?php
				endif;
			?>
		</div>
	</div>
	<div class="theme-container overflow-visible">
		<?php
		$team_args = array(
			'post_type'   => 'team',
			'post_status' => 'published',
			'order'       => 'DESC',
			'orderby'     => 'date',
		);
		$team_query = new WP_Query( $team_args );
		if ( $team_query->have_posts() ) :
			echo '<div class="team-swiper swiper-container"><div class="swiper-wrapper">';
			while ( $team_query->have_posts() ) :
				$team_query->the_post();
				?>
				<div class="swiper-slide">
					<div class="team-member-card">
						<?php
						if ( has_post_thumbnail() ) :
							the_post_thumbnail( 'full', array( 'class' => 'w-full h-auto object-cover rounded-xl' ) );
						else :
							echo '<div class="w-full h-[415px] bg-dark-blue-shade flex items-center justify-center rounded-xl"></div>';
						endif;
						?>
						<div class="mt-4 md:mt-6 xl:mt-7 text-left">
							<h3 class="title-smallest mb-3"><?php the_title(); ?></h3>
							<p class="text-body"><?php the_field( 'role' ); ?></p>
						</div>
					</div>
				</div>
				<?php
			endwhile;
			echo '</div></div>';
		endif;
		wp_reset_postdata();
		?>
	</div>
</section>
