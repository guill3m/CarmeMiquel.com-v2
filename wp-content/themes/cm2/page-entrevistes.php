<?php
/**
 * @package WordPress
 * @subpackage CarmeMiquel.com v2
Template Name: Entrevistes
 */
?>

<?php $body_class = "entrevistes";
get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

	<article id="page-<?php the_ID(); ?>" class="cf">

		<hgroup class="title-block">
			<h1 class="title">Entrevistes</h1>
		</hgroup><!-- END .title-block -->

		<div class="content">
			<?php the_content(); ?>
		</div><!-- END .content -->

	</article><!-- END #page-<?php the_ID(); ?> -->

<?php endwhile; ?>

<?php get_footer(); ?>