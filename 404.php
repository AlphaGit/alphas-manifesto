<?php
    get_header();
?>
<div class="columnContainer">
    <div class="column colSize1">
        <?php wp_nav_menu(array(
            'theme_location' => 'left-sidebar',
            'container' => 'nav',
            'container_class' => 'leftMenu'
        )); ?>
    </div>
    <div class="column colSize5">
        <article class="post columnContainer">
            <div class="postContent column colSize4">
                <h1>Oooops!</h1>
                <h2 class="subtitle">Nothing over here. Neither over there.</h2>
                <p>There's nothing over here &ndash; maybe what you were looking for is somewhere else?</p>
                <p>You can <a href="<?php echo home_url() ?>">try visiting the main page</a>
                    or using the following search form:</p>
                <?php get_search_form(); ?>
            </div>
        </article>
    </div>
</div>
<?php get_footer(); ?>