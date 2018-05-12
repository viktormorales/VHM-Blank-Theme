<?php
class theme_Customize
{
	
	public static function register( $wp_customize )
	{
		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
		$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

	/**
	 * COLORS SECTION
	 *
	 */
		$wp_customize->add_setting('bootswatch_theme', array(
			'transport' => 'postMessage'
		));
		$wp_customize->add_control('bootswatch_theme_control', array(
			'label' => __('Bootstrap theme', VHMTHEME_TEXTDOMAIN),
			'description' => __('Choose the Bootstrap theme by Bootswatch', VHMTHEME_TEXTDOMAIN),
			'section' => 'colors',
			'settings' => 'bootswatch_theme',
			'type' => 'select',
			'choices' => array(
				'cerulean' => 'Cerulean',
				'cosmo' => 'Cosmo',
				'cyborg' => 'Cyborg',
				'darky' => 'Darky',
				'flatly' => 'Flatly',
				'journal' => 'Journal',
				'litera' => 'Litera',
				'lumen' => 'Lumen',
				'lux' => 'Lux',
				'materia' => 'Materia',
				'minty' => 'Minty',
				'pulse' => 'Pulse',
				'sandstone' => 'Sandstone',
				'simplex' => 'Simplex',
				'sketchy' => 'Skecthy',
				'slate' => 'Slate',
				'solar' => 'Solar',
				'spacelab' => 'Spacelab',
				'superhero' => 'Superhero',
				'united' => 'United',
				'yeti' => 'Yeti'
			)
		));

		// Menu background color
		$wp_customize->add_setting('menu_background_color', array(
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'menu_background_color_control', array(
			'label'    => __('Menu background color', VHMTHEME_TEXTDOMAIN),
			'section'  => 'colors',
			'settings' => 'menu_background_color',
		)));

		// Menu link text color
		$wp_customize->add_setting('menu_text_color', array(
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'menu_text_color_control', array(
			'label'    => __('Menu text color', VHMTHEME_TEXTDOMAIN),
			'section'  => 'colors',
			'settings' => 'menu_text_color',
		)));

		// Theme color (for android chrome)
		$wp_customize->add_setting('android_theme_color', array(
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'android_theme_color_control', array(
			'label'    => __('Android theme color', VHMTHEME_TEXTDOMAIN),
			'section'  => 'colors',
			'settings' => 'android_theme_color',
		)));
		
		// Header background color
		$wp_customize->add_setting('header_background_color', array(
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'header_background_color_control', array(
			'label'    => __('Header background color', VHMTHEME_TEXTDOMAIN),
			'section'  => 'colors',
			'settings' => 'header_background_color',
		)));

		// Footer background color
		$wp_customize->add_setting('footer_background_color', array(
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_background_color_control', array(
			'label'    => __('Footer background color', VHMTHEME_TEXTDOMAIN),
			'section'  => 'colors',
			'settings' => 'footer_background_color',
		)));
		
	/**
	 * BACKGROUND IMAGE SECTION
	 */
		// Footer background image
		$wp_customize->add_setting('footer_background_image', array(
			'default' => ''
		));
		$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'footer_background_image_control', array(
			'label'    => __('Footer background image', VHMTHEME_TEXTDOMAIN),
			'section'  => 'background_image',
			'settings' => 'footer_background_image',
		)));
		
	}
	
	public function wp_head()
	{
		echo '<style type="text/css">';
		echo 'header { background-color: ' . get_theme_mod('header_background_color') . ';}';
		echo 'nav.primary-menu, nav.primary-menu ul.dropdown-menu, nav.primary-menu .modalnav { background-color: ' . get_theme_mod('menu_background_color') . ' !important; }';
		echo 'nav.primary-menu a { color: ' . get_theme_mod('menu_text_color') . '; }';
		echo 'footer {';
		echo 'background-color: ' . get_theme_mod('footer_background_color') . ';';
		echo 'background-image: url(' . get_theme_mod('footer_background_image') . ');background-size: cover;';
		echo '}';
		echo '</style>';
	}

	public static function live_preview()
	{
		wp_enqueue_script('theme-customizer',get_template_directory_uri() . '/js/theme-customizer.js',array( 'jquery','customize-preview' ), mktime(), true );
	}

	/** Load frontend scripts */
	function frontend_scripts()
	{
		$bootswatch = get_theme_mod('bootswatch_theme');
		if ($bootswatch) {
			wp_enqueue_style('bootstrap-theme', 'https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/' . $bootswatch . '/bootstrap.min.css', array('bootstrap'));
		}
	}
}
add_action('customize_register', array('theme_Customize', 'register') );
add_action('wp_head', array('theme_Customize', 'wp_head') );
add_action('customize_preview_init', array('theme_Customize', 'live_preview') );
add_action('wp_enqueue_scripts', array('theme_Customize', 'frontend_scripts') );