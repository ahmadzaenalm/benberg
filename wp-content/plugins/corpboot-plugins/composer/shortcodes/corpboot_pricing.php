<?php
/*
 * Price Shortcode
 * Author: QodeArena
 * Author URI: http://qodearena.com/
 * Version: 1.0.0
 */

vc_map(
    array(
        'name'        => __( 'Pricing', 'js_composer' ),
        'base'        => 'corpboot_price',
        'params'      => array(
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Title', 'js_composer' ),
                'admin_label' => true,
                'param_name'  => 'title'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Currency', 'js_composer' ),
                'param_name'  => 'currency',
                'value'       => '',
                'description' => __( 'Use currency icons, like $, €...', 'js_composer' )
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Price', 'js_composer' ),
                'param_name'  => 'price',
                'value'		  => ''
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Interval', 'js_composer' ),
                'param_name'  => 'interval',
                'value'		  => '',
                'description' => __( 'Time interval, like day, week, month...', 'js_composer' )
            ),
            array(
                'type'       => 'param_group',
                'heading'    => __( 'Content List', 'js_composer' ),
                'param_name' => 'content_list',
                'params'     => array(
                    array(
                        'type'        => 'textfield',
                        'heading'     => __( 'Title list', 'js_composer' ),
                        'param_name'  => 'title_list'
                    ),
                ),
                'callbacks' => array(
                    'after_add' => 'vcChartParamAfterAddCallback'
                )
            ),
            array(
                'type'        => 'vc_link',
                'heading'     => __( 'Link', 'js_composer' ),
                'param_name'  => 'link',
                'value'       => '',
                'description' => __( 'link price', 'js_composer' )
            ),
            array(
                'type'        => 'checkbox',
                'heading'     => __( 'Active item?', 'js_composer' ),
                'param_name'  => 'active',
                'value'       => ''
            ),
            array(
                'heading'     => __( 'Icon active item', 'js_composer' ),
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
            array(
                'type' 		  => 'css_editor',
                'heading' 	  => __( 'CSS box', 'js_composer' ),
                'param_name'  => 'css',
                'group' 	  => __( 'Design options', 'js_composer' )
            )
        )
    )
);

class WPBakeryShortCode_corpboot_price extends WPBakeryShortCode{
    protected function content( $atts, $content = null ) {

        extract( shortcode_atts( array(
            'title'    	  		=> '',
            'title_price'    	=> '',
            'currency'    		=> '',
            'price' 	  		=> '',
            'interval' 	  		=> '',
            'content_list' 	  	=> '',
            'link' 	  		    => '',
            'active' 	  		=> '',
            'icon' 				=> '',
            'el_class' 	  		=> '',
            'css' 		  		=> ''
        ), $atts ) );

        $content_list = json_decode( urldecode( $content_list ) );

        $class  = ( ! empty( $el_class ) ) ? ' ' . $el_class : '';
        $class .= vc_shortcode_custom_css_class( $css, ' ' );
        $output	= '';

        // Icon
        $icon = ( ! empty( $icon ) ) ? $icon : 'fa fa-star-o';

        // Active
        $popular_title  = ( isset( $active ) && $active ) ? ' popular-title ' : '';
        $popular_icon   = ( isset( $active ) && $active ) ? '<span class="popular-tag"><i class="' . $icon . '"></i></span>' : '';

        // Title
        $title = ( ! empty( $title ) ) ? $title : '';

        // Currency, Interval
        $interval = ( ! empty( $interval ) ) ? esc_html( $interval ) : '';
        $currency = ( ! empty( $currency ) ) ? $currency : '';

        // Link
        $link = vc_build_link($link);

        $output .= '<div class="corp-pricing">';
            $output .= '<div class="corpboot-price-title ' . esc_attr( $popular_title ) . '">';

                // Price item
                if( ! empty( $price ) ) {
                    $output .= '<h2><sup>' . esc_html( $currency ) . '</sup>' . esc_html( $price ) . '<sub>' . esc_html('/') . ''. esc_html( $interval ) . '</sub></h2>';
                }

                // Title item
                if( $title ) {
                    $output .= '<h3>' . esc_html( $title ) . '</h3>';
                }

                // Popular icon
                $output .= $popular_icon;

            $output .= '</div>';

            // Content list item
            if( ! empty( $content_list ) ) {
                $output .= '<div class="corpboot-price-content">';
                    $output .= '<ul>';
                        foreach ( $content_list as $item ) {
                            $output .= '<li>' . esc_html( $item->title_list ) . '</li>';
                        }
                    $output .= '</ul>';
                $output .= '</div>';
            }

            // Button item
            if( ! empty( $link["url"] ) && ! empty( $link["title"] ) ) {
                $output .= '<div class="corp-pricing-btn">';
                    $output .= '<a href="' . esc_url( $link["url"] ) . '" class="btn btn-primary-corp">' . esc_html( $link["title"] ) . '</a>';
                $output .= '</div>';
            }

        $output .= '</div>';
        $output .= '<div class="visible-xs-block visible-sm-block pt20"></div>';

        return  $output;
    }
}

