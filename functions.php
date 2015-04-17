<?php

/** Defines the textdomain */
define('TEXTDOMAIN', 'vhmThemes');

/** External resources */
require(dirname(__FILE__) . '/libs/wp-bootstrap-navwalker.php');
require(dirname(__FILE__) . '/libs/functions.class.php');
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
    load_theme_textdomain(TEXTDOMAIN, get_template_directory() . '/languages');
}

/** Register menus */
 add_action( 'init', 'register_menus' );
 function register_menus() {
	register_nav_menus(
		array(
			'header-menu' => __( 'Header Menu', TEXTDOMAIN )
		)
	);
 }

/** Register sidebar */
if ( function_exists('register_sidebar') )
{
	register_sidebar( array( 
		'name' => __('Right sidebar', TEXTDOMAIN)
	));
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
        'clear' => __( 'Clear' ),
        'defaultString' => __( 'Default' ),
        'pick' => __( 'Select Color' )
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
