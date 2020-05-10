<?php


function nd_learning_registration_form( $nd_learning_username, $nd_learning_password, $nd_learning_email, $nd_learning_website, $nd_learning_first_name, $nd_learning_last_name, $nd_learning_nickname, $nd_learning_bio ) {
     
    echo '
    <form action="'.esc_url_raw($_SERVER['REQUEST_URI']).'" method="post">
    

    <p>
      <label class="nd_learning_section nd_learning_margin_top_20">'.__('Username *','nd-learning').'</label>
      <input type="text" name="nd_learning_username" class=" nd_learning_section" value="' . ( isset( $_POST['nd_learning_username'] ) ? $nd_learning_username : null ) . '">
    </p>
    <p>
      <label class="nd_learning_section nd_learning_margin_top_20">'.__('Password *','nd-learning').'</label>
      <input type="password" name="nd_learning_password" class=" nd_learning_section" value="' . ( isset( $_POST['nd_learning_password'] ) ? $nd_learning_password : null ) . '">
    </p>
    <p>
      <label class="nd_learning_section nd_learning_margin_top_20">'.__('Email *','nd-learning').'</label>
      <input type="text" name="nd_learning_email" class=" nd_learning_section" value="' . ( isset( $_POST['nd_learning_email']) ? $nd_learning_email : null ) . '">
    </p>
    <p>
      <label class="nd_learning_section nd_learning_margin_top_20">'.__('Website','nd-learning').'</label>
      <input type="text" name="nd_learning_website" class=" nd_learning_section" value="' . ( isset( $_POST['nd_learning_website']) ? $nd_learning_website : null ) . '">
    </p>
    <p>
      <label class="nd_learning_section nd_learning_margin_top_20">'.__('First Name','nd-learning').'</label>
      <input type="text" name="nd_learning_first_name" class="nd_learning_section" value="' . ( isset( $_POST['nd_learning_first_name']) ? $nd_learning_first_name : null ) . '">
    </p>
    <p>
      <label class="nd_learning_section nd_learning_margin_top_20">'.__('Last Name','nd-learning').'</label>
      <input type="text" name="nd_learning_last_name" class="nd_learning_section" value="' . ( isset( $_POST['nd_learning_last_name']) ? $nd_learning_last_name : null ) . '">
    </p>
    <p>
      <label class="nd_learning_section nd_learning_margin_top_20">'.__('Nickname','nd-learning').'</label>
      <input type="text" name="nd_learning_nickname" class="nd_learning_section" value="' . ( isset( $_POST['nd_learning_nickname']) ? $nd_learning_nickname : null ) . '">
    </p>
    <p>
      <label class="nd_learning_section nd_learning_margin_top_20">'.__('About / Bio','nd-learning').'</label>
      <textarea class="nd_learning_section" name="nd_learning_bio">' . ( isset( $_POST['nd_learning_bio']) ? $nd_learning_bio : null ) . '</textarea>
    </p>
    <input class="nd_learning_section nd_learning_margin_top_20" type="submit" name="submit" value="'.__('Register','nd-learning').'"/>
    </form>
    ';
}




function nd_learning_registration_validation( $nd_learning_username, $nd_learning_password, $nd_learning_email, $nd_learning_website, $nd_learning_first_name, $nd_learning_last_name, $nd_learning_nickname, $nd_learning_bio )  {


  global $nd_learning_reg_errors;
  $nd_learning_reg_errors = new WP_Error;

  if ( empty( $nd_learning_username ) || empty( $nd_learning_password ) || empty( $nd_learning_email ) ) {
      $nd_learning_reg_errors->add('field', 'Required form field is missing');
  }


  if ( 4 > strlen( $nd_learning_username ) ) {
      $nd_learning_reg_errors->add( 'username_length', 'Username too short. At least 4 characters is required' );
  }

  if ( username_exists( $nd_learning_username ) )
      $nd_learning_reg_errors->add('user_name', 'Sorry, that username already exists!');

    if ( ! validate_username( $nd_learning_username ) ) {
      $nd_learning_reg_errors->add( 'username_invalid', 'Sorry, the username you entered is not valid' );
  }

  if ( 5 > strlen( $nd_learning_password ) ) {
          $nd_learning_reg_errors->add( 'nd_learning_password', 'Password length must be greater than 5' );
      }

      if ( !is_email( $nd_learning_email ) ) {
      $nd_learning_reg_errors->add( 'email_invalid', 'Email is not valid' );
  }

  if ( email_exists( $nd_learning_email ) ) {
      $nd_learning_reg_errors->add( 'nd_learning_email', 'Email Already in use' );
  }

  if ( ! empty( $nd_learning_website ) ) {
      if ( ! filter_var( $nd_learning_website, FILTER_VALIDATE_URL ) ) {
          $nd_learning_reg_errors->add( 'nd_learning_website', 'Website is not a valid URL' );
      }
  }

  if ( is_wp_error( $nd_learning_reg_errors ) ) {
   
      foreach ( $nd_learning_reg_errors->get_error_messages() as $nd_learning_error ) {
       
          echo '<div class="nd_learning_margin_top_20">';
          echo '<strong class="nd_learning_text_decoration_underline">'.__('ERROR','nd-learning').'</strong> : ';
          echo $nd_learning_error;
          echo '</div>';
           
      }
   
  }

}


