<?php 
/**
 * @package WordPress
 * @subpackage CarmeMiquel.com v2
 */



/*
 * Add theme support:
 * RSS links on the head
 * Menus
 * Thumbnails and custom thumbnail sizes
 */

add_theme_support('automatic-feed-links');
add_theme_support('menus');
add_theme_support('post-thumbnails', array('llibres', 'page'));
add_image_size('sidebar', 350, 9999);
add_image_size('portada-llibre', 250, 9999);
add_image_size('portada-llibre-small', 9999, 120);



/*
 * Load CSS, before the JS
 */

function css_enqueue() {
	// Styles
	wp_register_style('style', get_template_directory_uri() . "/style.css", false, '2.0a', 'all');
	// Load styles
	wp_enqueue_style('style');
}

add_action('wp_enqueue_scripts', 'css_enqueue', 11);



/*
 * Load jQuery from Google’s servers, on the footer, and not in the admin area
 */

function jquery_enqueue() {
	wp_deregister_script('jquery');
	wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js", false, null, true);
	wp_enqueue_script('jquery');
}

if (!is_admin()) add_action('wp_enqueue_scripts', 'jquery_enqueue', 12);



/*
 * Load the rest of the JS, after jQuery
 */

function js_enqueue() {
	// Head
	wp_register_script('html5shiv', get_template_directory_uri() . "/js/html5shiv.min.js", false, '3.6.2pre', false);
	wp_register_script('prefix-free', get_template_directory_uri() . "/js/prefixfree.min.js", false, '1.0.7', false);
	// Footer
	wp_register_script('retina', get_template_directory_uri() . "/js/retina.min.js", false, '0.0.2', true);
	// Load scripts
	wp_enqueue_script(array('html5shiv', 'retina'));
}

add_action('wp_enqueue_scripts', 'js_enqueue', 13);



/*
 * JS condicional IE, after all the other scripts
 */

function ie_conditional_js_enqueue() {
	echo '<!--[if lt IE 9]>';
	echo '<script type="text/javascript" src="' . get_template_directory_uri() . '/js/respond.js?ver=1.1.0"></script>';
	echo '<![endif]-->';
}

add_action('wp_head', 'ie_conditional_js_enqueue', 14);


/*
 * The header and menu classes
 */

function the_body_class($echo) {
	if (is_page()) {
		if (get_field('cm_section', get_the_ID()) == 'Col·loqui') {
			$body_class = 'entrevistes';
		} else {
			$body_class = clean_for_url(get_field('cm_section', get_the_ID()), false);
		}
	} elseif (is_singular('articles') || is_tax('articles')) {
		$body_class = 'articles';
	} elseif (is_singular('llibres') || is_tax('llibres')) {
		$body_class = 'llibres';
	}
	return $body_class;
}

function the_menu_class($the_class) {
	$body_class = the_body_class();
	if ($body_class != $the_class) {
		echo $the_class;
	} else {
		echo $the_class.' active';
	}
}



/*
 * Custom Post Types
 */

