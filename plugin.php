<?php
namespace Nucleus;

// Define each widget class name here (EDIT BELOW # 1)
use Nucleus\Widgets\Meta_info;
use Nucleus\Widgets\Custom_Divider;
use Nucleus\Widgets\Twitter_Module;
use Nucleus\Widgets\Price_Table;
use Nucleus\Widgets\Portfolio_Module;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Main Plugin Class
 *
 * Register new elementor widget.
 *
 * @since 1.0.0
 */
class Plugin {

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		$this->add_actions();
	}

	/**
	 * Add Actions
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function add_actions() {
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'on_widgets_registered' ] );

		add_action( 'elementor/frontend/after_register_scripts', function() {
			wp_register_script( 'meta-info', plugins_url( '/assets/js/meta-info.js', ELEMENTOR_INIT__FILE__ ), [ 'jquery' ], false, true );
		} );
	}

	/**
	 * On Widgets Registered
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function on_widgets_registered() {
		$this->includes();
		$this->register_widget();
	}

	/**
	 * Includes
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function includes() {
		// Register each widget here (EDIT BELOW # 2)
		require __DIR__ . '/widgets/meta-info.php';
		require __DIR__ . '/widgets/custom-divider.php';
		require __DIR__ . '/widgets/twitter-module.php';
		require __DIR__ . '/widgets/price-table.php';
		require __DIR__ . '/widgets/portfolio-module.php';
	}

	/**
	 * Register Widget
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function register_widget() {
		// Register each widget here (EDIT BELOW # 3)
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Meta_info() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Custom_Divider() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Twitter_Module() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Price_Table() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Portfolio_Module() );
	}
}

new Plugin();
