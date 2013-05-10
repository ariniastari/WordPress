<?php get_header(); ?>

<div id="inner-page" class="wrap">
	<div class="inner-page-container fullwidth group">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID();?>" <?php post_class('entry group'); ?>>
				<h1><?php the_title(); ?></h1>

				<?php
					$args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $post->ID );
					$attachments = get_posts($args);
				?>
				<?php if ($attachments): ?>
						<div class="prod-sld-container">
							<div class="prod-sld">
							<?php
								// Big slides
								foreach ( $attachments as $attachment )
								{
									if(wp_attachment_is_image($attachment->ID))
									{
										$alt_text = trim(strip_tags( get_post_meta($attachment->ID, '_wp_attachment_image_alt', true) ));
										$attr = array(
											'alt'   => $alt_text,
											'title' => trim(strip_tags( $attachment->post_title ))
										);
										$img_attrs = wp_get_attachment_image_src( $attachment->ID, 'large' );
										echo '<div><a href="'.$img_attrs[0].'" rel="prettyPhoto-gal['.get_the_ID().']" title="'.esc_attr($alt_text).'">'.wp_get_attachment_image( $attachment->ID, 'product_preview', false, $attr ).'</a></div>';
									}
								}
							?>
							</div>
							<?php if (count($attachments) > 1): ?>
							<ul class="prod-sld-thumbs group">
								<?php
									// Pager thumbs
									foreach ( $attachments as $attachment )
									{
										if(wp_attachment_is_image($attachment->ID))
										{
											$alt_text = trim(strip_tags( get_post_meta($attachment->ID, '_wp_attachment_image_alt', true) ));
											$attr = array(
												'alt'   => $alt_text,
												'title' => trim(strip_tags( $attachment->post_title ))
											);
											$img_attrs = wp_get_attachment_image_src( $attachment->ID, 'product_preview' );
											echo '<li><a href="#">'.wp_get_attachment_image( $attachment->ID, 'product_thumb', false, $attr ).'</a></li>';
										}
									}
								?>
							</ul>
							<?php endif; ?>
						</div>
				<?php elseif(ci_setting('product_show_no_photo')=='enabled'): ?>
					<div class="prod-sld-container">
						<div class="prod-sld">
							<a href="#"><img width="380" height="290" src="<?php echo get_stylesheet_directory_uri(); ?>/images/product_not_available_380x290.png" /></a>
						</div>
					</div>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>

					
				<?php the_content(); ?>
				<?php wp_link_pages(); ?>

				<?php if(ci_setting('show_related_products')=='enabled'): ?>
					<div class="similar-work">
						<h3><?php _e('Related Products', 'ci_theme'); ?></h3>
						<ul class="product-items group three-col">
							<?php
								$term_list = array();
								$terms = get_the_terms(get_the_ID(), 'product_category');
								if(is_array($terms))
								{
									foreach($terms as $term)
									{
										$term_list[] = $term->slug;
									}
								}
								
								$args = array( 
									'post_type' => 'product', 
									'numberposts' => 3, 
									'post_status' => 'published', 
									'post__not_in' => array(get_the_ID()),
									'orderby' => 'rand',
									'tax_query' => array(
										array(
											'taxonomy' => 'product_category',
											'field' => 'slug',
											'terms' => $term_list
										)
									) 
								);
								$related_posts = get_posts($args);
							?>
							<?php 
								foreach($related_posts as $rpost)
								{
									$attr = array(
										'title' => trim(strip_tags( $rpost->post_title ))
									);
									
									$thumb_img = get_the_post_thumbnail($rpost->ID, 'product_thumb', $attr);
									if(!empty($thumb_img))
										echo '<li class="item"><a href="'.get_permalink($rpost->ID).'" title="'.esc_attr(get_the_title($rpost->ID)).'">'.get_the_post_thumbnail($rpost->ID, 'product_thumb', $attr).'</a></li>';
									else
										echo '<li class="item"><a href="'.get_permalink($rpost->ID).'" title="'.esc_attr(get_the_title($rpost->ID)).'"><img src="'.get_stylesheet_directory_uri().'/images/product_not_available_90x69.png" alt="'.esc_attr(get_the_title($rpost->ID)).'" /></a></li>';
									
								}
							?>
							
							<?php wp_reset_postdata(); ?>
						</ul><!-- #similar-portfolios -->
					</div>
				<?php endif; ?>

			</article>
		<?php endwhile; endif; ?>

	</div> <!-- .inner-page-container -->
</div> <!-- .inner-page -->

<?php get_footer(); ?>
