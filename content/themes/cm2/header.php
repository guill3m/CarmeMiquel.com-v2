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
	<meta name ="format-detection" content ="telephone=no" /><!-- iOS was recognizing the ISBN of the books as a phone number and formating it as one -->

	<title><?php wp_title('-', true, 'right'); ?></title>

	<link rel="author" href="http://carmemiquel.com/humans.txt" />

	<?php wp_head(); ?>

	<!--[if lt IE 9]> <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/ie8.min.js"></script> <![endif]-->

	<script>
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-375607-7']);
		_gaq.push(['_trackPageview']);
		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>

</head>

<body class="<?php global $body_class; echo $body_class; ?>">

	<div id="center" class="center">

		<header id="header" class="header">
			<a id="site-title" class="site-title" href="<?php echo home_url('/'); ?>" title="Carme Miquel"><img src="<?php bloginfo('template_directory'); ?>/img/carme-miquel.png" alt="Carme Miquel" title="Carme Miquel" /></a>
			<nav>
				<ul id="menu" class="menu"><!--
					--><li class="<?php cm2_menu_class('autora'); ?>"><a href="<?php echo home_url('/autora/'); ?>"><span data-icon="a"></span>Autora</a></li><!--
					--><li class="<?php cm2_menu_class('entrevistes'); ?>"><a href="<?php echo home_url('/entrevistes/'); ?>" class="with-submenu"><span data-icon="b"></span>Entrevistes</a></li><!--
					--><li class="<?php cm2_menu_class('llibres'); ?>"><a href="<?php echo home_url('/llibres/'); ?>" class="with-submenu"><span data-icon="c"></span>Llibres</a></li><!--
					--><li class="<?php cm2_menu_class('articles'); ?>"><a href="<?php echo home_url('/articles/'); ?>" class="with-submenu"><span data-icon="d"></span>Articles</a></li><!--
					--><li class="<?php cm2_menu_class('videos'); ?>"><a href="<?php echo home_url('/videos/'); ?>" class="with-submenu"><span data-icon="e"></span>Vídeos</a></li>
				</ul><!-- END #menu -->
				<div id="submenu" class="submenu">
					<!--
					Submenu Content :: Called with AJAX
					-->
				</div><!-- END #submenu -->
			</nav>
		</header><!-- END #header -->