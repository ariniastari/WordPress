<?php 
	global $post;
	$q = new WP_Query( array(
		'post_type'=>'slider',
		'posts_per_page' => -1
	)); 
?>

<div id="sld-container" class="wrap">
	<div class="sld-inner group">
		<div class="slideshow">
			<div class="slides">

				<?php while ( $q->have_posts() ) : $q->the_post(); ?>
					<?php 
						$link = get_post_meta($post->ID, 'ci_cpt_slider_url', true);
						$default_attr = array(
							'alt'	=> trim(strip_tags( get_the_excerpt() )),
							'title'	=> trim(strip_tags( get_the_title() ))
						);
						$thumb = get_the_post_thumbnail($post->ID, 'homepage_slider', $default_attr);
					?>
					
					<article class="sld-entry">

						<?php if(!empty($link)): ?><a href="<?php echo $link; ?>"><?php endif; ?>
							<?php if ($thumb) echo $thumb; else echo '<img src="" />'; ?>
						<?php if(!empty($link)): ?></a><?php endif; ?>

						<div class="slide-details">
							<?php if(!empty($link)): ?>
								<h1><a href="<?php echo $link; ?>"><?php the_title(); ?></a></h1>
							<?php else: ?>
								<h1><?php the_title(); ?></h1>
							<?php endif; ?>

							<p><?php echo mb_substr(get_the_excerpt(), 0, 300); ?>...</p>

							<?php if(!empty($link)): ?>
								<a href="<?php echo $link; ?>" class="ci-more-link"><?php _e('Explore.', 'ci_theme'); ?></a>
							<?php endif; ?>
						</div>

					</article>
				<?php endwhile; ?>

			</div>
		</div>
		<a href="#" class="sld-prev"><?php _e('Previous', 'ci_theme'); ?></a>
		<a href="#" class="sld-next"><?php _e('Next', 'ci_theme'); ?></a>
		<div class="sld-pager"></div>
	</div>
</div>
<?php wp_reset_postdata(); ?>
