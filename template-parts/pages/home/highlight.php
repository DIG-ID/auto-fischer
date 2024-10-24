<section class="section-highlight relative overflow-hidden">
    <?php
    $highlightImg = get_field( 'highlight_image' );
    if ( $highlightImg ) :
        echo wp_get_attachment_image( $highlightImg, 'full', false, array( 'class' => 'w-full object-cover' ) );
    endif;
    ?>
    <div class="theme-container theme-grid absolute top-0 left-1/2 -translate-x-1/2 py-28 h-full">
        <div class="col-span-2 md:col-span-6 xl:col-span-12 flex flex-col text-center justify-end items-center">
            <h2 class="title-secondary text-light-blue-shade"><?php echo get_field( 'highlight_title' ); ?></h2>
            <p class="text-body text-light-blue-shade pt-7 pb-12"><?php echo get_field( 'highlight_text' ); ?></p>
            <?php
            $button_highlight = get_field( 'highlight_button' );
            if ( $button_highlight ) :
                $link_url    = $button_highlight['url'];
                $link_title  = $button_highlight['title'];
                $link_target = $button_highlight['target'] ? $button_highlight['target'] : '_self';
                ?>
                <a class="btn-main btn-main--full-blue-darkbg max-w-[210px]" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
			<?php
				endif;
			?>
        </div>
    </div>
</section>