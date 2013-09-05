<?php
/**
 * @package WordPress
 * @subpackage CarmeMiquel.com v2
 */
?>

<?php $body_class = "llibres";
get_header();
$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));?>

<?php if (have_posts()) : ?>

	<hgroup class="title-block">
		<h1 class="title">Llibres</h1>
		<h2 class="subtitle"><?php echo $term->name; ?></h2>
	</hgroup><!-- END .title-block -->

	<div class="content book-list">

		<?php while (have_posts()) : the_post(); ?>

			<article id="book-<?php the_ID(); ?>" class="book" itemscope itemtype="http://schema.org/Book">
				<a href="<?php the_permalink(); ?>" itemprop="url">
					<?php if (has_post_thumbnail()) : the_post_thumbnail('llibre-small', array('alt' => the_title_attribute(array('echo' => 0)), 'itemprop' => 'image')); endif; ?>
					<div class="book-info">
						<h3 itemprop="name" class="book-name"><?php the_title(); ?></h3>
						<?php if (get_field('cm_book_publisher') && get_field('cm_book_year')) : ?><p class="date"><span itemprop="publisher"><?php the_field('cm_book_publisher'); ?></span> (<time itemprop="datePublished"><?php the_field('cm_book_year'); ?></time>)</p><?php endif; ?>
					</div>
				</a>
			</article><!-- END #book-<?php the_ID(); ?> -->

		<?php endwhile; ?>

	</div>

<?php endif; ?>

<?php get_footer(); ?>