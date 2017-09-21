<?php
/**
 * Comment template
 *
 * @package corpboot
 * @since 1.0.0
 *
 */

if ( post_password_required() ) { return; } ?>

<div class="comments">
    <?php // Comment list
    $comment_list = get_comments_number( get_the_id() );
    if( $comment_list > 0 ) : ?>
        <h5 class="comments-title">
            <i class="fa fa-comments"></i> <?php echo esc_html( $comment_list ); ?> <?php esc_html_e( 'comments on', 'corpboot' ); ?> <span class="color4"><?php the_title(); ?></span>
        </h5>
        <div class="corpboot-comments-list" id="comments">
            <ol><?php wp_list_comments( array( 'callback' => 'corpboot_comment' ) ); ?></ol>

            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
                <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
                    <div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'corpboot' ) ); ?></div>
                    <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'corpboot' ) ); ?></div>
                </nav>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<div class="row">
    <div class="col-md-12 mt10">

        <?php

        add_filter('comment_form_fields', 'corpboot_reorder_comment_fields' );
        function corpboot_reorder_comment_fields( $fields ){

            $new_fields = array();

            $myorder = array('author','email','website');

            foreach( $myorder as $key ){
                $new_fields[ $key ] = $fields[ $key ];
                unset( $fields[ $key ] );
            }

            if( $fields )
                foreach( $fields as $key => $val )
                    $new_fields[ $key ] = $val;

            return $new_fields;
        }

        comment_form(
            array(
                'id_form'              => 'corpboot-comment-form',
                'fields'               => array(
                    'author'            => '<div class="row"><div class="col-sm-12 col-md-4"><div class="form-group"><label class="sr-only" for="author">' . esc_html__('Name', 'corpboot') . '<br></label><div class="inner-addon left-addon"><i class="fa fa-user"></i><input type="text" class="form-control required" placeholder="' . esc_html__('Name', 'corpboot') . '" name="author" id="name" data-name="Name" required></div></div></div>',
                    'email'             => '<div class="col-sm-12 col-md-4"><div class="form-group"><label class="sr-only" for="email">' . esc_html__('Email', 'corpboot') . '<br></label><div class="inner-addon left-addon"><i class="fa fa-envelope"></i><input type="email" class="form-control required required-email" placeholder="' . esc_html__('Email', 'corpboot') . '" name="email" id="email" data-name="Email" required></div></div></div>',
                    'website'           => '<div class="col-sm-12 col-md-4"><div class="form-group"><label class="sr-only" for="website">' . esc_html__('Website', 'corpboot') . '<br></label><div class="inner-addon left-addon"><i class="fa fa-link"></i><input type="text" class="form-control required" placeholder="' . esc_html__('Website', 'corpboot') . '" name="website" id="website" data-name="Website"></div></div></div></div>',
                ),
                'comment_field'        => '<div class="row"><div class="col-sm-12"><div class="form-group"><label class="sr-only" for="comment">' . esc_html__('Comment', 'corpboot') . '<br></label><div class="inner-addon left-addon"><i class="fa fa-comment"></i><textarea rows="11" name="comment" id="message" class="form-control required" placeholder="' . esc_html__('Comment', 'corpboot') . '" data-name="Comment"></textarea></div></div></div></div>',
                'must_log_in'          => '',
                'logged_in_as'         => '',
                'comment_notes_before' => '',
                'comment_notes_after'  => '',
                'title_reply'          => 'Leave a Reply',
                'title_reply_to'       => esc_html__('Leave a Reply to %s', 'corpboot' ),
                'cancel_reply_link'    => esc_html__('Cancel', 'corpboot' ),
                'label_submit'         => esc_html__('Send Comment', 'corpboot' ),
                'submit_button'        => '<div class="row actions"><div class="col-sm-12 col-md-6"><button name="%1$s" type="submit" id="%2$s" class="btn btn-default btn-primary-corp-big" value="%4$s">' . esc_html__('&#xf1d9; &nbsp;Post Comment','corpboot') . '</button></div></div>',
                'submit_field'         => '%1$s %2$s',
            )
        ); ?>

    </div>
</div>