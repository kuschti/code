<?php
/**
 * @package Essence
 * @since Essence 0.1
 */
 
global $woo_options; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'woothemes' ), max( $paged, $page ) );

	?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<?php wp_head(); ?>
	<?php woo_head(); ?>
	
	<script type="text/javascript">
		jQuery(function($){
			$(window).load(function() {
		    	$('#slider').nivoSlider({
		        effect:'fold', // Specify sets like: 'fold,fade,sliceDown'
		        boxCols: 8, // For box animations
		        boxRows: 10, // For box animations
		        animSpeed:300, // Slide transition speed
		        pauseTime:3000, // How long each slide will show
		        startSlide:0, // Set starting Slide (0 index)
		        directionNav:false, // Next & Prev navigation
		        controlNav:false, // 1,2,3... navigation
		        pauseOnHover:true, // Stop animation while hovering
		    	});
			});
		});	
			
	</script>
</head>
<body <?php body_class(); ?>>

	<?php woo_top(); ?>
	
	<div id="startseite" class="gradient">
	
		<div class="container">
	
			<div id="branding" role="banner">
				<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
				<<?php echo $heading_tag; ?> id="sitetitle"><a href="<?php echo home_url( '/' ); ?>">
					<?php if (get_option('woo_texttitle') <> "true") : $logo = get_option('woo_logo'); ?>
						<img src="<?php if ($logo) echo $logo; else { bloginfo('template_directory'); ?>/images/logo.png<?php } ?>" alt="<?php bloginfo('name'); ?>" />
					<?php else : ?> 
						<?php bloginfo( 'name' ); ?>
					<?php endif; ?>
				</a></<?php echo $heading_tag; ?>> 
			</div>
			
			<div id="page-meta">				
				<?php //get_search_form(); ?>
				<?php get_template_part( '/includes/templates/social' ); ?>
			</div>
					
		</div><!-- End .container -->
	
	</div><!-- End #top -->
	
	<div id="fixed-navigation-container">
		
		<div class="container">
		
			<div id="fixed-navigation" role="navigation">
			
				<div class="inner">
			
					<?php $walker = new Essence_Walker; wp_nav_menu( array( 'walker' => $walker ) ); ?>
					
					<?php if( is_front_page() ) : ?>
					
					<div class="up-down">
						<a href="#" class="down"><?php _e( 'Down', 'woothemes' ); ?></a>
						<a href="#" class="up disabled"><?php _e( 'Up', 'woothemes' ); ?></a>
					</div>
					
					<?php endif; ?>
					
				</div>
				
			</div>
		
		</div>
	
	</div><!-- End #fixed-navigation -->