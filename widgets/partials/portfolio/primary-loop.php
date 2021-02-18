<?php
	// portfolio category
	$folio_terms 			= implode(', ', nucleus_get_term_fields('portfolio_category', 'name'));

	// entry dimension
	$thumbnail_height 		= get_post_meta(get_the_ID(), 'thumbnail_height', true);
	$thumbnail_width 		= get_post_meta(get_the_ID(), 'thumbnail_width', true);

	// entry url
	$folio_permalink 		= get_post_meta(get_the_ID(), 'custom_url', true) != false ? esc_url( get_post_meta(get_the_ID(), 'custom_url', true) ) : esc_url( get_permalink() );

?>

<!-- PORTFOLIO ENTRY -->
<article id="post-<?php the_ID(); ?>" <?php post_class("grid-item $thumbnail_height $thumbnail_width"); ?>>

	<a class="entry-link" href="<?php echo $folio_permalink; ?>" title="<?php the_title(); ?>" >
		
		<figure class="entry-thumbnail">
			<img src="<?php the_post_thumbnail_url(); ?>">
		</figure>

		<header class="entry-caption">
			<div class="inner-wrap">
				<h3 class="entry-title"><?php the_title(); ?></h3>
				<?php if ( $folio_terms ) { ?>
					<span class="entry-meta"><?php echo esc_html( $folio_terms ); ?></span>
				<?php } ?>
			</div>
		</header>

	</a>    

</article>