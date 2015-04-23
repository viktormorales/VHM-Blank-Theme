<?php
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die(__('Do not load this page directly. Thanks!', basename(__DIR__)));
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 id="comments">
			<i class="icon-comments-alt icon-large"></i>&nbsp; 
			<?php comments_number(__('No Comments', basename(__DIR__)), __('1 Comment', basenamme__DIR__), __('% Comments', basename(__DIR__)) ); ?> <a class="btn btn-success pull-right" href="#respond"><?php _e('Comment', basename(__DIR__)); ?></a>
		</h2>
		
		<ul class="media-list">
		<?php
			wp_list_comments( array('callback' => 'custom_comments' ) );
		?>
		</ul>
		
		<?php
		// Are there comments to navigate through?
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
			<div class="navigation">
				<div class="alignleft"><?php previous_comments_link() ?></div>
				<div class="alignright"><?php next_comments_link() ?></div>
			</div>
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
		'class_submit' => 'btn btn-info'
	);
	comment_form($comments_args);
	?>

</div><!-- .comments-area -->
