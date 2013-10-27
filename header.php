<?php
    $blogname = get_bloginfo('name', 'Display');
    $postTitle = get_the_title();

    $browserTitle = is_singular() 
        ? $postTitle . " | ". $blogname
        : $blogname;

    $pageTitle = is_singular()
        ? $postTitle
        : $blogname;

	$pageSubtitle = is_singular()
		? get_post_meta(get_the_ID(), 'subtitle', true)
		: get_bloginfo('description', 'Display');

	$blogLink = home_url();

    $stylesheetDir = get_bloginfo( 'stylesheet_directory' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo $browserTitle ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <!--[if lte IE 9]><link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/ie.css" type="text/css" media="screen" /><![endif]-->
    <link rel="stylesheet" href="<?php echo "$stylesheetDir/1140.css" ?>" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo "$stylesheetDir/reset.css" ?>" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo "$stylesheetDir/print.css" ?>" type="text/css" media="print" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php 
    if (!function_exists("alphasmanifesto_enqueue_scripts")) {
        function alphasmanifesto_enqueue_scripts() {
            wp_enqueue_script("jquery");
            wp_enqueue_script('mediaqueries', get_template_directory_uri() . '/css3-mediaqueries.js', array());
            if (has_nav_menu('footer-menu')) wp_enqueue_script('jqdock', get_template_directory_uri() . '/jquery.jqdock.min.js', array('jquery'));
            if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
                wp_enqueue_script( 'comment-reply' );
            }
        }
    }
	?>
    <?php add_action('wp_enqueue_scripts', 'alphasmanifesto_enqueue_scripts'); ?>
    <?php wp_head(); ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            <?php 
                if (has_nav_menu('footer-menu')) {
                    ?>
                        $('#dockMenu').jqDock({
                            align: 'bottom',
                            labels: 'bc',
                            fadeIn: 2000,
                            idle: 500,
                            onSleep: function(){ //scope (this) is the #menu element
                                var menu = $(this);
                                //slide the entire original menu off the top of the window...
                                menu.animate({bottom:-1 * menu.height() + 20},800);
                                //bind a one-off mousemove event to the silhouette child...
                                menu.one('mousemove', function(){
                                    menu.stop().animate(
                                        {bottom:'1em'},
                                        { 
                                            duration: 400, 
                                            complete: function() {
                                                menu.trigger('docknudge');
                                            }
                                        }
                                    );
                                    return false;
                                });
                            }       
                        });
                    <?php
                }
            ?>
            
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
                    $(this).parentsUntil('.searchForm').submit();
                }
            });
        });
    </script>
</head>
<body <?php body_class(); ?>>
    <header>
        <div id="titleContainer" class="container">
            <div class="row">
                <div class="twocol">
                    <div id="logo">
                        <a href="<?php echo $blogLink ?>"><img src="<?php echo "$stylesheetDir/logo.png" ?>" alt="logo" /></a>
                    </div>
                </div>
                <div class="eightcol">
                    <hgroup class="title">
                        <h1>
                            <?php if(!is_singular()) { ?>
                                <a href="<?php echo $blogLink ?>">
                            <?php } 
                                echo $pageTitle;
                                if(!is_singular()) { 
                            ?>
                                </a>
                            <?php } ?>
                        </h1>
                        <?php if(strlen($pageSubtitle) > 0) { ?>
                            <h2><?php echo $pageSubtitle ?></h2>
                        <?php } ?>
                    </hgroup>
                </div>
                <div class="twocol last">
                    <?php get_search_form() ?>
                </div>
            </div>
        </div>
    </header>
