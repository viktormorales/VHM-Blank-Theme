<?php

/** Bootstrap 4 navigation style */
require(dirname(__FILE__) . '/wp-bootstrap-navwalker.php');
/** Bootstrap 4 comment style */
require(dirname(__FILE__) . '/wp-bootstrap-comment-walker.php');
/** Load the class for the theme customizer */
 require(dirname(__FILE__) . '/theme-customizer.php');

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
	/* Popper & Bootstrap */
	wp_enqueue_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js', false, false, true);
	wp_enqueue_script('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', false, false, true);
	wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css', false, false);

	/* Font Awesome */
	wp_enqueue_script('fontawesome', 'https://use.fontawesome.com/releases/v5.0.8/js/all.js');
	wp_enqueue_style('fontawesome', 'https://use.fontawesome.com/releases/v5.0.8/css/all.css');

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
