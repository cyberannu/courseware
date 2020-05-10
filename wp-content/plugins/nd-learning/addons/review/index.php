<?php



//START
add_action('nd_learning_hook_shortcode_order_end_left_column','nd_learning_add_review_form_on_order_page');
function nd_learning_add_review_form_on_order_page($nd_learning_order_informations){


  $nd_learning_shortcode_result = '';



  if ( nd_learning_check_if_review_is_present($nd_learning_order_informations[0],$nd_learning_order_informations[1],$nd_learning_order_informations[2]) == 0 ){

    $nd_learning_shortcode_result .= '

      <div class="nd_learning_section nd_learning_height_50"></div>
      <h3><strong>'.__('Leave a Review','nd-learning').'</strong></h3>
      <div class="nd_learning_section nd_learning_height_20"></div>
      <p>'.__('Share your experience, your rating will be shown in the single course page.','nd-learning').'</p>
      <div class="nd_learning_section nd_learning_height_20"></div>

      
      <form class="nd_learning_section" method="post" action="'.nd_learning_get_order_page().'">
        <input name="nd_learning_review_order_id" type="hidden" value="'.$nd_learning_order_informations[0].'" >
        <input name="nd_learning_review_course_id" type="hidden" value="'.$nd_learning_order_informations[1].'" >
        <input name="nd_learning_review_user_id" type="hidden" value="'.$nd_learning_order_informations[2].'" >
        <select name="nd_learning_review_number" class="nd_learning_section">
          <option value="5">'.__('5 Star','nd-learning').'</option>
          <option value="4">'.__('4 Star','nd-learning').'</option>
          <option value="3">'.__('3 Star','nd-learning').'</option>
          <option value="2">'.__('2 Star','nd-learning').'</option>
          <option value="1">'.__('1 Star','nd-learning').'</option>
        </select>
        <div class="nd_learning_section nd_learning_height_20"></div>
        <textarea name="nd_learning_review_text" rows="7" placeholder="'.__('Insert here your review','nd-learning').'" class="nd_learning_section"></textarea>
        <div class="nd_learning_section nd_learning_height_20"></div>
        <input value="'.__('Rate Now','nd-learning').'" type="submit">
      </form>


    ';

  }else{



    $nd_learning_shortcode_result .= '
      <div class="nd_learning_section nd_learning_height_50"></div>
      <h3><strong>'.__('Rating has already been sent','nd-learning').'</strong></h3>
      <div class="nd_learning_section nd_learning_height_20"></div>
      <p>'.__('It seems that your feedback has already been sent','nd-learning').'</p>
      <div class="nd_learning_section nd_learning_height_20"></div>
      <a class="nd_learning_bg_green nd_learning_display_inline_block nd_learning_color_white_important nd_learning_text_decoration_none nd_learning_padding_5_10 nd_learning_border_radius_3 nd_options_first_font" href="'.nd_learning_get_account_page().'">'.__('My Account','nd-learning').'</a>
    ';




  }



  

  echo $nd_learning_shortcode_result;



}







add_action('nd_learning_hook_review_set','nd_learning_add_review_on_db');
function nd_learning_add_review_on_db(){


  //recover values
  $nd_learning_review_order_id = sanitize_text_field($_POST['nd_learning_review_order_id']);
  $nd_learning_review_course_id = sanitize_text_field($_POST['nd_learning_review_course_id']);
  $nd_learning_review_user_id = sanitize_text_field($_POST['nd_learning_review_user_id']);
  $nd_learning_review_number = sanitize_text_field($_POST['nd_learning_review_number']);
  $nd_learning_review_text = sanitize_text_field($_POST['nd_learning_review_text']);
  $nd_learning_review_date = date('H:m:s F j Y');

  $nd_learning_shortcode_result = '';


    $nd_learning_shortcode_result .= '

    <div class="nd_learning_section nd_learning_box_sizing_border_box nd_learning_padding_15">
      <h2><strong>'.__('Thanks For Your Review','nd-learning').'</strong></h2>
      <div class="nd_learning_section nd_learning_height_20"></div>
      <p>'.__('Your rating will be visible in the single course page.','nd-learning').'</p>
      <div class="nd_learning_section nd_learning_height_20"></div>
      <a class="nd_learning_bg_green nd_learning_display_inline_block nd_learning_color_white_important nd_learning_text_decoration_none nd_learning_padding_5_10 nd_learning_border_radius_3 nd_options_first_font" href="'.nd_learning_get_account_page().'">'.__('My Account','nd-learning').'</a>
    </div>
  '; 

  if ( nd_learning_check_if_review_is_present($nd_learning_review_order_id,$nd_learning_review_course_id,$nd_learning_review_user_id) == 0 ) {

    nd_learning_add_order_in_db(

      $nd_learning_review_course_id,
      $nd_learning_review_order_id,
      $nd_learning_review_date,
      $nd_learning_review_number,
      0,
      0,
      0,
      0,
      $nd_learning_review_user_id,
      0,
      0,
      $nd_learning_review_text,
      0,
      0,
      'review'

    );

  }

  
  echo $nd_learning_shortcode_result;

}








