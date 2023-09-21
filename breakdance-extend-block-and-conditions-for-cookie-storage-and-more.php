<?php
/**
 * Plugin Name: Breakdance Custom Conditions and Blocks for Cookie Storage and More
 * Plugin URI: https://plugins.aifb.ch/bccb-ext-plug-aifb
 * Description: Enhance your Breakdance Builder by introducing custom conditions and blocks, focusing on cookie storage functionalities and beyond. This plugin offers a seamless experience to control element visibility based on cookies and provides a foundation for more advanced conditions in future updates.
 * Version: 0.0.1
 * Requires at least: 6.0
 * Tested up to: 6.3
 * Requires PHP: 8.0
 * Author: Edoardo Guzzi, An Idea For Business
 * Author URI: https://plugins.aifb.ch
 * License: GPL-3.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: bccb-ext-plug-aifb
 * Domain Path: /languages/
 * Tags: breakdance, conditions, cookie, builder, custom blocks
 */

// Se questo file viene chiamato direttamente, abortire.
if (!defined('WPINC')) {
    die;
}

// Definisce la versione attuale del plugin.
define('BREAKDANCE_CUSTOM_CONDITIONS_VERSION', '0.0.1');

// Include le funzionalità del plugin.
require plugin_dir_path(__FILE__) . 'includes/functions.php';