function add_custom_post_types() {
	register_post_type('articles', array(
		'label' => 'Articles',
		'description' => 'Articles Levante EMV',
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'menu_icon' => get_stylesheet_directory_uri() . '/img/blog-blue.png',
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug' => 'article', 'with_front' => false),
		'query_var' => true,
		'supports' => array(
			'title',
			'editor',
			'custom-fields',
			'revisions',
			'excerpt',
			'author',
		),
		'labels' => array (
			'name' => 'Articles',
			'singular_name' => 'Article',
			'menu_name' => 'Articles',
			'add_new' => 'Afegir nou',
			'add_new_item' => 'Afegir nou article',
			'edit' => 'Editar',
			'edit_item' => 'Editar article',
			'new_item' => 'Nou article',
			'view' => 'Vore',
			'view_item' => 'Vore article',
			'search_items' => 'Buscar articles',
			'not_found' => 'No hi ha articles',
			'not_found_in_trash' => 'No hi ha articles a la paperera',
		),
	)); // articles
	register_post_type('llibres', array(
		'label' => 'Llibres',
		'description' => 'Llibres de Carme Miquel',
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'menu_icon' => get_stylesheet_directory_uri() . '/img/blog-blue.png',
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug' => 'llibre', 'with_front' => false),
		'query_var' => true,
		'supports' => array(
			'title',
			'editor',
			'custom-fields',
			'revisions',
			'excerpt',
			'author',
		),
		'labels' => array (
			'name' => 'LLibres',
			'singular_name' => 'LLibre',
			'menu_name' => 'LLibres',
			'add_new' => 'Afegir nou',
			'add_new_item' => 'Afegir nou llibre',
			'edit' => 'Editar',
			'edit_item' => 'Editar llibre',
			'new_item' => 'Nou llibre',
			'view' => 'Vore',
			'view_item' => 'Vore llibre',
			'search_items' => 'Buscar llibres',
			'not_found' => 'No hi ha llibres',
			'not_found_in_trash' => 'No hi ha llibres a la paperera',
		),
	)); // llibres
}

add_action('init', 'add_custom_post_types');



/*
 * Custom Taxonomies
 */

function add_custom_taxanomies() {
	register_taxonomy('cat_articles', array('articles'), array(
		'hierarchical' => true,
		'labels' => array(
			'name' => _x('Camps', 'taxonomy general name'),
			'singular_name' => _x('Camp', 'taxonomy singular name'),
			'search_items' =>  __('Buscar camps'),
			'all_items' => __('Tots els camps'),
			'parent_item' => __('Camp pare'),
			'parent_item_colon' => __('Camp pare:'),
			'edit_item' => __('Editar camp'), 
			'update_item' => __('Actualitzar camp'),
			'add_new_item' => __('Afegir nou camp'),
			'new_item_name' => __('Nou nom de camp'),
			'menu_name' => __('Camps'),
		),
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array(
			'slug' => 'articles',
			'with_front' => false,
			'hierarchical' => true,
		),
		'singular_label' => 'Camp',
	)); //cat_articles
	register_taxonomy('public_llibres', array('llibres'), array(
		'hierarchical' => true,
		'labels' => array(
			'name' => _x('Public', 'taxonomy general name'),
			'singular_name' => _x('Public', 'taxonomy singular name'),
			'search_items' =>  __('Buscar publics'),
			'all_items' => __('Tots els publics'),
			'parent_item' => __('Public pare'),
			'parent_item_colon' => __('Public pare:'),
			'edit_item' => __('Editar public'), 
			'update_item' => __('Actualitzar public'),
			'add_new_item' => __('Afegir nou public'),
			'new_item_name' => __('Nou nom de public'),
			'menu_name' => __('Publics'),
		),
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array(
			'slug' => 'llibres',
			'with_front' => false,
			'hierarchical' => true,
		),
		'singular_label' => 'Public',
	)); // public_llibres
}

add_action('init', 'add_custom_taxanomies');



/*
 * Admin menu order
 */

function the_menu_order($menu_ord) {
	if (!$menu_ord) return true;
	return array(
		'index.php', // Dashboard Link
		'separator1',
		'edit.php?post_type=articles', // Articles
		'edit.php?post_type=llibres',  // Llibres
		'edit.php?post_type=page',     // Pages
		'edit.php',                    // Posts
	);
}

add_filter('custom_menu_order', 'the_menu_order');
add_filter('menu_order', 'the_menu_order');



/*
 * Add Custom Post Types and Custom Taxonomies to the Dashboard
 */

