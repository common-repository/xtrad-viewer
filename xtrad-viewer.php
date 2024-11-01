<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://audlemsoftware.co.uk
 * @since             1.0.0
 * @package           Xtrad Viewer
 *
 * @wordpress-plugin
 * Plugin Name:       Xtrad Viewer
 * Plugin URI:        https://xtra-dimension.com/
 * Description:       Edits and Displays 3D Scenes
 * Version:           1.3.1
 * Author:            Len Ford
 * Author URI:        https://xtra-dimension.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       xtrad-viewer
 * Domain Path:       /languages
 */
// Exit If Accessed Directly
if(!defined('ABSPATH')){
    exit;
}

define( 'XTRAD_VIEWER_VERSION', '1.3.1' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-xtrad-viewer.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_xtrad_viewer() {

    $plugin = new Xtrad_Viewer();
    $plugin->run();

}
run_xtrad_viewer();





