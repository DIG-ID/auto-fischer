<section class="section-intro min-h-[99vh] bg-transparent pt-20 pb-[140px] relative overflow-hidden">
    <div class="theme-container theme-grid">
        <div class="col-span-2 md:col-span-3 xl:col-span-6 mb-12">
            <?php do_action( 'breadcrumbs' ); ?>
            <h1 class="title-secondary text-darker-blue-shade mb-14 mt-7"><?php echo get_field( 'intro_title' ); ?></h1>
            <p class="title-secondary !font-normal max-w-[620px] mb-16"><?php echo get_field( 'intro_subtitle' ); ?></p>
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