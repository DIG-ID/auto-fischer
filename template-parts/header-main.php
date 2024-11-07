<header id="header-main" class="header-main w-full relative z-50" itemscope itemtype="http://schema.org/WebSite">
	<section id="header-wrapper" class="header-wrapper bg-transparent">
		<nav class="navbar relative theme-container" role="navigation" aria-label="<?php esc_attr_e( 'Main menu', 'stricker' ); ?>">
			<div class="grid grid-cols-3 py-6 md:py-8 xl:py-9">
				<div class="col-span-1 flex justify-start items-center z-50">
					<div class="site-branding text-white">
						<a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url" class="navbar-brand custom-logo-link"><?php do_action( 'theme_logo' ); ?></a>
					</div>
				</div>

				<div class="col-span-2 flex justify-end items-center gap-x-8">
					<!-- Burger Menu Button for Mobile -->
					<button id="burger-menu-toggle" class="lg:hidden focus:outline-none text-black z-50" aria-label="Toggle main menu">
						<!-- Icon for burger menu (3 equal bars) -->
						<svg id="burger-icon" class="w-[22px] h-[20px] transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 22 20" fill="none">
							<rect width="22" height="2" fill="#001629"/>
							<rect y="9" width="22" height="2" fill="#001629"/>
							<rect y="18" width="22" height="2" fill="#001629"/>
						</svg>
						<!-- Icon for "X" (hidden by default) -->
						<svg id="close-icon" class="w-[18px] h-[18px] hidden transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
							<rect x="0.414062" y="16" width="22" height="2" transform="rotate(-45 0.414062 16)" fill="white"/>
							<rect x="1.41431" width="22" height="2" transform="rotate(45 1.41431 0)" fill="white"/>
						</svg>
					</button>

					<!-- Main Menu -->
					<div id="main-menu-container" class="main-menu-container opacity-0 lg:opacity-100 lg:flex flex-col xl:flex-row xl:items-center absolute pt-40 lg:pt-0 px-6 lg:px-0 lg:relative top-0 lg:top-0 left-0 lg:left-auto w-full lg:w-auto h-[100vh] lg:h-auto bg-dark-blue-shade lg:bg-transparent z-40 lg:z-auto transition-transform duration-300 ease-in-out transform -translate-y-full lg:translate-y-0">
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
						<a href="/kontakt/" class="block lg:hidden w-full btn-main btn-main--transparent-bluebg mt-11"><?php echo esc_html( 'Kontaktieren Sie uns' ); ?></a>
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
	const burgerIcon = document.getElementById('burger-icon');
	const closeIcon = document.getElementById('close-icon');

	burgerToggle.addEventListener('click', () => {
	// Toggle menu visibility with transition
	menuContainer.classList.toggle('open'); // Apply the open class for animation
	
	// Toggle icons
	burgerIcon.classList.toggle('hidden');
	closeIcon.classList.toggle('hidden');
	});

</script>
