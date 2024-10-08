<?php
/**
 * Plugin Name: Starkstrom Anmeldung
 * Description: Plugin für die Anmeldung bei Starkstrom über WordPress
 * Author: Richard Keutler / Henri Priller / Noah Kolb
 * Version: 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
define( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'API_URL', 'http://localhost:8080/api' );

require_once( PLUGIN_PATH . "model/anmeldung.php" );require_once(PLUGIN_PATH . "model/anmeldung.php");

function starkstrom_layout_categories( $categories ): array {
	$new = [
		'starkstrom' => [
			'slug'  => 'starkstrom',
			'title' => 'Starkstrom Blöcke',
		]
	];

	$exists = false;
	foreach ( $categories as $category ) {
		if ( isset( $category['slug'] ) && $category['slug'] === 'starkstrom' ) {
			$exists = true;
			break;
		}
	}

	if ( ! $exists ) {
		$position   = 2;
		$categories = array_slice( $categories, 0, $position, true ) + $new + array_slice( $categories, $position, null, true );
	}

	return array_values( $categories );
}

add_filter( 'block_categories_all', 'starkstrom_layout_categories' );

function starkstrom_register_blocks(): void {
	$blocks_dir = __DIR__ . '/build/blocks';
	$blocks     = array_filter( glob( $blocks_dir . '/*' ), 'is_dir' );

	foreach ( $blocks as $block ) {
		register_block_type( $block );
	}
}

add_action( 'init', 'starkstrom_register_blocks' );

function makeAnmeldung() : void {
    (new Mod_Application())->makeAnmeldung();
}

add_action('wp_ajax_handle_anmeldung_form_submission', 'makeAnmeldung');
add_action('wp_ajax_nopriv_handle_anmeldung_form_submission', 'makeAnmeldung');