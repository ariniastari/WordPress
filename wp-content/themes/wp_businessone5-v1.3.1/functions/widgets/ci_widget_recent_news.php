<?php
if( !class_exists('CI_Widget_Recent_News') ):
class CI_Widget_Recent_News extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'ci_widget_recent_news', 'description' => __("The most recent news (blog posts) on your site", 'ci_theme') );
		parent::__construct('ci-recent-news', __('-= CI Recent News =-', 'ci_theme'), $widget_ops);
		$this->alt_option_name = 'ci_widget_recent_news';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('ci_widget_recent_news', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent News', 'ci_theme') : $instance['title'], $instance, $this->id_base);
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
 			$number = 10;

		$r = new WP_Query(array('category_name' => 'news_and_article', 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true));
		if ($r->have_posts()) :

			echo $before_widget;

			if ( $title ) echo $before_title . $title . $after_title;

			?>
				<?php  if ($r->have_posts()) : $r->the_post(); ?>
					<?php echo '<a href="'.get_permalink().'" class="wgt-thumb">'.get_the_post_thumbnail().'</a>'; ?>
					<div class="left"><a class="ci-news-title" href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title( '<h5>', '</h5>' ); else the_ID(); ?></a></div>
					<div class="right"><span class="ci-news-time"><?php echo get_the_date(); ?></span></div>
					<div class="clear"></div>
					<?php the_excerpt(); ?>
					<a class="ci-more-link" href="<?php the_permalink() ?>">Read More</a>

				<?php endif; ?>
			<?php 

			echo $after_widget;
			
			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('ci_widget_recent_news', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['ci_widget_recent_news']) )
			delete_option('ci_widget_recent_news');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('ci_widget_recent_news', 'widget');
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ci_theme'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'ci_theme'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
		<?php
	}
}

register_widget('CI_Widget_Recent_News');

endif; // class_exists
?>
