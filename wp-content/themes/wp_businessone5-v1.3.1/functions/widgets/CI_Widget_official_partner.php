<?php
if( !class_exists('ci_widget_official_partner') ):
class ci_widget_official_partner extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'ci_widget_official_partner', 'description' => __("The most official partner (blog posts) on your site", 'ci_theme') );
		parent::__construct('ci-official-partner', __('-= CI official partner =-', 'ci_theme'), $widget_ops);
		$this->alt_option_name = 'ci_widget_official_partner';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('ci_widget_official_partner', 'widget');

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

		$title = apply_filters('widget_title', empty($instance['title']) ? __('official partner', 'ci_theme') : $instance['title'], $instance, $this->id_base);
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
 			$number = 10;

		$r = new WP_Query(array('post_type'=>'official_partner', 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true));
		if ($r->have_posts()) :

			echo $before_widget;

			if ( $title ) echo $before_title . $title . $after_title;

			?>
			<div class="official_partner">
				<ul>
				<?php while ( $r -> have_posts() ) : $r -> the_post(); ?>
					<li><a href="<?php print_custom_field('partner_url'); ?>"><img src="<?php print_custom_field('partner_logo:to_image_src'); ?>" /></a></li>
				<?php endwhile; ?>
				</ul>
			</div>
			<?php 

			echo $after_widget;
			
			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('ci_widget_official_partner', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['ci_widget_official_partner']) )
			delete_option('ci_widget_official_partner');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('ci_widget_official_partner', 'widget');
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

register_widget('ci_widget_official_partner');

endif; // class_exists
?>
