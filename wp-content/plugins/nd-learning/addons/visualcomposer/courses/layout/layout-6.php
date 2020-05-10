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
$nd_learning_permalink = get_permalink( $nd_learning_id );

//metabox
$nd_learning_meta_box_course_color = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_color', true );
if ( $nd_learning_meta_box_course_color == '' ) { $nd_learning_meta_box_course_color = '#000'; }


//course information
$nd_learning_course_button = '';
if ( nd_learning_get_course_availability($nd_learning_id) == 0 ) {
    $nd_learning_course_button = '
        <a class="nd_learning_position_absolute nd_learning_top_20 nd_learning_right_20 nd_learning_bg_red nd_learning_display_inline_block nd_learning_color_white_important nd_options_first_font nd_learning_padding_8 nd_learning_border_radius_3 nd_learning_font_size_13" href="'.$nd_learning_permalink.'">'.__('COMPLETED','nd-learning').'</a>
    '; 
}else{

    $nd_learning_course_price = '';
    if ( nd_learning_get_course_price($nd_learning_id) == 0 ) {
        $nd_learning_course_price = __('FREE','nd-learning');  
    }else{
        $nd_learning_course_price = nd_learning_get_course_currency().' '.nd_learning_get_course_price($nd_learning_id);  
    } 

    $nd_learning_course_button = '
        <a style="background-color: '.$nd_learning_meta_box_course_color.';" class="nd_learning_position_absolute nd_learning_top_20 nd_learning_right_20 nd_learning_display_inline_block nd_learning_color_white_important nd_options_first_font nd_learning_padding_8 nd_learning_border_radius_3 nd_learning_font_size_13" href="'.$nd_learning_permalink.'">'.$nd_learning_course_price.'</a>
    ';  

}

//image
$nd_learning_image_id = get_post_thumbnail_id( $nd_learning_id );
$nd_learning_image_attributes = wp_get_attachment_image_src( $nd_learning_image_id, $nd_learning_image_size );


//review
$nd_learning_review_result = '';
if ( nd_learning_course_review_qnt($nd_learning_id) == 0 ) {

    $nd_learning_review_result .= '';

}else{

    $nd_learning_review_result .= nd_learning_course_review_star(nd_learning_course_review_average($nd_learning_id),15,'white','2px');

}

$str .= '


    <div class=" '.$nd_learning_width.' nd_learning_padding_15 nd_learning_box_sizing_border_box nd_learning_masonry_item nd_learning_width_100_percentage_responsive">

        <div class="nd_learning_section nd_learning_position_relative">
                            
            <img alt="" class="nd_learning_section" src="'.$nd_learning_image_attributes[0].'">

            <div class="nd_learning_bg_greydark_alpha_5 nd_learning_position_absolute nd_learning_left_0 nd_learning_height_100_percentage nd_learning_width_100_percentage nd_learning_padding_30 nd_learning_box_sizing_border_box">

                '.$nd_learning_course_button.'

                <div class="nd_learning_display_table nd_learning_width_100_percentage nd_learning_height_100_percentage nd_learning_text_align_center">

                    <div class="nd_learning_display_table_cell nd_learning_vertical_align_middle">
        
                        <h2 class="nd_learning_color_white_important"><a class="nd_learning_color_white_important nd_options_first_font" href="'.$nd_learning_permalink.'"><strong>'.$nd_learning_title.'</strong></a></h2>
                        <div class="nd_learning_section nd_learning_height_10"></div>
                        <div class="nd_learning_section ">
                            
                            '.$nd_learning_review_result.'

                        </div>

                    </div>

                </div>


            </div>

        </div>

    </div>


  ';

endwhile;

$str .= '</div>';