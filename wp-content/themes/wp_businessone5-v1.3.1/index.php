<?php get_header(); ?>

<div id="inner-page" class="wrap">
	<div class="inner-page-container group">
		<div class="main-col group">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID();?>" <?php post_class('entry group'); ?>>
				<h1><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(__('Permalink to', 'ci_theme').' '.get_the_title()); ?>"><?php the_title(); ?></a></h1>
				<?php if ( has_post_thumbnail() and !is_singular() ) : ?>
					<a class="entry-thumb" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
				<?php endif; ?>
	
				<div class="post-meta">
					<time datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php _e('Posted on', 'ci_theme'); ?> <?php echo get_the_date(); ?></time>, <a href="<?php comments_link(); ?>" class="entry-comments"><?php comments_number(); ?></a>
				</div>
	
				<?php if(is_single() or is_page()): ?>
					<?php ci_the_post_thumbnail(array("class" => "thumb")); ?>
				<?php endif; ?>
	
	
				<?php ci_e_content(); ?>
				<?php if( is_singular() ) wp_link_pages(); ?>
				<?php if( ! is_singular() ) ci_read_more(); ?>
				<?php if (is_singular()) comments_template(); ?>
			</article>
		<?php endwhile; endif; ?>

		<?php ci_pagination(); ?>
		</div> <!-- .main-col -->
		<div id="sidebar">
			<?php dynamic_sidebar('blog-sidebar'); ?>
		</div><!-- #sidebar -->		
	</div> <!-- .inner-page-container -->
</div> <!-- .inner-page -->

<?php get_footer(); ?>
