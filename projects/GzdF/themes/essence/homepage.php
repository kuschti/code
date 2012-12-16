<?php
/**
 * @package Essence
 * @since Essence 0.1
 */

/*
Template Name: Homepage
*/
 
get_header(); 

global $woo_options; 

	get_template_part( 'page-start', 'home' ); 


	/*
	
	if( $woo_options[ 'woo_portfolio_show' ] == "true" )
		get_template_part( 'includes/templates/portfolio', 'home' ); 
	
	
	if( $woo_options[ 'woo_offer_show' ] == "true" )
		get_template_part( 'includes/templates/offer', 'home' ); 

	if( $woo_options[ 'woo_blog_show' ] == "true" )
		get_template_part( 'includes/templates/blog', 'home' );
		
	if( $woo_options[ 'woo_team_show' ] == "true" )
		get_template_part( 'includes/templates/team', 'home' );
	
	if( $woo_options[ 'woo_dribbble_show' ] == "true" )
		get_template_part( 'includes/templates/dribbble', 'home' ); 
	
	if( $woo_options[ 'woo_twitter_show' ] == "true" )
		get_template_part( 'includes/templates/twitter', 'home' ); 
	
	if( $woo_options[ 'woo_contact_show' ] == "true" )
		get_template_part( 'includes/templates/contact', 'home' ); 
	
	*/	

get_footer();