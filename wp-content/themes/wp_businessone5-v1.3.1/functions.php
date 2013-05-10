<?php 
	get_template_part('panel/constants');

	load_theme_textdomain( 'ci_theme', get_template_directory() . '/lang' );

	// This is the main options array. Can be accessed as a global in order to reduce function calls.
	$ci = get_option(THEME_OPTIONS);
	$ci_defaults = array();

	// The $content_width needs to be before the inclusion of the rest of the files, as it is used inside of some of them.
	if ( ! isset( $content_width ) ) $content_width = 590;

	//
	// Let's bootstrap the theme.
	//
	get_template_part('panel/bootstrap');


	//
	// Define our various image sizes.
	//
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 260, 123, true );
	add_image_size( 'homepage_slider', 927, 378, true);
	add_image_size( 'product_thumb', 90, 69, true);
	add_image_size( 'product_preview', 380, ci_setting('product_preview_height'), true);
	add_image_size( 'featured_full', 905, 230, true);

	// Let the user choose a color scheme on each post individually.
	add_ci_theme_support('post-color-scheme', array('page', 'post'));


	// Make linked images open with prettyPhoto.
	add_filter('the_content', 'prettyphotorel', 12);
	add_filter('get_comment_text', 'prettyphotorel');
	function prettyphotorel ($content)
	{   global $post;
		$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
	    $replacement = '<a$1href=$2$3.$4$5 rel="prettyPhoto['.$post->ID.']"$6>$7</a>';
	    $content = preg_replace($pattern, $replacement, $content);
	    return $content;
	}

?>
