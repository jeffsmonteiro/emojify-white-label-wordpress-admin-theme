<?php
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
      'page_title'            => esc_html__( 'Cool Admin Theme Lite', 'catforwp' ),
      'menu_title'            => esc_html__( 'Cool Admin Theme Lite', 'catforwp' ),
      'capability'            => 'manage_options',
      'slug'                  => 'catforwp',
      'icon'                  => 'dashicons-performance',
    //'position'              => 10,
      'submenu'               => true,
      'parent'                => 'options-general.php',
    );

    $config_array['sections'] = array(
    
      array(
        'id'    => 'emojify_section',
        'title' => esc_html__( 'Emojify Settings', 'catforwp' ),
        'desc'  => '',
      ),
      array(
        'id'    => 'help_section',
        'title' => esc_html__( 'Help', 'catforwp' ),
        'desc'  => esc_html__( '', 'catforwp' )
      )
    );

    $config_array['fields']   = array(
    
      'emojify_section' => array(
        
        array(
          'id'    => 'emojify',
          'label' => esc_html__( 'Emojify Menu', 'catforwp' ),
          'desc'  => esc_html__( 'Check if you want to replace icons of the admin menu by emojis 😁', 'catforwp' ),
          'type'  => 'checkbox',
        ),
        array(
          'id'          => 'cat_custom_style',
          'label'       => esc_html__( 'Custom CSS', 'catforwp' ),
          'desc'        => esc_html__( 'Add new emojis using custom CSS code.', 'catforwp' ),
          'type'        => 'textarea',
        ),
        
        // this section is generated dinamically
        // if necessary, you can add some fields here
        // they will displayed before the emoji selectors
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

    // Pass Config Array to Class Constructor
    $settings_helper = new Boo_Settings_Helper( $config_array );
  }
}

add_action( 'admin_menu', 'catforwp_settings_page', 999);