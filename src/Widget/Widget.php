<?php # -*- coding: utf-8 -*-

namespace TheDramatist\Ogive\Widget;

if ( ! defined( 'ABSPATH' ) ) {
	return; // Exit called directly.
}

/**
 * Class Widget
 *
 * @package TheDramatist\Ogive\Widget
 */
class Widget extends \WP_Widget {
	
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'ogive_widget', // Base ID
			esc_html__( 'Ogive Site Statistics', 'ogive' ), // Name
			[
				'description' => esc_html__(
					'A widget for showing some necessary statistics.',
					'ogive'
				),
			] // Args
		);
	}
	
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title']
			     . apply_filters( 'widget_title', $instance['title'] )
			     . $args['after_title'];
		}
		echo '<div class="ogive-stats"></div>';
		echo $args['after_widget'];
	}
	
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance[ 'title' ] ) ? $instance[ 'title' ]
			: esc_html__( 'Ogive Site Statistics', 'ogive' );
		require 'Views/html-backend-form.php';
	}
	
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		
		$instance          = [];
		$instance['title'] = ( ! empty( $new_instance['title'] ) )
			? strip_tags( $new_instance['title'] ) : '';
		
		return $instance;
	}
}
