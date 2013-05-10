<?php get_header(); ?>

<div id="inner-page" class="wrap">
	<div class="inner-page-container group">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID();?>" <?php post_class('entry group'); ?>>
				<h1><?php the_title(); ?></h1>

				<div class="post-meta">
					<time datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php _e('Posted on', 'ci_theme'); ?> <?php echo get_the_date(); ?></time>, <a href="<?php comments_link(); ?>" class="entry-comments"><?php comments_number(); ?></a>
				</div>
	
				<?php ci_the_post_thumbnail(array("class" => "thumb")); ?>
	
				<?php the_content(); ?>
				<?php wp_link_pages(); ?>
				<?php comments_template(); ?>
			</article>
		<?php endwhile; endif; ?>

		<div id="sidebar">
			<?php dynamic_sidebar('blog-sidebar'); ?>
		</div><!-- #sidebar -->		
	</div> <!-- .inner-page-container -->
</div> <!-- .inner-page -->

<?php get_footer(); ?>
