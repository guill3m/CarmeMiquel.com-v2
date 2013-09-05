<?php
/**
 * @package WordPress
 * @subpackage CarmeMiquel.com v2
 */
?>

<?php $body_class = "front-page";
get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

	<div class="content">
		<?php the_content(); ?>
	</div><!-- END .content -->

<?php endwhile; ?>

<?php get_footer(); ?>