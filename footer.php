    <?php 
        if (has_nav_menu('footer-menu')) {
            ?>
                <nav>
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
            <?php
        }
    ?>
    <?php wp_footer(); ?> 
</body>
</html>