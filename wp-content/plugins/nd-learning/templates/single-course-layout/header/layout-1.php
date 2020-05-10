<div class="nd_learning_section nd_learning_background_size_cover <?php echo $nd_learning_meta_box_course_header_img_position; ?>" style="background-image:url(<?php echo $nd_learning_meta_box_course_header_img; ?>);">

    <div class="nd_learning_section nd_learning_bg_greydark_alpha_gradient_2">

        <!--start nd_learning_container-->
        <div class="nd_learning_container nd_learning_clearfix">

            <div class="nd_learning_section nd_learning_height_200"></div>

            <div class="nd_learning_width_50_percentage nd_learning_padding_15 nd_learning_box_sizing_border_box nd_learning_width_100_percentage_all_iphone nd_learning_float_left">

                <strong class="nd_learning_color_white_important nd_learning_font_size_40 nd_options_first_font"><?php echo $nd_learning_meta_box_course_header_img_title; ?></strong>

                <div class="nd_learning_section nd_learning_height_20"></div>

                <div id="nd_learning_single_course_header_img_date_duration" class="nd_learning_display_table nd_learning_float_left nd_learning_display_none_all_iphone">
                    <img alt="" class="nd_learning_margin_right_10 nd_learning_display_table_cell nd_learning_vertical_align_middle" width="30" height="30" src="<?php echo esc_url(plugins_url('icon-calendar-white.svg', __FILE__ )); ?>">
                    <h3 class=" nd_learning_color_white_important nd_learning_display_table_cell nd_learning_vertical_align_middle"><?php echo nd_learning_get_course_date(); ?></h3>
                    <img alt="" class="nd_learning_margin_right_10 nd_learning_margin_left_20 nd_learning_display_table_cell nd_learning_vertical_align_middle" width="30" height="30" src="<?php echo esc_url(plugins_url('icon-clock-white.svg', __FILE__ )); ?>">
                    <h3 class="nd_learning_color_white_important nd_learning_display_table_cell nd_learning_vertical_align_middle "><?php echo nd_learning_get_course_duration(); ?></h3>
                </div>
                
            </div>


            <div class="nd_learning_width_50_percentage nd_learning_padding_15 nd_learning_box_sizing_border_box nd_learning_width_100_percentage_all_iphone nd_learning_display_none_all_iphone nd_learning_float_left nd_learning_text_align_right">

                <div class="nd_learning_section nd_learning_height_40"></div>

            
                <div id="nd_learning_single_course_header_img_price" class="nd_learning_display_table nd_learning_float_right">

                    <div class="nd_learning_display_table_cell nd_learning_vertical_align_bottom">
                        <h5 class="nd_learning_font_size_20 nd_learning_color_white_important"><?php _e('per person','nd-learning'); ?> / </h5>
                    </div>
                            
                    <div class="nd_learning_display_table_cell nd_learning_vertical_align_top">
                        <h5 class="nd_learning_font_size_20 nd_learning_color_white_important nd_learning_margin_5"><?php echo nd_learning_get_course_currency(); ?></h5>
                    </div>

                    <div class="nd_learning_display_table_cell nd_learning_vertical_align_bottom">
                        <h1 class=" nd_learning_color_white_important nd_learning_font_size_60 nd_learning_line_height_50">
                            <?php 
                                
                                if( nd_learning_get_course_price(get_the_ID()) == 0 ){

                                     _e('Free','nd-learning');

                                  }else{

                                    echo nd_learning_get_course_price(get_the_ID());

                                  }

                            ?>
                        </h1>
                    </div>

                </div> 


            </div>

            <div class="nd_learning_section nd_learning_height_5"></div>

        </div>
        <!--end container-->

    </div>

</div>