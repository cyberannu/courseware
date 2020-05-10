<?php


//page admin settings
require_once dirname( __FILE__ ) . '/inc/admin/admin-settings.php';



//START add book button to single course page
add_action('nd_learning_sidebar_single_course_page_3','nd_learning_add_booking_button_single_course_page');
function nd_learning_add_booking_button_single_course_page(){

	//recover datas from plugin settings
	$nd_learning_checkout_page = get_option('nd_learning_checkout_page');
	$nd_learning_checkout_page_url = get_permalink($nd_learning_checkout_page);

  //data to be passed to function
  $nd_learning_course_id = get_the_ID();
  $nd_learning_current_user = wp_get_current_user();
  $nd_learning_current_user_id = $nd_learning_current_user->ID;

  //metabox
  $nd_learning_meta_box_max_availability = get_post_meta( $nd_learning_course_id, 'nd_learning_meta_box_max_availability', true );

	//declare
	$nd_learning_booking_button_single_course_page = '';


  //check if the user is logged
  if (is_user_logged_in() == 1){

    if ( nd_learning_check_user_purchased_free_course($nd_learning_course_id, $nd_learning_current_user_id) === 0 ){

      
      if ( $nd_learning_meta_box_max_availability - nd_learning_get_all_orders_by_id($nd_learning_course_id) === 0 ) {

        $nd_learning_booking_button_single_course_page .= '

        <form class="">
          <input class="nd_learning_width_100_percentage" type="submit" disabled value="'.__('COURSE COMPLETED','nd-learning').'">
        </form>

      ';

      }else{

        $nd_learning_booking_button_single_course_page .= '

          <form class="" action="'.$nd_learning_checkout_page_url.'" method="post">
            <input type="hidden" name="nd_learning_id_course" value="'.get_the_ID().'">
            <input class="nd_learning_width_100_percentage nd_learning_cursor_pointer" type="submit" value="'.__('BOOK','nd-learning').'">
          </form>

        ';
      }

    }else{

      $nd_learning_booking_button_single_course_page .= '

        <form class="">
          <input class="nd_learning_width_100_percentage" type="submit" disabled value="'.__('ALREADY BOOKED','nd-learning').'">
        </form>

      ';

    }
  
  }else{

    $nd_learning_booking_button_single_course_page .= '

    <form class="" action="'.$nd_learning_checkout_page_url.'" method="post">
      <input type="hidden" name="nd_learning_id_course" value="'.get_the_ID().'">
      <input class="nd_learning_width_100_percentage nd_learning_cursor_pointer" type="submit" value="'.__('BOOK','nd-learning').'">
    </form>

  ';

  }
  //end if the user is logged

	


  echo $nd_learning_booking_button_single_course_page;

}
//END




//Start nd_learning_check_user_purchased_free_course
function nd_learning_check_user_purchased_free_course($nd_learning_course_id, $nd_learning_current_user_id){

  global $wpdb;

  $nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';
  $nd_learning_action_type = "'free'";

  //START select for items
  $nd_learning_order_ids = $wpdb->get_results( "SELECT id_course FROM $nd_learning_table_name WHERE id_user = $nd_learning_current_user_id AND action_type = $nd_learning_action_type AND id_course = $nd_learning_course_id");

  //no results
  if ( empty($nd_learning_order_ids) ) { 

    return 0;
    
  }else{

    return 1;

  }
  //END select for items

}
//END




