<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="<?php echo get_theme_mod('android_theme_color'); ?>">
	<link type="text/css" rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" />
	<?php 
		wp_head(); 
		if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
	?>
</head>
<body <?php body_class(); ?>>
	<!-- header -->
	<header class="header" role="banner">
			<nav class="navbar navbar-expand-lg">
				<div class="container">
					<a class="navbar-brand text-light" href="<?php echo site_url('/'); ?>"><?php bloginfo('name'); ?></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<?php wp_nav_menu( array('theme_location' => 'header-menu', 'depth' => 3, 'container' => '', 'items_wrap' => '<ul class="nav navbar-nav navbar-right">%3$s</ul>', 'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback', 'walker' => new WP_Bootstrap_Navwalker()) ); ?>
					</div>
				</div>
			</nav>
	</header>
	<!-- /header -->