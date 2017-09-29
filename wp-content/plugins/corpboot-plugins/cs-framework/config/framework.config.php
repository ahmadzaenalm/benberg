<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$settings = array(
    'menu_title' 		=> 'Theme options',
    'menu_type'  		=> 'menu',
    'menu_slug'  		=> 'qodearena-options',
    'ajax_save'  		=> true,
    'show_reset_all' 	=> true,
    'framework_title'	=> 'Theme options <small>by QodeArena</small>',
);

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options = array();

// ----------------------------------------
// General option section
// ----------------------------------------
$options[] = array(
    'name'        => 'general',
    'title'       => 'General',
    'icon'        => 'fa fa-cog',
    'fields'      => array(
        array(
            'id'      => 'page_preloader',
            'type'    => 'switcher',
            'title'   => 'Page preloader',
            'default' => true
        ),
        array(
            'id'      => 'page_scroll_up',
            'type'    => 'switcher',
            'title'   => 'Page scroll up',
            'default' => true
        ),
        array(
            'id'         => 'favicon_icon',
            'type'       => 'upload',
            'title'      => 'Favicon icon',
        ),
        array(
            'id'      => 'global_style_color',
            'type'    => 'color_picker',
            'title'   => 'Global style color'
        ),
    )
);

// ----------------------------------------
// Typography option section
// ----------------------------------------
$options[] = array(
    'name'        => 'typography',
    'title'       => 'Typography',
    'icon'        => 'fa fa-font',
    'fields'      => array(
        array(
            'type'    => 'subheading',
            'content' => 'Global typography style',
        ),
        array(
            'id'              => 'typography_style',
            'type'            => 'group',
            'title'           => 'Typography Headings',
            'button_title'    => 'Add New',
            'accordion_title' => 'Add New Icon',

            // begin: fields
            'fields'      => array(

                // header size
                array(
                    'id'             => 'heading_tag',
                    'type'           => 'select',
                    'title'          => 'Title Tag',
                    'options'        => array(
                        'h1'    => esc_html__('H1','corpboot'),
                        'h2'    => esc_html__('H2','corpboot'),
                        'h3'    => esc_html__('H3','corpboot'),
                        'h4'    => esc_html__('H4','corpboot'),
                        'h5'    => esc_html__('H5','corpboot'),
                        'h6'    => esc_html__('H6','corpboot'),
                        'p'     => esc_html__('Paragraph','corpboot'),
                        'span'  => esc_html__('Span','corpboot'),
                    ),
                ),

                // font family
                array(
                    'id'        => 'heading_family',
                    'type'      => 'typography',
                    'title'     => 'Font Family',
                    'default'   => array(
                        'family'  => 'Lato',
                        'variant' => 'regular',
                        'font'    => 'google', // this is helper for output
                    ),
                ),

                // font size
                array(
                    'id'          => 'heading_size',
                    'type'        => 'text',
                    'title'       => 'Font Size',
                    'default'     => '24',
                ),

                // font color
                array(
                    'id'      => 'heading_color',
                    'type'    => 'color_picker',
                    'title'   => 'Font Color',
                ),
            ),
        ),
        array(
            'type'    => 'subheading',
            'content' => 'Menu typography style',
        ),
        array(
            'id'      => 'default_header_typography',
            'type'    => 'switcher',
            'title'   => 'Default header typography',
            'default' => true
        ),
        array(
            'id'        => 'header_typography_group',
            'type'      => 'fieldset',
            'title'     => 'Menu typography',
            'fields'    => array(
                array(
                    'id'      => 'header_typography',
                    'type'    => 'typography',
                    'title'   => 'Font',
                    'default'   => array(
                        'font'    => 'google',
                    ),
                ),
                array(
                    'id'      => 'header_font_size',
                    'type'    => 'number',
                    'title'   => 'Menu font size',
                    'after'   => ' <i class="cs-text-muted">(px)</i>'
                ),
                array(
                    'id'      => 'header_font_color',
                    'type'    => 'color_picker',
                    'title'   => 'Menu font color',
                ),
            ),
            'dependency' => array( 'default_header_typography', '==', false )
        ),
    )
);

