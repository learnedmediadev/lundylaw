<?php 

get_header();
	the_post(); ?>

		<?php ll_page_header_image();

		if ( get_post_type() != 'faq' ) {
			ll_breadcrumbs(); 	
		}
		?>

		<div class="container clearfix">
			<div class="content">
				<?php
				ll_page_title();

				the_content();
				?>
			</div>
			<!-- end of content -->

			<?php get_sidebar('page'); ?>

		</div>
		<!-- end of container -->
<?php get_footer(); ?>