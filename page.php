<?php 
/**
 * @package WordPress
 * @subpackage CarmeMiquel.com v2
 */
?>

<?php get_header(); ?>

<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>

		<article id="page-<?php the_ID(); ?>" class="page cf">

			<hgroup class="title">
				<h2><?php the_field('cm_section'); ?></h2>
				<?php if(get_field('cm_title')): ?>
					<h3><?php the_field('cm_title') ?></h3>
				<?php endif; ?>
				<?php if(get_field('cm_subtitle')): ?>
					<h4><?php the_field('cm_subtitle') ?></h4>
				<?php endif; ?>
			</hgroup><!-- end .title -->

			<div class="content">
				<?php the_content(); ?>
			</div><!-- end .content -->

			<?php if (get_field('cm_aside')) : ?>
				<aside class="sidebar">
					<?php if (has_post_thumbnail()) : ?>
						<?php the_post_thumbnail('sidebar', array('class' => 'sidebar-img', 'title' => the_title_attribute(array('echo' => 0)), 'alt' => the_title_attribute(array('echo' => 0)))); ?>
					<?php endif; ?>
					<?php if (get_field('cm_sidebar-txt')) : ?>
						<div class="sidebar-txt">
							<?php the_field('cm_sidebar-txt'); ?>
						</div>
					<?php endif; ?>
				</aside><!-- end .sidebar -->
			<?php endif; ?>

		</article><!-- end #page-<?php the_ID(); ?> -->

	<?php endwhile; ?>

<?php endif; ?>

<?php get_footer(); ?>