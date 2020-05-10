<?php


//ADD settings group
add_action('nd_learning_add_settings_group','nd_learning_add_settings_group_checkout');
function nd_learning_add_settings_group_checkout(){

  register_setting( 'nd_learning_settings_group', 'nd_learning_checkout_page' );

}


//ADD row on settings group
add_action('nd_learning_add_main_settings_row','nd_learning_add_main_settings_row_checkout');
function nd_learning_add_main_settings_row_checkout(){ ?>


  <!--START-->
  <div class="nd_learning_section">
    <div class="nd_learning_width_40_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
      <h2 class="nd_learning_section nd_learning_margin_0"><?php _e('Checkout Page','nd-learning'); ?></h2>
      <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_10"><?php _e('Select your checkout page','nd-learning'); ?></p>
    </div>
    <div class="nd_learning_width_60_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
      
      <select class="nd_learning_width_100_percentage" name="nd_learning_checkout_page">
        <?php $nd_learning_pages = get_pages(); ?>
        <?php foreach ($nd_learning_pages as $nd_learning_page) : ?>
            <option

            <?php 
              if( get_option('nd_learning_checkout_page') == $nd_learning_page->ID ) { 
                echo 'selected="selected"';
              } 
            ?>

             value="<?php echo $nd_learning_page->ID; ?>">
                <?php echo $nd_learning_page->post_title; ?>
            </option>
        <?php endforeach; ?>
      </select>
      <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_20"><?php _e('Select the page where you have added the shortcode [nd_learning_checkout]','nd-learning'); ?></p>

    </div>
  </div>
  <!--END-->
  <div class="nd_learning_section nd_learning_height_1 nd_learning_background_color_E7E7E7 nd_learning_margin_top_10 nd_learning_margin_bottom_10"></div>

<?php
}



///////////////////////////////////////////////////PAGE MENU SETTINGS ///////////////////////////////////////////////////////////////

add_action('nd_learning_add_menu_settings','nd_learning_add_booking_settings');
function nd_learning_add_booking_settings(){

  add_submenu_page( 'nd-learning-settings','ND Booking', __('Paypal Settings','nd-learning'), 'manage_options', 'nd-learning-booking-settings', 'nd_learning_paypal_page' );
  add_action( 'admin_init', 'nd_learning_paypal_settings' );

}


function nd_learning_paypal_settings() {
  register_setting( 'nd_learning_paypal_settings_group', 'nd_learning_paypal_developer' );
  register_setting( 'nd_learning_paypal_settings_group', 'nd_learning_paypal_email' );
  register_setting( 'nd_learning_paypal_settings_group', 'nd_learning_paypal_token' );
  register_setting( 'nd_learning_paypal_settings_group', 'nd_learning_paypal_currency' );
}


