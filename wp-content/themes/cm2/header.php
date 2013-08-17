<?php
/**
 * @package WordPress
 * @subpackage CarmeMiquel.com v2
 */
?>

<!DOCTYPE html>

<!--[if lt IE 9]>      <html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->

<head>

	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<title><?php wp_title('-', true, 'right'); ?></title>

	<link rel="author" href="http://carmemiquel.com/humans.txt" />

	<?php wp_head(); ?>

</head>

<body class="<?php cm2_body_class(); ?>">

	<div id="center">

		<header id="header">
			<a id="site-title" href="<?php echo home_url('/'); ?>" title="Carme Miquel"><img src="<?php bloginfo('template_directory'); ?>/img/carme-miquel.png" alt="Carme Miquel" title="Carme Miquel" /></a>
			<nav>
				<ul id="menu"><!--
					--><li class="<?php cm2_menu_class('lautora'); ?>"><a href="<?php echo home_url(); ?>/autora/"><span data-icon="a"></span>Autora</a></li><!--
					--><li class="<?php cm2_menu_class('entrevistes'); ?>"><a href="<?php echo home_url(); ?>/entrevistes/"><span data-icon="b"></span>Entrevistes</a></li><!--
					--><li class="<?php cm2_menu_class('llibres'); ?>"><a href="<?php echo home_url(); ?>/llibres/"><span data-icon="c"></span>Llibres</a></li><!--
					--><li class="<?php cm2_menu_class('articles'); ?>"><a href="<?php echo home_url(); ?>/articles/"><span data-icon="d"></span>Articles</a></li><!--
					--><li class="<?php cm2_menu_class('videos'); ?>"><a href="<?php echo home_url(); ?>/videos/"><span data-icon="e"></span>Vídeos</a></li><!--
					--><li class="<?php cm2_menu_class('mes-sobre'); ?>"><a href="<?php echo home_url(); ?>/mes-sobre/"><span data-icon="f"></span>Més sobre…</a></li>
				</ul><!-- END #menu -->
				<div id="submenu" class="cf">
					<!--
					Submenu Content :: Called with AJAX
					-->
				</div><!-- END #submenu -->
			</nav>
		</header><!-- END #header -->