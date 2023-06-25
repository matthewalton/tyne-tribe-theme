<?php
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">Comments</h2>

		<ul class="list-unstyled">
			<?php
			wp_list_comments( array(
				'style'       => 'ul',
				'short_ping'  => true,
				'avatar_size' => 74,
			) );
			?>
		</ul><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav class="navigation comment-navigation" role="navigation">

				<h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', TYNE_TRIBE_DOMAIN); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', TYNE_TRIBE_DOMAIN ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', TYNE_TRIBE_DOMAIN) ); ?></div>
			</nav><!-- .comment-navigation -->
		<?php endif; // Check for comment navigation ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
			<p class="no-comments"><?php _e( 'Comments are closed.', TYNE_TRIBE_DOMAIN ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Leave a comment
    </button>

</div><!-- #comments -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Leave a Comment</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
	            <?php
	            $comments_args = array(
		            'title_reply'          => '',
		            'label_submit'  => esc_html__( 'Submit', TYNE_TRIBE_DOMAIN ),
		            'class_submit' => 'btn btn-secondary w-lg-auto w-100',
		            'comment_field' => sprintf(
			            '<p class="comment-form-comment my-4"><label class="form-label">%s *</label><textarea class="form-control" name="comment" cols="45" rows="6" aria-required="true" required></textarea></p>',
			            esc_html__('Your Answer', TYNE_TRIBE_DOMAIN)
		            )
	            );

	            comment_form( $comments_args );
	            ?>
            </div>
        </div>
    </div>
</div>

