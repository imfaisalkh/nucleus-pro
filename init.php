<?php
/**
 * Plugin Name: Nucleus Pro
 * Description: This plugin extends "Nucleus" theme capabilities.
 * Plugin URI:  https://wpscouts.net/
 * Version:     1.0.0
 * Author:      Faisal Khurshid
 * Author URI:  https://wpscouts.net/
 * Text Domain: nucleus
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'ELEMENTOR_INIT__FILE__', __FILE__ );

/**
 *
 * Load the plugin after Elementor (and other plugins) are loaded.
 *
 * @since 1.0.0
 */
function elementors_custom_widgets_load() {
	// Load localization file
	load_plugin_textdomain( 'nucleus' );

	// Notice if the Elementor is not active
	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'elementors_custom_widgets_fail_load' );
		return;
	}

	// Check version required
	$elementor_version_required = '1.0.0';
	if ( ! version_compare( ELEMENTOR_VERSION, $elementor_version_required, '>=' ) ) {
		add_action( 'admin_notices', 'elementors_custom_widgets_fail_load_out_of_date' );
		return;
	}

	// Require the main plugin file
	require( __DIR__ . '/plugin.php' );
}
add_action( 'plugins_loaded', 'elementors_custom_widgets_load' );
