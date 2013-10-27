<?php 
    get_header(); 
    $blogUrl = get_bloginfo('url');
    $stylesheetDir = get_bloginfo( 'stylesheet_directory' );
?>
<div id="postsContainer" class="container">
    <article id="" class="row">
        <div class="metadata twocol"> </div>
        <div class="eightcol postContent">
            <h1>Oooops!</h1>
            <h2 class="subtitle">Nada por aquí. Tampoco por acá.</h2>
            <p>No hay nada por aquí &ndash; ¿quizá lo que estabas buscando está en otro lado?</p>
            <p>Puedes intentar <a href="<?php echo $blogUrl ?>">visitando la página principal</a>
                o usando el siguiente formulario de búsqueda: </p>
            <?php get_search_form(); ?>
        </div>
        <div class="twocol last"> </div>
    </article>
</div>
<?php get_footer(); ?>