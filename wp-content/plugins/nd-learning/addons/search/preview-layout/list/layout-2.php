<?php

//info
$nd_learning_id = get_the_ID(); 
$nd_learning_title = get_the_title();
$nd_learning_excerpt = get_the_excerpt();
$nd_learning_permalink = get_permalink( $nd_learning_id );
$nd_learning_width = 'nd_learning_width_50_percentage';

//image
$nd_learning_image_id = get_post_thumbnail_id( $nd_learning_id );
$nd_learning_image_attributes = wp_get_attachment_image_src( $nd_learning_image_id, 'nd_learning_img_740_416' );
if ( $nd_learning_image_attributes[0] == '' ) { $nd_learning_output_image = ''; }else{

    $nd_learning_course_review_star = '';
    if ( nd_learning_course_review_qnt($nd_learning_id) != 0 ) {

        $nd_learning_course_review_star .= nd_learning_course_review_star(nd_learning_course_review_average($nd_learning_id),20,'white','0px 5px');

    }else {

        $nd_learning_course_review_star .= '';
    }


  $nd_learning_output_image = '


    <img class="nd_learning_section" alt="" src="'.$nd_learning_image_attributes[0].'">

    <div class="nd_learning_bg_greydark_alpha_gradient_2 nd_learning_position_absolute nd_learning_left_0 nd_learning_height_100_percentage nd_learning_width_100_percentage nd_learning_box_sizing_border_box">
        
        <div class="nd_learning_position_absolute nd_learning_bottom_20 nd_learning_width_100_percentage nd_learning_box_sizing_border_box nd_learning_text_align_center">
            
            '.$nd_learning_course_review_star.'

        </div>

    </div>

    ';
}

//metabox
$nd_learning_meta_box_course_color = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_color', true );
if ( $nd_learning_meta_box_course_color == '' ) { $nd_learning_meta_box_course_color = '#000'; }

$nd_learning_meta_box_course_teacher = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_teacher', true );
if ( $nd_learning_meta_box_course_teacher == '' ) { $nd_learning_meta_box_course_teacher = 0; }

//teacher info image and title
$nd_learning_teacher_image_id = get_post_thumbnail_id( $nd_learning_meta_box_course_teacher );
$nd_learning_teacher_image_attributes = wp_get_attachment_image_src( $nd_learning_teacher_image_id, 'large' );
if ( $nd_learning_teacher_image_attributes[0] == '' ) { $nd_learning_output_image_teacher = ''; }else{
  $nd_learning_output_image_teacher = '<img alt="" class="nd_learning_margin_right_10 nd_learning_display_table_cell nd_learning_vertical_align_middle nd_learning_border_radius_100_percentage" width="25" src="'.$nd_learning_teacher_image_attributes[0].'">';
}
$nd_learning_teacher_all_name = get_the_title($nd_learning_meta_box_course_teacher);
$nd_learning_teacher_all_name_array = explode(" ", $nd_learning_teacher_all_name);
$nd_learning_teacher_name = $nd_learning_teacher_all_name_array[0];


//course information
$nd_learning_course_button = '';
if ( nd_learning_get_course_availability($nd_learning_id) == 0 ) {
    $nd_learning_course_button = '
        <a class="nd_learning_bg_red nd_learning_display_inline_block nd_learning_color_white_important nd_options_first_font nd_learning_padding_10_20 nd_learning_border_radius_3 nd_learning_font_size_16 nd_learning_line_height_16" href="'.$nd_learning_permalink.'">'.__('COMPLETED','nd-learning').'</a>
    '; 
}else{

    $nd_learning_course_price = '';
    if ( nd_learning_get_course_price($nd_learning_id) == 0 ) {
        $nd_learning_course_price = __('FREE','nd-learning');  
    }else{
        $nd_learning_course_price = nd_learning_get_course_currency().' '.nd_learning_get_course_price($nd_learning_id);  
    } 

    $nd_learning_course_button = '
        <a style="background-color: '.$nd_learning_meta_box_course_color.';" class="nd_learning_display_inline_block nd_learning_color_white_important nd_options_first_font nd_learning_padding_10_20 nd_learning_border_radius_3 nd_learning_line_height_16 nd_learning_font_size_16" href="'.$nd_learning_permalink.'">'.$nd_learning_course_price.'</a>
    ';  

}



