<form method="get" class="searchForm" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="s"><?php echo _x('Search:', 'verb', 'alphas-manifesto') ?></label>
    <input type="text" class="searchTerm" name="s" id="s" placeholder="<?php echo __('Search term', 'alphas-manifesto') ?>" value="<?php the_search_query() ?>" />
    <input type="submit" value="<?php echo _x('Search', 'verb', 'alphas-manifesto') ?>" class="searchSubmit" />
</form>