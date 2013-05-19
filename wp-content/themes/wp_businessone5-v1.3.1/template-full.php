<?php
/*
Template Name: Full width, no sidebar
*/
?>
<?php get_header(); ?>

<div id="inner-page" class="wrap">
	<div class="inner-page-container fullwidth group">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID();?>" <?php post_class('entry group'); ?>>
				<h1><?php the_title(); ?></h1>
				<?php the_post_thumbnail('featured_full', array("class" => "thumb")); ?>
	
				<?php the_content(); ?>
				<?php wp_link_pages(); ?>
			</article>
		<?php endwhile; endif; ?>

	</div> <!-- .inner-page-container -->
</div> <!-- .inner-page -->

<?php get_footer(); ?>
