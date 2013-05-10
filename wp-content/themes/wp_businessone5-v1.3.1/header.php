<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<title><?php ci_e_title(); ?></title>

	<!-- JS files are loaded via /functions/scripts.php -->

	<!-- CSS files are loaded via /functions/styles.php -->	
	
	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<?php do_action('after_open_body_tag'); ?>


<div id="pre-head">
	<div class="wrap group">
		<?php 
			if(has_nav_menu('ci_top_menu'))
				wp_nav_menu( array(
					'theme_location' 	=> 'ci_top_menu',
					'fallback_cb' 		=> '',
					'container' 		=> '',
					'menu_id' 			=> 'top-navigation',
					'menu_class' 		=> 'pre-nav'
				));
		?>
	</div>
</div> <!-- #pre-head -->



<header id="header">
	<div class="wrap">
		<div class="mast-head group">

			<hgroup class="logo <?php logo_class(); ?>">
				<?php ci_e_logo('<h1 class="logo">', '</h1>'); ?>
				<?php ci_e_slogan('<span>', '</span>'); ?>
			</hgroup>

			<?php if(ci_setting('business_phone')): ?>
				<a href="<?php echo get_permalink(ci_setting('contact_page')); ?>" class="c-tel"><?php ci_e_setting('business_phone'); ?></a>
			<?php endif; ?>
		</div> <!-- .mast-head -->

		<nav id="nav">
			<span class="left-rbn"></span>
			<div class="nav-inner">
				<?php 
					if(has_nav_menu('ci_main_menu'))
						wp_nav_menu( array(
							'theme_location' 	=> 'ci_main_menu',
							'fallback_cb' 		=> '',
							'container' 		=> '',
							'menu_id' 			=> 'navigation',
							'menu_class' 		=> 'group'
						));
					else
						wp_page_menu(array('menu_class'=>''));
				?>
			</div>
			<span class="right-rbn"></span>
		</nav>
	</div> <!-- .wrap -->
</header>

<?php 
	if(is_page_template('template-front.php') or is_home())
	{
		get_template_part('slider');
	}
?>

<div id="main">
