<?php
/*
 * Contact Shortcode
 * Author: QodeArena
 * Author URI: https://themeforest.net/user/qodearena
 * Version: 1.0.0
 */

vc_map(
    array(
        'name'                    => __( 'Contact Info', 'js_composer' ),
        'base'                    => 'corpboot_contact_info',
        'content_element'         => true,
        'show_settings_on_create' => true,
        'params' => array(
            array(
                'type'       => 'param_group',
                'heading'    => __( 'Items', 'js_composer' ),
                'param_name' => 'items',
                'params'     => array(
                    array(
                        'type' 		  => 'textfield',
                        'heading' 	  => __( 'Title', 'js_composer' ),
                        'param_name'  => 'title',
                    ),
                    array(
                        'type' 		  => 'textfield',
                        'heading' 	  => __( 'URL', 'js_composer' ),
                        'param_name'  => 'url',
                    ),
                    array(
                        'heading'     => __( 'Icon', 'js_composer' ),
                        'type'        => 'iconpicker',
                        'param_name'  => 'icon',
                        'description' => __( 'Select icon from library.', 'js_composer' ),
                    ),
                ),
                'callbacks' => array(
                    'after_add' => 'vcChartParamAfterAddCallback'
                )
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

class WPBakeryShortCode_corpboot_contact_info extends WPBakeryShortCode{
    protected function content( $atts, $content = null ) {

        extract( shortcode_atts( array(
            'items' 	    => '',
            'el_class' 	    => '',
            'css' 		    => ''
        ), $atts ) );

        $output 	= '';
        $items 	    = json_decode( urldecode( $items ), true );
        $class  	= ( ! empty( $el_class ) ) ? $el_class : '';
        $class 	   .= vc_shortcode_custom_css_class( $css, ' ' );

        if( ! empty( $items ) ) {

            $output .= '<div class="cinfo">';
                $output .= '<address class=" ' . $class . '">';

                    foreach ( $items as $item ) {

                        $item_url = ( ! empty( $item['url'] ) ) ? $item['url'] : '';

                        // Title
                        $title = ( ! empty( $item['title'] ) ) ? $item['title'] : '';

                        // Icon info contact
                        $icon = ( ! empty( $item['icon'] ) ) ? $item['icon'] : '';

                        if( ! empty( $item['url'] ) ) {
                            $output .= '<p><i class="' . $icon . '"></i><a href="' . esc_url( $item_url ) . '">' . $title . '</a></p>';
                        } else {
                            $output .= '<p><i class="' . $icon . '"></i>' . $title . '</p>';
                        }
                    }

                $output .= '</address>';
            $output .= '</div>';

            return $output;
        }
    }
}