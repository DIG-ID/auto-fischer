<section class="section-intro bg-transparent pt-36 pb-40 relative overflow-hidden">
    <div class="theme-container theme-grid">
        <div class="col-span-2 md:col-span-6 xl:col-span-12">
            <?php do_action( 'breadcrumbs' ); ?>
            <h1 class="title-secondary"><?php echo get_field( 'intro_title' ); ?></h1>
        </div>
    </div>
    <div class="theme-container theme-grid">
        <div class="col-span-2 md:col-span-3 xl:col-span-5">
            <h2 class="title-secondary !font-normal"><?php echo get_field( 'intro_subtitle' ); ?></h2>
            <p class="text-body"><?php echo get_field( 'intro_description' ); ?></p>
        </div>
    </div>
</section>