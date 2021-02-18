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
class Team_Module extends Widget_Base {

	public function get_name() {
		return 'team-module';
	}

	public function get_title() {
		return __( 'Team', 'elementor' );
	}

	public function get_icon() {
		return 'eicon-gallery-justified';
	}


	/**
	 * A list of scripts that the widgets is depended in
	 * @since 1.3.0
	 **/
	public function get_script_depends() {
		return [ 'team-module' ];
	}

	public function get_terms() {
		
		$team_terms = get_terms('team_category');
		
		$team_terms_options = array();
		$team_terms_options[null] = '-- Select --';
	
		foreach ($team_terms as $term) {
			$team_terms_options[$term->slug] = $term->name;
		}

		return $team_terms_options;
	}

	public function get_posts() {

		$args = array( 'numberposts' => -1, 'post_type' => 'team' );
		$team_posts = get_posts($args);

		$team_posts_options = array();
		$team_posts_options[null] = '-- Select --';
	
		foreach ($team_posts as $post) {
			$team_posts_options[$post->ID] = $post->post_title;
		}

		return $team_posts_options;
	}


	protected function _register_controls() {

		// PORTFOLIO GRID - TAB
		$this->start_controls_section(
			'section_team_grid',
			[
				'label' => __( 'Team Grid', 'elementor' ),
			]
		);

		$this->add_control(
			'columns',
			[
				'label' => __( 'Columns', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 3,
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

		// Widget Variable(s)
		$team_columns = $this->get_settings( 'columns' );
		$team_gutter = $this->get_settings( 'gap' );

		// WP_QUERY Arguments
		$team_args = array(
			'post_type' => 'team',
		);

		$team_query = new \WP_Query($team_args);

	?>

		<?php if ( $team_query->have_posts() ) : ?>

			<section class="team-grid" data-col="<?php echo esc_attr( $team_columns['size'] ); ?>" data-margin="<?php echo esc_attr( $team_gutter['size'] ); ?>" style="grid-gap: <?php echo esc_attr( $team_gutter['size'] ); ?>px;">
		
				<?php while ( $team_query->have_posts() ) : $team_query->the_post(); ?>
					<?php require __DIR__ . '/partials/team/primary-loop.php'; ?> 
				<?php endwhile; ?>

			</section>

		<?php else: ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>


		<?php
	}

}