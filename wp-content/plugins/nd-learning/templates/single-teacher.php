<?php

//ADD default tab list
add_action('nd_learning_single_teacher_tab_list','nd_learning_single_teacher_add_default_tab_list');
function nd_learning_single_teacher_add_default_tab_list(){

    $nd_learning_default_tabs = '';


    $nd_learning_default_tabs .= '
    <li class="nd_learning_display_inline_block">
        <h4>
            <a class="nd_learning_outline_0 nd_learning_padding_20 nd_learning_display_inline_block nd_options_first_font nd_options_color_greydark" href="#nd_learning_single_teacher_courses">
                '.__('My Courses','nd-learning').'
            </a>
            <a class="nd_learning_display_inline_block nd_learning_bg_grey nd_learning_margin_right_20 nd_learning_border_1_solid_grey nd_options_first_font nd_learning_padding_8 nd_learning_border_radius_3 nd_learning_font_size_13" href="#">'.nd_learning_get_teacher_number_courses(get_the_ID()).'</a>
        </h4>
    </li>

    ';

    echo $nd_learning_default_tabs;
}


//ADD default tab content
add_action('nd_learning_single_teacher_tab_list_content','nd_learning_single_teacher_add_default_tab_list_content');
function nd_learning_single_teacher_add_default_tab_list_content(){


    $nd_learning_teacher_id = get_the_ID();
    $nd_learning_teacher_info = get_post($nd_learning_teacher_id);
    $nd_learning_teacher_slug = $nd_learning_teacher_info->post_name;


    $nd_learning_args = array(
        'post_type' => 'courses',
        
        'meta_query' => array( 
            
            'relation' => 'OR',

            array( 
                'key' => 'nd_learning_meta_box_teacher', 
                'value' => array($nd_learning_teacher_id)
            ),
            array( 
                'key' => 'nd_learning_meta_box_teachers', 
                'value' => $nd_learning_teacher_slug,
                'compare' => 'LIKE'
            )
        )

    );
    $nd_learning_the_query = new WP_Query( $nd_learning_args );


    //test
    $nd_learning_default_tabs_content = '';


    $nd_learning_default_tabs_content .= '

        <div class="nd_learning_section" id="nd_learning_single_teacher_courses">
            <div class="nd_learning_section nd_learning_height_20"></div>
               
            ';


                    if ( $nd_learning_the_query->have_posts() ) :

                       $nd_learning_default_tabs_content .= '<div class="nd_learning_section nd_learning_box_sizing_border_box nd_learning_overflow_hidden nd_learning_overflow_x_auto nd_learning_cursor_move_responsive">
                        <table class="nd_learning_section">
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
                            <tbody>';


                        while ( $nd_learning_the_query->have_posts() ) : $nd_learning_the_query->the_post();


                            $nd_learning_default_tabs_content .= ' <tr class="nd_learning_border_bottom_1_solid_grey">
                                <td class="nd_learning_padding_20">  
                                    <img alt="" class="nd_learning_section" src="'.nd_learning_get_course_image_url(get_the_ID()).'"> 
                                </td>
                                <td class="nd_learning_padding_20">  
                                    <h4><strong>'.get_the_title().'</strong></h4> 
                                </td>
                                <td class="nd_learning_padding_20 nd_learning_display_none_all_iphone">
                                    <p class="nd_learning_color_greydark">'.nd_learning_get_course_currency().' '.nd_learning_get_course_price(get_the_ID()).'</p>    
                                </td>
                                <td class="nd_learning_padding_20">   
                                    <a class="nd_learning_display_inline_block nd_learning_color_white_important nd_learning_bg_green nd_options_first_font nd_learning_padding_8 nd_learning_border_radius_3 nd_learning_font_size_13" href="'.get_the_permalink().'">'.__('VIEW','nd-learning').'</a>
                                </td>
                            </tr>';


                        endwhile; 


                        $nd_learning_default_tabs_content .= '</tbody>
                            </table>
                        </div>';

                    else :
                        
                        $nd_learning_default_tabs_content .= __('Any courses assigned','nd-learning');
                    
                    endif;


                    wp_reset_postdata();
                        

                $nd_learning_default_tabs_content .= '</div>';



    echo $nd_learning_default_tabs_content;
}

