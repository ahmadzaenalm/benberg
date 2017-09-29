<?php
/*
 * Portfolio Shortcode
 * Author: QodeArena
 * Author URI: https://themeforest.net/user/qodearena
 * Version: 1.0.0
 */

vc_map( array(
    'name'            => __( 'Portfolio', 'js_composer' ),
    'base'            => 'corpboot_portfolio',
    'description'     => __( 'Portfolio list', 'js_composer' ),
    'params'          => array(
        array(
            'type'        => 'vc_efa_chosen',
            'heading'     => __( 'Custom Categories', 'js_composer' ),
            'param_name'  => 'categories',
            'placeholder' => 'Choose category (optional)',
            'value'       => corpboot_param_values( 'terms' ),
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
            'type' 		  => 'dropdown',
            'heading' 	  => 'Style Portfolio',
            'param_name'  => 'style_portfolio',
            'admin_label' => true,
            'value' 	  => array(
                'Link Detail' 	 => 'link_detail',
                'Popup Image' 	 => 'popup_image',
                'Popup Content'  => 'popup_content',
            )
        ),

        /* Filter settings */
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Filter', 'js_composer' ),
            'param_name'  => 'filter_style',
            'value'       => array(
                'Hidden'  	=> 'hidden',
                'Show'  	=> 'show'
            ),
            'group' 	  => 'Filter settings'
        ),
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Align', 'js_composer' ),
            'param_name'  => 'filter_align',
            'value'       => array(
                'Center'  	=> 'center',
                'Left'  	=> 'left',
                'Right'  	=> 'right'
            ),
            'dependency'  => array( 'element' => 'filter_style', 'value' => 'show' ),
            'group' 	  => 'Filter settings'
        ),
    )
));




class WPBakeryShortCode_corpboot_portfolio extends WPBakeryShortCode{

    protected function content( $atts, $content = null ) {

        extract( shortcode_atts( array(
            'categories' 			  => '',
            'orderby' 				  => 'ID',
            'order' 				  => 'ASC',
            'limit' 				  => '',
            'style_portfolio' 		  => 'link_detail',
            'filter_style' 			  => 'hidden',
            'filter_align' 			  => 'center'
        ), $atts ) );


        /* FOR PORTFOLIO  FILTERS */
        $limit = ( ! empty( $limit ) && is_numeric( $limit ) ) ? $limit : 10;

        // add filter align
        $filter_styles = ' text-' . $filter_align;

        /* FOR PORTFOLIO  CONTENT */

        // get $categories
        if ( empty($categories) ){
            // get all category potfolio
            $categories = array();
            $terms = get_terms('portfolio-category', 'orderby=name&hide_empty=0');
            foreach($terms as $term){
                $categories[] = $term->slug;
            }
        } else {
            $categories = explode( ',', $categories );
        }

        // params output
        $args = array(
            'posts_per_page' => $limit,
            'post_type'   	 => 'portfolio',
            'orderby'   	 => $orderby,
            'order'   		 => $order,
            'tax_query' 	 => array(
                array(
                    'taxonomy'  => 'portfolio-category',
                    'field'     => 'slug',
                    'terms'     => $categories
                )
            )
        );

        // get portfolio posts
        $portfolio = new WP_Query( $args );

        // start output
        ob_start(); ?>

        <section id="portfolio-section">
            <div class="container">
                <div class="row">

                    <!-- Portfolio filter -->
                    <?php if( $filter_style != 'hidden' ) { ?>
                        <div class="col-md-12 text-center">
                            <ul class="portfolio-filters list-inline <?php echo esc_attr( $filter_styles ); ?>" id="filters">
                                <li class="filter active" data-filter="all"><?php echo esc_html__('All', 'corpboot' ); ?></li>
                                <?php foreach ( $categories as $category_slug ) {
                                    $category = get_term_by('slug', $category_slug, 'portfolio-category'); ?>
                                    <li class="filter" data-filter="<?php echo esc_html( $category->slug ); ?>"><?php echo esc_html( $category->name ); ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>

                    <div class="col-md-12">

                        <div id="grid" class="portfolio-wrap row text-center">

                            <?php while ( $portfolio->have_posts() ) : $portfolio->the_post();
                                setup_postdata( $portfolio );

                                $terms = get_the_terms( $portfolio->ID , 'portfolio-category' );
                                // add attribute item
                                $post_slug_category = array();
                                $post_item_attr = '';
                                $post_item_category = '';

                                $terms_key = array_keys( $terms );
                                $last_key = end( $terms_key );
                                foreach ($terms as $key => $term) {
                                    $post_slug_category[] = $term->name;
                                    $post_item_attr .= $term->slug . ' ';
                                    if( $key == $last_key ) {
                                        $post_item_category .= $term->slug;
                                    } else {
                                        $post_item_category .= $term->slug . ' / ';
                                    }
                                }

                                // Style portfolio
                                $style_portfolio_type = '';

                                if( isset( $style_portfolio ) && $style_portfolio == 'popup_image' ) {
                                    $style_portfolio_type = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
                                } elseif( isset( $style_portfolio ) && $style_portfolio == 'popup_content' ) {
                                    $style_portfolio_type = admin_url("admin-ajax.php") . '?action=trest&id=' . get_the_ID();
                                } else {
                                    $style_portfolio_type = get_the_permalink();
                                }

                                // Style popup class
                                $style_popup_class = '';
                                if( isset( $style_portfolio ) && $style_portfolio == 'popup_image' ) {
                                    $style_popup_class = 'class=lightbox';
                                } elseif( isset( $style_portfolio ) && $style_portfolio == 'popup_content' ) {
                                    $style_popup_class = 'class=webpage';
                                } else {
                                    $style_popup_class = '';
                                }

                                ?>

                                <div class="col-sm-4 mix <?php echo esc_html( $post_item_attr ); ?>">
                                    <a <?php echo esc_html( $style_popup_class ); ?> title="<?php the_title(); ?>" href="<?php echo $style_portfolio_type; ?>">
                                        <div class="item-img-wrap s-back-switch">
                                            <?php the_post_thumbnail('full', array('class'=>'s-img-switch')); ?>
                                            <div class="item-img-overlay">
                                                <div>
                                                    <i class="fa fa-eye"></i>
                                                    <h5><?php the_title(); ?><br><small><?php echo esc_html( $post_item_category ); ?></small></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                            <?php  endwhile; wp_reset_postdata(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php return ob_get_clean();

    } // end function content

}