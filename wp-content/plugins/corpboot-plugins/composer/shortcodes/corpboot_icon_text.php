<?php
/*
 * Icon Text Shortcode
 * Author: QodeArena
 * Author URI: http://qodearena.com/
 * Version: 1.0.0
 */

vc_map(
    array(
        'name'        => __( 'Icon Text', 'js_composer' ),
        'base'        => 'corpboot_icon_text',
        'params'      => array(
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Title', 'js_composer' ),
                'admin_label' => true,
                'param_name'  => 'title'
            ),
            array(
                'heading'     => __( 'Icon', 'js_composer' ),
                'type'        => 'iconpicker',
                'param_name'  => 'icon',
                'description' => __( 'Select icon from library.', 'js_composer' ),
            ),
            array(
                'type' 		  => 'textarea',
                'heading'     => __( 'Content', 'js_composer' ),
                'param_name'  => 'text',
                'value' 	  => ''
            ),
            array(
                'heading' 	  => __( 'Position item', 'js_composer' ),
                'type' 		  => 'dropdown',
                'param_name'  => 'position',
                'value' 	  => array(
                    __( 'Left', 'js_composer' )      => 'left',
                    __( 'Top', 'js_composer' )       => 'top',
                    __( 'Right', 'js_composer' )     => 'right',
                    __( 'Bottom', 'js_composer' )    => 'bottom',
                ),
                'dependency' => array( 'element' => 'style', 'value' => 'modern' ),
            ),
            array(
                'heading' 	  => __( 'Align content', 'js_composer' ),
                'type' 		  => 'dropdown',
                'param_name'  => 'align',
                'value' 	  => array(
                    __( 'Left', 'js_composer' )     => 'left',
                    __( 'Center', 'js_composer' )   => 'center',
                    __( 'Right', 'js_composer' )    => 'right'
                ),
                'dependency' => array( 'element' => 'style', 'value' => 'modern' ),
            ),
            array(
                'type' 		  => 'textfield',
                'heading' 	  => __( 'Extra class name', 'js_composer' ),
                'param_name'  => 'el_class',
                'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
                'value' 	  => ''
            ),
            /* Style tab */
            array(
                'heading' 	  => __( 'Style', 'js_composer' ),
                'type' 		  => 'dropdown',
                'param_name'  => 'style',
                'value' 	  => array(
                    __( 'Default', 'js_composer' )  => 'default',
                    __( 'Modern', 'js_composer' )   => 'modern',
                    __( 'Custom', 'js_composer' )   => 'custom'
                ),
                'group' 	 => __( 'Style', 'js_composer' )
            ),
            array(
                'type' => 'animation_style',
                'heading' => __( 'Animation In', 'js_composer' ),
                'param_name' => 'animation',
                'group' 	 => __( 'Style', 'js_composer' ),
                'settings' => array(
                    'type' => array(
                        'in',
                        'other',
                    ),
                ),
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Title font size', 'js_composer' ),
                'param_name'  => 'title_font_size',
                'value'       => '',
                'dependency'  => array( 'element' => 'style', 'value' => 'custom' ),
                'group' 	  => __( 'Style', 'js_composer' )
            ),
            array(
                'type'        => 'colorpicker',
                'heading'     => __( 'Title color', 'js_composer' ),
                'param_name'  => 'title_color',
                'dependency'  => array( 'element' => 'style', 'value' => 'custom' ),
                'group' 	  => __( 'Style', 'js_composer' )
            ),
            array(
                'type' 		 => 'dropdown',
                'heading' 	 => __( 'Title font family', 'js_composer' ),
                'param_name' => 'title_font_family',
                'value' 	 => array(
                    __( 'Default',  'js_composer' ) => 'default',
                    __( 'Custom',   'js_composer' ) => 'custom'
                ),
                'dependency' => array( 'element' => 'style', 'value' => 'custom' ),
                'group' 	 => __( 'Style', 'js_composer' )
            ),
            array(
                'type' 		 => 'google_fonts',
                'param_name' => 'title_font',
                'value' 	 => '',
                'settings'   => array(
                    'fields' => array(
                        'font_family_description' => __( 'Select font family.', 'js_composer' ),
                        'font_style_description'  => __( 'Select font styling.', 'js_composer' ),
                    ),
                ),
                'dependency' => array( 'element' => 'title_font_family', 'value' => 'custom' ),
                'group' 	 => __( 'Style', 'js_composer' )
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Content font size', 'js_composer' ),
                'param_name'  => 'content_font_size',
                'dependency'  => array( 'element' => 'style', 'value' => 'custom' ),
                'group' 	  => __( 'Style', 'js_composer' )
            ),
            array(
                'type'        => 'colorpicker',
                'heading'     => __( 'Content color', 'js_composer' ),
                'param_name'  => 'content_color',
                'dependency'  => array( 'element' => 'style', 'value' => 'custom' ),
                'group' 	 => __( 'Style', 'js_composer' )
            ),
            array(
                'type' 		 => 'dropdown',
                'heading' 	 => __( 'Content font family', 'js_composer' ),
                'param_name' => 'content_font_family',
                'value' 	 => array(
                    __( 'Default',  'js_composer' ) => 'default',
                    __( 'Custom',   'js_composer' ) => 'custom'
                ),
                'dependency' => array( 'element' => 'style', 'value' => 'custom' ),
                'group' 	 => __( 'Style', 'js_composer' )
            ),
            array(
                'type' 		 => 'google_fonts',
                'param_name' => 'content_font',
                'value' 	 => '',
                'settings'   => array(
                    'fields' => array(
                        'font_family_description' => __( 'Select font family.', 'js_composer' ),
                        'font_style_description'  => __( 'Select font styling.', 'js_composer' ),
                    ),
                ),
                'dependency' => array( 'element' => 'content_font_family', 'value' => 'custom' ),
                'group' 	 => __( 'Style', 'js_composer' )
            ),
            /* CSS editor */
            array(
                'type' 		  => 'css_editor',
                'heading' 	  => __( 'CSS box', 'js_composer' ),
                'param_name'  => 'css',
                'group' 	  => __( 'Design options', 'js_composer' )
            )
        )
    )
);

