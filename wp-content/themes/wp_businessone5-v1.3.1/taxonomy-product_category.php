<?php get_header(); ?>

<div id="inner-page" class="wrap">
	<div class="inner-page-container group">
			<article class="entry group">
				<h1><?php single_term_title(); ?></h1>

				<ul class="products group">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<li>
							<?php if ( has_post_thumbnail()) : ?>
								<a class="product-thumb" href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail('post-thumbnail', array(
										'alt' => trim(strip_tags(get_the_title())),
										'title' => trim(strip_tags(get_the_title()))
									)); ?>
								</a>
							<?php else: ?>
								<a class="product-thumb" href="<?php the_permalink(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/product_not_available_260x123.png" /></a>
							<?php endif; ?>
							<?php the_excerpt(); ?>
						</li>
					<?php endwhile; endif; ?>
				</ul>
				<?php ci_pagination(); ?>

			</article>


		<div id="sidebar">
			<?php dynamic_sidebar('products-sidebar'); ?>
		</div><!-- #sidebar -->		
	</div> <!-- .inner-page-container -->
</div> <!-- .inner-page -->

<?php get_footer(); ?>
