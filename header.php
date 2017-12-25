<?php
    $blogname = get_bloginfo('name', 'Display');
    $postTitle = get_the_title();

    $pageTitle = is_singular()
        ? $postTitle
        : $blogname;

	$pageSubtitle = is_singular()
		? get_post_meta(get_the_ID(), 'subtitle', true)
		: get_bloginfo('description', 'Display');

    $blogLink = home_url();
    $currentLink = home_url(add_query_arg(NULL, NULL));

    $stylesheetDir = get_stylesheet_directory_uri();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head <?php echo apply_filters('head_attributes', ''); ?>>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header>
        <div class="columnContainer titleRow">
            <div class="column colSize1 logoContainer">
                <?php if ( function_exists( 'jetpack_the_site_logo' ) ) jetpack_the_site_logo(); ?>
            </div><!-- This comment is a fix for inline-block spaces, do not remove
            --><div class="column colSize4 title">
                <h1>
                    <?php if(!is_single()) { ?> <a href="<?php echo esc_url($currentLink) ?>"> <?php } ?>
                    <?php echo $pageTitle; ?>
                    <?php if(!is_single()) { ?> </a> <?php } ?>
                </h1>
                <?php if(strlen($pageSubtitle) > 0) { ?>
                    <p class="subtitle"><?php echo $pageSubtitle ?></p>
                <?php } ?>
            </div><!-- This comment is a fix for inline-block spaces, do not remove
            --><div class="column colSize1 searchContainer">
                <?php get_search_form() ?>
            </div>
        </div>
    </header>
