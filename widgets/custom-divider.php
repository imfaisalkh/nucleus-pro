<?php
namespace Nucleus\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Divider
 *
 * Elementor widget for displaying a vertical divider.
 *
 * @since 1.0.0
 */
class Custom_Divider extends Widget_Base {

	public function get_name() {
		return 'custom-divider';
	}

	public function get_title() {
		return __( 'Divider', 'elementor' );
	}

	public function get_icon() {
		return 'eicon-divider';
	}


	/**
	 * A list of scripts that the widgets is depended in
	 * @since 1.3.0
	 **/
	public function get_script_depends() {
		return [ 'custom-divider' ];
	}

	protected function _register_controls() {
		
		// CONTENT - TAB
		$this->start_controls_section(
			'section_divider',
			[
				'label' => __( 'Divider: Custom', 'elementor' ),
			]
		);

		$this->add_control(
			'orientation',
			[
				'label' => __( 'Orientation', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'vertical' => __( 'Vertical', 'elementor' ),
					'horizontal' => __( 'Horizontal', 'elementor' ),
				],
				'default' => 'horizontal',
			]
		);

		$this->add_control(
			'style_horizontal',
			[
				'label' => __( 'Style', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'solid' => __( 'Solid', 'elementor' ),
					'double' => __( 'Double', 'elementor' ),
					'dotted' => __( 'Dotted', 'elementor' ),
					'dashed' => __( 'Dashed', 'elementor' ),
				],
				'default' => 'solid',
				'selectors' => [
					'{{WRAPPER}} .custom-divider-separator' => 'border-top-style: {{VALUE}};',
				],
				'condition' => [
					'orientation' => 'horizontal',
				],	
			]
		);

		$this->add_control(
			'style_vertical',
			[
				'label' => __( 'Style', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'solid' => __( 'Solid', 'elementor' ),
					'double' => __( 'Double', 'elementor' ),
					'dotted' => __( 'Dotted', 'elementor' ),
					'dashed' => __( 'Dashed', 'elementor' ),
				],
				'default' => 'solid',
				'selectors' => [
					'{{WRAPPER}} .custom-divider-separator' => 'border-left-style: {{VALUE}};',
				],
				'condition' => [
					'orientation' => 'vertical',
				],	
			]
		);

		$this->add_control(
			'weight_horizontal',
			[
				'label' => __( 'Weight', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .custom-divider-separator' => 'border-top-width: {{SIZE}}{{UNIT}}; height: 1px;',
				],
				'condition' => [
					'orientation' => 'horizontal',
				],	
			]
		);

		$this->add_control(
			'weight_vertical',
			[
				'label' => __( 'Weight', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .custom-divider-separator' => 'border-left-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'orientation' => 'vertical',
				],	
			]
		);

		$this->add_control(
			'color_horizontal',
			[
				'label' => __( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				// 'scheme' => [
				// 	'type' => Scheme_Color::get_type(),
				// 	'value' => Scheme_Color::COLOR_3,
				// ],
				'selectors' => [
					'{{WRAPPER}} .custom-divider-separator' => 'border-top-color: {{VALUE}};',
				],
				'condition' => [
					'orientation' => 'horizontal',
				],	
			]
		);

		$this->add_control(
			'color_vertical',
			[
				'label' => __( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				// 'scheme' => [
				// 	'type' => Scheme_Color::get_type(),
				// 	'value' => Scheme_Color::COLOR_3,
				// ],
				'selectors' => [
					'{{WRAPPER}} .custom-divider-separator' => 'border-left-color: {{VALUE}};',
				],
				'condition' => [
					'orientation' => 'vertical',
				],	
			]
		);

		$this->add_control(
			'width',
			[
				'label' => __( 'Width', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 100,
					'unit' => '%',
				],
				'selectors' => [
					'{{WRAPPER}} .custom-divider-separator' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'orientation' => 'horizontal',
				],
			]
		);

		$this->add_control(
			'height',
			[
				'label' => __( 'Height', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 70,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .custom-divider-separator' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'orientation' => 'vertical',
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .custom-divider' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'gap',
			[
				'label' => __( 'Gap', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
				],
				'range' => [
					'px' => [
						'min' => 2,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .custom-divider' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'view',
			[
				'label' => __( 'View', 'elementor' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->end_controls_section();
	}

	// RENDER ON FRONT-END ONLY
	protected function render() {
		?>
		<div class="custom-divider">
			<span class="custom-divider-separator"></span>
		</div>
		<?php
	}

	// RENDER WHILE EDITING ONLY
	protected function _content_template() {
		?>
		<div class="custom-divider">
			<span class="custom-divider-separator"></span>
		</div>
		<?php
	}
}
