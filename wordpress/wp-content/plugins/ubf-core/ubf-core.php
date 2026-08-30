<?php
/**
 * Plugin Name: UBF Core
 * Description: Portable content model for the UBF Köln website. Registers sermons, events, and their structured metadata without presentation logic.
 * Version: 0.1.0
 * Requires at least: 6.6
 * Requires PHP: 7.4
 * Author: UBF Köln
 * Text Domain: ubf-core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register portable content types.
 */
function ubf_core_register_post_types() {
	register_post_type(
		'ubf_sermon',
		array(
			'labels' => array(
				'name'               => __( 'Predigten', 'ubf-core' ),
				'singular_name'      => __( 'Predigt', 'ubf-core' ),
				'add_new_item'       => __( 'Predigt hinzufügen', 'ubf-core' ),
				'edit_item'          => __( 'Predigt bearbeiten', 'ubf-core' ),
				'new_item'           => __( 'Neue Predigt', 'ubf-core' ),
				'view_item'          => __( 'Predigt ansehen', 'ubf-core' ),
				'search_items'       => __( 'Predigten durchsuchen', 'ubf-core' ),
				'not_found'          => __( 'Keine Predigten gefunden.', 'ubf-core' ),
				'not_found_in_trash' => __( 'Keine Predigten im Papierkorb gefunden.', 'ubf-core' ),
				'all_items'          => __( 'Alle Predigten', 'ubf-core' ),
				'menu_name'          => __( 'Predigten', 'ubf-core' ),
			),
			'public'              => true,
			'show_in_rest'        => true,
			'has_archive'         => 'predigten',
			'rewrite'             => array(
				'slug'       => 'predigten',
				'with_front' => false,
			),
			'menu_icon'           => 'dashicons-microphone',
			'menu_position'       => 20,
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields' ),
			'taxonomies'          => array( 'ubf_sermon_series' ),
			'show_in_nav_menus'   => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
		)
	);

	register_post_type(
		'ubf_event',
		array(
			'labels' => array(
				'name'               => __( 'Veranstaltungen', 'ubf-core' ),
				'singular_name'      => __( 'Veranstaltung', 'ubf-core' ),
				'add_new_item'       => __( 'Veranstaltung hinzufügen', 'ubf-core' ),
				'edit_item'          => __( 'Veranstaltung bearbeiten', 'ubf-core' ),
				'new_item'           => __( 'Neue Veranstaltung', 'ubf-core' ),
				'view_item'          => __( 'Veranstaltung ansehen', 'ubf-core' ),
				'search_items'       => __( 'Veranstaltungen durchsuchen', 'ubf-core' ),
				'not_found'          => __( 'Keine Veranstaltungen gefunden.', 'ubf-core' ),
				'not_found_in_trash' => __( 'Keine Veranstaltungen im Papierkorb gefunden.', 'ubf-core' ),
				'all_items'          => __( 'Alle Veranstaltungen', 'ubf-core' ),
				'menu_name'          => __( 'Veranstaltungen', 'ubf-core' ),
			),
			'public'              => true,
			'show_in_rest'        => true,
			'has_archive'         => 'veranstaltungen',
			'rewrite'             => array(
				'slug'       => 'veranstaltungen',
				'with_front' => false,
			),
			'menu_icon'           => 'dashicons-calendar-alt',
			'menu_position'       => 21,
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields' ),
			'show_in_nav_menus'   => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
		)
	);
}
add_action( 'init', 'ubf_core_register_post_types' );

/**
 * Register sermon-series taxonomy separately so WordPress understands the
 * post-type/taxonomy relationship in all query contexts.
 */
