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
class Portfolio_Module extends Widget_Base {

	public function get_name() {
		return 'portfolio-module';
	}

	public function get_title() {
		return __( 'Portfolio', 'elementor' );
	}

	public function get_icon() {
		return 'eicon-gallery-justified';
	}


	/**
	 * A list of scripts that the widgets is depended in
	 * @since 1.3.0
	 **/
	public function get_script_depends() {
		return [ 'portfolio-module' ];
	}

	public function get_terms() {
		
		$portfolio_terms = get_terms('portfolio_category');
		
		$portfolio_terms_options = array();
		$portfolio_terms_options[null] = '-- Select --';
	
		foreach ($portfolio_terms as $term) {
			$portfolio_terms_options[$term->slug] = $term->name;
		}

		return $portfolio_terms_options;
	}

	public function get_posts() {

		$args = array( 'numberposts' => -1, 'post_type' => 'portfolio' );
		$portfolio_posts = get_posts($args);

		$portfolio_posts_options = array();
		$portfolio_posts_options[null] = '-- Select --';
	
		foreach ($portfolio_posts as $post) {
			$portfolio_posts_options[$post->ID] = $post->post_title;
		}

		return $portfolio_posts_options;
	}



	protected function _register_controls() {

		// PORTFOLIO GRID - TAB
		$this->start_controls_section(
			'section_portfolio_grid',
			[
				'label' => __( 'Portfolio Grid', 'elementor' ),
			]
		);

		$this->add_control(
			'category',
			[
				'label' => __( 'Category', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => $this->get_terms(),
				'default' => null,
				'label_block' => true,
			]
		);

		$this->add_control(
			'columns',
			[
				'label' => __( 'Columns', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 4,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 6,
					],
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
						'min' => 0,
						'max' => 200,
					],
				],
			]
		);

		$this->add_control(
			'count',
			[
				'label' => __( 'Count <small>(folios per page)</small>', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 8,
				],
				'range' => [
					'px' => [
						'min' => -1,
						'max' => 50,
					],
				],
			]
		);

		$this->add_control(
			'load_more_type',
			[
				'label' => __( 'Load More', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'scroll' => __( 'On Scroll', 'elementor' ),
					'button' => __( 'On Click', 'elementor' ),
				],
				'default' => 'scroll',
				'label_block' => true,
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

		// PORTFOLIO SLIDER - TAB
		$this->start_controls_section(
			'section_portfolio_slider',
			[
				'label' => __( 'Portfolio Slider', 'elementor' ),
			]
		);

		$this->add_control(
			'slider_posts',
			[
				'label' => __( 'Slider Posts', 'elementor' ),
				'type' => Controls_Manager::SELECT2,
				'default' => 'horizontal',
				'options' => $this->get_posts(),
				'multiple' => true,
				'label_block' => true,
				'description' => 'If you want to use the custom slider instead, enter the shortcode here. The built-in slider will gets disabled automatically.',
			]
		);

		$this->end_controls_section();

	}

	// RENDER ON FRONT-END ONLY
	protected function render() {

		// Widget Variable(s)
		$portfolio_category = $this->get_settings( 'category' );
		$portfolio_columns = $this->get_settings( 'columns' );
		$portfolio_gutter = $this->get_settings( 'gap' );
		$portfolio_count = $this->get_settings( 'count' );
		$portfolio_load_more = $this->get_settings( 'load_more_type' );


		// WP_QUERY Arguments
		$portfolio_args = array(
			'post_type' 		=> 'portfolio',
			'posts_per_page'    => $portfolio_count['size'],
			'paged' 		    => is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' )
		);

		$portfolio_query = new \WP_Query($portfolio_args);

	?>

		<?php require __DIR__ . '/partials/portfolio/featured-slider.php'; ?> 

		<?php if ( $portfolio_query->have_posts() ) : ?>

			<section class="grid" data-col="<?php echo esc_attr( $portfolio_columns['size'] ); ?>" data-margin="<?php echo esc_attr( $portfolio_gutter['size'] ); ?>" data-load-trigger="<?php echo esc_attr( $portfolio_load_more ); ?>" style="grid-gap: <?php echo esc_attr( $portfolio_gutter['size'] ); ?>px;">
		
				<?php while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post(); ?>
					<?php require __DIR__ . '/partials/portfolio/primary-loop.php'; ?> 
				<?php endwhile; ?>

			</section>

			<?php include(locate_template( 'partials/scaffolding/load-more.php' )); ?>

		<?php else: ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>


		<?php
	}

}