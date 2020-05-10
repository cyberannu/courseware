<?php


if ( get_option('nicdark_theme_author') != 1 ){



  add_action('admin_menu','nd_learning_add_settings_menu_premium_addons');
  function nd_learning_add_settings_menu_premium_addons(){

    add_submenu_page( 'nd-learning-settings','Premium Addons', __('Premium Addons','nd-learning'), 'manage_options', 'nd-learning-settings-premium-addons', 'nd_learning_settings_menu_premium_addons' );

  }



  function nd_learning_settings_menu_premium_addons() {

  ?>

    
    <div class="nd_learning_section nd_learning_padding_right_20 nd_learning_padding_left_2 nd_learning_box_sizing_border_box nd_learning_margin_top_25 ">

      

      <div style="background-color:<?php echo nd_learning_get_profile_bg_color(0); ?>; border-bottom:3px solid <?php echo nd_learning_get_profile_bg_color(2); ?>;" class="nd_learning_section nd_learning_padding_20  nd_learning_box_sizing_border_box">
        <h2 class="nd_learning_color_ffffff nd_learning_display_inline_block"><?php _e('ND Learning','nd-learning'); ?></h2><span class="nd_learning_margin_left_10 nd_learning_color_a0a5aa"><?php echo nd_learning_get_plugin_version(); ?></span>
      </div>

      

      <div class="nd_learning_section nd_learning_min_height_400  nd_learning_box_shadow_0_1_1_000_04 nd_learning_background_color_ffffff nd_learning_border_1_solid_e5e5e5 nd_learning_border_top_width_0 nd_learning_border_left_width_0 nd_learning_overflow_hidden nd_learning_position_relative">
      
        <!--START menu-->
        <div style="background-color:<?php echo nd_learning_get_profile_bg_color(1); ?>;" class="nd_learning_width_20_percentage nd_learning_float_left nd_learning_box_sizing_border_box nd_learning_min_height_3000 nd_learning_position_absolute">

          <ul class="nd_learning_navigation">
            <li><a class="" href="<?php echo admin_url('admin.php?page=nd-learning-settings'); ?>"><?php _e('Plugin Settings','nd-learning'); ?></a></li>
            
            <?php 

            if ( get_option('nicdark_theme_author') == 1 ){ ?>

              <li><a class="" href="<?php echo admin_url('admin.php?page=nd-learning-settings-addons-manager'); ?>" ><?php _e('Addons Manager','nd-learning'); ?></a></li>

            <?php }
            
            ?>
            
            <li><a class="" href="<?php echo admin_url('customize.php'); ?>"><?php _e('Customizer','nd-learning'); ?></a></li>
            <li><a class="" href="<?php echo admin_url('admin.php?page=nd-learning-booking-settings'); ?>"><?php _e('Paypal Settings','nd-learning'); ?></a></li>
            <li><a class="" href="<?php echo admin_url('admin.php?page=nd-learning-free-orders-page'); ?>"><?php _e('Free Orders','nd-learning'); ?></a></li>
            <li><a class="" href="<?php echo admin_url('admin.php?page=nd-learning-premium-orders-page'); ?>"><?php _e('Premium Orders','nd-learning'); ?></a></li>
            <li><a class="" href="<?php echo admin_url('admin.php?page=nd-learning-reviews-page'); ?>"><?php _e('Reviews List','nd-learning'); ?></a></li>
            <li><a class="" href="<?php echo admin_url('admin.php?page=nd-learning-settings-import-export'); ?>" ><?php _e('Import Export','nd-learning'); ?></a></li>
            <li><a target="_blank" href="http://documentations.nicdark.com/"><?php _e('Documentation','nd-learning'); ?></a></li>

            <?php 

            if ( get_option('nicdark_theme_author') != 1 ){ ?>

              <li><a style="background-color:<?php echo nd_learning_get_profile_bg_color(2); ?>;" class="" href="" ><?php _e('Premium Addons','nd-learning'); ?></a></li>

            <?php }
            
            ?>


          </ul>
        </div>
        <!--END menu-->


        <!--START content-->
        <div class="nd_learning_width_80_percentage nd_learning_margin_left_20_percentage nd_learning_float_left nd_learning_box_sizing_border_box nd_learning_padding_20">


          <!--START-->
          <div class="nd_learning_section">
            
              


               <div class="nd_learning_section nd_learning_padding_20 nd_learning_box_sizing_border_box">
                <div class="nd_learning_section nd_learning_padding_30 nd_learning_box_sizing_border_box nd_learning_border_1_solid_e5e5e5 nd_learning_position_relative">
                  <h2 class="nd_learning_font_size_21 nd_learning_line_height_21 nd_learning_margin_0"><?php _e('Get All Addons','nd-learning'); ?></h2>
                  <p class="nd_learning_margin_top_10 nd_learning_color_666666 nd_learning_font_size_16 nd_learning_line_height_16 nd_learning_margin_0"><?php _e('Get all addons and an amazing education WP theme all in one pack.','nd-learning'); ?></p>
                  <a target="_blank" class="button button-primary button-hero nd_learning_top_30 nd_learning_right_30 nd_learning_position_absolute" href="https://goo.gl/zb4TaQ"><?php _e('CHECK IT NOW !','nd-learning'); ?></a>
                </div>
              </div>





              <table id="nd_learning_table_premium_addons" class="nd_learning_width_60_percentage nd_learning_margin_auto nd_learning_border_collapse_collapse">
                
                <thead class="nd_learning_text_align_center">
                  <tr>
                    <td>
                    </td>
                    <td>
                      <h2><?php _e('FREE','nd-learning'); ?></h2>
                    </td>
                    <td>
                      <h2><?php _e('PREMIUM','nd-learning'); ?></h2>
                    </td>
                  </tr>
                </thead>

                <tbody>
                  

                  <tr>
                    <td>
                      <h2 class="nd_learning_section nd_learning_margin_0"><?php _e('Paypal','nd-learning'); ?></h2>
                      <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_10"><?php _e('Buy all courses with Paypal','nd-learning'); ?>. <a target="_blank" href="https://goo.gl/wwajOn"><?php _e('View Demo','nd-learning'); ?></a></p>
                    </td>

                    

                    <td class="nd_learning_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_learning_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>


                  <tr>
                    <td>
                      <h2 class="nd_learning_section nd_learning_margin_0"><?php _e('Reviews','nd-learning'); ?></h2>
                      <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_10"><?php _e('Public reviews for each order','nd-learning'); ?>. <a target="_blank" href="https://goo.gl/wwajOn"><?php _e('View Demo','nd-learning'); ?></a></p>
                    </td>
                    
                    <td class="nd_learning_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_learning_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>



                  <tr>
                    <td>
                      <h2 class="nd_learning_section nd_learning_margin_0"><?php _e('Print Feature','nd-learning'); ?></h2>
                      <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_10"><?php _e('Print all single course page','nd-learning'); ?>. <a target="_blank" href="https://goo.gl/wwajOn"><?php _e('View Demo','nd-learning'); ?></a></p>
                    </td>
                    
                    <td class="nd_learning_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_learning_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>


                  <tr>
                    <td>
                      <h2 class="nd_learning_section nd_learning_margin_0"><?php _e('Bookmark','nd-learning'); ?></h2>
                      <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_10"><?php _e('Add best courses to your custom list','nd-learning'); ?>. <a target="_blank" href="https://goo.gl/wwajOn"><?php _e('View Demo','nd-learning'); ?></a></p>
                    </td>
                    
                    <td class="nd_learning_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-not.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_learning_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>


                  <tr>
                    <td>
                      <h2 class="nd_learning_section nd_learning_margin_0"><?php _e('Compare','nd-learning'); ?></h2>
                      <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_10"><?php _e('Compare your best courses','nd-learning'); ?>. <a target="_blank" href="https://goo.gl/wwajOn"><?php _e('View Demo','nd-learning'); ?></a></p>
                    </td>
                    
                    <td class="nd_learning_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-not.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_learning_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>



                  <tr>
                    <td>
                      <h2 class="nd_learning_section nd_learning_margin_0"><?php _e('Share','nd-learning'); ?></h2>
                      <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_10"><?php _e('Share buttons for all social network','nd-learning'); ?>. <a target="_blank" href="https://goo.gl/wwajOn"><?php _e('View Demo','nd-learning'); ?></a></p>
                    </td>
                    
                    <td class="nd_learning_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-not.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_learning_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>



                  <tr>
                    <td>
                      <h2 class="nd_learning_section nd_learning_margin_0"><?php _e('Calendar','nd-learning'); ?></h2>
                      <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_10"><?php _e('Calendar view for single course','nd-learning'); ?>. <a target="_blank" href="https://goo.gl/wwajOn"><?php _e('View Demo','nd-learning'); ?></a></p>
                    </td>
                    
                    <td class="nd_learning_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-not.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_learning_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>



                  <tr>
                    <td>
                      <h2 class="nd_learning_section nd_learning_margin_0"><?php _e('Visual Composer','nd-learning'); ?></h2>
                      <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_10"><?php _e('Add some custom components/shortcodes for create your pages','nd-learning'); ?>. <a target="_blank" href="https://goo.gl/wwajOn"><?php _e('View Demo','nd-learning'); ?></a></p>
                    </td>
                    
                    <td class="nd_learning_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-not.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_learning_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>


                  <tr>
                    <td>
                      <h2 class="nd_learning_section nd_learning_margin_0"><?php _e('Follower','nd-learning'); ?></h2>
                      <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_10"><?php _e('Follower feature on single teacher page','nd-learning'); ?>. <a target="_blank" href="https://goo.gl/wwajOn"><?php _e('View Demo','nd-learning'); ?></a></p>
                    </td>
                    
                    <td class="nd_learning_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-not.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_learning_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>



                  <tr>
                    <td>
                      <h2 class="nd_learning_section nd_learning_margin_0"><?php _e('Documents','nd-learning'); ?></h2>
                      <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_10"><?php _e('Manage all attached documents and course program','nd-learning'); ?>. <a target="_blank" href="https://goo.gl/wwajOn"><?php _e('View Demo','nd-learning'); ?></a></p>
                    </td>
                    
                    <td class="nd_learning_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-not.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_learning_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>



                  <tr>
                    <td>
                      <h2 class="nd_learning_section nd_learning_margin_0"><?php _e('Comments','nd-learning'); ?></h2>
                      <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_10"><?php _e('Add comments on single course page','nd-learning'); ?>. <a target="_blank" href="https://goo.gl/wwajOn"><?php _e('View Demo','nd-learning'); ?></a></p>
                    </td>
                    
                    <td class="nd_learning_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-not.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_learning_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>






                </tbody>

              </table>




          </div>
          <!--END-->


          


        </div>
        <!--END content-->


      </div>

    </div>

  <?php } 
  /*END 1*/

}



