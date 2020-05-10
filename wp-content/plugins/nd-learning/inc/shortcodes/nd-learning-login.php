<?php

//START  nd_learning_login
function nd_learning_shortcode_login() {

  //recover datas from plugin settings
  $nd_learning_account_page = get_option('nd_learning_account_page');
  $nd_learning_account_page_url = get_permalink($nd_learning_account_page);

  $args = array(
      'echo'           => false,
      'redirect'       => $nd_learning_account_page_url, 
      'form_id'        => 'nd_learning_shortcode_account_login_form',
      'label_username' => __( 'Username','nd-learning' ),
      'label_password' => __( 'Password','nd-learning' ),
      'label_remember' => __( 'Remember Me','nd-learning' ),
      'label_log_in'   => __( 'Log In','nd-learning' ),
      'id_username'    => 'nd_learning_login_form_user',
      'id_password'    => 'nd_learning_login_form_password',
      'id_remember'    => 'nd_learning_login_form_remember',
      'id_submit'      => 'nd_learning_login_form_submit',
      'remember'       => true,
      'value_username' => NULL,
      'value_remember' => false
  );


  return wp_login_form( $args );


}
add_shortcode('nd_learning_login', 'nd_learning_shortcode_login');
//END nd_learning_login