<section class="section-intro bg-transparent pt-12 md:pt-20 pb-0 md:pb-32 relative overflow-hidden">
    <div class="theme-container theme-grid mb-20 md:mb-28">
        <div class="col-span-2 md:col-span-6 xl:col-span-12">
            <?php do_action( 'breadcrumbs' ); ?>
            <h1 class="title-secondary mt-7 !text-[40px] !leading-[45px]"><?php echo get_field( 'intro_title' ); ?></h1>
        </div>
    </div>
    <div class="theme-container theme-grid">
        <div class="col-span-2 md:col-span-6 xl:col-span-5">
            <h2 class="title-secondary !font-normal mb-12 md:mb-14 xl:mb-0"><?php echo get_field( 'intro_subtitle' ); ?></h2>
        </div>
        <div class="col-span-2 md:col-span-6 xl:col-span-4 col-start-1 md:col-start-1 xl:col-start-7 max-w-none md:max-w-[440px] xl:max-w-none">
            <p class="text-body mb-4"><?php echo get_field( 'intro_description' ); ?></p>
            <p class="text-body"><span class="block float-left mr-2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/info-outline.svg" alt="info icon" title="Info Icon" /></span class="flex"><span><?php echo get_field( 'intro_warning' ); ?></span></p>
        </div>
    </div>
</section>