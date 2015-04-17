		</div>
		<div class="col-md-4">
			<ul id="sidebar" class="list-unstyled">
				<?php if ( ! dynamic_sidebar() ) : ?>
					<li>{static sidebar item 1}</li>
					<li>{static sidebar item 2}</li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
	<!-- footer -->
	<footer class="footer" role="contentinfo">

		<div class="row">
			<div class="col-md-6">
			<p class="text-left text-mute">
			&copy; <?php echo date('Y'); ?> Copyright <a href="<?php site_url(); ?>"><?php bloginfo('name'); ?></a>.
			</p>
			</div>
			<div class="col-md-6">
				<p class="text-right text-mute">
					Graphic &amp; Web Designer // <a href="//viktormorales.com" title="WordPress">viktormorales.com</a>
				</p>
			</div>
		</div>

	</footer>
	<!-- /footer -->

	</div>
	<!-- /wrapper -->
	
	<?php wp_footer(); ?>

</body>
</html>