//START  nd_learning_checkout
function nd_learning_shortcode_checkout() {

  
  //recover datas from plugin settings
  $nd_learning_checkout_page = get_option('nd_learning_checkout_page');
  $nd_learning_checkout_page_url = get_permalink($nd_learning_checkout_page);

  $nd_learning_account_page = get_option('nd_learning_account_page');
  $nd_learning_account_page_url = get_permalink($nd_learning_account_page);

  $nd_learning_paypal_email = get_option('nd_learning_paypal_email');
  $nd_learning_paypal_currency = get_option('nd_learning_paypal_currency');
  $nd_learning_paypal_token = get_option('nd_learning_paypal_token');

  $nd_learning_paypal_developer = get_option('nd_learning_paypal_developer');
  if ( $nd_learning_paypal_developer == 1) {
    $nd_learning_paypal_action_1 = 'https://www.sandbox.paypal.com/cgi-bin';
    $nd_learning_paypal_action_2 = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; 
  }
  else{  
    $nd_learning_paypal_action_1 = 'https://www.paypal.com/cgi-bin';
    $nd_learning_paypal_action_2 = 'https://www.paypal.com/cgi-bin/webscr';
  }


  $nd_learning_shortcode_checkout = '';

  
  //START IF 1 - check if the user is lkogged
  if (is_user_logged_in() == 1){

    
    //START IF 2 - if arrive from course single page
    if ( isset( $_POST['nd_learning_id_course']) ){
      

      $nd_learning_id_course = sanitize_text_field($_POST['nd_learning_id_course']);

      //recover datas from plugin settings
      $nd_learning_settings_paypal = get_option('nd_learning_paypal');
      $nd_learning_settings_currency = get_option('nd_learning_currency');

      //get all user informations
      $nd_learning_current_user = wp_get_current_user();
      $nd_learning_current_user_login = $nd_learning_current_user->user_login;
      $nd_learning_current_user_email = $nd_learning_current_user->user_email;
      $nd_learning_current_user_firstname = $nd_learning_current_user->user_firstname;
      $nd_learning_current_user_lastname = $nd_learning_current_user->user_lastname;
      $nd_learning_current_user_display_name = $nd_learning_current_user->display_name;
      $nd_learning_current_user_id = $nd_learning_current_user->ID;

      //default wp value
      $nd_learning_title_course = get_the_title($nd_learning_id_course);

      //metabox course
      $nd_learning_meta_box_price = get_post_meta( $nd_learning_id_course, 'nd_learning_meta_box_price', true );
      $nd_learning_meta_box_date = get_post_meta( $nd_learning_id_course, 'nd_learning_meta_box_date', true );


      $nd_learning_shortcode_checkout .= '


      <div class="nd_learning_section">
          <div class="nd_learning_width_66_percentage nd_learning_float_left nd_learning_box_sizing_border_box nd_learning_padding_15 nd_learning_width_100_percentage_responsive">

              <h2><strong>'.__('Main Details ( Go to your account to change datas ) :','nd-learning').'</strong></h2>

              <form action="'.$nd_learning_checkout_page_url.'" method="post">

                <input name="nd_learning_free_id_course" type="hidden" readonly value="'.$nd_learning_id_course.'">
                <input name="nd_learning_free_title_course" type="hidden" readonly value="'.$nd_learning_title_course.'">
                <input name="nd_learning_free_price_course" type="hidden" readonly value="'.$nd_learning_meta_box_price.'">
                <input name="nd_learning_free_user_id" type="hidden" readonly value="'.$nd_learning_current_user_id.'">
                <input name="nd_learning_free_user_login" type="hidden" readonly value="'.$nd_learning_current_user_login.'">
                <input name="nd_learning_free_display_name" type="hidden" readonly value="'.$nd_learning_current_user_display_name.'">
                
                <div class="nd_learning_section nd_learning_height_20"></div>
                <input class="nd_learning_section" placeholder="'.__('Email','nd-learning').'" name="nd_learning_free_current_user_email" type="email" readonly value="'.$nd_learning_current_user_email.'"></p>
                <div class="nd_learning_section nd_learning_height_20"></div>
                <input class="nd_learning_section" placeholder="'.__('First Name','nd-learning').'" name="nd_learning_free_current_user_firstname" type="text" readonly value="'.$nd_learning_current_user_firstname.'"></p>
                <div class="nd_learning_section nd_learning_height_20"></div>
                <input class="nd_learning_section" placeholder="'.__('Last Name','nd-learning').'" name="nd_learning_free_current_user_lastname" type="text" readonly value="'.$nd_learning_current_user_lastname.'"></p>';



      //START if 3 -  course is free or not
      if ( $nd_learning_meta_box_price == 0 ){

        $nd_learning_shortcode_checkout .= '

        <div class="nd_learning_section nd_learning_height_50"></div>
        <h2><strong>'.__('Other Details :','nd-learning').'</strong></h2>

        <div class="nd_learning_section nd_learning_height_20"></div>
        <input class="nd_learning_section" name="nd_learning_free_user_country" placeholder="'.__('Country','nd-learning').'" type="text" value=""></p>
        <div class="nd_learning_section nd_learning_height_20"></div>
        <input class="nd_learning_section" name="nd_learning_free_user_address" placeholder="'.__('Address','nd-learning').'" type="text" value=""></p>
        <div class="nd_learning_section nd_learning_height_20"></div>
        <input class="nd_learning_section" name="nd_learning_free_user_city" placeholder="'.__('City','nd-learning').'" type="text" value=""></p>
        <div class="nd_learning_section nd_learning_height_20"></div>
        <input class="nd_learning_section" name="nd_learning_free_user_zip" placeholder="'.__('Zip Code','nd-learning').'" type="text" value=""></p>

        <div class="nd_learning_section nd_learning_height_50"></div>
        <h2><strong>'.__('Book For Free :','nd-learning').'</strong></h2>
        <div class="nd_learning_section nd_learning_height_20"></div>
        <input type="submit" value="'.__('BOOK','nd-learning').'"></form>';

      //END IF 3 - 
      }else{

        $nd_learning_shortcode_checkout .= '

          </form>

          <form target="paypal" action="'.$nd_learning_paypal_action_1.'" method="post" >
            <input type="hidden" name="cmd" value="_xclick">
            <input type="hidden" name="business" value="'.$nd_learning_paypal_email.'">
            <input type="hidden" name="lc" value="">
            <input type="hidden" name="item_name" value="'.$nd_learning_title_course.'">
            <input type="hidden" name="item_number" value="'.$nd_learning_id_course.'">
            <input type="hidden" name="custom" value="'.$nd_learning_current_user_id.'">
            <input type="hidden" name="amount" value="'.$nd_learning_meta_box_price.'">
            <input type="hidden" name="currency_code" value="'.$nd_learning_paypal_currency.'">
            <input type="hidden" name="rm" value="2" />
            <input type="hidden" name="return" value="'.$nd_learning_checkout_page_url.'" />
            <input type="hidden" name="cancel_return" value="" />
            <input type="hidden" name="button_subtype" value="services">
            <input type="hidden" name="no_note" value="0">
            <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">


            <div class="nd_learning_section nd_learning_height_50"></div>
            <h2><strong>'.__('Pay With Paypal :','nd-learning').'</strong></h2>
            <div class="nd_learning_section nd_learning_height_20"></div>

            <input id="nd_learning_paypal_button" type="submit" value="'.__('BOOK','nd-learning').'">
            <img alt="" border="0" src="https://www.paypalobjects.com/it_IT/i/scr/pixel.gif" width="1" height="1">
          </form>';

      }
      //END



      $nd_learning_shortcode_checkout .= '</div>


          <div class="nd_learning_width_33_percentage nd_learning_float_left nd_learning_box_sizing_border_box nd_learning_padding_15 nd_learning_width_100_percentage_responsive">


            <div class="nd_learning_section nd_learning_bg_grey nd_learning_border_1_solid_grey nd_learning_padding_20 nd_learning_box_sizing_border_box">

              <table class="nd_learning_section">
                  <thead>
                      <tr class="nd_learning_border_bottom_2_solid_grey">
                          <td class="nd_learning_padding_20_10 nd_learning_width_25_percentage">
                              <h6 class="nd_learning_text_transform_uppercase">'.__('cart','nd-learning').'</h6>    
                          </td>
                          <td class="nd_learning_padding_20_10 nd_learning_width_40_percentage">   
                          </td>
                          <td class="nd_learning_padding_20_10 nd_learning_width_35_percentage">   
                          </td>
                      </tr>
                  </thead>
                  <tbody>


                      <tr class="">
                          <td class="nd_learning_padding_20_10">
                              <img alt="" class="nd_learning_section" src="'.nd_learning_get_course_image_url($nd_learning_id_course).'">   
                          </td>
                          <td class="nd_learning_padding_20_10"> 
                              <h5><strong>'.$nd_learning_title_course.'</strong></h5>  
                          </td>
                          <td class="nd_learning_padding_20_10 nd_learning_text_align_right">  
                              <p>'.nd_learning_get_course_currency().' '.nd_learning_get_course_price($nd_learning_id_course).'</p> 
                          </td>
                      </tr>

                     
                  </tbody>
              </table>





              <table class="nd_learning_section">
                  <thead>
                      <tr class="nd_learning_border_bottom_2_solid_grey">
                          <td class="nd_learning_padding_20_10 nd_learning_width_25_percentage">
                              <h6 class="nd_learning_text_transform_uppercase">'.__('ORDER','nd-learning').'</h6>    
                          </td>
                          <td class="nd_learning_padding_20_10 nd_learning_width_40_percentage">   
                          </td>
                          <td class="nd_learning_padding_20_10 nd_learning_width_35_percentage">   
                          </td>
                      </tr>
                  </thead>
                  <tbody>


          
                      <tr class="">
                          <td class="nd_learning_padding_20_10">
                              <p>'.__('Subtotal','nd-learning').'</p>   
                          </td>
                          <td class="nd_learning_padding_20_10"> 
                                
                          </td>
                          <td class="nd_learning_padding_20_10 nd_learning_text_align_right">  
                              <p class="nd_learning_color_greydark">'.nd_learning_get_course_currency().' '.nd_learning_get_course_price($nd_learning_id_course).'</p> 
                          </td>
                      </tr>
                      <tr class="nd_learning_border_bottom_2_solid_grey">
                          <td class="nd_learning_padding_20_10">
                              <p>'.__('Method','nd-learning').'</p>   
                          </td>
                          <td class="nd_learning_padding_20_10"> 
                                
                          </td>
                          <td class="nd_learning_padding_20_10 nd_learning_text_align_right">  
                              <p class="nd_learning_color_greydark">';

                              if( nd_learning_get_course_price($nd_learning_id_course) == 0 ){

                                $nd_learning_shortcode_checkout .= __('Free','nd-learning');

                              }else{

                                $nd_learning_shortcode_checkout .= __('PayPal','nd-learning');

                              }


                              $nd_learning_shortcode_checkout .= '</p> 
                          </td>
                      </tr>
                      <tr class="">
                          <td class="nd_learning_padding_20_10">
                              <p>'.__('Total','nd-learning').'</p>   
                          </td>
                          <td class="nd_learning_padding_20_10"> 
                                
                          </td>
                          <td class="nd_learning_padding_20_10 nd_learning_text_align_right">  
                              <h3><strong>'.nd_learning_get_course_currency().' '.nd_learning_get_course_price($nd_learning_id_course).'</strong></h3> 
                          </td>
                      </tr>

                  </tbody>
              </table>




              <div class="nd_learning_section">
                  <div class="nd_learning_width_100_percentage nd_learning_padding_10 nd_learning_box_sizing_border_box nd_learning_float_left">
                      <a class="nd_learning_display_inline_block nd_learning_text_align_center nd_learning_box_sizing_border_box nd_learning_width_100_percentage nd_learning_color_white_important nd_learning_bg_orange nd_options_first_font nd_learning_padding_10_20 nd_learning_border_radius_3 " href="'.get_post_type_archive_link('courses').'">'.__('BACK TO COURSES','nd-learning').'</a>   
                  </div>
              </div> 


            </div>



          </div>
      </div>';


        


      echo $nd_learning_shortcode_checkout;


    






    //START ELSE IF 2 - arrive from paypal paypal payment
    }elseif ( isset($_GET['tx']) ){

      $nd_learning_tx = sanitize_text_field($_GET['tx']);
      $nd_learning_paypal_url = $nd_learning_paypal_action_2;

      //prepare the response
      $nd_learning_paypal_response = wp_remote_post( 

          $nd_learning_paypal_url, 

          array(
          
              'method' => 'POST',
              'timeout' => 45,
              'redirection' => 5,
              'httpversion' => '1.0',
              'blocking' => true,
              'headers' => array(),
              'body' => array( 
                  'cmd' => '_notify-synch',
                  'tx' => $nd_learning_tx,
                  'at' => $nd_learning_paypal_token
              ),
              'cookies' => array()
          
          )
      );

      $nd_learning_http_paypal_response_code = wp_remote_retrieve_response_code( $nd_learning_paypal_response );


      //START IF 4
      if ( $nd_learning_http_paypal_response_code == 200 ) {

        $nd_learning_paypal_response_body = wp_remote_retrieve_body( $nd_learning_paypal_response );

        //IF SUCCESS
        if ( strpos($nd_learning_paypal_response_body, 'SUCCESS') === 0 ) {

          $nd_learning_paypal_response = substr($nd_learning_paypal_response_body, 7);
          $nd_learning_paypal_response = urldecode($nd_learning_paypal_response);
          preg_match_all('/^([^=\s]++)=(.*+)/m', $nd_learning_paypal_response, $m, PREG_PATTERN_ORDER);
          $nd_learning_paypal_response = array_combine($m[1], $m[2]);

          if(isset($nd_learning_paypal_response['charset']) AND strtoupper($nd_learning_paypal_response['charset']) !== 'UTF-8')
          {
            foreach($nd_learning_paypal_response as $key => &$value)
            {
              $value = mb_convert_encoding($value, 'UTF-8', $nd_learning_paypal_response['charset']);
            }
            $nd_learning_paypal_response['charset_original'] = $nd_learning_paypal_response['charset'];
            $nd_learning_paypal_response['charset'] = 'UTF-8';
          }

          ksort($nd_learning_paypal_response);

          $nd_learning_response_result = '';
          $nd_learning_response_result .= '

            <h2><strong>'.__('Thanks for your order','nd-learning').'</strong></h2>
            <p class="nd_learning_margin_top_20"><strong>Item Name : </strong> '.$nd_learning_paypal_response['item_name'].' with ID '.$nd_learning_paypal_response['item_number'].' </p>
            <p><strong>'.__('Price : ','nd-learning').'</strong> '.$nd_learning_paypal_response['mc_gross'].' x '.$nd_learning_paypal_response['quantity'].''.__(' Qnt','nd-learning').'</p>
            <p><strong>'.__('Payment Status : ','nd-learning').'</strong> '.$nd_learning_paypal_response['payment_status'].' </p>
            <p><strong>'.__('Transiction ID : ','nd-learning').'</strong> '.$nd_learning_paypal_response['txn_id'].' </p>

            <a class="nd_learning_bg_green nd_learning_margin_top_20 nd_learning_display_inline_block nd_learning_color_white_important nd_learning_text_decoration_none nd_learning_padding_5_10 nd_learning_border_radius_3 nd_options_first_font" href="'.$nd_learning_account_page_url.'">'.__('My Orders','nd-learning').'</a>

          ';

          echo $nd_learning_response_result;

          //START add order in db
          if ( nd_learning_check_if_order_is_present($nd_learning_paypal_response['txn_id'],$nd_learning_paypal_response['item_number'],$nd_learning_paypal_response['custom']) == 0 ) {

            nd_learning_add_order_in_db(

              $nd_learning_paypal_response['item_number'],
              $nd_learning_paypal_response['mc_gross'],
              $nd_learning_paypal_response['payment_date'],
              $nd_learning_paypal_response['quantity'],
              $nd_learning_paypal_response['payment_status'],
              $nd_learning_paypal_response['mc_currency'],
              $nd_learning_paypal_response['payer_email'],
              $nd_learning_paypal_response['txn_id'],
              $nd_learning_paypal_response['custom'],
              $nd_learning_paypal_response['address_country'],
              $nd_learning_paypal_response['address_street'].' '.$nd_learning_paypal_response['address_zip'],
              $nd_learning_paypal_response['first_name'],
              $nd_learning_paypal_response['last_name'],
              $nd_learning_paypal_response['address_city'],
              'paypal'

            );

          }
          //END add order in db

        }
        //END SUCCESS


      }else{
        
        echo '
        <p>'.__('An error has occurred, contact the site administrator','nd-learning').'</p>
        <div class="nd_options_section nd_options_height_20"></div>
        <a class="nd_learning_bg_green nd_options_first_font nd_learning_display_inline_block nd_learning_color_white_important nd_learning_text_decoration_none nd_learning_padding_5_10 nd_learning_border_radius_3" href="'.get_post_type_archive_link('courses').'">'.__('Back To Courses','nd-learning').'</a>

      ';   
      }
      //END IF 4
      

    //START ELSE IF 2 -  arrive from booking free item
    }elseif ( isset($_POST['nd_learning_free_user_id']) ) {

      //recover datas
      $nd_learning_free_user_id = sanitize_text_field($_POST['nd_learning_free_user_id']);
      $nd_learning_free_user_login = sanitize_text_field($_POST['nd_learning_free_user_login']);
      $nd_learning_free_display_name = sanitize_text_field($_POST['nd_learning_free_display_name']);
      $nd_learning_free_current_user_email = sanitize_email($_POST['nd_learning_free_current_user_email']);
      $nd_learning_free_current_user_firstname = sanitize_text_field($_POST['nd_learning_free_current_user_firstname']);
      $nd_learning_free_current_user_lastname = sanitize_text_field($_POST['nd_learning_free_current_user_lastname']);
      $nd_learning_free_user_country = sanitize_text_field($_POST['nd_learning_free_user_country']);
      $nd_learning_free_user_address = sanitize_text_field($_POST['nd_learning_free_user_address']);
      $nd_learning_free_user_city = sanitize_text_field($_POST['nd_learning_free_user_city']);
      $nd_learning_free_user_zip = sanitize_text_field($_POST['nd_learning_free_user_zip']);
      $nd_learning_free_id_course = sanitize_text_field($_POST['nd_learning_free_id_course']);
      $nd_learning_free_title_course = sanitize_text_field($_POST['nd_learning_free_title_course']);
      $nd_learning_free_price_course = sanitize_text_field($_POST['nd_learning_free_price_course']);

      //get current date
      $nd_learning_free_date = date('H:m:s F j Y');

      $nd_learning_response_result = '';

      $nd_learning_response_result .= '

        <h2><strong>'.__('Thanks for your order','nd-learning').'</strong></h2>
        <p class="nd_learning_margin_top_20"><strong>'.__('Item Name : ','nd-learning').'</strong> '.$nd_learning_free_title_course.''.__(' with ID ','nd-learning').''.$nd_learning_free_id_course.'</p>
        <p><strong>'.__('Price : ','nd-learning').'</strong>'.__('FREE','nd-learning').'</p>

        <a class="nd_learning_bg_green nd_learning_margin_top_20 nd_learning_display_inline_block nd_learning_color_white_important nd_learning_text_decoration_none nd_learning_padding_5_10 nd_options_first_font nd_learning_border_radius_3" href="'.$nd_learning_account_page_url.'">'.__('My Orders','nd-learning').'</a>
 

      ';

      echo $nd_learning_response_result;



      //START add order in db
      if ( nd_learning_check_if_order_is_present(0,$nd_learning_free_id_course,$nd_learning_free_user_id) == 0 ) {
        
        nd_learning_add_order_in_db(

          $nd_learning_free_id_course,
          0,
          $nd_learning_free_date,
          1,
          0,
          0,
          $nd_learning_free_current_user_email,
          0,
          $nd_learning_free_user_id,
          $nd_learning_free_user_country,
          $nd_learning_free_user_address.' '.$nd_learning_free_user_zip,
          $nd_learning_free_current_user_firstname,
          $nd_learning_free_current_user_lastname,
          $nd_learning_free_user_city,
          'free'

        );
      }
      //END add order in db


    //END IF 2 - try to reach the page directly from browser
    }else{
      
      echo '

        <p>'.__('You have not selected any course','nd-learning').'</p>
        <div class="nd_options_section nd_options_height_20"></div>
        <a class="nd_learning_bg_green nd_options_first_font nd_learning_display_inline_block nd_learning_color_white_important nd_learning_text_decoration_none nd_learning_padding_5_10 nd_learning_border_radius_3" href="'.get_post_type_archive_link('courses').'">'.__('Back To Courses','nd-learning').'</a>

      ';

    }


  //END IF 1 - the user is not logged in the site
  }else{



    $nd_learning_registration_enable_result = '';

    $nd_learning_registration_enable_result .= '

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

        $nd_learning_registration_enable_result .='

        <div class="nd_learning_width_50_percentage nd_learning_float_left nd_learning_box_sizing_border_box nd_learning_padding_15 nd_learning_width_100_percentage_responsive">

            <div class="nd_learning_section nd_learning_bg_white nd_learning_border_radius_3 nd_learning_border_1_solid_grey nd_learning_padding_20 nd_learning_box_sizing_border_box">
            
                <h6 class="nd_options_second_font nd_learning_bg_orange nd_learning_padding_5 nd_learning_border_radius_3 nd_learning_color_white_important nd_learning_display_inline_block">'.__('I DO NOT HAVE AN ACCOUNT','nd-learning').'</h6>
                <div class="nd_learning_section nd_learning_height_5"></div>
                <h2><strong>'.__('Register','nd-learning').'</strong></h2>

                '.do_shortcode("[nd_learning_register]").'

            </div>
            
          </div>';

    }else{

        $nd_learning_registration_enable_result .='

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


    $nd_learning_registration_enable_result .='</div>';


    echo $nd_learning_registration_enable_result;
    

  }
  //end if

}
add_shortcode('nd_learning_checkout', 'nd_learning_shortcode_checkout');
//END nd_learning_checkout






