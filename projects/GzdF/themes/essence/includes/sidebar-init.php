<?php
/**
 * @package Essence
 * @since Essence 0.1
 */

/** Register sidebars by running the_widgets_init() on the init hook. */
add_action( 'init', 'the_widgets_init' );

if ( ! function_exists( 'the_widgets_init' ) ):
/**
 * Register Sidebar widgets.
 *
 * @uses register_sidebar
 * @since Essence 0.1
 */
function the_widgets_init() 
{
	/** No widgets here! */
}
endif;