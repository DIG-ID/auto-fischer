<footer class="footer-main overflow-hidden">
		<div class="footer-top-bar bg-blue-shade">
				<div class="theme-container theme-grid py-[3.25rem]">
						<div class="col-span-2 md:col-span-3 xl:col-span-6">
								<p class="title-smaller text-white !font-normal mb-6 md:mb-0 max-w-[260px] md:max-w-[300px] lg:max-w-none"><?php the_field( 'footer_contact_text', 'option' ); ?></p>
						</div>
						<div class="col-span-2 md:col-span-3 xl:col-span-3 md:text-right col-start-1 md:col-start-4 xl:col-start-10">
							<a href="tel:<?php echo esc_attr( preg_replace( '/[^\d+]/', '', get_field( 'general_phone_number', 'option' ) ) ); ?>" class="title-smaller text-white !font-normal hover:border-b-2 hover:border-white">
								<?php the_field( 'general_phone_number', 'option' ); ?>
							</a>
						</div>
				</div>
		</div>
		<div class="footer-content bg-dark-blue-shade">
				<div class="theme-container theme-grid pt-14 xl:pt-36 pb-10 xl:pb-32">
						<div class="col-span-2 md:col-span-6 xl:col-span-4 mb-16 xl:mb-0">
								<a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url" class="navbar-brand custom-logo-link max-w-[238px]"><?php do_action( 'theme_logo' ); ?></a>
						</div>
						<div class="col-span-1 md:col-span-3 xl:col-span-2 col-start-1 md:col-start-1 xl:col-start-5">
								<h4 class="title-smallest !font-medium text-white mb-7"><?php esc_html_e( 'Adresse', 'auto-fischer' ) ?></h4>
								<p class="text-body text-white !leading-[35px]"><?php the_field( 'general_address', 'option' ); ?></p>
						</div>
						<div class="copy-menu col-span-1 md:col-span-3 xl:col-span-1 col-start-2 md:col-start-4 xl:col-start-7">
								<h4 class="title-smallest !font-medium text-white mb-7"><?php esc_html_e( 'Seiten', 'auto-fischer' ) ?></h4>
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
						<div class="copy-menu col-span-1 md:col-span-6 xl:col-span-2 col-start-2 md:col-start-1 xl:col-start-8 md:pt-[53px] hidden xl:block">
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
						<div class="copy-menu col-span-2 md:col-span-6 xl:col-span-2 col-start-1 md:col-start-1 xl:col-start-11 mt-14 xl:mt-0">
								<h4 class="title-smallest !font-medium text-white mb-7"><?php esc_html_e( 'Folgen Sie uns auf', 'auto-fischer' ) ?></h4>
								<?php do_action( 'socials' ); ?>
						</div>
				</div>
		</div>
		<div class="footer-copyright bg-dark-blue-shade">
				<div class="theme-container theme-grid py-8">
						<div class="col-span-2 md:col-span-6 xl:col-span-6 order-2 md:order-1 pl-2 md:pl-0 mt-1 md:mt-0">
								<p class="text-body text-white"><?php esc_html_e( '© 2024 auto-fischer.ch All rights reserved.', 'auto-fischer' ) ?>
						</div>
						<div class="copy-menu col-span-2 md:col-span-6 xl:col-span-3 col-start-1 md:col-start-1 xl:col-start-10 order-1 md:order-2">
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
		<button id="scrollToTop" class="bg-white fixed right-8 bottom-8 border border-darker-blue-shade py-[0.45rem] px-[1.55rem] rounded-xl z-10 invisible opacity-0 translate-y-16">
			<span class="block -rotate-90">></span>
		</button>
</footer>
