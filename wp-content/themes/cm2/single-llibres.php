<?php
/**
 * @package WordPress
 * @subpackage CarmeMiquel.com v2
 */
?>

<?php $body_class = "llibres";
get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

	<?php if (is_subpage()) : ?>

		<article id="book-subpage-<?php the_ID(); ?>" class="cf">

			<hgroup class="title-block">
				<h2 class="title">Llibre</h2>
				<h3 class="subtitle"><?php the_field('cm_book_subpage_type'); ?></h3>
			</hgroup>

			<div class="content">
				<h1 class="subtitle"><?php the_title($post->post_parent); ?></h1>
				<?php the_content(); ?>
			</div>

		</article> <!-- END #book-subpage-<?php the_ID(); ?> -->

	<?php else : // If is parent page ?>

		<article id="book-<?php the_ID(); ?>" class="cf" itemscope itemtype="http://schema.org/Book">

			<div class="content">
				<h1 class="subtitle" itemprop="name"><?php the_title(); ?></h1>
				<meta itemprop="author" content="Carme Miquel" />
				<meta itemprop="inLanguage" content="ca" />
				<meta itemprop="audience" content="<?php the_terms($post->ID, 'public_llibres', '', ', ', ''); ?>" />
				<link itemprop="url" href="<?php the_permalink(); ?>">
				<?php if (get_field('cm_book_publisher') && get_field('cm_book_year')) : ?><p class="date"><span itemprop="publisher"><?php the_field('cm_book_publisher'); ?></span> (<time itemprop="datePublished"><?php the_field('cm_book_year'); ?></time>)</p><?php endif; ?>
				<?php if (get_field('cm_book_isbn')) : ?><p class="date">ISBN: <span itemprop="isbn"><?php the_field('cm_book_isbn'); ?></span></p><?php endif; ?>
			</div><!-- END .content -->

			<hgroup class="title-block">
				<h2 class="title">Llibre</h2>
				<?php if (get_field('cm_book_awards')) : while(has_sub_field('cm_book_awards')) : ?><h3 class="subsubtitle" itemprop="award"><?php the_field('cm_book_award'); ?></h3><?php endwhile; endif; ?>
			</hgroup><!-- END .title-block -->

			<div class="content" itemprop="description">
				<?php the_content(); ?>
			</div><!-- END .content -->

			<?php if (has_post_thumbnail() || get_field('cm_book_collaborator') || get_field('cm_book_illustrator') || get_field('cm_book_extras')) : ?>
				<aside class="sidebar">
					<?php if (has_post_thumbnail()) : the_post_thumbnail('sidebar', array('class' => 'sidebar-img', 'alt' => the_title_attribute(array('echo' => 0)), 'itemprop' => 'image')); endif; ?>
					<?php if (get_field('cm_book_collaborator')) : ?><p>En col·laboració amb: <span itemprop="contributor"><?php the_field('cm_book_collaborator'); ?></span></p><?php endif; ?>
					<?php if (get_field('cm_book_illustrator')) : ?><p>Il·lustracions: <span itemprop="illustrator"><?php the_field('cm_book_illustrator'); ?></span></p><?php endif; ?>
					<?php if (get_field('cm_book_extras')) : ?><p><?php the_field('cm_book_extras'); ?></p><?php endif; ?>
					<?php $subpages = wp_list_pages(array('depth' => -1, 'title_li' => '', 'link_before' => '<p>', 'link_after' => '</p>', 'post_type' => 'llibres', 'child_of' => $post->ID, 'echo' => 0)); ?>
					<?php if ($subpages) : ?>
						<ul><?php echo $subpages; ?></ul>
					<?php endif; ?>
				</aside><!-- END .sidebar -->
			<?php endif; ?>

		</article><!-- END #book-<?php the_ID(); ?> -->

	<?php endif; ?>

<?php endwhile; ?>

<?php get_footer(); ?>