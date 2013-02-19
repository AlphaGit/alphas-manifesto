<?php 
    get_header(); 
    $stylesheetDir = get_bloginfo( 'stylesheet_directory' );

?>
    <?php while(have_posts()) : the_post(); ?>
        <div id="postsContainer" class="container">
                <article class="row">
                    <div class="metadata twocol">
                        <time pubdate date="<?php the_time("Y-m-d") ?>" class="datetime"><?php the_time(get_option('date_format')); ?><br/><?php the_time() ?></time>
                        <div class="categories"><?php the_category(', ') ?></div>
                    </div>
                    <div id="post-<?php echo the_ID() ?>" <?php post_class('post eightcol') ?>>
                        <?php the_content(); ?>
                    </div>
                    <div class="twocol last postLinks">
                        <div class="permalink"><a href="<?php the_permalink() ?>">(Permalink)</a></div>
                        <?php 
                            $commentsNumber = get_comments_number();
                            $commentNumberText = $commentsNumber > 0
                                ? number_format_i18n($commentsNumber)
                              . " comentario"
                              . ($commentsNumber > 1 ? "s" : "")
                          : "Sin comentarios a&uacute;n.";     
                        ?>
                        <div class="commentCount"><a href="<?php the_permalink() ?>#comments"><?php echo $commentNumberText ?></a></div>
                        <div class="tags"><p><?php 
                      echo get_the_tags()
                      ? the_tags()
                      : "(Sin tags)";
                        ?></p></div>
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