//add comments tab list in the custom hook
add_action('nd_learning_single_course_tab_list_2','nd_learning_single_course_add_reviews_tab_list');
function nd_learning_single_course_add_reviews_tab_list(){

  $nd_learning_reviews_tab = '';


  $nd_learning_reviews_tab .= '
    <li class="nd_learning_display_inline_block">
    <h4>
      <a class="nd_learning_outline_0 nd_learning_padding_20_15 nd_learning_display_inline_block nd_options_first_font nd_options_color_greydark" href="#nd_learning_single_course_reviews">
        '.__('Reviews','nd-learning').'
      </a>
    </h4>
  </li>
    ';

    echo $nd_learning_reviews_tab;

}


//add shortcode in the custom hook
add_action('nd_learning_single_course_tab_list_content','nd_learning_shortcode_reviews');
function nd_learning_shortcode_reviews() {

  global $wpdb;

  $nd_learning_result = '';
  $nd_learning_course_id = get_the_ID();
  $nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';
  $nd_learning_action_type = "'review'";
 

  //START select for items
  $nd_learning_reviews = $wpdb->get_results( "SELECT qnt, id_user, user_first_name FROM $nd_learning_table_name WHERE id_course = $nd_learning_course_id AND action_type = $nd_learning_action_type");

  $nd_learning_result .= '<div class="nd_learning_section" id="nd_learning_single_course_reviews">';


  //title section
  $nd_learning_result .= '
  <div class="nd_learning_section nd_learning_height_40"></div>
  <h3><strong>'.__('Course Reviews','nd-learning').'</strong></h3>
  <div class="nd_learning_section nd_learning_height_30"></div>
  ';

  
  //no results
  if ( empty($nd_learning_reviews) ) { 

    $nd_learning_result .= '<p>'.__('Still no reviews','nd-learning').'</p>'; 

  }else{


    


    $nd_learning_result .= '


      <div class="nd_learning_section">

        <div class="nd_learning_width_30_percentage nd_learning_width_100_percentage_all_iphone nd_learning_border_radius_3 nd_learning_float_left nd_learning_text_align_center nd_learning_bg_greydark nd_learning_padding_30 nd_learning_box_sizing_border_box">

            <h1 class="nd_learning_font_size_70 nd_learning_color_white_important"><strong>'.nd_learning_course_review_average($nd_learning_course_id).'</strong></h1>

            <div class="nd_learning_section nd_learning_height_20"></div>

            <div class="nd_learning_section ">
                '.nd_learning_course_review_star(nd_learning_course_review_average($nd_learning_course_id),15,'yellow','0px 2px').'
            </div>

            <p>'.nd_learning_course_review_qnt($nd_learning_course_id).' '.__('Ratings','nd-learning').'</p>

        </div>


        <div class="nd_learning_width_70_percentage nd_learning_width_100_percentage_all_iphone nd_learning_padding_left_40 nd_learning_padding_left_0_all_iphone nd_learning_float_left nd_learning_box_sizing_border_box">

            <div class=" nd_learning_border_radius_3 nd_learning_section nd_learning_border_1_solid_grey nd_learning_padding_20 nd_learning_box_sizing_border_box">
                <table class="nd_learning_section">
                    <tbody><tr>
                        <td class="nd_learning_width_20_percentage "><h5><strong>'.__('5 Stars','nd-learning').'</strong></h5></td>
                        <td class="nd_learning_width_70_percentage ">
                          
                          <div class="nd_learning_section nd_learning_bg_grey_3 nd_learning_height_10 nd_learning_border_radius_3">
                            <span style="width:'.nd_learning_course_review_number_percentage($nd_learning_course_id,5).'%;" class="nd_learning_bg_yellow nd_learning_float_left nd_learning_height_10 nd_learning_border_radius_3"></span>
                          </div>

                        </td>
                        <td class="nd_learning_width_10_percentage nd_learning_text_align_right"><p class="nd_learning_font_size_14 nd_learning_line_height_30">'.nd_learning_course_review_number_qnt($nd_learning_course_id,5).'</p></td>
                    </tr>
                    <tr>
                        <td class="nd_learning_width_20_percentage "><h5><strong>'.__('4 Stars','nd-learning').'</strong></h5></td>
                        <td class="nd_learning_width_70_percentage ">

                        <div class="nd_learning_section nd_learning_bg_grey_3 nd_learning_height_10 nd_learning_border_radius_3">
                            <span style="width:'.nd_learning_course_review_number_percentage($nd_learning_course_id,4).'%;" class="nd_learning_bg_yellow nd_learning_float_left nd_learning_height_10 nd_learning_border_radius_3"></span>
                          </div>

                        </td>
                        <td class="nd_learning_width_10_percentage nd_learning_text_align_right"><p class="nd_learning_font_size_14 nd_learning_line_height_30">'.nd_learning_course_review_number_qnt($nd_learning_course_id,4).'</p></td>
                    </tr>
                    <tr>
                        <td class="nd_learning_width_20_percentage "><h5><strong>'.__('3 Stars','nd-learning').'</strong></h5></td>
                        <td class="nd_learning_width_70_percentage ">
                          
                          <div class="nd_learning_section nd_learning_bg_grey_3 nd_learning_height_10 nd_learning_border_radius_3">
                            <span style="width:'.nd_learning_course_review_number_percentage($nd_learning_course_id,3).'%;" class="nd_learning_bg_yellow nd_learning_float_left nd_learning_height_10 nd_learning_border_radius_3"></span>
                          </div>

                        </td>
                        <td class="nd_learning_width_10_percentage nd_learning_text_align_right"><p class="nd_learning_font_size_14 nd_learning_line_height_30">'.nd_learning_course_review_number_qnt($nd_learning_course_id,3).'</p></td>
                    </tr>
                    <tr>
                        <td class="nd_learning_width_20_percentage "><h5><strong>'.__('2 Stars','nd-learning').'</strong></h5></td>
                        <td class="nd_learning_width_70_percentage ">

                          <div class="nd_learning_section nd_learning_bg_grey_3 nd_learning_height_10 nd_learning_border_radius_3">

                            <div class="nd_learning_section nd_learning_bg_grey_3 nd_learning_height_10 nd_learning_border_radius_3">
                              <span style="width:'.nd_learning_course_review_number_percentage($nd_learning_course_id,2).'%;" class="nd_learning_bg_yellow nd_learning_float_left nd_learning_height_10 nd_learning_border_radius_3"></span>
                            </div>

                          </div>

                        </td>
                        <td class="nd_learning_width_10_percentage nd_learning_text_align_right"><p class="nd_learning_font_size_14 nd_learning_line_height_30">'.nd_learning_course_review_number_qnt($nd_learning_course_id,2).'</p></td>
                    </tr>
                    <tr>
                        <td class="nd_learning_width_20_percentage "><h5><strong>'.__('1 Stars','nd-learning').'</strong></h5></td>
                        <td class="nd_learning_width_70_percentage "><div class="nd_learning_section nd_learning_bg_grey_3 nd_learning_height_10 nd_learning_border_radius_3">

                          <div class="nd_learning_section nd_learning_bg_grey_3 nd_learning_height_10 nd_learning_border_radius_3">
                            <span style="width:'.nd_learning_course_review_number_percentage($nd_learning_course_id,1).'%;" class="nd_learning_bg_yellow nd_learning_float_left nd_learning_height_10 nd_learning_border_radius_3"></span>
                          </div>

                        </div></td>
                        <td class="nd_learning_width_10_percentage nd_learning_text_align_right"><p class="nd_learning_font_size_14 nd_learning_line_height_30">'.nd_learning_course_review_number_qnt($nd_learning_course_id,1).'</p></td>
                    </tr>
                </tbody></table>
            </div>

        </div>



    </div>


    <div class="nd_learning_section nd_learning_height_30"></div>



    ';




    
    foreach ( $nd_learning_reviews as $nd_learning_review ) 
    {
      
      $nd_learning_review_avatar_url_args = array( 'size' => 300 );
      $nd_learning_review_avatar_url = get_avatar_url($nd_learning_review->id_user, $nd_learning_review_avatar_url_args);
      $nd_learning_review_id = $nd_learning_review->id_user;


      $nd_learning_result .= '
                                 

          <!--START-->
          <div class="nd_learning_section nd_learning_border_top_1_solid_grey nd_learning_padding_40_20 nd_learning_box_sizing_border_box">
              <div class="nd_learning_display_table nd_learning_float_left">
                  <img alt="" class="nd_learning_display_none_all_iphone nd_learning_margin_right_10 nd_learning_display_table_cell nd_learning_vertical_align_middle nd_learning_border_radius_100_percentage" width="40" height="40" src="'.$nd_learning_review_avatar_url.'">
                  <p class="  nd_learning_display_table_cell nd_learning_vertical_align_middle "><span class="nd_options_color_greydark nd_options_first_font nd_learning_margin_right_20"><strong>'.get_userdata($nd_learning_review_id)->user_firstname.'</strong></span></p>
                  
                  <div class="nd_learning_display_table_cell nd_learning_vertical_align_middle ">
                      '.nd_learning_course_review_star($nd_learning_review->qnt,15,'yellow','0px 2px').'
                  </div>

              </div>

              <div class="nd_learning_section nd_learning_height_20"></div>
              <div class="nd_learning_section">
                  <p>'.$nd_learning_review->user_first_name.'</p>
              </div>

          </div>
          <!--END-->

      ';


    }

  }

  $nd_learning_result .= '</div>';

  echo $nd_learning_result;
  //END select for items

}








