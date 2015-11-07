<?php
/**
 * Template Name: Archives Template
*/
    get_header();
    $stylesheetDir = get_bloginfo( 'stylesheet_directory' );
    $show_author_name = get_option( 'show_author_name' );
?>
    <div id="postsContainer" class="container">
        <?php the_post(); ?>
        <article class="row">
            <div class="metadata twocol">
                <time pubdate date="<?php the_time("Y-m-d") ?>" class="datetime"><?php the_time(get_option('date_format')); ?><br/><?php the_time() ?></time>
                <div class="categories"><?php the_category(', ') ?></div>
                <?php if($show_author_name) { ?>
                    <div class="author">por <span class="name"><?php the_author() ?></span></div>
                <?php } ?>
                <?php edit_post_link('Edit...', '<div class="edit">', '</div>') ?>
            </div>
            <div id="post-<?php echo the_ID() ?>" <?php post_class('post eightcol') ?>>
                <?php the_content('(Read more &rarr;)'); ?>

                <h2>Archives by date:</h2>
                <ul>
                    <?php wp_get_archives(array(
                        'show_post_count' => true
                    )); ?>
                </ul>

                <h2>Archives by category:</h2>
                <ul>
                    <?php wp_list_categories(array(
                        'show_count' => true,
                        'title_li' => ''
                    )); ?>
                </ul>

                <h2>Archives by subject:</h2>
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
                <?php wp_link_pages(array(
                    'before' => '<div class="postPages"><p>Pages:</p><ul>',
                    'after' => '</ul></div>',
                    'link_before' => '<li>',
                    'link_after' => '</li>',
                    'next_or_number' => 'number',
                    'pagelink' => 'Page %'
                )); ?>
            </div>
        </article>
    </div>
<?php get_footer(); ?>