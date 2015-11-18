<?php if (!is_page() || comments_open()) { // comments section
    // special case when we show nothing: page with comments disabled
    // negating: every other case, which comes below ?>
    <div class="comments title row columnContainer">
        <div class="column colSize4">
            <h2>Comments</h2>

            <?php if(have_comments()) { ?>
                <ul class="commentList">
                    <?php wp_list_comments(array('style' => 'ul')); ?>
                </ul>
                <div class="commentPagination">
                    <?php paginate_comments_links(); ?>
                </div>
            <?php } else { ?>
                <p class="comments-no-comments">(There are currently no comments for this post.)</p>
            <?php }

            if (!comments_open()) {
                ?> <p class="comments-disabled">(Comments are disabled for this post.)</p> <?php
            } else { // comments are open
                comment_form();
            } ?>
        </div>
    </div>
<?php } // end: comments section ?>
