<?php


//ADD default tab list
add_action('nd_learning_single_course_tab_list','nd_learning_single_course_add_default_tab_list');
function nd_learning_single_course_add_default_tab_list(){

	$nd_learning_default_tabs = '';


	$nd_learning_default_tabs .= '
	<li class="nd_learning_display_inline_block">
		<h4>
			<a class="nd_learning_outline_0 nd_learning_padding_20_15 nd_learning_display_inline_block nd_options_first_font nd_options_color_greydark" href="#nd_learning_single_course_description">
				'.__('Description','nd-learning').'
			</a>
		</h4>
	</li>
	<li class="nd_learning_display_inline_block">
		<h4>
			<a class="nd_learning_outline_0 nd_learning_padding_20_15 nd_learning_display_inline_block nd_options_first_font nd_options_color_greydark" href="#nd_learning_single_course_teachers">
				'.__('Teachers','nd-learning').'
			</a>
		</h4>
	</li>
    ';

    echo $nd_learning_default_tabs;
}


//ADD default tab content
add_action('nd_learning_single_course_tab_list_content','nd_learning_single_course_add_default_tab_list_content');
function nd_learning_single_course_add_default_tab_list_content(){

	//get variables
	$nd_learning_content_course = do_shortcode(get_the_content());
	
	//teacher informations
	$nd_learning_meta_box_teachers = get_post_meta( get_the_ID(), 'nd_learning_meta_box_teachers', true );

	$nd_learning_meta_box_teacher_id = get_post_meta( get_the_ID(), 'nd_learning_meta_box_teacher', true );
    $nd_learning_teacher_name = get_the_title($nd_learning_meta_box_teacher_id);
    $nd_learning_teacher_permalink = get_permalink($nd_learning_meta_box_teacher_id);
    $nd_learning_teacher_excerpt = get_the_excerpt($nd_learning_meta_box_teacher_id);
    
    //image teacher
    $nd_learning_output_image_teacher = '';
	$nd_learning_teacher_image_id = get_post_thumbnail_id( $nd_learning_meta_box_teacher_id );
	$nd_learning_teacher_image_attributes = wp_get_attachment_image_src( $nd_learning_teacher_image_id, 'large' );
	if ( $nd_learning_teacher_image_attributes[0] == '' ) { $nd_learning_output_image = ''; }else{
	  $nd_learning_output_image_teacher .= '
	  <img alt="" class="nd_learning_single_course_page_teachers_image nd_learning_width_50_all_iphone nd_learning_margin_right_20 nd_learning_border_radius_100_percentage " width="100" src="'.$nd_learning_teacher_image_attributes[0].'">';
	}
	
	//metabox teacher
	$nd_learning_meta_box_teacher_color = get_post_meta( $nd_learning_meta_box_teacher_id, 'nd_learning_meta_box_teacher_color', true );
	if ( $nd_learning_meta_box_teacher_color == '' ) { $nd_learning_meta_box_teacher_color = '#000'; }
	$nd_learning_meta_box_teacher_role = get_post_meta( $nd_learning_meta_box_teacher_id, 'nd_learning_meta_box_teacher_role', true );
	if ( $nd_learning_meta_box_teacher_role == '' ) { $nd_learning_meta_box_teacher_role = __('TEACHER','nd-learning'); }

	$nd_learning_default_tabs_content = '';


	$nd_learning_default_tabs_content .= '
	
		<div class="nd_learning_section" id="nd_learning_single_course_description">
			<div class="nd_learning_section nd_learning_height_40"></div>
			'.$nd_learning_content_course.'
			<div class="nd_learning_section nd_learning_height_40"></div>

			<div class="nd_learning_section nd_learning_single_course_tags_container">
				'.get_the_tag_list('<p class="nd_options_first_font nd_options_color_greydark">'.__('Tags','nd-learning').' : ','','</p>').'
			</div>
			';

			echo $nd_learning_default_tabs_content;
			
			//custom hook
  			do_action("nd_learning_single_course_end_default_tab"); 


		$nd_learning_default_tabs_content = '</div>
		<div class="nd_learning_section" id="nd_learning_single_course_teachers">
			<div class="nd_learning_section nd_learning_height_40"></div>


			<h3><strong>'.__('Our Main Teachers','nd-learning').'</strong></h3>
            <div class="nd_learning_section nd_learning_height_30"></div>

            <div class="nd_learning_section">';

            	
            	//START ALL TEACHERS
            	if ($nd_learning_meta_box_teacher_id == ''){
            		
            		$nd_learning_default_tabs_content .= __('Any teachers for this course','nd-learning');
            	
            	}else{

            		
            		//START MAIN TEACHER
            		$nd_learning_default_tabs_content .= '

		            	<!--START teacher-->
		                <div class="nd_learning_section nd_learning_border_top_1_solid_grey nd_learning_padding_40_20 nd_learning_box_sizing_border_box">


		                    <div class="nd_learning_display_table nd_learning_float_left">
		                                
		                        <div class="nd_learning_display_table_cell nd_learning_vertical_align_middle">
		                        	'.$nd_learning_output_image_teacher.'
		                        </div>

		                        <div class="nd_learning_display_table_cell nd_learning_vertical_align_middle">
		                            <h3 class=""><a class="nd_options_color_greydark nd_options_first_font" href="'.$nd_learning_teacher_permalink.'"><strong>'.$nd_learning_teacher_name.'</strong></a></h3>
		                            <div class="nd_learning_section nd_learning_height_5"></div>
		                            <h5 class="nd_options_color_grey">'.$nd_learning_meta_box_teacher_role.'</h5>
		                            <div class="nd_learning_section nd_learning_height_20"></div>
		                            <a style="background-color:'.$nd_learning_meta_box_teacher_color.';" class="nd_learning_single_course_page_main_teacher_btn nd_learning_display_inline_block nd_learning_color_white_important nd_options_first_font nd_learning_padding_8 nd_learning_border_radius_3 nd_learning_font_size_13" href="'.$nd_learning_teacher_permalink.'">
		                            	'.__('VIEW PROFILE','nd-learning').'
		                            </a>
		                          

		                        </div>

		                    </div>
		            
		                    <div class="nd_learning_section nd_learning_height_20"></div>

		                    <p class="nd_learning_section">'.$nd_learning_teacher_excerpt.'</p>
		                    

		                </div>
		                <!--END teacher-->';
		                //END MAIN TEACHER



		                //START  OTHER TEACHERS
		                if ( $nd_learning_meta_box_teachers != '' ) {

		                	//explode the string
		            		$nd_learning_meta_box_teachers_array = explode(',', $nd_learning_meta_box_teachers);

		            		//start cicle for display all teachers
		            		for ($nd_learning_meta_box_teachers_array_i = 0; $nd_learning_meta_box_teachers_array_i < count($nd_learning_meta_box_teachers_array)-1; $nd_learning_meta_box_teachers_array_i++) {
							    
							    $nd_learning_page_by_path = get_page_by_path($nd_learning_meta_box_teachers_array[$nd_learning_meta_box_teachers_array_i],OBJECT,'teachers');
							    
							    //info teacher
							    $nd_learning_teacher_id = $nd_learning_page_by_path->ID;
							    $nd_learning_teacher_name = get_the_title($nd_learning_teacher_id);
							    $nd_learning_teacher_permalink = get_permalink($nd_learning_teacher_id);
							    $nd_learning_teacher_excerpt = get_the_excerpt($nd_learning_teacher_id);

							    //image teacher
							    $nd_learning_output_image_teacher = '';
								$nd_learning_teacher_image_id = get_post_thumbnail_id( $nd_learning_teacher_id );
								$nd_learning_teacher_image_attributes = wp_get_attachment_image_src( $nd_learning_teacher_image_id, 'large' );
								if ( $nd_learning_teacher_image_attributes[0] == '' ) { $nd_learning_output_image = ''; }else{
								  $nd_learning_output_image_teacher .= '
								  <img alt="" class="nd_learning_single_course_page_teachers_image nd_learning_width_50_all_iphone nd_learning_margin_right_20 nd_learning_border_radius_100_percentage " width="100" src="'.$nd_learning_teacher_image_attributes[0].'">';
								}
								
								//metabox teacher
								$nd_learning_meta_box_teacher_color = get_post_meta( $nd_learning_teacher_id, 'nd_learning_meta_box_teacher_color', true );
								if ( $nd_learning_meta_box_teacher_color == '' ) { $nd_learning_meta_box_teacher_color = '#000'; }
								$nd_learning_meta_box_teacher_role = get_post_meta( $nd_learning_teacher_id, 'nd_learning_meta_box_teacher_role', true );
								if ( $nd_learning_meta_box_teacher_role == '' ) { $nd_learning_meta_box_teacher_role = __('TEACHER','nd-learning'); }


							    $nd_learning_default_tabs_content .= '

				            	<!--START teacher-->
				                <div class="nd_learning_section nd_learning_border_top_1_solid_grey nd_learning_padding_40_20 nd_learning_box_sizing_border_box">


				                    <div class="nd_learning_display_table nd_learning_float_left">
				                                
				                        <div class="nd_learning_display_table_cell nd_learning_vertical_align_middle">
				                        	'.$nd_learning_output_image_teacher.'
				                        </div>

				                        <div class="nd_learning_display_table_cell nd_learning_vertical_align_middle">
				                            <h3 class=""><a class="nd_options_color_greydark nd_options_first_font" href="'.$nd_learning_teacher_permalink.'"><strong>'.$nd_learning_teacher_name.'</strong></a></h3>
				                            <div class="nd_learning_section nd_learning_height_5"></div>
				                            <h5 class="nd_options_color_grey">'.$nd_learning_meta_box_teacher_role.'</h5>
				                            <div class="nd_learning_section nd_learning_height_20"></div>
				                            <a style="background-color:'.$nd_learning_meta_box_teacher_color.';" class="nd_learning_single_course_page_teachers_btn nd_learning_display_inline_block nd_learning_color_white_important nd_options_first_font nd_learning_padding_8 nd_learning_border_radius_3 nd_learning_font_size_13" href="'.$nd_learning_teacher_permalink.'">
				                            	'.__('VIEW PROFILE','nd-learning').'
				                            </a>
				                          

				                        </div>

				                    </div>
				            
				                    <div class="nd_learning_section nd_learning_height_20"></div>

				                    <p class="nd_learning_section">'.$nd_learning_teacher_excerpt.'</p>
				                    

				                </div>
				                <!--END teacher-->';

							}

		                }
		                //END OTHER TEACHERS

            	}
            	//END ALL TEACHERS
                


            $nd_learning_default_tabs_content .= '</div>

		</div>

    ';

    echo $nd_learning_default_tabs_content;
}

