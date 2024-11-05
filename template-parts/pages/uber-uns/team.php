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
		if ( have_rows( 'team_members' ) ) :
			$i = 0;
			while ( have_rows( 'team_members' ) ) :
				the_row();
				// Get the subfields
				$picture_id  = get_sub_field( 'picture' );
				$name        = get_sub_field( 'name' );
				$member_role = get_sub_field( 'roles' );
				$picture_url = wp_get_attachment_image_url( $picture_id, 'full' );

				if ( 3 === $i  ) :
					echo '<div class="team-member-card col-span-3 hidden invisible xl:block xl:visible"></div>';
				endif;
				?>
				<div class="team-member-card col-span-1 md:col-span-2 xl:col-span-3 mb-6 md:mb-10 xl:mb-16">
					<?php
					//var_dump($i);
					if ( $picture_id ) :
						?>
						<!-- Display image if it exists -->
						<img src="<?php echo esc_url( $picture_url ); ?>" alt="<?php echo esc_attr( $name ); ?>" class="w-full h-auto object-cover rounded-xl">
						<?php
					else :
						?>
						<!-- Placeholder with background color if no image -->
						<div class="w-full h-[240px] md:h-[270px] xl:h-[415px] bg-dark-blue-shade flex items-center justify-center rounded-xl">
						</div>
						<?php
					endif;
					?>
					<div class="mt-4 md:mt-6 xl:mt-7 text-left">
						<h3 class="title-smallest mb-3"><?php echo $name; ?></h3>
						<p class="text-body"><?php echo $member_role; ?></p>
					</div>
				</div>

				<?php
				$i++;
			endwhile;
		endif;
		?>
	</div>
</section>
