<?php


$nd_learning_bookmark_enable = get_option('nd_learning_bookmark_enable');
if ( $nd_learning_bookmark_enable == 1 and get_option('nicdark_theme_author') == 1 ) {

//add button bookmark custom hook
add_action('nd_learning_single_course_over_image','nd_learning_add_bookmark_button');


function nd_learning_add_bookmark_button(){


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


  //heart image
  $nd_learning_empty_heart = esc_url(plugins_url('icon-heart-empty-white.svg', __FILE__ ));
  $nd_learning_full_heart = esc_url(plugins_url('icon-heart-full-white.svg', __FILE__ ));


  //get user ID
  $nd_learning_current_user = wp_get_current_user();
  $nd_learning_current_user_id = $nd_learning_current_user->ID;

  //bookmark
  if (is_user_logged_in() == 1){

      $nd_learning_action_type = "'bookmark'";

      //ajax results
      $nd_learning_add_to_bookmark_params = array(
          'nd_learning_ajaxurl_add_to_bookmark' => admin_url('admin-ajax.php'),
          'nd_learning_ajaxnonce_add_to_bookmark' => wp_create_nonce('nd_learning_add_to_bookmark_nonce'),
      );

      wp_enqueue_script( 'nd_learning_bookmark', esc_url( plugins_url( 'js/nd_learning_add_to_bookmark.js', __FILE__ ) ), array( 'jquery' ) ); 
      wp_localize_script( 'nd_learning_bookmark', 'nd_learning_my_vars_add_to_bookmark', $nd_learning_add_to_bookmark_params ); 

      if ( nd_learning_is_course_bookmarked( get_the_ID(), $nd_learning_current_user_id, $nd_learning_action_type ) == 0 ){

         $nd_learning_result .= '
          <div class="nd_learning_display_inline_block nd_learning_display_none_all_iphone">
            <a title="'.__('ALREADY ADDED','nd-learning').'" href="'.nd_learning_get_account_page().'#nd_learning_account_page_tab_bookmark" class="nd_learning_tooltip_jquery nd_learning_cursor_pointer nd_learning_display_inline_block nd_learning_text_decoration_none nd_learning_margin_right_20" >
              <img alt="" width="20" height="20" src="'.$nd_learning_full_heart.'">
            </a>
          </div>
          ';

      }else{


        $nd_learning_text_to_return = "'".__('ALREADY ADDED','nd-learning')."'";
        $nd_learning_link_to_return = "'".nd_learning_get_account_page()."#nd_learning_account_page_tab_bookmark"."'";
        $nd_learning_img_to_return = "'".esc_url(plugins_url("icon-heart-full-white.svg", __FILE__ ))."'";

        


         $nd_learning_result .= '
          
          <div class="nd_learning_position_relative nd_learning_display_none_all_iphone nd_learning_display_inline_block nd_learning_add_to_bookmark_btn_'.get_the_ID().'">
            <a title="'.__('ADD TO MY BOOKMARK','nd-learning').'" class="nd_learning_tooltip_jquery nd_learning_cursor_pointer nd_learning_margin_right_20 nd_learning_display_inline_block  nd_learning_text_decoration_none nd_learning_add_to_bookmark_link_'.get_the_ID().'" onclick="nd_learning_add_to_bookmark('.get_the_ID().','.$nd_learning_current_user_id.','.$nd_learning_action_type.','.$nd_learning_text_to_return.','.$nd_learning_link_to_return.','.$nd_learning_img_to_return.')" >
              <img alt="" width="20" height="20" src="'.$nd_learning_empty_heart.'">
            </a>
          </div>
        ';

      }

     

  }else{

    $nd_learning_result .= '
    
      <div class="nd_learning_display_inline_block nd_learning_display_none_all_iphone">
        <a title="'.__('MAKE THE LOGIN FOR BOOKMARK','nd-learning').'" href="'.nd_learning_get_account_page().'" class="nd_learning_tooltip_jquery nd_learning_margin_right_20 nd_learning_cursor_pointer nd_learning_display_inline_block  nd_learning_text_decoration_none" >
          <img alt="" width="20" height="20" src="'.$nd_learning_empty_heart.'">
        </a>
      </div>

    ';

  }
  //end bookmark



  return $nd_learning_result;


}



//check if course is bookmarked
function nd_learning_is_course_bookmarked($nd_learning_course_id,$nd_learning_current_user_id,$nd_learning_action_type){

  global $wpdb;

  $nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';

  $nd_learning_is_course_bookmarked = $wpdb->get_results( "SELECT id FROM $nd_learning_table_name WHERE id_user = $nd_learning_current_user_id AND action_type = $nd_learning_action_type AND id_course = $nd_learning_course_id");

  if ( empty($nd_learning_is_course_bookmarked) ) { 
      
      return 1;

  }else{

    return 0;

  }

}
//end



//START show tab list
add_action('nd_learning_shortcode_account_tab_list','nd_learning_add_bookmark_tab_list');
function nd_learning_add_bookmark_tab_list(){

  $nd_learning_add_bookmark_tab_list = '

    <li class="nd_learning_display_inline_block">
      <h4>
        <a class="nd_learning_outline_0 nd_learning_padding_20 nd_learning_display_inline_block nd_options_first_font nd_options_color_greydark" href="#nd_learning_account_page_tab_bookmark">'.__('My Bookmark','nd-learning').'</a>
      </h4>
    </li>

  ';

  echo $nd_learning_add_bookmark_tab_list;

}



//START show bookmark in account page
add_action('nd_learning_shortcode_account_tab_list_content','nd_learning_show_bookmark');
function nd_learning_show_bookmark(){

  //declare variable
  $nd_learning_result = '';

  //get current user id
  $nd_learning_current_user = wp_get_current_user();
  $nd_learning_current_user_id = $nd_learning_current_user->ID;

  global $wpdb;

  $nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';
  $nd_learning_action_type = "'bookmark'";

  //START select for items
  $nd_learning_course_ids = $wpdb->get_results( "SELECT DISTINCT id_course FROM $nd_learning_table_name WHERE id_user = $nd_learning_current_user_id AND action_type = $nd_learning_action_type");

  //title section
  $nd_learning_result .= '

  <div class="nd_learning_section" id="nd_learning_account_page_tab_bookmark">
      <div class="nd_learning_section nd_learning_height_40"></div>
      <h3><strong>'.__('My Favourite Courses','nd-learning').'</strong></h3>
      <div class="nd_learning_section nd_learning_height_20"></div>

  ';

  //no results
  if ( empty($nd_learning_course_ids) ) { 
    $nd_learning_result .= '<p>'.__('You do not have any course as a favorite','nd-learning').'</p>'; 
  }else{


    //ajax results
    $nd_learning_remove_to_bookmark_params = array(
        'nd_learning_ajaxurl_remove_to_bookmark' => admin_url('admin-ajax.php'),
        'nd_learning_ajaxnonce_remove_to_bookmark' => wp_create_nonce('nd_learning_remove_to_bookmark_nonce'),
    );

    wp_enqueue_script( 'nd_learning_remove_bookmark', esc_url( plugins_url( 'js/nd_learning_remove_to_bookmark.js', __FILE__ ) ), array( 'jquery' ) ); 
    wp_localize_script( 'nd_learning_remove_bookmark', 'nd_learning_my_vars_remove_to_bookmark', $nd_learning_remove_to_bookmark_params ); 


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
                <a onclick="nd_learning_remove_to_bookmark('.$nd_learning_course_id->id_course.','.$nd_learning_current_user_id.','.$nd_learning_action_type.')" class="nd_learning_display_inline_block nd_learning_color_white_important nd_learning_cursor_pointer nd_learning_bg_red nd_options_first_font nd_learning_padding_8 nd_learning_border_radius_3 nd_learning_font_size_13">'.__('REMOVE','nd-learning').'</a>
            </td>
        </tr>

      ';
    }
    $nd_learning_result .= '</tbody></table></div>';

  }

  
  //END select for items

  $nd_learning_result .= '</div>';
  
  echo $nd_learning_result;
  

}



