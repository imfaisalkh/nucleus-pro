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

	public function get_name() {
		return 'meta-info';
	}

	public function get_title() {
		return __( 'Meta Info', 'nucleus' );
	}

	public function get_icon() {
		return 'eicon-alert';
	}

	public function get_categories() {
		return [ 'general-elements' ];
	}

	/**
	 * A list of scripts that the widgets is depended in
	 * @since 1.3.0
	 **/
	public function get_script_depends() {
		return [ 'meta-info' ];
	}

	protected function _register_controls() {
		
		// CONTENT - TAB
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'nucleus' ),
			]
		);

		$this->add_control(
			'tabs',
			[
				'label' => __( 'Meta Fields', 'nucleus' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'meta_label' => __( 'Author', 'nucleus' ),
						'meta_value' => __( 'Jhon Doe', 'nucleus' ),
					],
				],
				'fields' => [
					[
						'name' => 'meta_label',
						'label' => __( 'Lable', 'nucleus' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
					],
					[
						'name' => 'meta_value',
						'label' => __( 'Value', 'nucleus' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
					],
				],
				'title_field' => '{{{ meta_label }}}', // what field value to show as repeater title
			]
		);

		$this->end_controls_section();

		// STYLE - TAB
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'nucleus' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'nucleus' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'nucleus' ),
					'uppercase' => __( 'UPPERCASE', 'nucleus' ),
					'lowercase' => __( 'lowercase', 'nucleus' ),
					'capitalize' => __( 'Capitalize', 'nucleus' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	// RENDER ON FRONT-END ONLY
	protected function render() {
		$settings = $this->get_settings();
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

	// RENDER WHILE EDITING ONLY
	protected function _content_template() {
		?>
		<div class="meta-fields" data-active-section="{{ editSettings.activeItemIndex ? editSettings.activeItemIndex : 0 }}">
			<#
			if ( settings.tabs ) {
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
