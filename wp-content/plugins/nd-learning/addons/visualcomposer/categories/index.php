<?php


//START
add_shortcode('nd_learning_categories_pg', 'nd_learning_vc_shortcode_categories');
function nd_learning_vc_shortcode_categories($atts, $content = null)
{  

  $atts = shortcode_atts(
  array(
    'nd_learning_class' => '',
    'nd_learning_layout' => '',
    'nd_learning_image' => '',
    'nd_learning_icon' => '',
    'nd_learning_color' => '',
    'nd_learning_tax' => '',
    'nd_learning_term' => '',
  ), $atts);

  $str = '';

  //get variables
  $nd_learning_class = $atts['nd_learning_class'];
  $nd_learning_layout = $atts['nd_learning_layout'];
  $nd_learning_color = $atts['nd_learning_color'];
  $nd_learning_tax = $atts['nd_learning_tax'];
  $nd_learning_term = $atts['nd_learning_term'];
  $nd_learning_image = wp_get_attachment_image_src($atts['nd_learning_image'],'large');
  $nd_learning_icon = wp_get_attachment_image_src($atts['nd_learning_icon'],'large');

  $nd_learning_term_id = get_term_by('slug', $nd_learning_term, $nd_learning_tax);
  $nd_learning_term_object = get_term( $nd_learning_term_id, $nd_learning_tax );
  $nd_learning_term_name = $nd_learning_term_object->name;
  $nd_learning_term_count = $nd_learning_term_object->count;
  $nd_learning_term_link = get_term_link($nd_learning_term,$nd_learning_tax);

  //default value
  if ($nd_learning_layout == '') { $nd_learning_layout = "layout-1"; }

  
  //include the layout selected
  include 'layout/'.$nd_learning_layout.'.php';


   return apply_filters('uds_shortcode_out_filter', $str);
}
//END





//vc
add_action( 'vc_before_init', 'nd_learning_categories_pg' );
function nd_learning_categories_pg() {


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
      "name" => __( "Categories", "nd-learning" ),
      "base" => "nd_learning_categories_pg",
      'description' => __( 'Add Category', 'nd-learning' ),
      'show_settings_on_create' => true,
      "icon" => esc_url(plugins_url('categories.jpg', __FILE__ )),
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
            'type' => 'attach_image',
            'heading' => __( 'Image', 'nd-learning' ),
            'param_name' => 'nd_learning_image',
            'description' => __( 'Select image from media library.', 'nd-learning' )
         ),
          array(
            'type' => 'attach_image',
            'heading' => __( 'Icon', 'nd-learning' ),
            'param_name' => 'nd_learning_icon',
            'description' => __( 'Select image from media library.', 'nd-learning' )
         ),
          array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __( "Color", "nd-learning" ),
            "param_name" => "nd_learning_color",
            "description" => __( "Choose color", "nd-learning" )
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