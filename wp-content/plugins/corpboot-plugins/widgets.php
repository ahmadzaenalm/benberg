<?php

/**
 * Latest posts.
 */
class Latest_Posts_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'latest_posts',
			esc_html__( 'Latest posts', 'corpboot' ),
			array( 'description' => esc_html__( 'Get latest posts', 'corpboot' ), )
		);
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['count_posts'] = strip_tags( $new_instance['count_posts'] );
		return $instance;
	}
	public function form( $instance ) {
		$instance['title'] = ( isset( $instance['title'] ) && ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$instance['count_posts'] = ( isset( $instance['count_posts'] ) && ! empty( $instance['count_posts'] ) ) ? $instance['count_posts'] : '';
		?>
		<p>
			<label for="<?php print $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'corpboot' ); ?></label>
			<input class="widefat" id="<?php print $this->get_field_id( 'title' ); ?>"
				name="<?php print $this->get_field_name( 'title' ); ?>" type="text"
				value="<?php print $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php print $this->get_field_id( 'count_posts' ); ?>"><?php esc_html_e( 'Count posts', 'corpboot' ); ?></label>
			<input class="widefat" id="<?php print $this->get_field_id( 'count_posts' ); ?>"
				name="<?php print $this->get_field_name( 'count_posts' ); ?>" type="text"
				value="<?php print $instance['count_posts']; ?>" />
		</p>
		<?php
	}

	public function widget( $args, $instance ) {

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$count_posts = ( ! empty( $instance['count_posts'] ) && is_numeric( $instance['count_posts'] ) ) ? $instance['count_posts'] : 2;

		print $args['before_widget'];
		if ( $title ) {
			print $args['before_title'] . $title . $args['after_title'];
		}

		$posts = get_posts( array( 'numberposts' => $count_posts ) );
		if ( $posts ) {
			if ( ! file_exists( EF_ROOT . '/aq_resizer.php' ) ) {
				print "<p>" . esc_html__( 'Plaese activate required plugins', 'corpboot' ) . ".</p>";
			} else {
				require_once EF_ROOT . '/aq_resizer.php';
				$output  = '<div class="wpc-latest-post">';
				$output .= '<ul>';
				foreach ( $posts as $post ) {
					$img_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );

					$output .= '<li>';
					$output .= ( ! empty( $img_url ) ) ? '<a class="img" href="' . get_permalink( $post->ID ) . '"><img src="' . aq_resize( $img_url, 136, 136, true, true, true ) . '" alt=""></a>' : '';
					$output .= ( ! empty( $img_url ) ) ? '<div class="content">' : '<div>';
					$output .= '<a href="' . get_permalink( $post->ID ) . '" class="link">' . $post->post_title . '</a>';
					$output .= '<div class="post-info-content">';
					$output .= '<span class="post-date">' . get_the_time( get_option('date_format'), $post->ID ) . '</span>';
					$output .= '</div>';
					$output .= '</div>';
					$output .= '</li>';
				}
				$output .= '</ul>';
				$output .= '</div>';
			}

			print $output;
		}

		print $args['after_widget'];
	}
}

add_action( 'widgets_init', function() {
	register_widget( 'Latest_Posts_Widget' );
});

/**
 * Info Widget.
 */
