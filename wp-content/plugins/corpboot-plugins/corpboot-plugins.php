<?php
/*
Plugin Name: Corpboot Plugins
Plugin URI: demo.qodearena.com/projects/corpbootwp/wp-content/themes/corpboot/include/plugins/corpboot-plugins.zip
Author: QodeArena
Author URI: http://qodearena.com
Version: 1.0.0
Description: Includes Portfolio Custom Post Types and Visual Composer Shortcodes
Text Domain: nagual
*/

// add in constant name path
defined( 'EF_ROOT' )   or define( 'EF_ROOT',   dirname(__FILE__) );
defined( 'T_URI' )     or define( 'T_URI',     get_template_directory_uri() );
defined( 'T_PATH' )    or define( 'T_PATH',    get_template_directory() );
defined( 'T_IMG' )	   or define( 'T_IMG',	   T_URI . '/assets/images' );
defined( 'FUNC_PATH' ) or define( 'FUNC_PATH', T_PATH . '/include' );

// Custom post type Integration
require_once EF_ROOT . '/post-type.php';

// Custom widgets Integration
require_once EF_ROOT . '/widgets.php';

if( ! class_exists( 'Corpboot_Plugins' ) ) {

	class Corpboot_Plugins {

		private $assets_js;

		public function __construct() { 
			$this->assets_js = plugins_url('/composer/js', __FILE__);

			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

			if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {

				require_once( WP_PLUGIN_DIR . '/js_composer/js_composer.php');

				add_action( 'admin_init', array($this, 'wpc_plugin_init') );
				add_action( 'wp', array($this, 'wpc_plugin_init') );
			}
		}

		//include custom map 
		public function wpc_plugin_init(){

			require_once( EF_ROOT .'/composer/init.php');

			foreach( glob( EF_ROOT . '/'. 'composer/shortcodes/corpboot_*.php' ) as $shortcode ) {
				require_once(EF_ROOT .'/'. 'composer/shortcodes/'. basename( $shortcode ) );
			}

			foreach( glob( EF_ROOT . '/'. 'composer/shortcodes/vc_*.php' ) as $shortcode ) {
				require_once(EF_ROOT .'/'. 'composer/shortcodes/'. basename( $shortcode ) );
			}
			
		}

	} // end of class

	// Framework for theme options.
	require_once( EF_ROOT .'/cs-framework/cs-framework.php');

	define( 'CS_ACTIVE_FRAMEWORK', true );
	define( 'CS_ACTIVE_METABOX',   true );
	define( 'CS_ACTIVE_TAXONOMY',  false );
	define( 'CS_ACTIVE_SHORTCODE', false );
	define( 'CS_ACTIVE_CUSTOMIZE', false );

	new Corpboot_Plugins;

} // end of class_exists


/**
 *
 * Get all Contact form 7 forms.
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'corpboot_get_cf7_forms' ) ) {
	function corpboot_get_cf7_forms() {
		$cf7_forms = array( '- Select form -' => 'none' );

		if ( ! function_exists( 'is_plugin_active' ) ) {
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); // Require plugin.php to use is_plugin_active() below
		}

		if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
			global $wpdb;

			$db_cf7froms = $wpdb->get_results("SELECT ID, post_title FROM $wpdb->posts WHERE post_type = 'wpcf7_contact_form'");
			if( $db_cf7froms ) {
				foreach ( $db_cf7froms as $cform ) {
					$cf7_forms[$cform->post_title] = $cform->ID;
				}
			}
		}

		return $cf7_forms;
	}
}

/**
 *
 * Get categories functions. Return array lists
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'corpboot_param_values' ) ) {
	function corpboot_param_values( $post_type = 'terms', $query_args = array() ) {

		$list = array();

		//check type
		switch( $post_type ) {

			case 'posts': // get posts

				$posts = get_posts( $query_args );
				if ( ! empty( $posts ) ) {

					foreach ( $posts as $post ) {
						$list[ $post->post_title ] = $post->post_name;
					}

				} else {
					$list[ esc_html__( 'not found posts','wpc' ) ] = '';
				}

			break;

			case 'terms': // get terms

				$taxonomies = ! empty( $query_args['taxonomies'] ) ? $query_args['taxonomies'] : 'portfolio-category';

				$terms = get_terms( $taxonomies, $query_args );
				if ( ! empty( $terms ) ) {
					foreach ( $terms as $key => $term ) {
						$list[$term->name] = $term->slug;
					}
				} else {
					$list[ esc_html__( 'not found terms or terms empty', 'wpc' ) ] = '';
				}

			break;

			case 'categories': // get categories

				$categories = get_categories( $query_args );
				if ( ! empty( $categories ) ) {

					if(is_array($categories)){
						foreach ( $categories as $category ) {
							$list[$category->name] = $category->slug;
						}
					} else {
						$list[ esc_html__( 'categories not is array', 'wpc' ) ] = '';
					}

				} else {

					$list[ esc_html__( 'not found categories', 'wpc' ) ] = '';

				}

			break;

		}

		// return array
		return $list;
	}
}

/**
 * Portfolio detail ajax load.
 */

