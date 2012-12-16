<?php
/**
 * @package Essence
 * @since Essence 0.1
 */

global $woo_options; get_header(); ?>

	<div id="blog"><div class="gradient">
	
		<div class="divider">&nbsp;</div>
		
		<div class="container content">
				
			<h2><?php _e( 'Blog Entries', 'woothemes' ); ?></h2>
			
			<p class="desc"><?php bloginfo( 'description' ); ?></p>
			
			<?php get_template_part( 'includes/templates/loop', 'index' ); ?>
			
		</div>
	
	</div></div><!-- End #blog -->

<?php get_footer(); ?>