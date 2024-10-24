<section class="section-contact bg-white pt-28 pb-24 relative overflow-hidden">
    <div class="px-6 lg:px-0 mx-auto w-full lg:max-w-[1700px] theme-grid bg-dark-blue-shade rounded-2xl">
        <div class="col-span-2 md:col-span-6 xl:col-span-6">
            <?php
            $contactImg = get_field( 'contact_image' );
            if ( $contactImg ) :
                echo wp_get_attachment_image( $contactImg, 'full', false, array( 'class' => 'w-full object-cover rounded-2xl' ) );
            endif;
            ?>
        </div>
        <div class="col-span-2 md:col-span-6 xl:col-span-4 col-start-1 md:col-start-1 xl:col-start-8 flex flex-col justify-center">
            <h2 class="title-secondary text-light-blue-shade"><?php echo get_field( 'contact_title' ); ?></h2>
            <p class="text-body text-light-blue-shade my-10"><?php echo get_field( 'contact_text' ); ?></p>
            <?php
            $button_contact = get_field( 'contact_button' );
            if ( $button_contact ) :
                $link_url    = $button_contact['url'];
                $link_title  = $button_contact['title'];
                $link_target = $button_contact['target'] ? $button_contact['target'] : '_self';
                ?>
                <a class="btn-main btn-main--full-blue-darkbg max-w-[207px]" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
			<?php
				endif;
			?>
        </div>        
    </div>
</section>