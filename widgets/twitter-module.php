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
class Twitter_Module extends Widget_Base {

	public function get_name() {
		return 'twitter-module';
	}

	public function get_title() {
		return __( 'Twitter', 'elementor' );
	}

	public function get_icon() {
		return 'eicon-social-icons';
	}


	/**
	 * A list of scripts that the widgets is depended in
	 * @since 1.3.0
	 **/
	public function get_script_depends() {
		return [ 'twitter-module' ];
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
			'address',
			[
				'label' => __( 'Address', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => 'placeholder',
				'default' => 'default address',
				'label_block' => true,
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


		$this->end_controls_section();
	}

	// RENDER ON FRONT-END ONLY
	protected function render() {

		$tweets = getTweets(3, 'wpscoutsHQ', array('exclude_replies' => true, 'include_rts' => false));

		?>

		<?php if ( is_array($tweets) ) { ?>
			<div class="twitter-carousel">
				<?php foreach($tweets as $tweet) { ?>
					<div class="tweet">
						<div class="content">
							<?php
								$tweet_text = $tweet['text'];

						        // i. User_mentions must link to the mentioned user's profile.
						        if(is_array($tweet['entities']['user_mentions'])){
						            foreach($tweet['entities']['user_mentions'] as $key => $user_mention){
						                $tweet_text = preg_replace(
						                    '/@'.$user_mention['screen_name'].'/i',
						                    '<a href="http://www.twitter.com/'.$user_mention['screen_name'].'" target="_blank">@'.$user_mention['screen_name'].'</a>',
						                    $tweet_text);
						            }
						        }

						        // ii. Hashtags must link to a twitter.com search with the hashtag as the query.
						        if(is_array($tweet['entities']['hashtags'])){
						            foreach($tweet['entities']['hashtags'] as $key => $hashtag){
						                $tweet_text = preg_replace(
						                    '/#'.$hashtag['text'].'/i',
						                    '<a href="https://twitter.com/search?q=%23'.$hashtag['text'].'&src=hash" target="_blank">#'.$hashtag['text'].'</a>',
						                    $tweet_text);
						            }
						        }

						        // iii. Links in Tweet text must be displayed using the display_url
						        //      field in the URL entities API response, and link to the original t.co url field.
						        if(is_array($tweet['entities']['urls'])){
						            foreach($tweet['entities']['urls'] as $key => $link){
						                $tweet_text = preg_replace(
						                    '`'.$link['url'].'`',
						                    '<a href="'.$link['url'].'" target="_blank">'.$link['url'].'</a>',
						                    $tweet_text);
						            }
						        }

							?>
							<?php echo $tweet_text; ?>	
						</div>
						<span class="timestamp">
							<?php echo human_time_diff( $tweet['created_at'], current_time('timestamp') ) . ' ago'; ?>
						</span>	
					</div>
				<?php } ?>
			</div>
		<?php } ?>

		<?php
	}

	// RENDER WHILE EDITING ONLY
	protected function _content_template() {

          $tweets = getTweets(3, 'wpscoutsHQ');

          foreach($tweets as $tweet){
            print_r($tweet);
          }

	}
}
