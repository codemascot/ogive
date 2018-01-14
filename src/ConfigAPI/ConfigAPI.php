<?php # -*- coding: utf-8 -*-

namespace TheDramatist\Ogive\ConfigAPI;

if ( ! defined( 'ABSPATH' ) ) {
	return; // Exit if called directly.
}

/**
 * Class ConfigAPI
 *
 * @package TheDramatist\Ogive\ConfigAPI
 */
class ConfigAPI {

	/**
	 * ConfigAPI constructor.
	 */
	public function __construct() {

	}

	/**
	 * Initiating hooks.
	 */
	public function init() {

		add_action( 'rest_api_init', [ $this, 'rest_routes' ] );

	}

	/**
	 * Defining REST routes.
	 */
	public function rest_routes() {

		// Registering routes for posts
		register_rest_route(
			'ogive/v1', '/posts/',
			[
				'methods'  => 'GET',
				'callback' => [ $this, 'get_posts' ],
			]
		);

		// Registering routes for users
		register_rest_route(
			'ogive/v1', '/users/',
			[
				'methods'  => 'GET',
				'callback' => [ $this, 'get_users' ],
			]
		);

		// Registering routes for comments
		register_rest_route(
			'ogive/v1', '/comments/',
			[
				'methods'  => 'GET',
				'callback' => [ $this, 'get_comments' ],
			]
		);
	}

	/**
	 * Grab the total number of posts.
	 *
	 * @param array $data Options for the function.
	 *
	 * @return int All users object,  * or null if none.
	 */
	public function get_posts( $data ) {
		$posts = wp_count_posts();

		if ( empty( $posts ) ) {
			return 0;
		}

		return (int) $posts->publish;
	}

	/**
	 * Grab the total number of users.
	 *
	 * @param array $data Options for the function.
	 *
	 * @return int All users count.
	 */
	public function get_users( $data ) {
		$users = count_users();

		if ( empty( $users ) ) {
			return 0;
		}

		return (int) $users['total_users'];
	}

	/**
	 * Grab the total number of comments.
	 *
	 * @param array $data Options for the function.
	 *
	 * @return int All comments count.
	 */
	public function get_comments( $data ) {

		$comments = wp_count_comments();

		if ( empty( $comments ) ) {
			return 0;
		}

		return (int) $comments->total_comments;
	}
}
