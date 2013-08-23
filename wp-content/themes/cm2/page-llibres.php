<?php
/**
 * @package WordPress
 * @subpackage CarmeMiquel.com v2
Template Name: Llibres
 */
?>

<?php $body_class = "llibres";
get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

	<article id="page-<?php the_ID(); ?>" class="cf">

		<hgroup class="title-block">
			<h1 class="title">Llibres</h1>
		</hgroup><!-- END .title-block -->

		<div class="content">
			<h2 class="subtitle">Per públic</h2>
			<ul>
				<li><a href="http://carmemiquel.com/llibres/infantil/">Infantil</a></li>
				<li><a href="http://carmemiquel.com/llibres/juvenil/">Juvenil</a></li>
				<li><a href="http://carmemiquel.com/llibres/adults/">Adults</a></li>
			</ul>
			<hr />
			<h2 class="subtitle">Aclariments previs</h2>
			<?php the_content(); ?>
		</div><!-- END .content -->

	</article><!-- END #page-<?php the_ID(); ?> -->

<?php endwhile; ?>

<?php get_footer(); ?>