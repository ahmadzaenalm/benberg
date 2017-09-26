<?php
/**
 * Single Portfolio
 *
 * @package benbergarome
 * @since 1.0.0
 *
 */

global $corpboot_opt;

$meta_data = get_post_meta( get_the_ID(), 'corpboot_portfolio_options', true );

get_header(); ?>

<div class="breadcrumb-container">
    <div class="container text-right">
        <ol class="breadcrumb">
            <?php echo corpboot_breadcrumbs(); ?>
        </ol>
    </div>
</div>

<?php while ( have_posts() ): the_post(); ?>

    <section id="portfolio-section" class="bg-white">
        <div class="container">
            <div class="row">

                <!-- Image -->
                <div class="col-sm-6">
                    <p class="text-center"><?php the_post_thumbnail( 'full', array('class'=>'img-responsive') ); ?></p>
                    <p><a href="<?php echo esc_url( $meta_data['link_project'] ); ?>" target="_blank" class="btn btn-primary-corp mt10"><i class="fa fa-external-link le"></i><?php echo esc_html( $meta_data['title_link_project'] ); ?></a></p>
                    <div class="visible-xs-block visible-sm-block pt20"></div>
                </div>

                <!-- Description -->
                <div class="col-sm-6">
                    <h4 class="color5 m0 text-uppercase wow fadeInLeft"><?php the_title(); ?></h4>
                    <h5 class="wow fadeInLeft" data-wow-delay="120ms"><?php the_author(); ?></h5>
                    <p><?php the_content(); ?></p>

                    <!-- Title lsit portfolio -->
                    <?php if( ! empty( $meta_data['title_list_portfolio'] ) ) { ?>
                        <h5 class="color5 m0 pb10 wow fadeInLeft"><?php echo esc_html( $meta_data['title_list_portfolio'] ); ?></h5>
                    <?php } ?>

                    <!-- Portfolio list -->
                    <?php if( ! empty( $meta_data['list_portfolio'] ) ) : ?>
                        <ul class="listicon-check">
                            <?php
                            foreach ( $meta_data['list_portfolio'] as $item_list ) { ?>
                                <li><?php echo esc_html( $item_list['title_list'] ); ?></li>
                            <?php } ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<?php endwhile; ?>

<?php get_footer(); ?>
