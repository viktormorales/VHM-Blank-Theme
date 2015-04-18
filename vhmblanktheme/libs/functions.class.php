<?php

function the_timthumb($args=false)
{
	$function = new Custom_Functions;
	$function->the_timthumb($args);
}

function custom_comments($comments, $args, $depth)
{
	$function = new Custom_Functions;
	return $function->custom_comments($comments, $args, $depth);
}

class Custom_Functions
{
	private $w;
	private $h;
	
	public function the_timthumb($args=false)
	{
		global $post;
		
		$w = 800;
		$h = 600;
		
		if ($args)
			extract($args);
		
		if (has_post_thumbnail())
		{
			$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
			if ($large_image_url)
				echo '<img src="' . get_bloginfo('template_url') . '/timthumb.php?src=' . $large_image_url[0] . '&w=' . $w .'&h=' . $h . '" class="img-responsive">';
			else
				echo '<img src="http://placehold.it/' . $w . 'x' . $h . '&text=No+Image+:(" class="img-responsive">';
		} else {
			echo '<img src="http://placehold.it/' . $w . 'x' . $h . '/&text=No+Image+:(" class="img-responsive">';
		}
	}
	
	/** Modifies the comments list */
	public function custom_comments( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
		<li class="post pingback">
			<p><?php _e( 'Pingback:'); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit'), '<span class="edit-link">', '</span>' ); ?></p>
		<?php
			break;
			default :
		?>
		<li <?php comment_class('media'); ?> id="comment-<?php comment_ID(); ?>">
			<a class="pull-left" href="#">
				<?php
					$avatar_size = 48;
					if ( '0' != $comment->comment_parent )
						$avatar_size = 48;
					
					echo get_avatar( $comment, $avatar_size );
				?>
			</a>
			<div class="media-body">
					<?php
						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s <br /> %2$s', TEXTDOMAIN),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s"><small>%3$s</small></time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', TEXTDOMAIN), get_comment_date(), get_comment_time() )
							)
						);
					?>
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.'); ?></em>
						<br />
					<?php endif; ?>

					<div class="comment-content"><?php comment_text(); ?></div>

					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', TEXTDOMAIN), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div><!-- .reply -->
			</div>
		
			<?php
			break;
		endswitch;
	}
}