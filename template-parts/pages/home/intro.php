<section class="section-intro 2xl:min-h-[99vh] bg-light-blue-shade pt-0 md:pt-44 xl:pt-64 pb-12 md:pb-32 xl:pb-[140px] relative overflow-hidden">
    <div class="absolute top-0 right-0 w-3/5 xl:w-1/2 hidden md:block">
        <div class="relative">
        <?php
            $heroimage = get_field( 'intro_image' );
            if ( $heroimage ) :
                echo wp_get_attachment_image( $heroimage, 'full', false, array( 'class' => 'object-cover w-full' ) );
            endif;
        ?>
        <?php 
        $award_logo = get_field('intro_award_logo');
        $award_image = get_field( 'intro_award_image' );
        if ($award_logo && $award_image) :
            echo wp_get_attachment_image( $award_image, 'full', false, array( 'class' => 'max-w-[125px] lg:max-w-[200px] max-h-[204px] absolute -bottom-16 lg:-bottom-24 right-12 lg:right-16' ) );
        endif;
        ?>
        </div>
    </div>
    <?php
    $heroimage_m = get_field( 'intro_image_mobile' );
    if ( $heroimage_m ) :
        echo wp_get_attachment_image( $heroimage_m, 'full', false, array( 'class' => 'w-full object-cover relative md:hidden' ) );
    endif;
    ?>
    <?php 
    $award_logo = get_field('intro_award_logo');
    $award_image = get_field( 'intro_award_image' );
    if ($award_logo && $award_image) :
        echo wp_get_attachment_image( $award_image, 'full', false, array( 'class' => 'max-w-[100px] max-h-[104px] absolute block md:hidden top-6  right-5' ) );
    endif;
    ?>
    
    <div class="theme-container theme-grid relative z-30">
        <div class="col-span-2 md:col-span-5 xl:col-span-6 mb-12">
            <p class="title-pre text-darker-blue-shade mt-5 md:mt-0"><?php the_field( 'intro_pre_title' ); ?></p>
            <h1 class="title-main text-darker-blue-shade mb-7 md:mb-14 mt-7 max-w-none md:max-w-96 xl:max-w-none"><?php the_field( 'intro_title' ); ?></h1>
            <?php
				$button_1 = get_field( 'intro_button_1' );
				if ( $button_1 ) :
					$link_url    = $button_1['url'];
					$link_title  = $button_1['title'];
					$link_target = $button_1['target'] ? $button_1['target'] : '_self';
					?>
					<a class="btn-main btn-main--full-blue mr-1 md:mr-5" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
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
					<a class="btn-main btn-main--empty mt-3 sm:mt-0" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
			<?php
				endif;
			?>
        </div>
        <div class="col-span-2 md:col-span-3 xl:col-span-3 col-start-1 md:col-start-1 xl:col-start-1 bg-white px-9 py-8 mb-4 md:mb-0 rounded-2xl">
            <h3 class="title-smallest mb-5"><?php the_field( 'intro_box_1_title' ); ?></h3>
            <p class="text-body"><?php the_field( 'intro_box_1_text' ); ?></p>
        </div>
        <div class="col-span-2 md:col-span-3 xl:col-span-3 col-start-1 md:col-start-4 xl:col-start-4 bg-white px-9 py-8 rounded-2xl">
            <h3 class="title-smallest mb-5"><?php the_field( 'intro_box_2_title' ); ?></h3>
            <p class="text-body"><?php the_field( 'intro_box_2_text' ); ?></p>
        </div>
    </div>
</section>