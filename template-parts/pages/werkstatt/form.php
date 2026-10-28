<section id="form" class="section-form py-32 bg-light-blue-shade">
	<div class="theme-container">
		<div class="theme-grid mb-16">
			<div class="col-span-12">
				<h2 class="title-secondary text-darker-blue-shade mb-5"><?php the_field( 'form_title' ); ?></h2>
				<p class="text-body max-w-[674px]"><?php the_field( 'form_text' ); ?></p>
			</div>
		</div>
		<div class="theme-grid">
			<div class="col-span-12">
				<?php echo do_shortcode( get_field( 'form_shortcode' ) ); ?>
			</div>
		</div>
	</div>
</section>