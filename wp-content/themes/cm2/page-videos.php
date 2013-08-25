<?php
/**
 * @package WordPress
 * @subpackage CarmeMiquel.com v2
 */
?>

<?php $body_class = "videos";
get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

	<article id="page-<?php the_ID(); ?>" class="cf">

		<hgroup class="title-block">
			<h1 class="title">Vídeos</h1>
		</hgroup><!-- END .title-block -->

		<div id="content" class="content">

			<?php $videos = get_posts(array(
				'posts_per_page'=> -1,
				'orderby'       => 'post_date',
				'order'         => 'ASC',
				'post_type'     => 'videos')); ?>
			<ul class="index">
				<?php foreach ($videos as $post): setup_postdata($post); ?>
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