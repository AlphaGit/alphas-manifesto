<?php 
/**
 * Template Name: Archives Template 
*/
    get_header(); 
    $stylesheetDir = get_bloginfo( 'stylesheet_directory' );
?>
    <div id="postsContainer" class="container">
        <?php the_post(); ?>
        <article class="row">
            <div class="metadata twocol">
                <time pubdate date="<?php the_time("Y-m-d") ?>" class="datetime"><?php the_time(get_option('date_format')); ?><br/><?php the_time() ?></time>
                <div class="categories"><?php the_category(', ') ?></div>
            </div>
            <div id="post-<?php echo the_ID() ?>" <?php post_class('post eightcol') ?>>
                <?php the_content(); ?>

                <h2>Archivos por fecha:</h2>
                <ul>
                    <?php wp_get_archives(array(
                        'show_post_count' => true
                    )); ?>
                </ul>

                <h2>Archivos por categoría:</h2>
                <ul>
                    <?php wp_list_categories(array(
                        'show_count' => true,
                        'title_li' => ''
                    )); ?>
                </ul>

                <h2>Archivos por tema:</h2>
                <ul>
                <?php
                    $tags = get_tags(); 
                    foreach ($tags as $tag) {
                        $tagLink = get_tag_link($tag->term_id);
                        echo "<li><a href='{$tagLink}' title='{$tag->name}'>{$tag->name}</a> ({$tag->count})</li>";
                    }
                ?>
                </ul>
            </div>
            <div class="twocol last postLinks">
                <div class="permalink"><a href="<?php the_permalink() ?>">(Permalink)</a></div>
            </div>
        </article>
    </div>
    <footer class="container">
    </footer>
<?php get_footer(); ?>