?>



<?php get_header( ); ?>



<?php 
  
$nd_learning_id = get_the_ID();
$nd_learning_meta_box_teacher_header_img = get_post_meta( get_the_ID(), 'nd_learning_meta_box_teacher_header_img', true );
$nd_learning_meta_box_teacher_header_img_position = get_post_meta( get_the_ID(), 'nd_learning_meta_box_teacher_header_img_position', true );

if ( $nd_learning_meta_box_teacher_header_img != '' ) { ?> 




    <?php


        //social
        $nd_learning_social_teacher_output = '<div class="nd_learning_display_inline_block nd_learning_margin_left_20">';

        //facebook
        $nd_learning_meta_box_teacher_social_facebook = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_teacher_social_facebook', true );
        if ( $nd_learning_meta_box_teacher_social_facebook == '' ) { 
            $nd_learning_meta_box_teacher_social_facebook = ''; 
        }else{
            $nd_learning_social_teacher_output .= '<a target="_blank" href="'.$nd_learning_meta_box_teacher_social_facebook.'"><img alt="" width="20" height="20" class="nd_learning_margin_right_10 nd_learning_float_left" src="'.esc_url(plugins_url('facebook.svg', __FILE__ )).'"></a>';
        }
        //twitter
        $nd_learning_meta_box_teacher_social_twitter = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_teacher_social_twitter', true );
        if ( $nd_learning_meta_box_teacher_social_twitter == '' ) { 
            $nd_learning_meta_box_teacher_social_twitter = ''; 
        }else{
            $nd_learning_social_teacher_output .= '<a target="_blank" href="'.$nd_learning_meta_box_teacher_social_twitter.'"><img alt="" width="20" height="20" class="nd_learning_margin_right_10 nd_learning_float_left" src="'.esc_url(plugins_url('twitter.svg', __FILE__ )).'"></a>';
        }

        //instagram
        $nd_learning_meta_box_teacher_social_instagram = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_teacher_social_instagram', true );
        if ( $nd_learning_meta_box_teacher_social_instagram == '' ) { 
            $nd_learning_meta_box_teacher_social_instagram = ''; 
        }else{
            $nd_learning_social_teacher_output .= '<a target="_blank" href="'.$nd_learning_meta_box_teacher_social_instagram.'"><img alt="" width="20" height="20" class="nd_learning_margin_right_10 nd_learning_float_left" src="'.esc_url(plugins_url('instagram.svg', __FILE__ )).'"></a>';
        }

        //pinterest
        $nd_learning_meta_box_teacher_social_pinterest = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_teacher_social_pinterest', true );
        if ( $nd_learning_meta_box_teacher_social_pinterest == '' ) { 
            $nd_learning_meta_box_teacher_social_pinterest = ''; 
        }else{
            $nd_learning_social_teacher_output .= '<a target="_blank" href="'.$nd_learning_meta_box_teacher_social_pinterest.'"><img alt="" width="20" height="20" class="nd_learning_margin_right_10 nd_learning_float_left" src="'.esc_url(plugins_url('pinterest.svg', __FILE__ )).'"></a>';
        }

        //googleplus
        $nd_learning_meta_box_teacher_social_googleplus = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_teacher_social_googleplus', true );
        if ( $nd_learning_meta_box_teacher_social_googleplus == '' ) { 
            $nd_learning_meta_box_teacher_social_googleplus = ''; 
        }else{
            $nd_learning_social_teacher_output .= '<a target="_blank" href="'.$nd_learning_meta_box_teacher_social_googleplus.'"><img alt="" width="20" height="20" class="nd_learning_margin_right_10 nd_learning_float_left" src="'.esc_url(plugins_url('googleplus.svg', __FILE__ )).'"></a>';
        }

        //youtube
        $nd_learning_meta_box_teacher_social_youtube = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_teacher_social_youtube', true );
        if ( $nd_learning_meta_box_teacher_social_youtube == '' ) { 
            $nd_learning_meta_box_teacher_social_youtube = ''; 
        }else{
            $nd_learning_social_teacher_output .= '<a target="_blank" href="'.$nd_learning_meta_box_teacher_social_youtube.'"><img alt="" width="20" height="20" class="nd_learning_margin_right_10 nd_learning_float_left" src="'.esc_url(plugins_url('youtube.svg', __FILE__ )).'"></a>';
        }

        //linkedin
        $nd_learning_meta_box_teacher_social_linkedin = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_teacher_social_linkedin', true );
        if ( $nd_learning_meta_box_teacher_social_linkedin == '' ) { 
            $nd_learning_meta_box_teacher_social_linkedin = ''; 
        }else{
            $nd_learning_social_teacher_output .= '<a target="_blank" href="'.$nd_learning_meta_box_teacher_social_linkedin.'"><img alt="" width="20" height="20" class="nd_learning_margin_right_10 nd_learning_float_left" src="'.esc_url(plugins_url('linkedin.svg', __FILE__ )).'"></a>';
        }

        //vimeo
        $nd_learning_meta_box_teacher_social_vimeo = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_teacher_social_vimeo', true );
        if ( $nd_learning_meta_box_teacher_social_vimeo == '' ) { 
            $nd_learning_meta_box_teacher_social_vimeo = ''; 
        }else{
            $nd_learning_social_teacher_output .= '<a target="_blank" href="'.$nd_learning_meta_box_teacher_social_vimeo.'"><img alt="" width="20" height="20" class="nd_learning_margin_right_10 nd_learning_float_left" src="'.esc_url(plugins_url('vimeo.svg', __FILE__ )).'"></a>';
        }

        //behance
        $nd_learning_meta_box_teacher_social_behance = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_teacher_social_behance', true );
        if ( $nd_learning_meta_box_teacher_social_behance == '' ) { 
            $nd_learning_meta_box_teacher_social_behance = ''; 
        }else{
            $nd_learning_social_teacher_output .= '<a target="_blank" href="'.$nd_learning_meta_box_teacher_social_behance.'"><img alt="" width="20" height="20" class="nd_learning_margin_right_10 nd_learning_float_left" src="'.esc_url(plugins_url('behance.svg', __FILE__ )).'"></a>';
        }

        //dribbble
        $nd_learning_meta_box_teacher_social_dribbble = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_teacher_social_dribbble', true );
        if ( $nd_learning_meta_box_teacher_social_dribbble == '' ) { 
            $nd_learning_meta_box_teacher_social_dribbble = ''; 
        }else{
            $nd_learning_social_teacher_output .= '<a target="_blank" href="'.$nd_learning_meta_box_teacher_social_dribbble.'"><img alt="" width="20" height="20" class="nd_learning_margin_right_10 nd_learning_float_left" src="'.esc_url(plugins_url('dribbble.svg', __FILE__ )).'"></a>';
        }

        //github
        $nd_learning_meta_box_teacher_social_github = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_teacher_social_github', true );
        if ( $nd_learning_meta_box_teacher_social_github == '' ) { 
            $nd_learning_meta_box_teacher_social_github = ''; 
        }else{
            $nd_learning_social_teacher_output .= '<a target="_blank" href="'.$nd_learning_meta_box_teacher_social_github.'"><img alt="" width="20" height="20" class="nd_learning_margin_right_10 nd_learning_float_left" src="'.esc_url(plugins_url('github.svg', __FILE__ )).'"></a>';
        }
          
        $nd_learning_social_teacher_output .= '</div>';


    ?>


    

	<div class="nd_learning_section nd_learning_background_size_cover <?php echo $nd_learning_meta_box_teacher_header_img_position; ?>" style="background-image:url(<?php echo $nd_learning_meta_box_teacher_header_img; ?>);">

        <div class="nd_learning_section nd_learning_bg_greydark_alpha_gradient_2">

            
            <!--start nd_learning_container-->
            <div class="nd_learning_container nd_learning_clearfix">


                <div class="nd_learning_section nd_learning_height_200"></div>


                <div class="nd_learning_float_left nd_learning_width_60_percentage nd_learning_width_100_percentage_responsive nd_learning_text_align_center_responsive nd_learning_padding_15 nd_learning_box_sizing_border_box">


                    <div class="nd_learning_section nd_learning_display_none nd_learning_display_block_responsive">  
                        <img alt="" class=" nd_learning_border_radius_100_percentage " width="150" src="<?php echo nd_learning_get_teacher_image_url(); ?>">
                    </div> 

                    <div class="nd_learning_display_table nd_learning_float_left nd_learning_width_100_percentage_responsive nd_learning_text_align_center_responsive">
                            

                        <div class="nd_learning_display_table_cell nd_learning_vertical_align_middle nd_learning_display_none_responsive">
                            <img alt="" class="nd_learning_margin_right_20 nd_learning_border_radius_100_percentage " width="150" src="<?php echo nd_learning_get_teacher_image_url(); ?>">
                        </div>

                        <div class="nd_learning_display_table_cell nd_learning_vertical_align_middle nd_learning_width_100_percentage_responsive nd_learning_text_align_center_all_iphone">
                            <strong class="nd_learning_color_white_important nd_learning_font_size_40 nd_options_first_font nd_learning_float_left_responsive nd_learning_width_100_percentage_responsive nd_learning_margin_bottom_20_responsive "><?php echo get_the_title(); ?></strong>
                            
                            <?php echo $nd_learning_social_teacher_output; ?>

                            <div class="nd_learning_section nd_learning_height_5"></div>
                            <h3 class="nd_learning_color_white_important"><?php echo nd_learning_get_teacher_role(); ?></h3>
                            <div class="nd_learning_section nd_learning_height_30"></div>
                            <a class="nd_learning_display_inline_block nd_learning_color_white_important nd_learning_line_height_16 nd_learning_border_1_solid_white nd_options_first_font nd_learning_padding_10_20 nd_learning_border_radius_3" href="#nd_learning_single_teacher_contact_form"><?php _e('MESSAGE ME','nd-learning'); ?></a>
                        
                            <?php do_action('nd_learning_single_teacher_header_btns'); ?>

                        </div>

                    </div>                    

                </div>




                <div class="nd_learning_float_left nd_learning_width_40_percentage nd_learning_text_align_center_responsive nd_learning_width_100_percentage_responsive nd_learning_padding_15 nd_learning_box_sizing_border_box nd_learning_text_align_right ">

                    <div class="nd_learning_section nd_learning_height_80 nd_learning_display_none_responsive"></div>

                    <div class="nd_learning_display_inline_block nd_learning_text_align_center  nd_learning_margin_left_40 nd_learning_margin_0_10_responsive">
                        <h1 class="nd_learning_color_white_important nd_learning_font_size_40 nd_learning_font_size_30_responsive nd_learning_font_size_20_all_iphone nd_learning_line_height_20_all_iphone"><strong><?php echo nd_learning_get_teacher_number_courses(get_the_ID()); ?></strong></h1>
                        <div class="nd_learning_section nd_learning_height_5"></div>
                        <p class="nd_learning_font_size_13_responsive nd_learning_color_white_important nd_learning_font_size_10_all_iphone"><?php _e('COURSES','nd-learning'); ?></p>
                    </div>

                    <?php do_action('nd_learning_single_teacher_header_info_bar'); ?>
                     
                </div>




            </div>
            <!--end container-->

        </div>

    </div>



    <?php do_action('nd_learning_end_header_img_single_teacher_hook'); ?>



<?php } ?>







