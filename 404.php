<?php
get_header();
do_action( 'before_main_content' );
?>

<section class="section-intro pt-20">
	<div class="theme-container theme-grid">
		<div class="col-span-2 md:col-span-6 xl:col-span-12">
			<?php do_action( 'breadcrumbs' ); ?>
		</div>
	</div>
</section>

<section class="section-error-notfound py-12 md:py-16 xl:pt-16 xl:pb-32">
	<div class="theme-container theme-grid">
		<div class="col-span-2 md:col-span-6 xl:col-span-8 xl:col-start-3 flex flex-col items-center text-center">
			<img src="<?php echo get_template_directory_uri() . '/assets/images/404.svg'; ?>" alt="404 illustration" class="max-w-[390px] md:max-w-[447px] xl:max-w-full w-full h-auto object-cover mb-16">
			<h1 class="title-secondary mb-6"><?php esc_html_e( 'Huch! Sieht aus, als hätten Sie sich verfahren.', 'auto-fischer' ) ?></h1>
			<p class="text-body max-w-md mb-6"><?php printf( esc_html__( 'Die von Ihnen gesuchte Seite ist nicht verfügbar. %s Versuchen Sie, die Suche zu wiederholen, oder verwenden Sie den nachfolgenden Button.', 'auto-fischer' ), '<br>' ); ?></p>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-main btn-main--empty"><?php esc_html_e( 'Zurück zur Startseite', 'auto-fischer' ); ?></a>
		</div>
	</div>
</section>
<?php
do_action( 'after_main_content' );
get_footer();