// ----------------------------------------
// Header option section
// ----------------------------------------
$options[] = array(
    'name'        => 'header',
    'title'       => 'Header',
    'icon'        => 'fa fa-star',
    'fields'      => array(
        array(
            'type'    => 'subheading',
            'content' => 'Other settings',
        ),
        array(
            'id'         => 'logo_type',
            'type'       => 'select',
            'title'      => 'Logo type',
            'options'    => array(
                'image'   => 'Image',
                'text'    => 'Text'
            ),
            'default' => 'text'
        ),
        array(
            'id'         => 'site_logo',
            'type'       => 'upload',
            'title'      => 'Site Logo',
            'desc'       => 'Upload any media using the WordPress Native Uploader.',
            'dependency' => array( 'logo_type', '==', 'image' )
        ),
        array(
            'id'         => 'retina_logo',
            'type'       => 'upload',
            'title'      => 'Retina Logo',
            'desc'       => 'Upload any media using the WordPress Native Uploader.',
            'dependency' => array( 'logo_type', '==', 'image' )
        ),
        array(
            'id'         => 'text_logo',
            'type'       => 'text',
            'title'      => 'Text logo',
            'default'    => 'QodeArena',
            'dependency' => array( 'logo_type', '==', 'text' )
        ),
        array(
            'id'         => 'text_logo_font_size',
            'type'       => 'text',
            'title'      => 'Text logo font size',
            'dependency' => array( 'logo_type', '==', 'text' )
        ),
        array(
            'id'      => 'header_logo_color',
            'type'    => 'color_picker',
            'title'   => 'Menu logo color',
            'dependency' => array( 'logo_type', '==', 'text' )
        ),
    ) // end: fields
);

// ----------------------------------------
// Footer option section                  -
// ----------------------------------------
$options[] = array(
    'name'        => 'footer',
    'title'       => 'Footer',
    'icon'        => 'fa fa-copyright',
    'fields'      => array(
        array(
            'type'    => 'subheading',
            'content' => 'Other settings',
        ),
        array(
            'id'           => 'footer_social_links',
            'type'         => 'group',
            'title'        => 'Header social links',
            'button_title' => 'Add New',
            'fields'       => array(
                array(
                    'id'     => 'footer_social_link',
                    'type'   => 'text',
                    'title'  => 'Link'
                ),
                array(
                    'id'     => 'footer_social_icon',
                    'type'   => 'icon',
                    'title'  => 'Icon'
                ),
            ),
            'default' => array(
                array(
                    'footer_social_link'  => 'https://fb.com/',
                    'footer_social_icon'  => 'fa fa-facebook',
                ),
                array(
                    'footer_social_link'  => 'https://twitter.com/',
                    'footer_social_icon'  => 'fa fa-twitter',
                ),
                array(
                    'footer_social_link'  => 'https://linkedin.com/',
                    'footer_social_icon'  => 'fa fa-linkedin',
                ),
                array(
                    'footer_social_link'  => 'https://www.youtube.com/',
                    'footer_social_icon'  => 'fa fa-youtube',
                ),
                array(
                    'footer_social_link'  => 'https://www.instagram.com/',
                    'footer_social_icon'  => 'fa fa-instagram',
                ),
            ),
        ),
        array(
            'id'         => 'footer_copyright',
            'type'       => 'textarea',
            'title'      => 'Copyright text',
            'default'    => 'Made with love by QodeArena',
        ),
        array(
            'id'      => 'footer_sidebar_color',
            'type'    => 'color_picker',
            'title'   => 'Footer sidebar color'
        ),
        array(
            'id'      => 'footer_bottom_color',
            'type'    => 'color_picker',
            'title'   => 'Footer bottom color'
        ),

    ) // end: fields
);

