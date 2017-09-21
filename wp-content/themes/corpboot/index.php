<?php
/**
 * The main template file.
 *
 * @package corpboot
 * @since 1.0.0
 *
 */

global $corpboot_opt;

// Sidebar position
$sidebar      = corpboot_sidebar_position( 'blog_sidebar' );
$sidebar_type = is_bool($sidebar) ? 'right' : $sidebar;
$blog_class   = ( $sidebar_type != 'disable' ) ? 'col-md-8' : 'col-md-12';

$post_class =  ( isset( $corpboot_opt['show_blog_breadcrumb'] ) && $corpboot_opt['show_blog_breadcrumb'] ) ? '' : 'not-empty-header';

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

<section class="bg-white <?php echo esc_html( $post_class ); ?>">
    <div class="container">
        <div id="content" class="row">

            <!-- Banner title -->
            <?php if ( isset( $corpboot_opt['blog_banner'] ) && $corpboot_opt['blog_banner'] ) :
                if ( ! empty( $corpboot_opt['blog_banner_title'] ) ) : ?>
                    <div class="col-md-12">
                        <div class="title">
                            <h2>News & Event <?php //echo esc_html( $corpboot_opt['blog_banner_title'] ); ?></h2>
                        </div>
                    </div>
                <?php endif;
            endif; ?>

            <!-- Left Sidebar -->
            <?php if ( is_active_sidebar('sidebar') && $sidebar_type == 'left' ): ?>
                <aside class="col-md-4 sidebar sidebar-left">
                    <?php dynamic_sidebar('sidebar'); ?>
                </aside>
            <?php endif; ?>

            <!-- Posts list -->
            <div id="main" class="<?php echo esc_attr( $blog_class ); ?>" role="main">

                <?php if ( have_posts() ): ?>
                    <?php while ( have_posts() ): the_post(); ?>

                        <!-- Blog Item -->
                        <article <?php post_class(); ?>>
                            <header>

                                <!-- Post image -->
                                <?php if( has_post_thumbnail() ) : ?>
                                    <div class="post-thumbnail s-back-switch">
                                        <?php the_post_thumbnail('full', array('class'=>'s-img-switch')); ?>
                                    </div>
                                <?php endif; ?>

                                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <p class="author-list">

                                    <!-- Date -->
                                    <i class="fa fa-calendar"></i><a href="<?php the_permalink(); ?>"><?php the_time( get_option('date_format') ); ?></a> <span>/</span>

                                    <!-- Author -->
                                    <?php esc_html_e('BY','corpboot'); ?> <strong><?php the_author_posts_link(); ?></strong>

                                    <!-- Categories -->
                                    <?php  if( has_category() ) : ?> <span>/</span> <?php esc_html_e('IN','corpboot'); ?> <strong><?php the_category(', '); ?></strong><?php endif; ?>

                                    <!-- Comments -->
                                    <?php
                                    $comment_list = get_comments_number( get_the_id() );
                                    if( $comment_list > 0  ) : ?>
                                        <span>/</span>
                                        <?php echo esc_html( $post->comment_count ); ?> <a href="<?php the_permalink(); ?>"><strong><?php esc_html_e( ' Comments', 'corpboot' ); ?></strong></a>
                                    <?php endif; ?>
                                </p>
                            </header>
                            <div class="post_content">
                                <p><?php the_excerpt(); ?></p>
                                <a href="<?php the_permalink(); ?>" class="btn btn-primary-corp"><i class="fa fa-plus"></i> <?php esc_html_e('READ MORE', 'corpboot'); ?></a>
                            </div>
                        </article>
                        <hr>

                    <?php endwhile; ?>

                    <!-- Pagination Blog -->
                    <?php echo corpboot_pagination_links(); ?>

                <?php else: ?>
                    <div id="corpboot-empty-result">
                        <p><?php esc_html_e('Sorry, no posts matched your criteria.', 'corpboot' ); ?></p>
                        <?php get_search_form( true ); ?>
                    </div>
                <?php endif; ?>

                <div class="visible-xs-block visible-sm-block pt20"></div>
            </div>

            <!-- Right Sidebar -->
            <?php if ( is_active_sidebar('sidebar') && $sidebar_type == 'right' && $sidebar_type !== 'left' ): ?>
                <aside class="col-md-4 sidebar sidebar-right">
                    <?php dynamic_sidebar('sidebar'); ?>
                </aside>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
