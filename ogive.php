<?php # -*- coding: utf-8 -*-

/**
 * Plugin Name: Ogive
 * Description: A widget plugin to show site statistics in frontend.
 * Plugin URI:  https://github.com/rnaby
 * Author:      TheDramatist
 * Author URI:  http://thedramatist.me/
 * Version:     dev-master
 * License:     GPL-2.0
 * Text Domain: ogive
 */

namespace TheDramatist\Ogive;

/**
 * Initialize a hook on plugin activation.
 *
 * @return void
 */
function activate() {
     do_action( 'ogive_plugin_activate' );
}
register_activation_hook( __FILE__, __NAMESPACE__ . '\\activate' );

/**
 * Initialize a hook on plugin deactivation.
 *
 * @return void
 */
function deactivate() {
     do_action( 'ogive_plugin_deactivate' );
}
register_activation_hook( __FILE__, __NAMESPACE__ . '\\deactivate' );

/**
 * Initialize all the plugin things.
 *
 * @return void
 * @throws \Throwable
 */
function initialize() {

	try {
		/**
		 * Checking if vendor/autoload.php exists or not.
		 */
		if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
			/** @noinspection PhpIncludeInspection */
			require_once __DIR__ . '/vendor/autoload.php';
		}

		/**
		 * Calling modules.
		 */
		( new Assets\AssetsEnqueue() )->init();
		( new Widget\InitWidget() )->init();
		( new ConfigAPI\ConfigAPI() )->init();

	} catch ( \Throwable $throwable ) {
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			throw $throwable;
		}
		do_action( 'ogive_error', $throwable );
	}
}

add_action( 'plugins_loaded', __NAMESPACE__ . '\\initialize' );
