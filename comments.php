<?php if (!is_page() || comments_open()) { // comments section
    // special case when we show nothing: page with comments disabled
    // negating: every other case, which comes below ?>
    <div class="comments title row columnContainer">
        <div class="column colSize4">
            <h2><?php echo __('Comments', 'alphas-manifesto') ?></h2>

            <?php if(have_comments()) { ?>
                <ul class="commentList">
                    <?php wp_list_comments(array('style' => 'ul', 'avatar_size' => 100)); ?>
                </ul>
                <div class="commentPagination">
                    <?php paginate_comments_links(); ?>
                </div>
            <?php } else { ?>
                <p class="comments-no-comments"><?php echo __('(There are currently no comments for this post.)', 'alphas-manifesto') ?></p>
            <?php }

            if (!comments_open()) {
                ?> <p class="comments-disabled"><?php echo __('(Comments are disabled for this post.)', 'alphas-manifesto') ?></p> <?php
            } else { // comments are open
                comment_form();
            } ?>
        </div>
    </div>
<?php } // end: comments section ?>
