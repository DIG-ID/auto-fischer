<section class="section-map mb-24 md:mb-44 lg:mb-48">
	<div class="theme-container theme-grid">
		<div class="col-span-2 md:col-span-6 xl:col-span-12 flex justify-center items-center rounded-2xl overflow-hidden">
			<?php
			$location = get_field( 'map' );
			if ( $location ) :
				?>
				<div class="acf-map" data-zoom="16">
					<div class="marker" data-lat="<?php echo esc_attr( $location['lat'] ); ?>" data-lng="<?php echo esc_attr( $location['lng'] ); ?>"></div>
				</div>
				<?php
			endif;
			?>
		</div>
	</div>

</section>
