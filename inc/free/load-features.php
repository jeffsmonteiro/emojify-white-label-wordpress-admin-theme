<?php
/**
* Cool Admin Theme Lite for WordPress
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
	$emojify 			= isset($options['catforwp_emojify']) ? $options['catforwp_emojify'] : 0 ;
	
	// Add emojify class to body

  if ( $emojify ):
		add_filter( 'admin_body_class', 'catforwp_add_body_class');
  endif;
  
}
add_filter('init', 'catforwp_load_options');




/**
* Adding catforwp class to body
*/

function catforwp_add_body_class(){
	return 'catforwp-emojify';
}


/**
* Enqueue Admin Theme Scripts
*/


function catforwp_content_styles() {

	wp_enqueue_code_editor( array( 'type' => 'text/html') );
  wp_enqueue_script( 'js-code-editor', plugin_dir_url( __FILE__ ) . '../../js/catforwp-lite.js', array( 'jquery' ), '', true );

	wp_enqueue_style(
		'catforwp-style',
		plugin_dir_url(__FILE__) . '../../css/catforwp.min.css'
	);
}

add_action( 'admin_enqueue_scripts', 'catforwp_content_styles', 20 );