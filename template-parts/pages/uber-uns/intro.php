<section class="section-intro bg-transparent pt-12 md:pt-20 pb-20 md:pb-32 relative overflow-hidden">
	<div class="theme-container theme-grid mb-20 md:mb-28">
		<div class="col-span-2 md:col-span-6 xl:col-span-12">
			<?php do_action( 'breadcrumbs' ); ?>
			<h1 class="title-secondary mt-7"><?php the_field( 'intro_title' ); ?></h1>
		</div>
	</div>
	<div class="theme-container theme-grid">
		<div class="col-span-2 md:col-span-3 xl:col-span-5">
			<h2 class="title-secondary !font-normal mb-12 md:mb-0"><?php the_field( 'intro_subtitle' ); ?></h2>
		</div>
		<div class="col-span-2 md:col-span-3 xl:col-span-4 col-start-1 md:col-start-4 xl:col-start-7">
			<p class="text-body"><?php the_field( 'intro_description' ); ?></p>
		</div>
	</div>
</section>