//add content in single teacher page
add_action('nd_learning_single_teacher_header_info_bar','nd_learning_single_teacher_header_info_bar_rating');
function nd_learning_single_teacher_header_info_bar_rating(){


  $nd_learning_result = '';

  $nd_learning_result .= '

    <div class="nd_learning_display_inline_block nd_learning_text_align_center  nd_learning_margin_left_40 nd_learning_margin_0_10_responsive">
        <h1 class="nd_learning_color_white_important nd_learning_font_size_40 nd_learning_font_size_30_responsive nd_learning_font_size_20_all_iphone nd_learning_line_height_20_all_iphone"><strong>'.nd_learning_get_rating_average_by_teacher(get_the_ID()).'</strong></h1>
        <div class="nd_learning_section nd_learning_height_5"></div>
        <p class="nd_learning_font_size_13_responsive nd_learning_color_white_important nd_learning_font_size_10_all_iphone">'.__('RATING','nd-learning').'</p>
    </div>

  ';

  echo $nd_learning_result;


}



//add tab review in single teacher page
add_action('nd_learning_single_teacher_tab_list_2','nd_learning_single_teacher_add_review_tab_list');
function nd_learning_single_teacher_add_review_tab_list(){

    $nd_learning_review_tabs = '';


    $nd_learning_review_tabs .= '
    <li class="nd_learning_display_inline_block">
        <h4>
            <a class="nd_learning_outline_0 nd_learning_padding_20 nd_learning_display_inline_block nd_options_first_font nd_options_color_greydark" href="#nd_learning_single_teacher_reviews">
                '.__('My Reviews','nd-learning').'
            </a>
            <a class="nd_learning_display_inline_block nd_learning_bg_grey nd_learning_margin_right_20 nd_learning_border_1_solid_grey nd_options_first_font nd_learning_padding_8 nd_learning_border_radius_3 nd_learning_font_size_13" href="#">'.nd_learning_get_qnt_rating_by_teacher(get_the_ID()).'</a>
        </h4>
    </li>

    ';

    echo $nd_learning_review_tabs;
}



