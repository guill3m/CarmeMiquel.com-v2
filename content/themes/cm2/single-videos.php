<?php
/**
 * @package WordPress
 * @subpackage CarmeMiquel.com v2
 */
?>

<?php $body_class = "videos";
get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

	<article id="interview-<?php the_ID(); ?>" class="cf">

		<hgroup class="title-block">
			<h2 class="title">Vídeo</h2>
			<h1 class="subtitle"><?php the_title(); ?></h1>
		</hgroup><!-- END .title-block -->

		<div class="content">
			<?php get_template_part('format', 'video'); ?>
			<?php the_content(); ?>
		</div><!-- END .content -->

	</article><!-- END #interview-<?php the_ID(); ?> -->

<?php endwhile; ?>

<?php get_footer(); ?>