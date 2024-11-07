<section class="section-intro md:min-h-[99vh] bg-transparent pt-0 md:pt-[186px] pb-3 md:pb-[140px] relative overflow-hidden">
<?php
    $heroimage = get_field( 'intro_image' );
    if ( $heroimage ) :
        echo wp_get_attachment_image( $heroimage, 'full', false, array( 'class' => 'w-3/5 xl:w-1/2 object-cover absolute top-0 right-0 hidden md:block' ) );
    endif;
    $heroimage_m = get_field( 'intro_image' );
    if ( $heroimage_m ) :
        echo wp_get_attachment_image( $heroimage_m, 'full', false, array( 'class' => 'w-full object-cover relative md:hidden' ) );
    endif;
    ?>
    <div class="theme-container theme-grid">
        <div class="col-span-2 md:col-span-3 xl:col-span-6 pt-5 md:pt-0 mb-12">
            <?php do_action( 'breadcrumbs' ); ?>
            <h1 class="title-secondary text-darker-blue-shade mb-14 mt-7 !text-[40px]"><?php echo get_field( 'intro_title' ); ?></h1>
            <p class="title-secondary !font-normal max-w-[620px] mb-7 md:mb-16"><?php echo get_field( 'intro_subtitle' ); ?></p>
            <?php
				$button_1 = get_field( 'intro_button_1' );
				if ( $button_1 ) :
					$link_url    = $button_1['url'];
					$link_title  = $button_1['title'];
					$link_target = $button_1['target'] ? $button_1['target'] : '_self';
					?>
					<a class="btn-main btn-main--full-blue mr-5" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
			<?php
				endif;
			?>
            <?php
				$button_2 = get_field( 'intro_button_2' );
				if ( $button_2 ) :
					$link_url    = $button_2['url'];
					$link_title  = $button_2['title'];
					$link_target = $button_2['target'] ? $button_2['target'] : '_self';
					?>
					<a class="btn-main btn-main--empty" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
			<?php
				endif;
			?>
        </div>
    </div>
</section>