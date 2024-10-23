<section class="section-why-choose bg-white pb-32 relative overflow-hidden">
    <div class="theme-container theme-grid">
        <div class="col-span-2 md:col-span-6 xl:col-span-6 bg-light-blue-shade rounded-2xl p-20 relative">
            <h3 class="title-smaller"><?php echo get_field( 'buy_title' ); ?></h3>
            <p class="text-body max-w-[310px] py-7"><?php echo get_field( 'buy_text' ); ?></p>
            <?php
            $button_buy = get_field( 'buy_button' );
            if ( $button_buy ) :
                $link_url    = $button_buy['url'];
                $link_title  = $button_buy['title'];
                $link_target = $button_buy['target'] ? $button_buy['target'] : '_self';
                ?>
                <a class="btn-main btn-main--full-blue" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
			<?php
				endif;
			?>
            <?php
            $buyImg = get_field( 'buy_icon' );
            if ( $buyImg ) :
                echo wp_get_attachment_image( $buyImg, 'full', false, array( 'class' => 'w-[95px] object-cover md:absolute md:right-[60px] md:bottom-[60px]' ) );
            endif;
            ?>
        </div>
        <div class="col-span-2 md:col-span-6 xl:col-span-6 bg-[#FFEDDE] rounded-2xl p-20 relative">
            <h3 class="title-smaller"><?php echo get_field( 'sell_title' ); ?></h3>
            <p class="text-body max-w-[350px] py-7"><?php echo get_field( 'sell_text' ); ?></p>
            <?php
            $button_sell = get_field( 'buy_button' );
            if ( $button_sell ) :
                $link_url    = $button_sell['url'];
                $link_title  = $button_sell['title'];
                $link_target = $button_sell['target'] ? $button_sell['target'] : '_self';
                ?>
                <a class="btn-main btn-main--full-orange" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
			<?php
				endif;
			?>
            <?php
            $buyImg = get_field( 'sell_icon' );
            if ( $buyImg ) :
                echo wp_get_attachment_image( $buyImg, 'full', false, array( 'class' => 'w-[86px] object-cover md:absolute md:right-[60px] md:bottom-[60px]' ) );
            endif;
            ?>
        </div>
    </div>
</section>