function ubf_core_register_taxonomies() {
	register_taxonomy(
		'ubf_sermon_series',
		array( 'ubf_sermon' ),
		array(
			'labels' => array(
				'name'          => __( 'Predigtreihen', 'ubf-core' ),
				'singular_name' => __( 'Predigtreihe', 'ubf-core' ),
				'search_items'  => __( 'Predigtreihen durchsuchen', 'ubf-core' ),
				'all_items'     => __( 'Alle Predigtreihen', 'ubf-core' ),
				'edit_item'     => __( 'Predigtreihe bearbeiten', 'ubf-core' ),
				'update_item'   => __( 'Predigtreihe aktualisieren', 'ubf-core' ),
				'add_new_item'  => __( 'Predigtreihe hinzufügen', 'ubf-core' ),
				'menu_name'     => __( 'Predigtreihen', 'ubf-core' ),
			),
			'public'            => true,
			'hierarchical'      => true,
			'show_in_rest'      => true,
			'show_admin_column' => true,
			'rewrite'           => array(
				'slug'       => 'predigtreihen',
				'with_front' => false,
			),
		)
	);
}
add_action( 'init', 'ubf_core_register_taxonomies' );

/**
 * Authorize REST/editor writes to structured fields per post.
 *
 * @param bool   $allowed  Existing authorization result.
 * @param string $meta_key Meta key.
 * @param int    $post_id  Post ID.
 * @param int    $user_id  User ID.
 * @param string $cap      Requested capability.
 * @param array  $caps     Primitive capabilities.
 * @return bool
 */
function ubf_core_can_edit_meta( $allowed, $meta_key, $post_id, $user_id, $cap, $caps ) {
	return current_user_can( 'edit_post', $post_id );
}

/**
 * Register structured metadata. These fields intentionally contain no
 * front-end rendering; templates or later purpose-built blocks may consume
 * them through the WordPress data/REST APIs.
 */
function ubf_core_register_meta() {
	$common = array(
		'single'            => true,
		'show_in_rest'      => true,
		'revisions_enabled' => true,
		'auth_callback'     => 'ubf_core_can_edit_meta',
	);

	register_post_meta(
		'ubf_sermon',
		'ubf_bible_passage',
		array_merge(
			$common,
			array(
				'type'              => 'string',
				'description'       => __( 'Bible passage or reference for the sermon.', 'ubf-core' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		)
	);

	register_post_meta(
		'ubf_sermon',
		'ubf_speaker',
		array_merge(
			$common,
			array(
				'type'              => 'string',
				'description'       => __( 'Speaker name for the sermon.', 'ubf-core' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		)
	);

	register_post_meta(
		'ubf_sermon',
		'ubf_media_url',
		array_merge(
			$common,
			array(
				'type'              => 'string',
				'description'       => __( 'Canonical audio or video URL for the sermon.', 'ubf-core' ),
				'sanitize_callback' => 'esc_url_raw',
			)
		)
	);

	register_post_meta(
		'ubf_event',
		'ubf_start_at',
		array_merge(
			$common,
			array(
				'type'              => 'string',
				'description'       => __( 'Event start date/time in ISO 8601 format.', 'ubf-core' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		)
	);

	register_post_meta(
		'ubf_event',
		'ubf_end_at',
		array_merge(
			$common,
			array(
				'type'              => 'string',
				'description'       => __( 'Event end date/time in ISO 8601 format.', 'ubf-core' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		)
	);

	register_post_meta(
		'ubf_event',
		'ubf_location',
		array_merge(
			$common,
			array(
				'type'              => 'string',
				'description'       => __( 'Verified event location text.', 'ubf-core' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		)
	);

	register_post_meta(
		'ubf_event',
		'ubf_registration_url',
		array_merge(
			$common,
			array(
				'type'              => 'string',
				'description'       => __( 'Optional canonical registration URL.', 'ubf-core' ),
				'sanitize_callback' => 'esc_url_raw',
			)
		)
	);
}
add_action( 'init', 'ubf_core_register_meta' );

/**
 * Flush rewrites only when lifecycle changes require it, never on each request.
 */
function ubf_core_activate() {
	ubf_core_register_post_types();
	ubf_core_register_taxonomies();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'ubf_core_activate' );

/**
 * Remove the registered routes before flushing. Content itself is retained.
 */
function ubf_core_deactivate() {
	if ( post_type_exists( 'ubf_sermon' ) ) {
		unregister_post_type( 'ubf_sermon' );
	}
	if ( post_type_exists( 'ubf_event' ) ) {
		unregister_post_type( 'ubf_event' );
	}
	if ( taxonomy_exists( 'ubf_sermon_series' ) ) {
		unregister_taxonomy( 'ubf_sermon_series' );
	}
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'ubf_core_deactivate' );
