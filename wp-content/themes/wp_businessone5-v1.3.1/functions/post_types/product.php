<?php
//
// Product Post Type related functions.
//
add_action('init', 'ci_create_cpt_product');
add_action('admin_init', 'ci_add_cpt_product_meta');
add_action('save_post', 'ci_update_cpt_product_meta');

if( !function_exists('ci_create_cpt_product') ):
function ci_create_cpt_product() {
	$labels = array(
		'name' => _x('Products', 'post type general name', 'ci_theme'),
		'singular_name' => _x('Product', 'post type singular name', 'ci_theme'),
		'add_new' => __('New Product', 'ci_theme'),
		'add_new_item' => __('Add New Product', 'ci_theme'),
		'edit_item' => __('Edit Product', 'ci_theme'),
		'new_item' => __('New Product', 'ci_theme'),
		'view_item' => __('View Product', 'ci_theme'),
		'search_items' => __('Search Products', 'ci_theme'),
		'not_found' =>  __('No Products found', 'ci_theme'),
		'not_found_in_trash' => __('No Products found in the trash', 'ci_theme'), 
		'parent_item_colon' => __('Parent Product:', 'ci_theme')
	);

	$args = array(
		'labels' => $labels,
		'singular_label' => __('Product', 'ci_theme'),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'has_archive' => true,
		'rewrite' => true,
		'menu_position' => 5,
/* 		'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats')  */
		'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'revisions', 'page-attributes') 
	);

	register_post_type( 'product' , $args );
}
endif;

if( !function_exists('ci_add_cpt_product_meta') ):
function ci_add_cpt_product_meta(){
	add_meta_box("ci_cpt_product_meta", __('Product Details', 'ci_theme'), "ci_add_cpt_product_meta_box", "product", "normal", "high");
}
endif;

if( !function_exists('ci_update_cpt_product_meta') ):
function ci_update_cpt_product_meta($post_id){
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
	if (isset($_POST['post_view']) and $_POST['post_view']=='list') return;

	if (isset($_POST['post_type']) && $_POST['post_type'] == "product")
	{

	}
}
endif;

if( !function_exists('ci_add_cpt_product_meta_box') ):
function ci_add_cpt_product_meta_box(){
	global $post;
	?>
	
	<p><?php _e('You should upload images of your product. You need to upload at least 2 images on this product for a working image slider. You should also upload and/or select a Featured Image, so that it will be used as the cover image of the product.', 'ci_theme'); ?></p>
	<input type="button" class="button ci-upload" value="<?php _e('Upload', 'ci_theme'); ?>" />
	<?php
}
endif;

//
// Product post type custom admin list
//
add_filter("manage_edit-product_columns", "ci_cpt_product_edit_columns");  
add_action("manage_posts_custom_column",  "ci_cpt_product_custom_columns");  

if( !function_exists('ci_cpt_product_edit_columns') ):
function ci_cpt_product_edit_columns($columns){  
	$columns = array(  
		"cb" => "<input type=\"checkbox\" />",  
		"title" => __('Product Name', 'ci_theme'),  
		"product_category" => __('Categories', 'ci_theme')
	);  
	
	return $columns;  
}  
endif;
  
if( !function_exists('ci_cpt_product_custom_columns') ):
function ci_cpt_product_custom_columns($column){  
	global $post;  
	switch ($column)  
	{  
		case "product_category": 
			$terms = wp_get_post_terms($post->ID, 'product_category'); 
			$list='';
			foreach($terms as $term)
			{
				$list .= $term->name.'<br />';
			}
			$list = substr($list, 0, -6);
			echo $list;
		break;  
	}  
} 
endif;

?>
