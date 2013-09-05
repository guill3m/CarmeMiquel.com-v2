<?php
/**
 * @package WordPress
 * @subpackage CarmeMiquel.com v2
 */
?>

<?php $body_class = "llibres";
get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

	<?php if (is_subpage()) : ?>

		<article id="book-subpage-<?php the_ID(); ?>" class="cf">

			<hgroup class="title-block">
				<h2 class="title">Llibre</h2>
				<?php if (has_post_thumbnail($post->post_parent)) : echo get_the_post_thumbnail($post->post_parent, 'llibre-small', array('class' => 'sidebar-img small', 'alt' => the_title_attribute(array('echo' => 0)))); endif; ?>
				<p><a href="<?php echo get_permalink($post->post_parent); ?>">« Tornar al llibre</a></p>
			</hgroup>

			<div class="content">
				<h1 class="the-title"><a href="<?php echo get_permalink($post->post_parent); ?>"><?php echo get_the_title($post->post_parent); ?>:</a> <?php the_field('cm_book_subpage_type'); ?></h1>
				<?php the_content(); ?>
			</div>

		</article> <!-- END #book-subpage-<?php the_ID(); ?> -->

	<?php else : // If is parent page ?>

		<article id="book-<?php the_ID(); ?>" class="cf" itemscope itemtype="http://schema.org/Book">

			<hgroup class="title-block">
				<h2 class="title">Llibre</h2>
			</hgroup><!-- END .title-block -->

			<header class="content">
				<h1 class="the-title" itemprop="name"><?php the_title(); ?></h1>
				<meta itemprop="author" content="Carme Miquel" />
				<meta itemprop="inLanguage" content="ca" />
				<?php $audiences = get_the_terms($post->ID, 'public_llibres');
				if ($audiences) :
					$audiences_link = array();
					foreach ($audiences as $audience) :
						$audience_link[] = $audience->name;
					endforeach;
					$the_audience = join( ", ", $audience_link ); ?>
					<meta itemprop="audience" content="<?php echo $the_audience; ?>" />
				<?php endif; ?>
				<link itemprop="url" href="<?php the_permalink(); ?>">
				<?php if (get_field('cm_book_publisher') && get_field('cm_book_year')) : ?><p class="date"><span itemprop="publisher"><?php the_field('cm_book_publisher'); ?></span> (<time itemprop="datePublished"><?php the_field('cm_book_year'); ?></time>)</p><?php endif; ?>
				<?php if (get_field('cm_book_isbn')) : ?><p class="date">ISBN: <span itemprop="isbn"><?php the_field('cm_book_isbn'); ?></span></p><?php endif; ?>
				<?php if (get_field('cm_book_awards')) : while(has_sub_field('cm_book_awards')) : ?><h3 class="subsubtitle" itemprop="award"><?php the_sub_field('cm_book_award'); ?></h3><?php endwhile; endif; ?>
				<?php if (get_field('cm_book_collaborator')) : ?><p class="book-more">En col·laboració amb <span itemprop="contributor"><?php the_field('cm_book_collaborator'); ?></span></p><?php endif; ?>
					<?php if (get_field('cm_book_illustrator')) : ?><p class="book-more">Il·lustracions per <span itemprop="illustrator"><?php the_field('cm_book_illustrator'); ?></span></p><?php endif; ?>
					<?php if (get_field('cm_book_extras')) : ?><p class="book-more"><?php the_field('cm_book_extras'); ?></p><?php endif; ?>
					<?php $subpages = get_pages(array('child_of' => $post->ID, 'post_type' => 'llibres')); ?>
					<?php if ($subpages) : ?>
						<p class="book-more">Més informació sobre aquest llibre:</p>
						<ul class="book-more">
							<?php foreach ($subpages as $subpage) : ?>
								<li><p class="book-more"><a href="<?php echo get_permalink($subpage->ID) ?>" title="<?php echo get_the_title($subpage->ID) ?>"><?php the_field('cm_book_subpage_type', $subpage->ID); ?></a></p></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
			</header>

			<?php if (has_post_thumbnail()) : ?>
				<aside class="sidebar">
					<?php the_post_thumbnail('sidebar', array('class' => 'sidebar-img', 'alt' => the_title_attribute(array('echo' => 0)), 'itemprop' => 'image')); ?>
				</aside><!-- END .sidebar -->
			<?php endif; ?>

			<div class="content" itemprop="description">
				<?php the_content(); ?>
			</div><!-- END .content -->

		</article><!-- END #book-<?php the_ID(); ?> -->

	<?php endif; ?>

<?php endwhile; ?>

<?php get_footer(); ?>