<section class="section-hero 2xl:min-h-[99vh] bg-light-blue-shade pt-0 md:pt-44 xl:pt-[186px] pb-3 md:pb-32 xl:pb-[140px] relative overflow-hidden">

	<div class="absolute top-0 right-0 w-3/5 xl:w-1/2 hidden md:block">
		<div class="relative">
			<?php
			$heroimage = get_field( 'hero_image' );
			if ( $heroimage ) :
				echo wp_get_attachment_image(
					$heroimage,
					'full',
					false,
					array(
						'class'         => 'object-cover w-full',
						'fetchpriority' => 'high',
						'loading'       => 'eager',
					)
				);
			endif;
			?>
		</div>
	</div>
	<?php
	$heroimage_m = get_field( 'hero_image_mobile' );
	if ( $heroimage_m ) :
		echo wp_get_attachment_image(
			$heroimage_m,
			'full',
			false,
			array(
				'class'         => 'w-full object-cover relative md:hidden',
				'fetchpriority' => 'high',
				'loading'       => 'eager',
			)
		);
	endif;
	?>
	<div class="theme-container theme-grid relative z-30 h-full py-8 md:py-0">
		<div class="col-span-2 md:col-span-5 xl:col-span-5 flex flex-col gap-y-8 xl:gap-y-16">
			<div>
				<?php do_action( 'breadcrumbs' ); ?>
				<h1 class="title-secondary !xl:text-[40px] !xl:leading-[45px] text-darker-blue-shade mt-5"><?php the_field( 'hero_title' ); ?></h1>
			</div>

			<div class="flex flex-col gap-4">
				<p class="inline-block self-start leading-none font-sans font-medium text-base text-dark-blue-shade bg-orange-shade p-3 pb-2 rounded-lg"><?php the_field( 'hero_badge' ); ?></p>
				<p class="title-secondary !font-normal text-darker-blue-shade"><?php the_field( 'hero_secondary_title' ); ?></p>
				<p class="text-body"><?php the_field( 'hero_text' ); ?></p>
			</div>
			<div>
				<?php
				$button_1 = get_field( 'hero_button_1' );
				if ( $button_1 ) :
					$link_url    = $button_1['url'];
					$link_title  = $button_1['title'];
					$link_target = $button_1['target'] ? $button_1['target'] : '_self';
					?>
					<a class="btn-main btn-main--full-blue mr-1 md:mr-5" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
					<?php
				endif;
				?>
				<?php
				$button_2 = get_field( 'hero_button_2' );
				if ( $button_2 ) :
					$link_url    = $button_2['url'];
					$link_title  = $button_2['title'];
					$link_target = $button_2['target'] ? $button_2['target'] : '_self';
					?>
					<a class="btn-main btn-main--empty mt-3 sm:mt-0" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
					<?php
				endif;
				?>
			</div>

		</div>
	</div>
</section>