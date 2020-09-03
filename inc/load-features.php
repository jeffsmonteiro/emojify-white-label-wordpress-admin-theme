<?php
/**
* Cool Admin Theme Pro for WordPress
* Version: 1.0.0
* License: GPL-3.0-or-later
*
* @package catforwp
* @version 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Applying options to Admin Theme
*/

function catforwp_load_options(){

	$options 			= wp_load_alloptions();

	$hide_wp 			= isset($options['catforwp_hide_wp_logo']) ? $options['catforwp_hide_wp_logo'] : 0;
	$clean_dash   = isset($options['catforwp_clean_dashboard']) ? $options['catforwp_clean_dashboard'] : 0;
	

	// Add emojify class to body	

	if ( $hide_wp ):
		add_action( 'wp_before_admin_bar_render', 'catforwp_remove_wp', 0 );
	endif;

	if ( $clean_dash ):
		add_action('wp_dashboard_setup', 'catforwp_clear_dashboard' );
	endif;
}
add_filter('init', 'catforwp_load_options');






/**
* Adding catforwp class to body
*/

function catforwp_emojify_menu(){

	$options 			= wp_load_alloptions();
	$emojify 			= isset($options['catforwp_emojify']) ? $options['catforwp_emojify'] : 0 ;
	
	// Add emojify class to body

	if ( $emojify ):
		return 'catforwp-emojify';
	endif;
}
add_filter( 'admin_body_class', 'catforwp_emojify_menu');




/**
* Hide WP logo from admin bar
*/

function catforwp_remove_wp() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_node( 'wp-logo' );
}











/**
* Add Custom Logo to Admin Bar
*/

function catforwp_custom_brand_admin() {
	
	$options 			= wp_load_alloptions();
	
	$brand_header = isset($options['catforwp_brand_header']) ? $options['catforwp_brand_header'] : 0;
	$brand_icon 	= isset($options['catforwp_brand_favicon']) ? $options['catforwp_brand_favicon'] : 0;
	$gutenberg 		= isset($options['catforwp_brand_gutenberg']) ? $options['catforwp_brand_gutenberg'] : 0;
	$hide_version = isset($options['catforwp_hide_wp_version']) ? $options['catforwp_hide_wp_version'] : 0;
	$custom_css   = isset($options['catforwp_cat_custom_style']) ? $options['catforwp_cat_custom_style'] : 0;
	

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
		$style .= "#footer-upgrade{ display: none; }";
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

	if($custom_css){
		$style .= $custom_css;
	}

	$style .= "</style>";
	
	if( $brand_icon != '' ):
		$brand_icon = wp_get_attachment_url( $brand_icon );
		if( $brand_icon ):
			$head .= '<link rel="Shortcut Icon" type="image/x-icon" href="'.$brand_icon.'" />';
		endif;
	endif;

	$head .= $style;
	echo $head;
}
add_action( 'admin_head', 'catforwp_custom_brand_admin', 100 );




/**
* Redefine branding on login page
*/


function catforwp_login_brand() {
	
	$brand = null !== get_option('catforwp_brand_login') ? get_option('catforwp_brand_login') : 0;
	$color = null !== get_option('catforwp_color_login') ? get_option('catforwp_color_login') : 0;
	
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
				background: '.$color.' !important;
			}
		';
	endif;

	$style .= '</style>';
	echo $style;
}
add_action( 'login_head', 'catforwp_login_brand', 100 );




/**
* Redefine url for logo on login page
*/

function catforwp_apply_home_url(){
	return get_home_url();
}

add_filter('login_headerurl', 'catforwp_apply_home_url');





/**
* Replace text on footer
*/

function catforwp_footer_text(){

	$options	= wp_load_alloptions();
	$footer 	= isset( $options['catforwp_footer_text']) && $options['catforwp_footer_text'] != '' ? trim($options['catforwp_footer_text']) : '';
	$footer 	= isset( $footer ) && $footer != ''  ? $footer : '';
	
	if( $footer != ''):
		return $footer;
	else:
		return;
	endif;
}

add_filter( 'admin_footer_text', 'catforwp_footer_text' );




/**
* Remove WordPress Default Wigets from Dashboard
*/


function catforwp_clear_dashboard() {

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

function catforwp_emojify_admin_icons() {

	add_action( 'admin_head', function(){

		global $menu;
		$css = '<style>';

		foreach( $menu as $item ){
			
			if( count( $item ) == 7 ){
				
				$emoji = get_option( 'catforwp_emojify_'.$item[5] );

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
add_action( 'admin_menu', 'catforwp_emojify_admin_icons', 999 );


/**
* Enqueue Admin Theme Scripts
*/

function catforwp_content_styles() {
	
	wp_enqueue_code_editor( array( 'type' => 'text/html') );
		
	wp_enqueue_script(
		'catforwp-script',
		plugin_dir_url(__FILE__) . '../js/catforwp.js',
		array('emojionearea-script'),
		'1.1'
	);

	wp_enqueue_style(
		'catforwp-style',
		plugin_dir_url(__FILE__) . '../css/catforwp.min.css'
	);

	wp_enqueue_script(
		'emojione-script',
		plugin_dir_url(__FILE__) . '../js/vendor/emojione.min.js',
		array('jquery'),
		'4.5'
	);

	wp_enqueue_script(
		'emojionearea-script',
		plugin_dir_url(__FILE__) . '../js/vendor/emojionearea.min.js',
		array('emojione-script'),
		'3.4.1'
	);

	wp_enqueue_style(
		'emojionarea-style',
		plugin_dir_url(__FILE__) . '../css/vendor/emojionearea.min.css'
	);
}

add_action( 'admin_enqueue_scripts', 'catforwp_content_styles',990 );
add_action( 'login_enqueue_scripts', 'catforwp_content_styles' );