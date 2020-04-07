
	</div>
	<!-- footer -->
	<footer class="py-2">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-6">
				<p class="text-center text-md-left text-mute">
				&copy; <?php echo date('Y'); ?> Copyright <a href="<?php site_url(); ?>"><?php bloginfo('name'); ?></a>.
				</p>
				</div>
				<div class="col-12 col-md-6">
					<p class="text-center text-md-right text-mute">
						<?php _e('WordPress Theme By %s',  basename(__DIR__)); ?> <a href="//viktormorales.com" title="WordPress">viktormorales.com</a>
					</p>
				</div>
			</div>
		</div>
	</footer>
	<!-- /footer -->

	<?php wp_footer(); ?>

</body>
</html>
