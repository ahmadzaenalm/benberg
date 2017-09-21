<?php
/**
 * Header template.
 *
 * @package corpboot
 * @since 1.0.0
 *
 */

global $corpboot_opt;

// Favicon icon
$favicon_icon = ( ! empty( $corpboot_opt['favicon_icon'] ) ) ? $corpboot_opt['favicon_icon'] : CORPBOOT_URI  . '/assets/img/favicon.png';

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <?php if ( ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) ) { ?>
            <link rel="shortcut icon" href="<?php echo esc_attr( $favicon_icon ); ?>"/>
        <?php } ?>
        <?php wp_head(); ?>
  </head>
<body <?php body_class(); ?>>

	<!-- PRELOADER -->
	<?php if ( isset( $corpboot_opt['page_preloader'] ) && $corpboot_opt['page_preloader'] ): ?>
        <div id="preloader">
            <div class="cssload-container">
                <div class="cssload-double-torus"></div>
            </div>
        </div>
	<?php endif; ?>
    
    <!-- Nav Menu -->
    <div class="nav-top-one">
     <div class="navbar2">
           
        <div class="container">  
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <ul style="display: inline-block;">
                        <li style="display: inline-block;"><i class="fa fa-phone"></i> +1234 5676 8765</li>
                        <li style="display: inline-block;"> <i class="fa fa-envelope"></i> admin@benberg.com</li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <ul class="header-top" style="float: right;">
                        <li class="fa fa-facebook"></li>
                        <li class="fa fa-twitter"></li>
                        <li class="fa fa-google-plus"></li>
                        <li class="fa fa-instagram"></li>
                    </ul>
                </div>

            </div>
        </div>
    </div> 
    <!-- Nav Menu -->
    <div class="navbar navbar-default  navbar-fixed-top" role="navigation">
         
        <div class="container">
            <div class="navbar-header">

                <!-- Button Menu -->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only"><?php esc_html_e('Toggle navigation', 'corpboot'); ?></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Logo header -->
                <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php corpboot_logo(); ?>
                </a>

            </div>
            <div class="navbar-collapse collapse">

                <!-- Navigation header -->
                <?php corpboot_custom_menu(); ?>

            </div>
        </div>
    </div>
</div>
