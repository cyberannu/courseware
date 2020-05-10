<?php


//ADD settings group
add_action('nd_learning_add_settings_group','nd_learning_add_settings_group_order');
function nd_learning_add_settings_group_order(){

  register_setting( 'nd_learning_settings_group', 'nd_learning_order_page' );

}


//ADD row on settings group
add_action('nd_learning_add_main_settings_row','nd_learning_add_main_settings_row_order');
function nd_learning_add_main_settings_row_order(){ ?>


  <!--START-->
  <div class="nd_learning_section">
    <div class="nd_learning_width_40_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
      <h2 class="nd_learning_section nd_learning_margin_0"><?php _e('Order Page','nd-learning'); ?></h2>
      <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_10"><?php _e('Select your order page','nd-learning'); ?></p>
    </div>
    <div class="nd_learning_width_60_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_float_left">
      
      <select class="nd_learning_width_100_percentage" name="nd_learning_order_page">
        <?php $nd_learning_pages = get_pages(); ?>
        <?php foreach ($nd_learning_pages as $nd_learning_page) : ?>
            <option

            <?php 
              if( get_option('nd_learning_order_page') == $nd_learning_page->ID ) { 
                echo 'selected="selected"';
              } 
            ?>

             value="<?php echo $nd_learning_page->ID; ?>">
                <?php echo $nd_learning_page->post_title; ?>
            </option>
        <?php endforeach; ?>
      </select>
      <p class="nd_learning_color_666666 nd_learning_section nd_learning_margin_0 nd_learning_margin_top_20"><?php _e('Select the page where you have added the shortcode [nd_learning_order]','nd-learning'); ?></p>

    </div>
  </div>
  <!--END-->
  <div class="nd_learning_section nd_learning_height_1 nd_learning_background_color_E7E7E7 nd_learning_margin_top_10 nd_learning_margin_bottom_10"></div>



<?php
}



