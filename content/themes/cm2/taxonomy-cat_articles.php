<?php
/**
 * @package WordPress
 * @subpackage CarmeMiquel.com v2
 */
?>

<?php $body_class = "articles";
get_header();
$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));?>

<?php if (have_posts()) : ?>

	<hgroup class="title-block">
		<h1 class="title">Articles</h1>
		<h2 class="subtitle"><?php echo $term->name; ?></h2>
	</hgroup><!-- END .title-block -->

	<?php while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" class="content" itemscope itemtype="http://schema.org/Article">

			<header>
				<h3 class="the-title" itemprop="name"><a href="<?php the_permalink(); ?>" class="show-hide" data-show="#show-hide-<?php the_ID(); ?>" itemprop="url"><?php the_title(); ?></a></h3>
				<meta itemprop="author" content="Carme Miquel" />
				<meta itemprop="genre" content="Columna d’opinió" />
				<p class="date"><span itemprop="publisher">Levante EMV</span>. <time datetime="<?php the_time('Y-m-d'); ?>" itemprop="datePublished"><?php the_time('j \d\e F \d\e Y'); ?></time></p>
			</header>
			<div id="show-hide-<?php the_ID(); ?>" class="show-hide-content">
				<?php the_content(); ?>
				<footer class="article-footer"><p><a href="<?php the_permalink(); ?>">Enllaç permanent a l’article</a><?php the_terms($post->ID, 'cat_articles', '&emsp;|&emsp;Categories: ', ', ', ''); ?></p></footer>
			</div>

		</article><!-- END #post-<?php the_ID(); ?> -->

	<?php endwhile; ?>

<?php endif; ?>

<?php get_footer(); ?>