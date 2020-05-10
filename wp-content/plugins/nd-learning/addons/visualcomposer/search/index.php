<?php


function nd_learning_build_select($nd_learning_tax,$nd_learning_i,$nd_learning_select_value,$nd_learning_layout,$nd_learning_width){ 
  
  //declare
  $nd_learning_select = '';

  //get all terms
  $nd_learning_terms = get_terms($nd_learning_tax);
  
  //get tax
  $nd_learning_the_tax = get_taxonomy($nd_learning_tax);
  
  //get name
  $nd_learning_tax_name = $nd_learning_the_tax->labels->name;

  if ( $nd_learning_i == 0 ) { $nd_learning_tax_class = 'nd_learning_display_none'; }else{ $nd_learning_tax_class = ''; }


  

  //START LAYOUT
  if ( $nd_learning_layout == 'layout-1' ) {



      //START LAYOUT 1
      $nd_learning_select .= '

      <div id="nd_learning_search_components_tax_'.$nd_learning_i.'" class=" nd_learning_width_100_percentage_all_iphone '.$nd_learning_tax_class.' '.$nd_learning_width.' nd_learning_float_left nd_learning_padding_15 nd_learning_box_sizing_border_box">

      <select class="nd_learning_section" name="'.$nd_learning_tax.'">';

      //default value
      $nd_learning_select .= '<option value="">'.__('All','nd-learning').' '. $nd_learning_tax_name .'</option>';

      //built options
      foreach ($nd_learning_terms as $nd_learning_term) {

      if ( $nd_learning_term->slug == $nd_learning_select_value ){ $nd_learning_term_selected = 'selected'; }else{ $nd_learning_term_selected = ''; }

      $nd_learning_select .= '<option '.$nd_learning_term_selected.' value="' . $nd_learning_term->slug . '">' . $nd_learning_term->name . '</option>';  
      }


      $nd_learning_select .= '</select></div>';
      //END LAYOUT 1



  }elseif ( $nd_learning_layout == 'layout-3' ) {



      //START LAYOUT 1
      $nd_learning_select .= '

      <div id="nd_learning_search_components_tax_'.$nd_learning_i.'" class=" nd_learning_width_100_percentage_all_iphone '.$nd_learning_tax_class.' '.$nd_learning_width.' nd_learning_float_left nd_learning_padding_15 nd_learning_box_sizing_border_box">

      <select class="nd_learning_section" name="'.$nd_learning_tax.'">';

      //default value
      $nd_learning_select .= '<option value="">'.__('All','nd-learning').' '. $nd_learning_tax_name .'</option>';

      //built options
      foreach ($nd_learning_terms as $nd_learning_term) {

      if ( $nd_learning_term->slug == $nd_learning_select_value ){ $nd_learning_term_selected = 'selected'; }else{ $nd_learning_term_selected = ''; }

      $nd_learning_select .= '<option '.$nd_learning_term_selected.' value="' . $nd_learning_term->slug . '">' . $nd_learning_term->name . '</option>';  
      }


      $nd_learning_select .= '</select></div>';
      //END LAYOUT 1



  }else{


      //START LAYOUT 2
      $nd_learning_select .= '


      <div id="nd_learning_search_components_tax_'.$nd_learning_i.'" class=" nd_learning_width_100_percentage_all_iphone '.$nd_learning_tax_class.' '.$nd_learning_width.' nd_learning_float_left nd_learning_padding_15 nd_learning_box_sizing_border_box">

      <select class="nd_learning_section nd_learning_font_size_20 nd_learning_color_white_important nd_learning_background_transparent_important nd_learning_border_radius_3_important nd_learning_border_2_solid_white_important" name="'.$nd_learning_tax.'">';

      //default value
      $nd_learning_select .= '<option value="">'.__('ALL','nd-learning').' '. $nd_learning_tax_name .'</option>';

      //built options
      foreach ($nd_learning_terms as $nd_learning_term) {

      if ( $nd_learning_term->slug == $nd_learning_select_value ){ $nd_learning_term_selected = 'selected'; }else{ $nd_learning_term_selected = ''; }

      $nd_learning_select .= '<option '.$nd_learning_term_selected.' value="' . $nd_learning_term->slug . '">' . $nd_learning_term->name . '</option>';  
      }


      $nd_learning_select .= '</select></div>';
      //END LAYOUT 2


  }
  //END LAYOUT



  return $nd_learning_select;

}





