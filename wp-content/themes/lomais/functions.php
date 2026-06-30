<?php
/**
 * Lomais — child theme di Ficus
 */

defined( 'ABSPATH' ) || exit;

add_action( 'wp_enqueue_scripts', function () {
    ficus_enqueue_assets(
        get_stylesheet_directory(),
        get_stylesheet_directory_uri(),
        wp_get_theme()->get( 'Version' )
    );
} );

add_action( 'after_setup_theme', function () {
    ficus_add_editor_styles(
        get_stylesheet_directory(),
        get_stylesheet_directory_uri()
    );
    new Ficus_GitHub_Updater(
        'lomais',
        'finoz/wpt-lomais',
        wp_get_theme()->get( 'Version' )
    );
} );
