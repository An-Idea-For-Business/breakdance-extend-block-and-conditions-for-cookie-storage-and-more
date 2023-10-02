<?php
/**
 * Plugin Name: Breakdance Custom Conditions and Blocks for Cookie Storage and More
 * Plugin URI: https://plugins.aifb.ch/bccb-ext-plug-aifb
 * Description: Enhance your Breakdance Builder by introducing custom conditions and blocks, focusing on cookie storage functionalities and beyond. This plugin offers a seamless experience to control element visibility based on cookies and provides a foundation for more advanced conditions in future updates.
 * Version: 0.0.5
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

 namespace AIFB\BDCustomElmentsAndConditions;

 // If this file is called directly, abort.
 if (!defined('WPINC')) {
     die;
 }
 
 // Defines the current version of the plugin.
 define('BREAKDANCE_CUSTOM_CONDITIONS_VERSION', '0.0.5');
 
 class BDCustomElementsAndConditions {
     
     public function __construct() {
         add_action('plugins_loaded', [$this, 'initialize_plugin']);
     }
 
     public function initialize_plugin() {
         include_once(ABSPATH . 'wp-admin/includes/plugin.php');
 
         if (is_plugin_active('breakdance/plugin.php')) {
             $this->include_plugin_features();
         } else {
             $this->deactivate_plugin();
         }
     }
 
     private function include_plugin_features() {
         require_once plugin_dir_path(__FILE__) . 'includes/custom-conditions.php';
         require_once plugin_dir_path(__FILE__) . 'includes/custom-elements.php';
     }
 
     private function deactivate_plugin() {
         deactivate_plugins(plugin_basename(__FILE__));
         wp_die(__('This plugin requires Breakdance to function. Please activate Breakdance before activating this plugin.', 'bccb-ext-plug-aifb'));
     }
 }
 
 new BDCustomElementsAndConditions();