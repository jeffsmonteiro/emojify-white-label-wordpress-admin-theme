<?php
/**
* Plugin Name: Emojify White Label WordPress Admin Theme
* Plugin URI: https://jeffmonteiro.gitbook.io/ewlwat/
* Description: Turn your WordPress Admin Interface more clean, friendly and actual using this plugin. To get a more fun interface, you can enable this theme to use emojis to replace dashicons! ;)
* Author: Jeff Monteiro
* Version: 1.1.0
* Author URI: https://www.linkedin.com/in/jeffmonteiro 
* Text Domain: ewlwat
* Domain Path: /languages/
*
* @package ewlwat
* @version 1.1.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// options framework

require_once( plugin_dir_path(__FILE__) . 'inc/class-boo-settings-helper.php');
require_once( plugin_dir_path(__FILE__) . 'inc/plugin-settings.php');


/**
* Set default color scheme
*/


add_action( 'admin_init', function() {

	// remove the color scheme picker
	remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

	// force all users to use the "Ectoplasm" color scheme
	add_filter( 'get_user_option_admin_color', function() {
		return 'fresh';
	});

});




/**
* Applying options to Admin Theme
*/

function ewlwat_load_options(){

	$options 			= wp_load_alloptions();

	$emojify 			= isset($options['ewlwat_emojify']) ? $options['ewlwat_emojify'] : 0 ;
	$hide_wp 			= isset($options['ewlwat_hide_wp_logo']) ? $options['ewlwat_hide_wp_logo'] : 0;
	$clean_dash   = isset($options['ewlwat_clean_dashboard']) ? $options['ewlwat_clean_dashboard'] : 0;

	// Add emojify class to body

	if ( $emojify ):
		add_filter( 'admin_body_class', 'ewlwat_add_body_class');
		add_action( 'admin_menu', 'emojify_admin_icons', 999 );
	endif;



	if ( $hide_wp ):
		add_action( 'wp_before_admin_bar_render', 'ewlwat_remove_wp', 0 );
	endif;

	if ( $clean_dash ):
		add_action('wp_dashboard_setup', 'ewlwat_clear_dashboard' );
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
	
	$brand_header = isset($options['ewlwat_brand_header']) ? $options['ewlwat_brand_header'] : 0;
	$brand_icon 	= isset($options['ewlwat_brand_favicon']) ? $options['ewlwat_brand_favicon'] : '';
	$gutenberg 		= isset($options['ewlwat_brand_gutenberg']) ? $options['ewlwat_brand_gutenberg'] : 0;
	$hide_version = isset($options['ewlwat_hide_wp_version']) ? $options['ewlwat_hide_wp_version'] : 0;

	$head 				= '';
	$style 				= '<style type="text/css">';

	if( $brand_header ):
		$brand_header = wp_get_attachment_url( $brand_header );
		$style .= '
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
			';
	endif;

	if( $hide_version ){
		$style .= '#footer-upgrade{ display: none; }';
	}

	if( $gutenberg ):
		$gutenberg = wp_get_attachment_url( $gutenberg );
		
		$style .="
			.edit-post-header .components-button.edit-post-fullscreen-mode-close.has-icon {
				background-color: #fff !important;
			}
			.edit-post-header .components-button.edit-post-fullscreen-mode-close.has-icon::after {
				content: url('".$gutenberg."');
			}
			.edit-post-header .components-button.edit-post-fullscreen-mode-close.has-icon > svg{
				display: none !important;
			}
			
		";

	endif;

	$style .= '</style>';
	
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




/**
* Redefine branding on login page
*/


function ewlwat_login_brand() {
	
	$brand = null !== get_option('ewlwat_brand_login') ? get_option('ewlwat_brand_login') : 0;
	$color = null !== get_option('ewlwat_color_login') ? get_option('ewlwat_color_login') : 0;
	
	$style = '<style type="text/css">';

	if( $brand && $brand != ''):

		$brand = wp_get_attachment_url( $brand );
		if( $brand ):
			$style .= '
				body.login #login h1 a{
					background-image: url("'.$brand.'") !important;
					background-size: contain;
					width: 270px;
					height: 80px;
				}
			';
		endif;

	endif;

	if( $color && $color != ''):
		$style .= '
			body{
				background: '.$color.';
			}
		';
	endif;

	$style .= '</style>';
	echo $style;
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
	$footer 	= isset( $options['ewlwat_footer_text']) && $options['ewlwat_footer_text'] != '' ? trim($options['ewlwat_footer_text']) : '';
	$footer 	= isset( $footer ) && $footer != ''  ? $footer : '';
	
	if( $footer != ''):
		return $footer;
	else:
		return;
	endif;
}

add_filter( 'admin_footer_text', 'ewlwat_footer_text' );




/**
* Remove WordPress Default Wigets from Dashboard
*/


function ewlwat_clear_dashboard() {

	global $wp_meta_boxes;

	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);       
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_site_health']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
}





/**
* Emojify Admin Icons
*/

function emojify_admin_icons() {

	add_action( 'admin_head', function(){

		global $menu;
		$css = '<style>';

		foreach( $menu as $item ){
			
			if( count( $item ) == 7 ){
				
				$emoji = get_option( 'ewlwat_emojify_'.$item[5] );

				if( $emoji ){
					
					$css .= "
						#".$item[5]." > a::before{
							content: '".$emoji."' !important;
						}
					";
				}
			}
		}
		$css .= '</style>';
		echo $css;
	}, 10 );
}



/**
* Enqueue Admin Theme Scripts
*/

function ewlwat_content_styles() {
	
	wp_enqueue_script(
		'ewlwat-script',
		plugin_dir_url(__FILE__) . 'js/ewlwat.js',
		array('emojionearea-script'),
		'1.1'
	);

	wp_enqueue_style(
		'ewlwat-style',
		plugin_dir_url(__FILE__) . 'css/ewlwat.min.css'
	);

	wp_enqueue_script(
		'emojione-script',
		plugin_dir_url(__FILE__) . 'js/vendor/emojione.min.js',
		array('jquery'),
		'4.5'
	);

	wp_enqueue_script(
		'emojionearea-script',
		plugin_dir_url(__FILE__) . 'js/vendor/emojionearea.min.js',
		array('emojione-script'),
		'3.4.1'
	);

	wp_enqueue_style(
		'emojionarea-style',
		plugin_dir_url(__FILE__) . 'css/vendor/emojionearea.css'
	);
}

add_action( 'admin_enqueue_scripts', 'ewlwat_content_styles' );
add_action( 'login_enqueue_scripts', 'ewlwat_content_styles' );