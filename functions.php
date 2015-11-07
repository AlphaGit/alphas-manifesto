<?php
    $content_width = 745;

    add_theme_support( 'automatic-feed-links' );

    /********************************************************************/
    // Custom menu support

    require_once 'custom_menu.php';

    /********************************************************************/
    // Custom theme options

    require_once 'theme_options.php';

    add_action('admin_init', 'alphasmanifesto_admin_init');
    add_action('admin_menu', 'alphasmanifesto_admin_menu');

    if (!function_exists("alphasmanifesto_comment")) {
        function alphasmanifesto_comment($comment, $args, $depth) {
            $GLOBALS['comment'] = $comment;
        ?>
            <article <?php comment_class("row"); ?> id="comment-<?php echo comment_ID(); ?>">
        <?php
            switch ($comment->comment_type) {
                case 'pingback':
                case 'trackback':
        ?>
                <div class="twocol"></div>
                <div class="commentContent trackback eightcol">
                    <p><strong>Trackback:</strong> <?php comment_author_link(); ?></p>
                </div>
                <div class="twocol last"></div>
        <?php
                    break;
                default:
        ?>
                <div class="twocol"></div>
                <div class="commentContent eightcol">
                    <div class="commentContentContainer">
                        <div class="commentAuthor">
                            <div class="commentAvatar"><?php echo get_avatar($comment);  ?></div>
                            <p class="commentAuthorName"><?php echo get_comment_author_link(); ?></p>
                            <p class="commentDate"><?php echo get_comment_date(); ?></p>
                            <time pubdate datetime="<?php echo get_comment_time("c") ?>"><?php echo get_comment_time(); ?></time>
                        </div>
                        <?php if ( $comment->comment_approved == '0' ) { ?>
                            <p class="needModeration">The comment is pending moderation.</p>
                        <?php } else {
                            comment_text();
                        } ?>
                    </div>
                    <div class="commentActions">
                        <?php comment_reply_link(array(
                            'after' => ' | ',
                            'add_below' => 'comment',
                            'depth' => $depth,
                            'respond_id' => 'commentForm',
                            'max_depth' => $args['max_depth'],
                            'reply_text' => '(Reply)',
                            'login_text' => '(You need to log in before leaving a comment)'
                        )) ?>

                        <?php edit_comment_link(__('(Edit)'), null, ' | '); ?>

                        <a href="<?php echo get_comment_link(); ?>">(Permalink)</a>
                    </div>
                    <hr class="commentSeparator" />
                </div>
                <div class="twocol last"></div>
        <?php
            } // switch ($comment->comment_type) {
        ?>
            </article>
        <?php
        } // function alphasmanifesto_comment
    } // if (!function_exists("alphasmanifesto_comment"))
?>
