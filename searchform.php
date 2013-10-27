<form method="get" class="searchForm" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="s">Buscar:</label>
    <input type="text" class="searchTerm" name="s" id="s" placeholder="Texto a buscar" value="<?php the_search_query() ?>" />
    <input type="submit" value="Buscar" class="searchSubmit" />
</form>