<section class="section-intro bg-transparent pt-36 pb-[140px] relative overflow-hidden">
    <div class="theme-container theme-grid">
        <div class="col-span-2 md:col-span-3 xl:col-span-6 mb-12">
            <p class="title-pre text-darker-blue-shade"><?php echo get_field( 'intro_pre_title' ); ?></p>
            <h1 class="title-main text-darker-blue-shade mb-14"><?php echo get_field( 'intro_title' ); ?></h1>
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
					<a class="btn-main btn-main--empty-blue" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
			<?php
				endif;
			?>
        </div>
        <div class="col-span-2 md:col-span-3 xl:col-span-3 col-start-1 md:col-start-1 xl:col-start-1 bg-white px-9 py-8 rounded-2xl">
            <h3 class="title-smallest mb-5"><?php echo get_field( 'intro_box_1_title' ); ?></h3>
            <p class="text-body"><?php echo get_field( 'intro_box_1_text' ); ?></p>
        </div>
        <div class="col-span-2 md:col-span-3 xl:col-span-3 col-start-1 md:col-start-4 xl:col-start-4 bg-white px-9 py-8 rounded-2xl">
            <h3 class="title-smallest mb-5"><?php echo get_field( 'intro_box_2_title' ); ?></h3>
            <p class="text-body"><?php echo get_field( 'intro_box_2_text' ); ?></p>
        </div>
    </div>
</section>