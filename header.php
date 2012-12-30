<?php 
/**
 * @package WordPress
 * @subpackage CarmeMiquel.com v2
 */
?>

<!DOCTYPE html>

<!--[if lt IE 8]>      <html dir="ltr" lang="ca" class="ie8 ie7"> <![endif]-->
<!--[if IE 8]>         <html dir="ltr" lang="ca" class="ie8"> <![endif]-->
<!--[if gt IE 8]><!--> <html dir="ltr" lang="ca"> <!--<![endif]-->

<head>

	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<title><?php wp_title('-', true, 'right'); ?></title>

	<link rel="author" href="http://carmemiquel.com/humans.txt" />

	<?php wp_head(); ?>

</head>

<?php // Generate the appropiate class for the body tag
if (is_page()) {
	if (get_field('cm_section') == 'Col·loqui') {
		$body_class = 'entrevistes';
	} else {
		$body_class = clean_for_url(get_field('cm_section'), false);
	}
} elseif (is_singular('articles')) {
	$body_class = 'articles';
} elseif (is_singular('llibres')) {
	$body_class = 'llibres';
} ?>

<body class="<?php echo $body_class; ?>">

	<div id="center">

		<header id="header">
			<h1><a href="http://carmemiquel.com" title="Carme Miquel"><img src="<?php bloginfo('template_directory') ?>/img/h1.png" alt="Carme Miquel" title="Carme Miquel" /></a></h1>
			<nav>
				<ul id="menu"><!--
					--><li class="autora current-menu-item"><a href="http://carmemiquel.com/autora/"><span data-icon="a"></span>Autora</a></li><!--
					--><li class="entrevistes"><a href="http://carmemiquel.com/entrevistes/"><span data-icon="b"></span>Entrevistes</a></li><!--
					--><li class="llibres"><a href="http://carmemiquel.com/llibres/"><span data-icon="c"></span>Llibres</a></li><!--
					--><li class="articles"><a href="http://carmemiquel.com/articles/"><span data-icon="d"></span>Articles</a></li><!--
					--><li class="videos"><a href="http://carmemiquel.com/videos/"><span data-icon="e"></span>Vídeos</a></li><!--
					--><li class="mes-sobre"><a href="http://carmemiquel.com/mes-sobre/"><span data-icon="f"></span>Més sobre…</a></li>
				</ul><!-- END #menu -->
				<div id="submenu" class="cf">
					<!--
					Submenu Content :: Called with AJAX
					-->
				</div><!-- END #submenu -->
			</nav>
		</header><!-- END #header -->