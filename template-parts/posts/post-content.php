<section class="section-post-content bg-blue-shade-5 pt-8 md:pt-10 xl:pt-7 pb-10 md:pb-5">
	<div class="theme-container theme-grid">
		<div class="col-span-2 md:col-span-6 xl:col-span-8">
			<h1 class="font-sans text-[40px] leading-[45px] font-bold pb-5"><?php the_title(); ?></h1>
			<p class="text-body !font-bold pb-7"><?php the_field( 'info_model' ); ?></p>
			<p class="pb-9 max-w-[435px]">
			<?php
			if( have_rows('info_features') ):
				while( have_rows('info_features') ) : the_row(); ?>
					<span class="text-body"><?php the_sub_field( 'name' ); ?></span>
					<span>
						<svg xmlns="http://www.w3.org/2000/svg" width="4" height="4" viewBox="0 0 4 4" fill="none" style="display: inline-block;">
							<circle cx="2" cy="2" r="2" fill="#ABAAAA"/>
						</svg>
					</span>
				<?php endwhile;
			endif; ?>
			</p>
			<div class="block xl:hidden">
				<h4 class="title-pre mb-5"><?php esc_html_e( 'Preis', 'fischer' ); ?></h4>
				<h2 class="font-sans text-[40px] leading-[45px] font-bold text-orange-shade mb-8"><?php the_field( 'price' ); ?></h2>
				<a href="#" class="btn-main btn-main--full-blue w-full"><?php esc_html_e( 'Kontaktieren Sie uns', 'fischer' ); ?></a>
				<a class="btn-main btn-main--transparent max-w-[210px] mx-auto !block mt-4 mb-5" href="/kontakt/"><?php esc_html_e( 'zu allen Fahrzeugen', 'fischer' ); ?></a>
			</div>
			<div class="table-car-info">
				<div class="table-container">
					<?php
					$table_car = get_field( 'info_car_data' );

					if ( ! empty ( $table_car ) ) {
						echo '<table border="0">';
							if ( ! empty( $table_car['caption'] ) ) {
								echo '<caption>' . $table_car['caption'] . '</caption>';
							}
							if ( ! empty( $table_car['header'] ) ) {
								echo '<thead>';
									echo '<tr>';
										foreach ( $table_car['header'] as $th ) {
											echo '<th>';
												echo $th['c'];
											echo '</th>';
										}
									echo '</tr>';
								echo '</thead>';
							}
							echo '<tbody>';
							foreach ( $table_car['body'] as $tr ) {
								echo '<tr>';
								$header_index = 0; // Track which header corresponds to the current column
								foreach ( $tr as $td ) {
									$header = $table_car['header'][$header_index]['c'] ?? ''; // Get the header text
									echo '<td data-label="' . esc_attr( $header ) . '">';
										echo $td['c'];
									echo '</td>';
									$header_index++;
								}
								echo '</tr>';
							}
							echo '</tbody>';

						echo '</table>';
					}
					?>
				</div>
			</div>

			<div class="pt-14 pb-9 border-b border-[#E1E1E1]">
				<h2 class="font-sans font-medium text-[26px] leading-[30px]"><?php the_field( 'specs_title' ); ?></h2>
			</div>
			<div class="pb-16 border-b border-[#E1E1E1]">
				<?php if( have_rows('specs_specifications') ): ?>
					<div class="specs-accordion">
						<?php $first_item = true; // Track the first item ?>
						<?php while( have_rows('specs_specifications') ): the_row(); 
							$question = get_sub_field('title');
							$answer = get_sub_field('list');
						?>
							<div class="specs-item">
								<button class="specs-title <?php echo $first_item ? '' : 'q-closed'; ?> w-full text-left pt-10 pb-4 px-0 title-smallest !font-medium transition outline-none relative">
									<?php echo esc_html($question); ?>
									<span class="icon-plus float-right absolute lg:relative right-2 top-1/2 -translate-y-1/2 lg:transform-none text-[30px]">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/<?php echo $first_item ? 'arrow-up-sign.svg' : 'arrow-down-sign.svg'; ?>" alt="" title="" />
									</span>
								</button>
								<div class="specs-text <?php echo $first_item ? 'open' : 'faq-closed'; ?> px-0 text-body" style="<?php echo $first_item ? 'max-height: fit-content;' : ''; ?>">
									<span class="inline-block pb-10 pr-5"><?php echo wp_kses_post($answer); ?></span>
								</div>
							</div>
							<?php $first_item = false; // Only the first item should start open ?>
						<?php endwhile; ?>
					</div>

				<?php else: ?>
					<p class="text-body">No specifications available at the moment.</p>
				<?php endif; ?>
			</div>
			<div class="pt-14 pb-20 border-b border-[#E1E1E1] max-w-[800px]">
				<h2 class="font-sans font-medium text-[26px] leading-[30px] pb-10"><?php the_field( 'services_title' ); ?></h2>
				<p class="text-body"><?php the_field( 'services_text' ); ?></p>
			</div>
			<div class="pt-14 pb-20 border-b border-[#E1E1E1] max-w-[800px]">
				<h2 class="font-sans font-medium text-[26px] leading-[30px] pb-8"><?php the_field( 'vfas_title' ); ?></h2>
				<p class="font-sans font-medium text-[18px] leading-[32px] pb-8"><?php the_field( 'vfas_subtitle' ); ?></p>
				<?php
				if( have_rows('vfas_list') ):
					while( have_rows('vfas_list') ) : the_row(); ?>
						<p class="text-body flex items-center mb-5"><span class="mr-3"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/list-arrow-blue.svg" alt="List Arrow" title="List Arrow" /></span><?php echo get_sub_field( 'item' ); ?></p>
					<?php endwhile;
				endif; ?>
			</div>
			<div class="pt-14 pb-20 border-b border-[#E1E1E1]">
			<p class="font-sans text-[13px] leading-[26px] max-w-[570px]"><span class="font-bold"><?php esc_html_e( 'Hinweis: ', 'fischer' ); ?></span><?php the_field( 'notice_text' ); ?></p>	
			</div>
		</div>
		<div class="col-span-2 md:col-span-6 xl:col-span-4">
			<div id="sticky-sidebar" class="sticky-content">
				<?php get_template_part( 'template-parts/posts/post-sidebar' ); ?>
			</div>
		</div>
	</div>
</section>
