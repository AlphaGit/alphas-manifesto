<?php
    get_header();
    $stylesheetDir = get_bloginfo( 'stylesheet_directory' );
?>
    <?php while(have_posts()) : the_post(); ?>
        <div id="postsContainer" class="container">
                <article id="post-<?php echo the_ID() ?>" <?php post_class('post row') ?>>
                    <div class="metadata twocol"> </div>
                    <div class="eightcol postContent">
                        <?php the_content('(Read more &rarr;)'); ?>
                    </div>
                    <div class="twocol last postLinks">
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
                    </div>
                </article>
                <?php
                  comments_template();
            ?>
        </div>
        <footer class="container">
            <div class="row">
                <div class="twocol"></div>
                <div class="eightcol">
                    <p>
                        <?php previous_post_link();

                        //knowing if there'll be a next or a previous post
                        //http://stackoverflow.com/questions/3003563/wordpress-previous-post-link-next-post-link-placeholder
                        if(get_adjacent_post(false, '', true) && get_adjacent_post(false, '', false)) {
                            ?> &bull; <?php
                        }

                        next_post_link(); ?>
                    </p>
                </div>
                <div class="twocol last"></div>
            </div>
        </footer>
    <?php endwhile; // while (have_posts()) ?>

<?php get_footer(); ?>