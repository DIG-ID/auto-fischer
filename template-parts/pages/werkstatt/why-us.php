<section class="section-why-us py-32">
	<div class="theme-container">
		<div class="theme-grid mb-8 md:mb-16">
			<div class="col-span-12">
				<h2 class="title-secondary !xl:text-[40px] !xl:leading-none mb-4"><?php the_field( 'why_us_title' ); ?></h2>
			</div>
		</div>
		<div class="theme-grid">
			<?php
			if ( have_rows( 'why_us_list' ) ) :
				$i = 1;
				while ( have_rows( 'why_us_list' ) ) :
					the_row();
					$icon = get_sub_field( 'icon' );
					?>
					<div class="col-span-2 md:col-span-6 xl:col-span-4 grid grid-cols-4 mb-8 last:mb-0 md:mb-0">
						<div class="col-span-3">
							<i class="h-[70px] flex flex-col justify-end">
								<?php
								if ( $icon ) :
									echo wp_get_attachment_image( $icon, 'full', false, array( 'class' => 'w-[65px] object-cover', 'loading' => 'lazy' ) );
								endif;
								?>
							</i>
							<h2 class="title-smallest !font-medium mb-7 mt-9"><?php the_sub_field( 'title' ); ?></h2>
							<p class="text-body"><?php the_sub_field( 'text' ); ?></p>
						</div>
					</div>
					<?php
					++$i;
				endwhile;
			endif;
			?>
		</div>
	</div>
</section>