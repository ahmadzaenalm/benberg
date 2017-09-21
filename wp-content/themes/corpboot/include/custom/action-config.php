<?php
/**
 * Action Config - Theme setting
 *
 * @package corpboot
 * @since 1.0.0
 *
 */

// ------------------------------------------
// Global actions for theme
// ------------------------------------------
add_action( 'widgets_init',       'corpboot_register_sidebar' );
add_action( 'wp_enqueue_scripts', 'corpboot_enqueue_scripts');
add_action( 'wp_enqueue_scripts', 'corpboot_custom_styles');
add_action( 'tgmpa_register',     'corpboot_include_required_plugins' );

// ------------------------------------------
// Function for add actions
// ------------------------------------------
/** Function for register sidebar */
if ( ! function_exists( 'corpboot_register_sidebar' ) ) {
	function corpboot_register_sidebar() {

		// register main sidebars
		register_sidebar(
			array(
				'id'            => 'sidebar',
				'name'          => esc_html__( 'Sidebar' , 'corpboot' ),
				'before_widget' => '<div class="well widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="corpboot-title-w">',
				'after_title'   => '</h2>',
				'description'   => esc_html__( 'Drag the widgets for sidebars.', 'corpboot' )
			)
		);
		register_sidebar(
			array(
				'id'            => 'footer-sidebar',
				'name'          => esc_html__( 'Footer sidebar' , 'corpboot' ),
				'before_widget' => '<div class="col-sm-6 col-md-3 footer-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>',
				'description'   => esc_html__( 'Drag the widgets for footer sidebars.', 'corpboot' )
			)
		);
	}
}

