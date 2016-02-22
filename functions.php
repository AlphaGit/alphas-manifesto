<?php
    if (!isset($content_width)) {
        $content_width = 745;
    }

    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');

    add_theme_support('post-thumbnails');
    add_image_size('full-size', $content_width, 9999);

    add_theme_support('custom-background', array('default-color' => 'white'));

    add_image_size('alphasmanifesto-logo-size', 170, 100);
    add_theme_support('site-logo', array('size' => 'alphasmanifesto-logo-size'));

    /********************************************************************/
    // Custom theme options

    require_once 'theme_options.php';

    add_action('customize_register', 'alphasmanifesto_customize_register');

    /********************************************************************/
    // Admin editor styles

    if(!function_exists("alphasmanifesto_add_editor_styles")) {
        function alphasmanifesto_add_editor_styles() {
            add_editor_style('style.css');
        }
    }

    add_action('admin_init', 'alphasmanifesto_add_editor_styles');

    /********************************************************************/
    // Widget support

    if(!function_exists('alphasmanifesto_init_widgets')) {
        function alphasmanifesto_init_widgets() {
            register_sidebar( array(
                'name'          => 'Left sidebar',
                'id'            => 'left_sidebar',
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>'
            ) );
        }
    }

    add_action('widgets_init', 'alphasmanifesto_init_widgets');

    /********************************************************************/
    // Enqueuing styles and scripts

    if (!function_exists('alphasmanifesto_enqueue_scripts_and_styles')) {
        function alphasmanifesto_enqueue_scripts_and_styles() {
            wp_enqueue_style('style', get_stylesheet_uri());
            wp_enqueue_script('html5shiv', get_template_directory_uri() . '/html5shiv.min.js');
            
            if (is_singular() && comments_open() && get_option('thread_comments')) {
                wp_enqueue_script('comment-reply');
            }
        }
    }

    add_action('wp_enqueue_scripts', 'alphasmanifesto_enqueue_scripts_and_styles');

?>