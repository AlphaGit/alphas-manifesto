<?php
    get_header();
    $blogUrl = get_bloginfo('url');
    $stylesheetDir = get_bloginfo( 'stylesheet_directory' );
?>
<div id="postsContainer" class="container">
    <article id="" class="row">
        <div class="metadata twocol"> </div>
        <div class="eightcol postContent">
            <h1>Oooops!</h1>
            <h2 class="subtitle">Nothing over here. Neither over there.</h2>
            <p>There's nothing over here &ndash; maybe what you were looking for is somewhere else?</p>
            <p>You can <a href="<?php echo $blogUrl ?>">try visiting the main page</a>
                or using the following search form:</p>
            <?php get_search_form(); ?>
        </div>
        <div class="twocol last"> </div>
    </article>
</div>
<?php get_footer(); ?>