<section class="section-why-choose bg-white pt-14 md:pt-24 xl:pt-32 pb-16 md:pb-32 xl:pb-60 relative overflow-hidden">
    <div class="theme-container theme-grid">
        <div class="col-span-2 md:col-span-6 xl:col-span-6 mb-12">
            <h2 class="title-secondary text-darker-blue-shade mb-5 max-w-[80%] md:max-w-none"><?php the_field( 'why_choose_title' ); ?></h2>
            <p class="text-body text-darker-blue-shade"><?php the_field( 'why_choose_description' ); ?></p>
        </div>
        <?php get_template_part( 'template-parts/components/boxes-why-choose' ); ?>
    </div>
</section>