<?php
/*
 * Team Shortcode
 * Author: QodeArena
 * Author URI: https://themeforest.net/user/qodearena
 * Version: 1.0.0
 */

vc_map(
    array(
        'name'                    => __( 'Team', 'js_composer' ),
        'base'                    => 'corpboot_team',
        'as_parent'               => array( 'only' => 'corpboot_team_item' ),
        'content_element'         => true,
        'show_settings_on_create' => false,
        'js_view'                 => 'VcColumnView',
        'params'                  => array(
            array(
                'heading' 	  => __( 'Style Team', 'js_composer' ),
                'type' 		  => 'dropdown',
                'param_name'  => 'style_team',
                'value' 	  => array(
                    __( 'Default', 'js_composer' ) => 'default',
                    __( 'Slider', 'js_composer' )  => 'slider',
                )
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Extra class name', 'js_composer' ),
                'param_name'  => 'el_class',
                'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
                'value'       => ''
            ),
            array(
                'type'       => 'css_editor',
                'heading'    => __( 'CSS box', 'js_composer' ),
                'param_name' => 'css',
                'group'      => __( 'Design options', 'js_composer' )
            )
        ) //end params
    )
);

class WPBakeryShortCode_corpboot_team extends WPBakeryShortCodesContainer {
    protected function content( $atts, $content = null ) {

        extract( shortcode_atts( array(
            'style_team' => 'default',
            'css'        => '',
            'el_class'   => ''
        ), $atts ) );

        $class = ( ! empty( $el_class ) ) ? $el_class : '';
        $class .= vc_shortcode_custom_css_class( $css, ' ' );
        $output = '';

        global $corpboot_team_items;
        $corpboot_team_items = '';

        ob_start();

        do_shortcode( $content );

        if ( ! empty( $corpboot_team_items ) && count( $corpboot_team_items ) > 0 ) {

            if( isset( $style_team ) && $style_team == 'slider' ) {
                $output .= '<div class="slick-carousel ' . $class  . '" id="team">';
            } else {
                $output .= '<div class="row">';
            }

            foreach ( $corpboot_team_items as $key => $item ) {
                $value = (object)$item['atts'];

                // Author
                $author = ( ! empty( $value->author ) ) ? '<h4 class="h-underline2">' . $value->author . '</h4>' : '';

                // Position
                $position = ( ! empty( $value->position ) ) ? '<h5>' . $value->position . '</h5>' : '';

                // Title
                $title = ( ! empty( $value->title ) ) ? '<strong class="color4 text-uppercase">' . $value->title . '</strong><br>' : '';

                // Description
                $description = ( ! empty( $item['content'] ) ) ? $item['content'] : '';

                // Image
                $image = ( ! empty( $value->image ) && is_numeric( $value->image ) ) ? '<img src="' . wp_get_attachment_url( $value->image ) . '" class="img-responsive" alt="' . $value->author . '">' : '';

                // Animation content
                $animation = ( ! empty( $value->animation ) ) ? $value->animation : 'fadeInLeft';

                // Social
                $social_content = '';
                $social = ! empty( $value->social ) ? json_decode( urldecode( $value->social ) ) : false;
                if( $social ) {
                    foreach ( $social as $social_item ) {
                        $icon       = ( ! empty( $social_item->icon ) ) ? $social_item->icon : '';
                        $icon_url   = ( ! empty( $social_item->url ) ) ? $social_item->url : '';
                        $icon_color = ( ! empty( $social_item->icon_color ) ) ? 'style="color:' . $social_item->icon_color . '"' : '';

                        $type_social = ( isset( $style_team ) && $style_team == 'default' ) ? 'data-toggle="tooltip" data-placement="bottom" data-original-title="Facebook" class="corp-tooltip"' : '';

                        $social_content .= '<li><a href="' . $icon_url . '" ' . $type_social . ' target="_blank"><i class="' . $icon . ' fa-2x" ' . $icon_color . '></i></a></li> ';

                    }
                }

                // Content list one
                $content_list_one = '';
                $list_item = ! empty( $value->content_list_one ) ? json_decode( urldecode( $value->content_list_one ) ) : false;
                if( $list_item ) {
                    foreach ( $list_item as $item ) {
                        $list = ( ! empty( $item->lists ) ) ? '<li>' . $item->lists . '</li>' : '';
                        $content_list_one .= $list;
                    }
                }

                // Content list two
                $content_list_two = '';
                $list_item = ! empty( $value->content_list_two ) ? json_decode( urldecode( $value->content_list_two ) ) : false;
                if( $list_item ) {
                    foreach ( $list_item as $item ) {
                        $list = ( ! empty( $item->lists ) ) ? '<li>' . $item->lists . '</li>' : '';
                        $content_list_two .= $list;
                    }
                }

                // Content list three
                $content_list_three = '';
                $list_item = ! empty( $value->content_list_three ) ? json_decode( urldecode( $value->content_list_three ) ) : false;
                if( $list_item ) {
                    foreach ( $list_item as $item ) {
                        $list = ( ! empty( $item->lists ) ) ? '<li>' . $item->lists . '</li>' : '';
                        $content_list_three .= $list;
                    }
                }

                if( isset( $style_team ) && $style_team == 'default' ) {
                    $output .= '<div class="col-sm-6 col-md-3 wow ' . $animation . '" data-wow-duration="1000ms" data-wow-delay="300ms">';

                        // Hover Content
                        $output .= '<figure class="item-img-wrap">';
                            $output .= $image;
                            $output .= '<div class="item-img-overlay">';
                                $output .= '<div class="team-social">';
                                    $output .= '<p>' . $title . ' ' . $description . '</p>';
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</figure>';

                        // Content Team
                        $output .= '<div class="team-name">';
                            $output .= $author;
                            $output .= $position;
                            $output .= '<ul class="list-inline socialstaff">';
                                $output .= $social_content;
                            $output .= '</ul>';
                        $output .= '</div>';

                        $output .= '<div class="visible-xs-block visible-sm-block pt20"></div>';

                    $output .= '</div>';
                } else { // Style team: slider
                    $output .= '<div class="row">';
                        $output .= '<div class="col-sm-6 col-md-3 text-center">';

                        // Image and hover content
                        $output .= '<div class="item-img-wrap">';
                            $output .= $image;
                                $output .= '<div class="item-img-overlay">';
                                    $output .= '<div class="team-social">';
                                    $output .= '<p><strong class="color4">' . esc_html__('Social Media', 'corpboot') . '</strong></p>';
                                    $output .= '<ul class="list-inline socialstaff">';
                                        $output .= $social_content;
                                    $output .= '</ul>';
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';
                        $output .= '<div class="visible-xs-block visible-sm-block pt20"></div>';

                        $output .= '</div>';

                        // Content team
                        $output .= '<div class="col-sm-6 col-md-9 pb30">';
                            $output .= '<h4 class="color5 text-uppercase">' . ( ! empty( $value->author ) ? $value->author : '' ) . ' ' . ( ! empty( $value->position ) ? '<small><i class="fa fa-angle-right"></i> ' . $value->position . '</small>' : '' ) . '</h4>';
                            $output .= '<p>' . $description . '</p>';
                            $output .= ( ( ! empty( $value->title ) ) ? '<h5 class="color5 m0 pb10">' . $value->title . '</h5>' : '' );
                            $output .= '<div class="row highlights">';
                                $output .= '<div class="col-md-4">';
                                    $output .= '<ul class="listicon-check">';
                                        $output .= $content_list_one;
                                    $output .= '</ul>';
                                $output .= '</div>';
                                $output .= '<div class="col-md-4">';
                                    $output .= '<ul class="listicon-check">';
                                        $output .= $content_list_two;
                                    $output .= '</ul>';
                                $output .= '</div>';
                                $output .= '<div class="col-md-4">';
                                    $output .= '<ul class="listicon-check">';
                                        $output .= $content_list_three;
                                    $output .= '</ul>';
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                }

            }

            $output .= '</div>';

        }

        return  $output;
    }
}

