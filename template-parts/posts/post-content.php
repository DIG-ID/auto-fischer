<section class="section-post-content bg-blue-shade-5 lg:pt-28 lg:pb-28 pt-10">
	<div class="theme-container">
		<div class="theme-grid">
			<div class="col-span-2 lg:col-span-6 lg:col-start-2">
				<h1 class="text-title text-blue-shade-5 mb-6"><?php the_title(); ?></h1>
				<div class="section-post-content-wrapper invisible fade-in--noscroll">
					<?php the_content(); ?>
				</div>
			</div>
			<div class="col-span-2 lg:col-span-4 lg:invisible lg:hidden">
				<?php get_template_part( 'template-parts/posts/post-related' ); ?>
			</div>
		</div>
	</div>
</section>
