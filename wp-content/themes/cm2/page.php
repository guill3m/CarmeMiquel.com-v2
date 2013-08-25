<?php
/**
 * @package WordPress
 * @subpackage CarmeMiquel.com v2
 */
?>

<?php $body_class = "none";
get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

	<article id="page-<?php the_ID(); ?>" class="cf">

		<hgroup class="title-block">
			<h1 class="title"><?php the_field('cm_section'); ?></h1>
			<?php if(get_field('cm_title')): ?>
				<h2 class="subtitle"><?php the_field('cm_title'); ?></h2>
			<?php endif; ?>
			<?php if(get_field('cm_subtitle')): ?>
				<h3 class="subsubtitle"><?php the_field('cm_subtitle'); ?></h3>
			<?php endif; ?>
		</hgroup><!-- END .title-block -->

		<div class="content">
			<?php the_content(); ?>
		</div><!-- END .content -->

		<?php if (has_post_thumbnail()) : ?>
			<aside class="sidebar">
				<?php the_post_thumbnail('sidebar', array('class' => 'sidebar-img', 'title' => the_title_attribute(array('echo' => 0)), 'alt' => the_title_attribute(array('echo' => 0)))); ?>
			</aside><!-- END .sidebar -->
		<?php endif; ?>

	</article><!-- END #page-<?php the_ID(); ?> -->

<?php endwhile; ?>

<?php get_footer(); ?>