vc_map(
    array(
        'name'            => 'Item',
        'base'            => 'corpboot_team_item',
        'as_child'        => array( 'only' => 'corpboot_team' ),
        'content_element' => true,
        'params'          => array(
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Author', 'js_composer' ),
                'admin_label' => true,
                'param_name'  => 'author'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Position', 'js_composer' ),
                'param_name'  => 'position'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Title', 'js_composer' ),
                'param_name'  => 'title'
            ),
            array(
                'type'       => 'textarea',
                'heading'    => __( 'Content', 'js_composer' ),
                'param_name' => 'content',
                'value'      => ''
            ),
            array(
                'type'       => 'attach_image',
                'heading'    => __( 'Image', 'js_composer' ),
                'param_name' => 'image'
            ),
            array(
                'type'       => 'param_group',
                'heading'    => __( 'Social', 'js_composer' ),
                'param_name' => 'social',
                'params'     => array(
                    array(
                        'heading'     => __( 'Icon', 'js_composer' ),
                        'type'        => 'iconpicker',
                        'param_name'  => 'icon',
                        'description' => __( 'Select icon from library.', 'js_composer' ),
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => __( 'Socail URL', 'js_composer' ),
                        'param_name' => 'url',
                        'value'      => ''
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => __( 'Icon Color', 'js_composer' ),
                        'param_name'  => 'icon_color',
                    ),
                ),
                'callbacks'  => array(
                    'after_add' => 'vcChartParamAfterAddCallback'
                )
            ),
            array(
                'type'       => 'param_group',
                'heading'    => __( 'Content list column one', 'js_composer' ),
                'param_name' => 'content_list_one',
                'params'     => array(
                    array(
                        'type'       => 'textarea',
                        'heading'    => __( 'Lists', 'js_composer' ),
                        'param_name' => 'lists',
                    ),
                ),
                'callbacks'  => array(
                    'after_add' => 'vcChartParamAfterAddCallback'
                )
            ),
            array(
                'type'       => 'param_group',
                'heading'    => __( 'Content list column two', 'js_composer' ),
                'param_name' => 'content_list_two',
                'params'     => array(
                    array(
                        'type'       => 'textarea',
                        'heading'    => __( 'Lists', 'js_composer' ),
                        'param_name' => 'lists',
                    ),
                ),
                'callbacks'  => array(
                    'after_add' => 'vcChartParamAfterAddCallback'
                )
            ),
            array(
                'type'       => 'param_group',
                'heading'    => __( 'Content list column three', 'js_composer' ),
                'param_name' => 'content_list_three',
                'params'     => array(
                    array(
                        'type'       => 'textarea',
                        'heading'    => __( 'Lists', 'js_composer' ),
                        'param_name' => 'lists',
                    ),
                ),
                'callbacks'  => array(
                    'after_add' => 'vcChartParamAfterAddCallback'
                )
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
            ),
        )
    )
);


class WPBakeryShortCode_corpboot_team_item extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        global $corpboot_team_items;
        $corpboot_team_items[] = array( 'atts' => $atts, 'content' => $content );

        return;
    }
}