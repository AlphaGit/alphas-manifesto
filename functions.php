<?php
    if (!isset($content_width)) {
        $content_width = 745;
    }

    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');

    add_theme_support('post-thumbnails');
    add_image_size('full-size', $content_width, 9999);

    add_theme_support('custom-background', array('default-color' => 'white'));

    /********************************************************************/
    // Custom menu support

    add_theme_support( 'nav-menus' );

    //http://codex.wordpress.org/Navigation_Menus
    if (!function_exists("alphasmanifesto_register_menus")) {
        function alphasmanifesto_register_menus() {
            register_nav_menus(array('left-sidebar' => "Left Sidebar"));
        }
    }

    add_action('init', 'alphasmanifesto_register_menus');

    /********************************************************************/
    // Custom theme options

    require_once 'theme_options.php';

    add_action('admin_init', 'alphasmanifesto_admin_init');
    add_action('admin_menu', 'alphasmanifesto_admin_menu');

    /********************************************************************/
    // Admin editor styles

    if(!function_exists("alphasmanifesto_add_editor_styles")) {
        function alphasmanifesto_add_editor_styles() {
            add_editor_style('style.css');
        }
    }

    add_action('admin_init', 'alphasmanifesto_add_editor_styles');
?>
