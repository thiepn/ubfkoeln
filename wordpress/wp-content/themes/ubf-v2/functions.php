<?php
/**
 * Theme bootstrap for UBF Köln V2.
 *
 * Durable content and business logic belong in UBF Core, not in this theme.
 *
 * @package UBF_V2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register editor/front-end theme supports.
 */
function ubf_v2_setup() {
	add_theme_support( 'editor-styles' );
	add_editor_style( 'style.css' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
}
add_action( 'after_setup_theme', 'ubf_v2_setup' );

/**
 * Load the small amount of CSS that sits outside theme.json.
 */
function ubf_v2_enqueue_styles() {
	$theme = wp_get_theme();
	wp_enqueue_style(
		'ubf-v2',
		get_stylesheet_uri(),
		array(),
		$theme->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'ubf_v2_enqueue_styles' );
