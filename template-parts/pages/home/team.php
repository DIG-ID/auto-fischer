<section class="section-team bg-white relative pt-40 pb-40 overflow-hidden">
        <div class="theme-container theme-grid">
            <div class="col-span-2 md:col-span-3 xl:col-span-5">
                <p class="title-secondary text-darker-blue-shade mb-10"><?php echo get_field( 'team_title' ); ?></p>
            </div>
            <div class="col-span-2 md:col-span-3 xl:col-span-3 col-start-1 md:col-start-4 xl:col-start-10 text-right">
                <?php
                $button_team = get_field( 'team_call_to_action' );
                if ( $button_team ) :
                    $link_url    = $button_team['url'];
                    $link_title  = $button_team['title'];
                    $link_target = $button_team['target'] ? $button_team['target'] : '_self';
                    ?>
                    <a class="btn-main btn-main--transparent max-w-[210px]" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                <?php
                    endif;
                ?>
            </div>
        </div>
        <div class="theme-container overflow-visible">
            <?php if (have_rows('team_members')) : ?>
                <div class="team-swiper swiper-container">
                    <div class="swiper-wrapper">
                        <?php while (have_rows('team_members')) : the_row(); ?>
                            <?php
                            // Get the subfields
                            $picture_id = get_sub_field('picture');
                            $name = get_sub_field('name');
                            $role = get_sub_field('roles');
                            $picture_url = wp_get_attachment_image_url($picture_id, 'full');
                            ?>
                            <div class="swiper-slide">
                                <div class="team-member-card">
                                <?php if ($picture_id) : ?>
                                    <!-- Display image if it exists -->
                                    <img src="<?php echo esc_url($picture_url); ?>" alt="<?php echo esc_attr($name); ?>" class="w-full h-auto object-cover rounded-xl">
                                <?php else : ?>
                                    <!-- Placeholder with background color if no image -->
                                    <div class="w-full h-[415px] bg-dark-blue-shade flex items-center justify-center rounded-xl">
                                        <span class="text-white text-body">No Picture</span>
                                    </div>
                                <?php endif; ?>
                                    <div class="mt-7 text-left">
                                        <h3 class="title-smallest mb-3"><?php echo esc_html($name); ?></h3>
                                        <p class="text-body"><?php echo esc_html($role); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
</section>