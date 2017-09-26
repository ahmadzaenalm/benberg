<?php
/**
 * Helper functions
 *
 * @package benbergarome
 * @since 1.0.0
 *
 */

/**
 * Global variable with all theme options
 */
if ( ! function_exists( 'corpboot_get_options' ) ) {
    /**
     * @param bool $default
     * @return bool|mixed
     */
    function corpboot_get_options($default = false ) {

        if( function_exists( 'cs_framework_init' ) ) {
            global $corpboot_opt;
            if( empty( $corpboot_opt ) ) {
                $corpboot_opt = apply_filters( 'cs_get_option', get_option( CS_OPTION ) );
            }
            if( isset( $_GET['style'] ) && $_GET['style'] == 'post-left-sidebar' ) {
            	$corpboot_opt['post_sidebar']  = 'left';
            } elseif( isset( $_GET['style'] ) && $_GET['style'] == 'blog-left-sidebar' ) {
                $corpboot_opt['blog_sidebar']  = 'left';
            } elseif( isset( $_GET['style'] ) && $_GET['style'] == 'medical' ) {
                $corpboot_opt['global_style_color']    = '#00BCD4';
                $corpboot_opt['footer_sidebar_color']  = '#10595E';
                $corpboot_opt['footer_bottom_color']   = '#0e4f53';
                $corpboot_opt['site_logo']   = '//demo.qodearena.com/projects/corpbootwp/wp-content/uploads/2017/02/logo-cyan.png';
            } elseif( isset( $_GET['style'] ) && $_GET['style'] == 'law' ) {
                $corpboot_opt['global_style_color']    = '#6D4C41';
                $corpboot_opt['footer_sidebar_color']  = '#3E2723';
                $corpboot_opt['footer_bottom_color']   = '#36221e';
                $corpboot_opt['site_logo']   = '//demo.qodearena.com/projects/corpbootwp/wp-content/uploads/2017/02/logo-brown.png';
            }
            return $corpboot_opt;
        } else {
            return $default;
        }
	}
	add_action( 'wp', 'corpboot_get_options' );
}

/**
 * Custom menu
 */
if ( ! function_exists( 'corpboot_custom_menu' ) ) {
	function corpboot_custom_menu() {
		if ( has_nav_menu( 'top-menu' ) ) {
            $walker = new Corpboot_Menu_Walker;
			wp_nav_menu(
				array(
					'container'       => false,
					'items_wrap'      => '<ul class="nav navbar-nav navbar-right">%3$s</ul>',
					'theme_location'  => 'top-menu',
					'depth'           => 3,
                    'walker' => $walker
				)
			);
		} else {
			echo '<div class="no-menu">' . esc_html__( 'Please register Top Navigation from', 'corpboot' ) . ' <a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '" target="_blank">' . esc_html__( 'Appearance &gt; Menus', 'corpboot' ) . '</a></div>';
		}
	}
}

/**
 * Get social links list
 */
if ( ! function_exists( 'corpboot_get_social' ) ) {
	function corpboot_get_social() {
		global $corpboot_opt;

		if ( ! empty( $corpboot_opt['footer_social_links'] ) ) {

			$output  = '<div class="col-sm-6 social">';
                $output  .= '<ul class="list-inline social">';
                foreach ( $corpboot_opt['footer_social_links'] as $social ) {
                    if( ! empty( $social['footer_social_link'] ) && ! empty( $social['footer_social_icon'] ) ) {
                        $output .= '<li><a href="' . esc_url( $social['footer_social_link'] ) . '" target="_blank"><i class="' . esc_attr( $social['footer_social_icon'] ) . '"></i></a></li> ';
                    }
                }
                $output .= '</ul>';
			$output .= '</div>';
			echo wp_kses_post( $output );
		}
	}
}

/**
 * Replaces the excerpt "more" text by a link
 */
if ( ! function_exists( 'corpboot_excerpt_more' ) ) {
	function corpboot_excerpt_more() {
		return esc_html__( '...', 'corpboot' );
	}
	add_filter('excerpt_more', 'corpboot_excerpt_more');
}

/**
 * Get post format.
 */
if ( ! function_exists( 'corpboot_get_post_format' ) ) {
    function corpboot_get_post_format() {
        return get_post_format();
    }
}

/**
 * Filter the except length to 20 characters.
 */
