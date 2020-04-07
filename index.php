<?php get_header(); ?>
	
	<div class="row">
		<div class="col-md-8">
			<div id="home" class="content-area">
				<?php if ( have_posts() ) : ?>

					<?php if ( is_home() && ! is_front_page() ) : ?>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					<?php endif; ?>

					<?php
					// Start the loop.
					while ( have_posts() ) : the_post();

						/*
						* Include the Post-Format-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Format name) and that will be used instead.
						*/
						get_template_part( 'loop', get_post_format() );

					// End the loop.
					endwhile;

					// Previous/next page navigation.
					the_posts_pagination();

				// If no content, include the "No posts found" template.
				else :
					get_template_part( 'content', 'none' );

				endif;
				?>

				</main><!-- .site-main -->
			</div><!-- .content-area -->
		</div>
		<div class="col-md-4">
			<?php if ( is_active_sidebar( 'main-right-sidebar' ) ) { ?>
			<ul id="sidebar" class="list-unstyled">
				 <?php dynamic_sidebar( 'main-right-sidebar' ); ?>
			</ul>
			<?php } ?>
		</div>
	</div>
<?php get_footer(); ?>
