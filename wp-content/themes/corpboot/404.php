<?php
/**
 * 404 Page template.
 *
 * @package corpboot
 * @since 1.0.0
 *
 */

global $corpboot_opt;

get_header(); ?>

<!-- Breadcrumb -->
<?php if( isset( $corpboot_opt['show_breadcrumb_404'] ) && $corpboot_opt['show_breadcrumb_404'] == true ) : ?>
    <div class="breadcrumb-container">
        <div class="container text-right">
            <ol class="breadcrumb">
                <?php echo corpboot_breadcrumbs(); ?>
            </ol>
        </div>
    </div>
<?php endif; ?>

<section class="row bg-white">
    <div class="container">
        <div class="row">

            <p class="text-center color4">
                <span class="fa-stack fa-5x mb15">
                    <i class="fa fa-file-o fa-stack-2x"></i>
                    <strong class="fa-stack-1x fa-stack-text file-text fs404"><?php esc_html_e('404','corpboot'); ?></strong>
                </span>
            </p>

            <!-- Error title -->
            <?php echo ( ! empty( $corpboot_opt['error_title'] ) ? '<h3 class="text-center text-uppercase color5">' . esc_html( $corpboot_opt['error_title'] ) . '</h3>' : '<h3 class="text-center text-uppercase color5">' . esc_html__('OOPS, Page Not Found', 'corpboot') )  . '</h3>'; ?>

            <!-- Error subtitle -->
            <?php echo ( ! empty( $corpboot_opt['error_content'] ) ? '<p class="text-center">' . esc_html( $corpboot_opt['error_content'] ) . '</p>' : '<p class="text-center">' . esc_html__('Looks like something went completely wrong!', 'corpboot') ) . '</p>'; ?>

            <!-- Error links -->
            <div class="text-center">
                <p><br>
                    <a class="btn btn-primary-corp" href="<?php echo esc_url( home_url( '/' ) ); ?>"><i class="fa fa-home le"></i> <?php esc_html_e('Home','corpboot'); ?></a>
                    <?php if( isset( $corpboot_opt['error_link'] ) && $corpboot_opt['error_link'] ) {
                        $link = $corpboot_opt['error_link'];

                        if( ! empty( $link['error_link_url'] ) && ! empty( $link['error_link_title'] ) ) : ?>
                            <a class="btn btn-primary-corp" href="<?php echo esc_url( $link['error_link_url'] ); ?>"><i class="fa fa-envelope le"></i> <?php echo esc_html( $link['error_link_title'] ); ?></a>
                        <?php endif;
                    } ?>
                </p>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
