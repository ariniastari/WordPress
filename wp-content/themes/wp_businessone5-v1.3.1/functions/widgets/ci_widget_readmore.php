<?php
if( !class_exists('CI_Widget_ReadMore') ):
class CI_Widget_ReadMore extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'ci_widget_readmore', 'description' => __('Arbitrary text or HTML with URL for Read More', 'ci_theme'));
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('ci_readmore', __('-= CI Read More =-', 'ci_theme'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>

		<div class="readmorewidget">
			<?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?>
			<?php if(!empty($instance['url'])): ?>
				<a class="ci-more-link" href="<?php echo esc_attr($instance['url']); ?>"><?php echo $instance['readmore']; ?></a>
			<?php endif; ?>
		</div>
			
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset($new_instance['filter']);
		$instance['url'] = strip_tags($new_instance['url']);
		$instance['readmore'] = strip_tags($new_instance['readmore']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'filter'=>true, 'url'=>'#', 'readmore'=>__('Read More', 'ci_theme') ) );
		$title = strip_tags($instance['title']);
		$text = esc_textarea($instance['text']);
		$url = strip_tags($instance['url']);
		$readmore = strip_tags($instance['readmore']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ci_theme'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>

		<p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs', 'ci_theme'); ?></label></p>

		<p><label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('URL:', 'ci_theme'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo esc_attr($url); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('readmore'); ?>"><?php _e('Read More text:', 'ci_theme'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('readmore'); ?>" name="<?php echo $this->get_field_name('readmore'); ?>" type="text" value="<?php echo esc_attr($readmore); ?>" /></p>
<?php
	}
}

register_widget('CI_Widget_ReadMore');

endif; //class_exists
?>
