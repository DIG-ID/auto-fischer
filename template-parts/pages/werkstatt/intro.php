<section class="section-intro py-16">
	<div class="theme-container">
		<div class="theme-grid">
			<div class="col-span-2 md:col-span-6">
				<h2 class="title-secondary !xl:text-[40px] !xl:leading-none mb-4"><?php the_field( 'intro_title' ); ?></h2>
				<p class="text-body mb-8 md:mb-16 xl:mb-0"><?php the_field( 'intro_text' ); ?></p>
			</div>
			<div class="col-span-2 md:col-span-6 flex md:justify-center md:items-center">
				<?php
				if ( have_rows( 'intro_list' ) ) :
					?><ul class="grid grid-cols-2 gap-5"><?php
					while ( have_rows( 'intro_list' ) ) :
						the_row();
						$sub_value = get_sub_field( 'item' );
						?>
						
							<li class="col-span-2 md:col-span-1 flex md:items-center gap-2">
								<i class=" bg-light-blue-shade min-w-6 min-h-6 flex justify-center items-center rounded-full">
									<svg width="7" height="6" viewBox="0 0 7 6" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M6.79496 1.19589L3.10217 4.88842C2.82872 5.16192 2.38513 5.16192 2.11141 4.88842L0.205169 2.98203C-0.0683898 2.70853 -0.0683898 2.26489 0.205169 1.99133C0.47878 1.71772 0.922334 1.71772 1.19582 1.99123L2.60694 3.40236L5.80415 0.20513C6.07776 -0.0684804 6.52135 -0.0682731 6.79486 0.20513C7.06836 0.478689 7.06836 0.922173 6.79496 1.19589Z" fill="#F48123"/>
									</svg>
								</i>
								<p class="title-smallest !font-medium"><?php echo esc_html( $sub_value ); ?></p>
							</li>
						
						<?php
					endwhile;
					?></ul><?php
				endif;
				?>
			</div>
		</div>
	</div>
</section>