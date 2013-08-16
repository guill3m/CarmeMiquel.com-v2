<?php
/*
Plugin Name: CM2 Admin
Version: 1.0
Author: Guillem Andreu
Author URI: http://guillemandreu.com
Description: Some modifications to the WP-Admin
*/



/*
 * Reorder items on the admin menu
 */

function cm2_menu_order($menu_ord) {
	if (!$menu_ord) return true;
	return array(
		'index.php',                   // Dashboard Link
		'separator1',                  // Separator
		'edit.php?post_type=articles', // Articles
		'edit.php?post_type=llibres',  // Llibres
		'edit.php?post_type=page',     // Pages
		'edit.php',                    // Posts
		'upload.php',                  // Media
		'edit-comments.php'            // Comments
	);
}

add_filter('custom_menu_order', 'cm2_menu_order');
add_filter('menu_order', 'cm2_menu_order');



/*
 * Hide the default “post” post type and comments from the menu, as well as the tools
 *
 * This just hides the menu item, there are still there if you use the correct url
 * And this does not remove the posts from the “right now” dashboard widget, I still need to figure out how to do that
 */

function cm2_remove_from_admin_menu() {
	remove_menu_page('edit.php');          // Hide default Posts
	remove_menu_page('edit-comments.php'); // Hide Comments
}

add_action('admin_menu','cm2_remove_from_admin_menu');



/*
 * Modifying the visual editor (simplify by removing icons that are not going to be used, and reordering)
 */

function cm2_base_extended_editor_mce_buttons($buttons) {
	return array(
		'bold',
		'italic',
		'separator',
		'bullist',
		'numlist',
		'separator',
		'link',
		'unlink',
		'separator',
		'undo',
		'redo',
		'separator',
		'pastetext',
		'removeformat',
		'separator',
		'fullscreen',
		'charmap'
	);
}

add_filter('mce_buttons', 'cm2_base_extended_editor_mce_buttons', 0);


function cm2_base_extended_editor_mce_buttons_2($buttons) {
	return array();
}

add_filter('mce_buttons_2', 'cm2_base_extended_editor_mce_buttons_2', 0);


function cm2_base_custom_mce_format($init) {
	$init['theme_advanced_blockformats'] = 'p,h2,h3,h4,h5,h6';
	return $init;
}

add_filter('tiny_mce_before_init', 'cm2_base_custom_mce_format');



/*
 * WP-Admin footer text
 */

function cm2_admin_footer_text($default_text) {
	return '<span id="footer-thankyou">© 2009–' . date('Y') . ' Carme Miquel<span> | Disseny i Desenvolupament Web per <a href="http://guillemandreu.com">Guillem Andreu</a> | Gestionat amb <a href="http://www.wordpress.org">WordPress</a></span></span>';
}

add_filter('admin_footer_text', 'cm2_admin_footer_text');



/*
 * Removing the WP logo and comments button from the admin bar
 */

function cm2_admin_bar() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_node('wp-logo');
	$wp_admin_bar->remove_node('comments');
}

add_action('wp_before_admin_bar_render', 'cm2_admin_bar');