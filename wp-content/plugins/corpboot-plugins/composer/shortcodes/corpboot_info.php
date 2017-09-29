<?php
/*
 * Info block Shortcode
 * Author: QodeArena
 * Author URI: https://themeforest.net/user/qodearena
 * Version: 1.0.0
 */

vc_map(
    array(
        'name'        => __( 'Info block', 'js_composer' ),
        'base'        => 'corpboot_info_block',
        'params'      => array(
            array(
                'type'        => 'attach_image',
                'heading'     => __( 'Image', 'js_composer' ),
                'param_name'  => 'image',
            ),
            array(
                'type' 		  => 'vc_link',
                'heading' 	  => __( 'Button', 'js_composer' ),
                'param_name'  => 'button',
            ),
            array(
                'type' 		  => 'textfield',
                'heading' 	  => __( 'Extra class name', 'js_composer' ),
                'param_name'  => 'el_class',
                'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
                'value' 	  => ''
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

class WPBakeryShortCode_corpboot_info_block extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {

        extract( shortcode_atts( array(
            'image' 			=> '',
            'button' 		    => '',
            'el_class' 			=> '',
            'css' 			    => ''
        ), $atts ) );

        $class  = ( ! empty( $el_class ) ) ? $el_class : '';
        $class .= vc_shortcode_custom_css_class( $css, ' ' );

        $output = '';

        // Image
        $image 	= ( ! empty( $image ) && is_numeric( $image ) ) ? '<img src="' . wp_get_attachment_url( $image ) . '" class="img-responsive" alt="template">' : '';

        // Link
        $link = ( ! empty( $button ) ) ? vc_build_link( $button ) : '';
        $link_target = ( ! empty( $link['target'] ) ) ? 'target="' . $link['target'] . '"' : '';

        $output .= '<div class="blognews ' . esc_attr( $class ) . '">';
            $output .= '<a href="' . esc_url( $link['url'] ) . '" ' . $link_target . ' class="mb20">';
                $output .= '<div class="item-img-wrap">';
                    $output .= $image;
                    $output .= '<div class="item-img-overlay">';
                        $output .= '<div class="about">';
                            $output .= '<span class="btn btn-transparent-sm"><i class="fa fa-plus"></i> ' . esc_html( $link['title'] ) . '</span>';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
            $output .= '</a>';
        $output .= '</div>';

        return $output;
    }
}