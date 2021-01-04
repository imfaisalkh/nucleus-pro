<?php
	
	// Post or Page ID
	if( is_home() || is_archive() || is_search() ) {
		$post_ID = get_option('page_for_posts');
	} else {
		$post_ID = get_the_ID();
	}


	// Portfolio Configuration - Meta Panel
	$portfolio_slider_posts = $this->get_settings( 'slider_posts' );
	
	// WP_QUERY Arguments
	$portfolio_slider_args = array(
		'post_type' 	=> 'portfolio',
		'post__in'    	=> $portfolio_slider_posts,
		'orderby' 		=> 'post__in'

	);

	$portfolio_slider_query = new WP_Query($portfolio_slider_args);

?>

<?php if ( $portfolio_slider_query->have_posts() ) { ?>

	<div id="featured-slider">

		<div class="main-carousel">

			<?php while ( $portfolio_slider_query->have_posts() ) : $portfolio_slider_query->the_post(); ?>

				<?php 
					$folio_terms = implode(', ', nucleus_get_term_fields('portfolio_category', 'name'));
					$folio_slider_image = get_field('slider_image');
					$folio_permalink = get_post_meta(get_the_ID(), 'custom_url', true) != false ? esc_url( get_post_meta(get_the_ID(), 'custom_url', true) ) : esc_url( get_permalink() );
				?>

				<div class="carousel-cell">
					<img class="carousel-image" src="<?php echo esc_url( $folio_slider_image ); ?>" />
					<div class="carousel-desc">
						<a href="<?php echo $folio_permalink; ?>" title="<?php the_title(); ?>" >
							<h3 class="title"><?php the_title(); ?></h3>
							<?php if ( $folio_terms ) { ?>
								<span class="tags"><?php echo esc_html( $folio_terms ); ?></span>
							<?php } ?>
						</a>
					</div>
				</div>

			<?php endwhile; ?>

		</div>

		<div class="progress-bar">
			<span class="progress"></span>
		</div>

	</div>

<?php } ?>