<?php
/*
 * Content Slider Shortcode
 * Author: QodeArena
 * Author URI: http://qodearena.com/
 * Version: 1.0.0
 */

vc_map(
    array(
        'name'                    => __( 'Content slider', 'js_composer' ),
        'base'                    => 'corpboot_content_slider',
        'as_parent' 		      => array('only' => 'corpboot_content_slider_item'),
        'content_element'         => true,
        'show_settings_on_create' => false,
        'js_view'                 => 'VcColumnView',
        'params'          		  => array(
            array(
                'heading' 	  => __( 'Style Slider', 'js_composer' ),
                'type' 		  => 'dropdown',
                'param_name'  => 'style_slider',
                'value' 	  => array(
                    __( 'Default', 'js_composer' ) => 'default',
                    __( 'Modern', 'js_composer' )  => 'modern',
                )
            ),
            array(
                'type'        => 'textarea',
                'heading'     => __( 'Title', 'js_composer' ),
                'param_name'  => 'title',
                'dependency'  => array( 'element' => 'style_slider', 'value'   => 'default' ),
            ),
            array(
                'type'     	  => 'textarea',
                'heading'     => __( 'Subtitle', 'js_composer' ),
                'param_name'  => 'subtitle',
                'value'    	  => '',
                'dependency'  => array( 'element' => 'style_slider', 'value'   => 'default' ),
            ),
            array(
                'type'     	  => 'textarea',
                'heading'     => __( 'Description', 'js_composer' ),
                'param_name'  => 'text',
                'dependency'  => array( 'element' => 'style_slider', 'value'   => 'default' ),
            ),
            array(
                'type' 		  => 'vc_link',
                'heading' 	  => __( 'Button', 'js_composer' ),
                'param_name'  => 'button',
                'dependency'  => array( 'element' => 'style_slider', 'value'   => 'default' ),
            ),
            array(
                'heading' 	  => __( 'Icon style', 'js_composer' ),
                'type' 		  => 'dropdown',
                'param_name'  => 'icon_type',
                'value' 	  => array(
                    __( 'Font awesome', 'js_composer' ) => 'faw',
                    __( 'Flaticon', 'js_composer' )     => 'flaticon',
                ),
                'dependency'  => array( 'element' => 'style_slider', 'value'   => 'default' ),
            ),
            array(
                'type' 		  => 'iconpicker',
                'heading' 	  => __( 'Icon', 'js_composer' ),
                'param_name'  => 'icon_flaticon',
                'value' 	  => 'icon-adjustments',
                'settings' 	  => array(
                    'emptyIcon'    => false,
                    'type' 		   => 'flaticon',
//                    'source' 	   => corpboot_flaticon_icons(),
                    'iconsPerPage' => 4000,
                ),
                'dependency'  => array( 'element' => 'icon_type', 'value'   => 'flaticon' ),
                'description' => __( 'Select icon from library.', 'js_composer' ),
            ),
            array(
                'heading'     => __( 'Icon', 'js_composer' ),
                'type'        => 'iconpicker',
                'param_name'  => 'icon',
                'description' => __( 'Select icon from library.', 'js_composer' ),
                'dependency'  => array( 'element' => 'icon_type', 'value' => 'faw' )
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

class WPBakeryShortCode_corpboot_content_slider extends WPBakeryShortCodesContainer {
    protected function content( $atts, $content = null ) {

        extract( shortcode_atts( array(
            'style_slider'       => 'default',
            'title'              => '',
            'subtitle'           => '',
            'text'               => '',
            'button'             => '',
            'icon_type' 		 => 'faw',
            'icon' 				 => '',
            'icon_flaticon'      => 'icon-adjustments',
            'css'	             => '',
            'el_class'           => ''
        ), $atts ) );

        $class  = ( ! empty( $el_class ) ) ? $el_class : '';
        $class .= vc_shortcode_custom_css_class( $css, ' ' );
        $output = '';

        global $corpboot_content_slider_items;
        $corpboot_content_slider_items = '';

        do_shortcode( $content );

        $counter = 1;

        if( ! empty( $corpboot_content_slider_items ) && count( $corpboot_content_slider_items ) > 0 ) {

            if( $style_slider == 'default' ) {

                $output .= '<header class="container-fluid intro-slider">';

                    // Title Slider
                    $title = ( ! empty( $title ) ) ? '<span class="middle">' . $title . '</span>' : '';
                    // Subtitle Slider
                    $subtitle = ( ! empty( $subtitle ) ) ? '<span class="upper">' . esc_html( $subtitle ) . '</span>' : '';

                    // Content Slider
                    $text = ( ! empty( $text ) ) ? '<span class="bottom">' . esc_html( $text ) . '</span>' : '';

                    // Link Slider
                    $link = ( ! empty( $button ) ) ? vc_build_link( $button ) : '';
                    $link_target = ( ! empty( $link['target'] ) ) ? 'target="' . $link['target'] . '"' : '';

                    // Icon Button
                    $type_icon_tab = ( ! isset( $icon_type ) ) ? 'faw' : $icon_type;
                    $icon_fa   = ( ! empty( $icon ) ) ? $icon : '';

                    if( $type_icon_tab == 'faw' ) {
                        $icon  = $icon_fa;
                    } else {
                        $icon  = '';
                    }

                    $button = ( ! empty( $link ) ) ? '<a href="' . esc_url( $link['url'] ) . '" ' . $link_target . ' class="btn btn-transparent"><i class="' . esc_attr( $icon ) . '"></i> ' . esc_html( $link['title'] ) . '</a>' : '';

                    // Slider item
                    $output .= '<div class="bg-slider-wrapper">';
                        $output .= '<div id="bg-slider" class="flexslider bg-slider">';
                            $output .= '<ul class="slides">';

                                foreach ( $corpboot_content_slider_items as $key => $item ) {
                                    $value = (object)$item['atts'];

                                    // Image Slider
                                    $image = ( ! empty( $value->image ) && is_numeric( $value->image ) ) ? wp_get_attachment_url( $value->image ) : '';
                                    $output .= '<li class="slide slide-' . $counter . '" style="background-image: url(' . $image . ');
									background-repeat: no-repeat;"></li>';
                                    $counter++;
                                }

                            $output .= '</ul>';
                        $output .= '</div>';
                    $output .= '</div>';

                    $output .= '<section class="home-promo">';
                        $output .= '<div class="text-center wow">';
                            $output .= '<h2 class="titlepro">';
                                $output .= $subtitle;
                                $output .= $title;
                                $output .= $text;
                            $output .= '</h2>';
                            $output .= $button;
                        $output .= '</div>';
                    $output .= '</section>';

                $output .= '</header>';


            } else {

                $output .= '<header class="container-fluid intro-slider">';
                    $output .= '<div class="bg-slider-wrapper">';
                        $output .= '<div id="main-slider" class="flexslider bg-slider">';
                            $output .= '<ul class="slides">';
                                $counter = 1;
                                foreach ( $corpboot_content_slider_items as $key => $item ) {
                                    $value = (object)$item['atts'];

                                    // Image Slider
                                    $image = ( ! empty( $value->image ) && is_numeric( $value->image ) ) ? wp_get_attachment_url( $value->image ) : '';

                                    // Title Slider
                                    $title = ( ! empty( $value->title ) ) ? '<span class="middle">' . $value->title . '</span>' : '';

                                    // Subtitle Slider
                                    $subtitle = ( ! empty( $value->subtitle ) ) ? '<span class="upper">' . esc_html( $value->subtitle ) . '</span>' : '';

                                    // Content Slider
                                    $content = ( ! empty( $item['content'] ) ) ? '<span class="bottom">' . esc_html( $item['content'] ) . '</span>' : '';

                                    // Link Slider
                                    $link = ( ! empty( $value->button ) ) ? vc_build_link( $value->button ) : '';
                                    $link_target = ( ! empty( $link['target'] ) ) ? 'target="' . $link['target'] . '"' : '';

                                    // Icon Button
                                    $type_icon_tab = ( ! isset( $value->icon_type ) ) ? 'faw' : $value->icon_type;
                                    $icon_fa   = ( ! empty( $value->icon ) ) ? $value->icon : '';

                                    if( $type_icon_tab == 'faw' ) {
                                        $icon  = $icon_fa;
                                    } else {
                                        $icon  = '';
                                    }

                                    $button = ( ! empty( $link ) ) ? '<a href="' . esc_url( $link['url'] ) . '" ' . $link_target . ' class="btn btn-transparent"><i class="' . esc_attr( $icon ) . '"></i> ' . esc_html( $link['title'] ) . '</a>' : '';

                                    $output .= '<li class="slide slide-' . $counter . '" style="background-image: url(' . $image . '); background-repeat: no-repeat;">';
                                        $output .= '<div class="push-text-slide"></div>';
                                        $output .= '<section class="home-promo">';
                                            $output .= '<div class="text-center">';
                                                $output .= '<h2 class="titlepro">';
                                                    $output .= $subtitle;
                                                    $output .= $title;
                                                    $output .= $content;
                                                $output .= '</h2>';
                                                $output .= $button;
                                            $output .= '</div>';
                                        $output .= '</section>';
                                    $output .= '</li>';
                                    $counter++;
                                }
                            $output .= '</ul>';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</header>';

            }
        }
        return $output;
    }
}

vc_map(
    array(
        'name'            => 'Item',
        'base'            => 'corpboot_content_slider_item',
        'as_child' 		  => array('only' => 'corpboot_content_slider'),
        'content_element' => true,
        'params'          => array(
            array(
                'heading' 	  => __( 'Style Slider', 'js_composer' ),
                'type' 		  => 'dropdown',
                'param_name'  => 'style_sliders',
                'value' 	  => array(
                    __( 'Default', 'js_composer' ) => 'default',
                    __( 'Modern', 'js_composer' )  => 'modern',
                )
            ),
            array(
                'type'        => 'textarea',
                'heading'     => __( 'Title', 'js_composer' ),
                'param_name'  => 'title',
                'dependency'  => array( 'element' => 'style_sliders', 'value'   => 'modern' ),
            ),
            array(
                'type'     	  => 'textarea',
                'heading'     => __( 'Subtitle', 'js_composer' ),
                'param_name'  => 'subtitle',
                'value'    	  => '',
                'dependency'  => array( 'element' => 'style_sliders', 'value'   => 'modern' ),
            ),
            array(
                'type'     	  => 'textarea',
                'heading'     => __( 'Description', 'js_composer' ),
                'param_name'  => 'content',
                'holder'      => 'div',
                'value'    	  => '',
                'dependency'  => array( 'element' => 'style_sliders', 'value'   => 'modern' ),
            ),
            array(
                'type'        => 'attach_image',
                'heading'     => __( 'Image Slide', 'js_composer' ),
                'param_name'  => 'image',
            ),
            array(
                'type' 		  => 'vc_link',
                'heading' 	  => __( 'Button', 'js_composer' ),
                'param_name'  => 'button',
                'dependency'  => array( 'element' => 'style_sliders', 'value'   => 'modern' ),
            ),
            array(
                'heading' 	  => __( 'Icon style', 'js_composer' ),
                'type' 		  => 'dropdown',
                'param_name'  => 'icon_type',
                'value' 	  => array(
                    __( 'Font awesome', 'js_composer' ) => 'faw',
                    __( 'Flaticon', 'js_composer' )     => 'flaticon',
                ),
                'dependency'  => array( 'element' => 'style_sliders', 'value'   => 'modern' ),
            ),
            array(
                'type' 		  => 'iconpicker',
                'heading' 	  => __( 'Icon', 'js_composer' ),
                'param_name'  => 'icon_flaticon',
                'value' 	  => 'icon-adjustments',
                'settings' 	  => array(
                    'emptyIcon'    => false,
                    'type' 		   => 'flaticon',
//                    'source' 	   => corpboot_flaticon_icons(),
                    'iconsPerPage' => 4000,
                ),
                'dependency'  => array( 'element' => 'icon_type', 'value'   => 'flaticon' ),
                'description' => __( 'Select icon from library.', 'js_composer' ),
            ),
            array(
                'heading'     => __( 'Icon', 'js_composer' ),
                'type'        => 'iconpicker',
                'param_name'  => 'icon',
                'description' => __( 'Select icon from library.', 'js_composer' ),
                'dependency'  => array( 'element' => 'icon_type', 'value' => 'faw' )
            ),
        ),
    )
);


class WPBakeryShortCode_corpboot_content_slider_item extends WPBakeryShortCode{
    protected function content( $atts, $content = null ) {
        global $corpboot_content_slider_items;
        $corpboot_content_slider_items[] = array( 'atts' => $atts, 'content' => $content);
        return;
    }
}