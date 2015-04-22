<?php

/** Load the class to implement the Bootstrap 3 navigation style */
require(dirname(__FILE__) . '/libs/wp-bootstrap-navwalker.php');
/** Load the class for the theme settings */
require(dirname(__FILE__) . '/libs/theme.settings.php');

/** Theme Support */
if (!isset($content_width))
{
    $content_width = 1170;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 600, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail

    // Add Support for Custom Backgrounds
    add_theme_support('custom-background', array(
		'default-color' => 'eee',
		'default-image' => get_template_directory_uri() . '/img/default-background.png'
    ));
	
    // Add Support for Custom Header
    add_theme_support('custom-header', array(
		'default-text-color' => '000',
		'default-image' => get_template_directory_uri() . '/img/default-header.jpg',
    ));
	
    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');
	
	add_theme_support( 'title-tag' );
	
    // Localisation Support
    load_theme_textdomain(basename(__DIR__), get_template_directory() . '/languages');
}

/** Register menus */
 add_action( 'init', 'register_menus' );
 function register_menus() {
	register_nav_menus(
		array(
			'header-menu' => __( 'Header Menu', basename(__DIR__) )
		)
	);
 }
 
/** Register sidebar */
add_action( 'widgets_init', 'custom_widgets_init' );
function custom_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Righ Sidebar', basename(__DIR__) ),
        'id' => 'main-right-sidebar',
        'description' => __( 'Widgets in this area will be shown on all posts and pages.', basename(__DIR__) ),
    ) );
}

/** Removes the "Category:" string from the title */
add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>' ;
	}
    return $title;
});

/** Template for listing the comments */
function custom_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', basename(__DIR__)); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', basename(__DIR__)), '<span class="edit-link">', '</span>' ); ?></p>
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
					printf( __( '%1$s <br /> %2$s', basename(__DIR__)),
						sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
						sprintf( '<a href="%1$s"><time pubdate datetime="%2$s"><small>%3$s</small></time></a>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							get_comment_time( 'c' ),
							/* translators: 1: date, 2: time */
							sprintf( __( '%1$s at %2$s', basename(__DIR__)), get_comment_date(), get_comment_time() )
						)
					);
				?>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', basename(__DIR__)); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-content"><?php comment_text(); ?></div>

				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', basename(__DIR__)), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
		</div>
	
		<?php
		break;
	endswitch;
 }

/** Load frontend scripts */
 add_action( 'wp_enqueue_scripts', 'frontend_scripts' );
 function frontend_scripts() 
 {
	// jQuery & UI
	wp_enqueue_script('jquery');
	
	// Font Awesome
	wp_enqueue_style('fontawesome', get_template_directory_uri() . '/sources/fontawesome/css/font-awesome.min.css');
	
	// Bootstrap
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/sources/bootstrap/js/bootstrap.min.js', false, false);
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/sources/bootstrap/css/bootstrap.min.css');
	
	// Normalize
	wp_enqueue_style('normalize', get_template_directory_uri() . '/normalize.min.css');
	
	// Scripts
	wp_enqueue_script('scripts', get_template_directory_uri() . '/js/scripts.js', false, false);
	wp_localize_script( 'scripts', 'scripts_var', array(
			'site_url' => site_url(),
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce( 'ajax-nonce' )
		)
	);
 }
 
/** Load backend scripts */
 add_action( 'admin_enqueue_scripts', 'backend_scripts' );
 function backend_scripts() {
	// Color picker
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script(
        'iris',
        admin_url( 'js/iris.min.js' ),
        array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ),
        false,
        1
    );
    wp_enqueue_script(
        'wp-color-picker',
        admin_url( 'js/color-picker.min.js' ),
        array( 'iris' ),
        false,
        1
    );
    $colorpicker_l10n = array(
        'clear' => __( 'Clear', basename(__DIR__) ),
        'defaultString' => __( 'Default', basename(__DIR__) ),
        'pick' => __( 'Select Color', basename(__DIR__) )
    );
    wp_localize_script( 'wp-color-picker', 'wpColorPickerL10n', $colorpicker_l10n ); 
	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/admin_scripts.js', array( 'wp-color-picker' ), false, true );
	wp_localize_script( 'scripts', 'scripts_var', array(
			'site_url' => site_url(),
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce( 'ajax-nonce' )
		)
	);
 }
