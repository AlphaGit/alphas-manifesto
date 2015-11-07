<?php
    get_header();
    $stylesheetDir = get_bloginfo( 'stylesheet_directory' );
    $show_author_name = get_option( 'show_author_name' );
?>
    <div id="postsContainer" class="container">
        <?php while(have_posts()) : the_post(); ?>
            <article id="post-<?php echo the_ID() ?>" <?php post_class('post row') ?>>
                <div class="twocol">
                </div>
                <div class="eightcol postContent">
                    <?php
                        $the_title = get_the_title();
                        $the_subtitle = get_post_meta(get_the_ID(), 'subtitle', true);

                        if (strlen($the_title) || strlen($the_subtitle)) {
                            ?>
                                <hgroup>
                                    <?php if(strlen($the_title) > 0) {
                                        ?>
                                            <h1><a href="<?php the_permalink() ?>"><?php echo $the_title ?></a></h1>
                                        <?php
                                    } ?>
                                    <?php if(strlen($the_subtitle) > 0) {
                                        ?>
                                            <h2 class="subtitle"><?php echo $the_subtitle ?></h2>
                                        <?php
                                    } ?>
                                </hgroup>
                            <?php
                        }
                    ?>

                    <?php the_content('(Read more &rarr;)'); ?>
                </div>
                <div class="twocol last postLinks metadata">
                    <time pubdate date="<?php the_time("Y-m-d") ?>" class="datetime">
                        <span class="date"><?php the_time(get_option('date_format')); ?></span>
                        <span class="time"><?php the_time() ?></span>
                    </time>
                    <div class="categories"><?php the_category(', ') ?></div>

                    <div class="permalink"><a href="<?php the_permalink() ?>">(Permalink)</a></div>
                    <?php
                        $commentsNumber = get_comments_number();
                        $commentNumberText = $commentsNumber > 0
                            ? number_format_i18n($commentsNumber)
                                . " comment"
                                . ($commentsNumber > 1 ? "s" : "")
                            : "No comments yet.";
                    ?>
                    <div class="commentCount"><a href="<?php the_permalink() ?>#comments"><?php echo $commentNumberText ?></a></div>

                    <?php wp_link_pages(array(
                        'before' => '<div class="postPages"><p>Pages:</p><ul>',
                        'after' => '</ul></div>',
                        'link_before' => '<li>',
                        'link_after' => '</li>',
                        'next_or_number' => 'number',
                        'pagelink' => 'Page %'
                    )); ?>

                    <div class="tags"><p><?php
                        echo get_the_tags()
                            ? the_tags()
                            : "(No tags)";
                    ?></p></div>

                    <?php if($show_author_name) { ?>
                        <div class="author">por <span class="name"><?php the_author() ?></span></div>
                    <?php } ?>
                    <?php edit_post_link('Edit...', '<div class="edit">', '</div>') ?>
                </div>
            </article>
            <?php  endwhile; // while (have_posts())
        ?>
    </div>
    <?php
        if (!empty(get_posts_nav_link())) {
    ?>
        <footer class="container">
            <div class="row">
                <div class="twocol"></div>
                <div class="eightcol">
                    <p><?php posts_nav_link(" &bull; ", "&laquo; Next posts", "Previous posts &raquo;"); ?></p>
                </div>
                <div class="twocol last"></div>
            </div>
        </footer>
    <?php
        }
    ?>
<?php get_footer(); ?>