<?php

//add container
$nd_learning_container = get_option('nd_learning_container');
if ($nd_learning_container != 1) { echo '<div class="nd_learning_container nd_learning_clearfix">'; }

?>


<?php

if(have_posts()) :
	while(have_posts()) : the_post(); 


        //include tabs js
        wp_enqueue_script('jquery-ui-tabs');
		
		//get variables
		$nd_learning_content_teacher = do_shortcode(get_the_content());

		//taxonomies
		$nd_learning_term_category_teacher_result = '';
	    $nd_learning_terms_category_teacher = wp_get_post_terms( get_the_ID(), 'category-teacher', array("fields" => "all"));
	    foreach($nd_learning_terms_category_teacher as $nd_learning_term_category_teacher) { $nd_learning_term_category_teacher_result .= $nd_learning_term_category_teacher->name.' '; }
		
        //metabox
        $nd_learning_meta_box_teacher_form = get_post_meta( get_the_ID(), 'nd_learning_meta_box_teacher_form', true );


		$nd_learning_str = '


			<div class="nd_learning_section nd_learning_height_50"></div>

			<div class="nd_learning_section">

				<div class="nd_learning_width_66_percentage nd_learning_width_100_percentage_responsive nd_learning_float_left nd_learning_padding_15 nd_learning_box_sizing_border_box">
					
                    ';


                    if ( $nd_learning_meta_box_teacher_header_img == '' ) {

                        $nd_learning_str .= '<h1><strong>'.get_the_title().'</strong></h1>';

                    } 

                    $nd_learning_str .= ' '.$nd_learning_content_teacher.' 


                    <div class="nd_learning_section nd_learning_height_40"></div>

                    <!--START Tabs-->
                    <div class="nd_learning_tabs nd_learning_section">

                        <ul class="nd_learning_list_style_none nd_learning_margin_0 nd_learning_padding_0 nd_learning_section nd_learning_border_bottom_2_solid_grey">';


                            echo $nd_learning_str;

                            //custom hook
                            do_action("nd_learning_single_teacher_tab_list");
                            do_action("nd_learning_single_teacher_tab_list_2"); 

                        $nd_learning_str = '</ul>';


                        echo $nd_learning_str;
                        
                        //custom hook
                        do_action("nd_learning_single_teacher_tab_list_content"); 
                        
                        
                    $nd_learning_str = '</div>
                    <!--END tabs-->';


                    $nd_learning_str .= '<script type="text/javascript">
                    <!--//--><![CDATA[//><!--
                        jQuery(document).ready(function($) {
                            $(".nd_learning_tabs").tabs();
                        });
                    //--><!]]>
                    </script>';


				$nd_learning_str .= '</div>

                <style>#nd_learning_single_teacher_table_info tr:last-child { border-bottom-width:0px; }</style>

				<div class="nd_learning_width_33_percentage nd_learning_width_100_percentage_responsive nd_learning_float_left nd_learning_padding_15 nd_learning_box_sizing_border_box">
					
					<table id="nd_learning_single_teacher_table_info" class="nd_learning_section">
                        <tbody>';
                            

                        if (nd_learning_get_teacher_email() != '') {

                            $nd_learning_str .= '<tr class="nd_learning_border_bottom_2_solid_grey">
                                <td class="nd_learning_padding_20"><img alt="" class="nd_learning_float_left" width="40" height="40" src="'.esc_url(plugins_url('icon-email-grey.svg', __FILE__ )).'"></td>
                                <td class="nd_learning_padding_20"><h4 class=" nd_learning_text_align_right">'.__('Mail ','nd-learning').' : '.nd_learning_get_teacher_email().'</h4></td>
                            </tr>';

                        }

                        if (nd_learning_get_teacher_telephone() != '') {

                            $nd_learning_str .= '<tr class="nd_learning_border_bottom_2_solid_grey">
                                <td class="nd_learning_padding_20"><img alt="" class="nd_learning_float_left" width="40" height="40" src="'.esc_url(plugins_url('icon-mobile-grey.svg', __FILE__ )).'"></td>
                                <td class="nd_learning_padding_20"><h4 class=" nd_learning_text_align_right">'.__('Phone ','nd-learning').' : '.nd_learning_get_teacher_telephone().'</h4></td>
                            </tr>';

                        }

                        if (nd_learning_get_teacher_skype() != '') {

                            $nd_learning_str .= '<tr class="nd_learning_border_bottom_2_solid_grey">
                                <td class="nd_learning_padding_20"><img alt="" class="nd_learning_float_left" width="40" height="40" src="'.esc_url(plugins_url('icon-skype-grey.svg', __FILE__ )).'"></td>
                                <td class="nd_learning_padding_20"><h4 class=" nd_learning_text_align_right">'.__('Skype ','nd-learning').' : '.nd_learning_get_teacher_skype().'</h4></td>
                            </tr>';

                        }

                        if (nd_learning_get_teacher_website() != '') {

                            $nd_learning_str .= '<tr class="nd_learning_border_bottom_2_solid_grey">
                                <td class="nd_learning_padding_20"><img alt="" class="nd_learning_float_left" width="40" height="40" src="'.esc_url(plugins_url('/icon-link-grey.svg', __FILE__ )).'"></td>
                                <td class="nd_learning_padding_20"><h4 class=" nd_learning_text_align_right">'.__('Web ','nd-learning').' : '.nd_learning_get_teacher_website().'</h4></td>
                            </tr>';

                        }

                        if (nd_learning_get_teacher_location() != '') {

                            $nd_learning_str .= '<tr class="nd_learning_border_bottom_2_solid_grey">
                                <td class="nd_learning_padding_20"><img alt="" class="nd_learning_float_left" width="40" height="40" src="'.esc_url(plugins_url('icon-pin-grey.svg', __FILE__ )).'"></td>
                                <td class="nd_learning_padding_20"><h4 class=" nd_learning_text_align_right">'.__('Location ','nd-learning').' : '.nd_learning_get_teacher_location().'</h4></td>
                            </tr>';

                        }

                        #if ($nd_learning_term_category_teacher_result != '') {
                            #$nd_learning_str .= '<tr class="nd_learning_border_bottom_2_solid_grey"><td class="nd_learning_padding_20"><img alt="" class="nd_learning_float_left" width="40" src="'.esc_url(plugins_url('icon-category-grey.svg', __FILE__ )).'"></td><td class="nd_learning_padding_20"><h4 class=" nd_learning_text_align_right">'.__('Category ','nd-learning').' : '.$nd_learning_term_category_teacher_result.'</h4></td></tr>';
                        #}
                            

                        $nd_learning_str .= '</tbody>
                    </table>';





                    //START contact form
                    if ( $nd_learning_meta_box_teacher_form != '' ) {

                        $nd_learning_str .= '



                            <style>

                            #nd_learning_single_teacher_contact_form input[type="text"],
                            #nd_learning_single_teacher_contact_form input[type="email"],
                            #nd_learning_single_teacher_contact_form input[type="url"],
                            #nd_learning_single_teacher_contact_form input[type="tel"],
                            #nd_learning_single_teacher_contact_form input[type="number"],
                            #nd_learning_single_teacher_contact_form input[type="date"],
                            #nd_learning_single_teacher_contact_form input[type="checkbox"],
                            #nd_learning_single_teacher_contact_form input[type="file"],
                            #nd_learning_single_teacher_contact_form textarea,
                            #nd_learning_single_teacher_contact_form label,
                            #nd_learning_single_teacher_contact_form select
                            {

                              width: 100%;

                            }


                            #nd_learning_single_teacher_contact_form .wpcf7-response-output.wpcf7-validation-errors,
                            #nd_learning_single_teacher_contact_form .wpcf7-response-output.wpcf7-mail-sent-ok
                            {

                                float:left;
                                width:100%;
                                box-sizing:border-box;

                            }

                            </style>



                            <div class="nd_learning_section nd_learning_height_20"></div>
                            <div class="nd_learning_section nd_learning_bg_white nd_learning_border_1_solid_grey">

                              <div class="nd_learning_section nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_bg_grey nd_learning_border_bottom_1_solid_grey nd_learning_text_align_center">
                                <h3 class=""><strong>'.__('Contact Me','nd-learning').'</strong></h3>
                              </div>
                              <div id="nd_learning_single_teacher_contact_form" class="nd_learning_section nd_learning_padding_20 nd_learning_box_sizing_border_box">
                                
                                    '.do_shortcode('[contact-form-7 id="'.$nd_learning_meta_box_teacher_form.'"]').' 

                              </div>  

                            </div>



                        ';

                    }
                    //END contact form






				$nd_learning_str .= '</div>

			</div>

			<div class="nd_learning_section nd_learning_height_50"></div>

		';


		echo $nd_learning_str;


	    
	endwhile;
endif;

?>


<?php

//close container
$nd_learning_container = get_option('nd_learning_container');
if ($nd_learning_container != 1) { echo '</div>'; }

?>

<?php get_footer( ); ?>
