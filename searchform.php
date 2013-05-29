<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="s">Buscar:</label>
    <input type="text" class="field" name="s" id="s" placeholder="Buscar (presiona Enter)" value="<?php the_search_query() ?>" />
</form>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#searchform input').keyup(function(evt) {
            if (event.which == 13) {
                evt.preventDefault();
                $('#searchform').submit();
            }
        });
    });
</script>