<?php
/**
 * @package WordPress
 * @subpackage CarmeMiquel.com v2
Template Name: Vídeos
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
				'order'         => 'DES',
				'post_type'     => 'videos')); ?>

			<?php foreach ($videos as $post): setup_postdata($post); ?>
				<a href="<?php the_permalink(); ?>" class="video-link">
					<?php if (has_post_thumbnail()) : the_post_thumbnail('video', array('alt' => the_title_attribute(array('echo' => 0)))); endif; ?>
					<h2 class="video-name"><?php the_title(); ?></h2>
				</a>
			<?php endforeach;
			wp_reset_postdata(); ?>

			<?php $content = get_the_content();
			if (!empty($content)) : echo '<hr />'; endif;
			the_content(); ?>

		</div><!-- END .content -->

	</article><!-- END #page-<?php the_ID(); ?> -->

<?php endwhile; ?>

<?php get_footer(); ?>