<?php get_header(); ?>

	<section id="archive">
		<div class="container">
			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<?php
						the_archive_title( '<h1 class="mb-5">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</header><!-- .page-header -->
				
				<?php
				while ( have_posts() ) { the_post();
					get_template_part( 'loop' );
				}
				?>
				
				<?php
				// Previous/next page navigation.
				the_posts_pagination( array(
					'prev_text'          => __( 'Previous page', basename(__DIR__) ),
					'next_text'          => __( 'Next page', basename(__DIR__) ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', basename(__DIR__) ) . ' </span>',
				) );

			// If no content, include the "No posts found" template.
			else :
				get_template_part( 'content', 'none' );

			endif;
			?>

		</div><!-- .site-main -->
	</section><!-- .content-area -->

<?php get_footer(); ?>