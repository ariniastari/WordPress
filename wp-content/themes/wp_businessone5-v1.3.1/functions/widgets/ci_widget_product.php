<?php 
if( !class_exists('CI_Product_Widget') ):
class CI_Product_Widget extends WP_Widget {

	function CI_Product_Widget(){
		$widget_ops = array('description' => __('Displays a single product item', 'ci_theme'));
		$control_ops = array('width' => 300, 'height' => 400);
		parent::WP_Widget('ci_product_widget', __('-= CI Product =-', 'ci_theme'), $widget_ops, $control_ops);
	}
	
	function widget($args, $instance) {
		global $post;
		$old_post = $post;
				
		extract($args);
		$ci_title = apply_filters( 'widget_title', empty( $instance['ci_title'] ) ? '' : $instance['ci_title'], $instance, $this->id_base );
		$ci_post_id = $instance['ci_post_id'];

		$post = get_post($ci_post_id);

		echo $before_widget;
		echo '<div class="ci_widget_product">';

		if($post)
		{
			setup_postdata($post);
			
			if ($ci_title) 
				echo $before_title . $ci_title . $after_title;
			else 
				echo $before_title . '<a href="'.get_permalink().'">'. get_the_title() . '</a>' . $after_title;

			if(has_post_thumbnail())
				echo '<a href="'.get_permalink().'" class="wgt-thumb">'.get_the_post_thumbnail().'</a>';
			else
				echo '<a href="'.get_permalink().'" class="wgt-thumb"><img src="'. get_stylesheet_directory_uri() .'/images/product_not_available_260x123.png" /></a>';
			the_excerpt();
		}

		echo "</div>";
		echo $after_widget;

		$post = $old_post;
		setup_postdata($post);
	}
	
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['ci_title'] = stripslashes($new_instance['ci_title']);
		$instance['ci_post_id'] = intval($new_instance['ci_post_id']);
		return $instance;
	}
	 
	function form($instance){
		$instance = wp_parse_args( (array) $instance, array('ci_post_id' => 0, 'ci_title'=>'') );
		$ci_post_id = intval($instance['ci_post_id']);
		$ci_title = htmlspecialchars($instance['ci_title']);
		echo '<p><label for="'.$this->get_field_id('ci_title').'">' . __('Title (leave empty to use the product\'s title):', 'ci_theme') . '</label><input id="' . $this->get_field_id('ci_title') . '" name="' . $this->get_field_name('ci_title') . '" type="text" value="' . $ci_title . '" class="widefat" /></p>';
		echo '<p><label for="'.$this->get_field_id('ci_post_id').'">'.__('Product to show:', 'ci_theme').'</label></p>';
		wp_dropdown_posts( array(
			'post_type' => 'page',
			'selected' => $ci_post_id,
			'id' => $this->get_field_id('ci_post_id')
		), $this->get_field_name('ci_post_id'));
	}

} // class

register_widget('CI_Product_Widget');

endif; // class_exists
?>
