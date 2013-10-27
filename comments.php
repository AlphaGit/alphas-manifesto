<?php if (!is_page() || comments_open()) { // special case when we show nothing: page with comments disabled 
    // negating: every other case, which comes below ?>
    <div class="comments title row">
        <div class="twocol"></div>
        <div class="eightcol">
            <h2>Comentarios</h2>
        </div>
        <div class="twocol last"></div>
    </div>

    <?php if(have_comments()) {
        wp_list_comments( array( 'callback' => 'alphasmanifesto_comment' ) );
        ?>
        <div class="row">
            <div class="twocol"></div>
            <div class="commentPagination eightcol">
                 <?php paginate_comments_links(); ?> 
            </div>
            <div class="twocol last"></div>
        </div>
        <?php
    } else if (comments_open()) { // no comments -- if !have_comments() and comments_open() 
        // we check it like this because we don't want to display two messages if there are
        // no comments AND comments are closed -- see below for that ?>
        <div class="noComments row">
            <div class="twocol"></div>
            <div class="comment eightcol">
                <p>(Actualmente no hay comentarios para este post.)</p>
            </div>
            <div class="twocol last"></div>
        </div>
    <?php } //  if !have_comments() and comments_open() ?>

    <?php if (comments_open()) { ?>
        <div id="commentForm" class="row">
            <div class="twocol"></div>
            <div class="eightcol">
                <?php 
                    global $post_id;
                    global $user_identity;

                    $commenter = wp_get_current_commenter();
                    $req = get_option('require_name_email');
                    $aria_req = $req ? " aria-required='true'" : '';

                    $defaults = array(
                        'fields' => apply_filters('comment_form_default_fields', array(
                                'author' => '<p class="commentFormAuthor"><label for="author">Nombre:</label><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" tabindex="1"' . $aria_req . ' /></p>',
                                'email'  => '<p class="commentFormEmail"><label for="email">Email:</label><input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" tabindex="2"' . $aria_req . ' /></p>',
                                'url' => '<p class="commentFormUrl"><label for="url">Web:</label><input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" tabindex="3" /></p>'
                            ) 
                        ),
                        'comment_field' => '<p class="commentFormComment"><label for="comment">Comentario:</label><textarea id="comment" name="comment" cols="45" rows="8" tabindex="4" aria-required="true"></textarea></p>',
                        'logged_in_as' => '<p class="logged-in-as">' .
                            sprintf('Loggeado como <a href="%s">%s</a>. <a title="Desloggearse" href="%s">Desloggearse?</a></p>',
                                    admin_url( 'profile.php' ),
                                    $user_identity,
                                    wp_logout_url(
                                        apply_filters('the_permalink', get_permalink($post_id))
                                    )
                            ),
                        'comment_notes_before' => null,
                        'comment_notes_after' => null,
                        'id_form' => 'commentform',
                        'id_submit' => 'commentSubmit',
                        'title_reply' => 'Agrega tu comentario',
                        'title_reply_to' => 'Responde a %s',
                        'cancel_reply_link' => __( '(Cancelar respuesta)' ),
                        'label_submit' => 'Post',
                    );
                ?>
                <?php comment_form($defaults); ?>
            </div>
            <div class="twocol last"></div>
        </div>
    <?php } else { // if (comments_open()) ?>
        <div class="commentsDisabled row">
            <div class="twocol"></div>
            <div class="comment eightcol">
                <p>(Los comentarios se encuentran deshabilitados para este post.)</p>
            </div>
            <div class="twocol last"></div>
        </div>
    <?php } ?>
<?php } // end: special case when we show nothing: page with comments disabled?>
