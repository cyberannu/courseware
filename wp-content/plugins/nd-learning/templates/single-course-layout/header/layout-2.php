<style>
#nd_options_breadcrumbs { display: none; }
</style>


<div class="nd_learning_section nd_learning_background_size_cover <?php echo $nd_learning_meta_box_course_header_img_position; ?>" style="background-image:url(<?php echo $nd_learning_meta_box_course_header_img; ?>);">

    <div class="nd_learning_section nd_learning_bg_greydark_alpha_gradient_3">
        
        <!--start nd_learning_container-->
        <div class="nd_learning_container nd_learning_clearfix">

            <div class="nd_learning_section nd_learning_height_100"></div>

            <div id="nd_learning_archive_courses_header_l2" class="nd_learning_section nd_learning_padding_15 nd_learning_box_sizing_border_box">
                
                <h1 class="nd_learning_color_white_important nd_learning_font_size_30 nd_options_second_font nd_learning_font_weight_normal"><?php echo $nd_learning_meta_box_course_header_img_title; ?></h1>
                <div class="nd_learning_section nd_learning_height_10"></div>
                <h3 class="nd_learning_color_white_important nd_options_second_font nd_learning_font_weight_normal">

                    <?php _e('COURSE PRICE FOR ','nd-learning'); ?>
                    <?php if( nd_learning_get_course_price(get_the_ID()) == 0 ){ _e('FREE','nd-learning'); }else{ echo nd_learning_get_course_price(get_the_ID()).' '.nd_learning_get_course_currency(); } ?>

                </h3>

                <div class="nd_learning_section nd_learning_height_20"></div>

                <div class="nd_learning_section nd_learning_line_height_0 ">
                    <span class="nd_learning_display_inline_block nd_learning_bg_white nd_learning_width_80 nd_learning_height_5 nd_learning_border_radius_5"></span>
                </div>

            </div>

            <div class="nd_learning_section nd_learning_height_100"></div>

        </div>
        <!--end container-->

    </div>

</div>