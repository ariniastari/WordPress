<?php get_header(); ?>

<div id="inner-page" class="wrap">
	<div class="inner-page-container group">

		<article class="entry group">
			<h1><?php _e( 'Not Found', 'ci_theme' ); ?></h1>
	
			<p><?php _e( 'Oh, no! The page you requested could not be found. Perhaps searching will help...', 'ci_theme' ); ?></p>
	
			<?php get_search_form(); ?>
		</article>

		<div id="sidebar">
			<?php dynamic_sidebar('blog-sidebar'); ?>
		</div><!-- #sidebar -->		
	</div> <!-- .inner-page-container -->
</div> <!-- .inner-page -->

<?php get_footer(); ?>
