<form method="get" class="searchForm" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="s">Search:</label>
    <input type="text" class="searchTerm" name="s" id="s" placeholder="Search term" value="<?php the_search_query() ?>" />
    <input type="submit" value="Search" class="searchSubmit" />
</form>