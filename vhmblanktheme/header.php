<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php bloginfo('description'); ?>">

	<?php wp_head(); ?>
	<link type="text/css" rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" />
</head>
<body <?php body_class(); ?>>

	<!-- wrapper -->
	<div class="wrap-all container">
		
		<img class="img-responsive" src="<?php header_image(); ?>">
		
		<!-- header -->
		<header class="header" role="banner">
			<nav class="navbar navbar-default">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-menu">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				  <a class="navbar-brand" href="<?php echo site_url('/'); ?>"><?php bloginfo('name'); ?></a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="header-menu">
					
					<?php wp_nav_menu( array('theme_location' => 'header-menu', 'container' => '', 'items_wrap' => '<ul class="nav navbar-nav navbar-right">%3$s</ul>', 'fallback_cb' => 'wp_bootstrap_navwalker::fallback', 'walker' => new wp_bootstrap_navwalker()) ); ?>		  
					
				</div><!-- /.navbar-collapse -->
			</nav>
		</header>
		<!-- /header -->
		
		<div class="row">
			<div class="col-md-8">