//START nd_learning_add_order_in_db
function nd_learning_add_order_in_db(
  
  $nd_learning_id_course,
  $nd_learning_course_price,
  $nd_learning_date,
  $nd_learning_qnt,
  $nd_learning_paypal_payment_status,
  $nd_learning_paypal_currency,
  $nd_learning_paypal_email,
  $nd_learning_paypal_tx,
  $nd_learning_id_user,
  $nd_learning_user_country,
  $nd_learning_user_address,
  $nd_learning_user_first_name,
  $nd_learning_user_last_name,
  $nd_learning_user_city,
  $nd_learning_action_type

) {

  global $wpdb;
  $nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';


  //START INSERT DB
  $nd_learning_add_order = $wpdb->insert( 
    
    $nd_learning_table_name, 
    
    array( 
      'id_course' => $nd_learning_id_course,
      'course_price' => $nd_learning_course_price,
      'date' => $nd_learning_date,
      'qnt' => $nd_learning_qnt,
      'paypal_payment_status' => $nd_learning_paypal_payment_status,
      'paypal_currency' => $nd_learning_paypal_currency,
      'paypal_email' => $nd_learning_paypal_email,
      'paypal_tx' => $nd_learning_paypal_tx,
      'id_user' => $nd_learning_id_user,
      'user_country' => $nd_learning_user_country,
      'user_address' => $nd_learning_user_address,
      'user_first_name' => $nd_learning_user_first_name,
      'user_last_name' => $nd_learning_user_last_name,
      'user_city' => $nd_learning_user_city,
      'action_type' => $nd_learning_action_type
    )

  );
  
  if ($nd_learning_add_order){

    //order added in db

  }else{

    $wpdb->show_errors();
    $wpdb->print_error();

  }
  //END INSERT DB
  
        
  //close the function to avoid wordpress errors
  //die();

}
//END










