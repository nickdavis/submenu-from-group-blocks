<?php
/**
 * Plugin Name: Submenu from Group Blocks
 * Plugin URI: https://github.com/nickdavis/submenu-from-group-block-ids
 * Description: Generates a submenu from Group block ID attributes in the WordPress block editor. Requires developer setup.
 * Version: 1.0.0
 * Author: Nick Davis
 * Author URI: https://nickdavis.net
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation. You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

namespace NickDavis\SubmenuGroupBlocks;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Cheatin&#8217; uh?' );
}

/**
 * Sets up the plugin's constants.
 *
 * @since 1.0.0
 *
 * @return void
 */
function constants() {
	$plugin_url = plugin_dir_url( __FILE__ );

	if ( is_ssl() ) {
		$plugin_url = str_replace( 'http://', 'https://', $plugin_url );
	}

	if ( ! defined( 'ND_SUBMENU_GROUP_BLOCKS_DIR' ) ) {
		define( 'ND_SUBMENU_GROUP_BLOCKS_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
	}

	if ( ! defined( 'ND_SUBMENU_GROUP_BLOCKS_URL' ) ) {
		define( 'ND_SUBMENU_GROUP_BLOCKS_URL', $plugin_url );
	}

	if ( ! defined( 'ND_SUBMENU_GROUP_BLOCKS_FILE' ) ) {
		define( 'ND_SUBMENU_GROUP_BLOCKS_FILE', __FILE__ );
	}
}

/**
 * Autoloads files.
 *
 * @since 1.0.0
 *
 * @return void
 */
function autoload() {
	$autoloader = ND_SUBMENU_GROUP_BLOCKS_DIR . 'vendor/autoload.php';

	if ( is_readable( $autoloader ) ) {
		require_once $autoloader;
	} else {
		// Composer autoloader apparently was not found, so fall back to our bundled
		// autoloader.
		require_once __DIR__ . '/src/Autoloader.php';

		( new Autoloader() )
			->add_namespace( __NAMESPACE__, __DIR__ . '/src' )
			->register();
	}
}

add_action( 'plugins_loaded', __NAMESPACE__ . '\launch' );
/**
 * Launches the plugin.
 *
 * @since 1.0.0
 *
 * @return void
 */
function launch() {
	constants();
	autoload();
	( new Plugin )->run();
}
