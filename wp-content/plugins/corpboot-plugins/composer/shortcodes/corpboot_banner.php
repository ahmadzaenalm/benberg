<?php
/*
 * Banner Shortcode
 * Author: QodeArena
 * Author URI: http://qodearena.com/
 * Version: 1.0.0
 */

vc_map(
    array(
        'name'        => __( 'Banner', 'js_composer' ),
        'base'        => 'corpboot_banner',
        'params'      => array(
            array(
                'heading' 	  => __( 'Style Banner', 'js_composer' ),
                'type' 		  => 'dropdown',
                'param_name'  => 'style_banner',
                'value' 	  => array(
                    __( 'Default', 'js_composer' )  => 'default',
                    __( 'Image', 'js_composer' )    => 'image',
                    __( 'Video', 'js_composer' )    => 'video',
                )
            ),
            array(
                'type'        => 'textarea',
                'heading'     => __( 'Title', 'js_composer' ),
                'param_name'  => 'title',
                'dependency'  => array( 'element' => 'style_banner', 'value_not_equal_to' => 'default' )
            ),
            array(
                'type'     	  => 'textarea',
                'heading'     => __( 'Subtitle', 'js_composer' ),
                'param_name'  => 'subtitle',
                'value'    	  => '',
                'dependency'  => array( 'element' => 'style_banner', 'value_not_equal_to' => 'default' )
            ),
            array(
                'type'     	  => 'textarea',
                'heading'     => __( 'Description', 'js_composer' ),
                'param_name'  => 'text',
                'value'    	  => '',
                'dependency'  => array( 'element' => 'style_banner', 'value_not_equal_to' => 'default' )
            ),
            array(
                'type'        => 'attach_image',
                'heading'     => __( 'Image Slide', 'js_composer' ),
                'param_name'  => 'image',
                'dependency'  => array( 'element' => 'style_banner', 'value_not_equal_to' => 'default' )
            ),
            array(
                'type'        => 'attach_image',
                'heading'     => __( 'Video Slide', 'js_composer' ),
                'param_name'  => 'video',
                'dependency'  => array( 'element' => 'style_banner', 'value' => 'video' )
            ),
            array(
                'type' 		  => 'vc_link',
                'heading' 	  => __( 'Button', 'js_composer' ),
                'param_name'  => 'button',
                'dependency'  => array( 'element' => 'style_banner', 'value_not_equal_to' => 'default' )
            ),
            array(
                'heading'     => __( 'Icon', 'js_composer' ),
                'type'        => 'iconpicker',
                'param_name'  => 'icon',
                'description' => __( 'Select icon from library.', 'js_composer' ),
                'dependency'  => array( 'element' => 'style_banner', 'value_not_equal_to' => 'default' )
            ),
            array(
                'type' => 'animation_style',
                'heading' => __( 'Animation In', 'js_composer' ),
                'param_name' => 'animation',
                'group' 	 => __( 'Style', 'js_composer' ),
                'settings' => array(
                    'type' => array(
                        'in',
                        'other',
                    ),
                ),
                'dependency'  => array( 'element' => 'style_banner', 'value_not_equal_to' => 'default' )
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
                'heading'     => __( 'Subtitle font size', 'js_composer' ),
                'param_name'  => 'subtitle_font_size',
                'value'       => '',
                'group' 	  => __( 'Style', 'js_composer' )
            ),
            array(
                'type'        => 'colorpicker',
                'heading'     => __( 'Subtitle color', 'js_composer' ),
                'param_name'  => 'subtitle_color',
                'group' 	  => __( 'Style', 'js_composer' )
            ),
            array(
                'type' 		 => 'dropdown',
                'heading' 	 => __( 'Subtitle font family', 'js_composer' ),
                'param_name' => 'subtitle_font_family',
                'value' 	 => array(
                    __( 'Default',  'js_composer' ) => 'default',
                    __( 'Custom',   'js_composer' ) => 'custom'
                ),
                'group' 	 => __( 'Style', 'js_composer' )
            ),
            array(
                'type' 		 => 'google_fonts',
                'param_name' => 'subtitle_font',
                'value' 	 => '',
                'settings'   => array(
                    'fields' => array(
                        'font_family_description' => __( 'Select font family.', 'js_composer' ),
                        'font_style_description'  => __( 'Select font styling.', 'js_composer' ),
                    ),
                ),
                'dependency' => array( 'element' => 'subtitle_font_family', 'value' => 'custom' ),
                'group' 	 => __( 'Style', 'js_composer' )
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Content font size', 'js_composer' ),
                'param_name'  => 'content_font_size',
                'value'       => '',
                'group' 	  => __( 'Style', 'js_composer' )
            ),
            array(
                'type'        => 'colorpicker',
                'heading'     => __( 'Content color', 'js_composer' ),
                'param_name'  => 'content_color',
                'group' 	  => __( 'Style', 'js_composer' )
            ),
            array(
                'type' 		 => 'dropdown',
                'heading' 	 => __( 'Content font family', 'js_composer' ),
                'param_name' => 'content_font_family',
                'value' 	 => array(
                    __( 'Default',  'js_composer' ) => 'default',
                    __( 'Custom',   'js_composer' ) => 'custom'
                ),
                'group' 	 => __( 'Style', 'js_composer' )
            ),
            array(
                'type' 		 => 'google_fonts',
                'param_name' => 'content_font',
                'value' 	 => '',
                'settings'   => array(
                    'fields' => array(
                        'font_family_description' => __( 'Select font family.', 'js_composer' ),
                        'font_style_description'  => __( 'Select font styling.', 'js_composer' ),
                    ),
                ),
                'dependency' => array( 'element' => 'content_font_family', 'value' => 'custom' ),
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

class WPBakeryShortCode_corpboot_banner extends WPBakeryShortCode{
    protected function content( $atts, $content = null ) {

        extract( shortcode_atts( array(
            'style_banner'   	   => 'default',
            'title' 			   => '',
            'subtitle' 			   => '',
            'text' 			       => '',
            'image' 			   => '',
            'video' 			   => '',
            'button' 			   => '',
            'icon' 			       => '',
            'animation' 		   => '',
            'el_class' 			   => '',
            'title_font_size' 	   => '',
            'title_color' 		   => '',
            'title_font_family'    => 'default',
            'title_font' 		   => '',
            'subtitle_font_size'   => '',
            'subtitle_color' 	   => '',
            'subtitle_font_family' => 'default',
            'subtitle_font' 	   => '',
            'content_font_size'    => '',
            'content_color' 	   => '',
            'content_font_family'  => 'default',
            'content_font' 	       => '',
            'css' 		 		   => ''
        ), $atts ) );

        $google_fonts = new Vc_Google_Fonts;

        $class  = ( ! empty( $el_class ) ) ? $el_class : '';
        $class .= vc_shortcode_custom_css_class( $css, ' ' );

        $image 	= ( ! empty( $image ) && is_numeric( $image ) ) ? wp_get_attachment_url( $image ) : '';

        // Animation content
        $animation = ( ! empty( $animation ) ) ? $animation : 'fadeInUp';

        $title_style      = '';
        $subtitle_style   = '';
        $content_style    = '';

        ?> <?php $breadcrumbs = corpboot_breadcrumbs() ?>
        <?php

        $styles = array( 'title', 'subtitle', 'content' );

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

        $title = ( ! empty( $title ) ) ? $title : '';

        $output = '';

        // Title
        $title = ( ! empty( $title ) ) ? '<span class="middle" ' . $title_style . '>' . $title . '</span>' : '';

        // Subtitle
        $subtitle = ( ! empty( $subtitle ) ) ? '<span class="upper" ' . $subtitle_style . '>' . esc_html( $subtitle ) . '</span>' : '';

        // Content
        $text = ( ! empty( $text ) ) ? '<span class="bottom" ' . $content_style . '>' . esc_html( $text ) . '</span>' : '';

        // Link
        $link = ( ! empty( $button ) ) ? vc_build_link( $button ) : '';
        $link_target = ( ! empty( $link['target'] ) ) ? 'target="' . $link['target'] . '"' : '';

        // Button
        $icon = ( ! empty( $icon ) ) ? '<i class="' . esc_attr( $icon ) . '"></i>' : '';
        $button = ( ! empty( $link ) ) ? '<a href="' . esc_url( $link['url'] ) . '" ' . $link_target . ' class="btn btn-transparent">' . $icon . ' ' . esc_html( $link['title'] ) . '</a>' : '';

        // Image
        $image = ( ! empty( $image ) ) ? 'style="background-image: url(' . esc_url( $image ) . ');"' : '';

        // Video
        $video_output = '';

       $video_item = ( ! empty( $video ) && is_numeric( $video ) ) ? wp_get_attachment_url( $video ) : '';
       $video_output .= '<video loop muted autoplay class="bg-video">';
       $video_output .= '<source src="' . $video_item . '" type="video/mp4">';
       $video_output .= '</video>';

        if( $style_banner == 'default' ) {
            $output .= '<div class="breadcrumb-container">';
                $output .= '<div class="container text-right">';
                    $output .= '<ol class="breadcrumb">';
                        $output .= $breadcrumbs;
                    $output .= '</ol>';
                $output .= '</div>';
            $output .= '</div>';
        } else {
            $output .= '<header class="' . $class . '">';
                $output .= '<div class="bg-img-fixed-content">';

                if( $style_banner == 'image' ) {
                    $output .= '<div class="bg-img-fixed" ' . $image . '></div>';
                } else {
                    $output .= $video_output;
                }

                $output .= '<section class="home-promo">';
                    $output .= '<div class="text-center wow ' . esc_attr( $animation ) . '" data-wow-duration="1000ms" data-wow-delay="500ms">';
                        $output .= '<h2 class="titlepro">';
                            $output .= $subtitle;
                            $output .= $title;
                            $output .= $text;
                        $output .= '</h2>';
                        $output .= $button;
                    $output .= '</div>';
                $output .= '</section>';

            $output .= '</div>';
            $output .= '</header>';
        }

        return $output;
    }
}