//START show tab list
add_action('nd_learning_shortcode_account_tab_list','nd_learning_add_order_tab_list');
function nd_learning_add_order_tab_list(){

  $nd_learning_add_order_tab_list = '

    <li class="nd_learning_display_inline_block">
      <h4>
        <a class="nd_learning_outline_0 nd_learning_padding_20 nd_learning_display_inline_block nd_options_first_font nd_options_color_greydark" href="#nd_learning_account_page_tab_order">'.__('My Orders','nd-learning').'</a>
      </h4>
    </li>

  ';

  echo $nd_learning_add_order_tab_list;

}


//START show orders in account page
add_action('nd_learning_shortcode_account_tab_list_content','nd_learning_show_orders');
function nd_learning_show_orders(){

  //declare variable
  $nd_learning_result = '';


  //recover datas from plugin settings
  $nd_learning_settings_page_order = get_option('nd_learning_order_page');
  $nd_learning_order_page_url = get_permalink($nd_learning_settings_page_order);

  //get current user id
  $nd_learning_current_user = wp_get_current_user();
  $nd_learning_current_user_id = $nd_learning_current_user->ID;

  global $wpdb;

  $nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';
  $nd_learning_paypal_payment_status = "'Completed'";

  //START select for items
  $nd_learning_order_ids = $wpdb->get_results( "SELECT * FROM $nd_learning_table_name WHERE id_user = $nd_learning_current_user_id AND paypal_payment_status = $nd_learning_paypal_payment_status");

  //title section
  $nd_learning_result .= '
    <div class="nd_learning_section" id="nd_learning_account_page_tab_order">
      <div class="nd_learning_section nd_learning_height_40"></div>
      <h3><strong>'.__('My Premium Orders','nd-learning').'</strong></h3>
      <div class="nd_learning_section nd_learning_height_20"></div>
  ';

  //no results
  if ( empty($nd_learning_order_ids) ) { 
    $nd_learning_result .= '<p>'.__('You do not have any order','nd-learning').'</p>'; 
  }else{


    $nd_learning_result .= '
      
      <div class="nd_learning_section nd_learning_box_sizing_border_box nd_learning_overflow_hidden nd_learning_overflow_x_auto nd_learning_cursor_move_responsive">
      <table>
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
      <tbody>
    ';

    foreach ( $nd_learning_order_ids as $nd_learning_order_id ) 
    {
      $nd_learning_result .= '

        <tr class="nd_learning_border_bottom_1_solid_grey">
            <td class="nd_learning_padding_20">  
                <img alt="" class="nd_learning_section" src="'.nd_learning_get_course_image_url($nd_learning_order_id->id_course).'"> 
            </td>
            <td class="nd_learning_padding_20">  
                <h4><strong>'.get_the_title($nd_learning_order_id->id_course).'</strong></h4> 
                <div class="nd_learning_section nd_learning_height_5"></div>
                <p>'.__('Transiction : ','nd-learning').''.$nd_learning_order_id->paypal_tx.'</p> 
            </td>
            <td class="nd_learning_padding_20 nd_learning_display_none_all_iphone">
                <p class="nd_options_color_greydark">'.nd_learning_get_course_currency().' '.nd_learning_get_course_price($nd_learning_order_id->id_course).'</p>    
            </td>
            <td class="nd_learning_padding_20">   

              <form method="post" action="'.$nd_learning_order_page_url.'">
                <input type="hidden" name="nd_learning_order_id" value="'.$nd_learning_order_id->id.'">
                <input type="hidden" name="nd_learning_order_course_id" value="'.$nd_learning_order_id->id_course.'">
                <input type="hidden" name="nd_learning_order_user_id" value="'.$nd_learning_current_user->ID.'">
                <input type="hidden" name="nd_learning_order_user_first_name" value="'.$nd_learning_current_user->user_firstname.'">
                <input type="hidden" name="nd_learning_order_user_last_name" value="'.$nd_learning_current_user->user_lastname.'">
                <input type="hidden" name="nd_learning_order_user_email" value="'.$nd_learning_current_user->user_email.'">
                <input class="nd_learning_display_inline_block nd_learning_color_white_important nd_learning_cursor_pointer nd_learning_bg_green nd_options_first_font nd_learning_padding_8 nd_learning_border_radius_3 nd_learning_font_size_13" type="submit" value="'.__('VIEW','nd-learning').'">
              </form>

            </td>
        </tr>

      ';
    }
    $nd_learning_result .= '</tbody></table></div>';

  }
  //END select for items

  echo $nd_learning_result;
  

}
//END





