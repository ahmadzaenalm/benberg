<?php
/*
 * Tabs Shortcode
 * Author: QodeArena
 * Author URI: https://themeforest.net/user/qodearena/portfolio
 * Version: 1.0.0
 */

vc_map(
    array(
        'name'                    => __( 'Tabs', 'js_composer' ),
        'base'                    => 'corpboot_tabs',
        'as_parent' 		      => array('only' => 'corpboot_tabs_item'),
        'content_element'         => true,
        'show_settings_on_create' => true,
        'js_view'                 => 'VcColumnView',
        'params'          		  => array(
            array(
                'heading' 	  => __( 'Style Tabs', 'js_composer' ),
                'type' 		  => 'dropdown',
                'param_name'  => 'style_tabs',
                'value' 	  => array(
                    __( 'Default', 'js_composer' ) => 'default',
                    __( 'Modern', 'js_composer' )  => 'modern',
                    __( 'Static', 'js_composer' )  => 'static',
                )
            ),
            array(
                'type' 		  => 'textfield',
                'heading' 	  => __( 'Extra class name', 'js_composer' ),
                'param_name'  => 'el_class',
                'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
                'value' 	  => ''
            ),
        ) //end params
    )
);

class WPBakeryShortCode_corpboot_tabs extends WPBakeryShortCodesContainer {
    protected function content( $atts, $content = null ) {

        extract( shortcode_atts( array(
            'style_tabs' 		=> 'default',
            'el_class' 			=> '',
        ), $atts ) );

        global $tab;
        $tab = ( ! empty( $tab ) ) ? $tab + 1 : 1;

        global $corpboot_tab_items;
        $corpboot_tab_items = '';

        do_shortcode( $content );

        if( ! empty( $corpboot_tab_items ) && count( $corpboot_tab_items ) > 0 ) {

            $title_style = '';
            $text_style  = '';

            $image_tabs         = '';
            $title_tabs         = '';
            $content_tabs       = '';

            $title_style .= ( ! empty( $title_color ) ) ? 'color: ' . $title_color . ';' : '';
            if( ! empty( $title_font_size ) ) {
                $title_style .= ( is_numeric( $title_font_size ) ) ? 'font-size: ' . $title_font_size . 'px;' : 'font-size: ' . $title_font_size . ';';
            }
            $title_style = ( ! empty( $title_style ) ) ? 'style="' . $title_style . '"' : '';

            $text_style .= ( ! empty( $content_color ) ) ? 'color: ' . $content_color . ';' : '';
            if( ! empty( $content_font_size ) ) {
                $text_style .= ( is_numeric( $content_font_size ) ) ? 'font-size: ' . $content_font_size . 'px;' : 'font-size: ' . $content_font_size . ';';
            }
            $text_style = ( ! empty( $text_style ) ) ? 'style="' . $text_style . '"' : '';

            $output = '';


            if( $style_tabs == 'default' ) {
                $counter = 0;
                foreach ( $corpboot_tab_items as $item ) {
                    $value = (object) $item['atts'];

                    $active         = ( $counter == 0 ) ? ' active ' : '';
                    $active_content = ( $counter == 0 ) ? 'in active ' : '';

                    // Title tabs
                    $title_tabs .= '<li class="' . $active . '"><a data-toggle="tab" href="#menu' . esc_attr( $counter . $tab ) . '" ' . $title_style . '>' . esc_html( $value->title ) . '</a></li>';

                    // Content tabs
                    $content_tabs .= '<div id="menu' . esc_attr( $counter . $tab ) . '" class="tab-pane fade ' . esc_attr( $active_content ) . '">';
                        $content_tabs .= '<h3 class="color6" ' . $title_style . '>' . esc_html( $value->title ) . '</h3>';
                        $content_tabs .= '<p ' . $text_style . '>' . wp_kses_post( $item['content'] ) . '</p>';
                    $content_tabs .= '</div>';

                    $counter++;
                }

                // Tab Menu
                $output .= '<ul class="nav nav-tabs">';
                    $output .= $title_tabs;
                $output .= '</ul>';

                // Tab Content
                $output .= '<div class="tab-content">';
                    $output .= $content_tabs;
                $output .= '</div>';

            } elseif( $style_tabs == 'modern' ) {
                $counter = 0;
                foreach ( $corpboot_tab_items as $item ) {
                    $value = (object) $item['atts'];

                    $active         = ( $counter == 0 ) ? ' active ' : '';
                    $active_content = ( $counter == 0 ) ? 'in active ' : '';

                    $image = ( ! empty( $value->image ) && is_numeric( $value->image ) ) ? wp_get_attachment_url( $value->image ) : '';

                    // Image tabs
                    $image_tabs .= '<div>';
                        $image_tabs .= '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $value->title ) . '" class="img-responsive mb15">';
                    $image_tabs .= '</div>';

                    // Title tabs
                    $title_tabs .= '<li class="' . $active . '"><a data-toggle="tab" href="#menu' . esc_attr( $counter . $tab ) . '" ' . $title_style . '>' . esc_html( $value->title ) . '</a></li>';

                    // Content tabs
                    $content_tabs .= '<div id="menu' . esc_attr( $counter . $tab ) . '" class="tab-pane fade ' . esc_attr( $active_content ) . '">';
                        $content_tabs .= '<h3 class="color6" ' . $title_style . '>' . esc_html( $value->title ) . '</h3>';
                        $content_tabs .= '<p ' . $text_style . '>' . wp_kses_post( $item['content'] ) . '</p>';
                    $content_tabs .= '</div>';

                    $counter++;
                }

                // Tab image
                $output .= '<div class="slick-carousel" id="aboutCarousel">';
                    $output .= $image_tabs;
                $output .= '</div>';

                // Tab title
                $output .= '<ul class="nav nav-tabs nav-justified nav-about-carousel" id="navAboutCarousel">';
                    $output .= $title_tabs;
                $output .= '</ul>';

                // Tab content
                $output .= '<div class="tab-content tab-content-about">';
                    $output .= $content_tabs;
                $output .= '</div>';

            } else {
                $counter = 0;
                foreach ( $corpboot_tab_items as $item ) {
                    $value = (object) $item['atts'];

                    $active         = ( $counter == 0 ) ? ' active ' : '';
                    $active_content = ( $counter == 0 ) ? 'in active ' : '';

                    $image = ( ! empty( $value->image ) && is_numeric( $value->image ) ) ? wp_get_attachment_url( $value->image ) : '';

                    // Image tabs
                    $image_tabs .= '<div>';
                        $image_tabs .= '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $value->title ) . '" class="img-responsive mb15">';
                    $image_tabs .= '</div>';

                    // Title tabs
                    $title_tabs .= '<li class="' . $active . '"><a data-toggle="tab" href="#menu' . esc_attr( $counter . $tab ) . '" ' . $title_style . '>' . esc_html( $value->title ) . '</a></li>';

                    // Content tabs
                    $content_tabs .= '<div id="menu' . esc_attr( $counter . $tab ) . '" class="tab-pane fade ' . esc_attr( $active_content ) . '">';
                        $content_tabs .= '<h3 class="color5" ' . $title_style . '>' . esc_html( $value->title ) . '</h3>';
                        $content_tabs .= '<p class="text-italic" ' . $text_style . '>' . wp_kses_post( $item['content'] ) . '</p>';
                    $content_tabs .= '</div>';

                    $counter++;
                }

                $output .= '<div class="row">';
                    $output .= '<div class="col-md-6">';

                        // Title tabs
                        $output .= '<ul class="nav nav-justified nav-wizard" id="navHistoryCarousel">';
                            $output .= $title_tabs;
                        $output .= '</ul>';

                        // Content tabs
                        $output .= '<div class="tab-content">';
                            $output .= $content_tabs;
                        $output .= '</div>';

                    $output.= '</div>';

                    // Image tabs
                    $output .= '<div class="col-md-6">';
                        $output .= '<div class="slick-carousel" id="historyCarousel">';
                            $output .= $image_tabs;
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
            }

            return $output;
        }
    }
}

vc_map(
    array(
        'name'            => 'Tab item',
        'base'            => 'corpboot_tabs_item',
        'as_child' 		  => array('only' => 'corpboot_tabs'),
        'content_element' => true,
        'params'          => array(
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Tab title', 'js_composer' ),
                'param_name'  => 'title',
                'value'       => ''
            ),
            array(
                'type'        => 'textarea_html',
                'heading'     => __( 'Item text', 'js_composer' ),
                'param_name'  => 'content',
                'value'       => ''
            ),
            array(
                'type'        => 'attach_image',
                'heading'     => __( 'Image', 'js_composer' ),
                'param_name'  => 'image',
                'description' => 'This field is just for style: Modern, Static.'
            ),
        )
    )
);

class WPBakeryShortCode_corpboot_tabs_item extends WPBakeryShortCode{
    protected function content( $atts, $content = null ) {
        global $corpboot_tab_items;
        $corpboot_tab_items[] = array( 'atts' => $atts, 'content' => $content);
        return;
    }
}