<?php
/*
Template Name: Post Listing
*/
?>

<?php get_header(); ?>

<?php
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	
	if (is_page('104')) {
		query_posts(array('category_name' => 'news_and_article', 'posts_per_page' => 6, 'paged' => $paged));
	} else if (is_page('101')) {
		query_posts(array('category_name' => 'program', 'posts_per_page' => 6, 'paged' => $paged));
	}
?>
<div id="inner-page" class="wrap blog">
	<div class="inner-page-container fullwidth group">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID();?>" <?php post_class('entry group'); ?>>
				<h1><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(__('Permalink to', 'ci_theme').' '.get_the_title()); ?>"><?php the_title(); ?></a></h1>
				<?php if ( has_post_thumbnail() ) : ?>
					<a class="entry-thumb" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
				<?php endif; ?>
	
				<div class="post-meta">
					<time datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php _e('Posted on', 'ci_theme'); ?> <?php echo get_the_date(); ?></time>, <a href="<?php comments_link(); ?>" class="entry-comments"><?php comments_number(); ?></a>
				</div>
	
				<?php the_excerpt(); ?>
				<?php ci_read_more(); ?>
			</article>
		<?php endwhile; endif; ?>
		<?php ci_pagination(); ?>
		<?php wp_reset_query(); ?>
	
	</div> <!-- .inner-page-container -->
</div> <!-- .inner-page -->

<?php get_footer(); ?>