<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// METABOX OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options      = array();

// -----------------------------------------
// PORTFOLIO OPTIONS                       -
// -----------------------------------------
$options[]    = array(
    'id'        => 'corpboot_portfolio_options',
    'title'     => 'Portfolio preview settings',
    'post_type' => 'portfolio',
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => array(
        array(
            'name'   => 'section_3',
            'fields' => array(
                array(
                    'id'          => 'post_preview_style',
                    'type'        => 'select',
                    'title'       => 'Preview style',
                    'options'     => array(
                        'image'      => 'Post image',
                        'video'      => 'Video',
                        'tabs'       => 'Tabs',
                        'full_image' => 'Full Image',
                        'full_video' => 'Full Video',
                    ),
                    'default'     => array( 'image' )
                ),
                /* Image */
                array(
                    'id'    => 'title_link_project',
                    'type'  => 'text',
                    'title' => 'Title link project',
                    'dependency'   => array( 'post_preview_style', 'any', 'image,video' ),
                ),
                array(
                    'id'    => 'link_project',
                    'type'  => 'text',
                    'title' => 'Link project',
                    'dependency'   => array( 'post_preview_style', 'any', 'image,video' ),
                ),
                array(
                    'id'    => 'title_list_portfolio',
                    'type'  => 'text',
                    'title' => 'Title list portfolio',
                    'dependency'   => array( 'post_preview_style', 'any', 'image,video' ),
                ),
                array(
                    'id'              => 'list_portfolio',
                    'type'            => 'group',
                    'title'           => 'List Portfolio',
                    'button_title'    => 'Add New',
                    'accordion_title' => 'Add New Field',
                    'fields'          => array(
                        array(
                            'id'    => 'title_list',
                            'type'  => 'text',
                            'title' => 'Title list',
                        ),
                    ),
                    'dependency'   => array( 'post_preview_style', 'any', 'image,video' ),
                ),
                /* Video */
                array(
                    'id'          => 'post_video',
                    'type'        => 'wysiwyg',
                    'title'       => 'Video iframe code',
                    'dependency'  => array( 'post_preview_style', '==', 'video' )
                ),
                /* Full Video */
                array(
                    'id'          => 'post_full_video',
                    'type'        => 'wysiwyg',
                    'title'       => 'Full Video',
                    'dependency'  => array( 'post_preview_style', '==', 'full_video' )
                ),
                /* Slider */
                array(
                    'id'              => 'post_tabs',
                    'type'            => 'group',
                    'title'           => 'Tabs portfolio',
                    'button_title'    => 'Add New',
                    'accordion_title' => 'Add New Field',
                    'fields'          => array(
                        array(
                            'id'    => 'title_tabs',
                            'type'  => 'text',
                            'title' => 'Title tab',
                        ),
                        array(
                            'id'    => 'content_tabs',
                            'type'  => 'textarea',
                            'title' => 'Content tab',
                        ),
                        array(
                            'id'    => 'title_link',
                            'type'  => 'text',
                            'title' => 'Title link project',
                        ),
                        array(
                            'id'    => 'url_link',
                            'type'  => 'text',
                            'title' => 'Link project',
                        ),
                        array(
                            'id'        => 'image_tabs',
                            'type'      => 'image',
                            'title'     => 'Image tab',
                            'add_title' => 'Add Image',
                        ),
                    ),
                    'dependency'   => array( 'post_preview_style', '==', 'tabs' ),
                ),
            )
        )
    )
);

// -----------------------------------------
// PAGE OPTIONS                            -
// -----------------------------------------
$options[]    = array(
	'id'        => 'corpboot_page_options',
	'title'     => 'Page settings',
	'post_type' => 'page',
	'context'   => 'normal',
	'priority'  => 'high',
	'sections'  => array(
		array(
			'name'   => 'section_3',
			'fields' => array(
				array(
					'id'      => 'page_footer',
					'type'    => 'switcher',
					'title'   => 'Page footer',
					'default' => true
				),
			)
		),
	)
);

CSFramework_Metabox::instance( $options );
