<?php
    add_theme_support( 'automatic-feed-links' );


    /********************************************************************/
    // Custom menu support

    require_once 'custom_menu.php';
    require_once 'custom_menu_setup.php';

    /********************************************************************/

    function alphasmanifesto_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
?>
        <article class="comment row" id="comment-<?php echo comment_ID(); ?>">
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
                <div class="commentAuthor">
                    <div class="commentAvatar"><?php echo get_avatar($comment);  ?></div>
                    <p class="commentAuthorName"><?php echo get_comment_author_link(); ?></p>
                    <p><?php echo get_comment_date(); ?></p>
                    <time pubdate datetime="<?php echo get_comment_time("c") ?>"><?php echo get_comment_time(); ?></time>
                </div>
                <?php if ( $comment->comment_approved == '0' ) { ?>
                    <p class="needModeration">El comentario está pendiente de aprobación.</p>
                <?php } else {
                    comment_text();
                } ?>
                <hr class="commentSeparator" />
            </div>
            <div class="twocol last"></div>
<?php 
        }
?>
        </article>
<?php
    }
?>
