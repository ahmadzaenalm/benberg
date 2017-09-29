<?php
/*
 * Call to action Shortcode
 * Author: QodeArena
 * Author URI: https://themeforest.net/user/qodearena
 * Version: 1.0.0
 */

vc_map(
    array(
        'name'        => __( 'Call to action', 'js_composer' ),
        'base'        => 'corpboot_call_action',
        'params'      => array(
            array(
                'type' 		 => 'dropdown',
                'heading' 	 => __( 'Style', 'js_composer' ),
                'param_name' => 'style',
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
                'heading'     => __( 'Decription', 'js_composer' ),
                'admin_label' => true,
                'param_name'  => 'content',
                'dependency' => array( 'element' => 'style', 'value' => 'default' ),
            ),
            array(
                'type' 		 => 'vc_link',
                'heading' 	 => __( 'Link', 'js_composer' ),
                'param_name' => 'link',
            ),
            array(
                'heading'     => __( 'Icon Button', 'js_composer' ),
                'type'        => 'iconpicker',
                'param_name'  => 'icon',
                'description' => __( 'Select icon from library.', 'js_composer' ),
            ),
            array(
                'type'        => 'attach_image',
                'heading'     => __( 'Background Call Action', 'js_composer' ),
                'param_name'  => 'bg_action',
                'dependency' => array( 'element' => 'style', 'value' => 'default' ),
            ),
            array(
                'type'        => 'colorpicker',
                'heading'     => __( 'Block color', 'js_composer' ),
                'param_name'  => 'block_color',
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

class WPBakeryShortCode_corpboot_call_action extends WPBakeryShortCode{
    protected function content( $atts, $content = null ) {

        extract( shortcode_atts( array(
            'style' 			=> 'default',
            'title' 			=> '',
            'link' 			    => '',
            'icon' 			    => '',
            'bg_action' 		=> '',
            'block_color' 		=> '',
            'el_class' 			=> '',
            'title_font_size' 	=> '',
            'title_color' 		=> '',
            'title_font_family' => 'default',
            'title_font' 	    => '',
            'css' 			    => ''
        ), $atts ) );

        $google_fonts = new Vc_Google_Fonts;

        $class  = ( ! empty( $el_class ) ) ? $el_class : '';
        $class .= vc_shortcode_custom_css_class( $css, ' ' );

        $output = '';

        $title_style 	= '';

        /* Get styles from options */
        $styles = array('title');

        foreach ( $styles as $item ) {

            if( ! empty( ${$item."_font_size"} ) ) {
                ${$item."_style"} = ( is_numeric( ${$item."_font_size"} ) ) ? 'font-size: ' . ${$item."_font_size"} . 'px;' : 'font-size: ' . ${$item."_font_size"} . ';';
            }
            ${$item."_style"} .= ( ! empty( ${$item."_color"} ) ) ? 'color: ' . ${$item."_color"} . ';' : '';

            $title_style .= ( ! empty( $title_color ) ) ? 'color: ' . $title_color . ';' : '';

            if( ${$item."_font_family"} == 'custom' ) {
                ${$item."_font"} = $google_fonts->_vc_google_fonts_parse_attributes( $atts, ${$item."_font"} );

                $subsets  = '';
                $settings = get_option( 'wpb_js_google_fonts_subsets' );
                if ( is_array( $settings ) && ! empty( $settings ) ) {
                    $subsets = '&subset=' . implode( ',', $settings );
                }

                wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( ${$item."_font"}['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . ${$item."_font"}['values']['font_family'] . $subsets );

                ${$item."_font"} = explode( ':', ${$item."_font"}['values']['font_family'] );

                ${$item."_style"} .= 'font-family: ' . ${$item."_font"}[0] . ';';
            }

            ${$item."_style"} = ( ! empty( ${$item."_style"} ) ) ? 'style="' . ${$item."_style"} . '"' : '';

        }

        // Button
        $link = vc_build_link( $link );
        $icon = ( ! empty( $icon ) ) ? '<i class="' . esc_attr( $icon ) . ' le"></i>' : '';

        if( isset( $style ) && $style == 'default' ) {
            // Title
            $title = ( ! empty( $title ) ) ? '<h1 class="intro-text mt30 wow fadeInUp">' . esc_html( $title ) . '</h1>' : '';

            // Description
            $desc = ( ! empty( $content ) ) ? '<p class="lead mt30">' . esc_html( $content ) . '</p>'  : '';

            // Image banner
            $image 	= ( ! empty( $bg_action ) && is_numeric( $bg_action ) ) ? wp_get_attachment_url( $bg_action ) : '';

            $output .= '<section class="bg-buy parallax process-rounded ' . esc_attr( $class ) . '" data-stellar-background-ratio="0.5" style="background-image: url(' . $image . ');">';
                $output .= '<div class="container-fluid">';
                    $output .= '<div class="row text-center">';
                        $output .= '<div class="col-md-12">';
                            $output .= $title;
                            $output .= $desc;
                            if( ! empty( $link['url'] ) || ! empty( $link['title'] ) ) {
                                $link_target = ( ! empty( $link['target'] ) ) ? 'target="' . $link['target'] . '"' : '';
                                $output .= '<p><a href="' . esc_url( $link['url'] ) . '" class="btn btn-default btn-primary-corp-big" ' . $link_target . '>' . $icon . ' ' . esc_html( $link['title'] ) . '</a><p>';
                            }
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
            $output .= '</section>';
        } else {
            $block_color = ( ! empty( $block_color ) ) ? 'style="background-color: ' . $block_color . ' ;"' : '';

            $output .= '<section class="bg-gray" ' . $block_color . '>';
                $output .= '<div class="container text-center contact-por wow fadeInUp ' . esc_attr( $class ) . '" data-wow-duration="1000ms" data-wow-delay="50ms">';
                    $output .= ( ! empty( $title ) ? '<h4 class="pb10">' . $title . '</h4> ' : '');
                    if( ! empty( $link['url'] ) || ! empty( $link['title'] ) ) {
                        $link_target = ( ! empty( $link['target'] ) ) ? 'target="' . $link['target'] . '"' : '';
                        $output .= '<a href="' . esc_url( $link['url'] ) . '" class="btn btn-default btn-primary-corp-big" ' . $link_target . '>' . $icon . ' ' . esc_html( $link['title'] ) . '</a>';
                    }
                $output .= '</div>';
            $output .= '</section>';
        }

        return $output;
    }
}