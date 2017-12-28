<?php # -*- coding: utf-8 -*-

namespace TheDramatist\Ogive\Assets;

/**
 * Class AssetsEnqueue
 *
 * @package TheDramatist\Ogive\Assets
 */
class AssetsEnqueue {

	/**
	 * AssetsEnqueue constructor.
	 */
	public function __construct() {

	}

	/**
	 * Enqueueing scripts and styles.
	 * @return void
	 */
	public function init() {
		add_action( 'wp_enqueue_scripts', [ $this, 'styles' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'scripts' ] );
	}

	/**
	 * Enqueueing styles.
	 * @return void
	 */
	public function styles() {
		wp_enqueue_style(
			'ogive-css',
			plugin_dir_url( __FILE__ ) . '../../assets/css/ogive.css',
			null,
			'1.0.0',
			'all'
		);
	}

	/**
	 * Enqueueing scripts.
	 * @return void
	 */
	public function scripts() {
		// Registering the script.
		wp_register_script(
			'ogive-js',
			plugin_dir_url( __FILE__ ) . '../../assets/js/ogive.js',
			[ 'jquery' ],
			'1.0.0',
			true
		);
		// Local JS data
		$local_js_data = array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
		);
		// Pass data to myscript.js on page load
		wp_localize_script(
			'ogive-js',
			'TheDramatist\OgiveAjaxObj',
			$local_js_data
		);
		// Enqueueing JS file.
		wp_enqueue_script( 'ogive-js' );

	}
}
