<section class="section-contact bg-white py-32">
	<div class="bg-dark-blue-shade rounded-2xl text-white flex justify-center items-center px-5 md:px-10 xl:px-0 py-16 md:py-32 mx-6 md:mx-12 xl:mx-24">
		<div class="theme-container">
			<div class="theme-grid">

				<div class="col-span-2 md:col-span-6 xl:col-span-5 mb-8 md:mb-16 xl:mb-0">
					<h2 class="title-secondary text-light-blue-shade"><?php the_field( 'contact_title' ); ?></h2>
					<p class="text-body text-light-blue-shade my-10"><?php the_field( 'contact_text' ); ?></p>
					<div class="">
						<?php
						$button_1 = get_field( 'contact_button_1' );
						if ( $button_1 ) :
							$link_url    = $button_1['url'];
							$link_title  = $button_1['title'];
							$link_target = $button_1['target'] ? $button_1['target'] : '_self';
							?>
							<a class="btn-main btn-main--full-orange mr-1 md:mr-5" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
							<?php
						endif;
						?>
						<?php
						$button_2 = get_field( 'contact_button_2' );
						if ( $button_2 ) :
							$link_url    = $button_2['url'];
							$link_title  = $button_2['title'];
							$link_target = $button_2['target'] ? $button_2['target'] : '_self';
							?>
							<a class="btn-main btn-main--full-blue mt-3 sm:mt-0" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
							<?php
						endif;
						?>
					</div>
				</div>


				<div class="col-span-2 md:col-span-6 xl:col-span-5 xl:col-start-7">
					<div class="border border-white rounded-2xl p-10 flex flex-col gap-y-6">
							<h3 class="font-sans font-medium text-xl text-orange-shade"><?php the_field( 'contact_schedule_title' ); ?></h3>
							<?php
							if ( have_rows( 'contact_schedule_schedule' ) ) :
								?><ul class="space-y-6 text-body text-light-blue-shade"><?php
								while ( have_rows( 'contact_schedule_schedule' ) ) :
									the_row();
									?>
									<li class="border-b border-white pb-6 flex flex-col md:flex-row justify-between"><span class="text-[#C4C4C4]"><?php the_sub_field( 'days' ); ?></span>  <span><?php the_sub_field( 'details' ); ?></span></li>
									<?php
								endwhile;
								?></ul><?php
							endif;
							?>
							
							<h3 class="font-sans font-medium text-xl text-orange-shade"><?php the_field( 'contact_telephone_title' ); ?></h3>
							<?php $telephone = get_field( 'contact_telephone_number' ); ?>
							<a class="text-body text-light-blue-shade" href="tel:<?php echo esc_attr( $telephone ); ?>"><?php echo esc_html( $telephone ); ?></a>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>