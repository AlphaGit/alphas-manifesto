<?php
    get_header();
    $show_author_name = get_option( 'show_author_name' );
?>
<div class="columnContainer">
    <div class="column colSize1 leftSidebar">
        <?php if(is_active_sidebar('left_sidebar')) {
        ?>
            <input type="checkbox" id="displayMenus" class="menuSwitcher" />
            <label for="displayMenus" class="menuSwitcher"></label>
            <?php dynamic_sidebar('left_sidebar');
        } ?>
    </div><!-- This comment is a fix for inline-block spaces, do not remove
    --><div class="column colSize5 postContainer">
        <?php if(is_search()) { ?>
            <div class="columnContainer">
                <p class="column colSize5 searchHeader">These are the search results for <em><?php the_search_query() ?></em>.</p>
            </div>
        <?php } ?>

        <?php while(have_posts()) : the_post(); ?>
            <article id="post-<?php echo the_ID() ?>" <?php post_class('post columnContainer') ?>>
                <div class="postContent column colSize4">
                    <?php
                        if (!is_singular()) {
                            // show title and subtitle for each post

                            $the_title = get_the_title();
                            $the_subtitle = get_post_meta(get_the_ID(), 'subtitle', true);

                            $hasTitle = strlen($the_title) > 0;
                            $hasSubtitle = strlen($the_subtitle) > 0;

                            if($hasTitle || $hasSubtitle) { ?>
                                
                                <?php if($hasTitle) { ?>
                                    <h1>
                                        <a href="<?php the_permalink() ?>">
                                            <?php echo $the_title ?>
                                        </a>
                                    </h1>
                                <?php } ?>
                                <?php if($hasSubtitle) { ?>
                                    <p class="subtitle"><?php echo $the_subtitle ?></p>
                                <?php } ?>
                                
                            <?php }
                        }
                    
                    if (has_post_thumbnail()) {
                        ?> <p class="aligncenter"> <?php the_post_thumbnail(); ?> </p> <?php
                    }

                    the_content('(Read more &rarr;)'); ?>
                </div><!-- This comment is a fix for inline-block spaces, do not remove
                --><div class="metadata column colSize1">
                    <?php if(!is_page()) { ?>
                        <time datetime="<?php the_time(DateTime::ISO8601) ?>" class="datetime dt-published">
                            <span class="date"><?php the_time(get_option('date_format')); ?></span>
                            <span class="time"><?php the_time() ?></span>
                        </time>
                        <div class="categories"><?php the_category(', ') ?></div>
                    <?php } ?>

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

                    <?php if(!is_page()) { ?>
                        <div class="tags"><p><?php echo get_the_tags() ? the_tags() : "(No tags)"; ?></p></div>
                    <?php } ?>

                    <?php if($show_author_name && !is_page()) { ?>
                        <div class="author">by <span class="name"><?php the_author() ?></span></div>
                    <?php } ?>

                    <?php edit_post_link('Edit...', '<div class="edit">', '</div>') ?>
                </div>
            </article>
            <?php  endwhile; // while (have_posts())

            if (is_singular() && !post_password_required()) {
                comments_template();
            }
        ?>
    </div>
</div>

<?php
    // in multiple post pages, show navigation only if there is navigation to show
    $postsNavLinkResult = get_posts_nav_link();
    if (!is_singular() && !empty($postsNavLinkResult)) {
?>
    <footer class="columnContainer">
        <p><?php posts_nav_link(" &bull; ", "&laquo; Next posts", "Previous posts &raquo;"); ?></p>
    </footer>
<?php
    }

    // in single post pages, show navigation only if there are posts "around" it
    if (is_singular()) {
        //knowing if there'll be a next or a previous post
        //http://stackoverflow.com/questions/3003563/wordpress-previous-post-link-next-post-link-placeholder
        $previousPost = get_adjacent_post(false, '', true);
        $nextPost = get_adjacent_post(false, '', false);

        if ($nextPost || $previousPost) { ?>
            <footer class="columnContainer">
                <p>
                    <?php previous_post_link();
                    
                    if($nextPost && $previousPost) {
                        ?> &bull; <?php
                    }

                    next_post_link(); ?>
                </p>
            </footer>
    <?php } // $nextPost || $previousPost
    } // is_singular

    wp_footer(); 
?>
</body>
</html>
