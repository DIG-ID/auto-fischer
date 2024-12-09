<section class="section-highlight relative overflow-hidden mt-40">
    <?php
    $args = array(
        'post_type'      => 'unser-highlight',
        'post_status'    => 'publish',
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
                        <div class="relative inset-0 z-10">
                            <img src="<?php echo $highlightImg; ?>" alt="" class="w-full h-full object-cover min-h-[600px] md:min-h-[728px] min-w-[430px] md:min-w-[743px] lg:w-[1920px] lg:h-[850px] max-h-[94vh]">
                        </div>
                        <!-- Content -->
                        <div class="theme-container theme-grid absolute top-0 left-1/2 -translate-x-1/2 pt-28 pb-[60px] h-full z-20">
                            <div class="col-span-2 md:col-span-6 xl:col-span-12 flex flex-col text-center justify-end items-center relative">
                                <h2 class="title-secondary text-light-blue-shade"><?php esc_html_e( 'Unsere Highglights' ); ?></h2>
                                <p class="text-body text-light-blue-shade pt-5 pb-7"><?php esc_html_e( 'Entdecken Sie unsere aktuellen Highlight-Fahrzeuge.' ); ?></p>
                                <div class="flex items-center justify-center gap-4 relative">
                                    <!-- Previous Arrow -->
                                    <div class="swiper-button-prev cursor-pointer"></div>
                                    <!-- Button -->
                                    <a class="btn-main btn-main--full-blue-darkbg max-w-[210px]" href="<?php the_permalink(); ?>">
                                        <?php _e( 'Mehr erfahren', 'textdomain' ); ?>
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
        <div class="absolute top-[74px] right-0 flex gap-2 w-full">
            <div class="swiper swiper-thumbnails">
                <div class="swiper-wrapper">
                    <?php
                    if ( $highlight_query->have_posts() ) :
                        while ( $highlight_query->have_posts() ) :
                            $highlight_query->the_post();
                            ?>
                            <div class="swiper-slide w-auto px-1 border-b-2 pb-6 border-blue-shade cursor-pointer">
                                <span class="swiper-thumbnail-title text-white inline-block">
                                    <?php the_title(); ?>
                                </span>
                                <span class="font-sans text-[15px] xl:text-[20px] font-light text-white hidden xl:inline-block">
                                    <?php the_field( 'info_model' ); ?>
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
    </div>
</section>
