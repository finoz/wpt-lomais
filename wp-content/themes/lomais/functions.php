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

// DEBUG TEMPORANEO — rimuovere dopo la diagnosi
add_action( 'wp_head', function () {
    $port  = defined( 'FICUS_VITE_PORT' ) ? (int) FICUS_VITE_PORT : 5173;
    $socks = [];
    foreach ( [ 'localhost', 'host.docker.internal' ] as $h ) {
        $c = @fsockopen( $h, $port, $errno, $errstr, 0.5 );
        $socks[ $h ] = is_resource( $c ) ? 'OPEN' : 'CLOSED';
        if ( is_resource( $c ) ) fclose( $c );
    }
    $manifest_path = get_stylesheet_directory() . '/assets/dist/.vite/manifest.json';
    echo '<!-- FICUS-DEBUG'
        . ' vite_dev='    . ( ficus_is_vite_dev() ? 'true' : 'false' )
        . ' manifest='    . ( file_exists( $manifest_path ) ? 'YES' : 'NO' )
        . ' fsock='       . json_encode( $socks )
        . ' WP_DEBUG='    . ( defined( 'WP_DEBUG' ) && WP_DEBUG ? 'true' : 'false' )
        . " -->\n";
} );

add_action( 'after_setup_theme', function () {
    new Ficus_GitHub_Updater(
        'lomais',
        'finoz/wpt-lomais',
        wp_get_theme()->get( 'Version' )
    );
} );
