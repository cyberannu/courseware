<?php


add_action('admin_menu','nd_learning_add_settings_menu_import_export');
function nd_learning_add_settings_menu_import_export(){

  add_submenu_page( 'nd-learning-settings','Import Export', __('Import Export','nd-learning'), 'manage_options', 'nd-learning-settings-import-export', 'nd_learning_settings_menu_import_export' );

}



function nd_learning_settings_menu_import_export() {

  //ajax results
  $nd_learning_import_settings_params = array(
      'nd_learning_ajaxurl_import_settings' => admin_url('admin-ajax.php'),
      'nd_learning_ajaxnonce_import_settings' => wp_create_nonce('nd_learning_import_settings_nonce'),
  );

  wp_enqueue_script( 'nd_learning_import_sett', esc_url( plugins_url( 'js/nd_learning_import_settings.js', __FILE__ ) ), array( 'jquery' ) ); 
  wp_localize_script( 'nd_learning_import_sett', 'nd_learning_my_vars_import_settings', $nd_learning_import_settings_params ); 

?>

  
  <div class="nd_learning_section nd_learning_padding_right_20 nd_learning_padding_left_2 nd_learning_box_sizing_border_box nd_learning_margin_top_25 ">

    

    <div style="background-color:<?php echo nd_learning_get_profile_bg_color(0); ?>; border-bottom:3px solid <?php echo nd_learning_get_profile_bg_color(2); ?>;" class="nd_learning_section nd_learning_padding_20  nd_learning_box_sizing_border_box">
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
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-learning-booking-settings'); ?>"><?php _e('Paypal Settings','nd-learning'); ?></a></li>
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-learning-free-orders-page'); ?>"><?php _e('Free Orders','nd-learning'); ?></a></li>
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-learning-premium-orders-page'); ?>"><?php _e('Premium Orders','nd-learning'); ?></a></li>
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-learning-reviews-page'); ?>"><?php _e('Reviews List','nd-learning'); ?></a></li>
          <li><a style="background-color:<?php echo nd_learning_get_profile_bg_color(2); ?>;" class="" href="" ><?php _e('Import Export','nd-learning'); ?></a></li>
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
            <h2 class="nd_learning_section nd_learning_margin_0"><?php _e('Import/Export','nd-learning'); ?></h2>
            <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_10"><?php _e('Export or Import your theme options.','nd-learning'); ?></p>
          </div>
        </div>
        <!--END-->

        <div class="nd_learning_section nd_learning_height_1 nd_learning_background_color_E7E7E7 nd_learning_margin_top_10 nd_learning_margin_bottom_10"></div>


        <?php


          $nd_learning_all_options = wp_load_alloptions();
          $nd_learning_my_options  = array();

          $nd_learning_name_write = '';
           
          foreach ( $nd_learning_all_options as $nd_learning_name => $nd_learning_value ) {
              if ( stristr( $nd_learning_name, 'nd_learning_' ) ) {
                  
                $nd_learning_my_options[ $nd_learning_name ] = $nd_learning_value;
                $nd_learning_name_write .= $nd_learning_name.'[nd_learning_option_value]'.$nd_learning_value.'[nd_learning_end_option]';

              }
          }

          $nd_learning_name_write_new = str_replace(" ", "%20", $nd_learning_name_write);
           
        ?>


        <!--START-->
        <div class="nd_learning_section">
          <div class="nd_learning_width_40_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
            <h2 class="nd_learning_section nd_learning_margin_0"><?php _e('Export Settings','nd-learning'); ?></h2>
            <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_10"><?php _e('Export Nd Shortcodes and customizer options.','nd-learning'); ?></p>
          </div>
          <div class="nd_learning_width_60_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
            
            <div class="nd_learning_section nd_learning_padding_left_20 nd_learning_padding_right_20 nd_learning_box_sizing_border_box">
              
                <a class="button button-primary" href="data:application/octet-stream;charset=utf-8,<?php echo $nd_learning_name_write_new; ?>" download="nd-learning-export.txt"><?php _e('Export','nd-learning'); ?></a>
              
            </div>

          </div>
        </div>
        <!--END-->

        
        <div class="nd_learning_section nd_learning_height_1 nd_learning_background_color_E7E7E7 nd_learning_margin_top_10 nd_learning_margin_bottom_10"></div>

        

        <!--START-->
        <div class="nd_learning_section">
          <div class="nd_learning_width_40_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
            <h2 class="nd_learning_section nd_learning_margin_0"><?php _e('Import Settings','nd-learning'); ?></h2>
            <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_10"><?php _e('Paste in the textarea the text of your export file','nd-learning'); ?></p>
          </div>
          <div class="nd_learning_width_60_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
            
            <div class="nd_learning_section nd_learning_padding_left_20 nd_learning_padding_right_20 nd_learning_box_sizing_border_box">
              
                <textarea id="nd_learning_import_settings" class="nd_learning_margin_bottom_20 nd_learning_width_100_percentage" name="nd_learning_import_settings" rows="10"><?php echo esc_attr( get_option('nd_learning_textarea') ); ?></textarea>
                
                <a onclick="nd_learning_import_settings()" class="button button-primary"><?php _e('Import','nd-learning'); ?></a>

                <div class="nd_learning_margin_top_20 nd_learning_section" id="nd_learning_import_settings_result_container"></div>
                
            </div>

          </div>
        </div>
        <!--END-->


      </div>
      <!--END content-->


    </div>

  </div>

<?php } 
/*END 1*/







