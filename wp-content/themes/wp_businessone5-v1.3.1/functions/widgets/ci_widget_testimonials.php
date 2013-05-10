<?php 
if( !class_exists('CI_Testimonials') ):
class CI_Testimonials extends WP_Widget {

	function CI_Testimonials(){
		$widget_ops = array('description' => __('Testimonials widget', 'ci_theme'));
		$control_ops = array('width' => 300, 'height' => 400);
		parent::WP_Widget('ci_testimonials', __('-= CI Testimonials =-', 'ci_theme'), $widget_ops, $control_ops);
	}
	
	function widget($args, $instance) {
		global $post;
				
		extract($args);
		$ci_title = apply_filters( 'widget_title', empty( $instance['ci_title'] ) ? '' : $instance['ci_title'], $instance, $this->id_base );
		$ci_count = $instance['ci_count'];
		$ci_random = $instance['ci_random'];
		$ci_more_link = $instance['ci_more_link'];
	
		if($ci_random=='enabled')
		{
			$ci_random = 'rand';
		}
		else
		{
			$ci_random = 'post_date';
		}
		
		echo $before_widget;
		if ($ci_title) echo $before_title . $ci_title . $after_title;
		echo '<div class="textwidget"><div class="quote-icon"></div><div class="tsm-inner"> ';

		$posts = get_posts(array(
			'numberposts' => $ci_count,
			'orderby' => $ci_random,
			'post_type' => 'testimonial'
		));
		
		$old_post = $post;
		
		if(count($posts) > 0)
		{
			foreach($posts as $post)
			{
				setup_postdata($post);
				echo '<blockquote class="testimonial">';
				echo '';
				the_content();
					echo '<cite>';
					echo get_the_title();
					echo '</cite>';
				echo '</blockquote>';
			}
		}

		if($ci_more_link == 'enabled')
		{
			echo '<a href="'.get_post_type_archive_link('testimonial').'" class="readmore">' . __('Read more testimonials &raquo;', 'ci_theme') . '</a>';
		}
		
		echo "</div></div>";
		echo $after_widget;

		$post = $old_post;
		setup_postdata($post);
	}
	
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['ci_title'] = stripslashes($new_instance['ci_title']);
		$instance['ci_count'] = intval($new_instance['ci_count']);
		$instance['ci_random'] = stripslashes($new_instance['ci_random']);
		$instance['ci_more_link'] = stripslashes($new_instance['ci_more_link']);
		return $instance;
	}
	 
	function form($instance){
		$instance = wp_parse_args( (array) $instance, array('ci_title'=>__('Testimonials', 'ci_theme'), 'ci_count'=>'1', 'ci_random'=>'enabled', 'ci_more_link'=>'enabled') );
		$ci_title = htmlspecialchars($instance['ci_title']);
		$ci_count = htmlspecialchars($instance['ci_count']);
		$ci_random = htmlspecialchars($instance['ci_random']);
		$ci_more_link = htmlspecialchars($instance['ci_more_link']);
		echo '<p><label for="'.$this->get_field_id('ci_title').'">' . __('Title:', 'ci_theme') . '</label><input id="' . $this->get_field_id('ci_title') . '" name="' . $this->get_field_name('ci_title') . '" type="text" value="' . $ci_title . '" class="widefat" /></p>';
		echo '<p><label for="'.$this->get_field_id('ci_count').'">' . __('Number of testimonials:', 'ci_theme') . '</label><input id="' . $this->get_field_id('ci_count') . '" name="' . $this->get_field_name('ci_count') . '" type="text" value="' . $ci_count . '" class="widefat" /></p>';
		echo '<p><input type="checkbox" name="' . $this->get_field_name('ci_random') . '" id="' . $this->get_field_id('ci_random') . '" value="enabled" ' . checked($ci_random, 'enabled', false) . ' /> <label for="'.$this->get_field_id('ci_random').'">' . __('Show random testimonials', 'ci_theme') . '</label></p>';
		echo '<p><input type="checkbox" name="' . $this->get_field_name('ci_more_link') . '" id="' . $this->get_field_id('ci_more_link') . '" value="enabled" ' . checked($ci_more_link, 'enabled', false) . ' /> <label for="'.$this->get_field_id('ci_more_link').'">' . __('Show "Read More" link', 'ci_theme') . '</label></p>';
	}

} // class

register_widget('CI_Testimonials');

endif; // class_exists
?>
