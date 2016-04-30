<?php
/**
 * @package WordPress
 * @subpackage CarmeMiquel.com v2
 */



/*
 * Theme version number
 */

$theme = wp_get_theme();
$theme_version_number = $theme['Version'];



/*
 * Add theme support:
 * Menus
 * Thumbnails and custom thumbnail sizes
 */

function cm2_setup_theme() {
	add_theme_support('menus');
	add_theme_support('post-formats', array('audio', 'video'));
	add_theme_support('post-thumbnails', array('entrevistes', 'llibres', 'page', 'videos'));
	add_image_size('sidebar', 350, 9999);
	add_image_size('llibre-small', 9999, 200);
	add_image_size('video', 480, 270, true);
}

add_action('after_setup_theme', 'cm2_setup_theme');



/*
 * Load CSS, before the JS
 */

function cm2_css_enqueue() {
	global $theme_version_number;
	// Styles
	wp_register_style('style', get_template_directory_uri() . "/style.css", false, $theme_version_number, 'all');
	// Load styles
	wp_enqueue_style('style');
}

add_action('wp_enqueue_scripts', 'cm2_css_enqueue', 11);



/*
 * Load jQuery from Google’s servers, on the footer, and not in the admin area
 */

function cm2_jquery_enqueue() {
	wp_deregister_script('jquery');
	wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js", false, null, true);
	wp_enqueue_script('jquery');
}

if (!is_admin()) :
	add_action('wp_enqueue_scripts', 'cm2_jquery_enqueue', 12);
endif;



/*
 * Load the rest of the JS, after jQuery
 */

function cm2_js_enqueue() {
	global $theme_version_number;
	// Head
	// Footer
	wp_register_script('scripts', get_template_directory_uri() . "/js/scripts.min.js", 'jquery', $theme_version_number, true);
	// Load scripts
	wp_enqueue_script(array('scripts'));
}

add_action('wp_enqueue_scripts', 'cm2_js_enqueue', 13);



/*
 * The menu classes
 */

function cm2_menu_class($the_class) {
	global $body_class;
	if ($body_class != $the_class) {
		echo $the_class;
	} else {
		echo $the_class . ' active';
	}
}



/*
 * Prevent Wordpress from adding the attributes ‘width’ and ‘height’ to img elements
 */

function cm2_remove_width_attribute($html) {
	$html = preg_replace('/(width|height)="\d*"\s/', "", $html);
	return $html;
}

add_filter('post_thumbnail_html', 'cm2_remove_width_attribute', 10);
add_filter('image_send_to_editor', 'cm2_remove_width_attribute', 10);



/*
 * Removing unwanted crap from the head
 */

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');



/*
 * Removing the “read more” link jump, I find it anoying and confusing
 */

function cm2_remove_more_jump_link($link) {
	$link = preg_replace('|#more-[0-9]+|', '', $link);
	return $link;
}

add_filter('the_content_more_link', 'cm2_remove_more_jump_link');



/*
 * Check if we are on a subpage
 */

function is_subpage() {
	global $post;
	if ($post->post_parent) :
		return $post->post_parent;
	else :
		return false;
	endif;
}



/*
 * Taxonomy pages for ‘llibres’ and ‘articles’ post types show all posts in one page
 */

function cm2_show_all_posts($query) {
	if ($query->is_tax('cat_articles') && $query->is_main_query()) {
		$query->set('posts_per_page', '-1');
	}
	if ($query->is_tax('public_llibres') && $query->is_main_query()) {
		$query->set('posts_per_page', '-1');
	}
}

add_action('pre_get_posts', 'cm2_show_all_posts');



/*
 * Clean string for use on URL
 * Usage:
 * <?php clean_for_url($string); ?>         // Echoes it
 * <?php clean_for_url($string, false); ?>  // Returns it
 */

function clean_for_url($toClean, $echo = true) {

	$characters = array(
	'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f'
	);

	// Replace characters acording to the table in $characters
	$toClean = strtr($toClean, $characters);
	// Replace ampersand (&) with ‘i’ (this site’s language is catalan, that’s why I’m using ‘i’ instead of ‘and’)
	$toClean = str_replace('&', '-i-', $toClean);
	// Remove any ilegal characters remaining
	$toClean = trim(preg_replace('/[^\w\d_ -]/si', '', $toClean));
	// Replace spaces with dash
	$toClean = str_replace(' ', '-', $toClean);
	// Remove duplicate dashes
	$toClean = str_replace('--', '-', $toClean);
	// Convert the string to lowercase
	$toClean = strtolower($toClean);

	// The result
	if ($echo == true) {
		echo $toClean;
	} else {
		return $toClean;
	}

}
