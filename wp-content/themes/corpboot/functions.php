<?php
/**
 * The template includes necessary functions for theme.
 *
 * @package corpboot
 * @since 1.0.0
 *
 */

if ( ! isset( $content_width ) ) {
    $content_width = 960; // pixel
}

// ------------------------------------------
// Global define for theme
// ------------------------------------------
defined( 'CORPBOOT_URI' )    or define( 'CORPBOOT_URI',    get_template_directory_uri() );
defined( 'CORPBOOT_T_PATH' ) or define( 'CORPBOOT_T_PATH', get_template_directory() );
defined( 'CORPBOOT_F_PATH' ) or define( 'CORPBOOT_F_PATH', CORPBOOT_T_PATH . '/include' );

// ------------------------------------------
// Framework integration
// ------------------------------------------

// Include all styles and scripts.
require_once CORPBOOT_F_PATH . '/custom/action-config.php';

// Helper functions.
require_once CORPBOOT_F_PATH . '/custom/helper-functions.php';

// Menu Walker.
require_once CORPBOOT_F_PATH . '/custom/menu-walker.php';

// Plugin activation class.
require_once CORPBOOT_F_PATH . '/plugins/class-tgm-plugin-activation.php';

// Demo data importer.
require_once CORPBOOT_F_PATH . '/custom/importer/index.php';

// Include Importer.
//require_once CORPBOOT_F_PATH . '/custom/importer/index.php';


// ------------------------------------------
// Setting theme after setup
// ------------------------------------------
if ( ! function_exists( 'corpboot_after_setup' ) ) {
    function corpboot_after_setup()
    {
        load_theme_textdomain( 'corpboot', CORPBOOT_T_PATH . '/languages' );

        register_nav_menus(
            array(
                'top-menu' => esc_html__( 'Top menu', 'corpboot' ),
            )
        );

        add_theme_support( 'post-formats', array('video', 'gallery', 'audio', 'quote') );
        add_theme_support( 'custom-header' );
        add_theme_support( 'custom-background' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption') );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'title-tag' );
    }
}
add_action( 'after_setup_theme', 'corpboot_after_setup' );

/*
 * Check need minimal requirements (PHP and WordPress version)
 */
if ( version_compare( $GLOBALS['wp_version'], '4.3', '<' ) || version_compare( PHP_VERSION, '5.3', '<' ) ) {
    function corpboot_requirements_notice()
    {
        $message = sprintf( esc_html__( 'Corpboot theme needs minimal WordPress version 4.3 and PHP 5.3<br>You are running version WordPress - %s, PHP - %s.<br>Please upgrade need module and try again.', 'corpboot' ), $GLOBALS['wp_version'], PHP_VERSION );
        printf( '<div class="notice-warning notice"><p><strong>%s</strong></p></div>', $message );
    }
    add_action( 'admin_notices', 'corpboot_requirements_notice' );
}