//START nd_learning_bookmark_php_function for AJAX
function nd_learning_bookmark_php_function() {

  check_ajax_referer( 'nd_learning_add_to_bookmark_nonce', 'nd_learning_add_to_bookmark_security' );

  global $wpdb;
  $nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';


  //recover datas
  $nd_learning_course_id = sanitize_text_field($_GET['nd_learning_course_id']);
  $nd_learning_user_id = sanitize_text_field($_GET['nd_learning_user_id']);
  $nd_learning_action_type = sanitize_text_field($_GET['nd_learning_action_type']);


  //START INSERT DB
  $nd_learning_add_bookmark = $wpdb->insert( 
    
    $nd_learning_table_name, 
    
    array( 
      'id_course' => $nd_learning_course_id, 
      'id_user' => $nd_learning_user_id, 
      'action_type' => $nd_learning_action_type
    )

  );
  
  if ($nd_learning_add_bookmark){

    echo $nd_learning_course_id;

  }else{

    $wpdb->show_errors();
    $wpdb->print_error();

  }
  //END INSERT DB
  
        
  //close the function to avoid wordpress errors
  die();

}
add_action( 'wp_ajax_nd_learning_bookmark_php_function', 'nd_learning_bookmark_php_function' );
//END



//START nd_learning_remove_bookmark_php_function for AJAX
function nd_learning_remove_bookmark_php_function() {

  check_ajax_referer( 'nd_learning_remove_to_bookmark_nonce', 'nd_learning_remove_to_bookmark_security' );

  global $wpdb;
  $nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';


  //recover datas
  $nd_learning_course_id = sanitize_text_field($_GET['nd_learning_course_id']);
  $nd_learning_user_id = sanitize_text_field($_GET['nd_learning_user_id']);
  $nd_learning_action_type = sanitize_text_field($_GET['nd_learning_action_type']);

  //delete bookmark
  $nd_learning_remove_bookmark = $wpdb->delete( $nd_learning_table_name, array( 
    'id_user' => $nd_learning_user_id,
    'id_course' => $nd_learning_course_id,
    'action_type' => $nd_learning_action_type 
  ));


  if ($nd_learning_remove_bookmark){

    echo 'Removed';

  }else{

    $wpdb->show_errors();
    $wpdb->print_error();

  }
  //END INSERT DB
  
        
  //close the function to avoid wordpress errors
  die();

}
add_action( 'wp_ajax_nd_learning_remove_bookmark_php_function', 'nd_learning_remove_bookmark_php_function' );
//END




//css inline
function nd_learning_bookmark_style() { 
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
add_action('wp_head', 'nd_learning_bookmark_style');


}
