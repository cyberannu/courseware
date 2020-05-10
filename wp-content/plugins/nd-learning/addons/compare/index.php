<?php

$nd_learning_compare_enable = get_option('nd_learning_compare_enable');
if ( $nd_learning_compare_enable == 1 and get_option('nicdark_theme_author') == 1 ) {

//START  nd_learning_compare
function nd_learning_shortcode_compare() {

  $nd_learning_result = '';

  //get current user id
  $nd_learning_current_user = wp_get_current_user();
  $nd_learning_current_user_id = $nd_learning_current_user->ID;

  global $wpdb;

  $nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';
  $nd_learning_action_type = "'compare'";

  //START select for items
  $nd_learning_course_ids = $wpdb->get_results( "SELECT DISTINCT id_course FROM $nd_learning_table_name WHERE id_user = $nd_learning_current_user_id AND action_type = $nd_learning_action_type");


  //no results
  if ( empty($nd_learning_course_ids) ) { 
    $nd_learning_result .= '<p>'.__('You do not have any course in compare','nd-learning').'</p>'; 
  }else{

    
    //START first ROW
    $nd_learning_result .= '
      <table class="nd_learning_section nd_learning_display_none_responsive">
        <tr>
          <td class="nd_learning_width_25_percentage nd_learning_padding_15">

            <a class="nd_learning_display_inline_block nd_learning_color_white_important nd_learning_bg_orange nd_learning_padding_5 nd_learning_border_radius_3 nd_options_second_font nd_learning_font_size_12" href="#">'.__('COMPARE','nd-learning').'</a>
            <div class="nd_learning_section nd_learning_height_10"></div>
            <h1 class="nd_learning_font_size_50"><strong>'.__('Compare Courses','nd-learning').'</strong></h1>

          </td>
    ';


    foreach ( $nd_learning_course_ids as $nd_learning_course_id ) 
    {

      $nd_learning_id = $nd_learning_course_id->id_course;
      $nd_learning_course_title = get_the_title($nd_learning_id);
      $nd_learning_permalink = get_permalink( $nd_learning_id );

      //metabox
      $nd_learning_meta_box_course_color = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_color', true );
      if ( $nd_learning_meta_box_course_color == '' ) { $nd_learning_meta_box_course_color = '#000'; }

      //course information
      $nd_learning_course_button = '';
      if ( nd_learning_get_course_availability($nd_learning_id) == 0 ) {
          $nd_learning_course_button = '
              <a class="nd_learning_bg_red nd_learning_display_inline_block nd_learning_color_white_important nd_options_first_font nd_learning_padding_8 nd_learning_border_radius_3 nd_learning_font_size_13" href="'.$nd_learning_permalink.'">'.__('COMPLETED','nd-learning').'</a>
          '; 
      }else{

          $nd_learning_course_price = '';
          if ( nd_learning_get_course_price($nd_learning_id) == 0 ) {
              $nd_learning_course_price = __('FREE','nd-learning');  
          }else{
              $nd_learning_course_price = nd_learning_get_course_currency().' '.nd_learning_get_course_price($nd_learning_id);  
          } 

          $nd_learning_course_button = '
              <a style="background-color: '.$nd_learning_meta_box_course_color.';" class="nd_learning_display_inline_block nd_learning_color_white_important nd_options_first_font nd_learning_padding_8 nd_learning_border_radius_3 nd_learning_font_size_13" href="'.$nd_learning_permalink.'">'.$nd_learning_course_price.'</a>
          ';  

      }


      //image
      if ( has_post_thumbnail($nd_learning_course_id->id_course) ) {

        $nd_learning_image_id = get_post_thumbnail_id( $nd_learning_course_id->id_course );

        $nd_learning_image_attributes = wp_get_attachment_image_src( $nd_learning_image_id, 'large' );
        $nd_learning_image_src = $nd_learning_image_attributes[0];
        $nd_learning_image_course = '

            <div class="nd_learning_section nd_learning_position_relative">
                                            
                <img alt="" class="nd_learning_section" src="'.$nd_learning_image_src.'">

                <div class="nd_learning_bg_greydark_alpha_gradient_3 nd_learning_position_absolute nd_learning_left_0 nd_learning_height_100_percentage nd_learning_width_100_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box">
                  <div class="nd_learning_position_absolute nd_learning_right_20 nd_learning_bottom_20">
                      <a href="'.nd_learning_get_account_page().'#nd_learning_account_page_tab_compare"><img class="nd_learning_float_right" alt="" width="20" height="20" src="'.esc_url(plugins_url('icon-trash-white.svg', __FILE__ )).'"></a>   
                  </div>

              </div>

            </div>

          ';

      }else{

        $nd_learning_image_course = '';

      } 
      $nd_learning_result .= '
        <td class="nd_learning_width_25_percentage nd_learning_padding_15">'.$nd_learning_image_course.'

          <div class="nd_learning_section nd_learning_height_20"></div>

          <table class="nd_learning_section">
            <tbody>
                <tr>
                    <td><h3>'.$nd_learning_course_title.'</h3></td>
                    <td class="nd_learning_text_align_right">
                        '.$nd_learning_course_button.'
                    </td>
                </tr>
            </tbody>
          </table>

        </td>

      ';

    }


    $nd_learning_course_ids_missing = 3 - count($nd_learning_course_ids);

    for ($i = 1; $i <= $nd_learning_course_ids_missing; $i++) {
        $nd_learning_result .= '
        
          <td class="nd_learning_width_25_percentage nd_learning_padding_15 nd_learning_text_align_center">
            <div class="nd_learning_display_inline_block">
              <a href="'.get_post_type_archive_link('courses').'" class="nd_learning_bg_green nd_learning_cursor_pointer nd_learning_display_inline_block nd_learning_color_white_important nd_learning_text_decoration_none nd_learning_padding_8 nd_options_first_font nd_learning_font_size_13 nd_learning_border_radius_3">'.__('ADD COURSE','nd-learning').'</a>
            </div>
          </td>

        ';
    }

    $nd_learning_result .= '</table>';
    //END first row


    $nd_learning_result .= '

      <div class="nd_learning_width_25_percentage nd_learning_display_none_responsive nd_learning_float_left nd_learning_padding_15 nd_learning_box_sizing_border_box">
        <table class="nd_learning_section">
          <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p class="nd_options_color_greydark">'.__('ID','nd-learning').'</p></td></tr>
          <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p class="nd_options_color_greydark">'.__('Course Name','nd-learning').'</p></td></tr>
          <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p class="nd_options_color_greydark">'.__('Price','nd-learning').'</p></td></tr>
          <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p class="nd_options_color_greydark">'.__('Max Availability','nd-learning').'</p></td></tr>
          <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p class="nd_options_color_greydark">'.__('Teacher','nd-learning').'</p></td></tr>
          <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p class="nd_options_color_greydark">'.__('Start Date','nd-learning').'</p></td></tr>
          <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p class="nd_options_color_greydark">'.__('Level','nd-learning').'</p></td></tr>
          <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p class="nd_options_color_greydark">'.__('Category','nd-learning').'</p></td></tr>
          <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p class="nd_options_color_greydark">'.__('Location','nd-learning').'</p></td></tr>
          <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p class="nd_options_color_greydark">'.__('Typology','nd-learning').'</p></td></tr>
          <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p class="nd_options_color_greydark">'.__('Duration','nd-learning').'</p></td></tr>
        </table>
      </div>

    ';



    foreach ( $nd_learning_course_ids as $nd_learning_course_id ) 
    {

      //recover datas from plugin settings
      $nd_learning_currency = get_option('nd_learning_currency');
      $nd_learning_id = $nd_learning_course_id->id_course;

      //default
      $nd_learning_title_course = get_the_title($nd_learning_course_id->id_course);

      //metabox
      $nd_learning_meta_box_price = get_post_meta( $nd_learning_course_id->id_course, 'nd_learning_meta_box_price', true );
      if ( $nd_learning_meta_box_price == 0 ) { 
          $nd_learning_meta_box_price = 'Free';
      } else { 
          $nd_learning_meta_box_price = $nd_learning_meta_box_price.' '.$nd_learning_currency; 
      }


      //image
      if ( has_post_thumbnail($nd_learning_course_id->id_course) ) {

        $nd_learning_image_id = get_post_thumbnail_id( $nd_learning_course_id->id_course );

        $nd_learning_image_attributes = wp_get_attachment_image_src( $nd_learning_image_id, 'large' );
        $nd_learning_image_src = $nd_learning_image_attributes[0];
        $nd_learning_image_course_responsive = '

            <div class="nd_learning_section nd_learning_position_relative">
                                            
                <img alt="" class="nd_learning_section" src="'.$nd_learning_image_src.'">

                <div class="nd_learning_bg_greydark_alpha_gradient_3 nd_learning_position_absolute nd_learning_left_0 nd_learning_height_100_percentage nd_learning_width_100_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box">
                  <div class="nd_learning_position_absolute nd_learning_right_20 nd_learning_bottom_20">
                      <a href="'.nd_learning_get_account_page().'#nd_learning_account_page_tab_compare"><img class="nd_learning_float_right" alt="" width="20" height="20" src="'.esc_url(plugins_url('icon-trash-white.svg', __FILE__ )).'"></a>   
                  </div>

              </div>

            </div>

          ';

      }else{

        $nd_learning_image_course_responsive = '';

      } 
      //end image

      $nd_learning_meta_box_max_availability = get_post_meta( $nd_learning_course_id->id_course, 'nd_learning_meta_box_max_availability', true );
      $nd_learning_meta_box_teacher = get_post_meta( $nd_learning_course_id->id_course, 'nd_learning_meta_box_teacher', true );
      $nd_learning_teacher_name = get_the_title($nd_learning_meta_box_teacher);
      $nd_learning_teacher_permalink = get_permalink($nd_learning_meta_box_teacher);
      $nd_learning_meta_box_date = get_post_meta( $nd_learning_course_id->id_course, 'nd_learning_meta_box_date', true );
      $nd_learning_meta_box_color = get_post_meta( $nd_learning_course_id->id_course, 'nd_learning_meta_box_color', true ); 


      //teacher info image and title
      $nd_learning_meta_box_course_teacher = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_teacher', true );
      if ( $nd_learning_meta_box_course_teacher == '' ) { $nd_learning_meta_box_course_teacher = 0; }
      $nd_learning_teacher_image_id = get_post_thumbnail_id( $nd_learning_meta_box_course_teacher );
      $nd_learning_teacher_image_attributes = wp_get_attachment_image_src( $nd_learning_teacher_image_id, 'large' );
      if ( $nd_learning_teacher_image_attributes[0] == '' ) { $nd_learning_output_image_teacher = ''; }else{
        $nd_learning_output_image_teacher = '
          <a href="'.get_permalink($nd_learning_meta_box_course_teacher).'">
            <img alt="" class="nd_learning_margin_left_10 nd_learning_margin_right_10 nd_learning_display_table_cell nd_learning_vertical_align_middle nd_learning_border_radius_100_percentage" width="25" height="25" src="'.$nd_learning_teacher_image_attributes[0].'">
          </a>
        ';
      }
      $nd_learning_teacher_all_name = get_the_title($nd_learning_meta_box_course_teacher);
      $nd_learning_teacher_all_name_array = explode(" ", $nd_learning_teacher_all_name);
      $nd_learning_teacher_name = $nd_learning_teacher_all_name_array[0];


      //review
      $nd_learning_review_result = '';
      if ( nd_learning_course_review_qnt($nd_learning_id) == 0 ) {

          $nd_learning_review_result .= '';

      }else{

          $nd_learning_review_result .= nd_learning_course_review_star(nd_learning_course_review_average($nd_learning_id),15,'grey','2px');

      }


      //taxonomies
      $nd_learning_terms_difficulty_course = wp_get_post_terms( $nd_learning_course_id->id_course, 'difficulty-level-course', array("fields" => "all"));
      $nd_learning_terms_category_course = wp_get_post_terms( $nd_learning_course_id->id_course, 'category-course', array("fields" => "all"));
      $nd_learning_terms_location_course = wp_get_post_terms( $nd_learning_course_id->id_course, 'location-course', array("fields" => "all"));
      $nd_learning_terms_typology_course = wp_get_post_terms( $nd_learning_course_id->id_course, 'typology-course', array("fields" => "all"));
      $nd_learning_terms_duration_course = wp_get_post_terms( $nd_learning_course_id->id_course, 'duration-course', array("fields" => "all"));

      $nd_learning_terms_difficulty_course_results = '';
      $nd_learning_terms_category_course_results = '';
      $nd_learning_terms_location_course_results = '';
      $nd_learning_terms_typology_course_results = '';
      $nd_learning_terms_duration_course_results = '';

      foreach($nd_learning_terms_difficulty_course as $nd_learning_term_difficulty_course) { $nd_learning_terms_difficulty_course_results .= $nd_learning_term_difficulty_course->name.' '; }
      foreach($nd_learning_terms_category_course as $nd_learning_term_category_course) { $nd_learning_terms_category_course_results .= $nd_learning_term_category_course->name.' '; }
      foreach($nd_learning_terms_location_course as $nd_learning_term_location_course) { $nd_learning_terms_location_course_results .= $nd_learning_term_location_course->name.' '; }
      foreach($nd_learning_terms_typology_course as $nd_learning_term_typology_course) { $nd_learning_terms_typology_course_results .= $nd_learning_term_typology_course->name.' '; }
      foreach($nd_learning_terms_duration_course as $nd_learning_term_duration_course) { $nd_learning_terms_duration_course_results .= $nd_learning_term_duration_course->name.' '; }


      $nd_learning_result .= '
      <div class="nd_learning_width_25_percentage nd_learning_width_100_percentage_responsive nd_learning_float_left nd_learning_padding_15 nd_learning_box_sizing_border_box">
        <table class="nd_learning_section">

          <tr class=" nd_learning_display_none nd_learning_display_block_responsive">
            <td class="">
            '.$nd_learning_image_course_responsive.'
            </td>
          </tr>

          <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p>'.$nd_learning_course_id->id_course.'</p></td></tr>
          <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p>'.$nd_learning_title_course.'</p></td></tr>
          <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p>'.$nd_learning_meta_box_price.'</p></td></tr>
          <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p>'.$nd_learning_meta_box_max_availability.'</p></td></tr>
          <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p>'.$nd_learning_teacher_name.'</p></td></tr>
          <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p>'.$nd_learning_meta_box_date.'</p></td></tr>
          <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p>'.$nd_learning_terms_difficulty_course_results.'</p></td></tr>
          <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p>'.$nd_learning_terms_category_course_results.'</p></td></tr>
          <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p>'.$nd_learning_terms_location_course_results.'</p></td></tr>
          <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p>'.$nd_learning_terms_typology_course_results.'</p></td></tr>
          <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p>'.$nd_learning_terms_duration_course_results.'</p></td></tr>
        </table>


        <div class="nd_learning_section">

        <div class="nd_learning_section nd_learning_height_30"></div>

        ';
          
        

        $nd_learning_tags = wp_get_post_terms( $nd_learning_id );

        foreach ( $nd_learning_tags as $nd_learning_tag ) {

            $nd_learning_result .= '<a class="nd_learning_display_inline_block nd_learning_margin_right_10 nd_learning_bg_grey nd_learning_border_1_solid_grey nd_options_first_font nd_learning_padding_5 nd_learning_border_radius_3 nd_learning_font_size_12" href="#">'.$nd_learning_tag->name.'</a>';

        }

        $nd_learning_result .= '</div>


        <div class="nd_learning_section nd_learning_height_20"></div>

        <div class="nd_learning_section">
          <div class="nd_learning_width_50_percentage nd_learning_float_left">
              <div class="nd_learning_display_table nd_learning_float_left">
                  '.$nd_learning_output_image_teacher.'
                  <p class="nd_learning_display_table_cell nd_learning_vertical_align_middle nd_learning_font_size_15">'.$nd_learning_teacher_name.'</p>
              </div> 
          </div>



          <div class="nd_learning_width_50_percentage nd_learning_float_left nd_learning_text_align_right">
              <div class="nd_learning_section nd_learning_height_5"></div>
              '.$nd_learning_review_result.'
          </div>
        </div>





      </div>
      ';
    }


    $nd_learning_course_ids_missing = 3 - count($nd_learning_course_ids);

    for ($i = 1; $i <= $nd_learning_course_ids_missing; $i++) {
        $nd_learning_result .= '

          <div class="nd_learning_width_25_percentage nd_learning_float_left nd_learning_padding_15 nd_learning_box_sizing_border_box">
            <table class="nd_learning_section">
              <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p class="nd_learning_opacity_0">'.__('ID','nd-learning').'</p></td></tr>
              <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p class="nd_learning_opacity_0">'.__('Course Name','nd-learning').'</p></td></tr>
              <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p class="nd_learning_opacity_0">'.__('Price','nd-learning').'</p></td></tr>
              <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p class="nd_learning_opacity_0">'.__('Max Availability','nd-learning').'</p></td></tr>
              <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p class="nd_learning_opacity_0">'.__('Teacher','nd-learning').'</p></td></tr>
              <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p class="nd_learning_opacity_0">'.__('Start Date','nd-learning').'</p></td></tr>
              <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p class="nd_learning_opacity_0">'.__('Level','nd-learning').'</p></td></tr>
              <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p class="nd_learning_opacity_0">'.__('Category','nd-learning').'</p></td></tr>
              <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p class="nd_learning_opacity_0">'.__('Location','nd-learning').'</p></td></tr>
              <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p class="nd_learning_opacity_0">'.__('Typology','nd-learning').'</p></td></tr>
              <tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_10"><p class="nd_learning_opacity_0">'.__('Duration','nd-learning').'</p></td></tr>
            </table>
          </div> 

        ';
    }

    $nd_learning_result .= '';
    

  }  
  //END select for items


  echo $nd_learning_result;

}
add_shortcode('nd_learning_compare', 'nd_learning_shortcode_compare');
//END nd_learning_login



//ADD settings group
add_action('nd_learning_add_settings_group','nd_learning_add_settings_group_compare');
function nd_learning_add_settings_group_compare(){

  register_setting( 'nd_learning_settings_group', 'nd_learning_compare_page' );

}


//ADD row on settings group
add_action('nd_learning_add_main_settings_row','nd_learning_add_main_settings_row_compare');
function nd_learning_add_main_settings_row_compare(){ ?>


  <!--START-->
  <div class="nd_learning_section">
    <div class="nd_learning_width_40_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
      <h2 class="nd_learning_section nd_learning_margin_0"><?php _e('Compare Page','nd-learning'); ?></h2>
      <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_10"><?php _e('Select your compare page','nd-learning'); ?></p>
    </div>
    <div class="nd_learning_width_60_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
      
      <select class="nd_learning_width_100_percentage" name="nd_learning_compare_page">
        <?php $nd_learning_pages = get_pages(); ?>
        <?php foreach ($nd_learning_pages as $nd_learning_page) : ?>
            <option

            <?php 
              if( get_option('nd_learning_compare_page') == $nd_learning_page->ID ) { 
                echo 'selected="selected"';
              } 
            ?>

             value="<?php echo $nd_learning_page->ID; ?>">
                <?php echo $nd_learning_page->post_title; ?>
            </option>
        <?php endforeach; ?>
      </select>
      <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_20"><?php _e('Select the page where you have added the shortcode [nd_learning_compare]','nd-learning'); ?></p>

    </div>
  </div>
  <!--END-->
  <div class="nd_learning_section nd_learning_height_1 nd_learning_background_color_E7E7E7 nd_learning_margin_top_10 nd_learning_margin_bottom_10"></div>




<?php
}



//add button compare in single course page
add_action('nd_learning_single_course_over_image','nd_learning_add_compare_button');


function nd_learning_add_compare_button(){


  wp_enqueue_script('jquery-ui-tooltip');


  $nd_learning_result = '';

  $nd_learning_result .= '

    <script type="text/javascript">
    <!--//--><![CDATA[//><!--
      jQuery(document).ready(function($) {

        //tooltip
        $( ".nd_learning_tooltip_jquery" ).tooltip({ 
          tooltipClass: "nd_learning_tooltip_jquery_content",
          position: {
            my: "center top",
            at: "center+0 top-45",
          }
        });

      });
    //--><!]]>
    </script>
  ';


  //compare image
  $nd_learning_empty_compare = esc_url(plugins_url('icon-compare-empty-white.svg', __FILE__ ));
  $nd_learning_none_compare = esc_url(plugins_url('icon-compare-none-white.svg', __FILE__ ));
  $nd_learning_full_compare = esc_url(plugins_url('icon-compare-full-white.svg', __FILE__ ));

  //get user ID
  $nd_learning_current_user = wp_get_current_user();
  $nd_learning_current_user_id = $nd_learning_current_user->ID;

  //compare
  if (is_user_logged_in() == 1){

      $nd_learning_action_type = "'compare'";

      //ajax results
      $nd_learning_add_to_compare_params = array(
        'nd_learning_ajaxurl_add_to_compare' => admin_url('admin-ajax.php'),
        'nd_learning_ajaxnonce_add_to_compare' => wp_create_nonce('nd_learning_add_to_compare_nonce'),
      );

      wp_enqueue_script( 'nd_learning_compare', esc_url( plugins_url( 'js/nd_learning_add_to_compare.js', __FILE__ ) ), array( 'jquery' ) ); 
      wp_localize_script( 'nd_learning_compare', 'nd_learning_my_vars_add_to_compare', $nd_learning_add_to_compare_params ); 


      if ( nd_learning_is_course_compareed( get_the_ID(), $nd_learning_current_user_id, $nd_learning_action_type ) == 0 ){

         $nd_learning_result .= '
          <div class="nd_learning_display_inline_block nd_learning_display_none_all_iphone">
            <a title="'.__('ALREADY ADDED TO COMPARE','nd-learning').'" href="'.nd_learning_get_account_page().'#nd_learning_account_page_tab_compare" class="nd_learning_tooltip_jquery nd_learning_cursor_pointer nd_learning_display_inline_block nd_learning_text_decoration_none  " >
              <img alt="" width="20" height="20" src="'.$nd_learning_full_compare.'">
            </a>
          </div>
          ';

      }elseif ( nd_learning_check_number_courses_in_compare() === 3 ){

        $nd_learning_result .= '
          
          <div class="nd_learning_display_inline_block nd_learning_display_none_all_iphone">
            <a title="'.__('ALREADY 3 PRODUCTS','nd-learning').'" href="'.nd_learning_get_account_page().'#nd_learning_account_page_tab_compare" class="nd_learning_tooltip_jquery nd_learning_cursor_pointer  nd_learning_display_inline_block nd_learning_text_decoration_none  " >
              <img alt="" width="20" height="20" src="'.$nd_learning_none_compare.'">
            </a>
          </div>
        ';   

      }else{


        $nd_learning_text_to_return = "'".__('ALREADY ADDED TO COMPARE','nd-learning')."'";
        $nd_learning_link_to_return = "'".nd_learning_get_account_page()."#nd_learning_account_page_tab_compare"."'";

        $nd_learning_img_to_return_none = "'".esc_url(plugins_url("icon-compare-none-white.svg", __FILE__ ))."'";
        $nd_learning_img_to_return_full = "'".esc_url(plugins_url("icon-compare-full-white.svg", __FILE__ ))."'";



         $nd_learning_result .= '
          
          <div class="nd_learning_position_relative nd_learning_display_none_all_iphone nd_learning_display_inline_block nd_learning_add_to_compare_btn_'.get_the_ID().'">
            <a title="'.__('ADD TO MY COMPARE','nd-learning').'" class="nd_learning_tooltip_jquery nd_learning_cursor_pointer  nd_learning_display_inline_block nd_learning_text_decoration_none nd_learning_add_to_compare_link_'.get_the_ID().'" onclick="nd_learning_add_to_compare('.get_the_ID().','.$nd_learning_current_user_id.','.$nd_learning_action_type.','.$nd_learning_text_to_return.','.$nd_learning_link_to_return.','.$nd_learning_img_to_return_none.','.$nd_learning_img_to_return_full.')" >
              <img alt="" width="20" height="20" src="'.$nd_learning_empty_compare.'">
            </a>
          </div>
        ';

      }

     

  }else{

    $nd_learning_result .= '
    
      <div class="nd_learning_display_inline_block nd_learning_display_none_all_iphone">
        <a title="'.__('MAKE THE LOGIN FOR COMPARE','nd-learning').'" href="'.nd_learning_get_account_page().'" class="nd_learning_tooltip_jquery nd_learning_cursor_pointer  nd_learning_display_inline_block nd_learning_text_decoration_none  " >
          <img alt="" width="20" height="20" src="'.$nd_learning_empty_compare.'">
        </a>
      </div>

    ';

  }
  //end compare  



  return $nd_learning_result;

}



//check if course is compareed
function nd_learning_is_course_compareed($nd_learning_course_id,$nd_learning_current_user_id,$nd_learning_action_type){

  global $wpdb;

  $nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';

  $nd_learning_is_course_compareed = $wpdb->get_results( "SELECT id FROM $nd_learning_table_name WHERE id_user = $nd_learning_current_user_id AND action_type = $nd_learning_action_type AND id_course = $nd_learning_course_id");

  if ( empty($nd_learning_is_course_compareed) ) { 
      
      return 1;

  }else{

    return 0;

  }

}
//end



//START show tab list
add_action('nd_learning_shortcode_account_tab_list','nd_learning_add_compare_tab_list');
function nd_learning_add_compare_tab_list(){

  $nd_learning_add_compare_tab_list = '

    <li class="nd_learning_display_inline_block">
      <h4>
        <a class="nd_learning_outline_0 nd_learning_padding_20 nd_learning_display_inline_block nd_options_first_font nd_options_color_greydark" href="#nd_learning_account_page_tab_compare">'.__('My Compare','nd-learning').'</a>
      </h4>
    </li>

  ';

  echo $nd_learning_add_compare_tab_list;

}



//START show compare in account page
add_action('nd_learning_shortcode_account_tab_list_content','nd_learning_show_compare');
function nd_learning_show_compare(){

  //declare variable
  $nd_learning_result = '';

  //get current user id
  $nd_learning_current_user = wp_get_current_user();
  $nd_learning_current_user_id = $nd_learning_current_user->ID;

  global $wpdb;

  $nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';
  $nd_learning_action_type = "'compare'";

  //START select for items
  $nd_learning_course_ids = $wpdb->get_results( "SELECT DISTINCT id_course FROM $nd_learning_table_name WHERE id_user = $nd_learning_current_user_id AND action_type = $nd_learning_action_type");

  //title section
  $nd_learning_result .= '
  <div class="nd_learning_section" id="nd_learning_account_page_tab_compare">
      <div class="nd_learning_section nd_learning_height_40"></div>
      <h3><strong>'.__('My Compare Courses','nd-learning').'</strong></h3>
      <div class="nd_learning_section nd_learning_height_20"></div>
  ';

  //no results
  if ( empty($nd_learning_course_ids) ) { 
    $nd_learning_result .= '<p>'.__('You do not have any course in compare','nd-learning').'</p>'; 
  }else{


    //ajax results
    $nd_learning_remove_to_compare_params = array(
      'nd_learning_ajaxurl_remove_to_compare' => admin_url('admin-ajax.php'),
      'nd_learning_ajaxnonce_remove_to_compare' => wp_create_nonce('nd_learning_remove_to_compare_nonce'),
    );

    wp_enqueue_script( 'nd_learning_remove_compare', esc_url( plugins_url( 'js/nd_learning_remove_to_compare.js', __FILE__ ) ), array( 'jquery' ) ); 
    wp_localize_script( 'nd_learning_remove_compare', 'nd_learning_my_vars_remove_to_compare', $nd_learning_remove_to_compare_params ); 


    $nd_learning_result .= '
      
        <div class="nd_learning_section nd_learning_box_sizing_border_box nd_learning_overflow_hidden nd_learning_overflow_x_auto nd_learning_cursor_move_responsive">
          <table>
            <thead>
              <tr class="nd_learning_border_bottom_1_solid_grey">
                  <td class="nd_learning_padding_20 nd_learning_width_20_percentage">
                      <h6 class="nd_learning_text_transform_uppercase">'.__('COURSE','nd-learning').'</h6>    
                  </td>
                  <td class="nd_learning_padding_20 nd_learning_width_50_percentage nd_learning_display_none_all_iphone">
                          
                  </td>
                  <td class="nd_learning_padding_20 nd_learning_width_20_percentage">
                      <h6 class="nd_learning_text_transform_uppercase">'.__('PRICE','nd-learning').'</h6>    
                  </td>
                  <td class="nd_learning_padding_20 nd_learning_width_10_percentage">
                        
                  </td>
              </tr>
          </thead>
          <tbody>


    ';

    foreach ( $nd_learning_course_ids as $nd_learning_course_id ) 
    {
      $nd_learning_result .= '

        <tr class="nd_learning_border_bottom_1_solid_grey">
            <td class="nd_learning_padding_20">  
                <img alt="" class="nd_learning_section" src="'.nd_learning_get_course_image_url($nd_learning_course_id->id_course).'"> 
            </td>
            <td class="nd_learning_padding_20">  
                <h4><strong>'.get_the_title($nd_learning_course_id->id_course).'</strong></h4> 
            </td>
            <td class="nd_learning_padding_20 nd_learning_display_none_all_iphone">
                <p class="nd_options_color_greydark">'.nd_learning_get_course_currency().' '.nd_learning_get_course_price($nd_learning_course_id->id_course).'</p>    
            </td>
            <td class="nd_learning_padding_20">   
                <a onclick="nd_learning_remove_to_compare('.$nd_learning_course_id->id_course.','.$nd_learning_current_user_id.','.$nd_learning_action_type.')" class="nd_learning_display_inline_block nd_learning_color_white_important nd_learning_cursor_pointer nd_learning_bg_red nd_options_first_font nd_learning_padding_8 nd_learning_border_radius_3 nd_learning_font_size_13">'.__('REMOVE','nd-learning').'</a>
            </td>
        </tr>

      ';
    }
    $nd_learning_result .= '</tbody></table></div>';


    $nd_learning_result .= '

      <a class="nd_learning_bg_green nd_learning_margin_top_20 nd_options_first_font nd_learning_display_inline_block nd_learning_color_white_important nd_learning_text_decoration_none nd_learning_padding_5_10 nd_learning_border_radius_3" href="'.nd_learning_get_compare_page().'">
        '.__('Go To Compare Page','nd-learning').'
      </a>

    ';

  }

  
  //END select for items

  $nd_learning_result .= '</div>';
  
  echo $nd_learning_result;
  

}



//START nd_learning_compare_php_function for AJAX
function nd_learning_compare_php_function() {

  check_ajax_referer( 'nd_learning_add_to_compare_nonce', 'nd_learning_add_to_compare_security' );

  global $wpdb;
  $nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';


  //recover datas
  $nd_learning_course_id = sanitize_text_field($_GET['nd_learning_course_id']);
  $nd_learning_user_id = sanitize_text_field($_GET['nd_learning_user_id']);
  $nd_learning_action_type = sanitize_text_field($_GET['nd_learning_action_type']);


  //CHECK NUMBER COURES IN COMPARE
  if ( nd_learning_check_number_courses_in_compare() === 3 ){

    $nd_learning_compare_text_to_return = __('ALREADY 3 PRODUCTS','nd-learning');
    echo $nd_learning_course_id.','.$nd_learning_compare_text_to_return;

  }else{

    //START INSERT DB
    $nd_learning_add_compare = $wpdb->insert( 
      
      $nd_learning_table_name, 
      
      array( 
        'id_course' => $nd_learning_course_id, 
        'id_user' => $nd_learning_user_id, 
        'action_type' => $nd_learning_action_type
      )

    );
    
    if ($nd_learning_add_compare){

      echo $nd_learning_course_id;

    }else{

      $wpdb->show_errors();
      $wpdb->print_error();

    }
    //END INSERT DB

  }
  //END

  
   
  //close the function to avoid wordpress errors
  die();

}
add_action( 'wp_ajax_nd_learning_compare_php_function', 'nd_learning_compare_php_function' );
//END



//START nd_learning_check_number_courses_in_compare
function nd_learning_check_number_courses_in_compare(){

  global $wpdb;

  $nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';
  $nd_learning_action_type = "'compare'";

  //get current user id
  $nd_learning_current_user = wp_get_current_user();
  $nd_learning_current_user_id = $nd_learning_current_user->ID;

  //START select for items
  $nd_learning_course_ids = $wpdb->get_results( "SELECT DISTINCT id_course FROM $nd_learning_table_name WHERE id_user = $nd_learning_current_user_id AND action_type = $nd_learning_action_type");

  $nd_learning_result = count($nd_learning_course_ids);

  return $nd_learning_result;

}
//end


//START nd_learning_remove_compare_php_function for AJAX
function nd_learning_remove_compare_php_function() {

  check_ajax_referer( 'nd_learning_remove_to_compare_nonce', 'nd_learning_remove_to_compare_security' );

  global $wpdb;
  $nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';


  //recover datas
  $nd_learning_course_id = sanitize_text_field($_GET['nd_learning_course_id']);
  $nd_learning_user_id = sanitize_text_field($_GET['nd_learning_user_id']);
  $nd_learning_action_type = sanitize_text_field($_GET['nd_learning_action_type']);

  //delete compare
  $nd_learning_remove_compare = $wpdb->delete( $nd_learning_table_name, array( 
    'id_user' => $nd_learning_user_id,
    'id_course' => $nd_learning_course_id,
    'action_type' => $nd_learning_action_type 
  ));


  if ($nd_learning_remove_compare){

    echo 'Removed';

  }else{

    $wpdb->show_errors();
    $wpdb->print_error();

  }
  //END INSERT DB
  
        
  //close the function to avoid wordpress errors
  die();

}
add_action( 'wp_ajax_nd_learning_remove_compare_php_function', 'nd_learning_remove_compare_php_function' );
//END


//css inline
function nd_learning_compare_style() { 
?>

    <style type="text/css">
      .ui-tooltip.nd_learning_tooltip_jquery_content{ 
        z-index: 99; 
        border-radius: 3px; 
        padding: 8px; 
        position: absolute; 
        color: #fff; 
        margin: 0px; 
        font-size: 14px;
        line-height:14px; 
        outline: 0; 
        -webkit-appearance: none; 
        border: 0;
      }
    </style>
    
<?php
}
add_action('wp_head', 'nd_learning_compare_style');


}