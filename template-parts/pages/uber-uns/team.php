<section class="section-team">
	<div class="theme-container theme-grid">
		<div class="col-span-12">
			<div class="col-span-2 md:col-span-3 xl:col-span-5">
				<h2 class="title-secondary text-darker-blue-shade mb-10"><?php the_field( 'team_title' ); ?></h2>
			</div>
		</div>
	</div>
	<div class="theme-container theme-grid">
		<?php
		$team_args = array(
			'post_type'   => 'team',
			'post_status' => 'published',
			'order'       => 'DESC',
			'orderby'     => 'date',
		);
		$team_query = new WP_Query( $team_args );
		if ( $team_query->have_posts() ) :
			$i = 0;
			while ( $team_query->have_posts() ) :
				$team_query->the_post();
				if ( 3 === $i  ) :
					echo '<div class="team-member-card col-span-3 hidden invisible xl:block xl:visible"></div>';
				endif;
				?>
				<div class="team-member-card col-span-1 md:col-span-2 xl:col-span-3 mb-6 md:mb-10 xl:mb-16">
					<?php
					if ( has_post_thumbnail() ) :
						the_post_thumbnail( 'full', array( 'class' => 'w-full h-auto object-cover rounded-xl' ) );
					else :
						echo '<div class="w-full h-[240px] md:h-[270px] xl:h-[415px] bg-dark-blue-shade flex items-center justify-center rounded-xl"></div>';
					endif;
					?>
					<div class="mt-4 md:mt-6 xl:mt-7 text-left">
						<h3 class="title-smallest mb-3"><?php the_title(); ?></h3>
						<p class="text-body"><?php the_field( 'role' ); ?></p>
					</div>
				</div>
				<?php
				$i++;
			endwhile;
		endif;
		wp_reset_postdata();
		?>
	</div>
</section>
