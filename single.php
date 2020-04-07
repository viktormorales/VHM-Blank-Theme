<?php get_header(); ?>

	<section id="single" class="py-5">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
				<?php while ( have_posts() ) { the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="page-header">
							<?php the_title( '<h2 class="page-title">', '</h2>' ); ?>
							<ul class="text-muted list-unstyled list-inline">
								<li class="list-inline-item"><i class="fas fa-user"></i> <?php the_author(); ?></li>
								<li class="list-inline-item"><i class="fas fa-clock"></i> <?php the_time('j.M.Y'); ?></li>
								<li class="list-inline-item"><i class="fas fa-comment"></i> <a href="<?php the_permalink(); ?>#comments"><?php comments_number( __('Comment', basename(__DIR__)), __('1 comment', basename(__DIR__)), __('% comments', basename(__DIR__)) ); ?></a></li>
								<li class="list-inline-item"><i class="fas fa-folder"></i> <?php the_category(', '); ?></li>
							</ul>
						</header>

						<div class="page-content">
							<?php 		
								the_content(); 
								
								the_tags( '<p class="text-muted"><i class="fa fa-tags"></i> ', ', ', '</p>' );
								
								wp_link_pages( array(
									'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', basename(__DIR__) ) . '</span>',
									'after'       => '</div>',
									'link_before' => '<span>',
									'link_after'  => '</span>',
									'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', basename(__DIR__) ) . ' </span>%',
									'separator'   => '<span class="screen-reader-text">, </span>',
								) );
							?>
						</div>

					</article>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

					// Previous/next post navigation.
					the_post_navigation( array(
						'prev_text' => '<span class="post-title"><i class="fa fa-angle-double-left"></i> %title</span>',
						'next_text' => '<span class="post-title">%title <i class="fa fa-angle-double-right"></i></span>'
					) );
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
	</section><!-- .content-area -->

<?php get_footer(); ?>
