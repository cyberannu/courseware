<?php


add_action('customize_register','nd_learning_customizer_plugin_colors');
function nd_learning_customizer_plugin_colors( $wp_customize ) {
  

	//ADD section 1
	$wp_customize->add_section( 'nd_learning_customizer_plugin_colors' , array(
	  'title' => 'Plugin Colors',
	  'priority'    => 10,
	  'panel' => 'nd_learning_customizer_learning',
	) );


	//color
	$wp_customize->add_setting( 'nd_learning_customizer_color_green', array(
	  'type' => 'option', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => '',
	  'sanitize_js_callback' => '', // Basically to_json.
	) );
	$wp_customize->add_control(
	  new WP_Customize_Color_Control(
	    $wp_customize, // WP_Customize_Manager
	    'nd_learning_customizer_color_green', // Setting id
	    array( // Args, including any custom ones.
	      'label' => __( 'Green Color' ),
	      'description' => __('Select color for your green elements','nd-learning'),
	      'section' => 'nd_learning_customizer_plugin_colors',
	    )
	  )
	);




	//color
	$wp_customize->add_setting( 'nd_learning_customizer_color_red', array(
	  'type' => 'option', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => '',
	  'sanitize_js_callback' => '', // Basically to_json.
	) );
	$wp_customize->add_control(
	  new WP_Customize_Color_Control(
	    $wp_customize, // WP_Customize_Manager
	    'nd_learning_customizer_color_red', // Setting id
	    array( // Args, including any custom ones.
	      'label' => __( 'Red Color' ),
	      'description' => __('Select color for your red elements','nd-learning'),
	      'section' => 'nd_learning_customizer_plugin_colors',
	    )
	  )
	);



	//color
	$wp_customize->add_setting( 'nd_learning_customizer_color_orange', array(
	  'type' => 'option', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => '',
	  'sanitize_js_callback' => '', // Basically to_json.
	) );
	$wp_customize->add_control(
	  new WP_Customize_Color_Control(
	    $wp_customize, // WP_Customize_Manager
	    'nd_learning_customizer_color_orange', // Setting id
	    array( // Args, including any custom ones.
	      'label' => __( 'Orange Color' ),
	      'description' => __('Select color for your orange elements','nd-learning'),
	      'section' => 'nd_learning_customizer_plugin_colors',
	    )
	  )
	);



	//color
	$wp_customize->add_setting( 'nd_learning_customizer_color_greydark', array(
	  'type' => 'option', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => '',
	  'sanitize_js_callback' => '', // Basically to_json.
	) );
	$wp_customize->add_control(
	  new WP_Customize_Color_Control(
	    $wp_customize, // WP_Customize_Manager
	    'nd_learning_customizer_color_greydark', // Setting id
	    array( // Args, including any custom ones.
	      'label' => __( 'Greydark Color' ),
	      'description' => __('Select color for your greydark elements','nd-learning'),
	      'section' => 'nd_learning_customizer_plugin_colors',
	    )
	  )
	);



}





//css inline
function nd_learning_customizer_add_colors() { 
?>

	<?php

	//get colors
	$nd_learning_customizer_color_green = get_option( 'nd_learning_customizer_color_green', '#68B78C' );
	$nd_learning_customizer_color_red = get_option( 'nd_learning_customizer_color_red', '#CC8585' );
	$nd_learning_customizer_color_orange = get_option( 'nd_learning_customizer_color_orange', '#ceb28d' );
	$nd_learning_customizer_color_greydark = get_option( 'nd_learning_customizer_color_greydark', '#444' );

	?>

    <style type="text/css">

    	/*green*/
    	.nd_learning_tabs .ui-tabs-active.ui-state-active { box-shadow: 0 2px 0 <?php echo $nd_learning_customizer_color_green;  ?>;}
		.nd_learning_bg_green { background-color: <?php echo $nd_learning_customizer_color_green;  ?>; }
		.nd_learning_border_1_solid_green { border: 1px solid <?php echo $nd_learning_customizer_color_green;  ?>; }

		/*red*/
		.nd_learning_bg_red { background-color: <?php echo $nd_learning_customizer_color_red;  ?>; }

		/*orange*/
		.nd_learning_bg_orange { background-color: <?php echo $nd_learning_customizer_color_orange;  ?>; }

		/*greydark*/
		.nd_learning_bg_greydark,
		.ui-tooltip.nd_learning_tooltip_jquery_content
		{ background-color: <?php echo $nd_learning_customizer_color_greydark;  ?>; }
       
    </style>
    

<?php
}
add_action('wp_head', 'nd_learning_customizer_add_colors');
