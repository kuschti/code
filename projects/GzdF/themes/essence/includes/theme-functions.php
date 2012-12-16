<?php
/**
 * Diverse functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, woo_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'woo_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package Essence
 * @since Essence 0.1
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 637;

/** Tell WordPress to run diverse_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'woo_setup' );

if ( ! function_exists( 'woo_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override woo_setup() in a child theme, add your own diverse_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses add_image_size() To set extra thumbnail sizes.
 *
 * @since Essence 0.1
 */
function woo_setup() 
{ 
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	
	// Set image sizes for featured images.
	add_image_size( 'portfolio-thumb', 238, 324, true );
	add_image_size( 'portfolio-thumb2', 100, 100, true );
	add_image_size( 'portfolio-full', 762, 507, true );
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'woothemes' ),
		'footer' => __( 'Footer Navigation', 'woothemes' )
	) );
}
endif;

/** Tell WordPress to run woo_post_types() when the 'admin_menu' hook is run. */ 
add_action( 'init', 'woo_post_types' );

/**
 * Create custom post types.
 * 
 * To override woo_post_types() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @uses register_post_type
 * @since Knowledgebase 0.1
 */
function woo_post_types() 
{
	$portfolio_labels =  array(
		'name' => __( 'Galerien', 'woothemes' ),
		'singular_name' => __( 'Galerie', 'woothemes' ),
		'add_new' => __( 'Neue Galerie', 'woothemes' ),
		'add_new_item' => __( 'Neue Galerie', 'woothemes' ),
		'edit_item' => __( 'Galerie bearbeiten', 'woothemes' ),
		'view_item' => __( 'Galerie anschauen', 'woothemes' ),
		'search_items' => __( 'Galerien suchen', 'woothemes' ),
		'not_found' => __( 'Keine Galerien gefunden', 'woothemes' ),
		'not_found_in_trash' => __( 'No Portfolio items found in trash', 'woothemes' )
	);
	
	$portfolio_supports = array(
		'title', 'editor', 'thumbnail'
	);
		
	register_post_type( 'portfolio', array(
		'labels' => apply_filters( 'woo_portfolio_labels', $portfolio_labels ),
		'supports' => apply_filters( 'woo_portfolio_supports', $portfolio_supports ),
		'public' => true,
		'rewrite' => array(
			'slug' => 'was'
		),
		'menu_position' => 5
	) );
	
	/** Add excerpt support for pages. */
	add_post_type_support( 'page', array( 'excerpt' ) );
}

/** Register the introduction shortcode */
add_shortcode( 'intro', 'woo_shortcode_intro' );

/**
 * Wrap this paragaraph with the .intro class.
 *
 * @since Essence 0.1
 */
function woo_shortcode_intro( $atts, $content = null )
{
	return '<p class="intro">' . do_shortcode( $content ) . '</p>';
}

/** Register the "What We Offer" shortcode. */
add_shortcode( 'offer', 'woo_shortcode_offer' );

/**
 * Place this shortcode in the excerpt section when creating
 * the page. 
 *
 * @att title: The title of what you offer. Required.
 * @att icon: the URL to an icon next to the title. Required.
 * @att description: Describe what you offer. Required.
 *
 * @since Essence 0.1
 */
function woo_shortcode_offer( $atts, $content = null )
{
	extract( shortcode_atts( array(
		'title' => '',
		'icon' => '',
		'description' => ''
	), $atts ) );

	echo'<div class="offered">';
		echo'<h3>';
			if( $icon )
				echo'<img src="' . $icon . '" alt="' . $title . '" />';
				
			echo $title; 
		echo'</h3>';
		echo'<p>' . $description . '</p>';
	echo'</div>';
}

/** Register the The Team shortcode */
add_shortcode( 'the-team', 'woo_shortcode_team' );

/**
 * Place this shortcode in the excerpt section when creating
 * the page. 
 *
 * @att name: The name of the team member. Required.
 * @att job: The job the team member does. Required.
 * @att description: Describe what this job entails. Required.
 * @att image: A picture of said team member. Required.
 * @att url: A URL linking to that team mebers page. Optional.
 *
 * @since Essence 0.1
 */
function woo_shortcode_team( $atts, $content = null )
{
	extract( shortcode_atts( array(
		'name' => '',
		'job' => '',
		'description' => '',
		'image' => '',
		'url' => ''
	), $atts ) );
	
	echo'
	<li>
		<span class="pic">
			<img src="' . $image . '" alt="" />
		</span>
		
		<h4>' . $name . '</h4>
		<p>' . $description . '</p>
	</li>';
}

if ( ! function_exists( 'woo_dribbles' ) ):
/**
 * Grab the latest shots from the users Dribbble feed.
 * 
 * @since Essence 0.1
 */
function woo_dribbbles()
{
	global $woo_options;
	
	include_once( ABSPATH . WPINC . '/class-simplepie.php' );

	$shots = fetch_feed( sprintf( 'http://dribbble.com/players/%s/shots.rss', $woo_options[ 'woo_dribbble' ] ) );
	
	if( !is_wp_error( $shots ) )
	{
		$show = $shots->get_item_quantity( 6 );
		$shots_feed = $shots->get_items( 0, $show );
		
		return $shots_feed;
	}
		
	return false;
}
endif;

if ( ! function_exists( 'woo_get_tweets' ) ):
/**
 * Grab the latest tweets (in atom format) by a user.
 * Return an array of tweets.
 *
 * @since Essence 0.1
 */
function woo_get_tweets( $amount = 1, $offset = 0 )
{	
	global $woo_options;
	
	include_once( ABSPATH . WPINC . '/class-simplepie.php' );
	
	$tweets = fetch_feed( 'http://search.twitter.com/search.atom?q=+from%3A' . $woo_options[ 'woo_tweet' ] );
	//$tweets = fetch_feed( 'http://twitter.com/statuses/user_timeline/' . $woo_options[ 'woo_tweet' ] .'.rss' );
	
	if( !is_wp_error( $tweets ) )
	{
		$show = $tweets->get_item_quantity( $amount );
		$tweet_feed = $tweets->get_items( $offset, $show );
		
		return $tweet_feed;
	}
		
	return false;
}
endif;

/**
 * Modify the menu walker just a bit.
 * If you are not on the front page, remove the "scroll"
 * class from the links.
 *
 * @since Essence 0.1
 */
class Essence_Walker extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth, $args) 
	{
        global $wp_query, $woo_options;
		
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

		if( !is_front_page() )
			$class_names = str_replace( "scroll", "", $class_names );
		
        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>'; 
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

// Remove image dimensions from woo_get_image images 
update_option( 'woo_force_all',false );
update_option( 'woo_force_single',false );