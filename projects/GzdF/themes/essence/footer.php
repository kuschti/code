<?php
/**
 * @package Essence
 * @since Essence 0.1
 */

global $woo_options; ?>

	<div id="footer">

		<div class="divider">&nbsp;</div>
		
		<div class="container">
		
			<div id="footer-meta">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.jpg" alt="" />
				
				<div class="links">
					<?php //wp_nav_menu( array( 'sort_column' => 'menu_order', 'container_class' => 'footer-menu', 'menu_class' => 'footer-navigation', 'depth' => 1 ) ); ?>
					
					<p class="copyright"><?php printf( __( '&copy; 2010 %s', 'woothemes' ), get_bloginfo( 'name' ) ); ?></p>
					
				</div>
			
			</div>
			<div id="footer-right">
				<p class="by">Design & Entwicklung by <a href="http://www.pascalkuster.ch">pascalkuster.ch</a></p>
			</div>
		
			<?php get_template_part( '/includes/templates/social' ); ?>
		
		</div>
		
	</div><!-- End #footer -->
	
	<!-- <?php echo get_num_queries(); ?> queries. <?php timer_stop(1); ?> seconds. -->
	
	<?php wp_footer(); ?>
	
</body>
</html>