?>



<?php get_header( ); ?>




<?php 
	

//get layout
$nd_learning_meta_box_course_page_layout = get_post_meta( get_the_ID(), 'nd_learning_meta_box_course_page_layout', true );
if ( $nd_learning_meta_box_course_page_layout == '' ) { $nd_learning_meta_box_course_page_layout = 'layout-1'; }

//get image info
$nd_learning_meta_box_course_header_img = get_post_meta( get_the_ID(), 'nd_learning_meta_box_course_header_img', true );
$nd_learning_meta_box_course_header_img_title = get_post_meta( get_the_ID(), 'nd_learning_meta_box_course_header_img_title', true );
$nd_learning_meta_box_course_header_img_position = get_post_meta( get_the_ID(), 'nd_learning_meta_box_course_header_img_position', true );


//start header image
if ( $nd_learning_meta_box_course_header_img != '' ) { 

	include "single-course-layout/header/".$nd_learning_meta_box_course_page_layout.".php";

    do_action('nd_learning_end_header_img_single_course_hook');

}
//end header image



//add container
$nd_learning_container = get_option('nd_learning_container');
if ($nd_learning_container != 1) { echo '<div class="nd_learning_container nd_learning_clearfix">'; }

?>


<?php

if(have_posts()) :
	while(have_posts()) : the_post();

		//include tabs js
		wp_enqueue_script('jquery-ui-tabs');
		
		//declare variables
	    $nd_learning_terms_difficulty_course_results = '';
	    $nd_learning_terms_category_course_results = '';
	    $nd_learning_terms_location_course_results = '';
	    $nd_learning_terms_typology_course_results = '';
	    $nd_learning_terms_duration_course_results = '';

	    //recover datas from plugin settings
	    $nd_learning_currency = get_option('nd_learning_currency');

	    //default
	    $nd_learning_title_course = get_the_title();

	    //metabox
	    $nd_learning_meta_box_price = get_post_meta( get_the_ID(), 'nd_learning_meta_box_price', true );
	    if ( $nd_learning_meta_box_price == 0 ) { 
	        $nd_learning_meta_box_price = 'Free';
	    } else { 
	        $nd_learning_meta_box_price = $nd_learning_meta_box_price.' '.$nd_learning_currency; 
	    }

	    $nd_learning_meta_box_max_availability = get_post_meta( get_the_ID(), 'nd_learning_meta_box_max_availability', true );
	    $nd_learning_meta_box_date = get_post_meta( get_the_ID(), 'nd_learning_meta_box_date', true );
	    $nd_learning_meta_box_color = get_post_meta( get_the_ID(), 'nd_learning_meta_box_color', true );
	    $nd_learning_meta_box_form = get_post_meta( get_the_ID(), 'nd_learning_meta_box_form', true );


	    //teacher informations
		$nd_learning_meta_box_teacher_id = get_post_meta( get_the_ID(), 'nd_learning_meta_box_teacher', true );
	    $nd_learning_teacher_name = get_the_title($nd_learning_meta_box_teacher_id);
	    $nd_learning_teacher_permalink = get_permalink($nd_learning_meta_box_teacher_id);
		$nd_learning_teacher_image_id = get_post_thumbnail_id( $nd_learning_meta_box_teacher_id );
		$nd_learning_teacher_image_attributes = wp_get_attachment_image_src( $nd_learning_teacher_image_id, 'large' );

	   
	    //taxonomies
	    $nd_learning_terms_difficulty_course = wp_get_post_terms( get_the_ID(), 'difficulty-level-course', array("fields" => "all"));
	    $nd_learning_terms_category_course = wp_get_post_terms( get_the_ID(), 'category-course', array("fields" => "all"));
	    $nd_learning_terms_location_course = wp_get_post_terms( get_the_ID(), 'location-course', array("fields" => "all"));
	    $nd_learning_terms_typology_course = wp_get_post_terms( get_the_ID(), 'typology-course', array("fields" => "all"));
	    $nd_learning_terms_duration_course = wp_get_post_terms( get_the_ID(), 'duration-course', array("fields" => "all"));

	    foreach($nd_learning_terms_difficulty_course as $nd_learning_term_difficulty_course) { $nd_learning_terms_difficulty_course_results .= $nd_learning_term_difficulty_course->name.' '; }
	    foreach($nd_learning_terms_category_course as $nd_learning_term_category_course) { $nd_learning_terms_category_course_results .= $nd_learning_term_category_course->name.' '; }
	    foreach($nd_learning_terms_location_course as $nd_learning_term_location_course) { $nd_learning_terms_location_course_results .= $nd_learning_term_location_course->name.' '; }
	    foreach($nd_learning_terms_typology_course as $nd_learning_term_typology_course) { $nd_learning_terms_typology_course_results .= $nd_learning_term_typology_course->name.' '; }
	    foreach($nd_learning_terms_duration_course as $nd_learning_term_duration_course) { $nd_learning_terms_duration_course_results .= $nd_learning_term_duration_course->name.' '; }

	    
	  	$nd_learning_result = '';


	  	//style for layout 2
	  	if ( $nd_learning_meta_box_course_page_layout == 'layout-2' ) {

	  		$nd_learning_result .= '
	  			<style>
	  				
	  				#nd_learning_single_course_page_title,
	  				#nd_learning_single_course_page_title_space { display:none; }

	  				#nd_learning_single_course_page_left_content h5,
	  				#nd_learning_single_course_page_left_content h5 strong,
	  				#nd_learning_single_course_page_left_content h4,
	  				#nd_learning_single_course_page_left_content h3,
	  				#nd_learning_single_course_page_left_content h3 a strong,
	  				#nd_learning_single_course_page_left_content h3 strong,
	  				#nd_learning_single_course_page_left_content h1 strong,
	  				#nd_learning_single_course_page_left_content p span strong {
	  					 font-weight:normal;

	  				}

	  				#nd_learning_single_course_page_related_courses h2 strong,
	  				#nd_learning_single_course_page_related_courses h3 a {
	  					font-weight:normal;
	  				}

	  				#nd_learning_single_course_page_related_courses .nd_learning_bg_greydark_alpha_gradient_2 { display:none; }
	  				#nd_learning_single_course_page_related_courses .nd_learning_width_33_percentage.nd_learning_display_none_all_iphone.nd_learning_float_left { display:none; }
	  				#nd_learning_single_course_page_related_courses .nd_learning_bg_grey .nd_learning_width_33_percentage { width:50%; }
	  				#nd_learning_single_course_page_related_courses .nd_learning_bg_grey .nd_learning_width_33_percentage a.nd_learning_color_white_important { padding:8px 15px; }
	  				#nd_learning_single_course_page_related_courses .nd_learning_bg_grey .nd_learning_width_33_percentage img { border-radius:4px; }

	  				#nd_learning_single_course_page_left_content cite { font-weight:normal !important; }

	  				#nd_learning_single_course_page_left_content .nd_learning_border_radius_3 { border-radius:4px; }

	  				#nd_learning_single_course_page_left_content h3 strong {
	  					 font-size:17px; text-transform:uppercase;
	  				}

	  				#nd_learning_single_course_page_right_content h4,
	  				#nd_learning_single_course_page_right_content h3 strong{
	  					font-weight:normal;
	  				}

	  				#nd_learning_single_course_info_course_teacher,
	  				#nd_learning_single_course_info_course_category,
	  				#nd_learning_single_course_info_course_print {
	  					width:33.33%;
	  				}

	  				#nd_learning_single_course_page_calendar_btn {
	  					border-radius:4px;
	  					margin-top: 10px;
	  					margin-bottom:6px;
	  					padding:10px 20px;
	  				}

	  				.nd_learning_single_course_page_attendes_filter,
	  				.nd_learning_single_course_page_attendes_image { border-radius:4px; }

	  				#nd_learning_single_course_page_img,
	  				#nd_learning_single_course_page_img_gradient { border-radius:4px; }

					.nd_learning_tabs > ul li {
						background-color:#fff;
						border:1px solid #f1f1f1;
						border-radius:4px;
						margin-right:10px;
					} 
					.nd_learning_tabs ul li h4 a{
						padding:8px 12px;
					} 
					.nd_learning_tabs ul li h4{
						font-size:14px;
					} 
					.nd_learning_tabs ul{
						border-bottom-width:0px;
					} 

					.nd_learning_tabs .ui-tabs-active.ui-state-active {
						box-shadow:none;
						background-color:'.$nd_learning_meta_box_color.';
						border:1px solid '.$nd_learning_meta_box_color.';
					}
					.nd_learning_tabs .ui-tabs-active.ui-state-active h4 a{
						color:#fff;
					}

					#nd_learning_calendar_single_course thead tr th span { font-weight:normal; }
					#nd_learning_single_course_page_start_cal { border-radius:4px; }
					#nd_learning_calendar_single_course tbody tr td { padding:7px 5px !important; }

					#nd_learning_single_course_table_info .nd_learning_border_bottom_2_solid_grey { border-bottom-width:1px; }
					#nd_learning_single_course_contact_form_container { border-radius:4px; }

					.nd_learning_single_course_page_main_teacher_btn,
					.nd_learning_single_course_page_teachers_btn { border-radius:4px; padding:8px 15px; }

					.nd_learning_single_course_page_teachers_image { border-radius:4px; }

	  			</style>
	  		';
	  		

	  	}
	    
	    $nd_learning_result .= '



	    	<div class="nd_learning_section nd_learning_height_50"></div>

	    	<div class="nd_learning_section">

	    		<div id="nd_learning_single_course_page_left_content" class="nd_learning_width_66_percentage nd_learning_width_100_percentage_responsive nd_learning_float_left nd_learning_padding_15 nd_learning_box_sizing_border_box">';

	    			echo $nd_learning_result;

	    			//custom hook
  					do_action("nd_learning_start_single_course_page");		

	    $nd_learning_result = '

	    			

	    			<h1 id="nd_learning_single_course_page_title">'.$nd_learning_title_course.'</h1>
	    			<div id="nd_learning_single_course_page_title_space" class="nd_learning_section nd_learning_height_20"></div>


	    			<!--START some info course-->
	    			<div class="nd_learning_section">

	    				<div id="nd_learning_single_course_info_course_teacher" class="nd_learning_width_25_percentage nd_learning_width_50_percentage_all_iphone nd_learning_float_left">
						    <div class="nd_learning_display_table nd_learning_float_left">
						        
						        <div class="nd_learning_display_table_cell nd_learning_vertical_align_middle">
						            <img alt="" class="nd_learning_margin_right_10 nd_learning_float_left nd_learning_border_radius_100_percentage" width="40" height="40" src="'.$nd_learning_teacher_image_attributes[0].'">
						        </div>

						        <div class="nd_learning_display_table_cell nd_learning_vertical_align_middle">
						            <p class="nd_learning_font_size_13">'.__('Teacher','nd-learning').'</p>
						            <div class="nd_learning_section nd_learning_height_5"></div>
						            <h5 class="">'.$nd_learning_teacher_name.'</h5>
						        </div>

						    </div> 
						</div>



						<div id="nd_learning_single_course_info_course_category" class="nd_learning_width_25_percentage nd_learning_width_50_percentage_all_iphone nd_learning_float_left">

						    <div class="nd_learning_section nd_learning_height_5"></div>
						    <div class="nd_learning_display_table nd_learning_float_left">
						        
						        <div class="nd_learning_display_table_cell nd_learning_vertical_align_middle">
						            <img alt="" class="nd_learning_margin_right_10 nd_learning_float_left" width="30" height="30" src="'.esc_url(plugins_url('icon-category.svg', __FILE__ )).'">
						        </div>

						        <div class="nd_learning_display_table_cell nd_learning_vertical_align_middle">
						            <p class="nd_learning_font_size_13">'.__('Category','nd-learning').'</p>
						            <div class="nd_learning_section nd_learning_height_5"></div>
						            <h5 class="">'.$nd_learning_terms_category_course_results.'</h5>
						        </div>

						    </div> 
						</div>



						<div id="nd_learning_single_course_info_course_print" class="nd_learning_width_50_percentage nd_learning_display_none_all_iphone nd_learning_float_right">

						    <div class="nd_learning_section nd_learning_height_5"></div>
						    <div class="nd_learning_section nd_learning_height_5"></div>
						    
						    <div class="nd_learning_display_table nd_learning_float_right">
						        <a class="nd_learning_cursor_pointer" onclick="window.print()"><img alt="" class="" width="30" height="30" src="'.esc_url(plugins_url('icon-print-grey.svg', __FILE__ )).'"></a>
						    </div> 
						</div>


	    			</div>
	    			<!--END some info course-->

	    			<div class="nd_learning_section nd_learning_height_20"></div>
	    			';

	    			


	    			//image
				    if ( has_post_thumbnail() ) {

					  $nd_learning_image_id = get_post_thumbnail_id( get_the_ID() );
					  $nd_learning_image_attributes = wp_get_attachment_image_src( $nd_learning_image_id, 'large' );
					  $nd_learning_image_src = $nd_learning_image_attributes[0];

				      $nd_learning_result .= '

						<div class="nd_learning_section nd_learning_position_relative">
						                                
							<img id="nd_learning_single_course_page_img" alt="" class="nd_learning_section" src="'.$nd_learning_image_src.'">

							<div id="nd_learning_single_course_page_img_gradient" class="nd_learning_bg_greydark_alpha_gradient nd_learning_position_absolute nd_learning_left_0 nd_learning_height_100_percentage nd_learning_width_100_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box">
							    <div class="nd_learning_position_absolute nd_learning_bottom_20">';
							       

							    //bookmark function
						        if (function_exists('nd_learning_add_bookmark_button')) { $nd_learning_result .= nd_learning_add_bookmark_button(); }
						        //compare function
						        if (function_exists('nd_learning_add_compare_button')) { $nd_learning_result .= nd_learning_add_compare_button(); }


						$nd_learning_result .= '</div>

							</div>

						</div>

				      ';

				    }







	    			
	    		   $nd_learning_result .= '<div class="nd_learning_section">';


	    				echo $nd_learning_result;	

	    				//custom hook
        				do_action("nd_learning_shortcode_single_metabox_details");