if ( ! function_exists( 'corpboot_custom_excerpt_length' ) ) {
	function corpboot_custom_excerpt_length() {
	    return 32;
	}
	add_filter( 'excerpt_length', 'corpboot_custom_excerpt_length', 999 );
}

/**
 * Body class.
 **/

if ( ! function_exists( 'corpboot_body_class' ) ) {
    function corpboot_body_class( $classes ) {

        $classes[] = '';

        if( ! class_exists('Corpboot_Plugins') ) {
            $classes[] .= ' default-menu blog-default ';
        }

        return $classes;
    }
}
add_filter('body_class','corpboot_body_class');

/**
 * Return theme logo
 */
if ( ! function_exists( 'corpboot_logo' ) ) {
	function corpboot_logo() {
		global $corpboot_opt;
		if ( isset( $corpboot_opt['logo_type'] ) ) {
			// for text logo
			if ( $corpboot_opt['logo_type'] == 'text' ) {
				echo esc_html( $corpboot_opt['text_logo'] );
			}
			// for image logo
			if ( $corpboot_opt['logo_type'] == 'image') {
				$retina = ( ! empty( $corpboot_opt['retina_logo'] ) ) ? 'data-retina="'. esc_url( $corpboot_opt['retina_logo'] ) .'"' : '';
				if ( ! empty( $corpboot_opt['site_logo'] ) ) {
					echo '<img '. $retina .' src="'. esc_url( $corpboot_opt['site_logo'] ) .'" alt="" />';
				} else {
					echo esc_html( $corpboot_opt['text_logo'] );
				}
			}
		} else {
            echo '<img src="'. CORPBOOT_URI . '/assets/img/logo.png' .'" alt="" />';
		}
	}
}

