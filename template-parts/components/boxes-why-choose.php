<div class="col-span-2 sm:col-span-3 xl:col-span-3 col-start-1 sm:col-start-1 xl:col-start-1">
    <div class="h-[70px] flex flex-col justify-end">
        <?php
        $featureImg_1 = get_field( 'why_choose_feature_1_icon' );
        if ( $featureImg_1 ) :
            echo wp_get_attachment_image( $featureImg_1, 'full', false, array( 'class' => 'w-[57px] object-cover ' ) );
        endif;
        ?>
    </div>
    <p class="title-smallest !font-medium mb-7 mt-9"><?php the_field( 'why_choose_feature_1_title' ); ?></p>
    <p class="text-body sm:max-w-[247px] min-h-[50px]"><?php the_field( 'why_choose_feature_1_text' ); ?></p>
</div>
<div class="col-span-2 sm:col-span-3 xl:col-span-3 col-start-1 sm:col-start-4 xl:col-start-4 mt-14 lg:mt-0">
    <div class="h-[70px] flex flex-col justify-end">
        <?php
        $featureImg_2 = get_field( 'why_choose_feature_2_icon' );
        if ( $featureImg_2 ) :
            echo wp_get_attachment_image( $featureImg_2, 'full', false, array( 'class' => 'w-[71px] object-cover ' ) );
        endif;
        ?>
    </div>
    <p class="title-smallest !font-medium mb-7 mt-9"><?php the_field( 'why_choose_feature_2_title' ); ?></p>
    <p class="text-body sm:max-w-[247px] min-h-[50px]"><?php the_field( 'why_choose_feature_2_text' ); ?></p>
</div>
<div class="col-span-2 sm:col-span-3 xl:col-span-3 col-start-1 sm:col-start-1 xl:col-start-7 mt-14 lg:mt-0">
    <div class="h-[70px] flex flex-col justify-end">
        <?php
        $featureImg_3 = get_field( 'why_choose_feature_3_icon' );
        if ( $featureImg_3 ) :
            echo wp_get_attachment_image( $featureImg_3, 'full', false, array( 'class' => 'w-[65px] object-cover ' ) );
        endif;
        ?>
    </div>
    <p class="title-smallest !font-medium mb-7 mt-9"><?php the_field( 'why_choose_feature_3_title' ); ?></p>
    <p class="text-body sm:max-w-[247px] min-h-[50px]"><?php the_field( 'why_choose_feature_3_text' ); ?></p>
</div>
<div class="col-span-2 sm:col-span-3 xl:col-span-3 col-start-1 sm:col-start-4 xl:col-start-10 mt-14 lg:mt-0">
    <div class="h-[70px] flex flex-col justify-end">
        <?php
        $featureImg_4 = get_field( 'why_choose_feature_4_icon' );
        if ( $featureImg_4 ) :
            echo wp_get_attachment_image( $featureImg_4, 'full', false, array( 'class' => 'w-[65px] object-cover ' ) );
        endif;
        ?>
    </div>
    <p class="title-smallest !font-medium mb-7 mt-9"><?php the_field( 'why_choose_feature_4_title' ); ?></p>
    <p class="text-body sm:max-w-[247px] min-h-[50px]"><?php the_field( 'why_choose_feature_4_text' ); ?></p>
</div>