<?php
    // in multiple post pages, show navigation only if there is navigation to show
    $postsNavLinkResult = get_posts_nav_link();
    if (!is_singular() && !empty($postsNavLinkResult)) {
?>
    <footer class="columnContainer">
        <p><?php posts_nav_link(" &bull; ", __('&laquo; Next posts', 'alphas-manifesto'), __('Previous posts &raquo;', 'alphas-manifesto')); ?></p>
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
<!-- Theme: alphasmanifesto - https://github.com/alphagit/alphasmanifesto -->
</body>
</html>