<header id="header-main" class="header-main w-full relative z-50" itemscope itemtype="http://schema.org/WebSite">
	<section id="header-wrapper" class="header-wrapper bg-transparent">
		<nav class="navbar relative theme-container" role="navigation" aria-label="<?php esc_attr_e( 'Main menu', 'stricker' ); ?>">
			<div class="grid grid-cols-3 py-6 md:py-8 xl:py-9">
				<div class="col-span-1 flex justify-start items-center z-50">
					<div class="site-branding text-white">
						<a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url" class="navbar-brand custom-logo-link max-w-[238px]"><?php do_action( 'theme_logo' ); ?></a>
					</div>
				</div>

				<div class="col-span-2 flex justify-end items-center gap-x-8">
					<!-- Burger Menu Button for Mobile -->
					<button id="burger-menu-toggle" class="lg:hidden focus:outline-none text-white z-50" aria-label="Open main menu">
						<!-- Icon for burger menu (3 lines) -->
						<svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
						</svg>
					</button>

					<!-- Main Menu -->
					<div id="main-menu-container" class="main-menu-container hidden lg:flex flex-col lg:flex-row lg:items-center absolute  pt-40 lg:pt-0 px-6 lg:px-0 lg:relative top-0 lg:top-0 left-0 lg:left-auto w-full lg:w-auto h-[100vh] lg:h-auto bg-dark-blue-shade lg:bg-transparent z-40 lg:z-auto transition-transform duration-300 ease-in-out">
						<?php
						wp_nav_menu(
							array(
								'theme_location'  => 'main-menu',
								'menu_id'         => 'main-menu',
								'menu_class'      => 'main-menu-top-level flex flex-col lg:flex-row',
								'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'fallback_cb'     => '__return_false',
							)
						);
						?>
					</div>
				</div>
			</div>
		</nav>
	</section>
</header>

<script>
	// Toggle burger menu
	const burgerToggle = document.getElementById('burger-menu-toggle');
	const menuContainer = document.getElementById('main-menu-container');

	burgerToggle.addEventListener('click', () => {
		menuContainer.classList.toggle('hidden');
		menuContainer.classList.toggle('flex');
	});
</script>
