</div> <!-- #main -->

<footer id="footer">
	<div class="pat-bg"></div>
	<div class="wrap">
		<div class="footer-top">
			<div class="footer-top-wrap group">
				<span class="footer-top-bg"></span>
				<div class="footer-top-widgets group">
					<?php dynamic_sidebar('footer-widgets-emphasis'); ?>
				</div> <!-- .footer-top-widgets -->
			</div> <!-- .footer-top-wrap -->
		</div> <!-- .footer-top -->

		<div class="footer-bottom group">
			<?php dynamic_sidebar('footer-widgets'); ?>
		</div> <!-- .footer-bottom -->
	</div> <!-- .wrap -->

	<div class="footer-copy">
		<div class="wrap group">
			<div class="siteinfo alignleft">
				<a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?>.</a><span class="foot-addr"><?php ci_e_setting('business_address'); ?></span>
			</div>

			<div class="sitecopy alignright">
				<?php echo ci_footer(); ?>
			</div>
		</div> <!-- .wrap -->
	</div> <!-- .footer-copy -->
</footer>

<?php wp_footer(); ?>

</body>
</html>
