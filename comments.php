<?php if (!is_page() || comments_open()) { // comments section
    // special case when we show nothing: page with comments disabled
    // negating: every other case, which comes below ?>
    <div class="comments title row columnContainer">
        <div class="column colSize4">
            <h2>Comments</h2>

            <?php if(have_comments()) {
                wp_list_comments( array( 'callback' => 'alphasmanifesto_comment' ) );
                paginate_comments_links();
            } else {
                ?> <p>(There are currently no comments for this post.)</p> <?php
            }

            if (!comments_open()) {
                ?> <p>(Comments are disabled for this post.)</p> <?php
            } else { // comments are open
                comment_form();
            } ?>
        </div>
    </div>
<?php } // end: comments section ?>
