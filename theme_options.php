<?php

function alphasmanifesto_admin_init() {
	register_setting('alphasmanifesto_options', 'show_author_name');
}

function alphasmanifesto_admin_menu() {
	add_theme_page('Opciones del tema', 'Opciones del tema', 'edit_theme_options', 'alphasmanifesto_options_page', 'alphasmanifesto_options_page');
}

function alphasmanifesto_options_page() {
	//global $select_options; 
	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false; 
?>
	<div>
		<h1>Opciones del Tema</h1>
		<?php if ( false !== $_REQUEST['settings-updated'] ) { ?>
			<div>
				<p><em>Opciones guardadas</em></p>
			</div>
		<?php } ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'alphasmanifesto_options' ); ?>  

			<?php $show_author_name = get_option( 'show_author_name' ); ?> 
			<input id="show-author-name" name="show_author_name" type="checkbox" <?php checked( 'on', $show_author_name ) ?> />
			<label for="show-author-name">Mostrar nombre de autor en los posts</label>

			<br />
			<input type="submit" value="Enviar" />
		</form>
	</div>
	<?php
}

?>