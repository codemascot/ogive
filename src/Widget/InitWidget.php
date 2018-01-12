<?php # -*- coding: utf-8 -*-

namespace TheDramatist\Ogive\Widget;

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
	
	public function init() {
		add_action( 'widgets_init', [ $this, 'register_widget' ] );
	}
	
	public function register_widget() {
		register_widget( $this->widget );
	}
}