function add_custom_post_type_and_taxonomy_to_dashboard() {
	/* Custom Post Types */
	$post_types = get_post_types(array('_builtin' => false), 'objects');
	foreach ($post_types as $post_type) {
		$num_posts = wp_count_posts($post_type->name);
		$num = number_format_i18n($num_posts->publish);
		$text = _n($post_type->labels->singular_name, $post_type->labels->name, $num_posts->publish);
		if (current_user_can('edit_posts')) {
			$num = '<a href="edit.php?post_type=' . $post_type->name . '">' . $num . '</a>';
			$text = '<a href="edit.php?post_type=' . $post_type->name . '">' . $text . '</a>';
		}
		echo '<td class="first b b-' . $post_type->name . 's">' . $num . '</td>';
		echo '<td class="t ' . $post_type->name . 's">' . $text . '</td>';
		echo '</tr>';
		if ($num_posts->pending > 0) {
			$num = number_format_i18n($num_posts->pending);
			$text = _n($post_type->labels->singular_name . ' Pendent', $post_type->labels->name . ' Pendents', $num_posts->pending);
			if (current_user_can('edit_posts')) {
				$num = '<a href="edit.php?post_status=pending&post_type=' . $post_type->name . '">' . $num . '</a>';
				$text = '<a href="edit.php?post_status=pending&post_type=' . $post_type->name . '">' . $text . '</a>';
			}
			echo '<td class="first b b-' . $post_type->name . 's">' . $num . '</td>';
			echo '<td class="t ' . $post_type->name . 's">' . $text . '</td>';
			echo '</tr>';
		}
	}
	/* Custom Taxonomies */
	$taxonomies = get_taxonomies(array('_builtin' => false), 'objects');
	foreach ($taxonomies as $taxonomy) {
		$num_terms  = wp_count_terms($taxonomy->name);
		$num = number_format_i18n($num_terms);
		$text = _n($taxonomy->labels->singular_name, $taxonomy->labels->name, $num_terms);
		$associated_post_type = $taxonomy->object_type;
		if (current_user_can('manage_categories')) {
			$num = '<a href="edit-tags.php?taxonomy=' . $taxonomy->name . '&post_type=' . $associated_post_type[0] . '">' . $num . '</a>';
			$text = '<a href="edit-tags.php?taxonomy=' . $taxonomy->name . '&post_type=' . $associated_post_type[0] . '">' . $text . '</a>';
		}
		echo '<td class="first b b-' . $taxonomy->name . 's">' . $num . '</td>';
		echo '<td class="t ' . $taxonomy->name . 's">' . $text . '</td>';
		echo '</tr><tr>';
	}
}

add_action('right_now_content_table_end', 'add_custom_post_type_and_taxonomy_to_dashboard');



/*
 * Thumbnail with his own column on ‘llibres’ custom post type
 */

function llibres_column_thumb($column) {
	global $post;
	switch ($column) {
		case 'thumbnail':
			the_post_thumbnail();
		break;
	}
}

add_action('manage_llibres_posts_custom_column', 'llibres_column_thumb');



/*
* Columns for the Custom Post Types
*/

function articles_columns($columns) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => 'Article',
		'cat_articles' => 'Camps',
		'date' => 'Data'
	);
	return $columns;
}

function llibres_columns($columns) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => 'Llibre',
		'thumbnail' => 'Portada',
		'public_llibres' => 'Public',
		'date' => 'Data'
	);
	return $columns;
}

add_filter('manage_edit-articles_columns', 'articles_columns');
add_filter('manage_edit-llibres_columns', 'llibres_columns');



/*
 * Show Custom Taxonomies with a column at the posts view
 */

function articles_column($column_name, $post_id) {
	$taxonomy = $column_name;
	$post_type = get_post_type($post_id);
	$terms = get_the_terms($post_id, $taxonomy);
	if (!empty($terms)) {
		foreach ($terms as $term)
			$post_terms[] = "<a href='edit.php?post_type={$post_type}&{$taxonomy}={$term->slug}'> " . esc_html(sanitize_term_field('name', $term->name, $term->term_id, $taxonomy, 'edit')) . "</a>";
		echo join(', ', $post_terms);
	} else {
		echo '<i>No hi ha res ací</i>'; // No taxonomies
	}
}