$nd_learning_result .= '

  <div class=" '.$nd_learning_width.' nd_learning_padding_0_15  nd_learning_box_sizing_border_box nd_learning_masonry_item nd_learning_width_100_percentage_responsive">
            
        <!--start preview-->
        <div class="nd_learning_section nd_learning_padding_20_0 nd_learning_border_bottom_1_solid_grey">
            

            <div class="nd_learning_float_left nd_learning_width_40_percentage nd_learning_width_100_percentage_responsive">

                <!--image-->
                <div class="nd_learning_section nd_learning_position_relative">
                    '.$nd_learning_output_image.'
                </div>
                <!--image-->

            </div>


            <div class="nd_learning_float_left nd_learning_width_60_percentage nd_learning_width_100_percentage_responsive">

                <div class="nd_learning_section nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_bg_white">
                
                    <h1><a class="nd_options_color_greydark nd_options_first_font" href="'.$nd_learning_permalink.'">'.$nd_learning_title.'</a></h3>
                    <div class="nd_learning_section nd_learning_height_20"></div> 



                    <!--START some info course-->
                    <div class="nd_learning_section">

                        <div class="nd_learning_width_33_percentage nd_learning_width_50_percentage_all_iphone nd_learning_float_left">
                            <div class="nd_learning_display_table nd_learning_float_left">
                                
                                <div class="nd_learning_display_table_cell nd_learning_vertical_align_middle nd_learning_display_none_all_iphone">
                                    <img alt="" class="nd_learning_margin_right_10 nd_learning_float_left nd_learning_border_radius_100_percentage" width="40" src="'.$nd_learning_teacher_image_attributes[0].'">
                                </div>

                                <div class="nd_learning_display_table_cell nd_learning_vertical_align_middle">
                                    <p class="nd_learning_font_size_13">'.__('Teacher','nd-learning').'</p>
                                    <div class="nd_learning_section nd_learning_height_5"></div>
                                    <h5 class="">'.$nd_learning_teacher_name.'</h5>
                                </div>

                            </div> 
                        </div>



                        <div class="nd_learning_width_33_percentage nd_learning_width_50_percentage_all_iphone nd_learning_float_left">

                            <div class="nd_learning_section nd_learning_height_5 nd_learning_display_none_all_iphone"></div>
                            <div class="nd_learning_display_table nd_learning_float_left">
                                
                                <div class="nd_learning_display_table_cell nd_learning_vertical_align_middle nd_learning_display_none_all_iphone">
                                    <img alt="" class="nd_learning_margin_right_10 nd_learning_float_left" width="30" src="'.esc_url(plugins_url('icon-category.svg', __FILE__ )).'">
                                </div>

                                <div class="nd_learning_display_table_cell nd_learning_vertical_align_middle">
                                    <p class="nd_learning_font_size_13">'.__('Availability','nd-learning').'</p>
                                    <div class="nd_learning_section nd_learning_height_5"></div>
                                    <h5 class="">'.nd_learning_get_course_availability($nd_learning_id).' '.__('Seats','nd-learning').'</h5>
                                </div>

                            </div> 
                        </div>



                        <div class="nd_learning_width_33_percentage nd_learning_display_none_all_iphone nd_learning_float_left">

                            <div class="nd_learning_section nd_learning_height_5"></div>
                            <div class="nd_learning_display_table nd_learning_float_left">
                                
                                <div class="nd_learning_display_table_cell nd_learning_vertical_align_middle">
                                    <img alt="" class="nd_learning_margin_right_10 nd_learning_float_left" width="30" src="'.esc_url(plugins_url('icon-date-grey.svg', __FILE__ )).'">
                                </div>

                                <div class="nd_learning_display_table_cell nd_learning_vertical_align_middle">
                                    <p class="nd_learning_font_size_13">'.__('Date','nd-learning').'</p>
                                    <div class="nd_learning_section nd_learning_height_5"></div>
                                    <h5 class="">'.nd_learning_get_course_date().'</h5>
                                </div>

                            </div> 
                        </div>


                    </div>
                    <!--END some info course-->

                    <div class="nd_learning_section nd_learning_height_20"></div> 

                    <p><a class="" href="'.$nd_learning_permalink.'">'.$nd_learning_excerpt.'</a></p>
                    <div class="nd_learning_section nd_learning_height_20"></div>
                    '.$nd_learning_course_button.'

                </div>

            </div>


        </div>
        <!--start preview-->


    </div>


  ';