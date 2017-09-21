<?php
/**
 * Page
 *
 * @package corpboot
 * @since 1.0.0
 *
 */

global $corpboot_opt;

get_header(); ?>

<?php while ( have_posts() ):
the_post();
$content = get_the_content();

if ( ! strpos( $content, 'vc_' ) ): ?>

    <!-- Page breadcrumbs -->
    <div class="breadcrumb-container">
        <div class="container text-right">
            <ol class="breadcrumb">
                <?php echo corpboot_breadcrumbs(); ?>
            </ol>
        </div>
    </div>

    <section class="bg-white">
        <div class="container">
            <div id="content" class="row">
                <div id="main" class="col-md-12" role="main">
                    <article>
                        <header>

                            <!-- Image banner -->
                            <?php if( has_post_thumbnail() ) : ?>
                                <div class="post-thumbnail s-back-switch">
                                    <?php the_post_thumbnail('full', array('class'=>'s-img-switch')); ?>
                                </div>
                            <?php endif; ?>

                            <!-- Content page -->
                            <?php the_title('<h2 class="entry-title">','</h2>'); ?>
                            <p class="author-list">

                                <!-- Date -->
                                <i class="fa fa-calendar"></i> <?php the_time( get_option('date_format') ); ?> <span>/</span>

                                <!-- Author -->
                                <?php esc_html_e('BY','corpboot'); ?> <strong><?php the_author_posts_link(); ?></strong>

                                <!-- Categories -->
                                <?php  if( has_category() ) : ?> <span>/</span> <?php esc_html_e('IN','corpboot'); ?> <strong><?php the_category(', '); ?></strong><?php endif;

                                // Count comments
                                $comment_list = get_comments_number( get_the_id() );
                                if( $comment_list > 0  ) : ?>
                                    <span>/</span>
                                    <?php echo esc_html( $post->comment_count ); ?> <a href="<?php the_permalink(); ?>"><strong><?php esc_html_e( ' Comments', 'corpboot' ); ?></strong></a>
                                <?php endif; ?>
                            </p>
                        </header>
                        <div class="post_content"><?php the_content(); ?></div>

                        <!-- Post tags -->
                        <?php if( has_tag() ) : ?>
                            <footer class="row entry-meta">
                                <div class="col-md-10">
                                    <p class="tags-links">
                                        <?php the_tags('',' ',''); ?>
                                    </p>
                                </div>
                                <div class="col-md-2">
                                    <p class="text-right" id="edit-post">
                                        <?php edit_post_link( esc_html__( 'Edit', 'corpboot' ), '<span class="btn-edit m0"><i class="fa fa-edit"></i>', '</span>' ); ?>
                                    </p>
                                </div>
                            </footer>
                        <?php endif; ?>

                        <?php wp_link_pages(); ?>

                    </article>

                    <!-- Comments form -->
                    <?php if ( comments_open() || get_comments_number() ):
                        comments_template( '', true );
                    endif; ?>

                </div>

            </div>
        </div>
    </section>
<?php else: ?>
    <div class="container">
        <?php the_content(); ?>
    </div>
<?php endif; ?>

<?php endwhile; ?>

<?php get_footer(); ?>
