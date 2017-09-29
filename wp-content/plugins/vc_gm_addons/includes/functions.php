<?php
if ( ! function_exists('get_language_code') ){
    function get_language_code(){
        require_once( ABSPATH . 'wp-admin/includes/translation-install.php' );
        $language = array();
        foreach( wp_get_available_translations() as $lan_key => $lang ){
            $language[ $lang['english_name'] ] = $lan_key;
        }
       return $language;
    }
}