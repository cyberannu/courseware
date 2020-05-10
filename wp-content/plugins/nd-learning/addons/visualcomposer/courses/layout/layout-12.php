<?php

wp_enqueue_script('masonry');

$str .= '


    <script type="text/javascript">
    //<![CDATA[
    
    jQuery(document).ready(function() {

      //START masonry
      jQuery(function ($) {
        
        //Masonry
        var $nd_learning_masonry_content = $(".nd_learning_masonry_content").imagesLoaded( function() {
          // init Masonry after all images have loaded
          $nd_learning_masonry_content.masonry({
            itemSelector: ".nd_learning_masonry_item"
          });
        });


      });
      //END masonry

    });

    //]]>
  </script>


';


$str .= '<div class="nd_learning_section nd_learning_masonry_content '.$nd_learning_class.' ">';

while ( $the_query->have_posts() ) : $the_query->the_post();

//info
$nd_learning_id = get_the_ID(); 
$nd_learning_title = get_the_title();
$nd_learning_excerpt = get_the_excerpt();
$nd_learning_permalink = get_permalink( $nd_learning_id );

//metabox
$nd_learning_meta_box_course_color = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_color', true );
if ( $nd_learning_meta_box_course_color == '' ) { $nd_learning_meta_box_course_color = '#000'; }

$nd_learning_meta_box_course_teacher = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_teacher', true );
if ( $nd_learning_meta_box_course_teacher == '' ) { $nd_learning_meta_box_course_teacher = 0; }

//teacher info image and title
$nd_learning_teacher_image_id = get_post_thumbnail_id( $nd_learning_meta_box_course_teacher );
$nd_learning_teacher_image_attributes = wp_get_attachment_image_src( $nd_learning_teacher_image_id, 'large' );
if ( $nd_learning_teacher_image_attributes[0] == '' ) { $nd_learning_output_image_teacher = ''; }else{
  $nd_learning_output_image_teacher = '<a href="'.get_permalink($nd_learning_meta_box_course_teacher).'"><img alt="" class="nd_learning_display_none_all_iphone nd_learning_border_2_solid_white nd_learning_border_radius_8 nd_learning_position_absolute nd_learning_right_20 nd_learning_bottom_35_negative" width="70" src="'.$nd_learning_teacher_image_attributes[0].'"></a>';
}
$nd_learning_teacher_all_name = get_the_title($nd_learning_meta_box_course_teacher);
$nd_learning_teacher_all_name_array = explode(" ", $nd_learning_teacher_all_name);
$nd_learning_teacher_name = $nd_learning_teacher_all_name_array[0];


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
        <a class="nd_learning_bg_greydark nd_learning_display_inline_block nd_learning_color_white_important nd_options_first_font nd_learning_padding_8 nd_learning_border_radius_3 nd_learning_font_size_13" href="'.$nd_learning_permalink.'">'.$nd_learning_course_price.'</a>
    ';  

}

//image
$nd_learning_image_id = get_post_thumbnail_id( $nd_learning_id );
$nd_learning_image_attributes = wp_get_attachment_image_src( $nd_learning_image_id, $nd_learning_image_size );
if ( $nd_learning_image_attributes[0] == '' ) { $nd_learning_output_image = ''; }else{
  $nd_learning_output_image = '


    <img class="nd_learning_section nd_learning_border_radius_4_4_0_0" alt="" src="'.$nd_learning_image_attributes[0].'">

    <div class=" nd_learning_position_absolute nd_learning_left_0 nd_learning_height_100_percentage nd_learning_width_100_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box">
        

        <div class="nd_learning_position_absolute nd_learning_right_20 nd_learning_top_20">
            '.$nd_learning_course_button.'
        </div>    

        '.$nd_learning_output_image_teacher.'

    </div>

    ';
}




$str .= '

    <div class=" '.$nd_learning_width.' nd_learning_padding_15 nd_learning_box_sizing_border_box nd_learning_masonry_item nd_learning_width_100_percentage_responsive">

        <div class="nd_learning_section">
            
            <!--start preview-->
            <div class="nd_learning_section nd_learning_border_1_solid_grey nd_learning_border_radius_4">
                
                <!--image-->
                <div class="nd_learning_section nd_learning_position_relative">
                    '.$nd_learning_output_image.'
                </div>
                <!--image-->

                <div class="nd_learning_section nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_bg_white">
                
                    <h2 class="nd_learning_font_weight_normal"><a class="nd_options_color_greydark nd_options_first_font" href="'.$nd_learning_permalink.'">'.$nd_learning_title.'</a></h2>
                    <div class="nd_learning_section nd_learning_height_20"></div> 
                    <p><a class="" href="'.$nd_learning_permalink.'">'.$nd_learning_excerpt.'</a></p>

                </div>

                <div class="nd_learning_section nd_learning_padding_20 nd_learning_box_sizing_border_box  nd_learning_border_top_1_solid_grey">

                    <div class="nd_learning_width_33_percentage nd_learning_width_50_percentage_all_iphone nd_learning_float_left nd_learning_text_align_left">
                        <a style="background-color:'.$nd_learning_meta_box_course_color.';" class="nd_learning_display_inline_block nd_learning_bg_greydark nd_learning_color_white_important nd_options_first_font nd_learning_padding_8_15 nd_learning_border_radius_4 nd_learning_font_size_13" href="'.$nd_learning_permalink.'">'.__('DETAILS','nd-learning').'</a>
                    </div>

                    <div class="nd_learning_width_33_percentage nd_learning_display_none_all_iphone nd_learning_width_50_percentage_all_iphone nd_learning_float_left">
                        <div class="nd_learning_display_table nd_learning_float_left">
                            <img alt="" class="nd_learning_margin_right_10 nd_learning_display_table_cell nd_learning_vertical_align_middle " width="23" src="'.esc_url(plugins_url('icon-difficulty-grey.svg', __FILE__ )).'">
                            <p class="nd_learning_display_table_cell nd_learning_vertical_align_middle nd_learning_font_size_15"><a href="'.$nd_learning_permalink.'">'.nd_learning_get_course_difficulty().'</a></p>
                        </div>
                    </div> 

                    <div class="nd_learning_width_33_percentage nd_learning_width_50_percentage_all_iphone nd_learning_float_left">
                        <div class="nd_learning_display_table nd_learning_float_left">
                            <img alt="" class="nd_learning_margin_right_10 nd_learning_display_table_cell nd_learning_vertical_align_middle" width="23" src="'.esc_url(plugins_url('icon-category-grey.svg', __FILE__ )).'">
                            <p class="nd_learning_display_table_cell nd_learning_vertical_align_middle nd_learning_font_size_15"><a href="'.$nd_learning_permalink.'">'.nd_learning_get_course_category().' '.__('Seats','nd-learning').'</a></p>
                        </div>
                    </div> 
   
                </div>

            </div>
            <!--start preview-->

        </div> 

    </div>


  ';

endwhile;

$str .= '</div>';