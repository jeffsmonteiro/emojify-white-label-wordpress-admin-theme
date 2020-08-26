<?php
/**
* Plugin Name: Cool Admin Theme Pro for WordPress
* Plugin URI: https://jeffmonteiro.gitbook.io/catforwp/
* Description: Turn your WordPress Admin Interface more clean, friendly and actual using this Free and Open Source WordPress Admin Theme. To get a more fun interface, you can enable this theme to use emojis to replace dashicons! ;)
* Version: 1.0.0
* Author: Jeff Monteiro
* Author URI: https://www.linkedin.com/in/jeff-monteiro 
* License: GPL-3.0-or-later
* License URI: https://www.gnu.org/licenses/gpl-3.0.html
* Text Domain: catforwp
* Domain Path: /languages
*
* @package catforwp
* @version 1.0.0
*/


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/**
* Loading Text Domain
*/


function catforwp_load_text_domain() {

	$domain 	= 'catforwp';
	$mo_file 	= WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . get_locale() . '.mo';

	load_textdomain( $domain, $mo_file ); 
	load_plugin_textdomain( $domain, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 

}
add_action('plugins_loaded', 'catforwp_load_text_domain');




/**
* Set default color scheme
*/

add_action( 'admin_init', function() {

	// remove the color scheme picker
	remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

	// force all users to use the "Fresh" color scheme
	add_filter( 'get_user_option_admin_color', function() {
		return 'fresh';
	});

});




require_once( plugin_dir_path(__FILE__) . 'inc/vendor/class-boo-settings-helper.php');
require_once( plugin_dir_path(__FILE__) . 'inc/plugin-settings.php');
require_once( plugin_dir_path(__FILE__) . 'inc/load-features.php');