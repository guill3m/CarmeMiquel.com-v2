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

	<div class="content">

		<?php while (have_posts()) : the_post(); ?>

			<article id="book-<?php the_ID(); ?>" class="book" itemscope itemtype="http://schema.org/Book">
				<a href="<?php the_permalink(); ?>" itemprop="url">
					<?php if (has_post_thumbnail()) : the_post_thumbnail('llibre-small', array('alt' => the_title_attribute(array('echo' => 0)), 'itemprop' => 'image')); endif; ?>
					<h3 itemprop="name"><?php the_title(); ?></h3>
				</a>
			</article><!-- END #book-<?php the_ID(); ?> -->

		<?php endwhile; ?>

	</div>

<?php endif; ?>

<?php get_footer(); ?>