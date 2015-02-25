<?php
/**
 * amora Theme Customizer
 *
 * @package amora
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function amora_customize_register( $wp_customize ) {
		
	$wp_customize->get_section( 'colors' )->description	= __( 'Background may only be visible on wide screens.', 'amora' );
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	$wp_customize->add_setting('title_color', array(
	'default'		=>	'#6669d2',
	'transport'		=>	'refresh',
	'sanitize_callback'	=>	'sanitize_hex_color',
			)
		); 
		
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize, 'title_color', array(
	'label'		=> 'Site Title Color',
	'section'	=> 'colors',
	'settings'	=> 'title_color',
			)
		)
	);
}
add_action( 'customize_register', 'amora_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function amora_customize_preview_js() {
	wp_enqueue_script( 'amora_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'amora_customize_preview_js' );
