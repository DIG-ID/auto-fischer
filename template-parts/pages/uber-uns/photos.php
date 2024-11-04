<section class="section-photos">
	<div class="theme-container theme-grid gap-y-4 md:gap-y-6 lg:gap-y-0">
		<div class="col-span-2 md:col-span-6 xl:col-span-7 grid grid-cols-7 gap-x-4 md:gap-x-6 xl:gap-x-8">
			<div class="col-span-2 flex flex-col gap-4 md:gap-x-6  xl:gap-y-8">
				<div class="bg-dark-blue-shade rounded-2xl h-full pl-8 pt-10">
					<p class="font-sans font-medium text-orange-shade text-5xl mb-6">25</p>
					<p class="font-sans font-bold text-white text-3xl leading-[2.813rem]"><?php printf( esc_html__( 'Jahre im%s Geschäft', 'auto-fischer' ), '<br>' ); ?></p>
				</div>
				<?php
				$img_01 = get_field( 'photos_image_1' );
				if ( $img_01 ) :
					echo wp_get_attachment_image( $img_01, 'full', false, array( 'class' => 'max-w-full w-full object-cover rounded-2xl' ) );
				endif;
				?>
			</div>
			<div class="col-span-5">
				<?php
				$img_02 = get_field( 'photos_image_2' );
				if ( $img_02 ) :
					echo wp_get_attachment_image( $img_02, 'full', false, array( 'class' => 'max-w-full w-full object-cover rounded-2xl' ) );
				endif;
				?>
			</div>
		</div>		<div class="col-span-2 md:col-span-6 xl:col-span-5 grid grid-cols-5 gap-4 md:gap-x-6 xl:gap-8">
			<div class="col-span-5">
				<?php
				$img_03 = get_field( 'photos_image_3' );
				if ( $img_03 ) :
					echo wp_get_attachment_image( $img_03, 'full', false, array( 'class' => 'max-w-full w-full object-cover rounded-2xl' ) );
				endif;
				?>
			</div>
			<div class="col-span-2">
				<?php
				$img_04 = get_field( 'photos_image_4' );
				if ( $img_04 ) :
					echo wp_get_attachment_image( $img_04, 'full', false, array( 'class' => 'max-w-full w-full object-cover rounded-2xl' ) );
				endif;
				?>
			</div>
			<div class="col-span-3">
				<?php
				$img_05 = get_field( 'photos_image_5' );
				if ( $img_05 ) :
					echo wp_get_attachment_image( $img_05, 'full', false, array( 'class' => 'max-w-full w-full object-cover rounded-2xl' ) );
				endif;
				?>
			</div>
		</div>
	</div>
</section>
