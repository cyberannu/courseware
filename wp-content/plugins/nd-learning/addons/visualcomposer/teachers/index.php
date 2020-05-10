<?php


//START
add_shortcode('nd_learning_teachers', 'nd_learning_shortcode_teachers');
function nd_learning_shortcode_teachers($atts, $content = null)
{  

  $atts = shortcode_atts(
  array(
    'nd_learning_class' => '',
    'nd_learning_layout' => '',
    'nd_learning_width' => '',
    'nd_learning_qnt' => '',
    'nd_learning_id' => '',
    'nd_learning_order' => '',
    'nd_learning_orderby' => '',
    'nd_learning_white_title' => '',
  ), $atts);

  $str = '';

  //get variables
  $nd_learning_class = $atts['nd_learning_class'];
  $nd_learning_layout = $atts['nd_learning_layout'];
  $nd_learning_width = $atts['nd_learning_width'];
  $nd_learning_qnt = $atts['nd_learning_qnt'];
  $nd_learning_id = $atts['nd_learning_id'];
  $nd_learning_order = $atts['nd_learning_order'];
  $nd_learning_orderby = $atts['nd_learning_orderby'];
  $nd_learning_white_title = $atts['nd_learning_white_title'];


  //default value
  if ($nd_learning_layout == '') { $nd_learning_layout = "layout-1"; }
  if ($nd_learning_width == '') { $nd_learning_width = "nd_learning_width_100_percentage"; }
  if ($nd_learning_qnt == '') { $nd_learning_qnt = -1; }
  if ($nd_learning_order == '') { $nd_learning_order = 'DESC'; }
  if ($nd_learning_orderby == '') { $nd_learning_orderby = 'date'; }
  if ($nd_learning_white_title == 1) { $nd_learning_white_title = 'nd_learning_color_white_important'; }else{ $nd_learning_white_title = ''; }



  $args = array(
    'post_type' => 'teachers',
    'posts_per_page' => $nd_learning_qnt,
    'order' => $nd_learning_order,
    'orderby' => $nd_learning_orderby,
    'p' => $nd_learning_id
  );

  $the_query = new WP_Query( $args );

  
  //include the layout selected
  include 'layout/'.$nd_learning_layout.'.php';


  wp_reset_postdata();


   return apply_filters('uds_shortcode_out_filter', $str);
}
//END





//vc
add_action( 'vc_before_init', 'nd_learning_teachers' );
function nd_learning_teachers() {


  //START get all layout
  $nd_learning_layouts = array();

  //php function to descover all name files in directory
  $nd_learning_directory = plugin_dir_path( __FILE__ ) .'layout/';
  $nd_learning_layouts = scandir($nd_learning_directory);


  //cicle for delete hidden file that not are php files
  $i = 0;
  foreach ($nd_learning_layouts as $value) {
    
    //remove all files that aren't php
    if ( strpos( $nd_learning_layouts[$i] , ".php" ) != true ){
      unset($nd_learning_layouts[$i]);
    }else{
      $nd_learning_layout_name = str_replace(".php","",$nd_learning_layouts[$i]);
      $nd_learning_layouts[$i] = $nd_learning_layout_name;
    } 
    $i++; 

  }
  //END get all layout


   vc_map( array(
      "name" => __( "Teachers", "nd-learning" ),
      "base" => "nd_learning_teachers",
      'description' => __( 'Add Teachers Post Grid', 'nd-learning' ),
      'show_settings_on_create' => true,
      "icon" => esc_url(plugins_url('teachers.jpg', __FILE__ )),
      "class" => "",
      "category" => __( "ND Learning", "nd-learning"),
      "params" => array(
   

          array(
           'type' => 'dropdown',
            'heading' => __( 'Layout', 'nd-learning' ),
            'param_name' => 'nd_learning_layout',
            'value' => $nd_learning_layouts,
            'description' => __( "Choose the layout", "nd-learning" )
         ),
          array(
          'type' => 'checkbox',
          'heading' => __( 'White Title', 'nd-learning' ),
          'param_name' => 'nd_learning_white_title',
          'value' => array( __( 'Yes', 'nd-learning' ) => '1' ),
          'description' => __( 'Check if you want to make the title white', 'nd-learning' ),
          'dependency' => array( 'element' => 'nd_learning_layout', 'value' => array('layout-4') )
        ), 
          array(
         'type' => 'dropdown',
          "heading" => __( "Width", "nd-learning" ),
          'param_name' => 'nd_learning_width',
          'value' => array( __( 'Select Width', 'nd-learning' ) => 'nd_learning_width_100_percentage nd_learning_float_left', __( '20 %', 'nd-learning' ) => 'nd_learning_width_20_percentage nd_learning_float_left', __( '25 %', 'nd-learning' ) => 'nd_learning_width_25_percentage nd_learning_float_left', __( '33 %', 'nd-learning' ) => 'nd_learning_width_33_percentage nd_learning_float_left', __( '50 %', 'nd-learning' ) => 'nd_learning_width_50_percentage nd_learning_float_left', __( '100 %', 'nd-learning' ) => 'nd_learning_width_100_percentage nd_learning_float_left' ),
          'description' => __( "Select the width for post preview grid", "nd-learning" )
         ),
          array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Qnt Posts", "nd-learning" ),
            "param_name" => "nd_learning_qnt",
            "description" => __( "Insert the quantity of posts that you want display.", "nd-learning" )
         ),
          array(
         'type' => 'dropdown',
          "heading" => __( "Order", "nd-learning" ),
          'param_name' => 'nd_learning_order',
          'value' => array('DESC','ASC'),
          'description' => __( "Select the Order paramater, more info <a target='_blank' href='https://codex.wordpress.org/it:Riferimento_classi/WP_Query#Parametri_Order_.26_Orderby'>here</a>", "nd-learning" )
         ),
          array(
         'type' => 'dropdown',
          "heading" => __( "Order By", "nd-learning" ),
          'param_name' => 'nd_learning_orderby',
          'value' => array('none','ID','author','title','name','date','modified','rand','comment_count'),
          'description' => __( "Select the OrderBy paramater, more info <a target='_blank' href='https://codex.wordpress.org/it:Riferimento_classi/WP_Query#Parametri_Order_.26_Orderby'>here</a>", "nd-learning" )
         ),
           array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "ID Posts", "nd-learning" ),
            "param_name" => "nd_learning_id",
            "description" => __( "Insert the id of the post that you want display ( NB: only one post )", "nd-learning" )
         ),
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Custom class", "nd-learning" ),
            "param_name" => "nd_learning_class",
            "description" => __( "Insert custom class", "nd-learning" )
         )

        
      )
   ) );
}
//end shortcode