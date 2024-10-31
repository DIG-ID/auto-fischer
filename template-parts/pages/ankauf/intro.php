<section class="section-intro bg-transparent pt-20 pb-32 relative overflow-hidden">
    <div class="theme-container theme-grid mb-28">
        <div class="col-span-2 md:col-span-6 xl:col-span-12">
            <?php do_action( 'breadcrumbs' ); ?>
            <h1 class="title-secondary mt-7"><?php echo get_field( 'intro_title' ); ?></h1>
        </div>
    </div>
    <div class="theme-container theme-grid">
        <div class="col-span-2 md:col-span-3 xl:col-span-5">
            <h2 class="title-secondary !font-normal"><?php echo get_field( 'intro_subtitle' ); ?></h2>
        </div>
        <div class="col-span-2 md:col-span-3 xl:col-span-4 col-start-1 md:col-start-4 xl:col-start-7">
            <p class="text-body mb-4"><?php echo get_field( 'intro_description' ); ?></p>
            <p class="text-body"><span class="block float-left mr-2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/info-outline.svg" alt="info icon" title="Info Icon" /></span class="flex"><span><?php echo get_field( 'intro_warning' ); ?></span></p>
        </div>
    </div>
</section>