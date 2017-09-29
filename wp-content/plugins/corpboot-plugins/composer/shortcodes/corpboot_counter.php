<?php
/*
 * Counter Shortcode
 * Author: QodeArena
 * Author URI: https://themeforest.net/user/qodearena
 * Version: 1.0.0
 */

vc_map(
    array(
        'name'        => __( 'Counter', 'js_composer' ),
        'base'        => 'corpboot_counter',
        'params'      => array(
            array(
                'type' 		 => 'dropdown',
                'heading' 	 => __( 'Style counter', 'js_composer' ),
                'param_name' => 'style_counter',
                'value' 	 => array(
                    __( 'Default',  'js_composer' ) => 'default',
                    __( 'Modern',   'js_composer' ) => 'modern'
                ),
            ),
            array(
                'type'        => 'textarea',
                'heading'     => __( 'Title', 'js_composer' ),
                'admin_label' => true,
                'param_name'  => 'title'
            ),
            array(
                'type'        => 'textarea',
                'heading'     => __( 'Number', 'js_composer' ),
                'param_name'  => 'number'
            ),
            array(
                'heading'     => __( 'Icon', 'js_composer' ),
                'type'        => 'iconpicker',
                'param_name'  => 'icon',
                'description' => __( 'Select icon from library.', 'js_composer' ),
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
                'type'        => 'textfield',
                'heading'     => __( 'Title font size', 'js_composer' ),
                'param_name'  => 'title_font_size',
                'value'       => '',
                'group' 	  => __( 'Style', 'js_composer' )
            ),
            array(
                'type'        => 'colorpicker',
                'heading'     => __( 'Title color', 'js_composer' ),
                'param_name'  => 'title_color',
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
                'heading'     => __( 'Number font size', 'js_composer' ),
                'param_name'  => 'number_font_size',
                'value'       => '',
                'group' 	  => __( 'Style', 'js_composer' )
            ),
            array(
                'type'        => 'colorpicker',
                'heading'     => __( 'Number color', 'js_composer' ),
                'param_name'  => 'number_color',
                'group' 	  => __( 'Style', 'js_composer' )
            ),
            array(
                'type' 		 => 'dropdown',
                'heading' 	 => __( 'Number font family', 'js_composer' ),
                'param_name' => 'number_font_family',
                'value' 	 => array(
                    __( 'Default',  'js_composer' ) => 'default',
                    __( 'Custom',   'js_composer' ) => 'custom'
                ),
                'group' 	 => __( 'Style', 'js_composer' )
            ),
            array(
                'type' 		 => 'google_fonts',
                'param_name' => 'number_font',
                'value' 	 => '',
                'settings'   => array(
                    'fields' => array(
                        'font_family_description' => __( 'Select font family.', 'js_composer' ),
                        'font_style_description'  => __( 'Select font styling.', 'js_composer' ),
                    ),
                ),
                'dependency' => array( 'element' => 'number_font_family', 'value' => 'custom' ),
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

class WPBakeryShortCode_corpboot_counter extends WPBakeryShortCode{
    protected function content( $atts, $content = null ) {

        extract( shortcode_atts( array(
            'style_counter'      => 'default',
            'title' 			 => '',
            'number' 			 => '',
            'icon' 				 => '',
            'el_class' 			 => '',
            'title_font_size' 	 => '',
            'title_color' 		 => '',
            'title_font_family'  => 'default',
            'title_font' 	     => '',
            'number_font_size' 	 => '',
            'number_color' 		 => '',
            'number_font_family' => 'default',
            'number_font' 	     => '',
            'css' 			     => ''
        ), $atts ) );

        $google_fonts = new Vc_Google_Fonts;

        $class  = ( ! empty( $el_class ) ) ? $el_class : '';
        $class .= vc_shortcode_custom_css_class( $css, ' ' );

        $output = '';

        $title_style 	= '';
        $number_style 	= '';

        /* Get styles from options */
        $styles = array('title', 'number');

        foreach ( $styles as $item ) {

            if( ! empty( ${$item."_font_size"} ) ) {
                ${$item."_style"} = ( is_numeric( ${$item."_font_size"} ) ) ? 'font-size: ' . ${$item."_font_size"} . 'px;' : 'font-size: ' . ${$item."_font_size"} . ';';
            }
            ${$item."_style"} .= ( ! empty( ${$item."_color"} ) ) ? 'color: ' . ${$item."_color"} . ';' : '';

            if( ${$item."_font_family"} == 'custom' ) {
                ${$item."_font"} = $google_fonts->_vc_google_fonts_parse_attributes( $atts, ${$item."_font"} );

                $subsets  = '';
                $settings = get_option( 'wpb_js_google_fonts_subsets' );
                if ( is_array( $settings ) && ! empty( $settings ) ) {
                    $subsets = '&subset=' . implode( ',', $settings );
                }

                wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( ${$item."_font"}['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . ${$item."_font"}['values']['font_family'] . $subsets );

                $google_fonts_family = explode( ':', ${$item."_font"}['values']['font_family'] );
                ${$item."_style"} .= 'font-family:' . $google_fonts_family[0] . ';';
                $google_fonts_styles = explode( ':', ${$item."_font"}['values']['font_style'] );
                ${$item."_style"} .= 'font-weight:' . $google_fonts_styles[1] . ';';
                ${$item."_style"} .= 'font-style:' . $google_fonts_styles[2] . ';';
            }

            ${$item."_style"} = ( ! empty( ${$item."_style"} ) ) ? 'style="' . ${$item."_style"} . '"' : '';

        }

        $output .= '<div class="counterUp text-center ' . esc_attr( $class ) . '">';

            if( isset( $style_counter ) && $style_counter == 'modern' ) {
                $output .= '<h3 class="facts-title">';
                // Icon counter
                if( ! empty( $icon ) ) {
                    $output .= '<i class="' . esc_attr( $icon ) . ' le"></i> ';
                }

                // Count Counter
                if( ! empty( $number ) ) {
                    $output .= '<span class="count">' . esc_html( $number ) . '</span>';
                }
                $output .= '</h3>';
            } else {
                // Icon counter
                if( ! empty( $icon ) ) {
                    $output .= '<figure class="home-icons">';
                    $output .= '<i class="' . esc_attr( $icon ) . ' le"></i>';
                    $output .= '</figure>';
                }

                // Count Counter
                $output .= ( ! empty( $number ) ? '<h3 class="facts-title" ' . $number_style . '><span class="count">' . esc_html( $number ) . '</span></h3>' : '' );
            }

            // Title counter
            $output .= ( ! empty( $title ) ? '<h6 class="color4" ' . $title_style . '>' . esc_html( $title ) . '</h6>' : '' );

        $output .= '</div>';

        return $output;
    }
}