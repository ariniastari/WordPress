<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	add_filter('ci_panel_tabs', 'ci_add_tab_product_options', 20);
	if( !function_exists('ci_add_tab_product_options') ):
		function ci_add_tab_product_options($tabs) 
		{ 
			$tabs[sanitize_key(basename(__FILE__, '.php'))] = __('Product Options', 'ci_theme'); 
			return $tabs; 
		}
	endif;

	// Default values for options go here.
	// $ci_defaults['option_name'] = 'default_value';
	// or
	// load_panel_snippet( 'snippet_name' );

	$ci_defaults['offers_label'] 				= __('Offers', 'ci_theme');
	$ci_defaults['offers_url'] 					= '#';

	$ci_defaults['product_preview_height']		= "290";
	$ci_defaults['product_show_no_photo']		= "enabled";

	$ci_defaults['show_related_products']		= 'enabled';

	$ci_defaults['product_slider_autoslide'] 	= 'enabled';
	$ci_defaults['product_slider_timeout'] 		= 3000;
	$ci_defaults['product_slider_speed'] 		= 500;
	$ci_defaults['product_slider_effect'] 		= 'fade';
	$ci_defaults['product_slider_sync'] 		= 'enabled';

	// Inject the offers link into the top menu.
	add_filter('wp_nav_menu', 'ci_add_offers_to_top_menu', 10, 2);
	function ci_add_offers_to_top_menu($nav_menu, $args)
	{
		
		if($args->theme_location=='ci_top_menu')
		{
			$offers_url = ci_setting('offers_url');
			if(!empty($offers_url))
			{
				$last_ul = strrpos($nav_menu, '</ul>');
				$nav_menu2 = substr($nav_menu, 0, $last_ul);
				$nav_menu2 .= '<li class="rbn-link"><a href="'.esc_attr(ci_setting('offers_url')).'">'.ci_setting('offers_label').'</a></li></ul>';
				return $nav_menu2;
			}
		}

		return $nav_menu;
	}


?>
<?php else: ?>

	<fieldset class="set">
		<p class="guide"><?php _e('There is a special Offers link that can be displayed on top of your website, alongside with the "Top Menu" automatically. You can create such a menu from Appearance -> Menus. Set here the URL (and the label) of your offers page. This may be any any URL. Ideally, you will set it to the URL of a specific products\' category which you will have created and named accordingly. Leaving the URL blank disables the Offers link.', 'ci_theme'); ?></p>
		<?php ci_panel_input('offers_label', __('Offers page label', 'ci_theme')); ?>
		<?php ci_panel_input('offers_url', __('Offers page URL', 'ci_theme')); ?>
	</fieldset>

	<fieldset class="set">
		<p class="guide"><?php _e('This option controls the height (in pixels) of the images appearing on the slider of each individual product page. If you set this option to <strong>0</strong>, images will be resized proportionally. If you set it to any other integer number, the image will be automatically cropped to fit. In any case, the slider will be automatically resized to accommodate each image.', 'ci_theme'); echo " "; _e('Note that if you change the width and/or the height of the product image, you will need to regenerate all your thumbnails using an appropriate plugin, such as the <a href="http://wordpress.org/extend/plugins/regenerate-thumbnails/" target="_blank">Regenerate Thumbnails</a> plugin, otherwise your images may appear distorted.', 'ci_theme'); ?></p>
		<?php ci_panel_input('product_preview_height', __('Product slider height', 'ci_theme')); ?>
		<?php ci_panel_checkbox('product_show_no_photo', 'enabled', __('Show "Product Photo Not Available" image', 'ci_theme')); ?>
	</fieldset>

	<fieldset class="set">
		<p class="guide"><?php _e('You can enable or disable the "Similar Products" section that appears on each product\'s page, just below the content.' , 'ci_theme'); ?></p>
		<?php ci_panel_checkbox('show_related_products', 'enabled', __('Show Similar Products', 'ci_theme')); ?>
	</fieldset>


	<fieldset class="set">
		<p class="guide"><?php _e('The following options control the internal slider. You may enable auto-sliding by checking the appropriate option, or by setting the auto-slide timeout to a value grater than 0. A demo of the transition effects can be seen <a href="http://jquery.malsup.com/cycle/browser.html">here</a>.' , 'ci_theme'); ?></p>
		<fieldset>
			<?php ci_panel_checkbox('product_slider_autoslide', 'enabled', __('Enable auto-slide', 'ci_theme')); ?>
		</fieldset>
		<fieldset>
			<?php ci_panel_input('product_slider_timeout', __('Auto-slide timeout (milliseconds)', 'ci_theme')); ?>
		</fieldset>
		<fieldset>
			<?php 
				$slider_effects = array(
					'none' => _x('None', 'slider effect', 'ci_theme'),
					'cover' => _x('Cover', 'slider effect', 'ci_theme'),
					'uncover' => _x('Uncover', 'slider effect', 'ci_theme'),
					'fade' => _x('Fade', 'slider effect', 'ci_theme'),
					'fadeZoom' => _x('Fade Zoom', 'slider effect', 'ci_theme'),
					'shuffle' => _x('Shuffle', 'slider effect', 'ci_theme'),
					'toss' => _x('Toss', 'slider effect', 'ci_theme'),
					'wipe' => _x('Wipe', 'slider effect', 'ci_theme'),
					'zoom' => _x('Zoom', 'slider effect', 'ci_theme'),
					'scrollVert' => _x('Scroll Vertically', 'slider effect', 'ci_theme'),
					'scrollHorz' => _x('Scroll Horizontally', 'slider effect', 'ci_theme'),
					'scrollLeft' => _x('Scroll Left', 'slider effect', 'ci_theme'),
					'scrollRight' => _x('Scroll Right', 'slider effect', 'ci_theme'),
					'scrollUp' => _x('Scroll Up', 'slider effect', 'ci_theme'),
					'scrollDown' => _x('Scroll Down', 'slider effect', 'ci_theme'),
					'blindX' => _x('Blind X', 'slider effect', 'ci_theme'),
					'blindY' => _x('Blind Y', 'slider effect', 'ci_theme'),
					'blindZ' => _x('Blind Z', 'slider effect', 'ci_theme'),
					'curtainX' => _x('Curtain X', 'slider effect', 'ci_theme'),
					'curtainY' => _x('Curtain Y', 'slider effect', 'ci_theme'),
					'growX' => _x('Grow X', 'slider effect', 'ci_theme'),
					'growY' => _x('Grow Y', 'slider effect', 'ci_theme'),
					'slideX' => _x('Slide X', 'slider effect', 'ci_theme'),
					'slideY' => _x('Slide Y', 'slider effect', 'ci_theme'),
					'turnUp' => _x('Turn Up', 'slider effect', 'ci_theme'),
					'turnDown' => _x('Turn Down', 'slider effect', 'ci_theme'),
					'turnLeft' => _x('Turn Left', 'slider effect', 'ci_theme'),
					'turnRight' => _x('Turn Right', 'slider effect', 'ci_theme')
				);
				ci_panel_dropdown('product_slider_effect', $slider_effects, __('Slider Effect', 'ci_theme'));
			?>
		</fieldset>
		<fieldset>
			<?php ci_panel_input('product_slider_speed', __('Slideshow speed in milliseconds (smaller number means faster)', 'ci_theme')); ?>
		</fieldset>
		<fieldset>
			<?php ci_panel_checkbox('product_slider_sync', 'enabled', __('Enable synchronized sliding', 'ci_theme')); ?>
		</fieldset>
	</fieldset>
	
<?php endif; ?>
