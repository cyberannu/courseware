<?php


add_action('customize_register','nd_learning_customizer_archive_teachers');
function nd_learning_customizer_archive_teachers( $wp_customize ) {
  

	//ADD section 1
	$wp_customize->add_section( 'nd_learning_customizer_archive_teachers_section' , array(
	  'title' => 'Archive Teachers',
	  'priority'    => 10,
	  'panel' => 'nd_learning_customizer_learning',
	) );


	//Disable Header
	$wp_customize->add_setting( 'nd_learning_customizer_archive_teachers_header_image_display', array(
	  'type' => 'option', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => '',
	  'sanitize_js_callback' => '', // Basically to_json.
	) );
	$wp_customize->add_control( 'nd_learning_customizer_archive_teachers_header_image_display', array(
	  'label' => __( 'Disable Header Section' ),
	  'type' => 'checkbox',
	  'section' => 'nd_learning_customizer_archive_teachers_section',
	) );

	
	//Teachers Header Image
	$wp_customize->add_setting( 'nd_learning_customizer_archive_teachers_header_image', array(
	  'type' => 'option', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => '',
	  'sanitize_js_callback' => '', // Basically to_json.
	) );
	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'nd_learning_customizer_archive_teachers_header_image', 
			array(
			  'label' => __( 'Teachers Header Image', 'nd-learning' ),
			  'section' => 'nd_learning_customizer_archive_teachers_section',
			  'mime_type' => 'image',
			) 
		) 
	);



	//image position
	$wp_customize->add_setting( 'nd_learning_customizer_archive_teachers_header_image_position', array(
	  'type' => 'option', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => '',
	  'sanitize_js_callback' => '', // Basically to_json.
	) );
	$wp_customize->add_control( 'nd_learning_customizer_archive_teachers_header_image_position', array(
	  'label' => __( 'Image Position' ),
	  'type' => 'select',
	  'section' => 'nd_learning_customizer_archive_teachers_section',
	  'choices' => array(
	        'nd_learning_background_position_center_top' => 'Position Top',
	        'nd_learning_background_position_center_bottom' => 'Position Bottom',
	        'nd_learning_background_position_center' => 'Position Center',
	    ),
	) );



}