//START
add_shortcode('nd_learning_search', 'nd_learning_shortcode_search');
function nd_learning_shortcode_search($atts, $content = null)
{  

  $atts = shortcode_atts(
  array(
    'nd_learning_class' => '',
    'nd_learning_layout' => '',
    'nd_learning_title' => '',
    'nd_learning_width' => '',
    'nd_learning_hide_level' => '',
    'nd_learning_hide_category' => '',
    'nd_learning_hide_typology' => '',
    'nd_learning_hide_duration' => '',
    'nd_learning_label_bg_color' => '',
    'nd_learning_hide_location' => '',
  ), $atts);

  $nd_learning_str = '';

  //get variables
  $nd_learning_class = $atts['nd_learning_class'];
  $nd_learning_layout = $atts['nd_learning_layout'];
  $nd_learning_title = $atts['nd_learning_title'];
  $nd_learning_width = $atts['nd_learning_width'];
  $nd_learning_hide_level = $atts['nd_learning_hide_level'];
  $nd_learning_hide_category = $atts['nd_learning_hide_category'];
  $nd_learning_hide_typology = $atts['nd_learning_hide_typology'];
  $nd_learning_hide_duration = $atts['nd_learning_hide_duration'];
  $nd_learning_hide_location = $atts['nd_learning_hide_location'];
  $nd_learning_label_bg_color = $atts['nd_learning_label_bg_color'];

  //START hide tax
  $nd_learning_str .= '<style>';

    if ( $nd_learning_hide_level == 1 ) { $nd_learning_str .= ' #nd_learning_search_components_tax_1{ display:none; } '; }
    if ( $nd_learning_hide_category == 1 ) { $nd_learning_str .= ' #nd_learning_search_components_tax_2{ display:none; } '; }
    if ( $nd_learning_hide_location == 1 ) { $nd_learning_str .= ' #nd_learning_search_components_tax_3{ display:none; } '; }
    if ( $nd_learning_hide_typology == 1 ) { $nd_learning_str .= ' #nd_learning_search_components_tax_4{ display:none; } '; }
    if ( $nd_learning_hide_duration == 1 ) { $nd_learning_str .= ' #nd_learning_search_components_tax_5{ display:none; } '; }

  $nd_learning_str .= '</style>';
  //END hide tax

  //default value
  if ($nd_learning_layout == '') { $nd_learning_layout = "layout-1"; }
  if ($nd_learning_width == '') { $nd_learning_width = "nd_learning_width_100_percentage"; }


  //START title
  if ( $nd_learning_title != '' ) { 

    $nd_learning_title_output = '
    <div class="nd_learning_section nd_learning_padding_15 nd_learning_box_sizing_border_box">
      <h2><strong>'.$nd_learning_title.'</strong></h2>
    </div>';

  }else{

    $nd_learning_title_output = '';

  }
  //END title

  
  $nd_learning_posttype = 'courses';
  $nd_learning_action = get_post_type_archive_link($nd_learning_posttype);

  
  
  //include the layout selected
  include 'layout/'.$nd_learning_layout.'.php';


  return apply_filters('uds_shortcode_out_filter', $nd_learning_str);

}
//END





//vc
add_action( 'vc_before_init', 'nd_learning_search' );
function nd_learning_search() {



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
      "name" => __( "Search", "nd-learning" ),
      "base" => "nd_learning_search",
      'description' => __( 'Add Advanced Search', 'nd-learning' ),
      'show_settings_on_create' => true,
      "icon" => esc_url(plugins_url('search.jpg', __FILE__ )),
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
            "heading" => __( "Title", "nd-learning" ),
            "param_name" => "nd_learning_title",
            "description" => __( "Insert the title", "nd-learning" )
         ),
          array(
          'type' => 'checkbox',
          'heading' => __( 'Hide Level Field', 'nd-learning' ),
          'param_name' => 'nd_learning_hide_level',
          'value' => array( __( 'Yes', 'nd-learning' ) => '1' ),
          'description' => __( 'Check if you want to hide this taxonomy', 'nd-learning' ),
        ), 
          array(
          'type' => 'checkbox',
          'heading' => __( 'Hide Category Field', 'nd-learning' ),
          'param_name' => 'nd_learning_hide_category',
          'value' => array( __( 'Yes', 'nd-learning' ) => '1' ),
          'description' => __( 'Check if you want to hide this taxonomy', 'nd-learning' ),
        ), 
          array(
          'type' => 'checkbox',
          'heading' => __( 'Hide Location Field', 'nd-learning' ),
          'param_name' => 'nd_learning_hide_location',
          'value' => array( __( 'Yes', 'nd-learning' ) => '1' ),
          'description' => __( 'Check if you want to hide this taxonomy', 'nd-learning' ),
        ), 
           array(
          'type' => 'checkbox',
          'heading' => __( 'Hide Typology Field', 'nd-learning' ),
          'param_name' => 'nd_learning_hide_typology',
          'value' => array( __( 'Yes', 'nd-learning' ) => '1' ),
          'description' => __( 'Check if you want to hide this taxonomy', 'nd-learning' ),
        ), 
            array(
          'type' => 'checkbox',
          'heading' => __( 'Hide Duration Field', 'nd-learning' ),
          'param_name' => 'nd_learning_hide_duration',
          'value' => array( __( 'Yes', 'nd-learning' ) => '1' ),
          'description' => __( 'Check if you want to hide this taxonomy', 'nd-learning' ),
        ), 
            array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __( "Label Bg Color", "nd-learning" ),
            "param_name" => "nd_learning_label_bg_color",
            "description" => __( "Choose label bg color", "nd-learning" ),
            'dependency' => array( 'element' => 'nd_learning_layout', 'value' => array( 'layout-3' ) )
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