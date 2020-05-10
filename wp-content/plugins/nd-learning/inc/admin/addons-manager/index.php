<?php


if ( get_option('nicdark_theme_author') == 1 ){
   
add_action('admin_menu','nd_learning_add_settings_menu_addons');
function nd_learning_add_settings_menu_addons(){

  add_submenu_page( 'nd-learning-settings','Addons Manager', __('Addons Manager','nd-learning'), 'manage_options', 'nd-learning-settings-addons-manager', 'nd_learning_settings_menu_addons_manager' );
  add_action( 'admin_init', 'nd_learning_addons_settings' );

}


function nd_learning_addons_settings() {
  register_setting( 'nd_learning_addons_settings_group', 'nd_learning_bookmark_enable' );
  register_setting( 'nd_learning_addons_settings_group', 'nd_learning_compare_enable' );
  register_setting( 'nd_learning_addons_settings_group', 'nd_learning_visualcomposer_enable' );
  register_setting( 'nd_learning_addons_settings_group', 'nd_learning_calendar_enable' );
  register_setting( 'nd_learning_addons_settings_group', 'nd_learning_comments_enable' );
  register_setting( 'nd_learning_addons_settings_group', 'nd_learning_documents_enable' );
  register_setting( 'nd_learning_addons_settings_group', 'nd_learning_googlecalendar_enable' );
  register_setting( 'nd_learning_addons_settings_group', 'nd_learning_relatedcourse_enable' );
  register_setting( 'nd_learning_addons_settings_group', 'nd_learning_share_enable' );
  register_setting( 'nd_learning_addons_settings_group', 'nd_learning_follower_enable' );
}


function nd_learning_settings_menu_addons_manager() { ?>


<form method="post" action="options.php">
    
  <?php settings_fields( 'nd_learning_addons_settings_group' ); ?>
  <?php do_settings_sections( 'nd_learning_addons_settings_group' ); ?>
  
  <div class="nd_learning_section nd_learning_padding_right_20 nd_learning_padding_left_2 nd_learning_box_sizing_border_box nd_learning_margin_top_25 ">

    

    <div style="background-color:<?php echo nd_learning_get_profile_bg_color(0); ?>; border-bottom:3px solid <?php echo nd_learning_get_profile_bg_color(2); ?>;" class="nd_learning_section nd_learning_padding_20  nd_learning_box_sizing_border_box">
      <h2 class="nd_learning_color_ffffff nd_learning_display_inline_block"><?php _e('ND Learning','nd-learning'); ?></h2><span class="nd_learning_margin_left_10 nd_learning_color_a0a5aa"><?php echo nd_learning_get_plugin_version(); ?></span>
    </div>

    

    <div class="nd_learning_section  nd_learning_box_shadow_0_1_1_000_04 nd_learning_background_color_ffffff nd_learning_border_1_solid_e5e5e5 nd_learning_border_top_width_0 nd_learning_border_left_width_0 nd_learning_overflow_hidden nd_learning_position_relative">
    
      <!--START menu-->
      <div style="background-color:<?php echo nd_learning_get_profile_bg_color(1); ?>;" class="nd_learning_width_20_percentage nd_learning_float_left nd_learning_box_sizing_border_box nd_learning_min_height_3000 nd_learning_position_absolute">

        <ul class="nd_learning_navigation">
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-learning-settings'); ?>"><?php _e('Plugin Settings','nd-learning'); ?></a></li>
          <li><a style="background-color:<?php echo nd_learning_get_profile_bg_color(2); ?>;" class="" href="" ><?php _e('Addons Manager','nd-learning'); ?></a></li>
          <li><a class="" href="<?php echo admin_url('customize.php'); ?>"><?php _e('Customizer','nd-learning'); ?></a></li>
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-learning-booking-settings'); ?>"><?php _e('Paypal Settings','nd-learning'); ?></a></li>
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-learning-free-orders-page'); ?>"><?php _e('Free Orders','nd-learning'); ?></a></li>
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-learning-premium-orders-page'); ?>"><?php _e('Premium Orders','nd-learning'); ?></a></li>
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-learning-reviews-page'); ?>"><?php _e('Reviews List','nd-learning'); ?></a></li>
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-learning-settings-import-export'); ?>" ><?php _e('Import Export','nd-learning'); ?></a></li>
          <li><a target="_blank" href="http://documentations.nicdark.com/"><?php _e('Documentation','nd-learning'); ?></a></li>
        </ul>
      </div>
      <!--END menu-->


      <!--START content-->
      <div class="nd_learning_width_80_percentage nd_learning_margin_left_20_percentage nd_learning_float_left nd_learning_box_sizing_border_box nd_learning_padding_20">


        <!--START-->
        <div class="nd_learning_section">
          <div class="nd_learning_width_40_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
            <h2 class="nd_learning_section nd_learning_margin_0"><?php _e('Addons Manager','nd-learning'); ?></h2>
            <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_10"><?php _e('Here you can remove some plugins addons.','nd-learning'); ?></p>
          </div>
        </div>
        <!--END-->

        <div class="nd_learning_section nd_learning_height_1 nd_learning_background_color_E7E7E7 nd_learning_margin_top_10 nd_learning_margin_bottom_10"></div>


         <!--START-->
        <div class="nd_learning_section">
          <div class="nd_learning_width_40_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
            <h2 class="nd_learning_section nd_learning_margin_0"><?php _e('Main Addons','nd-learning'); ?></h2>
            <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_10"><?php _e('Manage your main addons','nd-learning'); ?></p>
          </div>
          <div class="nd_learning_width_60_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
            
            <label class="nd_learning_section"><input <?php if( get_option('nd_learning_bookmark_enable') == 1 ) { echo 'checked="checked"'; } ?> name="nd_learning_bookmark_enable" type="checkbox" value="1"> <?php _e('Bookmark','nd-learning'); ?></label>
            <div class="nd_learning_section nd_learning_height_10"></div>
            <label class="nd_learning_section"><input <?php if( get_option('nd_learning_compare_enable') == 1 ) { echo 'checked="checked"'; } ?> name="nd_learning_compare_enable" type="checkbox" value="1"> <?php _e('Compare','nd-learning'); ?></label>
            <div class="nd_learning_section nd_learning_height_10"></div>
            <label class="nd_learning_section"><input <?php if( get_option('nd_learning_visualcomposer_enable') == 1 ) { echo 'checked="checked"'; } ?> name="nd_learning_visualcomposer_enable" type="checkbox" value="1"> <?php _e('Visual Composer Components','nd-learning'); ?></label>

          </div>
        </div>
        <!--END-->
        <div class="nd_learning_section nd_learning_height_1 nd_learning_background_color_E7E7E7 nd_learning_margin_top_10 nd_learning_margin_bottom_10"></div>




        <!--START-->
        <div class="nd_learning_section">
          <div class="nd_learning_width_40_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
            <h2 class="nd_learning_section nd_learning_margin_0"><?php _e('Single Course','nd-learning'); ?></h2>
            <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_10"><?php _e('These Addons works only on single course page','nd-learning'); ?></p>
          </div>
          <div class="nd_learning_width_60_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
            
            <label class="nd_learning_section"><input <?php if( get_option('nd_learning_calendar_enable') == 1 ) { echo 'checked="checked"'; } ?> name="nd_learning_calendar_enable" type="checkbox" value="1"> <?php _e('Calendar','nd-learning'); ?></label>
            <div class="nd_learning_section nd_learning_height_10"></div>
            <label class="nd_learning_section"><input <?php if( get_option('nd_learning_comments_enable') == 1 ) { echo 'checked="checked"'; } ?> name="nd_learning_comments_enable" type="checkbox" value="1"> <?php _e('Comments','nd-learning'); ?></label>
            <div class="nd_learning_section nd_learning_height_10"></div>
            <label class="nd_learning_section"><input <?php if( get_option('nd_learning_documents_enable') == 1 ) { echo 'checked="checked"'; } ?> name="nd_learning_documents_enable" type="checkbox" value="1"> <?php _e('Documents','nd-learning'); ?></label>
            <div class="nd_learning_section nd_learning_height_10"></div>
            <label class="nd_learning_section"><input <?php if( get_option('nd_learning_googlecalendar_enable') == 1 ) { echo 'checked="checked"'; } ?> name="nd_learning_googlecalendar_enable" type="checkbox" value="1"> <?php _e('Google Calendar','nd-learning'); ?></label>
            <div class="nd_learning_section nd_learning_height_10"></div>
            <label class="nd_learning_section"><input <?php if( get_option('nd_learning_relatedcourse_enable') == 1 ) { echo 'checked="checked"'; } ?> name="nd_learning_relatedcourse_enable" type="checkbox" value="1"> <?php _e('Related Courses','nd-learning'); ?></label>
            <div class="nd_learning_section nd_learning_height_10"></div>
            <label class="nd_learning_section"><input <?php if( get_option('nd_learning_share_enable') == 1 ) { echo 'checked="checked"'; } ?> name="nd_learning_share_enable" type="checkbox" value="1"> <?php _e('Share','nd-learning'); ?></label>

          </div>
        </div>
        <!--END-->
        <div class="nd_learning_section nd_learning_height_1 nd_learning_background_color_E7E7E7 nd_learning_margin_top_10 nd_learning_margin_bottom_10"></div>



        <!--START-->
        <div class="nd_learning_section">
          <div class="nd_learning_width_40_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
            <h2 class="nd_learning_section nd_learning_margin_0"><?php _e('Teacher Addons','nd-learning'); ?></h2>
            <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_10"><?php _e('Addons that works on single teacher page','nd-learning'); ?></p>
          </div>
          <div class="nd_learning_width_60_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
            
            <label class="nd_learning_section"><input <?php if( get_option('nd_learning_follower_enable') == 1 ) { echo 'checked="checked"'; } ?> name="nd_learning_follower_enable" type="checkbox" value="1"> <?php _e('Follower','nd-learning'); ?></label>

          </div>
        </div>
        <!--END-->
        <div class="nd_learning_section nd_learning_height_1 nd_learning_background_color_E7E7E7 nd_learning_margin_top_10 nd_learning_margin_bottom_10"></div>




        <div class="nd_learning_section nd_learning_padding_left_20 nd_learning_padding_right_20 nd_learning_box_sizing_border_box">
          <?php submit_button(); ?>
        </div>



      </div>
      <!--END content-->


    </div>

  </div>
</form>


<?php } 
/*END 1*/

}
