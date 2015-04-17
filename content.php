<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
		<ul class="post-meta-data text-muted list-unstyled">
			<li><i class="fa fa-user"></i> <?php the_author(); ?></li>
			<li><i class="fa fa-clock-o"></i> <?php the_time('j.M.Y'); ?></li>
			<li><i class="fa fa-comment"></i> <a href="<?php the_permalink(); ?>#comments"><?php comments_number( __('Comment', TEXTDOMAIN), __('1 comment', TEXTDOMAIN), __('% comments', TEXTDOMAIN) ); ?></a></li>
			<li><i class="fa fa-folder"></i> <?php the_category(', '); ?></li>
		</ul>
	</header>

	<div class="entry-content">
		<?php the_content(); ?>
		
	</div><!-- .entry-content -->

	<footer class="entry-footer">
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
