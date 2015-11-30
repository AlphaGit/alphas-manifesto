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
            wp_enqueue_script('html5shiv', get_template_directory_uri() . '/html5shiv.min.js');
            if (is_singular() && comments_open() && get_option('thread_comments')) {
                wp_enqueue_script('comment-reply');
            }
        }
    }
	?>
    <?php add_action('wp_enqueue_scripts', 'alphasmanifesto_enqueue_scripts'); ?>
    <?php wp_head(); ?>
    <script type="text/javascript">
        // helper functions, used to avoid jQuery as a dependency
        function onBodyReady(fn) {
            if (document.readyState != 'loading') {
                fn();
            } else if (document.addEventListener) { // IE9+
                document.addEventListener('DOMContentLoaded', fn);
            } else { // IE8
                document.attachEvent('onreadystatechange', function() {
                    if (document.readyState != 'loading') fn();
                });
            }
        }

        function addEventListener(el, eventName, handler) {
          if (el.addEventListener) {
            el.addEventListener(eventName, handler);
          } else {
            el.attachEvent('on' + eventName, function(){
              handler.call(el);
            });
          }
        }

        // theme adjustments
        function adjustEmbedSizes() {
            var embeds = document.querySelectorAll('article iframe, article video, article embed');
            for (var i = 0; i < embeds.length; i++) {
                var embedded = embeds[i];
                var declaredWidth = +embedded.getAttribute('width');
                var declaredHeight = +embedded.getAttribute('height');
                if (!!declaredHeight && !!declaredWidth) {
                    embedded.removeAttr('width');
                }
            }
        }

        function searchParentsByTag(element, upperTagName) {
            if (element.nodeName === upperTagName) return element;
            if (element.nodeName === 'WINDOW') return null;
            return searchParentsByTag(element.parentNode, upperTagName);
        }

        function searchBoxEventHandler(evt) {
            if (evt.which == 13) {
                evt.preventDefault();
                var closesForm = searchParentsByTag(evt.target, 'FORM');
                closesForm.submit();
            }            
        }

        function bindEnterToSearchBox() {
            var searchBoxes = document.querySelectorAll('.searchForm input.searchTerm');
            for (var i = 0; i < searchBoxes.length; i++) {
                var searchBox = searchBoxes[i];
                addEventListener(searchBox, 'keyup', searchBoxEventHandler);
            }
        }

        onBodyReady(adjustEmbedSizes);
        onBodyReady(bindEnterToSearchBox);
    </script>
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
