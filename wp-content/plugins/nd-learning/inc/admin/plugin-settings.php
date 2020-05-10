<?php


//START add custom css
function nd_learning_admin_style() {
  
  wp_enqueue_style( 'nd_learning_admin_style', esc_url(plugins_url('admin-style.css', __FILE__ )), array(), false, false );
  
}
add_action( 'admin_enqueue_scripts', 'nd_learning_admin_style' );
//END add custom css



///////////////////////////////////////////////////PAGE MENU SETTINGS ///////////////////////////////////////////////////////////////
add_action('admin_menu', 'nd_learning_create_menu');
function nd_learning_create_menu() {
  
  add_menu_page('Learning Plugin', __('Learning Plugin','nd-learning'), 'manage_options', 'nd-learning-settings', 'nd_learning_settings_page', 'dashicons-admin-generic' );
  add_action( 'admin_init', 'nd_learning_settings' );

  //custom hook
  do_action("nd_learning_add_menu_settings");

}

function nd_learning_settings() {
  register_setting( 'nd_learning_settings_group', 'nd_learning_currency' );
  register_setting( 'nd_learning_settings_group', 'nd_learning_account_page' );
  register_setting( 'nd_learning_settings_group', 'nd_learning_container' );

  //custom hook
  do_action("nd_learning_add_settings_group");
}

