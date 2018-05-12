
		<article id="post-<?php the_ID(); ?>" <?php post_class('thumbnail'); ?>>
			<div class="row">
				<div class="col-md-4">
					<a href="<?php the_permalink(); ?>">
						<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail(); ?>
						<?php else: ?>
							<img src="http://placehold.it/800x600&text=No+Image+:(" class="img-responsive">
						<?php endif; ?>
					</a>
				</div>
				<div class="col-md-8">
					<header class="page-header">
						<?php the_title( sprintf( '<h2><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
						<ul class="post-meta-data text-muted list-unstyled">
							<li><i class="fa fa-user"></i> <?php the_author(); ?></li>
							<li><i class="fa fa-clock-o"></i> <?php the_time('j.M.Y'); ?></li>
							<li><i class="fa fa-comment"></i> <a href="<?php the_permalink(); ?>#comments"><?php comments_number( __('Comment', VHMTHEME_TEXTDOMAIN), __('1 comment', VHMTHEME_TEXTDOMAIN), __('% comments', VHMTHEME_TEXTDOMAIN) ); ?></a></li>
							<li><i class="fa fa-folder"></i> <?php the_category(', '); ?></li>
						</ul>
					</header>
					
					<?php the_excerpt(); ?>
					
					<footer class="page-footer">
						<p><a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php _e('Continue reading', VHMTHEME_TEXTDOMAIN); ?></a></p>
					</footer>
				</div>
			</div>
		</article><!-- #post-## -->
