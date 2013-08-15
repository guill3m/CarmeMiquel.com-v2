<?php 
/**
 * @package WordPress
 * @subpackage CarmeMiquel.com v2
 */
?>

<?php get_header(); ?>

<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" class="post cf">

			<hgroup class="title-block">
				<h2 class="title"><?php the_field('cm_section'); ?></h2>
				<h3 class="subtitle"><time datetime="<?php the_time('c'); ?>" pubdate><?php the_time('j F, Y'); ?></time></h3>
			</hgroup><!-- END .title-block -->

			<div class="content">
				<h1 class="the-title"><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</div><!-- END .content -->

		</article><!-- END #post-<?php the_ID(); ?> -->

	<?php endwhile; ?>

<?php endif; ?>

<?php get_footer(); ?>