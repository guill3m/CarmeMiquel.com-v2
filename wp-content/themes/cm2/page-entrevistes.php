<?php
/**
 * @package WordPress
 * @subpackage CarmeMiquel.com v2
 */
?>

<?php $body_class = "entrevistes";
get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

	<article id="page-<?php the_ID(); ?>" class="cf">

		<hgroup class="title-block">
			<h1 class="title">Entrevistes</h1>
		</hgroup><!-- END .title-block -->

		<div id="content" class="content">

			<h2 class="subtitle">Entrevistes</h2>
			<?php $entrevistes = get_posts(array(
				'posts_per_page'=> -1,
				'orderby'       => 'post_date',
				'order'         => 'ASC',
				'meta_key'      => 'cm_interview_type_sort',
				'meta_value'    => 'entrevista',
				'post_type'     => 'entrevistes')); ?>
			<ul class="index">
				<?php foreach ($entrevistes as $post): setup_postdata($post); ?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endforeach;
				wp_reset_postdata(); ?>
			</ul>

			<hr />

			<h2 class="subtitle">Col·loquis amb estudiants</h2>
			<?php $colloquis = get_posts(array(
				'posts_per_page'=> -1,
				'orderby'       => 'post_date',
				'order'         => 'ASC',
				'meta_key'      => 'cm_interview_type_sort',
				'meta_value'    => 'colloqui',
				'post_type'     => 'entrevistes')); ?>
			<ul class="index">
				<?php foreach ($colloquis as $post): setup_postdata($post); ?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endforeach;
				wp_reset_postdata(); ?>
			</ul>

			<?php $content = get_the_content();
			if (!empty($content)) : echo '<hr />'; endif;
			the_content(); ?>

		</div><!-- END .content -->

	</article><!-- END #page-<?php the_ID(); ?> -->

<?php endwhile; ?>

<?php get_footer(); ?>