<?php
add_action( 'widgets_init', 'ci_widgets_init' );
if( !function_exists('ci_widgets_init') ):
function ci_widgets_init() {

	register_sidebar(array(
		'name' => __( 'Products Sidebar', 'ci_theme'),
		'id' => 'products-sidebar',
		'description' => __( 'This sidebar appears on product listing pages.', 'ci_theme'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s group">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __( 'Pages Sidebar', 'ci_theme'),
		'id' => 'pages-sidebar',
		'description' => __( 'This sidebar appears on normal pages.', 'ci_theme'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s group">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __( 'Blog Sidebar', 'ci_theme'),
		'id' => 'blog-sidebar',
		'description' => __( 'The sidebar appears on the blog section of your website, i.e. on posts and post listing pages.', 'ci_theme'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s group">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __( 'Front page 1st row', 'ci_theme'),
		'id' => 'frontpage-widgets-1',
		'description' => __( 'This sidebar appears on the first row of the front page.', 'ci_theme'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s group">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => __( 'Front page 2nd row', 'ci_theme'),
		'id' => 'frontpage-widgets-2',
		'description' => __( 'This sidebar appears on the second row of the front page.', 'ci_theme'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s group">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => __( 'Front page 3rd row', 'ci_theme'),
		'id' => 'frontpage-widgets-3',
		'description' => __( 'This sidebar appears on the third row of the front page.', 'ci_theme'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s group">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));


	register_sidebar(array(
		'name' => __( 'Emphasized Footer Widgets', 'ci_theme'),
		'id' => 'footer-widgets-emphasis',
		'description' => __( 'The widgets here will appear in an emphasized area on the footer of your website.', 'ci_theme'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s group">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => __( 'Footer Widgets', 'ci_theme'),
		'id' => 'footer-widgets',
		'description' => __( 'The widgets here will appear in the footer of your website.', 'ci_theme'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s group">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

}
endif;
?>
