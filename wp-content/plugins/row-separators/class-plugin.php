<?php
/*
Plugin Name: Row Separators
Description: Add designs between your Visual Composer rows. Choose from 70+ customizable designs.
Author: Gambit Technologies
Version: 1.1.1
Author URI: http://gambit.ph
Plugin URI: http://codecanyon.net/user/gambittech/portfolio
Text Domain: row_separators
Domain Path: /languages
SKU: ROWSEP
*/


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


// Identifies the plugin itself. If already existing, it will not redefine itself.
defined( 'VERSION_GAMBIT_ROW_SEPARATORS' ) or define( 'VERSION_GAMBIT_ROW_SEPARATORS', '1.1.1' );

// Initializes the plugin translations.
defined( 'GAMBIT_ROW_SEPARATORS' ) or define( 'GAMBIT_ROW_SEPARATORS', 'row_separators' );

// Plugin automatic updates
require_once( 'class-admin-license.php' );

// This is the main plugin functionality
require_once( 'class-row_separators.php' );


// Initializes plugin class.
if ( ! class_exists( 'GambitRowSeparatorsPlugin' ) ) {
	
	class GambitRowSeparatorsPlugin {

		/**
		 * Hook into WordPress
		 *
		 * @return	void
		 * @since	1.0
		 */
		function __construct() {

			// Admin pointer reminders for automatic updates
			require_once( 'class-admin-pointers.php' );
			if ( class_exists( 'GambitAdminPointers' ) ) {
				new GambitAdminPointers( array (
					'pointer_name' => 'GambitRowSeparatorsPlugin', // This should also be placed in uninstall.php
					'header' => __( 'Automatic Updates', GAMBIT_ROW_SEPARATORS ),
					'body' => __( 'Keep Row Separators updated by entering your purchase code here.', GAMBIT_ROW_SEPARATORS ),
				) );
			}

			// Our translations
			add_action( 'plugins_loaded', array( $this, 'loadTextDomain' ), 1 );

			// Gambit links
			add_filter( 'plugin_row_meta', array( $this, 'pluginLinks' ), 10, 2 );
		}


		/**
		 * Loads the translations
		 *
		 * @return	void
		 * @since	1.0
		 */
		public function loadTextDomain() {
			load_plugin_textdomain( GAMBIT_ROW_SEPARATORS, false, basename( dirname( __FILE__ ) ) . '/languages/' );
		}


		/**
		 * Adds plugin links
		 *
		 * @access	public
		 * @param	array $plugin_meta The current array of links
		 * @param	string $plugin_file The plugin file
		 * @return	array The current array of links together with our additions
		 * @since	1.0
		 **/
		public function pluginLinks( $plugin_meta, $plugin_file ) {
			if ( $plugin_file == plugin_basename( __FILE__ ) ) {
				$pluginData = get_plugin_data( __FILE__ );

				$plugin_meta[] = sprintf( "<a href='%s' target='_blank'>%s</a>",
					"http://support.gambit.ph?utm_source=" . urlencode( $pluginData['Name'] ) . "&utm_medium=plugin_link",
					__( "Get Customer Support", GAMBIT_ROW_SEPARATORS )
				);
				$plugin_meta[] = sprintf( "<a href='%s' target='_blank'>%s</a>",
					"https://gambit.ph/plugins?utm_source=" . urlencode( $pluginData['Name'] ) . "&utm_medium=plugin_link",
					__( "Get More Plugins", GAMBIT_ROW_SEPARATORS )
				);
			}
			return $plugin_meta;
		}


	}

	new GambitRowSeparatorsPlugin();
}