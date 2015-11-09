<?php
    if (!isset($content_width)) {
        $content_width = 745;
    }

    add_theme_support( 'automatic-feed-links' );

    /********************************************************************/
    // Custom menu support

    require_once 'custom_menu.php';

    /********************************************************************/
    // Custom theme options

    require_once 'theme_options.php';

    add_action('admin_init', 'alphasmanifesto_admin_init');
    add_action('admin_menu', 'alphasmanifesto_admin_menu');
?>