//START show free orders in account page
add_action('nd_learning_shortcode_account_tab_list_content','nd_learning_show_free_orders');
function nd_learning_show_free_orders(){

  //declare variable
  $nd_learning_result = '';

  //recover datas from plugin settings
  $nd_learning_settings_page_order = get_option('nd_learning_order_page');
  $nd_learning_order_page_url = get_permalink($nd_learning_settings_page_order);

  //get current user id
  $nd_learning_current_user = wp_get_current_user();
  $nd_learning_current_user_id = $nd_learning_current_user->ID;

  global $wpdb;

  $nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';
  $nd_learning_action_type = "'free'";

  //START select for items
  $nd_learning_order_ids = $wpdb->get_results( "SELECT id_course, id FROM $nd_learning_table_name WHERE id_user = $nd_learning_current_user_id AND action_type = $nd_learning_action_type");

  //title section
  $nd_learning_result .= '
      <div class="nd_learning_section nd_learning_height_40"></div>
      <h3><strong>'.__('My Free Orders','nd-learning').'</strong></h3>
      <div class="nd_learning_section nd_learning_height_20"></div>
  ';

  //no results
  if ( empty($nd_learning_order_ids) ) { 
    $nd_learning_result .= '<p>'.__('You do not have any order','nd-learning').'</p>'; 
  }else{


    $nd_learning_result .= '
      
      <div class="nd_learning_section nd_learning_box_sizing_border_box nd_learning_overflow_hidden nd_learning_overflow_x_auto nd_learning_cursor_move_responsive">
        <table>
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
        <tbody>
    ';

    foreach ( $nd_learning_order_ids as $nd_learning_order_id ) 
    {
      $nd_learning_result .= '

        <tr class="nd_learning_border_bottom_1_solid_grey">
            <td class="nd_learning_padding_20">  
                <img alt="" class="nd_learning_section" src="'.nd_learning_get_course_image_url($nd_learning_order_id->id_course).'"> 
            </td>
            <td class="nd_learning_padding_20">  
                <h4><strong>'.get_the_title($nd_learning_order_id->id_course).'</strong></h4> 
            </td>
            <td class="nd_learning_padding_20 nd_learning_display_none_all_iphone">
                <p class="nd_options_color_greydark">'.nd_learning_get_course_currency().' '.nd_learning_get_course_price($nd_learning_order_id->id_course).'</p>    
            </td>
            <td class="nd_learning_padding_20">  

              <form method="post" action="'.$nd_learning_order_page_url.'">
                <input type="hidden" name="nd_learning_order_id" value="'.$nd_learning_order_id->id.'">
                <input type="hidden" name="nd_learning_order_course_id" value="'.$nd_learning_order_id->id_course.'">
                <input type="hidden" name="nd_learning_order_user_id" value="'.$nd_learning_current_user->ID.'">
                <input type="hidden" name="nd_learning_order_user_first_name" value="'.$nd_learning_current_user->user_firstname.'">
                <input type="hidden" name="nd_learning_order_user_last_name" value="'.$nd_learning_current_user->user_lastname.'">
                <input type="hidden" name="nd_learning_order_user_email" value="'.$nd_learning_current_user->user_email.'">
                <input class="nd_learning_display_inline_block nd_learning_color_white_important nd_learning_cursor_pointer nd_learning_bg_green nd_options_first_font nd_learning_padding_8 nd_learning_border_radius_3 nd_learning_font_size_13" type="submit" value="'.__('VIEW','nd-learning').'">
              </form>

            </td>
        </tr>
      ';
    }
    $nd_learning_result .= '</tbody></table></div>';

  }
  //END select for items


  $nd_learning_result .= '</div>';


  echo $nd_learning_result;
  

}
//END



