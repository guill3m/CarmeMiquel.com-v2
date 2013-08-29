<?php
/**
 * @package WordPress
 * @subpackage CarmeMiquel.com v2
 */
?>

<?php get_header(); ?>

<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" class="cf">

			<hgroup class="title-block">
				<h2 clas="title"><?php the_field('cm_section'); ?></h2>
				<h3 class="subtitle"><?php the_title(); ?></h3>
				<h4 class="subsubtitle"><?php the_time('j F, Y'); ?></h4>
			</hgroup><!-- END .title -->

			<div class="content">
				<?php the_content(); ?>
			</div><!-- END .content -->

		</article><!-- END #post-<?php the_ID(); ?> -->

	<?php endwhile; ?>

<?php endif; ?>

<?php get_footer(); ?>