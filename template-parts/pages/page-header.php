<section class="page-header bg-blue-shade-5 text-blue-shade-1 pt-28 lg:pt-64 pb-20 lg:pb-40">
	<div class="theme-container">
		<div class="flex flex-col w-full text-center">
			<div class="page-header--breadcrumbs invisible fade-in--noscroll">
				<?php do_action( 'breadcrumbs' ); ?>
			</div>
			<div class="page-header--title invisible fade-in--noscroll">
				<?php
				$page_header_title = '';
				if ( is_home() ) :
					$page_header_title = get_field( 'archive_news_header_title', 'options' );
				else :
					$page_header_title = get_field( 'page_header_title' );
				endif;
				if ( $page_header_title ) :
					?>
					<h1 class="text-title py-5 lg:py-10"><?php echo $page_header_title; ?></h1>
					<?php
				else :
					?>
					<h1 class="text-title py-5 lg:py-10"><?php the_title(); ?></h1>
					<?php
				endif;
				?>
			</div>
			<div class="page-header--description w-3/4 lg:w-[40%] mx-auto invisible fade-in--noscroll">
				<?php
				$page_header_desc = '';
				if ( is_home() ) :
					$page_header_desc = get_field( 'archive_news_header_description', 'options' );
				else :
					$page_header_desc = get_field( 'page_header_description' );
				endif;
				if ( $page_header_desc ) :
					?>
					<p class="text-description"><?php echo $page_header_desc; ?></p>
					<?php
				endif;
				?>
			</div>
		</div>
	</div>
</section>
