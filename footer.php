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
        <?php
        /*<ul id="dockMenu">
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
        */
        ?>
    </nav>
    <?php wp_footer(); ?> 
</body>
</html>