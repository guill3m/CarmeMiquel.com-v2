<?php
/*
Plugin Name: CM2 Post Types & Taxonomies
Version: 1.0
Author: Guillem Andreu
Author URI: http://guillemandreu.com
Description: Custom post types and custom taxonomies
*/



/*
 * Custom Post Types
 */

function cm2_custom_post_types() {

	$articles_labels = array(
		'name'               => 'Articles',
		'singular_name'      => 'Article',
		'menu_name'          => 'Articles',
		'add_new'            => 'Afegir nou',
		'add_new_item'       => 'Afegir nou article',
		'edit'               => 'Editar',
		'edit_item'          => 'Editar article',
		'new_item'           => 'Nou article',
		'view'               => 'Vore',
		'view_item'          => 'Vore article',
		'search_items'       => 'Buscar articles',
		'not_found'          => 'No hi ha articles',
		'not_found_in_trash' => 'No hi ha articles a la paperera'
	);
	$articles_supports = array(
		'title',
		'editor',
		'custom-fields'
	);
	$articles_rewrite = array(
		'slug'       => 'article',
		'with_front' => false
	);
	$articles_args = array(
		'labels'          => $articles_labels,
		'description'     => 'Articles de Carme Miquel a Levante EMV',
		'public'          => true,
		'capability_type' => 'post',
		'hierarchical'    => false,
		'supports'        => $articles_supports,
		'has_archive'     => false,
		'rewrite'         => $articles_rewrite
	);

	$entrevistes_labels = array(
		'name'               => 'Entrevistes',
		'singular_name'      => 'Entrevista',
		'menu_name'          => 'Entrevistes',
		'add_new'            => 'Afegir nova',
		'add_new_item'       => 'Afegir nova entrevista',
		'edit'               => 'Editar',
		'edit_item'          => 'Editar entrevista',
		'new_item'           => 'Nova entrevista',
		'view'               => 'Vore',
		'view_item'          => 'Vore entrevista',
		'search_items'       => 'Buscar entrevistes',
		'not_found'          => 'No hi ha entrevistes',
		'not_found_in_trash' => 'No hi ha entrevistes a la paperera'
	);
	$entrevistes_supports = array(
		'title',
		'editor',
		'custom-fields',
		'post-formats'
	);
	$entrevistes_rewrite = array(
		'slug'       => 'entrevista',
		'with_front' => false,
		'feeds'      => false
	);
	$entrevistes_args = array(
		'labels' => $entrevistes_labels,
		'description'     => 'Entrevistes a Carme Miquel',
		'public'          => true,
		'capability_type' => 'post',
		'hierarchical'    => false,
		'supports'        => $entrevistes_supports,
		'has_archive'     => false,
		'rewrite'         => $entrevistes_rewrite
	);

	$llibres_labels = array(
		'name'               => 'Llibres',
		'singular_name'      => 'Llibre',
		'menu_name'          => 'Llibres',
		'add_new'            => 'Afegir nou',
		'add_new_item'       => 'Afegir nou llibre',
		'edit'               => 'Editar',
		'edit_item'          => 'Editar llibre',
		'new_item'           => 'Nou llibre',
		'view'               => 'Vore',
		'view_item'          => 'Vore llibre',
		'search_items'       => 'Buscar llibres',
		'not_found'          => 'No hi ha llibres',
		'not_found_in_trash' => 'No hi ha llibres a la paperera'
	);
	$llibres_supports = array(
		'title',
		'editor',
		'thumbnail',
		'custom-fields',
		'page-attributes'
	);
	$llibres_rewrite = array(
		'slug'       => 'llibre',
		'with_front' => false,
		'feeds'      => false
	);
	$llibres_args = array(
		'labels' => $llibres_labels,
		'description'     => 'Llibres de Carme Miquel',
		'public'          => true,
		'capability_type' => 'post',
		'hierarchical'    => true,
		'supports'        => $llibres_supports,
		'has_archive'     => false,
		'rewrite'         => $llibres_rewrite
	);

	$videos_labels = array(
		'name'               => 'Vídeos',
		'singular_name'      => 'Vídeo',
		'menu_name'          => 'Vídeos',
		'add_new'            => 'Afegir nou',
		'add_new_item'       => 'Afegir nou vídeo',
		'edit'               => 'Editar',
		'edit_item'          => 'Editar vídeo',
		'new_item'           => 'Nou vídeo',
		'view'               => 'Vore',
		'view_item'          => 'Vore vídeo',
		'search_items'       => 'Buscar vídeos',
		'not_found'          => 'No hi ha vídeos',
		'not_found_in_trash' => 'No hi ha vídeos a la paperera'
	);
	$videos_supports = array(
		'title',
		'editor',
		'thumbnail',
		'custom-fields'
	);
	$videos_rewrite = array(
		'slug'       => 'video',
		'with_front' => false,
		'feeds'      => false
	);
	$videos_args = array(
		'labels' => $videos_labels,
		'description'     => 'Vídeos de llibres de Carme Miquel',
		'public'          => true,
		'capability_type' => 'post',
		'hierarchical'    => false,
		'supports'        => $videos_supports,
		'has_archive'     => false,
		'rewrite'         => $videos_rewrite
	);

	register_post_type('articles', $articles_args);
	register_post_type('entrevistes', $entrevistes_args);
	register_post_type('llibres', $llibres_args);
	register_post_type('videos', $videos_args);

}

