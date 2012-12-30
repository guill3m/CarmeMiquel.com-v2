<?php 
/**
 * @package WordPress
 * @subpackage CarmeMiquel.com v2
 */
?>

		<footer id="footer" class="cf">
			<small>
			<?php if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb('<nav class="breadcrumbs"><p>','</p></nav>');
			} ?>
				<span class="footer-left">© Carme Miquel, 2009–<?php date('Y'); ?></span>
				<span class="footer-right">Disseny i Desenvolupament Web: <a href="http://guillemandreu.com/">Guillem Andreu</a></span>
			</small>
		</footer><!-- END #footer -->

	</div><!-- END #center -->

	<?php wp_footer(); ?>

</body>

</html>