<section class="section-info bg-white relative pb-24 md:pb-32 overflow-hidden">
    <div class="theme-container theme-grid">
        <div class="has-offset-bg col-span-2 md:col-span-3 xl:col-span-6 md:py-24">
            <?php
            $goodImg = get_field( 'good_to_know_image' );
            if ( $goodImg ) :
                echo wp_get_attachment_image( $goodImg, 'full', false, array( 'class' => 'w-full object-cover rounded-2xl z-10 relative' ) );
            endif;
            ?>
        </div>
        <div class="col-span-2 md:col-span-3 xl:col-span-4 col-start-1 md:col-start-4 xl:col-start-8 flex flex-col justify-center">
            <h2 class="title-secondary mt-8 md:mt-0"><?php the_field( 'good_to_know_title' ); ?></h2>
            <p class="text-body py-8 md:py-[59px] max-w-[440px]"><?php the_field( 'good_to_know_text' ); ?></p>
            <?php
            if( have_rows('good_to_know_list') ):
                while( have_rows('good_to_know_list') ) : the_row(); ?>
                <p class="text-body !font-bold flex items-center mb-5"><span class="mr-3"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/list-arrow.svg" alt="List Arrow" title="List Arrow" /></span><?php echo get_sub_field( 'item' ); ?></p>
            <?php
                endwhile;
            endif;
            ?>
            <?php
            $button_good = get_field( 'good_to_know_button' );
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