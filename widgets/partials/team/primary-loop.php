<?php
    // Helper Variable(s)
    $member_position = get_field('member_position');
    $member_social_profiles = get_field('member_social_profiles');
?>
<!-- PORTFOLIO ENTRY -->
<article id="member-<?php the_ID(); ?>" <?php post_class("grid-item"); ?>>
		
    <figure class="member-photo">
        <img src="<?php the_post_thumbnail_url(); ?>">
    </figure>

    <header class="member-details">
        <h3 class="title"><?php the_title(); ?></h3>
        <?php if ($member_position) { ?>
            <span class="position"><?php echo esc_html($member_position); ?></span>
        <?php } ?>
        <?php the_content(); ?>
        <ul class="social-profiles">
            <?php if ($member_social_profiles['facebook_profile']) { ?>
                <li><a href="<?php echo esc_url($member_social_profiles['facebook_profile']); ?>"><i class="fa fa-facebook-f"></i></a></li>
            <?php } ?>
            <?php if ($member_social_profiles['twitter_profile']) { ?>
                <li><a href="<?php echo esc_url($member_social_profiles['twitter_profile']); ?>"><i class="fa fa-twitter"></i></a></li>
            <?php } ?>
            <?php if ($member_social_profiles['dribbble_profile']) { ?>
                <li><a href="<?php echo esc_url($member_social_profiles['dribbble_profile']); ?>"><i class="fa fa-dribbble"></i></a></li>
            <?php } ?>
            <?php if ($member_social_profiles['linkedin_profile']) { ?>
                <li><a href="<?php echo esc_url($member_social_profiles['linkedin_profile']); ?>"><i class="fa fa-linkedin-in"></i></a></li>
            <?php } ?>
        </ul>
    </header>

</article>