add_action('init', 'cm2_custom_post_types');



/*
 * Custom post types messages
 */

function cm2_custom_post_types_messages($messages) {
	global $post, $post_ID;

	$messages['articles'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf('Article actualitzat. <a href="%s">Vore article</a>', esc_url(get_permalink($post_ID))),
		2 => 'Camp personalitzat actualitzat.',
		3 => 'Camp personalitzat el·liminat.',
		4 => 'Article actualitzat.',
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf('Article restaurat a la revisió de %s', wp_post_revision_title((int) $_GET['revision'], false)) : false,
		6 => sprintf('Article publicat. <a href="%s">Vore article</a>', esc_url(get_permalink($post_ID))),
		7 => 'Article guardat.',
		8 => sprintf('Article enviat. <a target="_blank" href="%s">Vore article</a>', esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
		9 => sprintf('Article programat per a: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Previsualitzar article</a>',
			// translators: Publish box date format, see http://php.net/date
			date_i18n('M j, Y @ G:i', strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
		10 => sprintf('Esborrany de l’article actualitzat. <a target="_blank" href="%s">Previsualitzar article</a>', esc_url(add_query_arg( 'preview', 'true', get_permalink($post_ID)))),
	);

$messages['entrevites'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf('Entrevista actualitzada. <a href="%s">Vore entrevista</a>', esc_url(get_permalink($post_ID))),
		2 => 'Camp personalitzat actualitzat.',
		3 => 'Camp personalitzat el·liminat.',
		4 => 'Entrevista actualitzada.',
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf('Entrevista restaurada a la revisió de %s', wp_post_revision_title((int) $_GET['revision'], false)) : false,
		6 => sprintf('Entrevista publicada. <a href="%s">Vore entrevista</a>', esc_url(get_permalink($post_ID))),
		7 => 'Entrevista guardada.',
		8 => sprintf('Entrevista enviada. <a target="_blank" href="%s">Vore entrevista</a>', esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
		9 => sprintf('Entrevista programada per a: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Previsualitzar entrevista</a>',
			// translators: Publish box date format, see http://php.net/date
			date_i18n('M j, Y @ G:i', strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
		10 => sprintf('Esborrany de l’entrevista actualitzat. <a target="_blank" href="%s">Previsualitzar entrevista</a>', esc_url(add_query_arg( 'preview', 'true', get_permalink($post_ID)))),
	);

	$messages['llibres'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf('Llibre actualitzat. <a href="%s">Vore llibre</a>', esc_url(get_permalink($post_ID))),
		2 => 'Camp personalitzat actualitzat.',
		3 => 'Camp personalitzat el·liminat.',
		4 => 'Llibre actualitzat.',
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf('Llibre restaurat a la revisió de %s', wp_post_revision_title((int) $_GET['revision'], false)) : false,
		6 => sprintf('Llibre publicat. <a href="%s">Vore llibre</a>', esc_url(get_permalink($post_ID))),
		7 => 'Llibre guardat.',
		8 => sprintf('Llibre enviat. <a target="_blank" href="%s">Vore llibre</a>', esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
		9 => sprintf('Llibre programat per a: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Previsualitzar llibre</a>',
			// translators: Publish box date format, see http://php.net/date
			date_i18n('M j, Y @ G:i', strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
		10 => sprintf('Esborrany del llibre actualitzat. <a target="_blank" href="%s">Previsualitzar llibre</a>', esc_url(add_query_arg( 'preview', 'true', get_permalink($post_ID)))),
	);

	return $messages;
}

add_filter('post_updated_messages', 'cm2_custom_post_types_messages');



/*
 * Custom Taxonomies
 */

function cm2_custom_taxanomies() {

	$cat_articles_labels = array(
		'name'                  => 'Categories',
		'singular_name'         => 'Categoria',
		'menu_name'             => 'Categories',
		'all_items'             => 'Totes les categories',
		'edit_item'             => 'Editar categoria',
		'view_item'             => 'Vore categoria',
		'update_item'           => 'Actualitzar categoria',
		'add_new_item'          => 'Afegir nova categoria',
		'new_item_name'         => 'Nou nom de categoria',
		'parent_item'           => 'Categoria mare',
		'parent_item_colon'     => 'Categoria mare:',
		'search_items'          => 'Buscar categories',
		'popular_items'         => 'Categories més utilitzades',
		'add_or_remove_items'   => 'Afegir o llevar categories',
		'choose_from_most_used' => 'Sel·leccionar de les categories més utilitzades',
		'not_found'             => 'No s’han trobat categories'
	);
	$cat_articles_rewrite = array(
		'slug'         => 'articles',
		'with_front'   => false,
		'hierarchical' => true
	);
	$cat_articles_args = array(
		'labels'            => $cat_articles_labels,
		'public'            => true,
		'show_admin_column' => true,
		'hierarchical'      => true,
		'rewrite'           => $cat_articles_rewrite,
		'sort'              => false
	);

	$public_llibres_labels = array(
		'name'                  => 'Públics',
		'singular_name'         => 'Públic',
		'menu_name'             => 'Públics',
		'all_items'             => 'Tots els públics',
		'edit_item'             => 'Editar públic',
		'view_item'             => 'Vore Públic',
		'update_item'           => 'Actualitzar públic',
		'add_new_item'          => 'Afegir nou públic',
		'new_item_name'         => 'Nou nom de públic',
		'parent_item'           => 'Públic pare',
		'parent_item_colon'     => 'Públic pare:',
		'search_items'          => 'Buscar públics',
		'popular_items'         => 'Públics més utilitzats',
		'add_or_remove_items'   => 'Afegir o llevar públics',
		'choose_from_most_used' => 'Sel·leccionar dels públics més utilitzats',
		'not_found'             => 'No s’han trobat públics'
	);
	$public_llibres_rewrite = array(
		'slug'         => 'llibres',
		'with_front'   => false,
		'hierarchical' => true
	);
	$public_llibres_args = array(
		'labels'            => $public_llibres_labels,
		'public'            => true,
		'show_admin_column' => true,
		'hierarchical'      => true,
		'rewrite'           => $public_llibres_rewrite,
		'sort'              => false
	);

	register_taxonomy('cat_articles', 'articles', $cat_articles_args);
	register_taxonomy('public_llibres', 'llibres', $public_llibres_args);

}

add_action('init', 'cm2_custom_taxanomies');



/*
 * Thumbnail with his own column on ‘llibres’ custom post type
 */

function cm2_llibres_column_thumb($column) {
	global $post;
	switch ($column) {
		case 'thumbnail':
			the_post_thumbnail();
		break;
	}
}

add_action('manage_llibres_posts_custom_column', 'cm2_llibres_column_thumb');



/*
* Columns for the Custom Post Types
*/

function cm2_llibres_columns($columns) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => 'Llibre',
		'thumbnail' => 'Portada',
		'public_llibres' => 'Public',
		'date' => 'Data'
	);
	return $columns;
}

add_filter('manage_edit-llibres_columns', 'cm2_llibres_columns');



/*
 * Add custom post types and custom taxonomies to the “right now” dashboard widget
 */

function cm2_add_to_right_now_widget() {
	/* Post Types */
	$post_types = get_post_types(array('_builtin' => false), 'objects');
	foreach ($post_types as $post_type) {
		if ($post_type->name == 'acf') continue; // Don0t show the Advanced Custom Fields plugin’s custom type
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
			$text = _n($post_type->labels->singular_name . ' Pendiente', $post_type->labels->name . ' Pendientes', $num_posts->pending);
			if (current_user_can('edit_posts')) {
				$num = '<a href="edit.php?post_status=pending&post_type=' . $post_type->name . '">' . $num . '</a>';
				$text = '<a href="edit.php?post_status=pending&post_type=' . $post_type->name . '">' . $text . '</a>';
			}
			echo '<td class="first b b-' . $post_type->name . 's">' . $num . '</td>';
			echo '<td class="t ' . $post_type->name . 's">' . $text . '</td>';
			echo '</tr>';
		}
	}
	/* Taxonomies */
	$taxonomies = get_taxonomies(array('_builtin' => false), 'objects');
	foreach ($taxonomies as $taxonomy) {
		$num_terms = wp_count_terms($taxonomy->name);
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

add_action('right_now_content_table_end', 'cm2_add_to_right_now_widget');



/*
 * Hability to filter custom post types by custom taxonomies on the “all posts” admin page
 */

function cm2_taxonomy_filter_restrict_manage_posts() {
	global $typenow;
	$post_types = get_post_types(array('_builtin' => false));
	if (in_array($typenow, $post_types)) {
		$filters = get_object_taxonomies($typenow);
		foreach ($filters as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			wp_dropdown_categories(array(
				'show_option_all' => $tax_obj->label,
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

add_action('restrict_manage_posts', 'cm2_taxonomy_filter_restrict_manage_posts');


function cm2_taxonomy_filter_post_type_request($query) {
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

add_filter('parse_query', 'cm2_taxonomy_filter_post_type_request');