//START  nd_learning_order
function nd_learning_shortcode_order() {

  
  if ( isset($_POST['nd_learning_review_number']) ) {


      //custom hook
      do_action('nd_learning_hook_review_set');


  }else{

    //recover order info
    $nd_learning_order_id = sanitize_text_field($_POST['nd_learning_order_id']);
    $nd_learning_order_course_id = sanitize_text_field($_POST['nd_learning_order_course_id']);
    $nd_learning_order_user_id = sanitize_text_field($_POST['nd_learning_order_user_id']);
    $nd_learning_order_user_first_name = sanitize_text_field($_POST['nd_learning_order_user_first_name']);
    $nd_learning_order_user_last_name = sanitize_text_field($_POST['nd_learning_order_user_last_name']);
    $nd_learning_order_user_email = sanitize_email($_POST['nd_learning_order_user_email']);


    //info order
    global $wpdb;

    $nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';
    $nd_learning_action_type = "'free'";

    //START select for items
    $nd_learning_order_infos = $wpdb->get_results( "SELECT * FROM $nd_learning_table_name WHERE id = $nd_learning_order_id" );




    
    foreach ( $nd_learning_order_infos as $nd_learning_order_info ) 
    {

      $nd_learning_order_action_type = $nd_learning_order_info->action_type;

      //user name surname
      if ( $nd_learning_order_action_type == 'free' ) {
          $nd_learning_order_user_name = $nd_learning_order_user_first_name.' '.$nd_learning_order_user_last_name;
      }else{
          $nd_learning_order_user_name = $nd_learning_order_info->user_first_name.' '.$nd_learning_order_info->user_last_name;
      }

      //payment status
      if ( $nd_learning_order_action_type == 'free' ) {
          $nd_learning_order_payment_status = __('Free Course','nd-learning');
      }else{
          $nd_learning_order_payment_status = $nd_learning_order_info->paypal_payment_status;
      }


      //payment currency
      if ( $nd_learning_order_action_type == 'free' ) {
          $nd_learning_order_payment_currency = __('Free Course','nd-learning');
      }else{
          $nd_learning_order_payment_currency = $nd_learning_order_info->paypal_currency;
      }


      //email user
      if ( $nd_learning_order_action_type == 'free' ) {
          $nd_learning_order_email_user = $nd_learning_order_user_email.' / '.__('Free Course','nd-learning');
      }else{
          $nd_learning_order_email_user = $nd_learning_order_user_email.' / '.$nd_learning_order_info->paypal_email;
      }


      //payment transiction
      if ( $nd_learning_order_action_type == 'free' ) {
          $nd_learning_order_payment_transiction = __('Free Course','nd-learning');
      }else{
          $nd_learning_order_payment_transiction = $nd_learning_order_info->paypal_tx;
      }

      
      //city/country/address
      $nd_learning_order_user_country = $nd_learning_order_info->user_country;
      $nd_learning_order_user_address = $nd_learning_order_info->user_address;
      $nd_learning_order_user_city = $nd_learning_order_info->user_city;


    $nd_learning_shortcode_order = '


      <div class="nd_learning_width_50_percentage nd_learning_width_100_percentage_responsive nd_learning_padding_15 nd_learning_box_sizing_border_box nd_learning_float_left">

        <div class="nd_learning_section nd_learning_box_sizing_border_box nd_learning_overflow_hidden nd_learning_overflow_x_auto nd_learning_cursor_move_responsive">

            <table class="nd_learning_section">
                <thead>
                    <tr class="nd_learning_border_bottom_2_solid_grey">
                        <td class="nd_learning_padding_20 nd_learning_width_25_percentage">
                            <h6 class="nd_learning_text_transform_uppercase">'.__('Product','nd-learning').'</h6>    
                        </td>
                        <td class="nd_learning_padding_40 nd_learning_width_30_percentage">   
                        </td>
                        <td class="nd_learning_padding_20 nd_learning_width_10_percentage">
                            <h6 class="nd_learning_text_transform_uppercase">'.__('Qnt','nd-learning').'</h6>    
                        </td>
                        <td class="nd_learning_padding_20 nd_learning_width_15_percentage">
                            <h6 class="nd_learning_text_transform_uppercase">'.__('Total','nd-learning').'</h6>    
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr class="nd_learning_border_bottom_2_solid_grey">
                        <td class="nd_learning_padding_20">
                            <img alt="" class="nd_learning_section" src="'.nd_learning_get_course_image_url($nd_learning_order_course_id).'">   
                        </td>
                        <td class="nd_learning_padding_20"> 
                            <h3><strong>'.get_the_title($nd_learning_order_course_id).'</strong></h3>  
                        </td>
                        <td class="nd_learning_padding_20">
                            <h3>1</h3>  
                        </td>
                        <td class="nd_learning_padding_20">
                            <p class="">'.nd_learning_get_course_currency().' '.nd_learning_get_course_price($nd_learning_order_course_id).'</p>    
                        </td>
                    </tr>

                </tbody>
            </table>

        </div>';


        echo $nd_learning_shortcode_order;

        $nd_learning_order_informations = array($nd_learning_order_id,$nd_learning_order_course_id,$nd_learning_order_user_id);

        //custom hook
        do_action('nd_learning_hook_shortcode_order_end_left_column',$nd_learning_order_informations);



    $nd_learning_shortcode_order = '</div>

    <div class="nd_learning_width_50_percentage nd_learning_width_100_percentage_responsive nd_learning_padding_15 nd_learning_box_sizing_border_box nd_learning_float_left">

        <div class="nd_learning_section nd_learning_bg_grey nd_learning_border_1_solid_grey nd_learning_padding_20 nd_learning_box_sizing_border_box  nd_learning_overflow_hidden nd_learning_overflow_x_auto nd_learning_cursor_move_responsive">


            
            <table class="nd_learning_section">
                <thead>
                    <tr class="">
                        <td class="nd_learning_padding_20_10 nd_learning_width_50_percentage">
                            <h6 class="nd_learning_text_transform_uppercase">'.__('ORDER DETAILS WITH ID : ','nd-learning').' '.$nd_learning_order_info->id.' </h6>    
                        </td>
                        <td class="nd_learning_padding_20_10 nd_learning_width_50_percentage">   
                        </td>
                    </tr>
                </thead>
                <tbody>


        
                    <tr class="nd_learning_border_top_2_solid_grey nd_learning_border_bottom_2_solid_grey">
                        <td class="nd_learning_padding_20_10">
                            <p>'.__('Order Date','nd-learning').'</p>   
                        </td>
                        <td class="nd_learning_padding_20_10 ">  
                            <p class="nd_options_color_greydark">'.$nd_learning_order_info->date.'</p> 
                        </td>
                    </tr>
                    <tr class="nd_learning_border_bottom_2_solid_grey">
                        <td class="nd_learning_padding_20_10">
                            <p>'.__('Payment Status','nd-learning').'</p>   
                        </td>
                        <td class="nd_learning_padding_20_10 ">  
                            <p class="nd_options_color_greydark">'.$nd_learning_order_payment_status.'</p> 
                        </td>
                    </tr>
                    <tr class="nd_learning_border_bottom_2_solid_grey">
                        <td class="nd_learning_padding_20_10">
                            <p>'.__('Payment Currency','nd-learning').'</p>   
                        </td>
                        <td class="nd_learning_padding_20_10 ">  
                            <p class="nd_options_color_greydark">'.$nd_learning_order_payment_currency.'</p> 
                        </td>
                    </tr>
                    <tr class="nd_learning_border_bottom_2_solid_grey">
                        <td class="nd_learning_padding_20_10">
                            <p>'.__('Email User / Email Payment','nd-learning').'</p>   
                        </td>
                        <td class="nd_learning_padding_20_10 ">  
                            <p class="nd_options_color_greydark">'.$nd_learning_order_email_user.'</p> 
                        </td>
                    </tr>
                    <tr class="nd_learning_border_bottom_2_solid_grey">
                        <td class="nd_learning_padding_20_10">
                            <p>'.__('Payment Transiction','nd-learning').'</p>   
                        </td>
                        <td class="nd_learning_padding_20_10 ">  
                            <p class="nd_options_color_greydark">'.$nd_learning_order_payment_transiction.'</p> 
                        </td>
                    </tr>
                    <tr class="nd_learning_border_bottom_2_solid_grey">
                        <td class="nd_learning_padding_20_10">
                            <p>'.__('User Country','nd-learning').'</p>   
                        </td>
                        <td class="nd_learning_padding_20_10 ">  
                            <p class="nd_options_color_greydark">'.$nd_learning_order_user_country.'</p> 
                        </td>
                    </tr>
                    <tr class="nd_learning_border_bottom_2_solid_grey">
                        <td class="nd_learning_padding_20_10">
                            <p>'.__('User Address','nd-learning').'</p>   
                        </td>
                        <td class="nd_learning_padding_20_10 ">  
                            <p class="nd_options_color_greydark">'.$nd_learning_order_user_address.'</p> 
                        </td>
                    </tr>
                    <tr class="nd_learning_border_bottom_2_solid_grey">
                        <td class="nd_learning_padding_20_10">
                            <p>'.__('User First and Last Name','nd-learning').'</p>   
                        </td>
                        <td class="nd_learning_padding_20_10 ">  
                            <p class="nd_options_color_greydark">'.$nd_learning_order_user_name.'</p> 
                        </td>
                    </tr>
                    <tr class="">
                        <td class="nd_learning_padding_20_10">
                            <p>'.__('User City','nd-learning').'</p>   
                        </td>
                        <td class="nd_learning_padding_20_10 ">  
                            <p class="nd_options_color_greydark">'.$nd_learning_order_user_city.'</p> 
                        </td>
                    </tr>

                </tbody>
            </table>




            <div class="nd_learning_section">
                    <div class="nd_learning_width_100_percentage nd_learning_padding_10 nd_learning_box_sizing_border_box nd_learning_float_left">
                        <a class="nd_learning_display_inline_block nd_learning_text_align_center nd_learning_box_sizing_border_box nd_learning_width_100_percentage nd_learning_color_white_important nd_learning_bg_orange nd_options_first_font nd_learning_padding_10_20 nd_learning_border_radius_3 " href="'.nd_learning_get_account_page().'">'.__('GO TO ACCOUNT PAGE','nd-learning').'</a>   
                    </div>
                </div> 


        </div>

    </div>

    ';


    }
    //end for each


    echo $nd_learning_shortcode_order;


  }


  


}
add_shortcode('nd_learning_order', 'nd_learning_shortcode_order');
//END nd_learning_order



?>