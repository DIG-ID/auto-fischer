<section class="section-vehicles-info-1 bg-light-blue-shade pb-0 pt-20 md:pt-16 md:pb-0 xl:py-40 relative overflow-hidden">
		<div class="px-6 2xl:px-0 mx-auto w-full lg:max-w-[1440px] grid grid-cols-2 md:grid-cols-6 xl:grid-cols-12 gap-x-6">
				<div class="col-span-2 md:col-span-6 xl:col-span-6 md:grid md:grid-cols-3 xl:grid-cols-6 gap-6 py-24 order-2 xl:order-1 auto-rows-max content-center">
						<div class="w-[30%] md:w-full float-left md:float-none mr-[4%] md:mr-0 md:col-span-1 xl:col-span-2">
								<?php
								$goodImg_1 = get_field( 'vehicles_info_1_image_1' );
								if ( $goodImg_1 ) :
										echo wp_get_attachment_image( $goodImg_1, 'full', false, array( 'class' => 'w-full object-cover rounded-2xl relative max-h-[280px]' ) );
								endif;
								?>
						</div>
						<div class="w-[64%] md:w-full float-left md:float-none md:col-span-2 xl:col-span-4">
								<?php
								$goodImg_2 = get_field( 'vehicles_info_1_image_2' );
								if ( $goodImg_2 ) :
										echo wp_get_attachment_image( $goodImg_2, 'full', false, array( 'class' => 'w-full object-cover rounded-2xl relative max-h-[280px]' ) );
								endif;
								?>
						</div>
						<div class="w-full float-left md:float-none mt-4 md:mt-0 md:col-span-3 xl:col-span-6">
								<?php
								$goodImg_3 = get_field( 'vehicles_info_1_image_3' );
								if ( $goodImg_3 ) :
										echo wp_get_attachment_image( $goodImg_3, 'full', false, array( 'class' => 'w-full object-cover rounded-2xl relative' ) );
								endif;
								?>
						</div>
				</div>
				<div class="col-span-2 md:col-span-6 xl:col-span-5 col-start-1 md:col-start-1 xl:col-start-8 flex flex-col justify-center order-1 xl:order-2">
						<h2 class="title-secondary !text-[40px] !leading-none"><?php the_field( 'vehicles_info_1_title' ); ?></h2>
						<p class="text-body py-5 md:py-[59px] max-w-[460px]"><?php the_field( 'vehicles_info_1_description' ); ?></p>
						<?php
						if( have_rows('vehicles_info_1_info_list') ):
								while( have_rows('vehicles_info_1_info_list') ) : the_row(); ?>
								<p class="title-smallest flex items-center"><span class="mr-3"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/checkmark-green.svg" class="min-w-[25px]" alt="List Arrow" title="List Arrow" /></span><?php echo get_sub_field( 'title' ); ?></p>
								<p class="text-body ml-3 pl-[25px] [&:not(:last-of-type)]:border-l border-black pt-2 pb-8"><?php echo get_sub_field( 'text' ); ?></p>
						<?php
								endwhile;
						endif;
						?>
						<?php
						$button_good = get_field( 'vehicles_info_1_button' );
						if ( $button_good ) :
								$link_url    = $button_good['url'];
								$link_title  = $button_good['title'];
								$link_target = $button_good['target'] ? $button_good['target'] : '_self';
								?>
								<a class="btn-main btn-main--full-blue max-w-[209px] mt-10 mx-auto md:mx-0" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
			<?php
				endif;
			?>
				</div>
		</div>
</section>

<section class="section-vehicles-info-2 bg-white pb-0 pt-24 md:pt-16 md:pb-0 xl:py-40 relative overflow-hidden">
		<div class="theme-container theme-grid">
				<div class="col-span-2 md:col-span-6 xl:col-span-5 flex flex-col justify-center">
						<h2 class="title-secondary !text-[40px] !leading-none"><?php the_field( 'vehicles_info_1_title' ); ?></h2>
						<p class="text-body py-5 md:py-[59px] max-w-[460px]"><?php the_field( 'vehicles_info_1_description' ); ?></p>
						<?php
						if( have_rows('vehicles_info_2_info_list') ):
								while( have_rows('vehicles_info_2_info_list') ) : the_row(); ?>
								<p class="title-smallest flex items-center"><span class="mr-3"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/checkmark-green.svg" class="min-w-[25px]" alt="List Arrow" title="List Arrow" /></span><?php the_sub_field( 'title' ); ?></p>
								<p class="text-body ml-3 pl-[25px] [&:not(:last-of-type)]:border-l border-black pt-2 pb-8"><?php the_sub_field( 'text' ); ?></p>
						<?php
								endwhile;
						endif;
						?>
						<?php
						$button_good = get_field( 'vehicles_info_2_button' );
						if ( $button_good ) :
								$link_url    = $button_good['url'];
								$link_title  = $button_good['title'];
								$link_target = $button_good['target'] ? $button_good['target'] : '_self';
								?>
								<a class="btn-main btn-main--full-orange max-w-[166px] mt-10  mx-auto md:mx-0" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
			<?php
				endif;
			?>
				</div>
				<div class="col-span-2 md:col-span-6 xl:col-span-6 col-start-1 md:col-start-1 xl:col-start-8 py-24 md:grid md:grid-cols-3 xl:grid-cols-6 gap-6 auto-rows-max content-center">
						<div class="w-[64%] md:w-full mr-[4%] md:mr-0 float-left md:float-none col-span-1 md:col-span-2 xl:col-span-4">
								<?php
								$goodImg_2 = get_field( 'vehicles_info_2_image_1' );
								if ( $goodImg_2 ) :
										echo wp_get_attachment_image( $goodImg_2, 'full', false, array( 'class' => 'w-full object-cover rounded-2xl relative max-h-[280px]' ) );
								endif;
								?>
						</div>
						<div class="w-[30%] md:w-full float-left md:float-none md:col-span-1 xl:col-span-2">
								<?php
								$goodImg_1 = get_field( 'vehicles_info_2_image_2' );
								if ( $goodImg_1 ) :
										echo wp_get_attachment_image( $goodImg_1, 'full', false, array( 'class' => 'w-full object-cover rounded-2xl relative max-h-[280px]' ) );
								endif;
								?>
						</div>
						
						<div class="w-full float-left md:float-none mt-4 md:mt-0 md:col-span-3 xl:col-span-6">
								<?php
								$goodImg_3 = get_field( 'vehicles_info_2_image_3' );
								if ( $goodImg_3 ) :
										echo wp_get_attachment_image( $goodImg_3, 'full', false, array( 'class' => 'w-full object-cover rounded-2xl relative' ) );
								endif;
								?>
						</div>
				</div>
		</div>
</section>