<?php
/*
================================================================================================
Arlene Theme Customizer
================================================================================================
@package        Arlene
@link           https://codex.wordpress.org/Theme_Customization_API
@copyright      Copyright (C) 2017. Samuel Guebo
@license        GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
@author         Samuel Guebo (https://samuelguebo.co/)
================================================================================================
*/

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function arlene_customize_register( $wp_customize ) {
	
    
    /*
     * Theme colors using Customizer Custom Controls, 
     * @link https://github.com/bueltge/Wordpress-Theme-Customizer-Custom-Controls
     *
     */
    require_once dirname(__FILE__) . '/class-palette_custom_control.php';
    
    $wp_customize->remove_control('header_textcolor'); // remove existing Headline color setting
    $wp_customize->add_setting(
		'arlene_theme_color', array(
			'default' => '',
            'sanitize_callback'	=> 'arlene_sanitize_colors'

		)
	);
    
    $wp_customize->add_control(
            new Palette_Custom_Control(
                $wp_customize, 'arlene_theme_color', array(
                    'label' => __( 'Theme color', 'arlene' ),
                    'section' => 'colors',
                    'settings' => 'arlene_theme_color',
                )
            )
        );    
    
     /*
      * Events
      *
      */
    
    // Create sections for Events settings
    $wp_customize->add_section('arlene_events_section', array(
		'title' => __('Events', 'arlene'),
		'priority' => 30,
	));
    
    // Events page selector
    $wp_customize->add_setting('events_page', array(
		'default' => '#',
		'transport' => 'refresh',
        'sanitize_callback'	=> 'absint'

	));
    $wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		'events_page',
		array(
			'label' => __('Set what page must be used for listing the events.', 'arlene'),
			'section' => 'arlene_events_section',
			'settings' => 'events_page',
			'type' => 'dropdown-pages',
		)
	));
    
     // Events label
    $wp_customize->add_setting('events_label', array(
		'default' => __('Events', 'arlene'),
		'transport' => 'refresh',
        'sanitize_callback'	=> 'sanitize_text_field'

	));
    $wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		'events_label',
		array(
			'label' => __('Label for the Events section on homepage', 'arlene'),
			'section' => 'arlene_events_section',
			'settings' => 'events_label',
			'type' => 'text',
		)
	));
    
    /*
     * Programmes
     *
     */
    
    // Create sections for Programmes settings
    $wp_customize->add_section('arlene_programmes_section', array(
		'title' => __('Programmes', 'arlene'),
		'priority' => 30,
	));
    
    // Programmes page selector
    $wp_customize->add_setting('programmes_page', array(
		'default' => '#',
		'transport' => 'refresh',
        'sanitize_callback'	=> 'absint'

	));
    $wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		'programmes_page',
		array(
			'label' => __('Set what page must be used for listing the programmes.', 'arlene'),
			'section' => 'arlene_programmes_section',
			'settings' => 'programmes_page',
			'type' => 'dropdown-pages',
		)
	));
    
     // Programmes label
    $wp_customize->add_setting('programmes_label', array(
		'default' => __('Programmes', 'arlene'),
		'transport' => 'refresh',
        'sanitize_callback'	=> 'sanitize_text_field'

	));
    $wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		'programmes_label',
		array(
			'label' => __('Label for the Programmes section on homepage', 'arlene'),
			'section' => 'arlene_programmes_section',
			'settings' => 'programmes_label',
			'type' => 'text',
		)
	));
}
add_action( 'customize_register', 'arlene_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function arlene_customize_preview_js() {
	wp_enqueue_script( 'arlene_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20170425', true );
}

/* Validate user input */
get_template_part('inc/customizer-sanitize'); 
