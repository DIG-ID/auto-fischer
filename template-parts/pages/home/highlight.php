<section class="section-highlight relative overflow-hidden max-h-[94vh] mt-40 hidden">
    <?php
    $args = array(
        'post_type'      => 'unser-highlight',
        'post_status'    => 'published',
        'order'          => 'ASC',
        'orderby'        => 'date',
        'posts_per_page' => -1,
    );
    $highlight_query = new WP_Query( $args ); ?>
    <div class="highlights-swiper">
        <div class="swiper-wrapper">
            
        <?php
            if ( $highlight_query->have_posts() ) :
                while ( $highlight_query->have_posts() ) :
                    $highlight_query->the_post();
                    
                    // Get featured image
                    $highlightImg = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                    ?>
                    <div class="swiper-slide relative">
                        <!-- Background image -->
                        <div class="relative inset-0">
                            <img src="<?php echo $highlightImg; ?>" alt="" class="w-full h-full object-cover">
                        </div>
                        <!-- Content -->
                        <div class="theme-container theme-grid absolute top-0 left-1/2 -translate-x-1/2 pt-28 pb-[60px] h-full">
                            <div class="col-span-2 md:col-span-6 xl:col-span-12 flex flex-col text-center justify-end items-center relative">
                                <h2 class="title-secondary text-light-blue-shade"><?php the_title(); ?></h2>
                                <p class="text-body text-light-blue-shade pt-5 pb-7"><?php echo get_field( 'info_model' ); ?></p>
                                <div class="flex items-center justify-center gap-4 relative">
                                    <!-- Previous Arrow -->
                                    <div class="swiper-button-prev cursor-pointer"></div>
                                    <!-- Button -->
                                    <a class="btn-main btn-main--full-blue-darkbg max-w-[210px]" href="<?php the_permalink(); ?>">
                                        <?php _e( 'Read More', 'textdomain' ); ?>
                                    </a>
                                    <!-- Next Arrow -->
                                    <div class="swiper-button-next cursor-pointer"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
        <!-- Thumbnails -->
        <div class="swiper swiper-thumbnails absolute top-[74px] right-0 flex gap-2">
            <div class="swiper-wrapper justify-end">
                <?php
                if ( $highlight_query->have_posts() ) :
                    while ( $highlight_query->have_posts() ) :
                        $highlight_query->the_post();
                        ?>
                        <div class="swiper-slide w-auto px-4 border-b-2 border-blue-shade">
                            <span class="swiper-thumbnail-title text-white inline-block">
                                <?php the_title(); ?>
                            </span>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </div>
</section>
