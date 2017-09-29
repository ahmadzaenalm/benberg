<?php
/**
 * Footer template.
 *
 * @package benbergarome
 * @since 1.0.0
 *
 */

global $corpboot_opt;

$footer = true;
if ( is_page() ) {
    $meta_data = get_post_meta( get_the_ID(), 'corpboot_page_options', true );
    if ( isset( $meta_data['page_footer'] ) && $meta_data['page_footer'] === false ) {
        $footer = false;
    }
}

if ( $footer ) : ?>

    <!-- Footer Site -->
    <footer>

        <!-- Footer sidebar -->
        <?php if( is_active_sidebar('footer-sidebar') ) : ?>
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <?php dynamic_sidebar('footer-sidebar'); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Footer content -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row">

                   

                    <!-- Footer copyright -->
                    <?php if ( ! empty( $corpboot_opt['footer_copyright'] ) ) { ?>
                        <div class="col-sm-6 credits">
                            <p><?php echo wp_kses_post( $corpboot_opt['footer_copyright'] ); ?></p>
                        </div>
                    <?php } else { ?>
                        <div class="col-sm-6 credits">
                            <p><?php esc_html_e('Made with love by QodeArena', 'corpboot'); ?></p>
                        </div>
                    <?php } ?>
                     <!-- Footer social icons -->
                    <?php corpboot_get_social(); ?>

                </div>
            </div>
        </div>

        <!-- Button top scroll -->
        <?php if ( isset( $corpboot_opt['page_scroll_up'] ) && $corpboot_opt['page_scroll_up'] ) : ?>
            <a href="#" id="scrollToTop" class="scrollToTop"><i class="fa fa-angle-up"></i></a>
        <?php endif; ?>

    </footer>

<?php endif;

wp_footer(); ?>
</body>
</html>
