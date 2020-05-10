<?php

//START  nd_learning_account
function nd_learning_shortcode_account() {


	//check if the user is lkogged
	if (is_user_logged_in() == 1){

		$nd_learning_current_user = wp_get_current_user();

		wp_enqueue_script('jquery-ui-tabs');

		?>



		<div class="nd_learning_width_33_percentage nd_learning_float_left nd_learning_box_sizing_border_box nd_learning_padding_15 nd_learning_width_100_percentage_responsive">

	        <div class="nd_learning_section nd_learning_box_sizing_border_box">
	                    
                <!--start preview-->
                <div class="nd_learning_section ">
            
                    <!--image-->
                    <div class="nd_learning_section nd_learning_position_relative">


                    	<?php

                    		$nd_learning_account_avatar_url_args = array(
								'size'   => 600
							);
							$nd_learning_account_avatar_url = get_avatar_url($nd_learning_current_user->user_email, $nd_learning_account_avatar_url_args);

                    	?>
                        
                        <img alt="" class="nd_learning_section" src="<?php echo $nd_learning_account_avatar_url; ?>">

                        <div class="nd_learning_bg_greydark_alpha_gradient nd_learning_position_absolute nd_learning_left_0 nd_learning_height_100_percentage nd_learning_width_100_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box">
                            <div class="nd_learning_position_absolute nd_learning_bottom_20">
                                <h2 class="nd_learning_color_white_important">@<?php echo $nd_learning_current_user->user_login; ?></h2>
                            </div>

                        </div>

                    </div>
                    <!--image-->


                    <div class="nd_learning_section nd_learning_box_sizing_border_box">
                    
                        <div class="nd_learning_section nd_learning_bg_greydark">
                            <table class="nd_learning_section ">
                                <tbody>
                                   
                                   <tr class="">
                                        <td class="nd_learning_padding_30">  
                                            <h5 class="nd_learning_font_size_13 nd_learning_text_transform_uppercase nd_options_color_grey"><?php _e('Name','nd-learning'); ?></h5>
                                            <div class="nd_learning_section nd_learning_height_5"></div>
                                            <p class="nd_learning_color_white_important nd_learning_line_height_16"><?php echo $nd_learning_current_user->user_firstname; ?></p>
                                        </td>
                                        <td class="nd_learning_padding_30">
                                            <h5 class="nd_learning_font_size_13 nd_learning_text_transform_uppercase nd_options_color_grey"><?php _e('Last Name','nd-learning'); ?></h5>
                                            <div class="nd_learning_section nd_learning_height_5"></div>
                                            <p class="nd_learning_color_white_important nd_learning_line_height_16"><?php echo $nd_learning_current_user->user_lastname; ?></p>    
                                        </td>
                                    </tr>

                                </tbody>
                            </table> 
                        </div>

                        <div class="nd_learning_section nd_learning_border_1_solid_grey nd_learning_padding_20 nd_learning_box_sizing_border_box">

                            <table class="nd_learning_section">
                                <tbody>
                                   
                                   <tr class="">
                                        <td class="nd_learning_padding_10">  

                                            <div class="nd_learning_display_table nd_learning_float_left">
                    
                                                <div class="nd_learning_display_table_cell nd_learning_vertical_align_middle">
                                                    <img alt="" class="nd_learning_margin_right_20" width="25" src="<?php echo esc_url(plugins_url('icon-email-grey.svg', __FILE__ )); ?>">
                                                </div>

                                                <div class="nd_learning_display_table_cell nd_learning_vertical_align_middle">
                                                    <h5 class="nd_learning_font_size_13 nd_learning_text_transform_uppercase"><strong><?php _e('Email','nd-learning'); ?></strong></h5>
                                                    <div class="nd_learning_section nd_learning_height_5"></div>
                                                    <p class=""><?php echo $nd_learning_current_user->user_email; ?></p>
                                                </div>

                                            </div>

                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td class="nd_learning_padding_10">  

                                            <div class="nd_learning_display_table nd_learning_float_left">
                    
                                                <div class="nd_learning_display_table_cell nd_learning_vertical_align_middle">
                                                    <img alt="" class="nd_learning_margin_right_20" width="25" src="<?php echo esc_url(plugins_url('icon-link-grey.svg', __FILE__ )); ?>">
                                                </div>

                                                <div class="nd_learning_display_table_cell nd_learning_vertical_align_middle">
                                                    <h5 class="nd_learning_font_size_13 nd_learning_text_transform_uppercase"><strong><?php _e('Url','nd-learning'); ?></strong></h5>
                                                    <div class="nd_learning_section nd_learning_height_5"></div>
                                                    <p class=""><?php echo $nd_learning_current_user->user_url; ?></p>
                                                </div>

                                            </div>

                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td class="nd_learning_padding_10">  
                                            <h5 class="nd_learning_font_size_13 nd_learning_text_transform_uppercase"><strong><?php _e('About Me','nd-learning'); ?></strong></h5>
                                            <div class="nd_learning_section nd_learning_height_5"></div>
                                            <p class="nd_learning_line_height_25"><?php echo $nd_learning_current_user->description; ?></p>
                                        </td>
                                    </tr>

                                </tbody>
                            </table> 
                        </div>
                        

                    </div>

                    <div class="nd_learning_section nd_learning_padding_10 nd_learning_box_sizing_border_box nd_learning_bg_white ">
                        
                        <div class="nd_learning_width_50_percentage nd_learning_padding_10 nd_learning_box_sizing_border_box nd_learning_float_left nd_learning_text_align_center">
                            <a class="nd_learning_display_inline_block nd_learning_color_white_important nd_learning_bg_green nd_learning_box_sizing_border_box nd_learning_width_100_percentage nd_options_first_font nd_learning_padding_8 nd_learning_border_radius_3 nd_learning_font_size_13" href="<?php echo get_edit_user_link(); ?>"><?php _e('EDIT PROFILE','nd-learning'); ?></a>
                        </div>  

                        <div class="nd_learning_width_50_percentage nd_learning_padding_10 nd_learning_box_sizing_border_box nd_learning_float_left nd_learning_text_align_center">
                            <a class="nd_learning_display_inline_block nd_learning_color_white_important nd_learning_bg_red nd_learning_box_sizing_border_box nd_learning_width_100_percentage nd_options_first_font nd_learning_padding_8 nd_learning_border_radius_3 nd_learning_font_size_13" href="<?php echo wp_logout_url( get_permalink() ); ?>"><?php _e('LOGOUT','nd-learning'); ?></a>
                        </div> 
                        
                    </div>



        		</div>
                <!--start preview-->

	        </div>

	    </div>






	    <div class="nd_learning_width_66_percentage nd_learning_float_left nd_learning_box_sizing_border_box nd_learning_padding_15 nd_learning_width_100_percentage_responsive">
	    	

	    	<!--START Tabs-->
			<div class="nd_learning_tabs nd_learning_section">

				<ul class="nd_learning_list_style_none nd_learning_margin_0 nd_learning_padding_0 nd_learning_section nd_learning_border_bottom_2_solid_grey">

					<?php 
					//custom hook
	    			do_action("nd_learning_shortcode_account_tab_list"); 
		    		?>	
				</ul>
			  
			  	<?php 
				//custom hook
				do_action("nd_learning_shortcode_account_tab_list_content"); 
		    	?>
			    
	    	</div>
	    	<!--END tabs-->



	    	<script type="text/javascript">
			<!--//--><![CDATA[//><!--
				jQuery(document).ready(function($) {
					$('.nd_learning_tabs').tabs();
				});
			//--><!]]>
			</script>


	    </div>




		<?php

		//custom hook
    	do_action("nd_learning_end_shortcode_account_on_user_login");

    	?>



    	<?php


	}else{

        $nd_learning_account_page_result = '';

        $nd_learning_account_page_result .= '

            <div class="nd_learning_section">
              <div class="nd_learning_width_50_percentage nd_learning_float_left nd_learning_box_sizing_border_box nd_learning_padding_15 nd_learning_width_100_percentage_responsive">
                
                <div class="nd_learning_section nd_learning_border_radius_3 nd_learning_border_1_solid_grey nd_learning_padding_20 nd_learning_box_sizing_border_box">
                    
                    <h6 class="nd_options_second_font nd_learning_bg_green nd_learning_padding_5 nd_learning_border_radius_3 nd_learning_color_white_important nd_learning_display_inline_block">'.__('ALREADY A MEMBER','nd-learning').'</h6>
                    <div class="nd_learning_section nd_learning_height_5"></div>
                    <h2><strong>'.__('Log In','nd-learning').'</strong></h2>

                    '.do_shortcode("[nd_learning_login]").' 
                </div>

                
              </div>

        ';

        //START check if registration is enable
        if ( get_option( 'users_can_register' ) == 1 ) {

            $nd_learning_account_page_result .='

            <div class="nd_learning_width_50_percentage nd_learning_float_left nd_learning_box_sizing_border_box nd_learning_padding_15 nd_learning_width_100_percentage_responsive">

                <div class="nd_learning_section nd_learning_bg_white nd_learning_border_radius_3 nd_learning_border_1_solid_grey nd_learning_padding_20 nd_learning_box_sizing_border_box">
                
                    <h6 class="nd_options_second_font nd_learning_bg_orange nd_learning_padding_5 nd_learning_border_radius_3 nd_learning_color_white_important nd_learning_display_inline_block">'.__('I DO NOT HAVE AN ACCOUNT','nd-learning').'</h6>
                    <div class="nd_learning_section nd_learning_height_5"></div>
                    <h2><strong>'.__('Register','nd-learning').'</strong></h2>

                    '.do_shortcode("[nd_learning_register]").'

                </div>
                
              </div>';

        }else{

            $nd_learning_account_page_result .='

            <div class="nd_learning_width_50_percentage nd_learning_float_left nd_learning_box_sizing_border_box nd_learning_padding_15 nd_learning_width_100_percentage_responsive">


                <div class="nd_learning_opacity_04 nd_learning_section nd_learning_bg_white nd_learning_border_radius_3 nd_learning_border_1_solid_grey nd_learning_padding_20 nd_learning_box_sizing_border_box">
                
                    <h6 class="nd_options_second_font nd_learning_bg_orange nd_learning_padding_5 nd_learning_border_radius_3 nd_learning_color_white_important nd_learning_display_inline_block">'.__('I DO NOT HAVE AN ACCOUNT','nd-learning').'</h6>
                    <div class="nd_learning_section nd_learning_height_5"></div>
                    <h2><strong>'.__('Registration Disabled','nd-learning').'</strong></h2>

                    
                    <form action="#" method="post">
                        <p>
                          <label class="nd_learning_section nd_learning_margin_top_20">'.__('Username','nd-learning').' *</label>
                          <input readonly type="text" name="nd_learning_username" class=" nd_learning_section" value="">
                        </p>
                        <p>
                          <label class="nd_learning_section nd_learning_margin_top_20">'.__('Password','nd-learning').' *</label>
                          <input readonly type="password" name="nd_learning_password" class=" nd_learning_section" value="">
                        </p>
                        <p>
                          <label class="nd_learning_section nd_learning_margin_top_20">'.__('Email','nd-learning').' *</label>
                          <input readonly type="text" name="nd_learning_email" class=" nd_learning_section" value="">
                        </p>
                        <p>
                          <label class="nd_learning_section nd_learning_margin_top_20">'.__('Website','nd-learning').'</label>
                          <input readonly type="text" name="nd_learning_website" class=" nd_learning_section" value="">
                        </p>
                        <p>
                          <label class="nd_learning_section nd_learning_margin_top_20">'.__('First Name','nd-learning').'</label>
                          <input readonly type="text" name="nd_learning_first_name" class="nd_learning_section" value="">
                        </p>
                        <p>
                          <label class="nd_learning_section nd_learning_margin_top_20">'.__('Last Name','nd-learning').'</label>
                          <input readonly type="text" name="nd_learning_last_name" class="nd_learning_section" value="">
                        </p>
                        <p>
                          <label class="nd_learning_section nd_learning_margin_top_20">'.__('Nickname','nd-learning').'</label>
                          <input readonly type="text" name="nd_learning_nickname" class="nd_learning_section" value="">
                        </p>
                        <p>
                          <label class="nd_learning_section nd_learning_margin_top_20">'.__('About / Bio','nd-learning').'</label>
                          <textarea readonly class="nd_learning_section" name="nd_learning_bio"></textarea>
                        </p>
                        <input disabled class="nd_learning_section nd_learning_margin_top_20" type="submit" name="submit" value="'.__('Registration Disabled','nd-learning').'">
                    </form>
    

                </div>


              </div>';

        }
        //END check if registration is enable


        $nd_learning_account_page_result .='</div>';


        echo $nd_learning_account_page_result;
		

	}
	//end if


}
add_shortcode('nd_learning_account', 'nd_learning_shortcode_account');
//END nd_learning_account