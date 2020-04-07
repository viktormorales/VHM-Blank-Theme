<?php
/** Theme Support */
if (!isset($content_width))
{
    $content_width = 1170;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Custom Header
    add_theme_support( 'custom-header' );

    // Add Custom Logo
    add_theme_support( 'custom-logo' );

    // Add Custom Background
    add_theme_support( 'custom-background' );

    // Add HTML5
    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

    // Responsive embeds
    add_theme_support( 'responsive-embeds' );

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 800, '', true); // Large Thumbnail
    add_image_size('medium', 650, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

	// Support TITLE TAG
	add_theme_support( 'title-tag' );

    // Localization Support
	define('VHMTHEME_TEXTDOMAIN', 'vhmtheme');
    load_theme_textdomain(VHMTHEME_TEXTDOMAIN, get_template_directory() . '/languages');
}

/** Register Nav Walker */
add_action( 'after_setup_theme', 'register_navwalker' );
function register_navwalker(){
	require_once get_template_directory() . '/incs/class-wp-bootstrap-navwalker.php';
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

/** Load frontend scripts */
 add_action( 'wp_enqueue_scripts', 'frontend_scripts' );
 function frontend_scripts() 
 {
    wp_enqueue_script('jquery');
	/* Popper & Bootstrap */
	wp_enqueue_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js', false, false, true);
	wp_enqueue_script('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', false, false, true);

	/* Font Awesome */
	wp_enqueue_script('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js');
	wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css');

	/* on single blog post pages with comments open and threaded comments */
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' ); 
    }

	/* Scripts */
	wp_enqueue_script('scripts', get_template_directory_uri() . '/js/scripts.js', false, false, true);
	wp_localize_script( 'scripts', 'scripts_var', array(
			'site_url' => site_url(),
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'template_url' => get_template_directory_uri(),
			'nonce' => wp_create_nonce( 'ajax-nonce' )
		)
	);
 }
