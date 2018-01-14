<?php # -*- coding: utf-8 -*-

namespace TheDramatist\Ogive\Assets;

if ( ! defined( 'ABSPATH' ) ) {
	return; // Exit if called directly.
}

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
			plugin_dir_url( __FILE__ ) . '../../assets/css/style.css',
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
			plugin_dir_url( __FILE__ ) . '../../assets/js/system.js',
			[ 'jquery' ],
			'1.0.0',
			true
		);
		// Local JS data
		$local_js_data = apply_filters( 'ogive_local_js_data', [
			'ajax_url'      => admin_url( 'admin-ajax.php' ),
			'site_url'      => site_url(),
			'sites'         => $this->get_sites(),
			'data_types'    => [
				'posts'          => __( 'Posts' ),
				'comments'       => __( 'Comments' ),
				'users'          => __( 'Users' ),
			],
			'refresh_time'  => 60000, // 60*1000 ms = 60s or 1 minute
		] );
		// Pass data to myscript.js on page load
		wp_localize_script(
			'ogive-js',
			'OgiveAjaxObj',
			$local_js_data
		);
		// Enqueueing JS file.
		wp_enqueue_script( 'ogive-js' );

	}

	/**
	 * Wrapper method for get_sites().
	 *
	 * @return array
	 */
	public function get_sites() {
		$sites = get_sites();
		$data  = [];
		foreach ( $sites as $value ) {
			$data[] = $value->path;
		}
		return $data;
	}
}
