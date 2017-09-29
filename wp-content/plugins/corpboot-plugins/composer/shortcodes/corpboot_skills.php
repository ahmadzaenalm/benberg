<?php
/*
 * Skills Shortcode
 * Author: QodeArena
 * Author URI: http://qodearena.com/
 * Version: 1.0.0
 */

vc_map(
    array(
        'name'                    => __( 'Skills', 'js_composer' ),
        'base'                    => 'corpboot_skills',
        'as_parent' 		      => array('only' => 'corpboot_skills_item'),
        'content_element'         => true,
        'show_settings_on_create' => false,
        'js_view'                 => 'VcColumnView',
        'params'          		  => array(
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

class WPBakeryShortCode_corpboot_skills extends WPBakeryShortCodesContainer {
    protected function content( $atts, $content = null ) {

        extract( shortcode_atts( array(
            'css'	             => '',
            'el_class'           => ''
        ), $atts ) );

        $class  = ( ! empty( $el_class ) ) ? $el_class : '';
        $class .= vc_shortcode_custom_css_class( $css, ' ' );
        $output = '';

        global $corpboot_skills_items;
        $corpboot_skills_items = '';

        do_shortcode( $content );

        if( ! empty( $corpboot_skills_items ) && count( $corpboot_skills_items ) > 0 ) {

            $output = '';

            $output .= '<div class="skills ' . $class . '">';

                foreach ( $corpboot_skills_items as $key => $item ) {
                    $value = (object)$item['atts'];

                    $output .= ( ! empty( $value->title ) ) ? '<h5>' . esc_html( $value->title ) . '</h5>' : '';
                    if( ! empty( $value->number ) ) :
                        $output .= '<div class="progress wow fadeInUp">';
                        $output .= '<div class="progress-bar progress-bar-striped" role="progressbar" data-value="' . esc_attr( $value->number ) . '" style="width: ' . $value->number . '%;">' . esc_html( $value->number ) . '%<span></span></div>';
                        $output .= '</div>';
                    endif;
                }

            $output .= '</div>';

        }
        return $output;
    }
}

vc_map(
    array(
        'name'            => 'Item',
        'base'            => 'corpboot_skills_item',
        'as_child' 		  => array('only' => 'corpboot_skills'),
        'content_element' => true,
        'params'          => array(
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Title', 'js_composer' ),
                'admin_label' => true,
                'param_name'  => 'title'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Number', 'js_composer' ),
                'param_name'  => 'number'
            ),
        ),
    )
);


class WPBakeryShortCode_corpboot_skills_item extends WPBakeryShortCode{
    protected function content( $atts, $content = null ) {
        global $corpboot_skills_items;
        $corpboot_skills_items[] = array( 'atts' => $atts, 'content' => $content);
        return;
    }
}

