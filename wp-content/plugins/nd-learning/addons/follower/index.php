<?php

$nd_learning_follower_enable = get_option('nd_learning_follower_enable');
if ( $nd_learning_follower_enable == 1 and get_option('nicdark_theme_author') == 1 ) {

//add content in single teacher page
add_action('nd_learning_single_teacher_header_btns','nd_learning_single_teacher_header_info_btn_follower');
function nd_learning_single_teacher_header_info_btn_follower(){


  //get user ID
  $nd_learning_current_user = wp_get_current_user();
  $nd_learning_current_user_id = $nd_learning_current_user->ID;


  if (is_user_logged_in() == 1){

      $nd_learning_action_type = "'followers'";

    
      if ( nd_learning_is_teacher_followed( get_the_ID(), $nd_learning_current_user_id, $nd_learning_action_type ) == 0 ){

        //ajax results
        $nd_learning_remove_follower_params = array(
            'nd_learning_ajaxurl_remove_follower' => admin_url('admin-ajax.php'),
            'nd_learning_ajaxnonce_remove_follower' => wp_create_nonce('nd_learning_remove_follower_nonce'),
        );

        wp_enqueue_script( 'nd_learning_remove_follower', esc_url( plugins_url( 'js/nd_learning_remove_follower.js', __FILE__ ) ), array( 'jquery' ) ); 
        wp_localize_script( 'nd_learning_remove_follower', 'nd_learning_my_vars_remove_follower', $nd_learning_remove_follower_params ); 


         echo '<div id="nd_learning_following_btn_container" class="nd_learning_position_relative nd_learning_display_inline_block">
            <a id="nd_learning_following_btn" class="nd_learning_display_inline_block nd_learning_margin_left_20 nd_learning_margin_left_0_all_iphone nd_learning_margin_top_20_iphone_port nd_learning_color_white_important nd_learning_line_height_16 nd_learning_border_1_solid_green nd_learning_bg_green nd_options_first_font nd_learning_padding_10_20 nd_learning_border_radius_3 nd_learning_cursor_pointer">'.__('FOLLOWING','nd-learning').'</a>
         </div>

         <script type="text/javascript">
          <!--//--><![CDATA[//><!--
              
              jQuery(document).ready(function($) {

                  $( "#nd_learning_following_btn_container" ).hover(
                    function() {
                      $("#nd_learning_following_btn").css( "display","none" );
                      $("#nd_learning_following_btn_container").append("<a onclick=\"nd_learning_remove_follower('.get_the_ID().','.$nd_learning_current_user_id.','.$nd_learning_action_type.')\" id=\"nd_learning_unfollowing_btn\" class=\"nd_learning_display_inline_block nd_learning_margin_left_20 nd_learning_margin_left_0_all_iphone nd_learning_margin_top_20_iphone_port nd_learning_color_white_important nd_learning_line_height_16 nd_learning_border_1_solid_red nd_learning_bg_red nd_options_first_font nd_learning_padding_10_20 nd_learning_border_radius_3 nd_learning_cursor_pointer\">'.__('UNFOLLOWING','nd-learning').'</a>");
                    }, function() {
                      $("#nd_learning_following_btn").css( "display","block" );
                      $("#nd_learning_unfollowing_btn").remove();
                    }
                  );


              });

          //--><!]]>
          </script>

         ';
      
      }else{


        //ajax results
        $nd_learning_add_follower_params = array(
            'nd_learning_ajaxurl_add_follower' => admin_url('admin-ajax.php'),
            'nd_learning_ajaxnonce_add_follower' => wp_create_nonce('nd_learning_add_follower_nonce'),
        );

        wp_enqueue_script( 'nd_learning_followers', esc_url( plugins_url( 'js/nd_learning_add_follower.js', __FILE__ ) ), array( 'jquery' ) ); 
        wp_localize_script( 'nd_learning_followers', 'nd_learning_my_vars_add_follower', $nd_learning_add_follower_params ); 


         echo '<div class="nd_learning_position_relative nd_learning_display_inline_block">
            <a id="nd_learning_follow_me_btn" onclick="nd_learning_add_follower('.get_the_ID().','.$nd_learning_current_user_id.','.$nd_learning_action_type.')" class="nd_learning_display_inline_block nd_learning_margin_left_20 nd_learning_margin_left_0_all_iphone nd_learning_margin_top_20_iphone_port nd_learning_color_white_important nd_learning_line_height_16 nd_learning_border_1_solid_white nd_learning_cursor_pointer nd_options_first_font nd_learning_padding_10_20 nd_learning_border_radius_3">'.__('FOLLOW ME','nd-learning').'</a>
          </div>';
      }

     

  }else{

    echo '<div class="nd_learning_position_relative nd_learning_display_inline_block">
      <a class="nd_learning_display_inline_block nd_learning_margin_left_20 nd_learning_margin_left_0_all_iphone nd_learning_margin_top_20_iphone_port nd_learning_color_white_important nd_learning_line_height_16 nd_learning_border_1_solid_white nd_options_first_font nd_learning_padding_10_20 nd_learning_border_radius_3" href="'.nd_learning_get_account_page().'">'.__('FOLLOW ME','nd-learning').'</a>
    </div>';  

  }




}



//add content in single teacher page
add_action('nd_learning_single_teacher_header_info_bar','nd_learning_single_teacher_header_info_bar_follower');
function nd_learning_single_teacher_header_info_bar_follower(){


  $nd_learning_result = '';

  $nd_learning_result .= '

    <div class="nd_learning_display_inline_block nd_learning_text_align_center  nd_learning_margin_left_40 nd_learning_margin_0_10_responsive">
        <h1 class="nd_learning_color_white_important nd_learning_font_size_40 nd_learning_font_size_30_responsive nd_learning_font_size_20_all_iphone nd_learning_line_height_20_all_iphone"><strong>'.nd_learning_follower_qnt_by_teacher(get_the_ID()).'</strong></h1>
        <div class="nd_learning_section nd_learning_height_5"></div>
        <p class="nd_learning_font_size_13_responsive nd_learning_color_white_important nd_learning_font_size_10_all_iphone">'.__('FOLLOWERS','nd-learning').'</p>
    </div>

  ';

  echo $nd_learning_result;


}



//add tab follower in single teacher page
add_action('nd_learning_single_teacher_tab_list_2','nd_learning_single_teacher_add_followers_tab_list');
function nd_learning_single_teacher_add_followers_tab_list(){

    $nd_learning_follower_tabs = '';


    $nd_learning_follower_tabs .= '
    <li class="nd_learning_display_inline_block">
        <h4>
            <a class="nd_learning_outline_0 nd_learning_padding_20 nd_learning_display_inline_block nd_options_first_font nd_options_color_greydark" href="#nd_learning_single_teacher_followers">
                '.__('My Followers','nd-learning').'
            </a>
            <a class="nd_learning_display_inline_block nd_learning_bg_grey nd_learning_margin_right_20 nd_learning_border_1_solid_grey nd_options_first_font nd_learning_padding_8 nd_learning_border_radius_3 nd_learning_font_size_13" href="#">'.nd_learning_follower_qnt_by_teacher(get_the_ID()).'</a>
        </h4>
    </li>

    ';

    echo $nd_learning_follower_tabs;
}



//ADD default tab content
add_action('nd_learning_single_teacher_tab_list_content','nd_learning_single_teacher_add_followers_tab_list_content');
function nd_learning_single_teacher_add_followers_tab_list_content(){



    $nd_learning_followers_tabs_content = '';


    $nd_learning_followers_tabs_content .= '

        <div class="nd_learning_section" id="nd_learning_single_teacher_followers">
            <div class="nd_learning_section nd_learning_height_20"></div>';



    if (nd_learning_follower_qnt_by_teacher(get_the_ID()) == 0) {

      $nd_learning_followers_tabs_content .= __('Any followers founded','nd-learning');  

    }else{

      //START db query
      global $wpdb;
      $nd_learning_teacher_id = get_the_ID();
      $nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';
      $nd_learning_action_type = "'followers'";
      $nd_learning_followers_info = $wpdb->get_results( "SELECT id_user FROM $nd_learning_table_name WHERE id_course = $nd_learning_teacher_id AND action_type = $nd_learning_action_type");
      //END db query


      foreach ( $nd_learning_followers_info as $nd_learning_follower_info ) 
      {
        
        $nd_learning_follower_avatar_url_args = array( 'size' => 300 );
        $nd_learning_follower_avatar_url = get_avatar_url($nd_learning_follower_info->id_user, $nd_learning_follower_avatar_url_args);

        $nd_learning_followers_tabs_content .= '

          <!--START preview-->
          <div class="nd_learning_width_20_percentage nd_learning_width_50_percentage_all_iphone nd_learning_padding_20 nd_learning_float_left nd_learning_box_sizing_border_box">
              <div class="nd_learning_section nd_learning_box_sizing_border_box">

                  <div class="nd_learning_section nd_learning_position_relative">
                      <img alt="" class="nd_learning_section" src="'.$nd_learning_follower_avatar_url.'">
                      <div class="nd_learning_bg_greydark_alpha_gradient_3 nd_learning_position_absolute nd_learning_left_0 nd_learning_height_100_percentage nd_learning_width_100_percentage nd_learning_box_sizing_border_box"></div>
                  </div>

              </div>
          </div>
          <!--END preview-->

        ';
                                  
      }

      

    }



    $nd_learning_followers_tabs_content .= '</div>';



    echo $nd_learning_followers_tabs_content;
}




//START for AJAX
function nd_learning_followers_php_function() {

  check_ajax_referer( 'nd_learning_add_follower_nonce', 'nd_learning_add_follower_security' );

  global $wpdb;
  $nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';


  //recover datas
  $nd_learning_teacher_id = sanitize_text_field($_GET['nd_learning_teacher_id']);
  $nd_learning_user_id = sanitize_text_field($_GET['nd_learning_user_id']);
  $nd_learning_action_type = sanitize_text_field($_GET['nd_learning_action_type']);


  //START INSERT DB
  $nd_learning_add_follower = $wpdb->insert( 
    
    $nd_learning_table_name, 
    
    array( 
      'id_course' => $nd_learning_teacher_id, 
      'id_user' => $nd_learning_user_id, 
      'action_type' => $nd_learning_action_type
    )

  );
  
  if ($nd_learning_add_follower){

  }else{

    $wpdb->show_errors();
    $wpdb->print_error();

  }
  //END INSERT DB
  
        
  //close the function to avoid wordpress errors
  die();

}
add_action( 'wp_ajax_nd_learning_followers_php_function', 'nd_learning_followers_php_function' );
//END






//START remove follower for AJAX
function nd_learning_remove_follower_php_function() {

  check_ajax_referer( 'nd_learning_remove_follower_nonce', 'nd_learning_remove_follower_security' );

  global $wpdb;
  $nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';


  //recover datas
  $nd_learning_teacher_id = sanitize_text_field($_GET['nd_learning_teacher_id']);
  $nd_learning_user_id = sanitize_text_field($_GET['nd_learning_user_id']);
  $nd_learning_action_type = sanitize_text_field($_GET['nd_learning_action_type']);

  //remove_follower
  $nd_learning_remove_follower = $wpdb->delete( $nd_learning_table_name, array( 
    'id_user' => $nd_learning_user_id,
    'id_course' => $nd_learning_teacher_id,
    'action_type' => $nd_learning_action_type 
  ));


  if ($nd_learning_remove_follower){

  }else{

    $wpdb->show_errors();
    $wpdb->print_error();

  }
  //END INSERT DB
  
        
  //close the function to avoid wordpress errors
  die();

}
add_action( 'wp_ajax_nd_learning_remove_follower_php_function', 'nd_learning_remove_follower_php_function' );
//END





//check if teacher is followed
function nd_learning_is_teacher_followed($nd_learning_teacher_id,$nd_learning_current_user_id,$nd_learning_action_type){

  global $wpdb;

  $nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';

  $nd_learning_is_teacher_followed = $wpdb->get_results( "SELECT id FROM $nd_learning_table_name WHERE id_user = $nd_learning_current_user_id AND action_type = $nd_learning_action_type AND id_course = $nd_learning_teacher_id");

  if ( empty($nd_learning_is_teacher_followed) ) { 
      
      return 1;

  }else{

    return 0;

  }

}
//end




//START show tab list
add_action('nd_learning_shortcode_account_tab_list','nd_learning_add_followers_tab_list');
function nd_learning_add_followers_tab_list(){

  $nd_learning_add_follower_tab_list = '

    <li class="nd_learning_display_inline_block">
      <h4>
        <a class="nd_learning_outline_0 nd_learning_padding_20 nd_learning_display_inline_block nd_options_first_font nd_options_color_greydark" href="#nd_learning_account_page_tab_followers">'.__('Teachers Followed','nd-learning').'</a>
      </h4>
    </li>

  ';

  echo $nd_learning_add_follower_tab_list;

}





//START show follower in account page
add_action('nd_learning_shortcode_account_tab_list_content','nd_learning_show_followers');
function nd_learning_show_followers(){

  //declare variable
  $nd_learning_result = '';

  //get current user id
  $nd_learning_current_user = wp_get_current_user();
  $nd_learning_current_user_id = $nd_learning_current_user->ID;

  global $wpdb;

  $nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';
  $nd_learning_action_type = "'followers'";

  //START select for items
  $nd_learning_followers_ids = $wpdb->get_results( "SELECT DISTINCT id_course FROM $nd_learning_table_name WHERE id_user = $nd_learning_current_user_id AND action_type = $nd_learning_action_type");

  //title section
  $nd_learning_result .= '
  <div class="nd_learning_section" id="nd_learning_account_page_tab_followers">
      <div class="nd_learning_section nd_learning_height_40"></div>
      <h3><strong>'.__('Teachers Followed','nd-learning').'</strong></h3>
      <div class="nd_learning_section nd_learning_height_20"></div>
  ';

  //no results
  if ( empty($nd_learning_followers_ids) ) { 
    $nd_learning_result .= '<p>'.__('You do not follow any teachers','nd-learning').'</p>'; 
  }else{


    foreach ( $nd_learning_followers_ids as $nd_learning_followers_id ) 
    {

      $nd_learning_teacher_id = $nd_learning_followers_id->id_course;
      $nd_learning_teacher_name = get_the_title($nd_learning_teacher_id);
      $nd_learning_teacher_permalink = get_permalink($nd_learning_teacher_id);

      //image teacher
      $nd_learning_output_image_teacher = '';
      $nd_learning_teacher_image_id = get_post_thumbnail_id( $nd_learning_teacher_id );
      $nd_learning_teacher_image_attributes = wp_get_attachment_image_src( $nd_learning_teacher_image_id, 'large' );
      if ( $nd_learning_teacher_image_attributes[0] == '' ) { $nd_learning_output_image = ''; }else{
        $nd_learning_output_image_teacher .= '
        <img alt="" class="nd_learning_width_50_all_iphone nd_learning_margin_right_20 nd_learning_float_left " width="100" src="'.$nd_learning_teacher_image_attributes[0].'">';
      }

      //metabox teacher
      $nd_learning_meta_box_teacher_color = get_post_meta( $nd_learning_teacher_id, 'nd_learning_meta_box_teacher_color', true );
      if ( $nd_learning_meta_box_teacher_color == '' ) { $nd_learning_meta_box_teacher_color = '#000'; }
      $nd_learning_meta_box_teacher_role = get_post_meta( $nd_learning_teacher_id, 'nd_learning_meta_box_teacher_role', true );
      if ( $nd_learning_meta_box_teacher_role == '' ) { $nd_learning_meta_box_teacher_role = __('TEACHER','nd-learning'); }


      $nd_learning_result .= '


          <!--START teacher-->
          <div class="nd_learning_section nd_learning_border_top_1_solid_grey nd_learning_padding_40_20 nd_learning_box_sizing_border_box">


              <div class="nd_learning_display_table nd_learning_float_left">
                          
                  <div class="nd_learning_display_table_cell nd_learning_vertical_align_middle">
                    '.$nd_learning_output_image_teacher.'
                  </div>

                  <div class="nd_learning_display_table_cell nd_learning_vertical_align_middle">
                      <h3 class=""><a class="nd_options_color_greydark nd_options_first_font" href="'.$nd_learning_teacher_permalink.'"><strong>'.$nd_learning_teacher_name.'</strong></a></h3>
                      <div class="nd_learning_section nd_learning_height_5"></div>
                      <h5 class="nd_options_color_grey">'.$nd_learning_meta_box_teacher_role.'</h5>
                      <div class="nd_learning_section nd_learning_height_20"></div>
                      <a style="background-color:'.$nd_learning_meta_box_teacher_color.';" class="nd_learning_display_inline_block nd_learning_color_white_important nd_options_first_font nd_learning_padding_8 nd_learning_border_radius_3 nd_learning_font_size_13" href="'.$nd_learning_teacher_permalink.'">
                        '.__('VIEW PROFILE','nd-learning').'
                      </a>
                    

                  </div>

              </div>
                 

          </div>
          <!--END teacher-->


      ';
    }


  }

  
  //END select for items

  $nd_learning_result .= '</div>';
  
  echo $nd_learning_result;
  

}

}