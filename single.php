<?php 
$title = get_the_title();
$headTitle = $title . " | ".get_bloginfo('name', 'Display');

$pageSubtitle = get_post_meta(get_the_ID(), 'subtitle', true);

$blogLink = home_url();
$titleLink = get_permalink();
$stylesheetDir = get_bloginfo( 'stylesheet_directory' );

$content_width = 745;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <title><?php echo $headTitle ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <!--[if lte IE 9]><link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/ie.css" type="text/css" media="screen" /><![endif]-->
    <link rel="stylesheet" href="<?php echo "$stylesheetDir/1140.css" ?>" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo "$stylesheetDir/reset.css" ?>" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo "$stylesheetDir/print.css" ?>" type="text/css" media="print" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php 
    function enqueue_scripts() {
        wp_enqueue_script("jquery");
        wp_enqueue_script('mediaqueries', get_template_directory_uri() . '/css3-mediaqueries.js', array());
        wp_enqueue_script('jqdock', get_template_directory_uri() . '/jquery.jqdock.min.js', array('jquery'));
        wp_enqueue_script('addthis', 'http://s7.addthis.com/js/250/addthis_widget.js#pubid=Alpha', array('jquery'));
    }
	?>
    
    <?php add_action('wp_enqueue_scripts', 'enqueue_scripts'); ?>
    <?php wp_head(); ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
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
            
            // embed resize fix
            $('article iframe').removeAttr('width');
			$('article video').removeAttr('width').removeAttr('height');
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
                        <h1><a href="<?php echo $titleLink ?>"><?php echo $title ?></a></h1>
                        <?php if(strlen($pageSubtitle) > 0) { ?>
                            <h2><?php echo $pageSubtitle ?></h2>
                        <?php } ?>
                    </hgroup>
                </div>
                <div class="twocol last searchForm">
                    <?php get_search_form() ?>
                </div>
            </div>
        </div>
    </header>
    <div id="postsContainer" class="container">
        <?php while(have_posts()) :
                  the_post(); ?>
            <article class="row">
                <div class="metadata twocol">
                    <time pubdate date="<?php the_time("Y-m-d") ?>" class="datetime"><?php the_time(get_option('date_format')); ?><br/><?php the_time() ?></time>
                    <div class="categories"><?php the_category(', ') ?></div>
                </div>
                <div id="post-<?php echo the_ID() ?>" <?php post_class('post eightcol') ?>>
                    <?php the_content(); ?>
                </div>
                <div class="twocol last postLinks">
                    <div class="permalink"><a href="<?php the_permalink() ?>">(Permalink)</a></div>
                    <?php 
                  $commentsNumber = get_comments_number();
                  $commentNumberText = $commentsNumber > 0 
                      ? number_format_i18n($commentsNumber)
                          . " comentario"
                          . ($commentsNumber > 1 ? "s" : "")
                      : "Sin comentarios aún.";     
                    ?>
                    <div class="share"></div>
                    <script type="text/javascript">
                        var configuration = {
                            url: "<?php the_permalink() ?>",
                            title: "<?php the_title() ?>"
                        };
                        addthis.button('.share', configuration);
                    </script>
                    <div class="commentCount"><a href="<?php the_permalink() ?>#comments"><?php echo $commentNumberText ?></a></div>
                    <div class="tags"><p><?php 
                  echo get_the_tags()
                  ? the_tags()
                  : "(Sin tags)";
                    ?></p></div>
                </div>
            </article>
            <?php 
              comments_template(); 
              endwhile; // while (have_posts())
        ?>
    </div>
    <nav>
        <?php
        $categories = get_categories(array(
            'hierarchical' => false
        ));
        ?>
        <ul id="dockMenu">
            <?php 
            foreach ($categories as $cat) {
                $slug = $cat->slug;
                    ?>
                        <li>
                            <a href="<?php echo get_category_link($cat->cat_ID) ?>" title="<?php echo $cat->name ?>">
                                <img src="<?php echo "$stylesheetDir/icon-$slug.png" ?>" alt="<?php echo $cat->name ?>" width="128" height="128" />
                            </a>
                        </li>
                    <?php
            }
            ?>
        </ul>
    </nav>
    <footer>
        <?php wp_footer(); ?> 
    </footer>
</body>
</html>