<?php

//info
$nd_learning_id = get_the_ID(); 
$nd_learning_title = get_the_title();
$nd_learning_excerpt = get_the_excerpt();
$nd_learning_permalink = get_permalink( $nd_learning_id );
$nd_learning_width = 'nd_learning_width_33_percentage';


//metabox
$nd_learning_meta_box_course_color = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_color', true );
if ( $nd_learning_meta_box_course_color == '' ) { $nd_learning_meta_box_course_color = '#000'; }
$nd_learning_meta_box_course_teacher = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_teacher', true );
if ( $nd_learning_meta_box_course_teacher == '' ) { $nd_learning_meta_box_course_teacher = 0; }


//course information
$nd_learning_course_button = '';
if ( nd_learning_get_course_availability($nd_learning_id) == 0 ) {
    $nd_learning_course_button = '
        <a class="nd_learning_archive_courses_l2_price nd_learning_top_20 nd_learning_right_20 nd_learning_position_absolute nd_learning_bg_red nd_learning_display_inline_block nd_learning_color_white_important nd_options_first_font nd_learning_padding_8 nd_learning_border_radius_3 nd_learning_font_size_13" href="'.$nd_learning_permalink.'">'.__('COMPLETED','nd-learning').'</a>
    '; 
}else{

    $nd_learning_course_price = '';
    if ( nd_learning_get_course_price($nd_learning_id) == 0 ) {
        $nd_learning_course_price = __('FREE','nd-learning');  
    }else{
        $nd_learning_course_price = nd_learning_get_course_currency().' '.nd_learning_get_course_price($nd_learning_id);  
    } 

    $nd_learning_course_button = '
        <a class="nd_learning_archive_courses_l2_price nd_learning_top_20 nd_learning_right_20 nd_learning_position_absolute nd_learning_display_inline_block nd_learning_color_white_important nd_learning_bg_greydark nd_options_first_font nd_learning_padding_8 nd_learning_border_radius_4 nd_learning_font_size_13" href="'.$nd_learning_permalink.'">'.$nd_learning_course_price.'</a>
    ';  

}


//image
$nd_learning_image_id = get_post_thumbnail_id( $nd_learning_id );
$nd_learning_image_attributes = wp_get_attachment_image_src( $nd_learning_image_id, 'nd_learning_img_740_416' );
if ( $nd_learning_image_attributes[0] == '' ) { $nd_learning_output_image = ''; }else{
  
    $nd_learning_output_image = '

        <img class="nd_learning_section" alt="" src="'.$nd_learning_image_attributes[0].'">
        '.$nd_learning_course_button.'

    ';
}



//teacher info image and title
$nd_learning_teacher_image_id = get_post_thumbnail_id( $nd_learning_meta_box_course_teacher );
$nd_learning_teacher_image_attributes = wp_get_attachment_image_src( $nd_learning_teacher_image_id, 'large' );
if ( $nd_learning_teacher_image_attributes[0] == '' ) { $nd_learning_output_image_teacher = ''; }else{
  $nd_learning_output_image_teacher = '<img alt="" class="nd_learning_margin_right_10 nd_learning_display_table_cell nd_learning_vertical_align_middle nd_learning_border_radius_100_percentage" width="25" src="'.$nd_learning_teacher_image_attributes[0].'">';
}
$nd_learning_teacher_all_name = get_the_title($nd_learning_meta_box_course_teacher);
$nd_learning_teacher_all_name_array = explode(" ", $nd_learning_teacher_all_name);
$nd_learning_teacher_name = $nd_learning_teacher_all_name_array[0];



$nd_learning_result .= '

  <div class=" '.$nd_learning_width.' nd_learning_padding_15 nd_learning_box_sizing_border_box nd_learning_masonry_item nd_learning_width_100_percentage_responsive">

        <div class="nd_learning_section">
            
            <!--start preview-->
            <div class="nd_learning_section nd_learning_border_1_solid_grey nd_learning_border_radius_4">
                
                <!--image-->
                <div class="nd_learning_section nd_learning_position_relative">
                    '.$nd_learning_output_image.'
                </div>
                <!--image-->

                <div class="nd_learning_section nd_learning_padding_15_20 nd_learning_box_sizing_border_box nd_learning_bg_greydark">
                
                    <h4 class="nd_learning_archive_courses_l2_title nd_learning_font_weight_normal"><a class="nd_options_color_white nd_options_first_font" href="'.$nd_learning_permalink.'">'.$nd_learning_title.'</a></h4>

                </div>

                <div class="nd_learning_section nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_bg_white">
                 
                    <p><a class="" href="'.$nd_learning_permalink.'">'.$nd_learning_excerpt.'</a></p>
                    <div class="nd_learning_section nd_learning_height_15"></div>
                    <a style="background-color: '.$nd_learning_meta_box_course_color.';" class="nd_options_color_white nd_options_first_font nd_learning_border_radius_4 nd_learning_padding_10_20 nd_learning_line_height_16 nd_learning_display_inline_block" href="'.$nd_learning_permalink.'">'.__('MORE INFO','nd-learning').'</a>
                    <div class="nd_learning_section nd_learning_height_5"></div>

                </div>

                <div class="nd_learning_display_none nd_learning_section nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_bg_grey nd_learning_border_top_1_solid_grey">

                    <div class="nd_learning_width_33_percentage nd_learning_display_none_all_iphone nd_learning_float_left">
                        <div class="nd_learning_display_table nd_learning_float_left">
                            '.$nd_learning_output_image_teacher.'
                            <p class="nd_learning_display_table_cell nd_learning_vertical_align_middle nd_learning_font_size_15"><a href="'.get_permalink($nd_learning_meta_box_course_teacher).'">'.$nd_learning_teacher_name.'</a></p>
                        </div>
                    </div> 

                    <div class="nd_learning_width_33_percentage nd_learning_width_50_percentage_all_iphone nd_learning_float_left">
                        <div class="nd_learning_display_table nd_learning_float_left">
                            <img alt="" class="nd_learning_margin_right_10 nd_learning_display_table_cell nd_learning_vertical_align_middle " width="23" src="'.esc_url(plugins_url('icon-tickets-grey.png', __FILE__ )).'">
                            <p class="nd_learning_display_table_cell nd_learning_vertical_align_middle nd_learning_font_size_15"><a href="'.$nd_learning_permalink.'">'.nd_learning_get_course_availability($nd_learning_id).' '.__('Kids','nd-learning').'</a></p>
                        </div>
                    </div> 

                    <div class="nd_learning_width_33_percentage nd_learning_width_50_percentage_all_iphone nd_learning_float_left nd_learning_text_align_right">
                        <div class="nd_learning_display_table nd_learning_float_left">
                            <img alt="" class="nd_learning_margin_right_10 nd_learning_display_table_cell nd_learning_vertical_align_middle " width="23" src="'.esc_url(plugins_url('icon-clock-grey.png', __FILE__ )).'">
                            <p class="nd_learning_display_table_cell nd_learning_vertical_align_middle nd_learning_font_size_15"><a href="'.$nd_learning_permalink.'">'.nd_learning_get_course_duration().'</a></p>
                        </div>    
                    </div> 
                    
                </div>

            </div>
            <!--start preview-->

        </div> 

    </div>


  ';