/*
Register Fonts
*/
function corpboot_fonts_url() {
    $font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */

    if ( 'off' !== esc_html_x( 'on', 'Google font: on or off', 'corpboot' ) ) {
        $fonts = array(
            'Montserrat:400,700',
            'Work+Sans:400,300,500,600,700,800',
        );

        $font_url = add_query_arg( 'family',
            ( implode( '|', $fonts ) . "&subset=latin,latin-ext" ), "//fonts.googleapis.com/css" );
    }

    return $font_url;
}
/*
Enqueue scripts and styles.
*/
function corpboot_scripts() {
    wp_enqueue_style( 'corpboot-fonts', corpboot_fonts_url(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'corpboot_scripts' );

/**
 * Comments template
 **/
if ( ! function_exists( 'corpboot_comment' ) ) {
	function corpboot_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;

		switch ( $comment->comment_type ):
			case 'pingback':
			case 'trackback': ?>
				<div class="pingback">
					<?php esc_html_e( 'Pingback:', 'corpboot' ); ?> <?php comment_author_link(); ?>
					<?php edit_comment_link( esc_html__( '(Edit)', 'corpboot' ), '<span class="edit-link">', '</span>' ); ?>
				</div>
				<?php
				break;
			default: ?>
                <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                    <div class="media comment-block" id="comment-<?php comment_ID(); ?>">
                        <a class="avatar" href="#">
                            <?php echo get_avatar( $comment, 64,  '', '', array( 'class' => 'media-object' ) ); ?>
                        </a>
                        <div class="media-body">
                            <h5 class="media-heading"><?php comment_author(); ?>
                                <small><?php esc_html_e('Says','corpboot'); ?></small>
                            </h5>
                            <p class="small">
                                <a href="#">
                                    <i class="fa fa-calendar"></i>
                                    <span><?php comment_date( get_option('date_format') );?></span>
                                </a>
                            </p>
                            <p><?php comment_text(); ?></p>
                            <p class="text-right">
                                <?php comment_reply_link(
                                    array_merge( $args,
                                        array(
                                            'reply_text' => '<i class="fa fa-reply"></i>' . esc_html__( 'Reply', 'corpboot' ),
                                            'after' 	 => '',
                                            'depth' 	 => $depth,
                                            'max_depth'  => $args['max_depth']
                                        )
                                    )
                                ); ?>
                                <?php edit_comment_link( esc_html__( 'Edit', 'corpboot' ) ); ?>
                            </p>
                        </div>
                    </div>
                </li>
			<?php
			break;
		endswitch;
	}
}

/**
 * Return sidebar position.
 */
if ( ! function_exists( 'corpboot_sidebar_position' ) ) {
	function corpboot_sidebar_position( $key ) {
		global $corpboot_opt;
		if( ! isset( $corpboot_opt[$key] ) ) {
			return true;
		} else {
			return $corpboot_opt[$key];
		}
		return false;
	}
}

/**
 *
 * Breadcrumbs
 * @since 1.0.0
 * @version 1.0.0
 *
 **/

function corpboot_breadcrumbs( $enable_category = true, $root_title_sitename = true) {

	$separator = ' / '; // Simply change the separator to what ever you need e.g. / or >

	$crumbsLinks = '';
	if (!is_front_page()) {

        $crumbsLinks .= '<li><a href="' . esc_url(get_home_url()) . '">' . esc_html__('Home', 'corpboot') . '</a></li> ';
        if (is_home()) {
            $crumbsLinks .= '<li class="active">' . esc_html__('News & Event', 'corpboot') . ' ' . '<i class="fa fa-arrow-down ml5"></i></li>';
        }
        if (is_category()) {
            if ($enable_category) {
                $crumbsLinks .= '<li>' . get_the_category_list(', ') . ' <i class="fa fa-arrow-down ml5"></i></li> ';
            }
        } elseif ( is_tag() ) {
            $crumbsLinks .= '<li>' . get_the_tag_list('', ', ', '') . ' <i class="fa fa-arrow-down ml5"></i></li> ';
        } elseif ( is_author() ) {
            $curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
            $crumbsLinks .= '<li class="active">' . esc_html( $curauth->nickname ) . '</li>';
        } elseif ( is_singular('post') ) {
            if ($enable_category) {
                $crumbsLinks .= '<li class="active">' .  esc_html( get_the_title(isset( $post->ancestors[isset($i)]) ) ) . ' ' . '<i class="fa fa-arrow-down ml5"></i></li>';
            }
        } elseif ( is_singular('portfolio') ) {
            if ($enable_category) {
                $crumbsLinks .= '<li>' .  esc_html__( 'Portfolio', 'corpboot' ) . '</li>';
                $crumbsLinks .= '<li class="active">' .  esc_html( get_the_title(isset( $post->ancestors[isset($i)]) ) ) . '<i class="fa fa-arrow-down ml5"></i></li>';
            }
        } elseif ( is_page() && isset( $post->post_parent ) ) {
			$home = get_page(get_option('page_on_front'));
			for ($i = count($post->ancestors)-1; $i >= 0; $i--) {
				if (($home->ID) != ($post->ancestors[$i])) {
					$crumbsLinks .= '<li><a href="' . esc_url( get_permalink($post->ancestors[$i]) ) . '">' .  esc_html( get_the_title($post->ancestors[$i]) ) . '</a></li>' . esc_html($separator);
				}
			}
			$crumbsLinks .= esc_html( get_the_title() );
		} elseif (is_page()) {
			$crumbsLinks .= '<li class="active">' . esc_html( get_query_var('pagename') ) . ' ' . '<i class="fa fa-arrow-down ml5"></i></li> ';
		} elseif (is_404()) {
			$crumbsLinks .= '<li class="active">' . esc_html__('404 ERROR','corpboot') . ' ' . '<i class="fa fa-arrow-down ml5"></i></li>';
		}
	} else {
		$crumbsLinks .= esc_html( get_bloginfo('name') );
	}

	return wp_kses_post( $crumbsLinks );
}

/**
 *
 * Pagination first, last pages
 * @since 1.0.0
 * @version 1.0.0
 *
 **/

if( ! function_exists('corpboot_pagination_links') ) {
    function corpboot_pagination_links() {

        global $wp_query;
        $output = '';
        $current_page = $wp_query->get( 'paged' );
        $max_page = (int) $wp_query->max_num_pages;

        $args = array(
            'prev_text'    => esc_html__('', 'corpboot'),
            'next_text'    => esc_html__('', 'corpboot'),
        );

        if ( $paginate_links = paginate_links($args) ):
            $output .= '<ul class="pagination mt10">';
                if( $current_page != 0 ) {
                    $output .= '<a href="' . esc_url( get_pagenum_link(1) ) . '" class="first-page"> <i class="fa fa-angle-double-left small"></i></a>';
                }
                $output.= $paginate_links;
                if ( $wp_query->max_num_pages != get_query_var('paged') ) :
                    $output .= '<a href="' . esc_url( get_pagenum_link( $max_page ) )  . '" class="last-page"><i class="fa fa-angle-double-right small"></i> </a></a>';
                endif;
            $output .= '</ul>';
        endif;

        return wp_kses_post( $output );
    }
}

/**
 *
 * Add custom user field.
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'corpboot_show_extra_profile_fields' ) ) {
    function corpboot_show_extra_profile_fields( $user ) { ?>
        <h3><?php esc_attr_e( 'Social user', 'corpboot' ); ?></h3>
        <table class="form-table">
            <tr>
                <th><label for="facebook"><?php esc_attr_e( 'Facebook', 'corpboot' ); ?></label></th>
                <td>
                    <input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
                    <span class="description"><?php esc_html_e( 'Please enter your job facebook.', 'corpboot'); ?></span>
                </td>
            </tr>
            <tr>
                <th><label for="twitter"><?php esc_attr_e( 'Twitter', 'corpboot' ); ?></label></th>
                <td>
                    <input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
                    <span class="description"><?php esc_html_e( 'Please enter your job twitter.', 'corpboot'); ?></span>
                </td>
            </tr>
            <tr>
                <th><label for="gplus"><?php esc_attr_e( 'Google Plus', 'corpboot' ); ?></label></th>
                <td>
                    <input type="text" name="gplus" id="gplus" value="<?php echo esc_attr( get_the_author_meta( 'gplus', $user->ID ) ); ?>" class="regular-text" /><br />
                    <span class="description"><?php esc_html_e( 'Please enter your job gplus.', 'corpboot'); ?></span>
                </td>
            </tr>
            <tr>
                <th><label for="linkedin"><?php esc_attr_e( 'Linkedin', 'corpboot' ); ?></label></th>
                <td>
                    <input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" class="regular-text" /><br />
                    <span class="description"><?php esc_html_e( 'Please enter your job linkedin.', 'corpboot'); ?></span>
                </td>
            </tr>
        </table>
    <?php }
    add_action( 'show_user_profile', 'corpboot_show_extra_profile_fields' );
    add_action( 'edit_user_profile', 'corpboot_show_extra_profile_fields' );
}

/**
 *
 * Save custom user field.
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'corpboot_save_extra_profile_fields' ) ) {
    function corpboot_save_extra_profile_fields( $user_id ) {
        if ( ! current_user_can( 'edit_user', $user_id ) ) {
            return false;
        }
        /* Copy and paste this line for additional fields. Make sure to change 'facebook' to the field ID. */
        update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
        update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
        update_user_meta( $user_id, 'gplus', $_POST['gplus'] );
        update_user_meta( $user_id, 'linkedin', $_POST['linkedin'] );
    }
}
add_action( 'personal_options_update', 'corpboot_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'corpboot_save_extra_profile_fields' );



if( ! function_exists('corpboot_social_user') ) {
    function corpboot_social_user() {
        $output = '';
        $output .= '<ul class="list-inline socialstaff social-author">';
            if ( ! empty( get_the_author_meta('facebook') ) ) :
                $output .= '<li><a href="' . esc_url( get_the_author_meta('facebook') ) . '" target="_blank" title="' . esc_attr__('Facebook','corpboot') . '"><i class="fa fa-facebook-square"></i></a></li> ';
            endif;
            if ( ! empty( get_the_author_meta('twitter') ) ) :
                $output .= '<li><a href = "' . esc_url( get_the_author_meta( 'twitter' ) ) . '" target = "_blank" title = "' . esc_attr__('Twitter','corpboot') . '" ><i class="fa fa-twitter-square" ></i></a></li> ';
            endif;
            if ( ! empty( get_the_author_meta('gplus') ) ) :
                $output .= '<li><a href = "' . esc_url( get_the_author_meta( 'gplus' ) ) . '" target = "_blank" title = "' . esc_attr__('Google Plus','corpboot') . '" ><i class="fa fa-google-plus-square" ></i></a></li> ';
            endif;
            if ( ! empty( get_the_author_meta('linkedin') ) ) :
                $output .= '<li><a href = "' . esc_url( get_the_author_meta( 'linkedin' ) ) . '" target = "_blank" title = "' . esc_attr__('LinkedIn','corpboot') . '" ><i class="fa fa-linkedin-square" ></i></a></li>';
            endif;
        $output .= '</ul>';
        return wp_kses_post( $output );
    }
}