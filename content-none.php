<?php
/**
 * The template part for displaying a message that posts cannot be found
 */
?>

<section id="not-found">
	<header class="page-header">
		<h2 class="page-title"><?php _e( 'Nothing Found', basename(__DIR__) ); ?></h2>
	</header><!-- .page-header -->

	<div class="page-content">

		<?php if ( is_search() ) : ?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', basename(__DIR__) ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', basename(__DIR__) ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>

	</div><!-- .page-content -->
</section><!-- .no-results -->
