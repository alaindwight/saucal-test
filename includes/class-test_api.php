<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       alaindwight.com
 * @since      1.0.0
 *
 * @package    Test_api
 * @subpackage Test_api/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Test_api
 * @subpackage Test_api/includes
 * @author     Alain Dwight <alaindwight@gmail.com>
 */
class Test_api {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Test_api_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'TEST_API_VERSION' ) ) {
			$this->version = TEST_API_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'test_api';

		$this->load_dependencies();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Test_api_Loader. Orchestrates the hooks of the plugin.
	 * - Test_api_widget. Loads widget.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-test_api-loader.php';

		/**
		 * The class responsible for the api widget
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-test_api-widget.php';

		/**
		 * The class responsible for the api widget
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/functions-account_settings.php';

		/**
		 * The class responsible for the api widget
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/functions-api_call.php';

		/**
		 * The class responsible for the api widget
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/functions-plugin_settings.php';

		/**
		 * The class responsible for the api widget
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/functions-utilities.php';

		$this->loader = new Test_api_Loader();

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Test_api_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
