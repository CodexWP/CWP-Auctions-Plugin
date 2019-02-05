<?php

/**
 * @link              http://www.codexwp.com/about/
 * @since             1.0.0
 * @package           Cwp_Auctions
 *
 * @wordpress-plugin
 * Plugin Name:       CWP Auctions
 * Plugin URI:        http://www.codexwp.com/
 * Description:       CWP Auctions is one of the best plugin for selling your products by opening an auctions. Use [cwp-past-auctions] and Use [cwp-up-auctions] in your page to show auctions.
 * Version:           1.0.0
 * Author:            Codex WP
 * Author URI:        http://www.codexwp.com/about/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cwp-auctions
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cwp-auctions-activator.php
 */
function activate_cwp_auctions() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cwp-auctions-activator.php';
	Cwp_Auctions_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cwp-auctions-deactivator.php
 */
function deactivate_cwp_auctions() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cwp-auctions-deactivator.php';
	Cwp_Auctions_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cwp_auctions' );
register_deactivation_hook( __FILE__, 'deactivate_cwp_auctions' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cwp-auctions.php';
require plugin_dir_path( __FILE__ ) . 'includes/functions-cwp-auctions.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cwp_auctions() {

	$plugin = new Cwp_Auctions();
	$plugin->run();

}
run_cwp_auctions();
