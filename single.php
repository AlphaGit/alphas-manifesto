<?php 
    get_header(); 
    $stylesheetDir = get_bloginfo( 'stylesheet_directory' );
    $show_author_name = get_option( 'show_author_name' );
?>
    <?php while(have_posts()) : the_post(); ?>
        <div id="postsContainer" class="container">
                <article id="post-<?php echo the_ID() ?>" <?php post_class('post row') ?>>
                    <div class="metadata twocol">
                        <time pubdate date="<?php the_time("Y-m-d") ?>" class="datetime"><?php the_time(get_option('date_format')); ?><br/><?php the_time() ?></time>
                        <div class="categories"><?php the_category(', ') ?></div>
                        <?php if($show_author_name) { ?>
                            <div class="author">por <span class="name"><?php the_author() ?></span></div>
                        <?php } ?>
                        <?php edit_post_link('Editar...', '<div class="edit">', '</div>') ?>
                    </div>
                    <div class="eightcol postContent">
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
                        <?php wp_link_pages(array(
                            'before' => '<div class="postPages"><p>Páginas:</p><ul>',
                            'after' => '</ul></div>',
                            'link_before' => '<li>',
                            'link_after' => '</li>',
                            'next_or_number' => 'number',
                            'pagelink' => 'Página %'
                        )); ?>
                        <div class="tags"><p><?php 
                      echo get_the_tags()
                      ? the_tags()
                      : "(Sin tags)";
                        ?></p></div>
                    </div>
                </article>
                <?php 
                    if (!post_password_required()) {
                        comments_template(); 
                    }
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