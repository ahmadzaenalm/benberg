<?php
/*
 * Lists Shortcode
 * Author: QodeArena
 * Author URI: https://themeforest.net/user/qodearena
 * Version: 1.0.0
 */

vc_map(
    array(
        'name'        => __( 'Lists with icons', 'js_composer' ),
        'base'        => 'corpboot_lists',
        'params'      => array(
            array(
                'heading' 	  => __( 'Style lists', 'js_composer' ),
                'type' 		  => 'dropdown',
                'param_name'  => 'style_lists',
                'value' 	  => array(
                    __( 'Check', 'js_composer' )          => 'listicon-check',
                    __( 'Times', 'js_composer' )          => 'listicon-times',
                    __( 'Chevron Right', 'js_composer' )  => 'listicon-chevron-right'
                )
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

class WPBakeryShortCode_corpboot_lists extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {

        extract( shortcode_atts( array(
            'style_lists'       => 'listicon-check',
            'content_list'      => '',
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

        $content_list = json_decode( urldecode( $content_list ) );

        $title_style 	= '';

        /* Get styles from options */
        $styles = array('title');

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

        // Content list item
        if( ! empty( $content_list ) ) {

            $style_lists = ( isset( $style_lists ) && $style_lists == 'listicon-check' ) ? 'listicon-check' : $style_lists;

            $output .= '<ul class="' . esc_attr( $class ) . ' ' . $style_lists . '">';
            foreach ( $content_list as $item ) {
                $output .= '<li ' . $title_style . '>' . esc_html( $item->title_list ) . '</li>';
            }
            $output .= '</ul>';
        }

        return $output;
    }
}