class Corpboot_Info_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'Corpboot_Info_Widget',
            esc_html__( 'Info widget', 'corpboot' ),
            array( 'classname' => 'info_widget','description' => esc_html__( 'Displays image box with text', 'corpboot' ), )
        );
    }

    function widget( $args, $instance ) {
        // Widget output
        extract($args, EXTR_SKIP);

        $title = empty($instance['title']) ? ''  : apply_filters('widget_title', $instance['title']);
        $form_text = ( ! empty( $instance['form_text'] ) ) ? $instance['form_text'] : '';

        $title_ps = empty($instance['title_ps']) ? ''  : apply_filters('widget_title_ps', $instance['title_ps']);
        $title_lt = empty($instance['title_lt']) ? ''  : apply_filters('widget_title_lt', $instance['title_lt']);
        $title_tl = empty($instance['title_tl']) ? ''  : apply_filters('widget_title_tl', $instance['title_tl']);

        $lt = ( ! empty( $instance['lt'] ) ) ? $instance['lt'] : '';
        $tl = ( ! empty( $instance['tl'] ) ) ? $instance['tl'] : '';

        $title_skype = ( ! empty( $instance['title_skype'] ) ) ? $instance['title_skype'] : '';

        echo $args['before_widget'];
        if ( $title ) {
            print $args['before_title'] . $title . $args['after_title'];
        }

        $output = '';

        $output .= ( ! empty( $form_text ) ) ? '<p>' . $form_text . '</p>' : '';
        $output .= '<ul class="list-unstyled">';
        $output .= ( ! empty( $title_ps ) ) ? '<li><i class="fa fa-map-marker"></i> ' . $title_ps . '</li>' : '';
        $output .= ( ! empty( $tl ) ) ? '<li><a href="tel:' . esc_url( $tl ) . '"><i class="fa fa-phone"></i> ' . $title_tl . '</a></li>' : '';
        $output .= ( ! empty( $lt ) ) ? '<li><a href="mailto:' . esc_url( $lt ) . '"><i class="fa fa-envelope"></i> ' . $title_lt . '</a></li>' : '';
        $output .= ( ! empty( $title_skype ) ) ? '<li><i class="fa fa-skype"></i> ' . $title_skype . '</li>' : '';
        $output .= '</ul>';
        $output .= '<div class="visible-xs-block visible-sm-block pt20"></div>';

        echo $output;

        echo $args['after_widget'];
    }

    function update( $new_instance, $old_instance ) {
        // Save widget options
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['form_text'] = $new_instance['form_text'];

        $instance['title_ps'] = $new_instance['title_ps'];
        $instance['title_lt'] = $new_instance['title_lt'];
        $instance['title_tl'] = $new_instance['title_tl'];

        $instance['lt'] = $new_instance['lt'];
        $instance['tl'] = $new_instance['tl'];

        $instance['title_skype'] = $new_instance['title_skype'];
        return $instance;
    }

    function form( $instance ) {
        // Output admin widget options form
        $instance = wp_parse_args( (array) $instance, array(
                'title' => '',
                'form_text' => '',
                'title_ps' => '',
                'title_lt' => '',
                'title_tl' => '',
                'lt' => '',
                'tl' => '',
                'title_skype' => '',
            )
        );
        $title = $instance['title'];
        $form_text = $instance['form_text'];

        $title_ps = $instance['title_ps'];
        $title_lt = $instance['title_lt'];
        $title_tl = $instance['title_tl'];

        $lt = $instance['lt'];
        $tl = $instance['tl'];

        $title_skype = $instance['title_skype'];

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:','corpboot'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('form_text'); ?>">
                <?php esc_html_e( 'Text:','corpboot'); ?>
                <textarea class="widefat" id="<?php echo $this->get_field_id('form_text'); ?>"
                          name="<?php echo $this->get_field_name('form_text'); ?>"><?php echo esc_attr($form_text); ?></textarea>
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('title_ps'); ?>">
                <?php esc_html_e( 'Location:','corpboot'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('title_ps'); ?>"
                       name="<?php echo $this->get_field_name('title_ps'); ?>"
                       type="text" value="<?php echo esc_attr($title_ps); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('tl'); ?>">
                <?php esc_html_e( 'Tel url:','corpboot'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('tl'); ?>"
                       name="<?php echo $this->get_field_name('tl'); ?>"
                       type="text" value="<?php echo esc_attr($tl); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('title_tl'); ?>"><?php esc_html_e( 'Title Tel:','corpboot'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('title_tl'); ?>" name="<?php echo $this->get_field_name('title_tl'); ?>" type="text" value="<?php echo esc_attr($title_tl); ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('lt'); ?>">
                <?php esc_html_e( 'Letter url:','corpboot'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('lt'); ?>"
                       name="<?php echo $this->get_field_name('lt'); ?>"
                       type="text" value="<?php echo esc_attr($lt); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('title_lt'); ?>"><?php esc_html_e( 'Title Letter:','corpboot'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('title_lt'); ?>" name="<?php echo $this->get_field_name('title_lt'); ?>" type="text" value="<?php echo esc_attr($title_lt); ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('title_skype'); ?>"><?php esc_html_e( 'Title Skype:','corpboot'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('title_skype'); ?>" name="<?php echo $this->get_field_name('title_skype'); ?>" type="text" value="<?php echo esc_attr($title_skype); ?>" /></label>
        </p>
        <?php
    }
}

add_action( 'widgets_init', function() {
    register_widget( 'Corpboot_Info_Widget' );
});

/**
 * Newsletter Widget.
 */
class Corpboot_Newsletter_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'Corpboot_Newsletter_Widget',
            esc_html__( 'Newsletter widget', 'corpboot' ),
            array( 'classname' => 'newsletter_widget','description' => esc_html__( 'Displays image box with text', 'corpboot' ), )
        );
    }

    function widget( $args, $instance ) {
        // Widget output
        extract($args, EXTR_SKIP);

        $title = empty($instance['title']) ? ''  : apply_filters('widget_title', $instance['title']);
        $form_text = ( ! empty( $instance['form_text'] ) ) ? $instance['form_text'] : '';
        $mailchimp_shortcode = ( ! empty( $instance['mailchimp_shortcode'] ) ) ? $instance['mailchimp_shortcode'] : '';
        $info_title = ( ! empty( $instance['info_title'] ) ) ? $instance['info_title'] : '';

        echo $args['before_widget'];
        if ( $title ) {
            print $args['before_title'] . $title . $args['after_title'];
        }

        $output = '';

        $output .= ( ! empty( $form_text ) ) ? '<p>' . $form_text . '</p>' : '';
        $output .= ( ! empty( $mailchimp_shortcode ) ) ?  do_shortcode( $mailchimp_shortcode ) : '';
        $output .= ( ! empty( $info_title ) ) ? '<p class="newsletter-desc"> ' . $info_title . '</p>' : '';

        echo $output;

        echo $args['after_widget'];
    }

    function update( $new_instance, $old_instance ) {
        // Save widget options
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['form_text'] = $new_instance['form_text'];
        $instance['mailchimp_shortcode'] = $new_instance['mailchimp_shortcode'];
        $instance['info_title'] = $new_instance['info_title'];

        return $instance;
    }

    function form( $instance ) {
        // Output admin widget options form
        $instance = wp_parse_args( (array) $instance, array(
                'title' => '',
                'form_text' => '',
                'mailchimp_shortcode' => '',
                'info_title' => '',
            )
        );
        $title = $instance['title'];
        $form_text = $instance['form_text'];
        $mailchimp_shortcode = $instance['mailchimp_shortcode'];
        $info_title = $instance['info_title'];

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:','corpboot'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('form_text'); ?>">
                <?php esc_html_e( 'Text:','corpboot'); ?>
                <textarea class="widefat" id="<?php echo $this->get_field_id('form_text'); ?>" name="<?php echo $this->get_field_name('form_text'); ?>"><?php echo esc_attr($form_text); ?></textarea>
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('mailchimp_shortcode'); ?>">
                <?php esc_html_e( 'Mailchimp shortcode:','corpboot'); ?>
                <textarea class="widefat" id="<?php echo $this->get_field_id('mailchimp_shortcode'); ?>" name="<?php echo $this->get_field_name('mailchimp_shortcode'); ?>"><?php echo esc_attr($mailchimp_shortcode); ?></textarea>
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('info_title'); ?>"><?php esc_html_e( 'Information title:','corpboot'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('info_title'); ?>" name="<?php echo $this->get_field_name('info_title'); ?>" type="text" value="<?php echo esc_attr($info_title); ?>" /></label>
        </p>
        <?php
    }
}

add_action( 'widgets_init', function() {
    register_widget( 'Corpboot_Newsletter_Widget' );
});

/**
 * Gallery Widget.
 */
class Corpboot_Gallery_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'Corpboot_Gallery_Widget',
            esc_html__( 'Gallery widget', 'corpboot' ),
            array( 'classname' => 'gallery_widget','description' => esc_html__( 'Displays image box with text', 'corpboot' ), )
        );
    }

    function widget( $args, $instance ) {
        // Widget output
        extract($args, EXTR_SKIP);

        $title = empty($instance['title']) ? ''  : apply_filters('widget_title', $instance['title']);
        $gallery = empty( $instance['gallery'] ) ? '' : $instance['gallery'];

        echo $args['before_widget'];
        if ( $title ) {
            print $args['before_title'] . $title . $args['after_title'];
        }

        $output = '';

        $values = explode( ',', $gallery );

        foreach ( $values as $id ) {
            $attachment_image = wp_get_attachment_image_url( $id, 'full' );
            $output .= '<a href="' . esc_url( $attachment_image ) . '" class="gallery"><img src="' . esc_url( $attachment_image ) . '" alt="" /></a>';
        }

        $output .= '<div class="visible-xs-block visible-sm-block pt20"></div>';

        echo $output;

        echo $args['after_widget'];
    }

    function update( $new_instance, $old_instance ) {
        // Save widget options
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['gallery'] = $new_instance['gallery'];

        return $instance;
    }

    function form( $instance ) {
        // Output admin widget options form
        $instance = wp_parse_args( (array) $instance, array(
                'title' => '',
                'gallery' => '',
            )
        );
        $title = $instance['title'];
        $gallery = $instance['gallery'];

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:','corpboot'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label>
        </p>
        
        <?php
            $hidden = ( empty( $this->get_field_id('gallery') ) ) ? ' hidden' : '';
        ?>

        <div class="corpboot-field-images">
            <ul>

            <?php if( ! empty( $this->get_field_id('gallery') ) ) {

              $values = explode( ',', $gallery );
              foreach ( $values as $id ) {
                $attachment_image = wp_get_attachment_image_url( $id, 'thumbnail' ); ?>
                <li><img src="<?php echo esc_url( $attachment_image ); ?>" alt="" /></li>
              <?php }

            } ?>

            </ul>
            <a href="#" class="button button-primary fl-add"><?php esc_html_e( 'Add Gallery', 'corpboot' ); ?></a>
            <a href="#" class="button fl-edit<?php echo esc_attr( $hidden ); ?>"><?php esc_html_e( 'Edit Gallery', 'corpboot'); ?></a>
            <a href="#" class="button fl-warning-primary fl-remove<?php echo esc_attr( $hidden ); ?>"><?php esc_html_e( 'Clear', 'corpboot'); ?></a>
            <input type="hidden" name="<?php echo esc_attr( $this->get_field_name('gallery') ); ?>" value="<?php echo esc_attr( $gallery ); ?>" />
        </div>

        <?php wp_enqueue_style( 'menu-item-item', CORPBOOT_URI . '/assets/css/widget-gallery.css' ); ?>
        
        <?php
    }
}

add_action( 'widgets_init', function() {
    register_widget( 'Corpboot_Gallery_Widget' );
});