
		<article id="post-<?php the_ID(); ?>" <?php post_class('thumbnail'); ?>>
			<div class="row">
				<div class="col-md-4">
					<a href="<?php the_permalink(); ?>"><?php the_timthumb(); ?></a>
				</div>
				<div class="col-md-8">
					<header class="entry-header">
						<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
						<ul class="post-meta-data text-muted list-unstyled">
							<li><i class="fa fa-user"></i> <?php the_author(); ?></li>
							<li><i class="fa fa-clock-o"></i> <?php the_time('j.M.Y'); ?></li>
							<li><i class="fa fa-comment"></i> <a href="<?php the_permalink(); ?>#comments"><?php comments_number( __('Comment', TEXTDOMAIN), __('1 comment', TEXTDOMAIN), __('% comments', TEXTDOMAIN) ); ?></a></li>
							<li><i class="fa fa-folder"></i> <?php the_category(', '); ?></li>
						</ul>
					</header><!-- .entry-header -->
					
					<?php the_excerpt(); ?>
					
					<footer class="entry-footer">
						<a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php _e('Continue reading', TEXTDOMAIN); ?></a>
					</footer>
				</div>
			</div>
		</article><!-- #post-## -->