//ADD default tab content
add_action('nd_learning_single_teacher_tab_list_content','nd_learning_single_teacher_add_review_tab_list_content');
function nd_learning_single_teacher_add_review_tab_list_content(){



    $nd_learning_review_tabs_content = '';


    $nd_learning_review_tabs_content .= '

        <div class="nd_learning_section" id="nd_learning_single_teacher_reviews">
            <div class="nd_learning_section nd_learning_height_20"></div> 
            ';


    if ( nd_learning_get_qnt_rating_by_teacher(get_the_ID()) == 0 ) {

        $nd_learning_review_tabs_content .= __('Any review founded','nd-learning');  

    }else{


        $nd_learning_review_tabs_content .= '

          <div class="nd_learning_section nd_learning_height_20"></div> 
          <h3><strong>'.__('Teacher courses reviews','nd-learning').'</strong></h3>
          <div class="nd_learning_section nd_learning_height_30"></div> 

        ';


        $nd_learning_teacher_id = get_the_ID();
        $nd_learning_all_courses_teacher_id = nd_learning_get_id_courses_by_teacher($nd_learning_teacher_id);
        
        $nd_learning_courses_id_array = explode(',', $nd_learning_all_courses_teacher_id);

        
        for ($nd_learning_courses_id_array_i = 0; $nd_learning_courses_id_array_i < count($nd_learning_courses_id_array)-1; $nd_learning_courses_id_array_i++) {

          $nd_learning_courses_id = $nd_learning_courses_id_array[$nd_learning_courses_id_array_i];
          
          //START db query
          global $wpdb;
          $nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';
          $nd_learning_action_type = "'review'";
          $nd_learning_reviews_info = $wpdb->get_results( "SELECT id_course,id_user,qnt,user_first_name FROM $nd_learning_table_name WHERE id_course = $nd_learning_courses_id AND action_type = $nd_learning_action_type" );  
          
          if ( empty($nd_learning_reviews_info) ){  }else{


            //start for each
            foreach ( $nd_learning_reviews_info as $nd_learning_review_info ) 
            {
              
              $nd_learning_review_avatar_url_args = array( 'size' => 300 );
              $nd_learning_review_avatar_url = get_avatar_url($nd_learning_review_info->id_user, $nd_learning_review_avatar_url_args);
              $nd_learning_review_id = $nd_learning_review_info->id_user;
              $nd_learning_review_course_title = get_the_title($nd_learning_review_info->id_course);


              $nd_learning_review_tabs_content .= '
                                         

                  <!--START-->
                  <div class="nd_learning_section nd_learning_border_top_1_solid_grey nd_learning_padding_40_20 nd_learning_box_sizing_border_box">
                      <div class="nd_learning_display_table nd_learning_float_left">
                          <img alt="" class="nd_learning_display_none_all_iphone nd_learning_margin_right_10 nd_learning_display_table_cell nd_learning_vertical_align_middle nd_learning_border_radius_100_percentage" width="40" height="40" src="'.$nd_learning_review_avatar_url.'">
                          <p class="nd_learning_width_100_percentage_all_iphone nd_learning_float_left_all_iphone  nd_learning_display_table_cell nd_learning_vertical_align_middle "><span class="nd_options_color_greydark nd_options_first_font"><strong>'.get_userdata($nd_learning_review_id)->user_firstname.'</strong></span><span class="nd_learning_margin_0_10">-</span><span class="nd_learning_margin_right_20">'.$nd_learning_review_course_title.'</span></p>
                          
                          <div class="nd_learning_width_100_percentage_all_iphone nd_learning_float_left_all_iphone nd_learning_display_table_cell nd_learning_vertical_align_middle ">
                              '.nd_learning_course_review_star($nd_learning_review_info->qnt,15,'yellow','0px 2px').'
                          </div>

                      </div>

                      <div class="nd_learning_section nd_learning_height_20"></div>
                      <div class="nd_learning_section">
                          <p>'.$nd_learning_review_info->user_first_name.'</p>
                      </div>

                  </div>
                  <!--END-->

              ';


            }
            //end foreach


          }
          //END db query

        }

        

    }



    $nd_learning_review_tabs_content .= '</div>';



    echo $nd_learning_review_tabs_content;
}


