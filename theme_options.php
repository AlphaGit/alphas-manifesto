<?php

if (!function_exists("alphasmanifesto_admin_init")) {
	function alphasmanifesto_admin_init() {
		register_setting('alphasmanifesto_options', 'show_author_name');
	}
}

if (!function_exists("alphasmanifesto_admin_menu")) {
	function alphasmanifesto_admin_menu() {
		add_theme_page(__('Theme Options', 'alphas-manifesto'), __('Theme Options', 'alphas-manifesto'), 'edit_theme_options', 'alphasmanifesto_options_page', 'alphasmanifesto_options_page');
	}
}

if (!function_exists("alphasmanifesto_options_page")) {
	function alphasmanifesto_options_page() {
		//global $select_options;
		if ( ! isset( $_REQUEST['settings-updated'] ) )
			$_REQUEST['settings-updated'] = false;
	?>
		<div>
			<h1><?php echo __('Theme options', 'alphas-manifesto') ?></h1>
			<?php if ( false !== $_REQUEST['settings-updated'] ) { ?>
				<div>
					<p><em><?php echo __('Options saved') ?></em></p>
				</div>
			<?php } ?>

			<form method="post" action="options.php">
				<?php settings_fields( 'alphasmanifesto_options' ); ?>

				<?php $show_author_name = get_option( 'show_author_name' ); ?>
				<input id="show-author-name" name="show_author_name" type="checkbox" <?php checked( 'on', $show_author_name ) ?> />
				<label for="show-author-name"><?php echo __('Display the author name on posts', 'alphas-manifesto') ?></label>

				<br />
				<input type="submit" value="<?php echo _x('Save', 'verb', 'alphas-manifesto') ?>" />
			</form>
		</div>
		<?php
	}
}
?>