<section class="section-intro bg-transparent pt-20 relative overflow-hidden">
	<div class="theme-container theme-grid">
		<div class="col-span-2 md:col-span-6 xl:col-span-12">
			<?php do_action( 'breadcrumbs' ); ?>
			<h1 class="title-secondary mt-7"><?php the_title(); ?></h1>
		</div>
	</div>
	<?php
	if ( get_field( 'intro_subtitle' ) || get_field( 'intro_description' ) ) :
		?>
		<div class="theme-container theme-grid mt-28">
			<div class="col-span-2 md:col-span-3 xl:col-span-5">
				<h2 class="title-secondary !font-normal"><?php the_field( 'intro_subtitle' ); ?></h2>
			</div>
			<div class="col-span-2 md:col-span-3 xl:col-span-4 col-start-1 md:col-start-4 xl:col-start-7">
				<p class="text-body"><?php the_field( 'intro_description' ); ?></p>
			</div>
		</div>
		<?php
	endif;
	?>
</section>
