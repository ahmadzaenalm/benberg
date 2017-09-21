<?php
/**
 * Single Page
 *
 * @package corpboot
 * @since 1.0.0
 *
 */

global $corpboot_opt;

// Sidebar post
$sidebar   = corpboot_sidebar_position( 'post_sidebar' );
$sidebar = is_bool($sidebar) ? 'right' : $sidebar;
$post_size = ( $sidebar != 'disable' ) ? 'col-md-8' : 'col-md-12';

$post_class =  ( isset( $corpboot_opt['blog_banner'] ) && $corpboot_opt['blog_banner'] ) ? '' : 'not-empty-header';

get_header(); ?>

<!-- Blog breadcrumbs -->
<?php if ( isset( $corpboot_opt['show_blog_breadcrumb'] ) && $corpboot_opt['show_blog_breadcrumb'] ) : ?>
    <div class="breadcrumb-container">
        <div class="tambah-padding">`</div>
        <div class="container text-right">
            <ol class="breadcrumb">
                <?php echo corpboot_breadcrumbs(); ?>
            </ol>
        </div>
    </div>
<?php endif; ?>

<?php while ( have_posts() ): the_post(); ?>
<section class="bg-white <?php echo esc_html( $post_class ); ?>">
    <div class="container">
        <div id="content" class="row">

            <!-- Banner title -->
            <?php if ( isset( $corpboot_opt['post_banner'] ) && $corpboot_opt['post_banner'] ) :
                $post_class = 'empty-header';
                if ( ! empty( $corpboot_opt['post_banner_title'] ) ) : ?>
                    <div class="col-md-12">
                        <div class="title">
                            <h2> News & Event <?php //echo esc_html( $corpboot_opt['post_banner_title'] ); ?></h2>
                        </div>
                    </div>
                <?php endif;
            endif; ?>

            <!-- Left Sidebar -->
            <?php if ( is_active_sidebar('sidebar') && $sidebar == 'left' ): ?>
                <aside class="col-md-4 sidebar sidebar-left">
                    <?php dynamic_sidebar('sidebar'); ?>
                </aside>
            <?php endif; ?>

            <div id="main" class="<?php echo esc_attr( $post_size ); ?>" role="main">

                <article>
                    <header>

                        <?php if( has_post_thumbnail() ) : ?>
                            <div class="post-thumbnail s-back-switch">
                                <?php the_post_thumbnail('full', array('class'=>'s-img-switch')); ?>
                            </div>
                        <?php endif; ?>
                        <?php the_title('<h2 class="entry-title">','</h2>'); ?>
                        <p class="author-list">

                            <!-- Date -->
                            <i class="fa fa-calendar"></i> <?php the_time( get_option('date_format') ); ?> <span>/</span>

                            <!-- Author -->
                            <?php esc_html_e('BY','corpboot'); ?> <strong><?php the_author_posts_link(); ?></strong>

                            <!-- Categories -->
                            <?php if( has_category() ) : ?> <span>/</span> <?php esc_html_e('IN','corpboot'); ?> <strong><?php the_category(', '); ?></strong><?php endif;

                            // Count comments
                            $comment_list = get_comments_number( get_the_id() );
                            if( $comment_list > 0  ) : ?>
                                <span>/</span>
                                <?php echo esc_html( $post->comment_count ); ?> <a href="<?php the_permalink(); ?>"><strong><?php esc_html_e( ' Comments', 'corpboot' ); ?></strong></a>
                            <?php endif; ?>
                        </p>
                    </header>
                    <div class="post_content"><?php the_content(); ?></div>

                    <?php wp_link_pages(); ?>

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

                    <!-- Author bio -->
                    <div class="media author-bio">
                        <a class="avatar" href="<?php echo get_author_posts_url(get_post()->post_author); ?>">
                            <?php echo get_avatar( $post->post_author, 64,  '', '', array( 'class' => 'media-object' ) ); ?>
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php the_author(); ?></h4>
                            <?php if ( get_the_author_meta('description') ) : ?>
                                <p><?php echo get_the_author_meta('description'); ?></p>
                            <?php endif ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <?php echo corpboot_social_user(); ?>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-right">
                                        <a class="view-all" href="<?php echo get_author_posts_url(get_post()->post_author); ?>" rel="author"><i class="fa fa-angle-right"></i> <?php esc_html_e('View all posts by','corpboot'); ?> <?php the_author(); ?></a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>

                <?php if( isset( $corpboot_opt['post_navigation'] ) && $corpboot_opt['post_navigation'] ) : ?>
                    <!-- Pagination -->
                    <ul class="pagination mt10">
                        <?php
                            $prev_post = get_previous_post();
                            $next_post = get_next_post();
                        ?>
                        <a href="<?php echo esc_url( $prev_post->guid ); ?>"><i class="fa fa-angle-left small"></i>&nbsp; <?php esc_html_e('Previous post','corpboot'); ?></a>
                        <a href="<?php echo esc_url( $next_post->guid ); ?>"><?php esc_html_e('Next post','corpboot'); ?> <i class="fa fa-angle-right small"></i></a>
                    </ul>
                <?php endif; ?>

                <!-- Comments form -->
                <?php if ( comments_open() || get_comments_number() ):
                    comments_template( '', true );
                endif; ?>

            </div>

            <!-- Sidebar post -->
            <?php if ( is_active_sidebar('sidebar') && $sidebar == 'right' && $sidebar !== 'left' ): ?>
                <aside class="col-md-4 sidebar sidebar-right">
                    <?php dynamic_sidebar('sidebar'); ?>
                </aside>
            <?php endif; ?>

        </div>
    </div>
</section>
<?php endwhile; ?>

<?php get_footer(); ?>
