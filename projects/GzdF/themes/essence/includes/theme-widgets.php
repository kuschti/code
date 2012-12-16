<?php

/*---------------------------------------------------------------------------------*/
/* Loads all the .php files found in /includes/widgets/ directory */
/*---------------------------------------------------------------------------------*/

	$preview_template = _preview_theme_template_filter();

	if(!empty($preview_template)){
		$woo_widgets_dir = WP_CONTENT_DIR . "/themes/".$preview_template."/includes/widgets/";
	} else {
    	$woo_widgets_dir = WP_CONTENT_DIR . "/themes/".get_option('template')."/includes/widgets/";
    }
    
    if (@is_dir($woo_widgets_dir)) {
		$woo_widgets_dh = opendir($woo_widgets_dir);
		while (($woo_widgets_file = readdir($woo_widgets_dh)) !== false) {
  	
			if(strpos($woo_widgets_file,'.php') && $woo_widgets_file != "widget-blank.php") {
				include_once($woo_widgets_dir . $woo_widgets_file);
			
			}
		}
		closedir($woo_widgets_dh);
	}
	
	
/*---------------------------------------------------------------------------------*/
/* Deregister Default Widgets */
/*---------------------------------------------------------------------------------*/
if (!function_exists('woo_deregister_widgets')) {
	function woo_deregister_widgets(){
	    unregister_widget('WP_Widget_Search');         
	}
}
add_action('widgets_init', 'woo_deregister_widgets');  


?>