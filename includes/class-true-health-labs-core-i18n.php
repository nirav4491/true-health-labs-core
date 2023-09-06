<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://https://github.com/nirav4491
 * @since      1.0.0
 *
 * @package    True_Health_Labs_Core
 * @subpackage True_Health_Labs_Core/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    True_Health_Labs_Core
 * @subpackage True_Health_Labs_Core/includes
 * @author     Nirav Mehta <info@concatstring.com>
 */
class True_Health_Labs_Core_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'true-health-labs-core',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