function nd_learning_paypal_page() {
?>
<form method="post" action="options.php">
    
  <?php settings_fields( 'nd_learning_paypal_settings_group' ); ?>
  <?php do_settings_sections( 'nd_learning_paypal_settings_group' ); ?>


  <div class="nd_learning_section nd_learning_padding_right_20 nd_learning_padding_left_2 nd_learning_box_sizing_border_box nd_learning_margin_top_25 ">

    

    <div style="background-color:<?php echo nd_learning_get_profile_bg_color(0); ?>; border-bottom:3px solid <?php echo nd_learning_get_profile_bg_color(2); ?>;" class="nd_learning_section nd_learning_padding_20 nd_learning_box_sizing_border_box">
      <h2 class="nd_learning_color_ffffff nd_learning_display_inline_block"><?php _e('ND Learning','nd-learning'); ?></h2><span class="nd_learning_margin_left_10 nd_learning_color_a0a5aa"><?php echo nd_learning_get_plugin_version(); ?></span>
    </div>

    

    <div class="nd_learning_section  nd_learning_box_shadow_0_1_1_000_04 nd_learning_background_color_ffffff nd_learning_border_1_solid_e5e5e5 nd_learning_border_top_width_0 nd_learning_border_left_width_0 nd_learning_overflow_hidden nd_learning_position_relative">
    
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
          <li><a style="background-color:<?php echo nd_learning_get_profile_bg_color(2); ?>;" class="" href=""><?php _e('Paypal Settings','nd-learning'); ?></a></li>
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
            <h2 class="nd_learning_section nd_learning_margin_0"><?php _e('Paypal Settings','nd-learning'); ?></h2>
            <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_10"><?php _e('Below some important paypal settings.','nd-learning'); ?></p>
          </div>
        </div>
        <!--END-->
        <div class="nd_learning_section nd_learning_height_1 nd_learning_background_color_E7E7E7 nd_learning_margin_top_10 nd_learning_margin_bottom_10"></div>

        


        <!--START-->
        <div class="nd_learning_section">
          <div class="nd_learning_width_40_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
            <h2 class="nd_learning_section nd_learning_margin_0"><?php _e('Developer Mode','nd-learning'); ?></h2>
            <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_10"><?php _e('Enable developer mode','nd-learning'); ?></p>
          </div>
          <div class="nd_learning_width_60_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
            
            <input <?php if( get_option('nd_learning_paypal_developer') == 1 ) { echo 'checked="checked"'; } ?> name="nd_learning_paypal_developer" type="checkbox" value="1">
            <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_20"><?php _e('Check to use paypal in developer mode , more information','nd-learning'); ?> <a target="_blank" href="https://developer.paypal.com/docs/classic/lifecycle/sb_about-accounts/"><?php _e('HERE','nd-learning'); ?></a></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_learning_section nd_learning_height_1 nd_learning_background_color_E7E7E7 nd_learning_margin_top_10 nd_learning_margin_bottom_10"></div>



        <!--START-->
        <div class="nd_learning_section">
          <div class="nd_learning_width_40_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
            <h2 class="nd_learning_section nd_learning_margin_0"><?php _e('Email','nd-learning'); ?></h2>
            <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_10"><?php _e('Insert your paypal email','nd-learning'); ?></p>
          </div>
          <div class="nd_learning_width_60_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
            
            <input class="regular-text" type="text" name="nd_learning_paypal_email" value="<?php echo esc_attr( get_option('nd_learning_paypal_email') ); ?>" />
            <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_20"><?php _e('Insert your paypal email of your business account','nd-learning'); ?></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_learning_section nd_learning_height_1 nd_learning_background_color_E7E7E7 nd_learning_margin_top_10 nd_learning_margin_bottom_10"></div>




        <!--START-->
        <div class="nd_learning_section">
          <div class="nd_learning_width_40_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
            <h2 class="nd_learning_section nd_learning_margin_0"><?php _e('PDT identity token','nd-learning'); ?></h2>
            <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_10"><?php _e('Insert paypal api token','nd-learning'); ?></p>
          </div>
          <div class="nd_learning_width_60_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
            
            <input class="regular-text" type="text" name="nd_learning_paypal_token" value="<?php echo esc_attr( get_option('nd_learning_paypal_token') ); ?>" />
            <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_20"><?php _e('Insert your PDT identity token , more information','nd-learning'); ?> <a target="_blank" href="https://developer.paypal.com/docs/classic/paypal-payments-standard/integration-guide/paymentdatatransfer/"><?php _e('HERE','nd-learning'); ?></a> <?php _e('section Activating PDT','nd-learning'); ?></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_learning_section nd_learning_height_1 nd_learning_background_color_E7E7E7 nd_learning_margin_top_10 nd_learning_margin_bottom_10"></div>




        <!--START-->
        <div class="nd_learning_section">
          <div class="nd_learning_width_40_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
            <h2 class="nd_learning_section nd_learning_margin_0"><?php _e('Currency','nd-learning'); ?></h2>
            <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_10"><?php _e('Set your paypal currency','nd-learning'); ?></p>
          </div>
          <div class="nd_learning_width_60_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
            
            <select class="nd_learning_width_100_percentage" name="nd_learning_paypal_currency">
              <?php $nd_learning_currencies = array(
                
                "AUD","BRL","CAD","CZK","DKK","EUR","HKD","HUF","ILS","JPY","MYR","MXN","NOK","NZD","PHP","PLN","GBP","RUB","SGD","SEK","CHF","TWD","THB","TRY","USD"

                ); ?>
              <?php foreach ($nd_learning_currencies as $nd_learning_currency) : ?>
                  <option 

                  <?php 
                    if( get_option('nd_learning_paypal_currency') == $nd_learning_currency ) { 
                      echo 'selected="selected"';
                    } 
                  ?>

                  value="<?php echo $nd_learning_currency; ?>">
                      <?php echo $nd_learning_currency; ?>
                  </option>
              <?php endforeach; ?>
            </select>
            <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_20"><?php _e('Select your Currency, more information','nd-learning'); ?> <a target="_blank" href="https://developer.paypal.com/docs/classic/api/currency_codes/"><?php _e('HERE','nd-learning'); ?></a></p>

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
//END 