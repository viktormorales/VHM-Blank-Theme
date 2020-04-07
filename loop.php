
		<article id="post-<?php the_ID(); ?>" <?php post_class('thumbnail mb-5'); ?>>
			<div class="row">
				<div class="col-md-4">
					<a href="<?php the_permalink(); ?>">
						<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail('large', array('class' => 'img-fluid')); ?>
						<?php else: ?>
							<img src="http://placehold.it/800x600&text=No+Image" class="img-fluid">
						<?php endif; ?>
					</a>
				</div>
				<div class="col-md-8">
					<header class="page-header">
						<?php the_title( sprintf( '<h2><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
						<ul class="text-muted list-unstyled list-inline">
							<li class="list-inline-item"><i class="fa fa-user"></i> <?php the_author(); ?></li>
							<li class="list-inline-item"><i class="fa fa-clock"></i> <?php the_time('j.M.Y'); ?></li>
							<li class="list-inline-item"><i class="fa fa-comment"></i> <a href="<?php the_permalink(); ?>#comments"><?php comments_number( __('Comment', basename(__DIR__)), __('1 comment', basename(__DIR__)), __('% comments', basename(__DIR__)) ); ?></a></li>
							<li class="list-inline-item"><i class="fa fa-folder"></i> <?php the_category(', '); ?></li>
						</ul>
					</header>
					
					<?php the_excerpt(); ?>
					
					<footer class="page-footer">
						<p><a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php _e('Continue reading', basename(__DIR__)); ?></a></p>
					</footer>
				</div>
			</div>
		</article><!-- #post-## -->
