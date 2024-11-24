<div class="lg:flex lg:flex-col lg:justify-between lg:h-full pt-0 lg:pt-0 pb-10 lg:pb-0">
	<div class="grid grid-cols-2 md:grid-cols-6 xl:grid-cols-4 gap-x-6">
		<div class="col-span-2 md:col-span-6 xl:col-span-3 hidden xl:block">
			<h4 class="title-pre mb-5"><?php esc_html_e( 'Preis', 'fischer' ); ?></h4>
			<h2 class="font-sans text-[40px] leading-[45px] font-bold text-orange-shade mb-8"><?php the_field( 'price' ); ?></h2>
			<a href="#" class="btn-main btn-main--full-blue w-full"><?php esc_html_e( 'Kontaktieren Sie uns', 'fischer' ); ?></a>
			<a class="btn-main btn-main--transparent max-w-[210px] mx-auto !block mt-4 mb-5" href="/kontakt/"><?php esc_html_e( 'zu allen Fahrzeugen', 'fischer' ); ?></a>
		</div>
		<div class="col-span-2 md:col-span-6 xl:col-span-3 border-y border-[#E1E1E1] py-6">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/auto-fischer-logo.svg" alt="" title="" class="max-w-[120px]" />
			<p class="text-body !font-bold pt-[18px] pb-4"><?php esc_html_e( 'Auto Fischer Ettingen GmbH', 'fischer' ); ?></p>
			<p class="text-body"><?php esc_html_e( 'Verkauf / Eintausch / Ankauf / Leasing', 'fischer' ); ?></p>
		</div>
		<div class="col-span-2 md:col-span-6 xl:col-span-3 border-b border-[#E1E1E1] py-6">
			<p class="text-body mb-6"><?php esc_html_e( 'Brühlstrasse 1, 4107 Ettingen', 'fischer' ); ?></p>
			<p class="text-body xl:pl-12"><span class="font-medium"><?php esc_html_e( 'Geschäft', 'fischer' ); ?></span><a href="tel:<?php the_field( 'general_phone_number', 'option' ); ?>"><?php the_field( 'general_phone_number', 'option' ); ?></a></p>
			<p class="text-body mb-7 xl:pl-12"><span class="font-medium"><?php esc_html_e( 'Mail', 'fischer' ); ?></span><a href="mailto:<?php the_field( 'general_email', 'option' ); ?>"><?php the_field( 'general_email', 'option' ); ?></a></p>
			<div class="schedule-sidebar">
				<p class="text-body !font-bold mb-6"><?php esc_html_e( 'Öffnungszeiten', 'fischer' ); ?></p>
				<?php
				$table = get_field( 'general_schedule', 'option' );

				if ( ! empty ( $table ) ) {
					echo '<table border="0">';
						if ( ! empty( $table['caption'] ) ) {
							echo '<caption>' . $table['caption'] . '</caption>';
						}
						if ( ! empty( $table['header'] ) ) {
							echo '<thead>';
								echo '<tr>';
									foreach ( $table['header'] as $th ) {
										echo '<th>';
											echo $th['c'];
										echo '</th>';
									}
								echo '</tr>';
							echo '</thead>';
						}
						echo '<tbody>';
							foreach ( $table['body'] as $tr ) {
								echo '<tr>';
									foreach ( $tr as $td ) {
										echo '<td>';
											echo $td['c'];
										echo '</td>';
									}
								echo '</tr>';
							}
						echo '</tbody>';
					echo '</table>';
				}
				?>
			</div>
		</div>
	</div>
</div>
