<?php
/**
 * @package WordPress
 * @subpackage CarmeMiquel.com v2
Template Name: Articles
 */
?>

<?php $body_class = "articles";
get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

	<article id="page-<?php the_ID(); ?>" class="cf">

		<hgroup class="title-block">
			<h1 class="title">Articles</h1>
		</hgroup><!-- END .title-block -->

		<div id="content" class="content">

			<ul class="index">
				<?php wp_list_categories(array(
					'orderby'            => 'name',
					'order'              => 'ASC',
					'style'              => 'list',
					'show_count'         => 0,
					'hide_empty'         => 1,
					'use_desc_for_title' => 1,
					'hierarchical'       => 1,
					'title_li'           => ,
					'show_option_none'   => 'Sense categories',
					'number'             => null,
					'echo'               => 1,
					'depth'              => 0,
					'taxonomy'           => 'cat_articles')); ?>
			</ul>

			<?php $content = get_the_content();
			if (!empty($content)) : echo '<hr />'; endif;
			the_content(); ?>

		</div><!-- END .content -->

	</article><!-- END #page-<?php the_ID(); ?> -->

<?php endwhile; ?>

<?php get_footer(); ?>