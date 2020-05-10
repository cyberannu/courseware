<?php


//START
add_shortcode('nd_learning_courses_pg', 'nd_learning_vc_shortcode_courses');
function nd_learning_vc_shortcode_courses($atts, $content = null)
{  

  $atts = shortcode_atts(
  array(
    'nd_learning_class' => '',
    'nd_learning_layout' => '',
    'nd_learning_width' => '',
    'nd_learning_qnt' => '',
    'nd_learning_id' => '',
    'nd_learning_tax' => '',
    'nd_learning_term' => '',
    'nd_learning_order' => '',
    'nd_learning_orderby' => '',
    'nd_learning_image_size' => '',
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
  $nd_learning_tax = $atts['nd_learning_tax'];
  $nd_learning_term = $atts['nd_learning_term'];
  $nd_learning_image_size = $atts['nd_learning_image_size'];


  //default value
  if ($nd_learning_layout == '') { $nd_learning_layout = "layout-1"; }
  if ($nd_learning_width == '') { $nd_learning_width = "nd_learning_width_100_percentage"; }
  if ($nd_learning_qnt == '') { $nd_learning_qnt = -1; }
  if ($nd_learning_order == '') { $nd_learning_order = 'DESC'; }
  if ($nd_learning_orderby == '') { $nd_learning_orderby = 'date'; }



  $args = array(
    'post_type' => 'courses',
    'posts_per_page' => $nd_learning_qnt,
    'order' => $nd_learning_order,
    'orderby' => $nd_learning_orderby,
    'p' => $nd_learning_id,
    ''.$nd_learning_tax.'' => ''.$nd_learning_term.''
  );

  $the_query = new WP_Query( $args );

  
  //include the layout selected
  include 'layout/'.$nd_learning_layout.'.php';


  wp_reset_postdata();


   return apply_filters('uds_shortcode_out_filter', $str);
}
//END





//vc
add_action( 'vc_before_init', 'nd_learning_courses_pg' );
function nd_learning_courses_pg() {


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


  //START image size
  $nd_learning_image_sizes = get_intermediate_image_sizes(); 
  //END image size


   vc_map( array(
      "name" => __( "Courses", "nd-learning" ),
      "base" => "nd_learning_courses_pg",
      'description' => __( 'Add Courses Post Grid', 'nd-learning' ),
      'show_settings_on_create' => true,
      "icon" => esc_url(plugins_url('courses.jpg', __FILE__ )),
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
         'type' => 'dropdown',
          "heading" => __( "Width", "nd-learning" ),
          'param_name' => 'nd_learning_width',
          'value' => array( __( 'Select Width', 'nd-learning' ) => 'nd_learning_width_100_percentage nd_learning_float_left', __( '20 %', 'nd-learning' ) => 'nd_learning_width_20_percentage nd_learning_float_left', __( '25 %', 'nd-learning' ) => 'nd_learning_width_25_percentage nd_learning_float_left', __( '33 %', 'nd-learning' ) => 'nd_learning_width_33_percentage nd_learning_float_left', __( '50 %', 'nd-learning' ) => 'nd_learning_width_50_percentage nd_learning_float_left', __( '100 %', 'nd-learning' ) => 'nd_learning_width_100_percentage nd_learning_float_left' ),
          'description' => __( "Select the width for course preview grid", "nd-learning" )
         ),
          array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Qnt Courses", "nd-learning" ),
            "param_name" => "nd_learning_qnt",
            "description" => __( "Insert the quantity of courses that you want display.", "nd-learning" )
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
            "heading" => __( "ID Courses", "nd-learning" ),
            "param_name" => "nd_learning_id",
            "description" => __( "Insert the id of the course that you want display ( NB: only one course )", "nd-learning" )
         ),
           array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Taxonomy", "nd-learning" ),
            "param_name" => "nd_learning_tax",
            "description" => __( "Insert the slug of your Taxonomy", "nd-learning" )
         ),
           array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Term Taxonomy", "nd-learning" ),
            "param_name" => "nd_learning_term",
            "description" => __( "Insert the slug of your Term Taxonomy", "nd-learning" )
         ),
          array(
          'type' => 'dropdown',
          'heading' => __( 'Image Size', 'nd-learning' ),
          'param_name' => 'nd_learning_image_size',
          'value' => $nd_learning_image_sizes,
          'save_always' => true,
          'description' => __( 'Choose the image size that you want to use', 'nd-learning' ),
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