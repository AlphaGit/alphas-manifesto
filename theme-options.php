<?php

if (!function_exists("alphasmanifesto_customize_register")) {
	function alphasmanifesto_customize_register($wp_customize) {
		$wp_customize->add_section('alphas-manifesto-misc_section', array(
			'title' => __('Miscelaneous', 'alphas-manifesto'),
			'priority' => 160 // last
		));

		$wp_customize->add_setting('alphas-manifesto-show_author_name_setting', array(
			'default' => true,
			'type' => 'theme_mod',
			'sanitize_callback' => 'wp_validate_boolean'
		));

		$wp_customize->add_control(new WP_Customize_Control(
			$wp_customize,
			'alphas-manifesto-show_author_name_control',
			array(
				'label' => __('Display the author name on posts', 'alphas-manifesto'),
				'description' => __('Allows for author name to not be shown, for example, if there is only one author for the blog', 'alphas-manifesto'),
				'type' => 'checkbox',
				'settings' => 'alphas-manifesto-show_author_name_setting',
				'section' => 'alphas-manifesto-misc_section'
			)
		));
	}
}

?>