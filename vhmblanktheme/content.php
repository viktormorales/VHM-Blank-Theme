<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="page-header">
		<?php the_title( '<h2 class="page-title">', '</h2>' ); ?>
		<ul class="post-meta-data text-muted list-unstyled">
			<li><i class="fa fa-user"></i> <?php the_author(); ?></li>
			<li><i class="fa fa-clock-o"></i> <?php the_time('j.M.Y'); ?></li>
			<li><i class="fa fa-comment"></i> <a href="<?php the_permalink(); ?>#comments"><?php comments_number( __('Comment', basename(__DIR__)), __('1 comment', basename(__DIR__)), __('% comments', basename(__DIR__)) ); ?></a></li>
			<li><i class="fa fa-folder"></i> <?php the_category(', '); ?></li>
		</ul>
	</header>

	<div class="page-content">
		<?php 		
			the_content(); 
			
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
