<?php

$nd_learning_relatedcourse_enable = get_option('nd_learning_relatedcourse_enable');
if ( $nd_learning_relatedcourse_enable == 1 and get_option('nicdark_theme_author') == 1 ) {

add_action('nd_learning_single_course_page_before_footer','nd_learning_single_course_related_products');

function nd_learning_single_course_related_products() {

  $nd_learning_result = '';

  $nd_learning_result .= '<div id="nd_learning_single_course_page_related_courses" class="nd_learning_section nd_learning_border_top_1_solid_grey">';

    //add container
    $nd_learning_container = get_option('nd_learning_container');
    if ($nd_learning_container != 1) { $nd_learning_result .= '<div class="nd_learning_container nd_learning_clearfix">'; }

  
    $nd_learning_result .= '<div class="nd_learning_section nd_learning_height_50"></div>';


    $nd_learning_result .= '<div class="nd_learning_section nd_learning_padding_15 nd_learning_box_sizing_border_box">
    
      <h2><strong>'.__('Related Products','nd-learning').'</strong></h2>

    </div>'; 


    $nd_learning_result .= do_shortcode('[nd_learning_courses_pg nd_learning_image_size="nd_learning_img_740_416" nd_learning_layout="layout-9" nd_learning_width="nd_learning_width_33_percentage nd_learning_float_left" nd_learning_orderby="rand" nd_learning_qnt="3"]');
    $nd_learning_result .= '<div class="nd_learning_section nd_learning_height_50"></div>';

    //add container
    $nd_learning_container = get_option('nd_learning_container');
    if ($nd_learning_container != 1) { $nd_learning_result .= '</div>'; }


  $nd_learning_result .= '</div>';

  
  echo $nd_learning_result;


}

}