//add attendees tab list in the custom hook
add_action('nd_learning_single_course_tab_list_2','nd_learning_single_course_add_attendees_tab_list');
function nd_learning_single_course_add_attendees_tab_list(){

  $nd_learning_attendees_tab = '';


  $nd_learning_attendees_tab .= '
    <li class="nd_learning_display_inline_block">
    <h4>
      <a class="nd_learning_outline_0 nd_learning_padding_20_15 nd_learning_display_inline_block nd_options_first_font nd_options_color_greydark" href="#nd_learning_single_course_attendees">
        '.__('Attendees','nd-learning').'
      </a>
    </h4>
  </li>
    ';

    echo $nd_learning_attendees_tab;

}


//add shortcode in the custom hook
add_action('nd_learning_single_course_tab_list_content','nd_learning_shortcode_attendees');

//START  nd_learning_attendees
function nd_learning_shortcode_attendees() {

  global $wpdb;

  $nd_learning_result = '';
  $nd_learning_course_id = get_the_ID();
  $nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';

  if (nd_learning_get_course_price($nd_learning_course_id) == 0) {
    $nd_learning_action_type = "'free'";
  }else{
    $nd_learning_action_type = "'paypal'";
  }

  //START select for items
  $nd_learning_attendees = $wpdb->get_results( "SELECT id_user FROM $nd_learning_table_name WHERE id_course = $nd_learning_course_id AND action_type = $nd_learning_action_type");

  $nd_learning_result .= '<div class="nd_learning_section" id="nd_learning_single_course_attendees">';


  $nd_learning_meta_box_max_availability = get_post_meta( $nd_learning_course_id, 'nd_learning_meta_box_max_availability', true );
  $nd_learning_course_seats_available = $nd_learning_meta_box_max_availability - nd_learning_get_all_orders_by_id($nd_learning_course_id);
  

  //title section
  $nd_learning_result .= '
  <div class="nd_learning_section nd_learning_height_40"></div>
  <h3><strong>'.__('Course Attendees','nd-learning').'</strong></h3>
  <div class="nd_learning_section nd_learning_height_30"></div>
  ';

  //no results
  if ( empty($nd_learning_attendees) ) { 

    $nd_learning_result .= '<p>'.__('Still no participant','nd-learning').'</p>'; 

  }else{


    $nd_learning_result .= '

      <div class="nd_learning_section">

        <div class="nd_learning_width_33_percentage nd_learning_width_100_percentage_all_iphone nd_learning_padding_right_20 nd_learning_padding_right_0_all_iphone nd_learning_float_left nd_learning_box_sizing_border_box">

            <div class=" nd_learning_border_radius_3 nd_learning_section nd_learning_border_1_solid_grey  nd_learning_padding_30 nd_learning_box_sizing_border_box">
                <div class="nd_learning_section nd_learning_text_align_center   nd_learning_box_sizing_border_box">

                    <h1 class="nd_learning_font_size_50 "><strong>'.nd_learning_get_all_orders_by_id($nd_learning_course_id).'</strong></h1>

                    <p>'.__('Attendees','nd-learning').'</p>

                </div>
            </div>

        </div>

        <div class="nd_learning_width_33_percentage nd_learning_width_100_percentage_all_iphone nd_learning_padding_right_20 nd_learning_padding_left_0_all_iphone nd_learning_padding_right_0_all_iphone nd_learning_padding_left_20 nd_learning_float_left nd_learning_box_sizing_border_box">

            <div class=" nd_learning_border_radius_3 nd_learning_section nd_learning_border_1_solid_grey  nd_learning_padding_30 nd_learning_box_sizing_border_box">
                <div class="nd_learning_section nd_learning_text_align_center   nd_learning_box_sizing_border_box">

                    <h1 class="nd_learning_font_size_50 "><strong>'.nd_learning_get_course_availability($nd_learning_course_id).'</strong></h1>

                    <p>'.__('Available','nd-learning').'</p>

                </div>
            </div>

        </div>

        <div class="nd_learning_width_33_percentage nd_learning_width_100_percentage_all_iphone nd_learning_padding_left_20 nd_learning_padding_left_0_all_iphone nd_learning_float_left nd_learning_box_sizing_border_box">

            <div class=" nd_learning_border_radius_3 nd_learning_section nd_learning_border_1_solid_grey  nd_learning_padding_30 nd_learning_box_sizing_border_box">
                <div class="nd_learning_section nd_learning_text_align_center   nd_learning_box_sizing_border_box">

                    <h1 class="nd_learning_font_size_50 "><strong>'.nd_learning_get_course_max_availability($nd_learning_course_id).'</strong></h1>

                    <p>'.__('Maximum','nd-learning').'</p>

                </div>
            </div>

        </div>

    </div>


    <div class="nd_learning_section nd_learning_height_30"></div>

    ';



    foreach ( $nd_learning_attendees as $nd_learning_attendee ) 
    {
      
      $nd_learning_attendees_avatar_url_args = array(
        'size'   => 300
      );
      $nd_learning_attendees_avatar_url = get_avatar_url($nd_learning_attendee->id_user, $nd_learning_attendees_avatar_url_args);
      $nd_learning_attendee_id = $nd_learning_attendee->id_user;

      $nd_learning_result .= '
                                 
          <!--START preview-->
          <div class="nd_learning_width_25_percentage nd_learning_width_50_percentage_all_iphone nd_learning_padding_20 nd_learning_float_left nd_learning_box_sizing_border_box">
              <div class="nd_learning_section nd_learning_box_sizing_border_box">

                  <div class="nd_learning_section nd_learning_position_relative">
                          
                      <img alt="" class="nd_learning_single_course_page_attendes_image nd_learning_section" src="'.$nd_learning_attendees_avatar_url.'">

                      <div class="nd_learning_single_course_page_attendes_filter nd_learning_bg_greydark_alpha_gradient_3 nd_learning_position_absolute nd_learning_left_0 nd_learning_height_100_percentage nd_learning_width_100_percentage nd_learning_box_sizing_border_box">
                          
                          <div class="nd_learning_position_absolute nd_learning_bottom_20 nd_learning_width_100_percentage nd_learning_padding_bottom_0 nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_text_align_center">
                              <h5 class="nd_learning_color_white_important"><strong>'.get_userdata($nd_learning_attendee_id)->user_firstname.'</strong></h5>
                          </div>

                      </div>

                  </div>

              </div>
          </div>
          <!--END preview-->

      ';


    }

  }

  $nd_learning_result .= '</div>';

  echo $nd_learning_result;
  //END select for items


}
add_shortcode('nd_learning_attendees', 'nd_learning_shortcode_attendees');
//END nd_learning_login



//include all files
foreach ( glob ( plugin_dir_path( __FILE__ ) . "shortcodes/*.php" ) as $file ){
  include_once $file;
}


?>