//START nd_learning_import_settings_php_function for AJAX
function nd_learning_import_settings_php_function() {

  check_ajax_referer( 'nd_learning_import_settings_nonce', 'nd_learning_import_settings_security' );

  //recover datas
  $nd_learning_value_import_settings = sanitize_text_field($_GET['nd_learning_value_import_settings']);

  $nd_learning_import_settings_result .= '';



  //START import and update options only if is superadmin
  if ( current_user_can('manage_options') ) {


    if ( $nd_learning_value_import_settings != '' ) {

      $nd_learning_array_options = explode("[nd_learning_end_option]", $nd_learning_value_import_settings);

      foreach ($nd_learning_array_options as $nd_learning_array_option) {
          
        $nd_learning_array_single_option = explode("[nd_learning_option_value]", $nd_learning_array_option);
        $nd_learning_option = $nd_learning_array_single_option[0];
        $nd_learning_new_value = $nd_learning_array_single_option[1];

        if ( $nd_learning_new_value != '' ){


          //START update option only it contains the plugin suffix
          if ( strpos($nd_learning_option, 'nd_learning_') !== false ) {


            $nd_learning_update_result = update_option($nd_learning_option,$nd_learning_new_value);  

            if ( $nd_learning_update_result == 1 ) {
              $nd_learning_import_settings_result .= '

                <div class="notice updated is-dismissible nd_learning_margin_0_important">
                  <p>'.__('Updated option','nd-learning').' "'.$nd_learning_option.'" '.__('with','nd-learning').' '.$nd_learning_new_value.'.</p>
                </div>

                ';

            }else{
              $nd_learning_import_settings_result .= '

                <div class="notice updated is-dismissible nd_learning_margin_0_important">
                  <p>'.__('Updated option','nd-learning').' "'.$nd_learning_option.'" '.__('with the same value','nd-learning').'.</p>
                </div>

              ';    
            }


          }else{

            $nd_learning_import_settings_result .= '
              <div class="notice notice-error is-dismissible nd_learning_margin_0">
                <p>'.__('You do not have permission to change this option','nd-learning').'</p>
              </div>
            '; 

          }
          //END update option only it contains the plugin suffix


        }else{

          if ( $nd_learning_option != '' ){
            $nd_learning_import_settings_result .= '

          <div class="notice notice-warning is-dismissible nd_learning_margin_0">
            <p>'.__('No value founded for','nd-learning').' "'.$nd_learning_option.'" '.__('option.','nd-learning').'</p>
          </div>
          ';
          }

          
        }
        
      }

    }else{

      $nd_learning_import_settings_result .= '
        <div class="notice notice-error is-dismissible nd_learning_margin_0">
          <p>'.__('Empty textarea, please paste your export options.','nd-learning').'</p>
        </div>
      ';

    }


  }else{

    $nd_learning_import_settings_result .= '
      <div class="notice notice-error is-dismissible nd_learning_margin_0">
        <p>'.__('You do not have the privileges to do this.','nd-learning').'</p>
      </div>
    '; 

  }
  //END import and update options only if is superadmin


  
  echo $nd_learning_import_settings_result;

  die();


}
add_action( 'wp_ajax_nd_learning_import_settings_php_function', 'nd_learning_import_settings_php_function' );
//END