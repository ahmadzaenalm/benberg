<?php
/*
 * Blog Shortcode
 * Author: QodeArena
 * Author URI: https://themeforest.net/user/qodearena
 * Version: 1.0.0
 */

vc_map(
    array(
        'name'            => __( 'Blog', 'js_composer' ),
        'base'            => 'corpboot_blog',
        'description'     => __( 'Posts list', 'js_composer' ),
        'params'          => array(
            array(
                'type'        => 'vc_efa_chosen',
                'heading'     => __( 'Custom Categories', 'js_composer' ),
                'param_name'  => 'categories',
                'placeholder' => 'Choose category (optional)',
                'value'       => corpboot_param_values( 'categories' ),
                'std'         => '',
                'admin_label' => true,
                'description' => __( 'You can choose spesific categories for blog, default is all categories', 'js_composer' ),
            ),
            array(
                'type' 		  => 'dropdown',
                'heading' 	  => 'Order by',
                'param_name'  => 'orderby',
                'admin_label' => true,
                'value' 	  => array(
                    'ID' 		    => 'ID',
                    'Author' 	    => 'author',
                    'Post Title'    => 'title',
                    'Date' 		    => 'date',
                    'Last Modified' => 'modified',
                    'Random Order'  => 'rand',
                    'Menu Order'    => 'menu_order'
                )
            ),
            array(
                'type' 		  => 'dropdown',
                'heading' 	  => 'Order type',
                'param_name'  => 'order',
                'value' 	  => array(
                    'Ascending'  => 'ASC',
                    'Descending' => 'DESC'
                )
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Count items', 'js_composer' ),
                'param_name'  => 'limit',
                'value'       => '',
                'admin_label' => true,
                'description' => __( 'Default 10 items.', 'js_composer' )
            ),
            array(
                'type' 		  => 'textfield',
                'heading' 	  => __( 'Extra class name', 'js_composer' ),
                'param_name'  => 'el_class',
                'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
                'value' 	  => ''
            ),
            array(
                'type' 		  => 'css_editor',
                'heading' 	  => __( 'CSS box', 'js_composer' ),
                'param_name'  => 'css',
                'group' 	  => __( 'Design options', 'js_composer' )
            )
        )
    )
);

class WPBakeryShortCode_corpboot_blog extends WPBakeryShortCode{

    protected function content( $atts, $content = null ) {

        extract( shortcode_atts( array(
            'categories'   => '',
            'orderby' 	   => 'ID',
            'order' 	   => 'ASC',
            'limit' 	   => '',
            'el_class' 	   => '',
            'css' 		   => ''
        ), $atts ) );

        /* Custom styles */

        $class  	= ( ! empty( $el_class ) ) ? $el_class : '';
        $class 	   .= vc_shortcode_custom_css_class( $css, ' ' );

        /* FOR BLOG CONTENT */

        // get $categories
        if ( empty( $categories ) ){
            // get all category blog
            $categories = array();
            $terms = get_categories();
            foreach($terms as $term){
                $categories[] = $term->slug;
            }
        } else {
            $categories = explode( ',', $categories );
        }

        // params output
        $args = array(
            'posts_per_page' => $limit,
            'post_type'   	 => 'post',
            'orderby'   	 => $orderby,
            'order'   		 => $order,
            'tax_query' 	 => array(
                array(
                    'taxonomy'  => 'category',
                    'field'     => 'slug',
                    'terms'     => $categories
                )
            )
        );

        // get blog posts
        $post = new WP_Query( $args );

        // start output
        ob_start(); ?>
        <div class="slick-carousel" id="news">

            <?php while ( $post->have_posts() ) : $post->the_post();

                $terms = get_the_terms( $post->ID , 'category' );

                // add attribute item
                $post_slug_category = '';
                $post_item_attr 	= '';
                foreach ($terms as $term) {
                    $post_slug_category .= ' ' . $term->slug;
                    $post_item_attr 	.= ' ' . $term->slug;
                } ?>

                <div>
                    <article class="blognews">
                        <?php if( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>" class="mt5 mb15">
                                <div class="item-img-wrap">
                                    <?php the_post_thumbnail('full',array('class'=>'img-responsive')); ?>
                                    <div class="item-img-overlay">
                                        <div class="news">
                                            <span class="btn btn-transparent-sm"><i class="fa fa-plus"></i> <?php esc_html_e('Read more', 'corpboot' ); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php endif; ?>
                        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <p><?php the_excerpt(); ?></p>
                        <p class="author-list">
                            <i class="fa fa-calendar"></i>
                            <?php the_time( get_option('date_format') ); ?> <span>/</span>
                            <?php esc_html_e('BY', 'corpboot'); ?> <a href="<?php the_permalink(); ?>"><strong><?php the_author(); ?></strong></a> <span>/</span>
                            <a href="<?php the_permalink(); ?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="Read more" class="corp-tooltip"><i class="fa fa-plus-square"></i></a>
                        </p>
                    </article>
                </div>

            <?php  endwhile; wp_reset_postdata(); ?>

        </div>

        <?php return ob_get_clean();

    } // end function content


}
