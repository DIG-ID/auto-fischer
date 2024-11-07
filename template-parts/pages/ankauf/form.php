<section class="section-form pt-10 pb-16 md:pt-20 md:pb-24 xl:pt-20 xl:pb-40 relative overflow-hidden">
    <div class="theme-container">
        <?php 
        $form_shortcode = get_field('form_shortcode'); 
        if ($form_shortcode) {
            echo do_shortcode($form_shortcode); 
        }
        ?>
    </div>
    <div class="hidden flex-wrap gap-4 mt-5"></div>
    <div class="hidden mt-3"></div>
</section>