$nd_learning_result = '</div>


					<div class="nd_learning_section nd_learning_height_40"></div>

					<!--START Tabs-->
					<div class="nd_learning_tabs nd_learning_section">

						<ul class="nd_learning_list_style_none nd_learning_margin_0 nd_learning_padding_0 nd_learning_section nd_learning_border_bottom_2_solid_grey">';

						echo $nd_learning_result;
							 
							//custom hook
			    			do_action("nd_learning_single_course_tab_list");
			    			do_action("nd_learning_single_course_tab_list_2"); 
				    		

						$nd_learning_result = '</ul>';
					  

					  	echo $nd_learning_result;
					  	
						//custom hook
						do_action("nd_learning_single_course_tab_list_content"); 
				    	
					    
			    	$nd_learning_result = '</div>
			    	<!--END tabs-->';



			    	$nd_learning_result .= '<script type="text/javascript">
					<!--//--><![CDATA[//><!--
						jQuery(document).ready(function($) {
							$(".nd_learning_tabs").tabs();
						});
					//--><!]]>
					</script>';

					echo $nd_learning_result;

					//custom hook
  					do_action("nd_learning_end_single_course_page");


$nd_learning_result = '</div>

	    		<div id="nd_learning_single_course_page_right_content" class="nd_learning_width_33_percentage nd_learning_width_100_percentage_responsive nd_learning_float_left nd_learning_padding_15 nd_learning_box_sizing_border_box">';

	    			echo $nd_learning_result;

	    			//custom hook
  					do_action("nd_learning_sidebar_single_course_page");


  					$nd_learning_result = '<div id="nd_learning_single_course_page_start_cal" class="nd_learning_section nd_learning_border_1_solid_grey">';
  						echo $nd_learning_result;

	  					
  						//hook
	  					do_action("nd_learning_sidebar_single_course_page_2");


	  					$nd_learning_result = '<div id="nd_learning_single_course_all_book_buttons" class="nd_learning_section nd_learning_bg_grey nd_learning_border_top_1_solid_grey nd_learning_padding_20 nd_learning_box_sizing_border_box">';
	  					echo $nd_learning_result;

	  					//hook
	  					do_action("nd_learning_sidebar_single_course_page_3");

	  				$nd_learning_result = '</div></div>
	  				<div class="nd_learning_section nd_learning_height_20"></div>
	  				';



  					$nd_learning_result .= '

  					<style>#nd_learning_single_course_table_info tr:last-child { border-bottom-width:0px; }</style>

					<table id="nd_learning_single_course_table_info" class="nd_learning_section">
                        <tbody>';
                            

                        if ($nd_learning_meta_box_price != '') {

                        	$nd_learning_result .= '<tr id="nd_learning_single_course_table_info_price" class="nd_learning_border_bottom_2_solid_grey">
                                <td class="nd_learning_padding_20 "><img alt="" class="nd_learning_float_left" width="40" height="40" src="'.esc_url(plugins_url('icon-price-grey.svg', __FILE__ )).'"></td>
                                <td class="nd_learning_padding_20 "><h4 class=" nd_learning_text_align_right">'.__('Price ','nd-learning').' : '.$nd_learning_meta_box_price.'</h4></td>
                            </tr>';

                        }

                        if ($nd_learning_meta_box_max_availability != '') {

                        	$nd_learning_result .= '<tr id="nd_learning_single_course_table_info_max_availability" class="nd_learning_border_bottom_2_solid_grey">
                                <td class="nd_learning_padding_20"><img alt="" class="nd_learning_float_left" width="40" height="40" src="'.esc_url(plugins_url('icon-availability-grey.svg', __FILE__ )).'"></td>
                                <td class="nd_learning_padding_20"><h4 class=" nd_learning_text_align_right">'.__('Max Availability ','nd-learning').' : '.$nd_learning_meta_box_max_availability.'</h4></td>
                            </tr>';

                        }

                        /*if ($nd_learning_meta_box_date != '') {

                        	$nd_learning_result .= '<tr class="nd_learning_border_bottom_2_solid_grey">
                                <td class="nd_learning_padding_20 "><img alt="" class="nd_learning_float_left" width="40" src="'.esc_url(plugins_url('icon-date-grey.svg', __FILE__ )).'"></td>
                                <td class="nd_learning_padding_20 "><h4 class=" nd_learning_text_align_right">'.__('Date ','nd-learning').' : '.$nd_learning_meta_box_date.'</h4></td>
                            </tr>';

                        }*/

                        if ($nd_learning_terms_difficulty_course_results != '') {

                        	$nd_learning_result .= '<tr id="nd_learning_single_course_table_info_difficulty" class="nd_learning_border_bottom_2_solid_grey">
                                <td class="nd_learning_padding_20 "><img alt="" class="nd_learning_float_left" width="40" height="40" src="'.esc_url(plugins_url('icon-difficulty-grey.svg', __FILE__ )).'"></td>
                                <td class="nd_learning_padding_20 "><h4 class=" nd_learning_text_align_right">'.__('Difficulty ','nd-learning').' : '.$nd_learning_terms_difficulty_course_results.'</h4></td>
                            </tr>';

                        }

                        /*if ($nd_learning_terms_category_course_results != '') {

                        	$nd_learning_result .= '<tr class="nd_learning_border_bottom_2_solid_grey">
                                <td class="nd_learning_padding_20 "><img alt="" class="nd_learning_float_left" width="40" src="'.esc_url(plugins_url('icon-category-grey.svg', __FILE__ )).'"></td>
                                <td class="nd_learning_padding_20 "><h4 class=" nd_learning_text_align_right">'.__('Category ','nd-learning').' : '.$nd_learning_terms_category_course_results.'</h4></td>
                            </tr>';

                        }*/

                        if ($nd_learning_terms_location_course_results != '') {

                        	$nd_learning_result .= '<tr id="nd_learning_single_course_table_info_location" class="nd_learning_border_bottom_2_solid_grey">
                                <td class="nd_learning_padding_20 "><img alt="" class="nd_learning_float_left" width="40" height="40" src="'.esc_url(plugins_url('icon-location-grey.svg', __FILE__ )).'"></td>
                                <td class="nd_learning_padding_20 "><h4 class=" nd_learning_text_align_right">'.__('Location ','nd-learning').' : '.$nd_learning_terms_location_course_results.'</h4></td>
                            </tr>';

                        }

                        if ($nd_learning_terms_typology_course_results != '') {

                        	$nd_learning_result .= '<tr id="nd_learning_single_course_table_info_typology" class="nd_learning_border_bottom_2_solid_grey">
                                <td class="nd_learning_padding_20 "><img alt="" class="nd_learning_float_left" width="40" height="40" src="'.esc_url(plugins_url('icon-typology-grey.svg', __FILE__ )).'"></td>
                                <td class="nd_learning_padding_20 "><h4 class=" nd_learning_text_align_right">'.__('Typology ','nd-learning').' : '.$nd_learning_terms_typology_course_results.'</h4></td>
                            </tr>';

                        }

                        /*if ($nd_learning_terms_duration_course_results != '') {

                        	$nd_learning_result .= '<tr>
                                <td class="nd_learning_padding_20 "><img alt="" class="nd_learning_float_left" width="40" src="'.esc_url(plugins_url('icon-duration-grey.svg', __FILE__ )).'"></td>
                                <td class="nd_learning_padding_20 "><h4 class=" nd_learning_text_align_right">'.__('Duration ','nd-learning').' : '.$nd_learning_terms_duration_course_results.'</h4></td>
                            </tr>';

                        }*/
 

                        $nd_learning_result .= '</tbody>
                    </table>';



                    //START contact form
                    if ( $nd_learning_meta_box_form != '' ) {

                    	$nd_learning_result .= '



                    		<style>

						    #nd_learning_single_course_contact_form input[type="text"],
						    #nd_learning_single_course_contact_form input[type="email"],
						    #nd_learning_single_course_contact_form input[type="url"],
						    #nd_learning_single_course_contact_form input[type="tel"],
						    #nd_learning_single_course_contact_form input[type="number"],
						    #nd_learning_single_course_contact_form input[type="date"],
						    #nd_learning_single_course_contact_form input[type="checkbox"],
						    #nd_learning_single_course_contact_form input[type="file"],
						    #nd_learning_single_course_contact_form textarea,
						    #nd_learning_single_course_contact_form label,
						    #nd_learning_single_course_contact_form select
						    {

						      width: 100%;

						    }

						    #nd_learning_single_course_contact_form .wpcf7-response-output.wpcf7-validation-errors,
						    #nd_learning_single_course_contact_form .wpcf7-response-output.wpcf7-mail-sent-ok
						    {

						    	float:left;
						    	width:100%;
						    	box-sizing:border-box;

							}

						    </style>



	                    	<div class="nd_learning_section nd_learning_height_20"></div>
	                    	<div id="nd_learning_single_course_contact_form_container" class="nd_learning_section nd_learning_bg_white nd_learning_border_1_solid_grey">

	                          <div class="nd_learning_section nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_bg_grey nd_learning_border_bottom_1_solid_grey nd_learning_text_align_center">
	                            <h3 class=""><strong>'.__('Question','nd-learning').'</strong></h3>
	                          </div>
	                          <div id="nd_learning_single_course_contact_form" class="nd_learning_section nd_learning_padding_20 nd_learning_box_sizing_border_box">
	                            
	                          		'.do_shortcode('[contact-form-7 id="'.$nd_learning_meta_box_form.'"]').' 

	                          </div>  

	                        </div>



	                    ';

                    }
                    //END contact form

                    





$nd_learning_result .= '</div>

	    	</div>


	    	<div class="nd_learning_section nd_learning_height_50"></div>

	    ';


	    //START BOTTOM BAR
	    $nd_learning_result .= '

	    	<!--<div class="nd_learning_position_fixed nd_learning_bottom_0 nd_learning_left_0 nd_learning_section nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_bg_greydark">

	    		<p>test</p>

	    	</div>-->


	    ';
	    //END BOTTOM BAR
	    


		echo $nd_learning_result;    
	    

	    
	endwhile;
endif;

?>


<?php

//close container
$nd_learning_container = get_option('nd_learning_container');
if ($nd_learning_container != 1) { echo '</div>'; }

?>


<?php

//custom hook
do_action("nd_learning_single_course_page_before_footer");


?>



<?php get_footer( );
















