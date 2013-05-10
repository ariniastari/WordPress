<?php get_header(); ?>

<?php
	$args = array(
		'post_type' => 'testimonial',
		'nopaging' => true
	);
	query_posts($args);
?>

<div id="inner-page" class="wrap">
	<div class="inner-page-container group">
			<article class="entry group">
				<h1><?php _e('Testimonials', 'ci_theme'); ?></h1>
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<aside class="widget ci_widget_testimonials">
				<div class="textwidget">
					<blockquote class="testimonial">
						<div class="quote-icon"></div>
						<?php ci_e_content(); ?>
						<cite><?php the_title(); ?></cite>
					</blockquote>
				</div>
			</aside>
				<?php endwhile; endif; ?>

				<?php ci_pagination(); ?>

			</article>


		<div id="sidebar">
			<?php dynamic_sidebar('pages-sidebar'); ?>
		</div><!-- #sidebar -->		
	</div> <!-- .inner-page-container -->
</div> <!-- .inner-page -->

<?php get_footer(); ?>
