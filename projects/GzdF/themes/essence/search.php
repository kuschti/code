<?php
/**
 * @package Essence
 * @since Essence 0.1
 */

global $woo_options; get_header(); ?>

	<div id="blog"><div class="gradient">
	
		<div class="divider">&nbsp;</div>
		
		<div class="container content">
				
			<h1 class="page-title"><?php printf( __( 'Search Results: %s', 'woothemes' ), get_search_query() ); ?></h1>
						
			<p class="desc"><?php bloginfo( 'description' ); ?></p>
			
			<?php get_template_part( 'includes/templates/loop', 'search' ); ?>
			
		</div>
	
	</div></div><!-- End #blog -->

<?php get_footer(); ?>