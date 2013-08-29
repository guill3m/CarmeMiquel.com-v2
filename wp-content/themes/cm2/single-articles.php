<?php
/**
 * @package WordPress
 * @subpackage CarmeMiquel.com v2
 */
?>

<?php $body_class = "articles";
get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

	<article id="article-<?php the_ID(); ?>" class="cf" itemscope itemtype="http://schema.org/Article">

		<hgroup class="title-block">
			<h2 class="title">Article</h2>
			<h3 class="subtitle"><?php the_terms($post->ID, 'cat_articles', '', ', ', ''); ?></h3>
		</hgroup><!-- END .title-block -->

		<div class="content">
			<header>
				<h1 class="the-title" itemprop="name"><?php the_title(); ?></h1>
				<meta itemprop="author" content="Carme Miquel" />
				<meta itemprop="genre" content="Columna d’opinió" />
				<link itemprop="url" href="<?php the_permalink(); ?>">
				<p class="date"><span itemprop="publisher"><?php if(get_field('cm_publisher')) : the_field('cm_publisher'); else : echo 'Levante EMV'; endif;?></span>. <time datetime="<?php the_time('Y-m-d'); ?>" itemprop="datePublished"><?php the_time('j \d\e F \d\e Y'); ?></time></p>
			</header>
			<?php the_content(); ?>
		</div><!-- END .content -->

	</article><!-- END #article-<?php the_ID(); ?> -->

<?php endwhile; ?>

<?php get_footer(); ?>