// ----------------------------------------
// Blog                                   -
// ----------------------------------------
$options[] = array(
    'name'        => 'blog',
    'title'       => 'Blog',
    'icon'        => 'fa fa-book',
    'fields'      => array(
        /** Blog setting **/
        array(
            'type'    => 'subheading',
            'content' => 'Blog Banner Setting',
        ),
        array(
            'id'      	 => 'show_blog_breadcrumb',
            'type'    	 => 'switcher',
            'title'   	 => 'Show/Hide blog breadcrumb',
            'default' 	 => true
        ),
        array(
            'id'      	 => 'blog_banner',
            'type'    	 => 'switcher',
            'title'   	 => 'Blog banner',
            'default' 	 => true
        ),
        array(
            'id'      	 => 'blog_banner_title',
            'type'    	 => 'text',
            'title'   	 => 'Banner title',
            'dependency' => array( 'blog_banner', '==', true )
        ),
        array(
            'type'    => 'subheading',
            'content' => 'Other Setting',
        ),
        array(
            'id'      => 'blog_sidebar',
            'type'    => 'select',
            'title'   => 'Blog sidebar',
            'options' => array(
                'left'    => 'Left',
                'right'   => 'Right',
                'disable' => 'Disable'
            ),
            'default' => 'right'
        ),
        /** Post blog setting **/
        array(
            'type'    => 'subheading',
            'content' => 'Post blog Setting',
        ),
        array(
            'id'      	 => 'post_banner',
            'type'    	 => 'switcher',
            'title'   	 => 'Post banner',
            'default' 	 => true
        ),
        array(
            'id'      	 => 'post_banner_title',
            'type'    	 => 'text',
            'title'   	 => 'Banner title',
            'dependency' => array( 'post_banner', '==', true )
        ),
        array(
            'id'      => 'post_sidebar',
            'type'    => 'select',
            'title'   => 'Single post sidebar',
            'options' => array(
                'left'    => 'Left',
                'right'   => 'Right',
                'disable' => 'Disable'
            ),
            'default' => 'right'
        ),
        array(
            'id'      => 'post_navigation',
            'type'    => 'switcher',
            'title'   => 'Single post navigation',
            'desc'	  => 'Prev/next post on single post page.',
            'default' => true
        ),
    )
);

// ----------------------------------------
// Custom CSS and JS
// ----------------------------------------
$options[] = array(
    'name'        => 'custom_css',
    'title'       => 'Custom CSS and JS',
    'icon'        => 'fa fa-paint-brush',
    'fields'      => array(
        array(
            'id'         => 'custom_css_styles',
            'desc'       => 'Only CSS, without tag &lt;style&gt;.',
            'type'       => 'textarea',
            'title'      => 'Custom CSS code'
        ),
        array(
            'id'         => 'custom_js_code',
            'desc'       => 'Only JS code, without tag &lt;script&gt;.',
            'type'       => 'textarea',
            'title'      => 'Custom JS code'
        )
    )
);

// ----------------------------------------
// 404 Page                               -
// ----------------------------------------
$options[] = array(
    'name'        => 'error_page',
    'title'       => '404 Page',
    'icon'        => 'fa fa-bolt',
    'fields'      => array(
        array(
            'id'      => 'show_breadcrumb_404',
            'type'    => 'switcher',
            'title'   => 'Show/Hidden Breadcrumb',
            'default' => true
        ),
        array(
            'id'      => 'error_title',
            'type'    => 'text',
            'title'   => 'Error title',
            'default' => 'Oops, Page Not Found',
        ),
        array(
            'id'         => 'error_content',
            'type'       => 'text',
            'title'      => 'Error content',
            'default' => 'Looks like something went completely wrong!',
        ),
        array(
            'id'        => 'error_link',
            'type'      => 'fieldset',
            'title'     => 'Error link',
            'fields'    => array(
                array(
                    'id'    => 'error_link_url',
                    'type'  => 'text',
                    'title' => 'Error link URL',
                ),
                array(
                    'id'    => 'error_link_title',
                    'type'  => 'text',
                    'title' => 'Error link title',
                ),
            ),
        ),
    ) // end: fields
);

// ----------------------------------------
// Backup
// ----------------------------------------
$options[] = array(
    'name'     => 'backup_section',
    'title'    => 'Backup',
    'icon'     => 'fa fa-shield',
    'fields'   => array(
        array(
            'type'    => 'notice',
            'class'   => 'warning',
            'content' => 'You can save your current options. Download a Backup and Import.',
        ),
        array(
            'type'    => 'backup',
        ),
    ) // end: fields
);

// ----------------------------------------
// Documentation
// ----------------------------------------
$options[]  = array(
    'name'     => 'documentation_section',
    'title'    => 'Documentation',
    'icon'     => 'fa fa-info-circle',
    'fields'   => array(
        array(
            'type'    => 'heading',
            'content' => 'Documentation'
        ),
        array(
            'type'    => 'content',
            'content' => 'To view the documentation, go to <a href="'. esc_attr('http://qodearena.com') .'" target="_blank">documentation page</a>.',
        ),
    )
);

CSFramework::instance( $settings, $options );
