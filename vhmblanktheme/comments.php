<?php
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', basename(__DIR__) ),
					number_format_i18n( get_comments_number() ), get_the_title() );
			?>
		</h2>
		
		<ul class="list-unstyled">
			<?php
				wp_list_comments( array( 'callback' => 'custom_comments' ) );
			?>
		</ul><!-- .comment-list -->

		
		<?php
		// Are there comments to navigate through?
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<nav class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php _e( 'Comment navigation', basename(__DIR__) ); ?></h2>
			<div class="nav-links">
				<?php
					if ( $prev_link = get_previous_comments_link( __( 'Older Comments', basename(__DIR__) ) ) ) :
						printf( '<div class="nav-previous">%s</div>', $prev_link );
					endif;

					if ( $next_link = get_next_comments_link( __( 'Newer Comments', basename(__DIR__) ) ) ) :
						printf( '<div class="nav-next">%s</div>', $next_link );
					endif;
				?>
			</div><!-- .nav-links -->
		</nav><!-- .comment-navigation -->
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', basename(__DIR__) ); ?></p>
	<?php endif; ?>

	<?php 
	$fields =  array(
	  'author' =>
		'<div class="form-group"><label for="author">' . __( 'Name', basename(__DIR__) ) . '</label> ' .
		( $req ? '<span class="required">*</span>' : '' ) .
		'<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
		'" size="30"' . $aria_req . ' /></div>',

	  'email' =>
		'<div class="form-group"><label for="email">' . __( 'Email', basename(__DIR__) ) . '</label> ' .
		( $req ? '<span class="required">*</span>' : '' ) .
		'<input id="email" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
		'"' . $aria_req . '></div>',

	  'url' =>
		'<div class="form-group"><label for="url">' . __( 'Website', basename(__DIR__) ) . '</label>' .
		'<input id="url" class="form-control" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
		'"></div>',
	);
	$comments_args = array(
		// change the title of the reply section
		'title_reply' => __( 'Write a reply or comment', basename(__DIR__) ) ,
		// remove "Text or HTML to be displayed after the set of comment fields"
		'comment_notes_after' => '',
		// redefine your own textarea (the comment body)
		'comment_field' => '<div class="form-group"><label for="comment">' . __( 'Comment', basename(__DIR__) ) . '</label><textarea id="comment" class="form-control" name="comment" aria-required="true"></textarea></div>',
		'fields' => $fields,
		'class_submit' => 'btn btn-default'
	);
	comment_form($comments_args);
	?>

</div><!-- .comments-area -->
