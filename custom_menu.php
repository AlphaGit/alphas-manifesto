<?php
    add_theme_support( 'nav-menus' );

    //http://codex.wordpress.org/Navigation_Menus
    if (!function_exists("alphasmanifesto_register_menus")) {
        function alphasmanifesto_register_menus() {
            register_nav_menus(array('footer-menu' => "Footer menu"));
        }
    }

    add_action('init', 'alphasmanifesto_register_menus');
?>