<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.wetpaintwebtools.com/
 * @since      1.0.0
 *
 * @package    Littlebits
 * @subpackage Littlebits/admin/partials
 */

if ( ! empty($_REQUEST['_wp_http_referer']) ) {
	wp_redirect( remove_query_arg( array('_wp_http_referer', '_wpnonce'), stripslashes($_SERVER['REQUEST_URI']) ) );
	exit;
}
?>
<div class="wrap littlebits_settings_page">
	<h2>littleBits Settings</h2>
	
	<form action="options.php" method="post">

		<?php settings_fields( $this->littlebits.'_settings' ); ?>
		<?php do_settings_sections('littlebits_device'); ?>
		<?php do_settings_sections('littlebits_integration'); ?>
		<?php submit_button(); ?>
	</form>
</div>