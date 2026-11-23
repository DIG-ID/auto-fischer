<section class="section-map mb-24 md:mb-44 lg:mb-48">
	<div class="theme-container theme-grid">
		<div class="col-span-2 md:col-span-6 xl:col-span-12 flex justify-center items-center rounded-2xl overflow-hidden">
			<?php
			$locations = get_field( 'map_locations' );
			if ( $locations ) :
				?>
				<div class="acf-map" data-zoom="16">
					<?php
					foreach ( $locations as $item ) :
						$location = $item['location'];
						if ( empty( $location['lat'] ) ) :
							continue;
						endif;
						?>
						<div class="marker" data-lat="<?php echo esc_attr( $location['lat'] ); ?>" data-lng="<?php echo esc_attr( $location['lng'] ); ?>" data-label="<?php echo esc_attr( $item['label'] ); ?>">
							<?php echo esc_html( $location['address'] ); ?>
						</div>
						<?php
					endforeach;
					?>
				</div>
				<?php
			endif;
			?>
		</div>
	</div>
</section>
