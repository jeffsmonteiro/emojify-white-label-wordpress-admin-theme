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
        'id'    => 'about_section',
        'title' => __( 'About', 'ewlwat' ),
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

      'about_section' => array(
        array(
          'id'    => 'why',
          'label' => __( 'The gu•theme•berg', 'ewlwat' ),
          'desc'  => __( '<p>After launch of Gutenberg as a feature by WordPress, the Admin Interface design set was a little disconnected. Then inspired by the Gutenberg interface, this theme was created. However, you should not believe that we intend to replace the standard WordPress interface. This is just an alternative for enthusiasts.</p> ', 'ewlwat' ),
          'type'  => 'html'
        ),
        array(
          'id'    => 'freedom_and_loyalty',
          'label' => __( 'Freedom and Loyalty', 'ewlwat' ),
          'desc'  => __( '<p>WordPress is an amazing resource. Imagine that more than 30% of all internet sites use this tool and its creator has accepted that we have free access to it, in addition to being able to modify it. However, in order to enjoy this freedom, we believe that it is necessary to have loyalty to the basic concepts behind WordPress. So in the guise of saying that everything here was built without changes to the core and making the most of the native resources offered by the source code.</p> ', 'ewlwat' ),
          'type'  => 'html'
        ),
        array(
          'id'    => 'who',
          'label' => __( 'Who', 'ewlwat' ),
          'desc'  => __( '<p>The creator of <b>gu•theme•berg</b> is <a href="https://www.linkedin.com/in/jeff-monteiro/" target="_blank">Jeff Monteiro</a>, a designer (and developer) based in São Paulo, Brazil. With some years of experience in design and very close to development teams, he started to create his own codes, mainly through solutions built with WordPress. </p> ', 'ewlwat' ),
          'type'  => 'html'
        ),
        array(
          'id'    => 'donate',
          'label' => __( 'Buy me a coffee', 'ewlwat' ),
          'desc'  => __( "<p>There aren't many theme options for the WordPress Admin. If you want to change this environment, you will need to make your own theme or maybe buy one. These paid themes are usually sold for USD20. If you think you have saved some money and are satisfied with the <b>gu•theme•berg</b>, feel free to buy me a coffee.</p><div style='display: block; margin-top:40px;'><style>.bmc-button img{height: 34px !important;width: 35px !important;margin-bottom: 1px !important;box-shadow: none !important;border: none !important;vertical-align: middle !important;}.bmc-button{padding: 7px 10px 7px 10px !important;line-height: 35px !important;height:51px !important;min-width:217px !important;text-decoration: none !important;display:inline-flex !important;color:#000000 !important;background-color:#FFDD00 !important;border-radius: 5px !important;border: 1px solid transparent !important;padding: 7px 10px 7px 10px !important;font-size: 20px !important;letter-spacing:-0.08px !important;box-shadow: 0px 1px 2px rgba(190, 190, 190, 0.5) !important;-webkit-box-shadow: 0px 1px 2px 2px rgba(190, 190, 190, 0.5) !important;margin: 0 auto !important;font-family:'Lato', sans-serif !important;-webkit-box-sizing: border-box !important;box-sizing: border-box !important;-o-transition: 0.3s all linear !important;-webkit-transition: 0.3s all linear !important;-moz-transition: 0.3s all linear !important;-ms-transition: 0.3s all linear !important;transition: 0.3s all linear !important;}.bmc-button:hover, .bmc-button:active, .bmc-button:focus {-webkit-box-shadow: 0px 1px 2px 2px rgba(190, 190, 190, 0.5) !important;text-decoration: none !important;box-shadow: 0px 1px 2px 2px rgba(190, 190, 190, 0.5) !important;opacity: 0.85 !important;color:#000000 !important;}</style><link href='https://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet'><a class='bmc-button' target='_blank' href='https://www.buymeacoffee.com/ewlwat'><img src='https://cdn.buymeacoffee.com/buttons/bmc-new-btn-logo.svg' alt='Buy me a coffee'><span style='margin-left:15px;font-size:19px !important;'>Buy me a coffee</span></a></div>
            ", "ewlwat" ),
          'type'  => 'html'
        ),
        array(
          'id'    => 'web_page',
          'label' => __( 'More', 'ewlwat' ),
          'desc'  => __( '<a href="https://jeffmonteiro.gitbook.io/ewlwat/" target="_blank">Official Page</a>', 'ewlwat' ),
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