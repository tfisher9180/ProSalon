<?php
/**
 * ProSalon Theme Customizer
 *
 * @package ProSalon
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function prosalon_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_section( 'title_tagline' )->panel				= 'theme_options';
	$wp_customize->get_section( 'title_tagline' )->title				= __( 'Logo', 'prosalon' );
	$wp_customize->get_control( 'custom_logo' )->description		= __( 'Uploading an image will override the default text logo.', 'prosalon' );
	$wp_customize->remove_control( 'blogname' );
	$wp_customize->remove_control( 'blogdescription' );
	$wp_customize->remove_control( 'display_header_text' );

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'prosalon_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'prosalon_customize_partial_blogdescription',
		) );
	}

	$wp_customize->add_panel( 'theme_options', array(
		'priority'					=> 10,
		'capability'				=> 'edit_theme_options',
		'theme_supports'		=> '',
		'title'							=> __( 'Theme Options', 'prosalon' ),
	) );

	$wp_customize->add_setting( 'logo_text_primary', array(
		'default'						=> 'Pro',
		'type'							=> 'theme_mod',
		'sanitize_callback'	=> 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'logo_text_primary', array(
		'type'							=> 'text',
		'section'						=> 'title_tagline',
		'label'							=> __( 'Text Logo Primary', 'prosalon' ),
		'description'				=> __( 'Theme colored portion of the logo.', 'prosalon' ),
	) );

	$wp_customize->add_setting( 'logo_text_secondary', array(
		'default'						=> 'Salon',
		'type'							=> 'theme_mod',
		'sanitize_callback'	=> 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'logo_text_secondary', array(
		'type'							=> 'text',
		'section'						=> 'title_tagline',
		'label'							=> __( 'Text Logo Secondary', 'prosalon' ),
		'description'				=> __( 'Second portion of the logo.', 'prosalon' ),
	) );

	$wp_customize->add_section( 'business_info', array(
		'title'							=> __( 'Business Info', 'prosalon' ),
		'panel'							=> 'theme_options',
	) );

	$wp_customize->add_setting( 'business_info_hours', array(
		'default'						=> '',
		'type'							=> 'theme_mod',
		'sanitize_callback'	=> 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'business_info_hours', array(
		'type'							=> 'text',
		'section'						=> 'business_info',
		'label'							=> __( 'Salon Hours', 'prosalon' ),
		'description'				=> __( 'Enter your salon hours here.', 'prosalon' ),
		'input_attrs'				=> array(
			'placeholder'				=> __( 'Mon - Sat: 8:00AM - 9:00PM', 'prosalon' ),
		),
	) );

	$wp_customize->add_setting( 'business_info_phone', array(
		'default'						=> '',
		'type'							=> 'theme_mod',
		'sanitize_callback'	=> 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'business_info_phone', array(
		'type'							=> 'text',
		'section'						=> 'business_info',
		'label'							=> __( 'Salon Number', 'prosalon' ),
		'description'				=> __( 'Enter your salon contact number here.', 'prosalon' ),
		'input_attrs'				=> array(
			'placeholder'				=> __( '555-555-5555', 'prosalon' ),
		),
	) );

	$wp_customize->add_setting( 'business_info_email', array(
		'default'						=> '',
		'type'							=> 'theme_mod',
		'sanitize_callback'	=> 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'business_info_email', array(
		'type'							=> 'text',
		'section'						=> 'business_info',
		'label'							=> __( 'Salon E-mail', 'prosalon' ),
		'description'				=> __( 'Enter your salon e-mail address here.', 'prosalon' ),
		'input_attrs'				=> array(
			'placeholder'				=> __( 'info@prosalon.com', 'prosalon' ),
		),
	) );

	$wp_customize->add_section( 'social_media', array(
		'title'							=> __( 'Social Media', 'prosalon' ),
		'panel'							=> 'theme_options',
	) );

	// Facebook
	// -----------------------------
	$wp_customize->add_setting( 'url_facebook', array(
		'default'			=> 'https://www.facebook.com',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'transport'			=> '',
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( 'url_facebook', array(
		'type'				=> 'url',
		'section'			=> 'social_media',
		'label'				=> __( 'Facebook URL', 'srcc' ),
		'description'		=> '',
	) );


	// Twitter
	// -----------------------------
	$wp_customize->add_setting( 'url_twitter', array(
		'default'			=> 'https://www.twitter.com',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'transport'			=> '',
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( 'url_twitter', array(
		'type'				=> 'url',
		'section'			=> 'social_media',
		'label'				=> __( 'Twitter URL', 'srcc' ),
		'description'		=> '',
	) );


	// Instagram
	// -----------------------------
	$wp_customize->add_setting( 'url_instagram', array(
		'default'			=> 'https://www.instagram.com',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'transport'			=> '',
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( 'url_instagram', array(
		'type'				=> 'url',
		'section'			=> 'social_media',
		'label'				=> __( 'Instagram URL', 'srcc' ),
		'description'		=> '',
	) );


	// Google
	// -----------------------------
	$wp_customize->add_setting( 'url_google', array(
		'default'			=> '',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'transport'			=> '',
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( 'url_google', array(
		'type'				=> 'url',
		'section'			=> 'social_media',
		'label'				=> __( 'Google URL', 'srcc' ),
		'description'		=> '',
	) );


	// LinkedIn
	// -----------------------------
	$wp_customize->add_setting( 'url_linkedin', array(
		'default'			=> 'https://www.linkedin.com',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'transport'			=> '',
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( 'url_linkedin', array(
		'type'				=> 'url',
		'section'			=> 'social_media',
		'label'				=> __( 'LinkedIn URL', 'srcc' ),
		'description'		=> '',
	) );
}
add_action( 'customize_register', 'prosalon_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function prosalon_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function prosalon_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function prosalon_customize_preview_js() {
	wp_enqueue_script( 'prosalon-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'prosalon_customize_preview_js' );
