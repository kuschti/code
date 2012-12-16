<?php global $woo_options; ?>

	<div id="blog" class="section"><div class="gradient">
	
		<div class="divider">&nbsp;</div>
		
		<div class="container content">
		
			<h2><?php _e( 'Blog Entries', 'woothemes' ); ?></h2>
			
			<p class="desc"><?php bloginfo( 'description' ); ?></p>
			
			<?php get_template_part( 'includes/templates/loop', 'home' ); ?>
			
			<a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="button"><span><?php _e( 'Explore The Blog &nbsp;&rarr;', 'woothemes' ); ?></span></a>
	
			
		</div>
	
	</div></div><!-- End #blog -->