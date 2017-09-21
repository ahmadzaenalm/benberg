<?php
/*
 * Button block Shortcode
 * Author: QodeArena
 * Author URI: https://themeforest.net/user/qodearena
 * Version: 1.0.0
 */

vc_map(
    array(
        'name'        => __( 'Buttons', 'js_composer' ),
        'base'        => 'corpboot_buttons',
        'description' => __( 'Buttons', 'js_composer'),
        'params'      => array(
            array(
                'heading' 	  => __( 'Link', 'js_composer' ),
                'type' 		  => 'vc_link',
                'param_name'  => 'link',
                'value' 	  => '',
            ),
            array(
                'heading' 	  => __( 'Style button', 'js_composer' ),
                'type' 		  => 'dropdown',
                'param_name'  => 'style_btn',
                'value' 	  => array(
                    __('Small Button', 'js_composer')      => 'btn-reply',
                    __('Medium Button', 'js_composer')     => 'btn-primary-corp',
                    __('Big Button', 'js_composer')        => 'btn-primary-corp-big',
                    __('Big Transparent', 'js_composer')   => 'btn-transparent',
                    __('Small Transparent', 'js_composer') => 'btn-transparent-sm',
                )
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

class WPBakeryShortCode_corpboot_buttons extends WPBakeryShortCode{
    protected function content( $atts, $content = null ) {

        extract( shortcode_atts( array(
            'link'				=> '',
            'style_btn'			=> 'btn-reply',
            'el_class' 			=> '',
            'css' 			    => ''
        ), $atts ) );

        $class  = ( ! empty( $el_class ) ) ? $el_class : '';
        $class .= vc_shortcode_custom_css_class( $css, ' ' );

        $output = '';

        $style_btn = ( isset( $style_btn ) && $style_btn == 'btn-reply' ) ? 'btn-reply' : $style_btn;

        $button_link = vc_build_link( $link );
        $button_link_target = ( ! empty( $button_link['target'] ) ) ? 'target="' . $button_link['target'] . '"' : '';

        $output .= ( ! empty( $button_link['url'] ) && ! empty( $button_link['title'] ) ) ? '<a href="' . $button_link['url'] . '" class="button-srtc btn ' . $style_btn . ' '. $class . ' mb10 mr10" ' . $button_link_target . '>' . $button_link['title'] . ' </a>' : '';

        return $output;
    }
}