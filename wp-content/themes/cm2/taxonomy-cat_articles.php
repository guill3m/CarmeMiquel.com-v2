<?php
/**
 * @package WordPress
 * @subpackage CarmeMiquel.com v2
 */
?>

<?php get_header(); ?>

<?php if (have_posts()) : ?>

	<hgroup class="title-block">
		<h2 class="title">Articles</h2>
		<h3 class="subtitle"><?php echo $term->name; ?></h3>
	</hgroup><!-- END .title-block -->

	<?php while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" class="content" itemscope itemtype="http://schema.org/Article">

			<h2 class="the-title" itemprop="name"><?php the_title(); ?></h2>
			<meta itemprop="author" content="Carme Miquel" />
			<p class="date"><span itemprop="publisher">Levante EMV</span>. <time datetime="<?php the_time('Y-m-d'); ?>" itemprop="datePublished"><?php the_time('j \d\e F, Y'); ?></time></p>
			<?php the_content(); ?>

		</article><!-- END #post-<?php the_ID(); ?> -->

	<?php endwhile; ?>

<?php endif; ?>

<?php get_footer(); ?>