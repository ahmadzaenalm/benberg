<?php

/*
Plugin Name: VC GM Addons
Plugin URI: http://upqode.com
Description: Google Maps shortcodes for Visual Composer
Version: 0.1
Author: Upqode
Author URI: http://upqode.com
License: A "Slug" license name e.g. GPL2
*/

ini_set("display_errors",1);
error_reporting(E_ALL);

defined( 'PLUGIN_ROOT' )    or define( 'PLUGIN_ROOT',       dirname(__FILE__) );
defined( 'PLUGIN_DIR_URL' ) or define( 'PLUGIN_DIR_URL',    plugin_dir_url( __FILE__ ) );


class VC_GM_Addons {
    /**
     * VC_GM_Addons constructor.
     */
    public function __construct() {

        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

        include_once( PLUGIN_ROOT . '/includes/functions.php' );

        if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {

            require_once( WP_PLUGIN_DIR . '/js_composer/js_composer.php');

            add_action( 'admin_init', array($this, 'vc_gm_addons') );
            add_action( 'wp', array($this, 'vc_gm_addons') );
        }
    }

    public function vc_gm_addons(){
        require_once( PLUGIN_ROOT .'/composer/init.php');

        foreach( glob( PLUGIN_ROOT . '/composer/shortcodes/vc_gm_*.php' ) as $shortcode ) {
            require_once(PLUGIN_ROOT .'/composer/shortcodes/'. basename( $shortcode ) );
        }

        foreach( glob( PLUGIN_ROOT . '/composer/shortcodes/vc_*.php' ) as $shortcode ) {
            require_once(PLUGIN_ROOT .'/composer/shortcodes/' . basename( $shortcode ) );
        }
    }
}

new VC_GM_Addons();