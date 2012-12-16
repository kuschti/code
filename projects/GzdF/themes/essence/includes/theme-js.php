<?php
/**
 * @package Essence
 * @since Essence 0.1
 */

if( !is_admin() )  
{
	/** Tell WordPress to run the 'woothemes_add_javascript' action when wp_print_scripts is run. */
	add_action( 'wp_print_scripts', 'woothemes_add_javascript' );
	
	/** Tell WordPress to run the 'woothemes_add_styles' action when wp_print_styles is run. */
	add_action( 'wp_print_styles', 'woothemes_add_styles' );
	
	/** Tell WordPress to run woo_sort_results_js() when the 'wp_footer' hook is run. */ 
	add_action( 'wp_footer', 'woo_sort_results_js' );
}

/**
 * Enqueue the javascript files the theme depends on.
 *
 * @since Essence 0.1
 */
function woothemes_add_javascript() 
{
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jCarousellite', get_template_directory_uri() . '/includes/js/jquery.jcarousellite.js', array( 'jquery' ) );
	wp_enqueue_script( 'jquery.scrollTo.js', get_template_directory_uri() . '/includes/js/jquery.scrollTo.js', array( 'jquery' ) );
	wp_enqueue_script( 'jQuery Functions', get_template_directory_uri() . '/includes/js/jquery.custom.js', array( 'jquery' ) );
	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/includes/js/scripts.js', array( 'jquery' ) );
	
	
	if( is_single() )
		wp_enqueue_script( 'comment-reply' );
}


/**
 * Load custom styles.
 *
 * @since Essence 0.1
 */
function woothemes_add_styles() 
{		
	wp_enqueue_style( 'Fonts', get_template_directory_uri() . '/includes/fonts/stylesheet.css' );
}

/**
 * Create a variable linking to the Admin AJAX URL. 
 * Add it to the footer of the page.
 *
 * @since Essence 0.1
 */
function woo_sort_results_js() 
{
	echo'<script type="text/javascript" charset="utf-8">
		/* <![CDATA[ */	
		var load_ajax = "' . admin_url( 'admin-ajax.php' ) .'";
		var permalink = document.URL;
		/* ]]> */
	</script>';
}