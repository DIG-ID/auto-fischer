<section class="section-form bg-transparent pb-16 xl:pb-24">
	<div class="theme-container theme-grid">
		<div class="col-span-2 md:col-span-6 xl:col-span-6">
			<h2 class="title-secondary !font-normal mb-7"><?php the_field( 'intro_subtitle' ); ?></h2>
			<p class="text-body mb-7 xl:mb-12"><?php the_field( 'intro_description' ); ?></p>
			<div class="contact-form-wrapper gap-x-7 mb-11 md:md-0">
				<?php
				$form = get_field( 'contact_form' );
				if ( $form ) :
					echo do_shortcode( $form );
				endif;
				?>
			</div>
		</div>
		<div class="col-span-2 md:col-span-5 xl:col-span-5 xl:col-start-8 ">
			<div class="kontkact-box bg-white border border-[#E1E1E1] p-10 rounded-2xl">
				<h2 class="title-smallest mb-8"><?php esc_html_e( 'Kontakt', 'auto-fischer' ); ?></h2>
				<?php
				$opening_hours = get_field( 'opening_hours' );
				if ( $opening_hours ) :
					$monday_friday = get_field( 'opening_hours_monday_friday' );
					$saturday      = get_field( 'opening_hours_saturday' );
					$sunday        = get_field( 'opening_hours_sunday' );

					echo '<div class="opening-hours text-body !font-medium"><p class=" mb-9">' . esc_html__( 'Öffnungszeiten', 'auto-fischer' ) . '</p>';
					if ( $monday_friday ) :
						echo '<p class="text-body"><span class="font-medium">' . esc_html__( 'Montag - Freitag: ', 'auto-fischer' ) . '</span>' . $monday_friday . '</p>';
					endif;
					if ( $saturday ) :
						echo '<p class="text-body"><span class="font-medium">' . esc_html__( 'Samstag: ', 'auto-fischer' ) . '</span>' . $saturday . '</p>';
					endif;
					if ( $sunday ) :
						echo '<p class=" text-body mb-16"><span class="font-medium">' . esc_html__( 'Sonntag: ', 'auto-fischer' ) . '</span>' . $sunday . '</p>';
					endif;
					echo '</div>';
				endif;

				$contacts = get_field( 'contacts' );
				if ( $contacts ) :
					$address = get_field( 'contacts_address' );
					$email   = get_field( 'contacts_email' );
					$phone   = get_field( 'contacts_telephone' );
					echo '<address class="contacts flex flex-col gap-y-8 justify-between not-italic">';
					if ( $address ) :
						?>
						<div class="contacts-address flex gap-x-3">
							<div class="icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M13.0007 4.0625C8.67944 4.0625 5.14648 7.64734 5.14648 12.1068C5.14648 14.3555 6.0459 16.8458 7.51763 18.7689C8.99316 20.697 10.9461 21.9375 13.0007 21.9375C15.0552 21.9375 17.0081 20.697 18.4837 18.7689C19.9554 16.8458 20.8548 14.3555 20.8548 12.1068C20.8548 7.64734 17.3219 4.0625 13.0007 4.0625ZM3.52148 12.1068C3.52148 6.78329 7.74892 2.4375 13.0007 2.4375C18.2523 2.4375 22.4798 6.78329 22.4798 12.1068C22.4798 14.7496 21.4392 17.5809 19.7742 19.7564C18.113 21.9271 15.7326 23.5625 13.0007 23.5625C10.2687 23.5625 7.88834 21.9271 6.22715 19.7564C4.56217 17.5809 3.52148 14.7496 3.52148 12.1068Z" fill="#005AA9"/>
									<path fill-rule="evenodd" clip-rule="evenodd" d="M9.48047 11.3751C9.48047 9.43057 11.0568 7.85425 13.0013 7.85425C14.9458 7.85425 16.5221 9.43057 16.5221 11.3751C16.5221 13.3196 14.9458 14.8959 13.0013 14.8959C11.0568 14.8959 9.48047 13.3196 9.48047 11.3751ZM13.0013 9.47925C11.9543 9.47925 11.1055 10.328 11.1055 11.3751C11.1055 12.4221 11.9543 13.2709 13.0013 13.2709C14.0483 13.2709 14.8971 12.4221 14.8971 11.3751C14.8971 10.328 14.0483 9.47925 13.0013 9.47925Z" fill="#F48123"/>
								</svg>
							</div>
							<div class="contacts-address-content">
								<p class="text-body !font-medium"><?php esc_html_e( 'Adresse', 'auto-fischer' ); ?></p>
								<p class="text-body"><?php echo $address; ?></p>
							</div>
						</div>
						<?php
					endif;
					if ( $email ) :
						?>
						<div class="contacts-email flex gap-x-3">
							<div class="icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M12.7584 14.5869C12.0336 14.5869 11.3111 14.3474 10.7065 13.8686L5.84779 9.95128C5.49787 9.66962 5.44371 9.1572 5.72429 8.80837C6.00704 8.46062 6.51837 8.40537 6.86721 8.68595L11.7216 12.5989C12.3316 13.0821 13.1906 13.0821 13.8049 12.5946L18.6106 8.68812C18.9594 8.4032 19.4707 8.45737 19.7546 8.8062C20.0373 9.15395 19.9842 9.66528 19.6365 9.94912L14.8221 13.8621C14.2133 14.3453 13.4853 14.5869 12.7584 14.5869Z" fill="#F48123"/>
									<path fill-rule="evenodd" clip-rule="evenodd" d="M18.0479 21.6667C18.0501 21.6646 18.0587 21.6667 18.0652 21.6667C19.3013 21.6667 20.3976 21.2247 21.2383 20.3852C22.2144 19.4134 22.7506 18.017 22.7506 16.4537V9.01341C22.7506 5.98766 20.7725 3.79175 18.0479 3.79175H7.41173C4.68715 3.79175 2.70898 5.98766 2.70898 9.01341V16.4537C2.70898 18.017 3.24632 19.4134 4.22132 20.3852C5.06198 21.2247 6.1594 21.6667 7.3944 21.6667H18.0479ZM7.39115 23.2917C5.71957 23.2917 4.22673 22.6851 3.07407 21.5367C1.79032 20.2562 1.08398 18.4514 1.08398 16.4537V9.01341C1.08398 5.11016 3.80423 2.16675 7.41173 2.16675H18.0479C21.6554 2.16675 24.3756 5.11016 24.3756 9.01341V16.4537C24.3756 18.4514 23.6693 20.2562 22.3856 21.5367C21.234 22.684 19.7401 23.2917 18.0652 23.2917H7.39115Z" fill="#005AA9"/>
								</svg>
							</div>
							<div class="contacts-email-content">
								<p class="text-body !font-medium"><?php esc_html_e( 'Email', 'auto-fischer' ); ?></p>
								<a class="text-body" href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo $email; ?></a>
							</div>
						</div>
						<?php
					endif;
					if ( $phone ) :
						?>
						<div class="contacts-phone flex gap-x-3">
							<div class="icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
									<path d="M23.5131 10.9886C23.1046 10.9886 22.7536 10.6821 22.7071 10.2671C22.2954 6.6098 19.4538 3.77147 15.7965 3.36522C15.3512 3.31538 15.0295 2.91455 15.0793 2.46822C15.1281 2.02297 15.5278 1.69038 15.9763 1.75105C20.3931 2.24072 23.8251 5.66838 24.3212 10.0851C24.3721 10.5315 24.0504 10.9333 23.6051 10.9832C23.5748 10.9864 23.5434 10.9886 23.5131 10.9886Z" fill="#F48123"/>
									<path d="M19.6753 11.0003C19.2939 11.0003 18.9549 10.7317 18.879 10.3438C18.567 8.7405 17.3309 7.50441 15.7298 7.1935C15.2889 7.10791 15.0018 6.68216 15.0874 6.24125C15.1729 5.80033 15.6095 5.51325 16.0396 5.59883C18.294 6.0365 20.0349 7.77633 20.4737 10.0318C20.5593 10.4738 20.2722 10.8996 19.8324 10.9852C19.7793 10.9949 19.7273 11.0003 19.6753 11.0003Z" fill="#F48123"/>
									<path fill-rule="evenodd" clip-rule="evenodd" d="M8.1053 17.8102C13.2111 22.917 16.6106 24.256 18.7578 24.256C19.8173 24.256 20.5734 23.9299 21.0772 23.5681C21.0999 23.5551 23.4313 22.1294 23.8397 19.9714C24.0325 18.9585 23.7509 17.9564 23.0272 17.0724C20.0459 13.453 18.527 13.791 16.85 14.6068C15.8198 15.1116 15.0062 15.5038 12.7084 13.2082C10.412 10.9108 10.8081 10.0971 11.3096 9.067C12.1265 7.39 12.4625 5.8708 8.84197 2.8873C7.96013 2.16689 6.96455 1.88522 5.95272 2.0748C3.82613 2.47239 2.39397 4.7658 2.39397 4.7658C1.2543 6.36589 0.480802 10.1868 8.1053 17.8102ZM6.28422 3.66514C6.37955 3.64997 6.4738 3.6413 6.56697 3.6413C6.99163 3.6413 7.40113 3.80705 7.80955 4.14289C10.7291 6.54786 10.3597 7.30621 9.84839 8.35595C9.08031 9.93437 8.67838 11.4749 11.559 14.3576C14.4429 17.2404 15.9844 16.8384 17.5607 16.0682L17.5633 16.0669C18.6117 15.5573 19.3697 15.1888 21.7716 18.1049C22.1822 18.6054 22.3393 19.1059 22.2504 19.6334C22.0457 20.8468 20.6352 21.9334 20.2084 22.1977C18.6798 23.2875 14.9997 22.4068 9.25363 16.6619C3.5098 10.9169 2.62797 7.23689 3.7568 5.6498C3.98213 5.28255 5.07305 3.86989 6.28422 3.66514Z" fill="#005AA9"/>
								</svg>
							</div>
							<div class="contacts-phone-content">
								<p class="text-body !font-medium"><?php esc_html_e( 'Telefon', 'auto-fischer' ); ?></p>
								<a class="text-body" href="tel:<?php echo esc_attr( $phone ); ?>"><?php echo $phone; ?></a>
							</div>
						</div>
						<?php
					endif;
					echo '</address>';
				endif;
				?>
				<div class="mt-8">
					<p class="text-body !font-medium mb-5"><?php esc_html_e( 'Folgen Sie uns', 'auto-fischer' ); ?></p>
					<?php do_action( 'socials' ); ?>
				</div>

			</div>
		</div>
	</div>
</section>
