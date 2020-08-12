<?php
/**
* Plugin Name: Emojify White Label WordPress Admin Theme
* Plugin URI: https://jeffmonteiro.gitbook.io/ewlwat/
* Description: Turn your WordPress Admin Interface more clean, friendly and actual using this plugin. To get a more fun interface, you can enable this theme to use emojis to replace dashicons! ;)
* Author: Jeff Monteiro
* Version: 0.1.0
* Author URI: https://www.linkedin.com/in/jeffmonteiro 
* Text Domain: ewlwat
* Domain Path: /languages/
*
* @package ewlwat
* @version 0.1.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// options framework

require_once( plugin_dir_path(__FILE__) . 'inc/class-boo-settings-helper.php');
require_once( plugin_dir_path(__FILE__) . 'inc/plugin-settings.php');


/**
* Applying options to Admin Theme
*/

function ewlwat_load_options(){

	$options 			= wp_load_alloptions();

	$emojify 			= isset($options['ewlwat_emojify']) ? $options['ewlwat_emojify'] : 0 ;
	$hide_wp 			= isset($options['ewlwat_hide_wp_logo']) ? $options['ewlwat_hide_wp_logo'] : 0;
	$hide_version = isset($options['ewlwat_hide_wp_version']) ? $options['ewlwat_hide_wp_version'] : 0;
	$brand_icon 	= isset($options['ewlwat_brand_favicon']) ? $options['ewlwat_brand_favicon'] : 0;


	// Add emojify class to body

	if ( $emojify ):
		add_filter( 'admin_body_class', 'ewlwat_add_body_class'); 
	endif;

	// Hide WP logo from admin bar

	if ( $hide_wp ):
		add_action( 'wp_before_admin_bar_render', 'ewlwat_remove_wp', 0 );
	endif;

}
add_filter('init', 'ewlwat_load_options');



/**
* Adding ewlwat class to body
*/

function ewlwat_add_body_class(){
	return 'ewlwat-emojify';
}

/**
* Hide WP logo from admin bar
*/

function ewlwat_remove_wp() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_node( 'wp-logo' );
}

/**
* Add Custom Logo to Admin Bar
*/

function ewlwat_custom_brand_admin() {
	
	$options 			= wp_load_alloptions();
	
	$brand_header = isset($options['ewlwat_brand_header']) ? $options['ewlwat_brand_header'] : '';
	$brand_icon 	= isset($options['ewlwat_brand_favicon']) ? $options['ewlwat_brand_favicon'] : '';
	$head 				= '';
	$style 				= '';

	if( $brand_header != '' ):
		$brand_header = wp_get_attachment_url( $brand_header );
		if( $brand_header ):
			$style .= '
				<style type="text/css">
					.wp-admin #wpadminbar #wp-admin-bar-site-name>.ab-item::before{
						content: " ";
					}
					li#wp-admin-bar-site-name > a.ab-item{
						border-radius: 0 !important;
						font-size: 0;
						color: transparent;
						width: 160px !important;
						height: 44px !important;
						background: url( '.$brand_header.' ) no-repeat;
						background-color: transparent !important;
						background-size: contain;
						
					}
					li#wp-admin-bar-site-name.hover,
					li#wp-admin-bar-site-name:hover,
					li#wp-admin-bar-site-name > a.ab-item:hover,
					li#wp-admin-bar-site-name > a.ab-item:focus {
						background-color: transparent !important;
						background: url( '.$brand_header.' ) no-repeat;
						background-size: contain;
						
					}
				</style>';
		endif;
	endif;

	if( $brand_icon != '' ):
		$brand_icon = wp_get_attachment_url( $brand_icon );
		if( $brand_icon ):
			$head .= '<link rel="Shortcut Icon" type="image/x-icon" href="'.$brand_icon.'" />';
			$head .= $style;
		endif;
	endif;

	echo $head;
}
add_action( 'admin_head', 'ewlwat_custom_brand_admin', 0 );


function ewlwat_login_brand() {
	
	$options 			= get_option('ewlwat_brand_login');
	$brand_login	= isset( $options ) ? $options : 0;

	if( $brand_login != '' ):
		$brand_login = wp_get_attachment_url( $brand_login );
		if( $brand_login ):
			echo '
				<style type="text/css">
					body.login #login h1 a{
						background-image: url("'.$brand_login.'") !important;
						background-size: contain;
        		width: 270px;
        		height: 80px;
					}
				</style>';
		endif;
	endif;
}
add_action( 'login_head', 'ewlwat_login_brand', 100 );




/**
* Redefine url for logo on login page
*/

function apply_home_url(){
	return get_home_url();
}

add_filter('login_headerurl', 'apply_home_url');


/**
* Replace text on footer
*/

function ewlwat_footer_text(){

	$options	= wp_load_alloptions();
	$footer 	= isset($options['ewlwat_footer_text']) && $options['ewlwat_footer_text'] != '' ? trim($options['ewlwat_footer_text']) : '';
	$footer 	= isset( $footer ) && $footer != ''  ? $footer : '';
	
	if( $footer != ''):
		return $footer;
	else:
		return;
	endif;
}

add_filter( 'admin_footer_text', 'ewlwat_footer_text' );




/**
* Enqueue Admin Theme Scripts
*/

function ewlwat_content_styles() {
	
	wp_enqueue_script(
		'neo_theme_js',
		plugin_dir_url(__FILE__) . 'js/ewlwat.js',
		array('jquery'),
		'1.0'
	);

	wp_enqueue_style(
		'neo_theme_style',
		plugin_dir_url(__FILE__) . 'css/ewlwat.min.css'
	);

}

add_action( 'admin_enqueue_scripts', 'ewlwat_content_styles' );
add_action( 'login_enqueue_scripts', 'ewlwat_content_styles' );