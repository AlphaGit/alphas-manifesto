<?php
    add_theme_support( 'nav-menus' );

    //http://codex.wordpress.org/Navigation_Menus
    if (!function_exists("alphasmanifesto_register_menus")) {
        function alphasmanifesto_register_menus() {
            register_nav_menus(array('footer-menu' => "Menu al pie"));
        }
    }

    add_action('init', 'alphasmanifesto_register_menus');

    class AlphasManifestoNavMenuWalker extends Walker_Nav_Menu {
        /**
         * @see Walker::start_el()
         * @since 3.0.0
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param object $item Menu item data object.
         * @param int $depth Depth of menu item. Used for padding.
         * @param int $current_page Menu item ID.
         * @param object $args
         */
        function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

            $output .= $indent . '<li' . '>';

            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

            $title = apply_filters( 'the_title', $item->title, $item->ID );

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= "<img src='{$item->image_url}' alt='{$item->title}' width='128' height='128' title='$title' />";
            $item_output .= $args->link_before . $title . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }

        /**
         * @see Walker::end_el()
         * @since 3.0.0
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param object $item Page data object. Not used.
         * @param int $depth Depth of page. Not Used.
         */
        function end_el( &$output, $item, $depth = 0, $args = array() ) {
            $output .= "</li>\n";
        }
    }
?>