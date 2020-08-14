<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function ewlwat_settings_page() {

  if ( current_user_can('manage_options') ) {
    
    // Create Config Array

    $config_array             = array();
    $config_array['prefix']   = 'ewlwat_';
    $config_array['tabs']     = true;
    $config_array['menu']     = array(
      'page_title'            => __( 'Emojify WLWAT', 'ewlwat' ),
      'menu_title'            => __( 'Emojify Admin Theme', 'ewlwat' ),
      'capability'            => 'manage_options',
      'slug'                  => 'ewlwat',
      'icon'                  => 'dashicons-performance',
    //'position'              => 10,
      'submenu'               => true,
      'parent'                => 'options-general.php',
    );

    $config_array['sections'] = array(
    
      array(
        'id'    => 'general_section',
        'title' => __( 'General Settings', 'ewlwat' ),
        'desc'  => '',
      ),
      array(
        'id'    => 'emojify_section',
        'title' => __( 'Emojify Settings', 'ewlwat' ),
        'desc'  => '',
      ),
      array(
        'id'    => 'help_section',
        'title' => __( 'Help', 'ewlwat' ),
        'desc'  => __( '', 'ewlwat' )
      )
    );

    $config_array['fields']   = array(
    
      'general_section' => array(
       
        array(
          'id'    => 'hide_wp_logo',
          'label' => __( 'Hide WP Logo', 'ewlwat' ),
          'desc'  => __( 'Do you want to hide WordPress icon on admin bar?', 'ewlwat' ),
          'type'  => 'checkbox',
        ),

        array(
          'id'    => 'clean_dashboard',
          'label' => __( 'Clean Dashboard', 'ewlwat' ),
          'desc'  => __( 'Removes non-functional widgets (WP Events and News, At Glance, etc)', 'ewlwat' ),
          'type'  => 'checkbox',
        ),

        array(
          'id'          => 'footer_text',
          'label'       => __( 'Footer Text', 'ewlwat' ),
          'desc'        => __( 'If you want to replace WordPress text in footer of admin, you can do that using this field.', 'ewlwat' ),
          'placeholder' => __( 'HTML is unaccepted', 'ewlwat' ),
          'type'        => 'text'
        ),

        array(
          'id'    => 'hide_wp_version',
          'label' => __( 'Hide WP Version', 'ewlwat' ),
          'desc'  => __( 'Check to hide text version on footer', 'ewlwat' ),
          'type'  => 'checkbox',
        ),

        array(
          'id'      => 'brand_header',
          'label'   => __( 'Top Menu Logo', 'ewlwat' ),
          'desc'    => __( 'Add your own logo in top menu. The max width is 160 and max height is 44px.', 'ewlwat' ),
          'default' => '',
          'type'    => 'media',
          'options' => array(
            //'btn'     => __( 'Get the image', 'ewlwat' ),
            'max_width' => 160,
            'width'   => 160,
            'height'  => 44,
          )
        ),


        array(
          'id'      => 'brand_gutenberg',
          'label'   => __( 'Replace WP logo on Gutenberg', 'ewlwat' ),
          'desc'    => __( 'Add your own logo on post edit pages. The image must have 36x36 pixels. Use of png with transparent background is recommended', 'ewlwat' ),
          'default' => '',
          'type'    => 'media',
          'options' => array(
            //'btn'     => __( 'Get the image', 'ewlwat' ),
            'max_width' => 36,
            'width'   => 36,
            'height'  => 36,
          )
        ),


        array(
          'id'      => 'brand_favicon',
          'label'   => __( 'Admin Favicon', 'ewlwat' ),
          'desc'    => __( 'Add your own logo in browser tab. The size needs to be 16x16 pixels.', 'ewlwat' ),
          'default' => '',
          'type'    => 'media',
          'options' => array(
            //'btn'     => __( 'Get the image', 'ewlwat' ),
            'max_width' => 16,
            'width'   => 16,
            'height'  => 16
          )
        ),

        array(
          'id'      => 'brand_login',
          'label'   => __( 'Login Brand', 'ewlwat' ),
          'desc'    => __( 'Add your own logo in login page. The max height is 80px and max width is 270px.', 'ewlwat' ),
          'default' => '',
          'type'    => 'media',
          'options' => array(
            //'btn'     => __( 'Get the image', 'ewlwat' ),
            'max_width' => 270,
            'width'   => 270,
            'height'  => 80
          )
        ),

        array(
          'id'      => 'color_login',
          'label'   => __( 'Login Page Background', 'ewlwat' ),
          'desc'    => __( 'Changes the background color of the login page', 'ewlwat' ),
          'default' => '#fff',
          'type'    => 'color',
        ),

      ),// End of general settings

      'emojify_section' => array(
        
        array(
          'id'    => 'emojify',
          'label' => __( 'Emojify Menu', 'ewlwat' ),
          'desc'  => __( 'Check if you want to replace icons of the admin side menu by emojis 😁', 'ewlwat' ),
          'type'  => 'checkbox',
        ),
        
        // this section is generated dinamically
        // if necessary, you can add some fields here
        // they will displayed before the emoji selectors
      ),

      'help_section' => array(
        array(
          'id'    => 'question_1',
          'label' => __( "Emojify not working", "ewlwat" ),
          'desc'  => __( "<p>To enable emojify you need to check the option on Emojify Settings tab. if the emojis still don't appear, contact the support .</p> ", "ewlwat" ),
          'type'  => 'html'
        ),
        array(
          'id'    => 'question_2',
          'label' => __( "Where do I customize emojis?", "ewlwat" ),
          'desc'  => __( "<p>You can customize all menu items with emojis on Emojify Settings tab. Sometimes it can take a while to load the emojis, but not more than 30 seconds.</p> ", "ewlwat" ),
          'type'  => 'html'
        ),
        array(
          'id'    => 'question_3',
          'label' => __( "Can I use custom icons and emojis?", "ewlwat" ),
          'desc'  => __( "<p>No. Once emojis are enabled, the plugin will attempt to replace all menu icons.</p> ", "ewlwat" ),
          'type'  => 'html'
        ),
        array(
          'id'    => 'question_4',
          'label' => __( "I can't replace some emojis", "ewlwat" ),
          'desc'  => __( "<p>Some plugins have bugs in the menu register. To prevent you from running out of icons, we've added some directly to the code. When the plugins make corrections to your codes, you will automatically be able to change the emoji.</p> ", "ewlwat" ),
          'type'  => 'html'
        ),
        array(
          'id'    => 'question_5',
          'label' => __( "No emoji I set is changed in the menu", "ewlwat" ),
          'desc'  => __( "<p>In that case, the problem is in your database. It must be configured to the recommended standard for WordPress, in this case utf8-unicode. Otherwise nothing will work!</p> ", "ewlwat" ),
          'type'  => 'html'
        ),
        array(
          'id'    => 'question_6',
          'label' => __( "Some emojis don't appear in the menu", "ewlwat" ),
          'desc'  => __( "<p>Try to open the Emojify Settings tab and set the emoji for the item that is not appearing and save the settings. If the emoji still does not appear, contact support.</p> ", "ewlwat" ),
          'type'  => 'html'
        ),
        array(
          'id'    => 'question_7',
          'label' => __( "How do I contact the support", "ewlwat" ),
          'desc'  => __( "<p>You can open a ticket on <a href='https://envato.com/' target='_blank'>Envato Market</a></p> ", "ewlwat" ),
          'type'  => 'html'
        ),
      )
    );

    $config_array['links']    = array(
      'plugin_basename' => plugin_basename( __FILE__ ),
      'action_links'    => array(
        array(
          'type' => 'default',
          'text' => __( 'Settings', 'ewlwat' ),
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

add_action( 'admin_menu', 'ewlwat_settings_page', 999);