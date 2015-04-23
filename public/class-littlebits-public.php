<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.wetpaintwebtools.com/
 * @since      1.0.0
 *
 * @package    Littlebits
 * @subpackage Littlebits/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Littlebits
 * @subpackage Littlebits/public
 * @author     WetPaint <rc@wetpaint.io>
 */
class Littlebits_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $littlebits    The ID of this plugin.
	 */
	private $littlebits;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $littlebits       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $littlebits, $version ) {

		$this->littlebits = $littlebits;
		$this->version = $version;

	}

	public function new_comment_indicator() {
		$options = get_option('littlebits_config');
		$response = wp_remote_post( 'https://api-http.littlebitscloud.cc/devices/'.$options['device_id'].'/output', array(
			'method' => 'POST',
			'headers' => array( 'Authorization' => 'Bearer '. $options['access_token'] .'', 'Accept' => 'application/nvd.littlebits.v2+json'),
			'body' => array( 'percent' => 100, 'duration_ms' => 5000 ),
		    )
		);

		if ( is_wp_error( $response ) ) {
		   $error_message = $response->get_error_message();
		   echo "Something went wrong: $error_message";
		} else {
		  // echo 'Response:<pre>';
		  // print_r( $response );
		  // echo '</pre>';
		}
	}

}
