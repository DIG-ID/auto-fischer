<header id="header-main" class="header-main w-full z-50 overflow-hidden" itemscope itemtype="http://schema.org/WebSite">
	<section id="header-wrapper" class="header-wrapper bg-transparent">

		<nav class="navbar relative overflow-hidden theme-container" role="navigation" aria-label="<?php esc_attr_e( 'Main menu', 'stricker' ); ?>">
			
			<div class="grid grid-cols-3 px-6 md:px-8 xl:px-16 py-6 md:py-8 xl:py-10">
				<div class="col-span-1 flex justify-center items-center">
					<div class="site-branding text-white">
						<a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url" class="navbar-brand custom-logo-link"><?php do_action( 'theme_logo' ); ?></a>
					</div>
				</div>
				
				
				<div class="col-span-1 flex justify-end items-center gap-x-8">
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'main-menu',
						'menu_id'         => 'main-menu',
						'container_class' => 'main-menu-container pt-20 md:pt-0',
						'menu_class'      => 'main-menu-top-level',
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'fallback_cb'     => '__return_false',
						'walker'          => '',
					)
				);
				?>
				</div>
			</div>
			
		</nav>

	</section>
</header>
