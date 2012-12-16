<?php

add_action('init','woo_global_options');
function woo_global_options() {
	// Populate WooThemes option in array for use in theme
	global $woo_options;
	$woo_options = get_option('woo_options');
}

add_action('admin_head','woo_options');  
if (!function_exists('woo_options')) {
function woo_options(){
  
// VARIABLES
$themename = "Essence";
$manualurl = 'http://www.woothemes.com/support/theme-documentation/essence/';
$shortname = "woo";

$GLOBALS['template_path'] = get_bloginfo('template_directory');

//Access the WordPress Categories via an Array
$woo_categories = array();  
$woo_categories_obj = get_categories('hide_empty=0');
foreach ($woo_categories_obj as $woo_cat) {
    $woo_categories[$woo_cat->cat_ID] = $woo_cat->cat_name;}
$categories_tmp = array_unshift($woo_categories, "Select a category:");    
       
//Access the WordPress Pages via an Array
$woo_pages = array();
$woo_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($woo_pages_obj as $woo_page) {
    $woo_pages[$woo_page->ID] = $woo_page->post_name; }
$woo_pages_tmp = array_unshift($woo_pages, "Select a page:");       

// Image Alignment radio box
$options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 

// Image Links to Options
$options_image_link_to = array("image" => "The Image","post" => "The Post"); 

//Testing 
$options_select = array("one","two","three","four","five"); 
$options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five"); 

//URL Shorteners
if (_iscurlinstalled()) {
  $options_select = array("Off","TinyURL","Bit.ly");
  $short_url_msg = 'Select the URL shortening service you would like to use.'; 
} else {
  $options_select = array("Off");
  $short_url_msg = '<strong>cURL was not detected on your server, and is required in order to use the URL shortening services.</strong>'; 
}

//Stylesheets Reader
$alt_stylesheet_path = TEMPLATEPATH . '/styles/';
$alt_stylesheets = array();

if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}

//More Options
$all_uploads_path = get_bloginfo('home') . '/wp-content/uploads/';
$all_uploads = get_option('woo_uploads');
$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");

// THIS IS THE DIFFERENT FIELDS
$options = array();   

$options[] = array( "name" => "General Settings",
                    "type" => "heading",
					"icon" => "general");

$options[] = array( "name" => "Custom Logo",
					"desc" => "Upload a logo for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png)",
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "upload");    
                                                                                     
$options[] = array( "name" => "Text Title",
					"desc" => "Enable if you want Blog Title and Tagline to be text-based. Setup title/tagline in WP -> Settings -> General.",
					"id" => $shortname."_texttitle",
					"std" => "false",
					"type" => "checkbox");

$options[] = array( "name" => "Custom Favicon",
					"desc" => "Upload a 16px x 16px Png/Gif image that will represent your website's favicon.",
					"id" => $shortname."_custom_favicon",
					"std" => "",
					"type" => "upload"); 
                                               
$options[] = array( "name" => "Tracking Code",
					"desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea"); 			

$options[] = array( "name" => "Facebook",
					"desc" => "Your Facebook name. <em>http://facebook.com/this_field</em>",
					"id" => $shortname."_facebook",
					"std" => "",
					"type" => "text");
										
$options[] = array( "name" => "Flickr ID",
					"desc" => "Your facebook ID. <a href='http://idgettr.com/'>idGettr</a>",
					"id" => $shortname."_flickr",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => "RSS URL",
					"desc" => "Enter your preferred RSS URL. (Feedburner or other)",
					"id" => $shortname."_feed_url",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Custom CSS",
                    "desc" => "Quickly add some CSS to your theme by adding it to this block.",
                    "id" => $shortname."_custom_css",
                    "std" => "",
                    "type" => "textarea");		

$options[] = array( "name" => "Portfolio Settings",
				    "type" => "heading",
					"icon" => "portfolio"); 	

$options[] = array( "name" => "Show on Homepage?",
					"desc" => "Should the portfolio section be shown on the homepage?",
					"id" => $shortname."_portfolio_show",
					"std" => "true",
					"type" => "checkbox"); 

$options[] = array( "name" => "Portfolio Page",
					"desc" => "Create a page, and apply the 'Portfolio' Page template. Select it here.",
					"id" => $shortname."_portfolio_page",
					"std" => "",
					"type" => "select",
					"options" => $woo_pages);
					
$options[] = array( "name" => "Portfolio Description",
					"desc" => "A brief excerpt about your portfolio.",
					"id" => $shortname."_portfolio_desc",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => "What We Offer Settings",
				    "type" => "heading",
					"icon" => "slider"); 	

$options[] = array( "name" => "Show on Homepage?",
					"desc" => "Should the 'What We Offer' section be shown on the homepage?",
					"id" => $shortname."_offer_show",
					"std" => "true",
					"type" => "checkbox"); 

$options[] = array( "name" => "Offer Page",
					"desc" => "Create a page, and apply the 'What we Offer' Page template. Select it here.",
					"id" => $shortname."_offer_page",
					"std" => "",
					"type" => "select",
					"options" => $woo_pages);
					
$options[] = array( "name" => "Offer Description",
					"desc" => "A brief excerpt about what you offer.",
					"id" => $shortname."_offer_desc",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => "Blog",
				    "type" => "heading",
					"icon" => "homepage"); 	

$options[] = array( "name" => "Show on Homepage?",
					"desc" => "Should the Blog section be shown on the homepage?",
					"id" => $shortname."_blog_show",
					"std" => "true",
					"type" => "checkbox"); 
					
$options[] = array( "name" => "Blog Description",
					"desc" => "A brief excerpt about what the Blog.",
					"id" => $shortname."_blog_desc",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => "The Team",
				    "type" => "heading",
					"icon" => "homepage"); 	

$options[] = array( "name" => "Show on Homepage?",
					"desc" => "Should the 'The Team' section be shown on the homepage?",
					"id" => $shortname."_team_show",
					"std" => "true",
					"type" => "checkbox"); 

$options[] = array( "name" => "Team Page",
					"desc" => "Create a page, and apply the 'Team' Page template. Select it here.",
					"id" => $shortname."_team_page",
					"std" => "",
					"type" => "select",
					"options" => $woo_pages);
					
$options[] = array( "name" => "The Team Description",
					"desc" => "A brief excerpt about the team.",
					"id" => $shortname."_team_desc",
					"std" => "",
					"type" => "textarea");	

$options[] = array( "name" => "Dribbble",
				    "type" => "heading",
					"icon" => "homepage"); 	

$options[] = array( "name" => "Show on Homepage?",
					"desc" => "Should the the Dribbble section be shown on the homepage?",
					"id" => $shortname."_dribbble_show",
					"std" => "true",
					"type" => "checkbox"); 
					
$options[] = array( "name" => "Dribbble Username",
					"desc" => "Your Dribbble username. <em>http://dribbble.com/player/this_field</em>",
					"id" => $shortname."_dribbble",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => "Dribbble Title",
					"desc" => "The title of the Dribbble section.",
					"id" => $shortname."_dribbble_title",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => "Dribbble Description",
					"desc" => "A brief excerpt about your shots.",
					"id" => $shortname."_dribbble_desc",
					"std" => "",
					"type" => "textarea");			

$options[] = array( "name" => "Twitter",
				    "type" => "heading",
					"icon" => "homepage"); 	

$options[] = array( "name" => "Show on Homepage?",
					"desc" => "Should the the Twitter section be shown on the homepage?",
					"id" => $shortname."_twitter_show",
					"std" => "true",
					"type" => "checkbox"); 
					
$options[] = array( "name" => "Twitter",
					"desc" => "Your Twitter handle. <em>http://twitter.com/this_field</em>",
					"id" => $shortname."_tweet",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => "Twitter Title",
					"desc" => "The title of the Twitter section.",
					"id" => $shortname."_twitter_title",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => "Twitter Description",
					"desc" => "A brief excerpt about your tweets.",
					"id" => $shortname."_twitter_desc",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => "Contact",
				    "type" => "heading",
					"icon" => "homepage"); 	

$options[] = array( "name" => "Show on Homepage?",
					"desc" => "Should the the contact section be shown on the homepage?",
					"id" => $shortname."_contact_show",
					"std" => "true",
					"type" => "checkbox"); 
					
$options[] = array( "name" => "Contact Form E-Mail",
				  "desc" => "Enter your E-mail address to use on the Contact Form.",
				  "id" => $shortname."_contactform_email",
				  "std" => "",
				  "type" => "text");	
					
$options[] = array( "name" => "Contact Title",
					"desc" => "The title of the Contact section.",
					"id" => $shortname."_contact_title",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => "Contact Description",
					"desc" => "A brief excerpt about your contact area.",
					"id" => $shortname."_contact_desc",
					"std" => "",
					"type" => "textarea");					
 					                   
$options[] = array( "name" => "Dynamic Images",
				    "type" => "heading",
					"icon" => "image");  
				   
$options[] = array( "name" => "Enable WordPress Post Images Support",
					"desc" => "Use WordPress 2.9+ built in thumbnail/post-image support.",
					"id" => $shortname."_post_image_support",
					"std" => "true",
					"type" => "checkbox"); 						   

$options[] = array( "name" => "Add thumbnail to RSS feed",
					"desc" => "Add the the image uploaded via your Custom Settings to your RSS feed",
					"id" => $shortname."_rss_thumb",
					"std" => "false",
					"type" => "checkbox");  

update_option('woo_template',$options);      
update_option('woo_themename',$themename);   
update_option('woo_shortname',$shortname);
update_option('woo_manual',$manualurl);

update_option( 'framework_woo_backend_header_image', get_template_directory_uri() . '/images/framework-logo.png' );
update_option( 'framework_woo_backend_icon', get_template_directory_uri() . '/images/icon.png' );
                                     
// Woo Metabox Options
$woo_metaboxes = array();

if( get_post_type() == 'portfolio2' )
{					
	$woo_metaboxes[] = array(	
		"name" => "the_meta",
		"std" => "",
		"label" => "Portfolio Meta",
		"type" => "textarea",
		"desc" => "An arbitrary area to the left of the portfolio content. Use HTML if needed."
	);
	
	$woo_metaboxes[] = array(	
		"name" => "live",
		"std" => "",
		"label" => "Live Project",
		"type" => "text",
		"desc" => "A link to the live project. <code>http://</code>"
	);
}

    
update_option('woo_custom_template',$woo_metaboxes);      

}
}

?>