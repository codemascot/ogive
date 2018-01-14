<?php # -*- coding: utf-8 -*-

namespace TheDramatist\Ogive\Widget;

if ( ! defined( 'ABSPATH' ) ) {
	return; // Exit called directly.
}

/**
 * Class InitWidget
 *
 * @package TheDramatist\Ogive\Widget
 */
class InitWidget {

	/**
	 * @var string
	 */
	private $widget = '';

	/**
	 * InitWidget constructor.
	 */
	public function __construct() {
		$this->widget = '\TheDramatist\Ogive\Widget\Widget';
	}

	/**
	 * Initializes hooks.
	 */
	public function init() {
		add_action( 'widgets_init', [ $this, 'register_widget' ] );
	}

	/**
	 * Registers widget class.
	 */
	public function register_widget() {
		register_widget( $this->widget );
	}
}
