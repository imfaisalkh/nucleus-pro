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
class Testimonial_Module extends Widget_Base {

	public function get_name() {
		return 'testimonial-module';
	}

	public function get_title() {
		return __( 'Testimonials', 'elementor' );
	}

	public function get_icon() {
		return 'eicon-gallery-justified';
	}


	/**
	 * A list of scripts that the widgets is depended in
	 * @since 1.3.0
	 **/
	public function get_script_depends() {
		return [ 'testimonial-module' ];
	}

	protected function _register_controls() {

		// PORTFOLIO GRID - TAB
		$this->start_controls_section(
			'section_testimonials',
			[
				'label' => __( 'General', 'elementor' ),
			]
        );
        
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'review', [
                'label' => __( 'Review', 'nucleus-pro' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                // 'label_block' => true,
            ]
        );

        $repeater->add_control(
			'author', [
				'label' => __( 'Author', 'nucleus-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
        );
        
        $repeater->add_control(
			'position', [
				'label' => __( 'Position', 'nucleus-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

        
        $this->add_control(
			'testimonial',
			[
				'label' => __( 'Testimonial', 'nucleus-pro' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ author }}}',
			]
		);

		$this->end_controls_section();

	}

	// RENDER ON FRONT-END ONLY
	protected function render() {

		// Widget Variable(s)
		$testimonials = $this->get_settings( 'testimonial' );

    ?>
        <div class="testimonials-carousel">
            <?php foreach (  $testimonials as $testimonial ) { ?>
                <div class="testimonial">
                    <blockquote class="review"><?php echo esc_html($testimonial['review']); ?></blockquote>
                    <cite class="author">
                        <span class="name"><?php echo esc_html($testimonial['author']); ?></span>
                        <span class="position"><?php echo esc_html($testimonial['position']); ?></span>
                    </cite>
                </div>
            <?php } ?>
        </div>

		<?php
	}

}