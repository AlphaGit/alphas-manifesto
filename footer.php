    <nav>
        <?php
            $stylesheetDir = get_bloginfo( 'stylesheet_directory' );
            $categories = get_categories(array(
                'hierarchical' => false
            ));
        ?>

        <?php 
            wp_nav_menu(array(
                    'theme_location' => 'footer-menu',
                    'container' => false,
                    'menu_id' => 'dockMenu',
                    'depth' => 1,
                    'walker' => new AlphasManifestoNavMenuWalker
                )
            );
        ?>
    </nav>
    <?php wp_footer(); ?> 
</body>
</html>