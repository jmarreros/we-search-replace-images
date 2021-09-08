<?php
/*
Plugin Name: Búscar y Reemplazar imágenes
Plugin URI: https://decodecms.com
Description: Plugin para búscar imágenes que tienen dimensiones diferentes y corregirlas
Version: 1.0
Author: Jhon Marreros Guzmán
Author URI: https://decodecms.com
Text Domain: we-search-replace-images
Domain Path: languages
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
*/

namespace dcms\we;

use dcms\we\includes\Submenu;
use dcms\we\includes\Enqueu;
use dcms\we\includes\Process;


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin class to handle settings constants and loading files
**/
final class Loader{

	// Define all the constants we need
	public function define_constants(){
		define ('DCMS_WE_VERSION', '1.0');
		define ('DCMS_WE_PATH', plugin_dir_path( __FILE__ ));
		define ('DCMS_WE_URL', plugin_dir_url( __FILE__ ));
		define ('DCMS_WE_BASE_NAME', plugin_basename( __FILE__ ));
		define ('DCMS_WE_SUBMENU', 'tools.php');
	}

	// Load all the files we need
	public function load_includes(){
		include_once ( DCMS_WE_PATH . '/helpers/helper.php');
		include_once ( DCMS_WE_PATH . '/includes/submenu.php');
		include_once ( DCMS_WE_PATH . '/includes/enqueu.php');
		include_once ( DCMS_WE_PATH . '/includes/database.php');
		include_once ( DCMS_WE_PATH . '/includes/process.php');
	}

	// Load tex domain
	public function load_domain(){
		add_action('plugins_loaded', function(){
			$path_languages = dirname(DCMS_WE_BASE_NAME).'/languages/';
			load_plugin_textdomain('we-search-replace-images', false, $path_languages );
		});
	}

	// Add link to plugin list
	public function add_link_plugin(){
		add_action( 'plugin_action_links_' . plugin_basename( __FILE__ ), function( $links ){
			return array_merge( array(
				'<a href="' . esc_url( admin_url( DCMS_SUBMENU . '?page=we-search-replace-images' ) ) . '">' . __( 'Settings', 'we-search-replace-images' ) . '</a>'
			), $links );
		} );
	}

	// Initialize all
	public function init(){
		$this->define_constants();
		$this->load_includes();
		$this->load_domain();
		$this->add_link_plugin();
		new SubMenu();
		new Enqueu();
		new Process();
	}

}

$dcms_we_process = new Loader();
$dcms_we_process->init();


