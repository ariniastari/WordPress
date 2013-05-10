<?php
//
// Product listing template meta box
//
add_action('admin_init', 'ci_add_page_product_listing_meta');
add_action('save_post', 'ci_update_page_product_listing_meta');

if( !function_exists('ci_add_page_product_listing_meta') ):
function ci_add_page_product_listing_meta(){
	add_meta_box("ci_page_product_listing_meta", __('Base Products Category', 'ci_theme'), "ci_add_page_product_listing_meta_box", "page", "normal", "high");
}
endif;

if( !function_exists('ci_update_page_product_listing_meta') ):
function ci_update_page_product_listing_meta($post_id){
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
	if (isset($_POST['post_view']) and $_POST['post_view']=='list') return;

	if (isset($_POST['post_type']) && $_POST['post_type'] == "page")
	{
		update_post_meta($post_id, "base_products_category", (isset($_POST["base_products_category"]) ? $_POST["base_products_category"] : '') );
	}
}
endif;

if( !function_exists('ci_add_page_product_listing_meta_box') ):
function ci_add_page_product_listing_meta_box(){
	global $post;
	$category = get_post_meta($post->ID, 'base_products_category', true);
	?>
	<p><?php _e('Select the base products category. Only items and sub-categories of the selected category will be displayed. If you don\'t select one (i.e. empty) all product categories will be shown. You need to select the <strong>Product Listing</strong> template for this option to work.', 'ci_theme'); ?></p>
	<?php wp_dropdown_categories(array(
		'selected'=>$category,
		'name' => 'base_products_category',
		'show_option_none' => ' ',
		'taxonomy' => 'product_category',
		'hierarchical' => 1,
		'show_count' => 1,
		'hide_empty' => 0
	)); ?>
	<?php
}
endif;

?>
