<?php
/*
Template Name: Product Listing
*/
?>

<?php $page_title = get_the_title(); ?>

<?php get_header(); ?>

<?php 
	global $post;
	$paged = get_query_var('paged') ? get_query_var('paged') : 1;
	$base_category = get_post_meta($post->ID, 'base_products_category', true);
	
	$args = array(
		'post_type'=>'product',
		'posts_per_page' => 6,
		'paged' => $paged
	);
	
	$args_tax = array(
		'tax_query' => array(
			array(
				'taxonomy' => 'product_category',
				'field' => 'id',
				'terms' => $base_category,
				'include_children' => true
			)
		)
	);

	if(empty($base_category) or $base_category < 1)
		query_posts($args);
	else
		query_posts(array_merge($args, $args_tax));
?>

<div id="inner-page" class="wrap">
	<div class="inner-page-container group">
			<article class="entry group">
				<h1><?php echo $page_title; ?></h1>

				<ul class="products group">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<li>
							<?php the_title('<h5>','</h5>'); ?>
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
