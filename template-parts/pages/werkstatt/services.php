<section class="section-services py-32 bg-light-blue-shade">
	<div class="theme-container">
		<div class="theme-grid mb-8 md:mb-16">
			<div class="col-span-12">
				<h2 class="title-secondary text-darker-blue-shade mb-5"><?php the_field( 'services_title' ); ?></h2>
				<p class="text-body max-w-[564px]"><?php the_field( 'services_text' ); ?></p>
			</div>
		</div>
		<div class="theme-grid gap-y-16">
			<?php
			if ( have_rows( 'services_services' ) ) :
				while ( have_rows( 'services_services' ) ) :
					the_row();
					$icon = get_sub_field( 'icon' );
					?>
					<div class="col-span-2 md:col-span-3 xl:col-span-4 grid grid-cols-4">
						<div class="col-span-3">
							<div class="h-[70px] flex flex-col justify-end">
								<?php
								if ( $icon ) :
									echo wp_get_attachment_image( $icon, 'full', false, array( 'class' => 'w-[65px] object-cover', 'loading' => 'lazy' ) );
								endif;
								?>
							</div>
							<h3 class="title-smallest !font-medium mb-7 mt-9"><?php the_sub_field( 'title' ); ?></h3>
							<p class="text-body"><?php the_sub_field( 'text' ); ?></p>
						</div>
					</div>
					<?php
				endwhile;
			endif;
			?>
			<div class="col-span-2 md:col-span-3 xl:col-span-4 xl:flex xl:flex-col xl:justify-center xl:items-center">
				<div class=" bg-white flex flex-col justify-between items-start rounded-2xl p-10 gap-y-6">
					<p class="title-smaller"><?php the_field( 'services_cta_text' ); ?></p>
					<?php
					$button_1 = get_field( 'services_cta_button' );
					if ( $button_1 ) :
						$link_url    = $button_1['url'];
						$link_title  = $button_1['title'];
						$link_target = $button_1['target'] ? $button_1['target'] : '_self';
						?>
						<a class="btn-main btn-main--full-blue mr-1 md:mr-5" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
						<?php
					endif;
					?>
				</div>
			</div>
		</div>
	</div>
</section>