class WPBakeryShortCode_corpboot_icon_text extends WPBakeryShortCode{
    protected function content( $atts, $content = null ) {

        extract( shortcode_atts( array(
            'title' 			  => '',
            'icon' 				  => '',
            'text' 				  => '',
            'position' 			  => 'left',
            'align' 			  => 'left',
            'animation' 		  => '',
            'el_class' 			  => '',
            'style' 			  => 'default',
            'title_font_size' 	  => '',
            'title_color' 		  => '',
            'title_font_family'   => 'default',
            'title_font' 		  => '',
            'content_font_size'   => '',
            'content_color' 	  => '',
            'content_font_family' => 'default',
            'content_font' 		  => '',
            'css' 				  => ''
        ), $atts ) );


        $class  = ( ! empty( $el_class ) ) ? $el_class : '';
        $class .= vc_shortcode_custom_css_class( $css, ' ' );

        // Align content
        $align = 'text-' . $align;

        // Animation content
        $animation = ( ! empty( $animation ) ) ? $animation : 'fadeInUp';

        // Position content
        $position = ( isset( $position ) ) ? $position : 'left';

        $title_style     = '';
        $content_style   = '';

        /* Custom shortcode styles */
        if( $style == 'custom' ) {
            $google_fonts = new Vc_Google_Fonts;

            /* Title style */
            if( ! empty( $title_font_size ) ) {
                $title_style = ( is_numeric( $title_font_size ) ) ? 'font-size: ' . $title_font_size . 'px;' : 'font-size: ' . $title_font_size . ';';
            }
            $title_style .= ( ! empty( $title_color ) ) ? 'color: ' . $title_color . ';' : '';

            if( $title_font_family == 'custom' ) {

                $title_font = $google_fonts->_vc_google_fonts_parse_attributes( $atts, $title_font );

                $subsets  = '';
                $settings = get_option( 'wpb_js_google_fonts_subsets' );
                if ( is_array( $settings ) && ! empty( $settings ) ) {
                    $subsets = '&subset=' . implode( ',', $settings );
                }

                wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $title_font['values']['font_family'] ), '//font.googleapis.com/css?family=' . $title_font['values']['font_family'] . $subsets );

                $title_font = explode( ':', $title_font['values']['font_family'] );

                $title_style .= 'font-family: ' . $title_font[0] . ';';
            }

