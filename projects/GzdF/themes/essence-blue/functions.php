<?php 

// get scripts
add_action('wp_enqueue_scripts','theme_name_scripts_function');
function theme_name_scripts_function() {
// use Google JS script
   //wp_deregister_script('jquery');
   //wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"), false, '1.4.2');
   //wp_enqueue_script('jquery');

// include nivoslider JS
   wp_enqueue_script('nivoSlider', get_stylesheet_directory_uri() . '/js/jquery.nivo.slider.pack.js', array( 'jquery' ));
}

?>