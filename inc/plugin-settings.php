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

function catforwp_settings_page() {

  if ( current_user_can('manage_options') ) {
    
    // Create Config Array

    $config_array             = array();
    $config_array['prefix']   = 'catforwp_';
    $config_array['tabs']     = true;
    $config_array['menu']     = array(
      'page_title'            => esc_html__( 'Cool Admin Theme Pro', 'catforwp' ),
      'menu_title'            => esc_html__( 'Cool Admin Theme', 'catforwp' ),
      'capability'            => 'manage_options',
      'slug'                  => 'catforwp',
      'icon'                  => 'dashicons-performance',
    //'position'              => 10,
      'submenu'               => true,
      'parent'                => 'options-general.php',
    );

    $config_array['sections'] = array(
    
      array(
        'id'    => 'general_section',
        'title' => esc_html__( 'General Settings', 'catforwp' ),
        'desc'  => '',
      ),
      array(
        'id'    => 'emojify_section',
        'title' => esc_html__( 'Emojify Settings', 'catforwp' ),
        'desc'  => '',
      ),
      array(
        'id'    => 'css_section',
        'title' => esc_html__( 'Custom CSS', 'catforwp' ),
        'desc'  => esc_html__( '', 'catforwp' )
      ),
      array(
        'id'    => 'help_section',
        'title' => esc_html__( 'Help', 'catforwp' ),
        'desc'  => esc_html__( '', 'catforwp' )
      )
    );

    $config_array['fields']   = array(
    
      'general_section' => array(
       
        array(
          'id'    => 'hide_wp_logo',
          'label' => esc_html__( 'Hide WP Logo', 'catforwp' ),
          'desc'  => esc_html__( 'Do you want to hide WordPress icon on admin bar?', 'catforwp' ),
          'type'  => 'checkbox',
        ),

        array(
          'id'    => 'clean_dashboard',
          'label' => esc_html__( 'Clean Dashboard', 'catforwp' ),
          'desc'  => esc_html__( 'Removes non-functional widgets (WP Events and News, At Glance, etc)', 'catforwp' ),
          'type'  => 'checkbox',
        ),

        array(
          'id'          => 'footer_text',
          'label'       => esc_html__( 'Footer Text', 'catforwp' ),
          'desc'        => esc_html__( 'If you want to replace WordPress text in footer of admin, you can do that using this field.', 'catforwp' ),
          'placeholder' => esc_html__( 'HTML is unaccepted', 'catforwp' ),
          'type'        => 'text'
        ),

        array(
          'id'    => 'hide_wp_version',
          'label' => esc_html__( 'Hide WP Version', 'catforwp' ),
          'desc'  => esc_html__( 'Check to hide text version on footer', 'catforwp' ),
          'type'  => 'checkbox',
        ),

        array(
          'id'      => 'brand_header',
          'label'   => esc_html__( 'Top Menu Logo', 'catforwp' ),
          'desc'    => esc_html__( 'Add your own logo in top menu. The max width is 160 and max height is 44px.', 'catforwp' ),
          'default' => '',
          'type'    => 'media',
          'options' => array(
            'max_width' => 160,
            'width'   => 160,
            'height'  => 44,
          )
        ),


        array(
          'id'      => 'brand_gutenberg',
          'label'   => esc_html__( 'Replace WP logo on Gutenberg', 'catforwp' ),
          'desc'    => esc_html__( 'Add your own logo on post edit pages. The image must have 36x36 pixels. Use of png with transparent background is recommended', 'catforwp' ),
          'default' => '',
          'type'    => 'media',
          'options' => array(
            //'btn'     => esc_html__( 'Get the image', 'catforwp' ),
            'max_width' => 36,
            'width'   => 36,
            'height'  => 36,
          )
        ),


        array(
          'id'      => 'brand_favicon',
          'label'   => esc_html__( 'Admin Favicon', 'catforwp' ),
          'desc'    => esc_html__( 'Add your own logo in browser tab. The size needs to be 16x16 pixels.', 'catforwp' ),
          'default' => '',
          'type'    => 'media',
          'options' => array(
            //'btn'     => esc_html__( 'Get the image', 'catforwp' ),
            'max_width' => 16,
            'width'   => 16,
            'height'  => 16
          )
        ),

        array(
          'id'      => 'brand_login',
          'label'   => esc_html__( 'Login Brand', 'catforwp' ),
          'desc'    => esc_html__( 'Add your own logo in login page. The max height is 80px and max width is 270px.', 'catforwp' ),
          'default' => '',
          'type'    => 'media',
          'options' => array(
            //'btn'     => esc_html__( 'Get the image', 'catforwp' ),
            'max_width' => 270,
            'width'   => 270,
            'height'  => 80
          )
        ),

        array(
          'id'      => 'color_login',
          'label'   => esc_html__( 'Login Page Background', 'catforwp' ),
          'desc'    => esc_html__( 'Changes the background color of the login page', 'catforwp' ),
          'default' => '#fff',
          'type'    => 'color',
        ),

      ),// End of general settings

      'emojify_section' => array(
        
        array(
          'id'    => 'emojify',
          'label' => esc_html__( 'Emojify Menu', 'catforwp' ),
          'desc'  => esc_html__( 'Check if you want to replace icons of the admin side menu by emojis 😁', 'catforwp' ),
          'type'  => 'checkbox',
        ),
        
        // this section is generated dinamically
        // if necessary, you can add some fields here
        // they will displayed before the emoji selectors
      ),

      'css_section' => array(
        
        array(
          'id'          => 'cat_custom_style',
          'label'       => esc_html__( 'Add your CSS', 'catforwp' ),
          'desc'        => esc_html__( 'You can add new emojis or whatever for Admin Area using custom CSS code.', 'catforwp' ),
          'type'        => 'textarea',
          'default'     => 
".catforwp-emojify #menu-dashboard > a::before{
  content: '📺';
}"
        ),
      ),

      'help_section' => array(
        array(
          'id'    => 'question_1',
          'label' => esc_html__( "Emojify not working", "catforwp" ),
          'desc'  => esc_html__( "To enable emojify you need to check the option on Emojify Settings tab.", "catforwp" ),
          'type'  => 'html'
        ),
        array(
          'id'    => 'question_2',
          'label' => esc_html__( "Where do I customize emojis?", "catforwp" ),
          'desc'  => esc_html__( "You can customize all menu items with emojis on Emojify Settings tab. Sometimes it can take a while to load the emojis, but not more than 30 seconds.", "catforwp" ),
          'type'  => 'html'
        ),
        array(
          'id'    => 'question_3',
          'label' => esc_html__( "Can I use custom icons and emojis?", "catforwp" ),
          'desc'  => esc_html__( "No. Once emojis are enabled, the plugin will attempt to replace all menu icons.", "catforwp" ),
          'type'  => 'html'
        ),
        array(
          'id'    => 'question_4',
          'label' => esc_html__( "I can't replace some emojis", "catforwp" ),
          'desc'  => esc_html__( "Some plugins have bugs in the menu register. To prevent you from running out of icons, we've added some directly to the code. When the plugins make corrections to your codes, you will automatically be able to change the emoji.", "catforwp" ),
          'type'  => 'html'
        ),
        array(
          'id'    => 'question_5',
          'label' => esc_html__( "No emoji I set is changed in the menu", "catforwp" ),
          'desc'  => esc_html__( "In that case, the problem is in your database. It must be configured to the recommended standard for WordPress, in this case utf8-unicode. Otherwise nothing will work!", "catforwp" ),
          'type'  => 'html'
        ),
        array(
          'id'    => 'question_6',
          'label' => esc_html__( "Some emojis don't appear in the menu", "catforwp" ),
          'desc'  => esc_html__( "Try to open the Emojify Settings tab and set the emoji for the item that is not appearing and save the settings. If the emoji still does not appear, contact support.", "catforwp" ),
          'type'  => 'html'
        ),
        array(
          'id'    => 'question_7',
          'label' => esc_html__( "Have a bug?", "catforwp" ),
          'desc'  => sprintf( esc_html__( 'Open an issue on %1$s', 'catforwp' ), '<a href="https://github.com/jeffsmonteiro/emojify-white-label-admin-theme/issues/" target="_blank">Git Hub Repository</a>'),
          'type'  => 'html'
        ),
      )
    );

    $config_array['links']    = array(
      'plugin_basename' => plugin_basename( __FILE__ ),
      'action_links'    => array(
        array(
          'type' => 'default',
          'text' => esc_html__( 'Settings', 'catforwp' ),
        ),
      ),
    );

    // Get current registered menus
    global $menu;

    foreach( $menu as $item ){
      if( count( $item ) == 7 ){
        array_push($config_array['fields']['emojify_section'], array(
          'id'    => 'emojify_'.$item[5],
          'label' => preg_replace('/\d+/u','',$item[0]),
          'type'  => 'text',
          'class' => 'my-class',
          'input_class' => 'is-emoji-picker hidden'
        ));
      }
    }
    
    // Pass Config Array to Class Constructor
    $settings_helper = new Boo_Settings_Helper( $config_array );
  }
}

add_action( 'admin_menu', 'catforwp_settings_page', 999);