function nd_learning_complete_registration() {
    global $nd_learning_reg_errors, $nd_learning_username, $nd_learning_password, $nd_learning_email, $nd_learning_website, $nd_learning_first_name, $nd_learning_last_name, $nd_learning_nickname, $nd_learning_bio;
    if ( 1 > count( $nd_learning_reg_errors->get_error_messages() ) ) {
        $nd_learning_userdata = array(
        'user_login'    =>   $nd_learning_username,
        'user_email'    =>   $nd_learning_email,
        'user_pass'     =>   $nd_learning_password,
        'user_url'      =>   $nd_learning_website,
        'first_name'    =>   $nd_learning_first_name,
        'last_name'     =>   $nd_learning_last_name,
        'nickname'      =>   $nd_learning_nickname,
        'description'   =>   $nd_learning_bio,
        );
        $nd_learning_user = wp_insert_user( $nd_learning_userdata );
        echo '<div class="nd_learning_section nd_learning_color_white_important nd_learning_bg_green nd_learning_padding_20 nd_learning_margin_top_20 nd_learning_box_sizing_border_box nd_learning_border_radius_3"><span class="nd_options_first_font">'.__('REGISTRATION COMPLETED','nd-learning').'</span> : '.__('Please for make the login using the form on the left.','nd-learning').'</div>';   
    }
}



function nd_learning_custom_registration_function() {
    if ( isset($_POST['submit'] ) ) {


        nd_learning_registration_validation(
        $_POST['nd_learning_username'],
        $_POST['nd_learning_password'],
        $_POST['nd_learning_email'],
        $_POST['nd_learning_website'],
        $_POST['nd_learning_first_name'],
        $_POST['nd_learning_last_name'],
        $_POST['nd_learning_nickname'],
        $_POST['nd_learning_bio']
        );
         
        // sanitize user form input
        global $nd_learning_username, $nd_learning_password, $nd_learning_email, $nd_learning_website, $nd_learning_first_name, $nd_learning_last_name, $nd_learning_nickname, $nd_learning_bio;
        $nd_learning_username   =   sanitize_user( $_POST['nd_learning_username'] );
        $nd_learning_password   =   esc_attr( $_POST['nd_learning_password'] );
        $nd_learning_email      =   sanitize_email( $_POST['nd_learning_email'] );
        $nd_learning_website    =   esc_url( $_POST['nd_learning_website'] );
        $nd_learning_first_name =   sanitize_text_field( $_POST['nd_learning_first_name'] );
        $nd_learning_last_name  =   sanitize_text_field( $_POST['nd_learning_last_name'] );
        $nd_learning_nickname   =   sanitize_text_field( $_POST['nd_learning_nickname'] );
        $nd_learning_bio        =   esc_textarea( $_POST['nd_learning_bio'] );
 
        // call @function complete_registration to create the user
        // only when no WP_error is found
        nd_learning_complete_registration(
        $nd_learning_username,
        $nd_learning_password,
        $nd_learning_email,
        $nd_learning_website,
        $nd_learning_first_name,
        $nd_learning_last_name,
        $nd_learning_nickname,
        $nd_learning_bio
        );
    }


    if ( isset( $nd_learning_username ) ) {

    }else{

      $nd_learning_username = ''; $nd_learning_password = ''; $nd_learning_email = ''; $nd_learning_website = '';
      $nd_learning_first_name = ''; $nd_learning_last_name = ''; $nd_learning_nickname = ''; $nd_learning_bio = '';

    }
 
    

    nd_learning_registration_form(
        $nd_learning_username,
        $nd_learning_password,
        $nd_learning_email,
        $nd_learning_website,
        $nd_learning_first_name,
        $nd_learning_last_name,
        $nd_learning_nickname,
        $nd_learning_bio
        );
}





add_shortcode( 'nd_learning_register', 'nd_learning_shortcode_register' );
function nd_learning_shortcode_register() {

    ob_start();

    //call function
    nd_learning_custom_registration_function();
    return ob_get_clean();

}



