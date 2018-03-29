<?php
/*
Plugin Name: Notion Core
Plugin URI: http://www.quadnotion.com
Description: Addon Plugin devloped by Quadnotion
Author: Quadnotion
Author URI: http://www.quadnotion.com
Version: 1.0
*/



defined('ABSPATH') or die("Restricted access!");

/**
 * Define constants
 *
 * @since 1.0
 */



defined('QCORE_DIR') or define('QCORE_DIR', dirname(plugin_basename(__FILE__)));
defined('QCORE_BASE') or define('QCORE_BASE', plugin_basename(__FILE__));
defined('QCORE_URL') or define('QCORE_URL', plugin_dir_url(__FILE__));
defined('QCORE_PATH') or define('QCORE_PATH', plugin_dir_path(__FILE__));
//defined('QCORE_TEXT') or define('QCORE_TEXT', 'my_custom_plugin_text_domain');
defined('QCORE_VERSION') or define('QCORE_VERSION', '1.0');

/**
 * Include Codestar Framework
 *
 * @since 1.0
 *
 * Make a new folder "inc" in your plugin folder. if you download the codestar framework zip from GitHub
 *
**/
require_once QCORE_PATH .'/inc/codestar-framework/cs-framework.php';


/**
 *Show/Hide Codestar Framework
 *
 * @since 1.0
 *
 * Location of actual files is in the inc/codestar-framework/config/ directory
 * Optionally, set each desired, to "false" to not display after plugin activation
 **/
define( 'CS_ACTIVE_FRAMEWORK',  true  ); // default true
define( 'CS_ACTIVE_METABOX',  false); // default true
define( 'CS_ACTIVE_TAXONOMY',  false); // default true
define( 'CS_ACTIVE_SHORTCODE',  false); // default true
define( 'CS_ACTIVE_CUSTOMIZE',  false); // default true


if (!is_admin()) {

    // add_action( 'wp_enqueue_scripts', 'quadnotion_addon_scripts' );
    // add_action( 'wp_enqueue_scripts', 'quadnotion_addon_styles' );

}
else{
	add_action( 'admin_enqueue_scripts', 'quadnotion_addon_admin_scripts' );
    add_action( 'admin_enqueue_scripts', 'quadnotion_addon_admin_styles' );
}

function quadnotion_addon_admin_scripts(){

	// wp_enqueue_script("jquery-ui", 'https://code.jquery.com/ui/1.12.1/jquery-ui.js',array(),false,true);


	wp_enqueue_script("quadnotion-main-script", plugins_url('js/main.js' , __FILE__ ),array(),false,true);
}


function quadnotion_addon_admin_styles(){



	wp_enqueue_style("quadnotion-main-style", plugins_url('css/main.css' , __FILE__ ));
}



require_once QCORE_PATH .'/inc/notion-shortcodes/shortcodes.php';