            /* Content style */
            if( ! empty( $content_font_size ) ) {
                $content_style = ( is_numeric( $content_font_size ) ) ? 'font-size: ' . $content_font_size . 'px;' : 'font-size: ' . $content_font_size . ';';
            }
            $content_style .= ( ! empty( $content_color ) ) ? 'color: ' . $content_color . ';' : '';

            if( $content_font_family == 'custom' ) {

                $content_font = $google_fonts->_vc_google_fonts_parse_attributes( $atts, $content_font );

                $subsets  = '';
                $settings = get_option( 'wpb_js_google_fonts_subsets' );
                if ( is_array( $settings ) && ! empty( $settings ) ) {
                    $subsets = '&subset=' . implode( ',', $settings );
                }

                wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $content_font['values']['font_family'] ), '//font.googleapis.com/css?family=' . $content_font['values']['font_family'] . $subsets );

                $content_font = explode( ':', $content_font['values']['font_family'] );

                $content_style .= 'font-family: ' . $content_font[0] . ';';
            }

            $content_style   = ( ! empty( $content_style ) )   ? 'style="' . $content_style . '"' : '';
            $title_style     = ( ! empty( $title_style ) )     ? 'style="' . $title_style . '"' : '';
        }

        $output = '';

        if( $style == 'default' ) {

            $output .= '<div class="text-center home-icons ' . esc_attr( $class ) . '">';

                // Icon
                if( ! empty( $icon ) ) {
                    $output .= '<i class="' . esc_attr( $icon ) . ' wow ' . $animation . '" data-wow-delay="20ms"></i>';
                }

                $output .= '<div>';

                    // Title
                    if (!empty($title)) {
                        $output .= '<h4 ' . $title_style . '>' . esc_html( $title ) . '</h4>';
                    }

                    // Description
                    if (!empty($text)) {
                        $output .= '<h5 ' . $content_style . '>' . esc_html( $text ) . '</h5>';
                    }

                $output .= '</div>';

            $output .= '</div>';

        } elseif ( $style == 'modern' ) {
            $output .= '<div class="row wow ' . $animation . ' ' . esc_attr( $class ) . '" data-wow-duration="600ms" data-wow-delay="100ms">';

                if( $position == 'left' || $position == 'top' ) :
                    // Icon
                    $size_item = ( $position == 'top' ) ? 'col-xs-12' : 'col-xs-3';
                    if( ! empty( $icon ) ) {
                        $output .= '<div class="' . esc_attr( $size_item ) . ' text-center">';
                            $output .= '<i class="' . esc_attr( $icon ) . ' fa-4x ico-services"></i>';
                        $output .= '</div>';
                    }
                endif;

                $size_item = ( $position == 'left' || $position == 'right' ) ? 'col-xs-9' : 'col-xs-12';
                $output .= '<div class="' . esc_attr( $size_item ) . ' servdesc ' . $align . '">';

                    // Title
                    if (!empty($title)) {
                        $output .= '<h6 ' . $title_style . '>' . esc_html( $title ) . '</h6>';
                    }

                    // Description
                    if (!empty($text)) {
                        $output .= '<p ' . $content_style . '>' . esc_html( $text ) . '</p>';
                    }

                $output .= '</div>';

                if( $position == 'right' || $position == 'bottom' ) :
                    // Icon
                    $size_item = ( $position == 'bottom' ) ? 'col-xs-12' : 'col-xs-2';

                    if( ! empty( $icon ) ) {
                        $output .= '<div class="' . esc_attr( $size_item ) . ' text-center">';
                        $output .= '<i class="' . esc_attr( $icon ) . ' fa-4x ico-services"></i>';
                        $output .= '</div>';
                    }
                endif;

            $output .= '</div>';
        }

        return  $output;
    }
}