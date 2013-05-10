<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	add_filter('ci_panel_tabs', 'ci_add_tab_business_options', 20);
	if( !function_exists('ci_add_tab_business_options') ):
		function ci_add_tab_business_options($tabs) 
		{ 
			$tabs[sanitize_key(basename(__FILE__, '.php'))] = __('Business Options', 'ci_theme'); 
			return $tabs; 
		}
	endif;

	// Default values for options go here.
	// $ci_defaults['option_name'] = 'default_value';
	// or
	// load_panel_snippet( 'snippet_name' );

	$ci_defaults['contact_page'] = '';
	$ci_defaults['business_phone'] = '800 11 80 80 80';
	$ci_defaults['business_address'] = 'Park Avenue &amp 42nd Street, 10111, New York City';

?>
<?php else: ?>

	<fieldset class="set">
		<p class="guide"><?php _e('The following information is used throughout the website, on every page\'s header and footer.', 'ci_theme'); ?></p>
		<?php ci_panel_input('business_phone', __('Phone number', 'ci_theme')); ?>
		<?php ci_panel_input('business_address', __('Address (in one line)', 'ci_theme')); ?>
		<fieldset>
			<?php $fieldname = 'contact_page'; ?>
			<label for="<?php echo THEME_OPTIONS.'['.$fieldname.']'; ?>"><?php _e('Select the page that is used as the contact page', 'ci_theme'); ?></label>
			<?php wp_dropdown_pages(array(
				'selected'=>$ci[$fieldname],
				'show_option_none'=>" ",
				'name'=>THEME_OPTIONS.'['.$fieldname.']'
			)); ?>
		</fieldset>
	</fieldset>
	
<?php endif; ?>
