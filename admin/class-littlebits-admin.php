<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.wetpaintwebtools.com/
 * @since      1.0.0
 *
 * @package    Littlebits
 * @subpackage Littlebits/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Littlebits
 * @subpackage Littlebits/admin
 * @author     WetPaint <rc@wetpaint.io>
 */
class Littlebits_Admin {

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
	 * @param      string    $littlebits       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $littlebits, $version ) {

		$this->littlebits = $littlebits;
		$this->version = $version;

	}

	public function add_pages() {
		$this->littlebits_settings_hook = add_submenu_page(
			'tools.php',
			'littleBits',
			'littleBits',
			'manage_options',
			'littlebits_settings',
			array( $this, 'littlebits_settings_page' )
		);
	}

	public function littlebits_settings_page() {
		include( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/littlebits-admin-display.php' );
	}

	public function register_settings() {
		register_setting( $this->littlebits.'_settings', 'littlebits_config' );
			add_settings_section('modules_section', 'Device Settings', array( $this, 'modules_section_text'), 'littlebits_device');
				add_settings_field('device_id', 'Device ID', array( $this, 'device_id_string'), 'littlebits_device', 'modules_section');
				add_settings_field('access_token', 'Access Token', array( $this, 'device_access_token'), 'littlebits_device', 'modules_section');

			add_settings_section('integrations', 'Integrations', array( $this, 'integrations_input'), 'littlebits_integration');
				add_settings_field('integration', 'Select', array( $this, 'integration_input'), 'littlebits_integration', 'integrations');
	}

	public function modules_section_text() {
		echo '<p>Login to manage your CloudBit device at <a href="http://control.littlebitscloud.cc/" target="_blank">http://control.littlebitscloud.cc/</a>. Once you have your device setup here, select it under "My CloudBits" and click Settings.</p>';
	}

	public function device_id_string() {
		$options = get_option('littlebits_config');
		echo '<input name="littlebits_config[device_id]" id="plugin_text_string" type="text" value="'. esc_attr( $options['device_id'] ) .'" size="13" />';
	}

	public function device_access_token() {
		$options = get_option('littlebits_config');
		echo '<input name="littlebits_config[access_token]" id="plugin_text_string" type="text" value="'. esc_attr( $options['access_token'] ) .'" size="72" />';
	}

	public function integrations_input() {
		echo '<p>Select which integration to enable.</p>';
	}

	public function integration_input() {
		$options = get_option('littlebits_config');
		echo '<input name="littlebits_config[integration]" id="plugin_text_string" type="checkbox" value="1" ' . checked( 1, $options['integration'], false ) . ' />';
	}

}