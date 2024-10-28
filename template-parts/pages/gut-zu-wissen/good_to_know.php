<section class="section-vehicles-info-1 bg-light-blue-shade py-40 relative overflow-hidden">
    <div class="theme-container theme-grid">
        <div class="col-span-2 md:col-span-3 xl:col-span-6 grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-6 py-24">
            <div class="col-span-1 md:col-span-1 xl:col-span-2">
                <?php
                $goodImg_1 = get_field( 'vehicles_info_1_image_1' );
                if ( $goodImg_1 ) :
                    echo wp_get_attachment_image( $goodImg_1, 'full', false, array( 'class' => 'w-full object-cover rounded-2xl relative max-h-[280px]' ) );
                endif;
                ?>
            </div>
            <div class="col-span-1 md:col-span-2 xl:col-span-4">
                <?php
                $goodImg_2 = get_field( 'vehicles_info_1_image_2' );
                if ( $goodImg_2 ) :
                    echo wp_get_attachment_image( $goodImg_2, 'full', false, array( 'class' => 'w-full object-cover rounded-2xl relative max-h-[280px]' ) );
                endif;
                ?>
            </div>
            <div class="col-span-2 md:col-span-3 xl:col-span-6">
                <?php
                $goodImg_3 = get_field( 'vehicles_info_1_image_3' );
                if ( $goodImg_3 ) :
                    echo wp_get_attachment_image( $goodImg_3, 'full', false, array( 'class' => 'w-full object-cover rounded-2xl relative' ) );
                endif;
                ?>
            </div>
        </div>
        <div class="col-span-2 md:col-span-3 xl:col-span-5 col-start-1 md:col-start-4 xl:col-start-8 flex flex-col justify-center">
            <h2 class="title-secondary"><?php echo get_field( 'vehicles_info_1_title' ); ?></h2>
            <p class="text-body py-[59px] max-w-[440px]"><?php echo get_field( 'vehicles_info_1_description' ); ?></p>
            <?php
            if( have_rows('vehicles_info_1_info_list') ):
                while( have_rows('vehicles_info_1_info_list') ) : the_row(); ?>
                <p class="text-body !font-bold flex items-center mb-2"><span class="mr-3"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/checkmark-green.svg" alt="List Arrow" title="List Arrow" /></span><?php echo get_sub_field( 'title' ); ?></p>
                <p class="text-body mb-5"><?php echo get_sub_field( 'text' ); ?></p>
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
                <a class="btn-main btn-main--full-blue max-w-[176px] mt-10" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
			<?php
				endif;
			?>
        </div>
    </div>
</section>

<section class="section-vehicles-info-2 bg-white py-40 relative overflow-hidden">
    <div class="theme-container theme-grid">
        <div class="col-span-2 md:col-span-3 xl:col-span-5 flex flex-col justify-center">
            <h2 class="title-secondary"><?php echo get_field( 'vehicles_info_1_title' ); ?></h2>
            <p class="text-body py-[59px] max-w-[440px]"><?php echo get_field( 'vehicles_info_1_description' ); ?></p>
            <?php
            if( have_rows('vehicles_info_2_info_list') ):
                while( have_rows('vehicles_info_2_info_list') ) : the_row(); ?>
                <p class="text-body !font-bold flex items-center mb-2"><span class="mr-3"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/checkmark-green.svg" alt="List Arrow" title="List Arrow" /></span><?php echo get_sub_field( 'title' ); ?></p>
                <p class="text-body mb-5"><?php echo get_sub_field( 'text' ); ?></p>
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
                <a class="btn-main btn-main--full-orange max-w-[176px] mt-10" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
			<?php
				endif;
			?>
        </div>
        <div class="col-span-2 md:col-span-3 xl:col-span-6 col-start-1 md:col-start-4 xl:col-start-8 py-24 grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-6">
            <div class="col-span-1 md:col-span-2 xl:col-span-4">
                <?php
                $goodImg_2 = get_field( 'vehicles_info_2_image_1' );
                if ( $goodImg_2 ) :
                    echo wp_get_attachment_image( $goodImg_2, 'full', false, array( 'class' => 'w-full object-cover rounded-2xl relative max-h-[280px]' ) );
                endif;
                ?>
            </div>
            <div class="col-span-1 md:col-span-1 xl:col-span-2">
                <?php
                $goodImg_1 = get_field( 'vehicles_info_2_image_2' );
                if ( $goodImg_1 ) :
                    echo wp_get_attachment_image( $goodImg_1, 'full', false, array( 'class' => 'w-full object-cover rounded-2xl relative max-h-[280px]' ) );
                endif;
                ?>
            </div>
            
            <div class="col-span-2 md:col-span-3 xl:col-span-6">
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