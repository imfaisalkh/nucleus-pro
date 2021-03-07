<?php
namespace Nucleus\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Meta Info
 *
 * Elementor widget for displaying meta info.
 *
 * @since 1.0.0
 */
class Meta_info extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'meta-info';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Meta Info', 'elementor-meta-info' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-alert';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'elementor-meta-info' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'elementor-meta-info' ),
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'meta_label', [
				'label' => __( 'Meta Label', 'nucleus-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'meta_value', [
				'label' => __( 'Meta Value', 'nucleus-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'tabs',
			[
				'label' => __( 'Meta Fields', 'nucleus-pro' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'meta_label' => __( 'Author', '_nucleus' ),
						'meta_value' => __( 'Jhon Doe', '_nucleus' ),
					],
				],
				'title_field' => '{{{ meta_label }}}',
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="meta-fields">
			<?php
			$counter = 1; ?>
			<?php foreach ( $settings['tabs'] as $item ) : ?>
				<div class="meta-field" data-count="<?php echo $counter; ?>">
					<span class="label"><?php echo $item['meta_label']; ?></span>
					<span class="value"><?php echo $item['meta_value']; ?></span>
				</div>
			<?php
				$counter++;
			endforeach; ?>
		</div>
		<?php
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _content_template() {
		?>
		<div class="meta-fields" data-active-section="{{ editSettings.activeItemIndex ? editSettings.activeItemIndex : 0 }}">
			<#
			if ( settings.tabs.length ) {
				var counter = 1;
				_.each( settings.tabs, function( item ) { #>
					<div class="meta-field" data-count="{{ counter }}">
						<span class="label">{{{ item.meta_label }}}</span>
						<span class="value">{{{ item.meta_value }}}</span>
					</div>
				<#
					counter++;
				} );
			} #>
		</div>
		<?php
	}
}
