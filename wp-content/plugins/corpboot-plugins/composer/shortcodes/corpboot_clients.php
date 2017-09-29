<?php
/*
 * Clients Shortcode
 * Author: QodeArena
 * Author URI: https://themeforest.net/user/qodearena
 * Version: 1.0.0
 */

vc_map(
    array(
        'name'                    => __( 'Clients', 'js_composer' ),
        'base'                    => 'corpboot_clients',
        'content_element'         => true,
        'show_settings_on_create' => true,
        'params' => array(
            array(
                'type'       => 'param_group',
                'heading'    => __( 'Logos', 'js_composer' ),
                'param_name' => 'items',
                'params'     => array(
                    array(
                        'type'        => 'attach_image',
                        'heading'     => __( 'Image', 'js_composer' ),
                        'param_name'  => 'image'
                    ),
                    array(
                        'type' 		 => 'vc_link',
                        'heading' 	 => __( 'Logo link', 'js_composer' ),
                        'param_name' => 'logo_link',
                    ),
                ),
                'callbacks' => array(
                    'after_add' => 'vcChartParamAfterAddCallback'
                )
            ),
            array(
                'type'        => 'checkbox',
                'heading'     => __( 'Autoplay True/False', 'js_composer' ),
                'param_name'  => 'autoplay',
                'value'       => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
            ),
            array(
                'type' 		  => 'textfield',
                'heading'     => __( 'Autoplay Speed', 'js_composer' ),
                'param_name'  => 'speed',
                'value' 	  => ''
            ),
            array(
                'heading' 	  => __( 'Slides to show', 'js_composer' ),
                'type' 		  => 'dropdown',
                'param_name'  => 'slides',
                'value' 	  => array(
                    __( '1', 'js_composer' )    => 1,
                    __( '2', 'js_composer' )    => 2,
                    __( '3', 'js_composer' )    => 3,
                    __( '4', 'js_composer' )    => 4,
                    __( '5', 'js_composer' )    => 5,
                    __( '6', 'js_composer' )    => 6,
                    __( '7', 'js_composer' )    => 7,
                    __( '8', 'js_composer' )    => 8,
                    __( '9', 'js_composer' )    => 9,
                    __( '10', 'js_composer' )   => 10,
                ),
            ),
            array(
                'type' 		  => 'textfield',
                'heading' 	  => __( 'Extra class name', 'js_composer' ),
                'param_name'  => 'el_class',
                'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
                'value' 	  => ''
            ),
            array(
                'type' 		  => 'css_editor',
                'heading' 	  => __( 'CSS box', 'js_composer' ),
                'param_name'  => 'css',
                'group' 	  => __( 'Design options', 'js_composer' )
            )
        ) //end params
    )
);

class WPBakeryShortCode_corpboot_clients extends WPBakeryShortCode{
    protected function content( $atts, $content = null ) {

        extract( shortcode_atts( array(
            'items'     => '',
            'autoplay'  => '',
            'speed'     => '2000',
            'slides'    => '6',
            'el_class'  => '',
            'css' 	    => ''
        ), $atts ) );

        $output = '';
        $items 	= json_decode( urldecode( $items ), true );
        $class  = ( ! empty( $el_class ) ) ? $el_class : '';
        $class 	.= vc_shortcode_custom_css_class( $css, ' ' );

        if( ! empty( $items ) ) {

            $autoplay = ( isset( $autoplay ) && $autoplay == 'yes' ) ? 'true' : '';
            $speed    = ( ! empty( $speed ) ) ? $speed : 2000;
            $slides   = ( isset( $slides ) ) ? $slides : 6;

            $output .= '<div class="slick-carousel ' . $class . '" id="clients" data-slides="' . $slides . '" data-speed="' . $speed . '" data-autoplay="' . $autoplay . '">';

            foreach ( $items as $item ) {

                $image 	= ( ! empty( $item['image'] ) && is_numeric( $item['image'] ) ) ? wp_get_attachment_url( $item['image'] ) : '';

                if( ! empty( $image ) ) {

                    // Link image client
                    $link_image = ( ! empty( $item['logo_link'] ) ) ? $item['logo_link'] : '';
                    $link = vc_build_link( $link_image );

                    // Image client
                    $logo = '<img src="' . esc_url( $image ) . '" alt=""/>';

                    $output .= '<div>';
                    if( ! empty( $link['url'] ) ) {
                        $link_target = ( ! empty( $link['target'] ) ) ? 'target="' . $link['target'] . '"' : '';
                        $output .= '<a href=' . esc_url( $link['url'] ) . ' ' . $link_target . '>';
                        $output .= $logo;
                        $output .= '</a>';
                    } else {
                        $output .= $logo;
                    }
                    $output .= '</div>';
                }
            }
            $output .= '</div>';

            return $output;
        }
    }
}