add_action('manage_articles_posts_custom_column', 'articles_column', 10, 2);



/*
 * Make Custom Post Type columns sortable
 */

function sortable_columns() {
	return array(
		'title' => 'title',
		'cat_articles' => 'cat_articles',
		'public_llibres' => 'public_llibres',
		'date' => 'date'
	);
}

add_filter('manage_edit-articles_sortable_columns', 'sortable_columns');
add_filter('manage_edit-llibres_sortable_columns', 'sortable_columns');



/*
 * Taxonomy filter for manage posts page
 */

function taxonomy_filter_restrict_manage_posts() {
	global $typenow;
	$post_types = get_post_types(array('_builtin' => false));
	if (in_array($typenow, $post_types)) {
		$filters = get_object_taxonomies($typenow);
		foreach ($filters as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			wp_dropdown_categories(array(
				'show_option_all' => __('Mostrar tots els '.$tax_obj->label),
				'taxonomy' => $tax_slug,
				'name' => $tax_obj->name,
				'orderby' => 'name',
				'selected' => $_GET[$tax_slug],
				'hierarchical' => $tax_obj->hierarchical,
				'show_count' => false,
				'hide_empty' => true
			));
		}
	}
}

function taxonomy_filter_post_type_request($query) {
	global $pagenow, $typenow;
	if ('edit.php' == $pagenow) {
		$filters = get_object_taxonomies($typenow);
		foreach ($filters as $tax_slug) {
			$var = &$query->query_vars[$tax_slug];
			if (isset($var)) {
				$term = get_term_by('id', $var, $tax_slug);
				$var = $term->slug;
			}
		}
	}
}

add_action('restrict_manage_posts', 'taxonomy_filter_restrict_manage_posts');
add_filter('parse_query', 'taxonomy_filter_post_type_request');



/*
 * Prevent Wordpress from adding the attributes ‘width’ and ‘height’ to img elements
 */

function remove_width_attribute($html) {
	$html = preg_replace('/(width|height)="\d*"\s/', "", $html);
	return $html;
}

add_filter('post_thumbnail_html', 'remove_width_attribute', 10);
add_filter('image_send_to_editor', 'remove_width_attribute', 10);



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


/*
 * Required and recomended plugins
 */

require_once dirname(__FILE__) . '/plugin/class-tgm-plugin-activation.php';

