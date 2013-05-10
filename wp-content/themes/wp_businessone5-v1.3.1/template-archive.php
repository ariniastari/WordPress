<?php
/*
Template Name: Archive
*/
?>
<?php get_header(); ?>

<div id="inner-page" class="wrap">
	<div class="inner-page-container group">
		<div class="main-col group">
			<article class="entry group">
				<h1><?php the_title(); ?></h1>

				<?php 
					global $paged;
					$arrParams = array(
						'paged' => $paged,
						'ignore_sticky_posts'=>1,
						'showposts' => ci_setting('archive_no'));
					query_posts($arrParams);
				?>
				<h2 ><?php _e('Recent Posts', 'ci_theme'); ?></h2>
				<ul class="lst archive">
					<?php while (have_posts() ) : the_post(); ?>
						<li><a href="<?php the_permalink(); ?>" title="<?php _e('Permalink to:','ci_theme'); ?> <?php the_title(); ?>"><?php the_title(); ?></a> - <?php echo get_the_date(); ?><?php the_excerpt(); ?></li>
					<?php endwhile; ?>
				</ul>
				<?php wp_reset_postdata();?>
				
				<?php if (ci_setting('archive_week')=='enabled'): ?>
					<h2 class="hdr"><?php _e('Weekly Archive', 'ci_theme'); ?></h2>
					<ul class="lst archive"><?php wp_get_archives('type=weekly&show_post_count=1') ?></ul>
				<?php endif; ?>
				
				<?php if (ci_setting('archive_month')=='enabled'): ?>
					<h2 class="hdr"><?php _e('Monthly Archive', 'ci_theme'); ?></h2>
					<ul class="lst archive"><?php wp_get_archives('type=monthly&show_post_count=1') ?></ul>
				<?php endif; ?>
				
				<?php if (ci_setting('archive_year')=='enabled'): ?>
					<h2 class="hdr"><?php _e('Yearly Archive', 'ci_theme'); ?></h2>
					<ul class="lst archive"><?php wp_get_archives('type=yearly&show_post_count=1') ?></ul>
				<?php endif; ?>

			</article>

		<?php ci_pagination(); ?>
		</div> <!-- .main-col -->
		<div id="sidebar">
			<?php dynamic_sidebar('blog-sidebar'); ?>
		</div><!-- #sidebar -->		
	</div> <!-- .inner-page-container -->
</div> <!-- .inner-page -->

<?php get_footer(); ?>
