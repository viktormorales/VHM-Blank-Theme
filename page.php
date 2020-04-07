<?php get_header(); ?>

	<section id="page" class="py-5">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<?php while ( have_posts() ) { the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<header class="page-header">
								<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
							</header>
							<div class="page-content">
								<?php the_content(); ?>
							</div>
						</article>

						<?php

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					}
					?>
				</div>
				<div class="col-md-4">
					<?php if ( is_active_sidebar( 'main-right-sidebar' ) ) { ?>
					<ul id="sidebar" class="list-unstyled">
						<?php dynamic_sidebar( 'main-right-sidebar' ); ?>
					</ul>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>
<?php get_footer(); ?>
