<?php



add_action('customize_register','nd_learning_customizer_nd_learning');
function nd_learning_customizer_nd_learning( $wp_customize ) {
  

	//ADD panel
	$wp_customize->add_panel( 'nd_learning_customizer_learning', array(
	  'title' => __( 'ND Learning' ),
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '',
	  'description' => __( 'Plugin Settings' ), // Include html tags such as <p>.
	  'priority' => 220, // Mixed with top-level-section hierarchy.
	) );


}



//include all options
foreach ( glob ( plugin_dir_path( __FILE__ ) . "*/index.php" ) as $file ){
  include_once $file;
}
