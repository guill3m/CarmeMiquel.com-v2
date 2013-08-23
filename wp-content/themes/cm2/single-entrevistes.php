<?php
/**
 * @package WordPress
 * @subpackage CarmeMiquel.com v2
 */
?>

<?php $body_class = "entrevistes";
get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" class="cf">

		<hgroup class="title-block">
			<h2 class="title"><?php the_field('cm_interview_type'); ?></h2>
			<h1 class="subtitle"><?php the_field('cm_interviewer'); ?></h1>
			<h3 class="subsubtitle"><?php the_field('cm_date'); ?></h3>
		</hgroup><!-- END .title-block -->

		<div class="content">
			<?php the_content(); ?>
		</div><!-- END .content -->

	</article><!-- END #post-<?php the_ID(); ?> -->

<?php endwhile; ?>

<?php get_footer(); ?>