function register_required_plugins() {
	$plugins = array(
		// Required
		array(
			'name' => 'Advanced Custom Fields',
			'slug' => 'advanced-custom-fields',
			'required' => true,
			'force_activation' => true,
			'force_deactivation' => false,
			'version' => '3.5',
		),
		// Recomended
		array(
			'name' => 'Wordpress SEO',
			'slug' => 'wordpress-seo',
			'required' => false,
			'force_activation' => false,
			'force_deactivation' => false,
		),
	);
	$config = array(
		'has_notices' => true,
		'is_automatic' => false,
		'message' => '',
		'strings' => array(
			'page_title' => 'Instal·lar plugins necessàris',
			'menu_title' => 'Instal·lar Plugins',
			'installing' => 'Instal·lant plugin: %1s.',
			'oops' => 'Alguna cosa no ha anat be amb la API de plugins.',
			'notice_can_install_required' => _n_noop('Aquest tema necessita el plugin: %1$s.', 'Aquest tema necessita els plugins: %1$s.'),
			'notice_can_install_recommended' => _n_noop('Aquest tema recomana el plugin: %1$s.', 'Aquest tema recomana els plugins: %1$s.'),
			'notice_cannot_install' => _n_noop('No tens els permisos necessàris per a instal·lar el plugin %1s. Contacta amb l’administrador per a sol·lucionar-ho.', 'No tens els permisos necessàris per a instal·lar els plugins %1s. Contacta amb l’administrador per a sol·lucionar-ho.'),
			'notice_can_activate_required' => _n_noop('El següent plugin necessàri està desactivat: %1$s.', 'Els següents plugins necessàris estàn desactivats: %1$s.'),
			'notice_can_activate_recommended' => _n_noop('El següent plugin recomanat està desactivat: %1$s.', 'Els següents plugins recomanats estàn desactivats: %1$s.'),
			'notice_cannot_activate' => _n_noop('No tens els permisos necessàris per a instal·lar el plugin %1s. Contacta amb l’administrador per a sol·lucionar-ho.', 'No tens els permisos necessàris per a instal·lar els plugins %1s. Contacta amb l’administrador per a sol·lucionar-ho.'),
			'notice_ask_to_update' => _n_noop('El següent plugin necesita ser actualizat per a asegurar el seu correcte funcionament amb el tema: %1$s.', 'Els següents plugin necesiten ser actualizats per a asegurar el seu correcte funcionament amb el tema: %1$s.'),
			'notice_cannot_update' => _n_noop('No tens els permisos necessàris per a actualitzar el plugin %1s. Contacta amb l’administrador per a sol·lucionar-ho.', 'No tens els permisos necessàris per a actualitzar els plugins %1s. Contacta amb l’administrador per a sol·lucionar-ho.'),
			'install_link' => _n_noop('Instal·la el plugin', 'Instal·la els plugins'),
			'activate_link' => _n_noop('Activa el plugin instal·lat', 'Activa los plugins instal·lats'),
			'return' => 'Tornar a l’instal·lador de plugins necessàris',
			'plugin_activated' => 'Plugin activat correctament. %1$s',
			'complete' => 'Tots els plugins s’han instal·lat i activat correctament. %1$s',
			'nag_type' => 'updated'
		)
	);
	tgmpa($plugins, $config);
}

add_action('tgmpa_register', 'register_required_plugins');



/*
 * Modify Wordpress’ visual editor (remove icons and reorganize)
 */

// TinyMCE: First line toolbar customizations
function base_extended_editor_mce_buttons($buttons) {
	// The settings are returned in this array. Customize to suite your needs.
	return array(
		'bold', 'italic', 'underline', 'separator', 'bullist', 'numlist', 'blockquote', 'separator', 'formatselect', 'separator', 'link', 'unlink', 'separator', 'wp_more', 'separator', 'pastetext', 'separator', 'undo', 'redo', 'separator', 'removeformat', 'spellchecker', 'fullscreen', 'charmap', 'wp_help'
	);
	/* WordPress Default:
	return array(
		'bold', 'italic', 'strikethrough', 'separator', 'bullist', 'numlist', 'blockquote', 'separator', 'justifyleft', 'justifycenter', 'justifyright', 'separator', 'link', 'unlink', 'wp_more', 'separator', 'spellchecker', 'fullscreen', 'wp_adv'
	); */
}

add_filter('mce_buttons', 'base_extended_editor_mce_buttons', 0);
 
// TinyMCE: Second line toolbar customizations
function base_extended_editor_mce_buttons_2($buttons) {
	// The settings are returned in this array. Customize to suite your needs. An empty array is used here because I remove the second row of icons.
	return array();
	/* WordPress Default:
	return array(
		'formatselect', 'underline', 'justifyfull', 'forecolor', 'separator', 'pastetext', 'pasteword', 'removeformat', 'separator', 'media', 'charmap', 'separator', 'outdent', 'indent', 'separator', 'undo', 'redo', 'wp_help'
	); */
}

add_filter('mce_buttons_2', 'base_extended_editor_mce_buttons_2', 0);

// Customize the format dropdown items
function base_custom_mce_format($init) {
	// Add block format elements you want to show in dropdown
	$init['theme_advanced_blockformats'] = 'p,h2,h3,h4,h5,h6';
	// Add elements not included in standard tinyMCE dropdown p,h1,h2,h3,h4,h5,h6
	//$init['extended_valid_elements'] = 'code[*]';
	return $init;
}

add_filter('tiny_mce_before_init', 'base_custom_mce_format');