function nd_learning_settings_page() {
?>


<form method="post" action="options.php">
    
  <?php settings_fields( 'nd_learning_settings_group' ); ?>
  <?php do_settings_sections( 'nd_learning_settings_group' ); ?>


  <div class="nd_learning_section nd_learning_padding_right_20 nd_learning_padding_left_2 nd_learning_box_sizing_border_box nd_learning_margin_top_25 ">

    

    <div style="background-color:<?php echo nd_learning_get_profile_bg_color(0); ?>; border-bottom:3px solid <?php echo nd_learning_get_profile_bg_color(2); ?>;" class="nd_learning_section nd_learning_padding_20 nd_learning_box_sizing_border_box">
      <h2 class="nd_learning_color_ffffff nd_learning_display_inline_block"><?php _e('ND Learning','nd-learning'); ?></h2><span class="nd_learning_margin_left_10 nd_learning_color_a0a5aa"><?php echo nd_learning_get_plugin_version(); ?></span>
    </div>

    

    <div class="nd_learning_section  nd_learning_box_shadow_0_1_1_000_04 nd_learning_background_color_ffffff nd_learning_border_1_solid_e5e5e5 nd_learning_border_top_width_0 nd_learning_border_left_width_0 nd_learning_overflow_hidden nd_learning_position_relative">
    
      <!--START menu-->
      <div style="background-color:<?php echo nd_learning_get_profile_bg_color(1); ?>;" class="nd_learning_width_20_percentage nd_learning_float_left nd_learning_box_sizing_border_box nd_learning_min_height_3000 nd_learning_position_absolute">

        <ul class="nd_learning_navigation">
          <li><a style="background-color:<?php echo nd_learning_get_profile_bg_color(2); ?>;" class="" href="#"><?php _e('Plugin Settings','nd-learning'); ?></a></li>
          
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
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-learning-settings-import-export'); ?>"><?php _e('Import Export','nd-learning'); ?></a></li>
          <li><a target="_blank" href="http://documentations.nicdark.com/"><?php _e('Documentation','nd-learning'); ?></a></li>
        
          <?php 

          if ( get_option('nicdark_theme_author') != 1 ){ ?>

            <li><a style="background-color:<?php echo nd_learning_get_profile_bg_color(2); ?>;" class="" href="<?php echo admin_url('admin.php?page=nd-learning-settings-premium-addons'); ?>" ><?php _e('Premium Addons','nd-learning'); ?></a></li>

          <?php }
          
          ?>
          

        </ul>
      </div>
      <!--END menu-->


      <!--START content-->
      <div class="nd_learning_width_80_percentage nd_learning_margin_left_20_percentage nd_learning_float_left nd_learning_box_sizing_border_box nd_learning_padding_20">


        <!--START-->
        <div class="nd_learning_section">
          <div class="nd_learning_width_40_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
            <h2 class="nd_learning_section nd_learning_margin_0"><?php _e('Plugin Settings','nd-learning'); ?></h2>
            <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_10"><?php _e('Below some important plugin settings.','nd-learning'); ?></p>
          </div>
        </div>
        <!--END-->
        <div class="nd_learning_section nd_learning_height_1 nd_learning_background_color_E7E7E7 nd_learning_margin_top_10 nd_learning_margin_bottom_10"></div>

        


        <!--START-->
        <div class="nd_learning_section">
          <div class="nd_learning_width_40_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
            <h2 class="nd_learning_section nd_learning_margin_0"><?php _e('Currency','nd-learning'); ?></h2>
            <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_10"><?php _e('Plugin Currency','nd-learning'); ?></p>
          </div>
          <div class="nd_learning_width_60_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
            
            <input class="nd_learning_width_100_percentage" type="text" name="nd_learning_currency" value="<?php echo esc_attr( get_option('nd_learning_currency') ); ?>" />
            <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_20"><?php _e('Insert the currency. Eg: $','nd-learning'); ?></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_learning_section nd_learning_height_1 nd_learning_background_color_E7E7E7 nd_learning_margin_top_10 nd_learning_margin_bottom_10"></div>


        <!--START-->
        <div class="nd_learning_section">
          <div class="nd_learning_width_40_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
            <h2 class="nd_learning_section nd_learning_margin_0"><?php _e('Container','nd-learning'); ?></h2>
            <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_10"><?php _e('Remove default container','nd-learning'); ?></p>
          </div>
          <div class="nd_learning_width_60_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
            
            <input <?php if( get_option('nd_learning_container') == 1 ) { echo 'checked="checked"'; } ?> name="nd_learning_container" type="checkbox" value="1">
            <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_20"><?php _e('If your theme does not need the default container of 1200px in template pages you can remove it by flagging the checkbox.','nd-learning'); ?></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_learning_section nd_learning_height_1 nd_learning_background_color_E7E7E7 nd_learning_margin_top_10 nd_learning_margin_bottom_10"></div>


        


        <!--START-->
        <div class="nd_learning_section">
          <div class="nd_learning_width_40_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
            <h2 class="nd_learning_section nd_learning_margin_0"><?php _e('Account Page','nd-learning'); ?></h2>
            <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_10"><?php _e('Select your account page','nd-learning'); ?></p>
          </div>
          <div class="nd_learning_width_60_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
            
            <select class="nd_learning_width_100_percentage" name="nd_learning_account_page">
              <?php $nd_learning_pages = get_pages(); ?>
              <?php foreach ($nd_learning_pages as $nd_learning_page) : ?>
                  <option

                  <?php 
                    if( get_option('nd_learning_account_page') == $nd_learning_page->ID ) { 
                      echo 'selected="selected"';
                    } 
                  ?>

                   value="<?php echo $nd_learning_page->ID; ?>">
                      <?php echo $nd_learning_page->post_title; ?>
                  </option>
              <?php endforeach; ?>
            </select>
            <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_20"><?php _e('Select the page where you have added the shortcode [nd_learning_account]','nd-learning'); ?></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_learning_section nd_learning_height_1 nd_learning_background_color_E7E7E7 nd_learning_margin_top_10 nd_learning_margin_bottom_10"></div>


        <?php do_action("nd_learning_add_main_settings_row"); ?>


        <div class="nd_learning_section nd_learning_padding_left_20 nd_learning_padding_right_20 nd_learning_box_sizing_border_box">
          <?php submit_button(); ?>
        </div>
      


      </div>
      <!--END content-->


    </div>

  </div>
</form>

<?php } 
//END 



//include all options
foreach ( glob ( plugin_dir_path( __FILE__ ) . "*/index.php" ) as $file ){
  include_once $file;
}