if ( ! function_exists( 'corpboot_trest' ) ) {
    function corpboot_trest()
    {

        if (isset($_GET['id'])) {
            $post_id = htmlspecialchars($_GET['id']);
            $post = get_post($post_id);

            $meta_data = get_post_meta($post_id, 'corpboot_portfolio_options', true);

            // Portfolio list
            $output_item = '';
            foreach ($meta_data['list_portfolio'] as $item_list) {
                $output_item .= '<li>' . $item_list['title_list'] . '</li>';
            }

            // Link Project
            $link_project = (!empty($meta_data['link_project']) && !empty($meta_data['title_link_project'])) ? '<p><a href="' . $meta_data['link_project'] . '" target="_blank" class="btn btn-primary-corp mt10"><i class="fa fa-external-link le"></i>' . $meta_data['title_link_project'] . '</a></p>' : '';

            // Portfolio author
            $author_name = get_user_by('id', $post->post_author);

            $type_content_item = '';
            if ($meta_data['post_preview_style'] == 'video') {

                if (!empty($meta_data['post_video'])) :
                    $url = wp_extract_urls($meta_data['post_video']);
                endif;
                $type_content_item = '<p class="embed-responsive embed-responsive-16by9"><iframe src="' . esc_url($url[0]) . '" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></p>';
            } elseif ($meta_data['post_preview_style'] == 'full_video') {
                if (!empty($meta_data['post_full_video'])) :
                    $url = wp_extract_urls($meta_data['post_full_video']);
                endif;
                $type_content_item = '<iframe src="' . esc_url($url[0]) . '" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
            } else {
                $type_content_item = '<p class="text-center"><img src="' . wp_get_attachment_url(get_post_thumbnail_id($post_id)) . '" alt="Photo" class="img-responsive"></p>';
            }

            if ($meta_data['post_preview_style'] == 'video' || $meta_data['post_preview_style'] == 'image') {
                echo '
                <link href="' . get_template_directory_uri() . '/assets/css/bootstrap.min.css" rel="stylesheet">
                <link href="' . get_template_directory_uri() . '/assets/css/font-awesome.min.css" rel="stylesheet">
                <link href="' . get_template_directory_uri() . '/assets/css/main.css" id="theme" rel="stylesheet">
                
                <section class="bg-portfolio-single">
                    <div class="container">
                        <div class="row">
                        
                            <!-- Image -->
                            <div class="col-sm-6 col-md-4">
                                ' . $type_content_item .
                    $link_project . '
                                <div class="visible-xs-block visible-sm-block pt20"></div>
                            </div>
                            
                            <!-- Description -->
                            <div class="col-sm-6 col-md-8">
                                <h4 class="color5 m0 text-uppercase">' . esc_html($post->post_title) . '</h4>
                                <h5>' . esc_html__('By', 'corpboot') . ' ' . $author_name->display_name . '</h5>
                                <p>' . wp_kses_post($post->post_content) . '</p>
                                <h5 class="color5 m0 pb10">' . $meta_data['title_list_portfolio'] . '</h5>
                                <ul class="listicon-check">
                                    ' . $output_item . '
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>';
            } elseif ($meta_data['post_preview_style'] == 'tabs') {

                // Portfolio tabs
                $output_tabs_item = '';
                $output_tabs_content = '';
                $counter = 0;
                foreach ($meta_data['post_tabs'] as $item_tab) {
                    $active = ($counter == 0) ? 'active' : '';
                    $output_tabs_item .= '<li class="' . $active . '"><a data-toggle="tab" href="#tab' . $counter . '">' . $item_tab['title_tabs'] . '</a></li>';

                    $output_tabs_content .= '<div class="tab-pane ' . $active . '" id="tab' . $counter . '">
                    <div class="row">
                        <div class="col-sm-7 mt15">
                            <img src="' . wp_get_attachment_url($item_tab['image_tabs']) . '" alt="Photo" class="img-responsive">
                        </div>
                        <div class="col-sm-5 mt15">
                            <h4 class="color5 m0 text-uppercase">' . $item_tab['title_tabs'] . '</h4>
                            <hr class="mt5 mb10">
                            <p>' . $item_tab['content_tabs'] . '</p>
                            <p><a href="' . $item_tab['url_link'] . '" target="_blank" class="btn btn-primary-corp mt5"><i class="fa fa-external-link le"></i> ' . $item_tab['title_link'] . '</a></p>
                        </div>
                    </div>
                </div>';

                    $counter++;
                }

                echo '
                <link href="' . get_template_directory_uri() . '/assets/css/bootstrap.min.css" rel="stylesheet">
                <link href="' . get_template_directory_uri() . '/assets/css/font-awesome.min.css" rel="stylesheet">
                <link href="' . get_template_directory_uri() . '/assets/css/main.css" id="theme" rel="stylesheet">
              
                <script src="' . esc_url('//code.jquery.com/jquery-1.12.4.min.js') . '"></script>
                <script src="' . get_template_directory_uri() . '/assets/js/bootstrap.min.js"></script>
                <script src="' . get_template_directory_uri() . '/assets/js/bootstrap-select.min.js"></script>
                
                <ul class="nav nav-tabs" data-tabs="tabs">
                    ' . $output_tabs_item . '
                </ul>
                
                <div class="tab-content">
                    ' . $output_tabs_content . '
                </div>';

            } else {
                echo $type_content_item;
            }
        }
        die();
    }

    add_action('wp_ajax_trest', 'corpboot_trest');
    add_action('wp_ajax_nopriv_trest', 'corpboot_trest');
}