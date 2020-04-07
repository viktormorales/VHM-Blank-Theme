<?php
/**
 * A custom WordPress comment walker class to implement the Bootstrap 4 Media object in wordpress comment list.
 *
 * @package     WP Bootstrap 4 Comment Walker
 * @version     1.0.0
 * @author      Aymene Bourafai <bourafai.a@gmail.com> <www.aymenebourafai.com>
 * @license     http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link        https://github.com/bourafai/wp-bootstrap-4-comment-walker
 * @link        https://v4-alpha.getbootstrap.com/layout/media-object/
 */

class Bootstrap_Comment_Walker extends Walker_Comment {
	/**
	 * Output a comment in the HTML5 format.
	 *
	 * @since 1.0.0
	 *
	 * @see wp_list_comments()
	 *
	 * @param object $comment the comments list.
	 * @param int    $depth   Depth of comments.
	 * @param array  $args    An array of arguments.
	 */
	protected function html5_comment( $comment, $depth, $args ) {
		$tag = ( $args['style'] === 'div' ) ? 'div' : 'li';
?>		
		<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'has-children media' : ' media' ); ?>>
			
			<?php if ( $args['avatar_size'] != 0  ): ?>
			<a href="<?php echo get_comment_author_url(); ?>">
				<?php echo get_avatar( $comment, $args['avatar_size'],'mm','', array('class'=>"mr-3") ); ?>
			</a>
			<?php endif; ?>

			<div class="media-body" id="div-comment-<?php comment_ID(); ?>">
				<a class="hidden-xs-down" href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">
					<time class="small" datetime="<?php comment_time( 'c' ); ?>">
						<?php comment_date() ?>,
						<?php comment_time() ?>
					</time> 
				</a>
				<?php edit_comment_link( __( 'Edit' ), '(<span class="edit-link small">', '</span>)' ); ?>

				<h5 class="mt-0 mb-1"><?php echo get_comment_author_link() ?></h5>

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="card-text comment-awaiting-moderation label label-info text-muted small"><?php _e( 'Your comment is awaiting moderation.' ); ?></p>
				<?php endif; ?>

				<div class="comment-content card-text">
					<?php comment_text(); ?>
				</div><!-- .comment-content -->
				
				
				<?php
					comment_reply_link( array_merge( $args, array(
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
						'before'    => '<p class="reply-link mb-3">',
						'after'     => '</p>'
					) ) );	
				?>
			<!-- </div> -->
		<!-- </div>		 -->
<?php
	}	
}