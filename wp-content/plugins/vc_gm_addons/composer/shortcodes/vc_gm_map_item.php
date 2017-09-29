<?php
vc_map(
    array(
        'name'            => 'Map item',
        'base'            => 'vc_gm_map_item',
        'as_child' 		  => array('only' => 'vc_gm_map'),
        'icon'                    => 'gm-addon-shortcode__icon-item',
        'admin_enqueue_css'       => '/wp-content/plugins/vc_gm_addons/admin/css/gm-addon-admin-style.css',
        'content_element' => true,
        'params'          => array(
            //Address (Latitude|Longitude)
            array(
                'type' 		  => 'textfield',
                'heading'     => __( 'Address (Latitude,Longitude)', 'js_composer' ),
                'description' => __( 'Add location address' ),
                'param_name'  => 'address',
            ),

            //Text for Directions Link
            array(
                'type' 		  => 'textfield',
                'heading'     => __( 'Text for Directions Link', 'js_composer' ),
                'description' => __( 'Text for Directions Link. Leave blank to remove direction link from info window.' ),
                'param_name'  => 'direction_link',
            ),

            //Marker Icon
            array(
                'heading'     => __( 'Marker Icon', 'js_composer' ),
                'type' 		  => 'attach_image',
                'description' => __( 'Upload marker pin icon' ),
                'param_name'  => 'marker_icon',
            ),

            //Icon Animation
            array(
                'heading' 	  => __( 'Icon Animation', 'js_composer' ),
                'type' 		  => 'dropdown',
                'param_name'  => 'icon_animation',
                'description' => 'Select marker animation',
                'value' 	  => array(
                    __( 'None',     'js_composer' ) => 'none',
                    __( 'BOUNCE',   'js_composer' ) => 'BOUNCE',
                    __( 'DROP',     'js_composer' ) => 'DROP',
                ),
            ),

            //Default Open Info Window
            array(
                'heading' 	  => __( 'Default Open Info Window', 'js_composer' ),
                'type' 		  => 'dropdown',
                'param_name'  => 'default_open_info_window',
                'description' => 'If yes, marker info window will be opened by default',
                'value' 	  => array(
                    __( 'No', 'js_composer' ) => 'no',
                    __( 'Yes', 'js_composer' ) => 'yes',
                ),
            ),

            //Marker Content
            array(
                'heading'     => __( 'Marker Content', 'js_composer' ),
                'type' 		  => 'textarea_html',
                'description' => __( 'Marker Content' ),
                'param_name'  => 'content',
            ),

        ),
    )
);


class WPBakeryShortCode_vc_gm_map_item extends WPBakeryShortCode{
    protected function content( $atts, $content = null ) {

        extract( shortcode_atts( array(
            'address'           => '',
            'direction_link'    => '',
            'marker_icon' 	    => '',
            'icon_animation'    => 'none',
            'default_open_info_window' => 'no',
        ), $atts ) );

        $item_settings = array(
            'marker_address'            => $address,
            'direction_link'            => $direction_link,
            'marker_icon' 	            => $marker_icon,
            'icon_animation'    	    => $icon_animation,
            'default_open_info_window'  => $default_open_info_window,
            'content'                   => $content,
        );

        global $vc_gm_map_items;
        $vc_gm_map_items[] = array( 'atts' => $item_settings );
        return;
    }
}