/** Loads all the js and css script to frontend */
if ( ! function_exists( 'corpboot_enqueue_scripts' ) ) {
	function corpboot_enqueue_scripts()
	{
		// general settings
		if ( ( is_admin() ) ) { return; }

		wp_enqueue_script( 'bootstrap',	            CORPBOOT_URI . '/assets/js/bootstrap.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'vanillabox',	        CORPBOOT_URI . '/assets/js/jquery.vanillabox-0.1.7.min.js', array( 'jquery' ), false, true );
        wp_enqueue_script( 'slick',	                CORPBOOT_URI . '/assets/js/slick.min.js', array( 'jquery' ), false, true );
        wp_enqueue_script( 'bootstrap-select',	    CORPBOOT_URI . '/assets/js/bootstrap-select.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'flexslider',     	    CORPBOOT_URI . '/assets/js/jquery.flexslider-min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'placeholder',	        CORPBOOT_URI . '/assets/js/jquery.placeholder.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'stellar',	            CORPBOOT_URI . '/assets/js/jquery.stellar.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'wow',	                CORPBOOT_URI . '/assets/js/wow.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'mixitup',	            CORPBOOT_URI . '/assets/js/jquery.mixitup.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'fitvids',	            CORPBOOT_URI . '/assets/js/jquery.fitvids.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'corpboot-theme',	    CORPBOOT_URI . '/assets/js/main.js', array( 'jquery' ), false, true );

		// add TinyMCE style
		add_editor_style();

		if ( is_singular() ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// register style
		wp_enqueue_style( 'corpboot-core-css', 	        CORPBOOT_URI . '/style.css' );
        wp_enqueue_style( 'bootstrap', 			        CORPBOOT_URI . '/assets/css/bootstrap.min.css' );
        wp_enqueue_style( 'bootstrap-select', 	        CORPBOOT_URI . '/assets/css/bootstrap-select.min.css' );
        wp_enqueue_style( 'font-awesome', 		        CORPBOOT_URI . '/assets/css/font-awesome.min.css' );
        wp_enqueue_style( 'flexslider', 	            CORPBOOT_URI . '/assets/css/flexslider.css' );
        wp_enqueue_style( 'animate', 	                CORPBOOT_URI . '/assets/css/animate.min.css' );
        wp_enqueue_style( 'slick', 	                    CORPBOOT_URI . '/assets/css/slick.css' );
        wp_enqueue_style( 'corpboot-responsive-space', 	CORPBOOT_URI . '/assets/css/responsive-space.css' );
		wp_enqueue_style( 'corpboot-theme-css',         CORPBOOT_URI . '/assets/css/main.css', array( 'corpboot-fonts' ) );
		wp_enqueue_style( 'custome-css', 	        CORPBOOT_URI . '/custome.css' );
	}
}

/** Style widget gallery */
function corpboot_media_lib_uploader_enqueue() {
    wp_enqueue_media();
    wp_enqueue_script( 'media-lib-uploader-js', CORPBOOT_URI . '/assets/js/media-lib-uploader.js', array( 'jquery' ), false, true );
}
add_action('admin_enqueue_scripts', 'corpboot_media_lib_uploader_enqueue');

/** Include required plugins */
if ( ! function_exists( 'corpboot_include_required_plugins' ) ) {
	function corpboot_include_required_plugins()
	{
		$plugins = array(
			array(
				'name'                  => esc_html__( 'Contact Form 7', 'corpboot' ), // The plugin name
				'slug'                  => 'contact-form-7', // The plugin slug (typically the folder name)
				'required'              => false, // If false, the plugin is only 'recommended' instead of required
				'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'          => '', // If set, overrides default API URL and points to an external URL
			),
            array(
                'name'					=> esc_html__( 'Easy Tables VC', 'corpboot' ),
                'slug'					=> 'easy-tables-vc',
                'source'                => esc_url('http://demo.qodearena.com/projects/plugins/easy-tables-vc.zip'),
                'required'				=> false,
                'version'				=> '',
                'force_activation'		=> false,
                'force_deactivation'	=> false,
                'external_url'			=> ''
            ),
            array(
                'name'                  => esc_html__( 'Google Map Addons', 'corpboot' ), // The plugin name
                'slug'                  => 'vc_gm_addons', // The plugin slug (typically the folder name)
                'source'                => esc_url('http://demo.qodearena.com/projects/plugins/vc_gm_addons.zip'), // The plugin source
                'required'              => true, // If false, the plugin is only 'recommended' instead of required
                'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url'          => '', // If set, overrides default API URL and points to an external URL
            ),
            array(
                'name'                  => esc_html__( 'MailChimp for WordPress', 'corpboot' ), // The plugin name
                'slug'                  => 'mailchimp-for-wp', // The plugin slug (typically the folder name)
                'required'              => false, // If false, the plugin is only 'recommended' instead of required
                'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url'          => '', // If set, overrides default API URL and points to an external URL
            ),
			array(
				'name'                  => esc_html__( 'Visual Composer', 'corpboot' ), // The plugin name
				'slug'                  => 'js_composer', // The plugin slug (typically the folder name)
				'source'                => esc_url('http://demo.qodearena.com/projects/plugins/js_composer.zip'), // The plugin source
				'required'              => true, // If false, the plugin is only 'recommended' instead of required
				'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'          => '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'                  => esc_html__( 'Corpboot Plugins', 'corpboot' ), // The plugin name
				'slug'                  => 'corpboot-plugins', // The plugin slug (typically the folder name)
				'source'                => esc_url('http://demo.qodearena.com/projects/corpbootwp/wp-content/themes/corpboot/include/plugins/corpboot-plugins.zip'), // The plugin source
				'required'              => true, // If false, the plugin is only 'recommended' instead of required
				'version'               => '1.0.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'          => '', // If set, overrides default API URL and points to an external URL
			),
		);

		// Change this to your theme text domain, used for internationalising strings

		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'id'           => 'corpboot',                // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
		);

		tgmpa( $plugins, $config );
	}
}

/** Custom styles from Theme Options */
if ( ! function_exists( 'corpboot_custom_styles' ) ) {
	function corpboot_custom_styles()
	{
		global $corpboot_opt;
		$output = '';

        /* Global typography */
        if ( isset( $corpboot_opt['typography_style'] ) && $corpboot_opt['typography_style'] ) {
            foreach ( $corpboot_opt['typography_style'] as $key => $title ) {

                $heading_tag = '';
                if( $title['heading_tag'] == 'span' ) {
                    $heading_tag .= '.home-promo .titlepro .middle';
                } elseif( $title['heading_tag'] == 'p' ) {
                    $heading_tag .= 'p, div';
                } else {
                    $heading_tag .= $title['heading_tag'];
                }

                if ( ! empty( $title['heading_family']['family'] ) ) {
                    $output .= $heading_tag . ' {font-family:' . $title['heading_family']['family'] . ' !important;}' . "\n\r";

                    if ( $title['heading_family']['font'] == 'google' ) {
                        wp_enqueue_style( 'header_typography', '//fonts.googleapis.com/css?family=' . $title['heading_family']['family'] . ':' . $title['heading_family']['variant'] );
                    }
                }
                if ( ! empty( $title['heading_size'] ) ) {
                    $output .=  $heading_tag . ' {font-size:' . $title['heading_size'] . 'px !important;}' . "\n\r";
                    $output .=  $heading_tag . ' {line-height:' . $title['heading_size'] . 'px !important;}' . "\n\r";
                }
                if ( ! empty( $title['heading_color'] ) ) {
                    $output .= $heading_tag . ' {color:' . $title['heading_color'] . ' !important;}' . "\n\r";
                }
            }
        }

        /* Custom menu typography */
        if ( isset( $corpboot_opt['default_header_typography'] ) && ! $corpboot_opt['default_header_typography'] ) {
            $typo = $corpboot_opt['header_typography_group'];

            if ( ! empty( $typo['header_typography']['family'] ) ) {
                $output .= '.navbar-default .navbar-nav > li > a, .navbar-default .navbar-nav .dropdown-menu > li > a {font-family:' . $typo['header_typography']['family'] . ';}' . "\n\r";

                if ( $typo['header_typography']['font'] == 'google' ) {
                    wp_enqueue_style( 'header_typography', '//fonts.googleapis.com/css?family=' . $typo['header_typography']['family'] . ':' . $typo['header_typography']['variant'] );
                }
            }
            if ( ! empty( $typo['header_font_size'] ) ) {
                $output .= '.navbar-default .navbar-nav > li > a, .navbar-default .navbar-nav .dropdown-menu > li > a {font-size:' . $typo['header_font_size'] . 'px;}' . "\n\r";
                $output .= '.navbar-default .navbar-nav > li > a, .navbar-default .navbar-nav .dropdown-menu > li > a {line-height:' . $typo['header_font_size'] . 'px;}' . "\n\r";
            }
            if ( ! empty( $typo['header_font_color'] ) ) {
                $output .= '.navbar-default .navbar-nav > li > a, .navbar-default .navbar-nav .dropdown-menu > li > a {color:' . $typo['header_font_color'] . ' !important;}' . "\n\r";
            }
        }

        /* Text Logo font size */
        if ( ! empty( $corpboot_opt['text_logo_font_size'] ) ) {
            $output .= '.navbar-default .navbar-brand {font-size:' . $corpboot_opt['text_logo_font_size'];
            $output .= ( is_numeric( $corpboot_opt['text_logo_font_size'] ) ) ? 'px;}' : ';}';
            $output .= "\n\r";
        }

        /* Text Logo font size */
        if ( ! empty( $corpboot_opt['header_logo_color'] ) ) {
            $output .= '.navbar-default .navbar-brand {color:' . $corpboot_opt['header_logo_color'] . ' !important;}' . "\n\r";
        }

        /* Global style color */
        if ( ! empty( $corpboot_opt['global_style_color'] ) ) {
            // Background
            $output .= '.navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus, .navbar-default .navbar-nav > .active > a:active,
                        .btn-transparent:hover, .btn-transparent:focus, .btn-transparent:active, .home-icons .fa:hover, .home-icons .glyphicon:hover, .scrollToTop, .btn-primary-corp-big:hover, .btn-primary-corp-big:focus, .btn-primary-corp-big:active,
                        .footer-top, .navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus, .navbar-default .navbar-nav > li > a:active, .navbar-default .navbar-nav .dropdown-menu > li > a:hover, .navbar-default .navbar-nav .dropdown-menu > li > a:focus,
                        .btn-primary-corp-big, .footer-bottom, .breadcrumb-container, .progress-bar, .nav-tabs > li > a:hover, .nav-wizard > li.done:hover > a, .nav-wizard > li:hover > a, .nav-wizard > li.active > a, .portfolio-filters li.active,
                        .portfolio-filters li:hover, .portfolio-filters li:focus, .btn-primary-corp, .submit, .widget h2, .widget_search .search-form:after, .tags-links a:hover, .tagcloud a:hover, .pagination a:hover, .navbar-default .navbar-nav > li.current-menu-ancestor > a, .navbar-default .navbar-nav > li.current-menu-item > a,
                        .navbar-default .navbar-nav > li.current-menu-ancestor .current-menu-ancestor, .navbar-default .navbar-nav > li.current-menu-ancestor .current-menu-item, .navbar-default .navbar-nav > li.current-menu-item .current-menu-ancestor, .navbar-default .navbar-nav > li.current-menu-item .current-menu-item,
                        .btn-reply, .btn-edit, .comment-edit-link, .comment-reply-link, .corpboot-price-title, .button-srtc, .wpcf7-form input.wpcf7-submit, .wpcf7-form button[type="submit"], .cinfo address i, .navbar-default .navbar-toggle {background-color:' . $corpboot_opt['global_style_color'] . ' !important;}' . "\n\r";
            $output .= '.portfolio-wrap .item-img-overlay div, .footer-top .footer-widget .mc4wp-form-fields button[type="submit"], .footer-top .footer-widget .mc4wp-form-fields input[type="submit"], .social li .fa:hover, .social li .fa:focus {background-color:' . $corpboot_opt['global_style_color'] . ' !important;}' . "\n\r";
            // Color
            $output .= '.navbar-default .navbar-nav > li > a, .home-promo .titlepro .middle strong, .home-icons .fa, .home-icons .glyphicon, .title h2, .title h3, .blognews a, .blognews a:hover, .blognews a:focus, .author, .author i,
                        .slick-dots li.slick-active button:before, .intro-text, .slick-prev:before, .slick-next:before, .navbar-default .navbar-nav .dropdown-menu > li > a, .title-r h2, .title-r h3, .title-r h4, .title-r h5, .title-r h6, .title-r p, .home-icons h4,
                        .wpb_wrapper .wpb_content_element h1, .wpb_wrapper .wpb_content_element h2, .wpb_wrapper .wpb_content_element h3, .wpb_wrapper .wpb_content_element h4, .wpb_wrapper .wpb_content_element h5, .wpb_wrapper .wpb_content_element h6, .color5,
                        .panel-group .panel-heading a:hover, .panel-group .panel-heading a:focus, .panel-group .panel-heading a:active, .panel-group .panel-heading a, .panel-group .panel-heading a:after, .skills > h5, .color4, .team-name h4, .facts-title,
                        .nav-about-carousel > li.active > a, .nav-about-carousel > li.active > a:hover, .nav-about-carousel > li.active > a:focus, .color6, .tab-content ul li:before, ul.listicon-check li:before, .servdesc > h3, .ico-services, .portfolio-filters li,
                        .entry-title a:hover, .entry-title a:focus, .author-list, .author-list a, .widget ul li a:hover, .entry-title a, .author-list i, .pagination a, .pagination span, .entry-title, .view-all, .comment-reply-title,
                        .nav-tabs > li > a:focus, ul.listicon-times li:before, ul.listicon-chevron-right li:before {color:' . $corpboot_opt['global_style_color'] . ' !important;}' . "\n\r";
            // Border color
            $output .= '.btn-transparent:hover, .btn-transparent:focus, .btn-transparent:active, .nav-tabs > li > a:hover, .nav-tabs > li > a:focus, .widget_search .search-form:after, .tags-links a:hover, .tagcloud a:hover, .nav-tabs > li > a:hover, .nav-tabs > li > a:focus,
                        .footer-top .footer-widget .mc4wp-form-fields button[type="submit"], .footer-top .footer-widget .mc4wp-form-fields input[type="submit"] {border-color:' . $corpboot_opt['global_style_color'] . ' !important;}' . "\n\r";
            $output .= '.cssload-double-torus {border-color:transparent ' . $corpboot_opt['global_style_color'] . ' ' . $corpboot_opt['global_style_color'] . ' !important;}' . "\n\r";
            $output .= '.navbar-default, .footer-bottom {border-top-color:' . $corpboot_opt['global_style_color'] . ' !important;}' . "\n\r";
            $output .= '.nav-wizard > li.active > a:after, .nav-wizard > li.done:hover > a:after, .nav-wizard > li:hover > a:after {border-left-color:' . $corpboot_opt['global_style_color'] . ' !important;}' . "\n\r";
        }

        /* Footer color */
        if( ! empty( $corpboot_opt['footer_sidebar_color'] ) ) {
            $output .= '.footer-top {background-color:' . $corpboot_opt['footer_sidebar_color'] . ' !important;}' . "\n\r";
            $output .= '.footer-bottom {border-top-color:' . $corpboot_opt['footer_sidebar_color'] . ' !important;}' . "\n\r";
        }

        if( ! empty( $corpboot_opt['footer_bottom_color'] ) ) {
            $output .= '.footer-bottom {background-color:' . $corpboot_opt['footer_bottom_color'] . ' !important;}' . "\n\r";
        }

		/* Custom CSS code */
		if( ! empty( $corpboot_opt['custom_css_styles'] ) ) {
			$output .= $corpboot_opt['custom_css_styles'];
		}

		if( ! empty( $output ) ) {
			wp_add_inline_style( 'corpboot-theme-css', $output );
		}

		/* Custom JavaScript code */
		if( ! empty( $corpboot_opt['custom_js_code'] ) ) {
			if ( function_exists( 'wp_add_inline_script' ) ) {
				wp_add_inline_script( 'corpboot-theme-js', $corpboot_opt['custom_js_code'] );
			}
		}
	}
}

