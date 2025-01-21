<section class="section-faq pt-3 pb-20 md:pt-20 md:pb-40 relative overflow-hidden">
    <div class="theme-container theme-grid">

        <div class="col-span-2 md:col-span-6 xl:col-span-8 xl:col-start-3">
            <h2 class="title-secondary text-center mb-12"><?php the_field( 'faq_title' ); ?></h2>
        </div>
        <div class="col-span-2 md:col-span-6 xl:col-span-8 xl:col-start-3">
            <?php if( have_rows('faq_list') ): ?>
                <div class="faq-accordion">
                    <?php while( have_rows('faq_list') ): the_row(); 
                        $question = get_sub_field('question');
                        $answer = get_sub_field('answer');
                    ?>
                        <div class="faq-item border-b border-[#E1E1E1]">
                            <button class="faq-question q-closed w-full text-left pt-5 xl:pt-10 pb-4 px-0 title-smallest !font-medium transition rounded-t-2xl outline-none relative">
                                <?php echo esc_html($question); ?>
                                <span class="icon-plus float-right absolute lg:relative right-2 top-1/2 -translate-y-1/2 lg:transform-none text-[30px]">+</span>
                            </button>
                            <div class="faq-answer <?php echo !is_admin() ? 'faq-closed' : ''; ?> pl-0 pr-5 text-body rounded-b-2xl">
                                <span class="inline-block pb-4 pr-5"><?php echo wp_kses_post($answer); ?></span>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p>No FAQs available at the moment.</p>
            <?php endif; ?>
        </div>

    </div>
</section>
