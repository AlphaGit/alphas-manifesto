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
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php
    if (!function_exists('alphasmanifesto_enqueue_scripts')) {
        function alphasmanifesto_enqueue_scripts() {
            wp_enqueue_script('jquery');
            if (is_singular() && comments_open() && get_option('thread_comments')) {
                wp_enqueue_script('comment-reply');
            }
        }
    }
	?>
    <?php add_action('wp_enqueue_scripts', 'alphasmanifesto_enqueue_scripts'); ?>
    <?php wp_head(); ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            // embed resize fix
            $('article iframe, article video, article embed').each(function() {
                var $embedded = $(this);
                var declaredWidth = +$embedded.attr('width');
                var declaredHeight = +$embedded.attr('height');
                if (!!declaredWidth && !!declaredHeight) {
                    $embedded.removeAttr('width');
                    var actualWidth = $embedded.width();
                    $embedded.attr('height', actualWidth / declaredWidth * declaredHeight);
                }
                $embedded.removeAttr('width');
            });

            // handle automated search on enter for search fields
            $('.searchForm input.searchTerm').keyup(function(evt) {
                if (event.which == 13) {
                    evt.preventDefault();
                    $(this).closest('.searchForm').submit();
                }
            });
        });
    </script>
</head>
<body <?php body_class(); ?>>
    <header>
        <div class="columnContainer titleRow">
            <div class="column colSize1 logoContainer">
                <a href="<?php echo $blogLink ?>"><img src="<?php echo "$stylesheetDir/logo.png" ?>" alt="logo" /></a>
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
