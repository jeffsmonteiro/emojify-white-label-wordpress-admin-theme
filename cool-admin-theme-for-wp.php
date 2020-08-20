<?php
/**
* Plugin Name: Cool Admin Theme Lite for WordPress
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

/*
	Cool Admin Theme for WordPress is free software: you can redistribute 
	it and/or modify it under the terms of the GNU General Public License 
	as published by the Free Software Foundation, either version 3 of the 
	License, or any later version.
	
	Cool Admin Theme for WordPress is distributed in the hope that it will 
	be useful,but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	along with Cool Admin Theme for WordPress. If not, see 
	https://www.gnu.org/licenses/gpl-3.0.html.
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

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


// ALL
require_once( plugin_dir_path(__FILE__) . 'inc/vendor/class-boo-settings-helper.php');


// PRO FEATURES
require_once( plugin_dir_path(__FILE__) . 'inc/pro/plugin-settings.php');
require_once( plugin_dir_path(__FILE__) . 'inc/pro/load-features.php');


// FREE
//require_once( plugin_dir_path(__FILE__) . 'inc/free/plugin-settings.php');
//require_once( plugin_dir_path(__FILE__) . 'inc/free/load-features.php');