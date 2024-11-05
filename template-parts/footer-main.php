<footer class="footer-main overflow-hidden">
    <div class="footer-top-bar bg-blue-shade">
        <div class="theme-container theme-grid py-[3.25rem]">
            <div class="col-span-2 md:col-span-3 xl:col-span-6">
                <p class="title-smaller text-white !font-normal"><?php echo get_field( 'footer_contact_text', 'option' ); ?></p>
            </div>
            <div class="col-span-2 md:col-span-3 xl:col-span-3 text-right col-start-1 md:col-start-4 xl:col-start-10">
                <a href="tel:<?php echo get_field( 'general_phone_number', 'option' ); ?>" class="title-smaller text-white !font-normal hover:border-b-2 hover:border-white"><?php echo get_field( 'general_phone_number', 'option' ); ?></a>
            </div>
        </div>
    </div>
    <div class="footer-content bg-dark-blue-shade">
        <div class="theme-container theme-grid pt-36 pb-32">
            <div class="col-span-2 md:col-span-6 xl:col-span-4">
                <a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url" class="navbar-brand custom-logo-link max-w-[238px]"><?php do_action( 'theme_logo' ); ?></a>
            </div>
            <div class="col-span-2 md:col-span-3 xl:col-span-2 col-start-1 md:col-start-1 xl:col-start-5">
                <h4 class="title-smallest !font-medium text-white mb-7"><?php esc_html_e( 'Adresse', 'fischer' ) ?></h4>
                <p class="text-body text-white !leading-[35px]"><?php echo get_field( 'general_address', 'option' ); ?></p>
            </div>
            <div class="copy-menu col-span-2 md:col-span-6 xl:col-span-1 col-start-1 md:col-start-1 xl:col-start-7">
                <h4 class="title-smallest !font-medium text-white mb-7"><?php esc_html_e( 'Seiten', 'fischer' ) ?></h4>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer-menu-left',
						'container'      => false,
						'menu_class'     => 'footer-menu-nav',
						'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'fallback_cb'    => '__return_false',
					)
				);
				?>
			</div>
            <div class="copy-menu col-span-2 md:col-span-6 xl:col-span-2 col-start-1 md:col-start-1 xl:col-start-8 pt-[53px]">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer-menu-right',
						'container'      => false,
						'menu_class'     => 'footer-menu-nav',
						'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'fallback_cb'    => '__return_false',
					)
				);
				?>
			</div>
            <div class="copy-menu col-span-2 md:col-span-6 xl:col-span-2 col-start-1 md:col-start-1 xl:col-start-11">
                <h4 class="title-smallest !font-medium text-white mb-7"><?php esc_html_e( 'Folgen Sie uns auf', 'fischer' ) ?></h4>
								<?php do_action( 'socials' ); ?>
            </div>
        </div>
    </div>
    <div class="footer-copyright bg-dark-blue-shade">
        <div class="theme-container theme-grid py-8">
            <div class="col-span-2 md:col-span-6 xl:col-span-6">
                <p class="text-body text-white"><?php esc_html_e( '© 2024 auto-fischer.ch All rights reserved.', 'fischer' ) ?>
            </div>
            <div class="copy-menu col-span-2 md:col-span-6 xl:col-span-3 col-start-1 md:col-start-1 xl:col-start-10">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'copyright-menu',
						'container'      => false,
						'menu_class'     => 'copy-menu-nav',
						'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'fallback_cb'    => '__return_false',
					)
				);
				?>
			</div>
        </div>
    </div>
</footer>
