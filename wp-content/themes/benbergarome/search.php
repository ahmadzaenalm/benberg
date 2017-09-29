<?php
/**
 * Search Page
 *
 * @package benbergarome
 * @since 1.0.0
 *
 */

get_header(); ?>

    <div class="breadcrumb-container">
        <div class="container text-center padd-50">
            <p class="info-search"><?php printf( esc_html__( 'Search Results for: %s', 'corpboot' ), get_search_query() ); ?></p>
            <?php get_search_form(); ?>
        </div>
    </div>

    <section class="bg-white">
        <div class="container">
            <div id="content" class="row">
                <div id="main" class="col-md-12" role="main">

                    <?php if ( have_posts() ) : ?>

                        <?php while ( have_posts() ) : the_post(); ?>

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

                        <?php endwhile;

                    else : ?>

                        <header class="no-result">
                            <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'corpboot'); ?></p>
                        </header>

                    <?php endif; ?>

                </div>

            </div>
        </div>
    </section>

<?php get_footer();