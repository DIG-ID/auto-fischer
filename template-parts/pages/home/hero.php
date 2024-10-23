<section class="section-hero bg-light-blue-shade pb-[140px] w-full absolute top-0 left-0 overflow-hidden">
    <?php
    $heroimage = get_field( 'intro_image' );
    if ( $heroimage ) :
        echo wp_get_attachment_image( $heroimage, 'full', false, array( 'class' => 'w-1/2 object-cover float-right' ) );
    endif;
    ?>
</section>