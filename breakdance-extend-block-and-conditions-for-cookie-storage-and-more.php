<?php
/**
 * Plugin Name: Breakdance Custom Conditions and Blocks for Cookie Storage and More
 * Plugin URI: https://plugins.aifb.ch/bccb-ext-plug-aifb
 * Description: Aggiunge condizioni personalizzate a Breakdance Builder.
 * Version: 0.0.1
 * Author: Edoardo Guzzi, An Idea For Business
 * Author URI: https://plugins.aifb.ch
 * License: GPL-3
 * Text Domain: bccb-ext-plug-aifb
 * Domain Path: /languages/
 */

// Se questo file viene chiamato direttamente, abortire.
if (!defined('WPINC')) {
    die;
}

// Definisce la versione attuale del plugin.
define('BREAKDANCE_CUSTOM_CONDITIONS_VERSION', '0.0.1');

// Include le funzionalità del plugin.
require plugin_dir_path(__FILE__) . 'includes/functions.php';