<?php
/*
 * Accordian Shortcode
 * Author: QodeArena
 * Author URI: https://themeforest.net/user/qodearena
 * Version: 1.0.0
 */

vc_map(
    array(
        'name'                    => __( 'Accordian', 'js_composer' ),
        'base'                    => 'corpboot_accordian',
        'content_element'         => true,
        'show_settings_on_create' => true,
        'description'             => __( 'Accordian list', 'js_composer'),
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
                        'value' 	  => ''
                    ),
                    array(
                        'type'        => 'checkbox',
                        'heading'     => __( 'Active item?', 'js_composer' ),
                        'param_name'  => 'active',
                        'value'       => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
                    ),
                    array(
                        'type' 		  => 'textarea',
                        'heading' 	  => __( 'Text', 'js_composer' ),
                        'param_name'  => 'text'
                    )
                ),
                'callbacks' => array(
                    'after_add' => 'vcChartParamAfterAddCallback'
                )
            ),
            array(
                'type'        => 'checkbox',
                'heading'     => __( 'Light style', 'js_composer' ),
                'param_name'  => 'light_style',
                'value'       => array( __( 'Yes, please', 'js_composer' ) => 'no' )
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

class WPBakeryShortCode_corpboot_accordian extends WPBakeryShortCode{
    protected function content( $atts, $content = null ) {

        extract( shortcode_atts( array(
            'items' 		   => '',
            'light_style' 	   => '',
            'el_class' 		   => '',
            'css' 		  	   => ''
        ), $atts ) );

        global $tab;
        $tab = ( ! empty( $tab ) ) ? $tab + 1 : 1;

        $output 	= '';
        $items 	  	= json_decode( urldecode( $items ), true );
        $class  	= ( ! empty( $el_class ) ) ? $el_class : '';
        $class 	   .= vc_shortcode_custom_css_class( $css, ' ' );

        if( ! empty( $items ) ) {
            $counter = 0;

            // Light Style
            $light_style  = ( isset( $light_style ) && $light_style == 'yes' ) ? 'light' : '';

            $output .= '<div class="accordion-wrap ' . $light_style . '">';
            $output .= '<div class="panel-group ' . $class . '" id="accordion-1' . $counter . $tab . '" role="tablist" aria-multiselectable="true">';

            foreach ( $items as $item ) {

                // Active elements
                $active      = ( isset( $item['active'] ) && $item['active'] == 'yes' ) ? 'in' : '';
                $expanted    = ( isset( $item['active'] ) && $item['active'] == 'yes' ) ? 'true' : 'false';
                $active_link = ( isset( $item['active'] ) && $item['active'] == 'yes' ) ? '' : 'collapsed';

                $output .= '<div class="panel panel-default">';
                $output .= '<div class="panel-heading" role="tab" id="headingOne-1' . 0 . $tab . '">';
                $output .= '<h4 class="panel-title">';
                $output .= '<a role="button" data-toggle="collapse" data-parent="#accordion-1' . 0 . $tab . '" href="#collapseOne-1' . $counter . $tab . '" aria-expanded="' . $expanted . '" aria-controls="collapseOne-1' . $counter . $tab . '" class="ion-android-arrow-dropdown ' . $active_link .'">';
                $output .= $item['title'];
                $output .= '</a>';
                $output .= '</h4>';
                $output .= '</div>';

                $output .= '<div id="collapseOne-1' . $counter . $tab . '" class="panel-collapse collapse ' . $active . '" role="tabpanel" aria-labelledby="headingOne-1' . $counter . $tab . '">';
                $output .= '<div class="panel-body"><p>' . wp_kses_post( $item['text'] ) . '</p></div>';
                $output .= '</div>';
                $output .= '</div>';

                $counter++;
            }

            $output .= '</div>';
            $output .= '</div>';

            return $output;
        }
    }
}