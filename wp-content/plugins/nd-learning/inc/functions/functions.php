<?php


/*PAGE SETTINGS*/
function nd_learning_get_account_page() {

  $nd_learning_account_page = get_option('nd_learning_account_page');
  $nd_learning_account_page_url = get_permalink($nd_learning_account_page);

  return $nd_learning_account_page_url;

}

function nd_learning_get_compare_page() {

  $nd_learning_compare_page = get_option('nd_learning_compare_page');
  $nd_learning_compare_page_url = get_permalink($nd_learning_compare_page);

  return $nd_learning_compare_page_url;

}


function nd_learning_get_order_page() {

  $nd_learning_order_page = get_option('nd_learning_order_page');
  $nd_learning_order_page_url = get_permalink($nd_learning_order_page);

  return $nd_learning_order_page_url;

}



/*COURSE INFORMATION*/
function nd_learning_get_course_availability($nd_learning_course_id){

	//max availability
	$nd_learning_meta_box_max_availability = get_post_meta( $nd_learning_course_id, 'nd_learning_meta_box_max_availability', true );

	//availability
	$nd_learning_course_availability = $nd_learning_meta_box_max_availability - nd_learning_get_all_orders_by_id($nd_learning_course_id);

	return $nd_learning_course_availability;
}

function nd_learning_get_course_price($nd_learning_course_id){

	$nd_learning_meta_box_price = get_post_meta( $nd_learning_course_id, 'nd_learning_meta_box_price', true );
    if ( $nd_learning_meta_box_price == 0 ) { 
        $nd_learning_course_price = 0;
    } else { 
        $nd_learning_course_price = $nd_learning_meta_box_price; 
    }

	return $nd_learning_course_price;

}

function nd_learning_get_course_date(){

	$nd_learning_course_date = get_post_meta( get_the_ID(), 'nd_learning_meta_box_date', true );

	return $nd_learning_course_date;

}


function nd_learning_get_course_color(){

	$nd_learning_course_color = get_post_meta( get_the_ID(), 'nd_learning_meta_box_color', true );

	return $nd_learning_course_color;

}


function nd_learning_get_course_max_availability($nd_learning_course_id){

	//max availability
	$nd_learning_meta_box_max_availability = get_post_meta( $nd_learning_course_id, 'nd_learning_meta_box_max_availability', true );

	return $nd_learning_meta_box_max_availability;
}


function nd_learning_get_course_duration(){

	$nd_learning_course_duration = '';
	$nd_learning_terms_duration_course = wp_get_post_terms( get_the_ID(), 'duration-course', array("fields" => "all"));
	foreach($nd_learning_terms_duration_course as $nd_learning_term_duration_course) { $nd_learning_course_duration .= $nd_learning_term_duration_course->name.' '; }

	return $nd_learning_course_duration;

}

function nd_learning_get_course_difficulty(){

	$nd_learning_course_difficulty = '';
	$nd_learning_terms_difficulty_course = wp_get_post_terms( get_the_ID(), 'difficulty-level-course', array("fields" => "all"));
	foreach($nd_learning_terms_difficulty_course as $nd_learning_term_difficulty_course) { $nd_learning_course_difficulty .= $nd_learning_term_difficulty_course->name.' '; }

	return $nd_learning_course_difficulty;

}

function nd_learning_get_course_category(){

	$nd_learning_course_category = '';
	$nd_learning_terms_category_course = wp_get_post_terms( get_the_ID(), 'category-course', array("fields" => "all"));
	foreach($nd_learning_terms_category_course as $nd_learning_term_category_course) { $nd_learning_course_category .= $nd_learning_term_category_course->name.' '; }

	return $nd_learning_course_category;

}

function nd_learning_get_course_currency(){

	$nd_learning_course_currency = get_option('nd_learning_currency');

	return $nd_learning_course_currency;

}

function nd_learning_get_course_image_url($nd_learning_course_id){

	$nd_learning_image_id = get_post_thumbnail_id( $nd_learning_course_id );
	$nd_learning_image_attributes = wp_get_attachment_image_src( $nd_learning_image_id, 'large' );
	if ( $nd_learning_image_attributes[0] == '' ) { $nd_learning_course_image_url = ''; }else{
	  $nd_learning_course_image_url = $nd_learning_image_attributes[0];
	}

	return $nd_learning_course_image_url;

}



/*TEACHER INFORMATION*/
function nd_learning_get_teacher_image_url(){

	$nd_learning_image_id = get_post_thumbnail_id( get_the_ID() );
	$nd_learning_image_attributes = wp_get_attachment_image_src( $nd_learning_image_id, 'large' );
	if ( $nd_learning_image_attributes[0] == '' ) { $nd_learning_teacher_image_url = ''; }else{
	  $nd_learning_teacher_image_url = $nd_learning_image_attributes[0];
	}

	return $nd_learning_teacher_image_url;

}

function nd_learning_get_teacher_role(){


	$nd_learning_teacher_role = get_post_meta( get_the_ID(), 'nd_learning_meta_box_teacher_role', true );

	return $nd_learning_teacher_role;

}

function nd_learning_get_teacher_location(){


	$nd_learning_teacher_location = get_post_meta( get_the_ID(), 'nd_learning_meta_box_teacher_location', true );

	return $nd_learning_teacher_location;

}

function nd_learning_get_teacher_email(){


	$nd_learning_teacher_email = get_post_meta( get_the_ID(), 'nd_learning_meta_box_teacher_email', true );

	return $nd_learning_teacher_email;

}

function nd_learning_get_teacher_telephone(){


	$nd_learning_teacher_telephone = get_post_meta( get_the_ID(), 'nd_learning_meta_box_teacher_telephone', true );

	return $nd_learning_teacher_telephone;

}

function nd_learning_get_teacher_skype(){


	$nd_learning_teacher_skype = get_post_meta( get_the_ID(), 'nd_learning_meta_box_teacher_skype', true );

	return $nd_learning_teacher_skype;

}

function nd_learning_get_teacher_website(){


	$nd_learning_teacher_website = get_post_meta( get_the_ID(), 'nd_learning_meta_box_teacher_website', true );

	return $nd_learning_teacher_website;

}

function nd_learning_get_teacher_number_courses($nd_learning_teacher_id){

    $nd_learning_teacher_info = get_post($nd_learning_teacher_id);
    $nd_learning_teacher_slug = $nd_learning_teacher_info->post_name;

	$nd_learning_args = array(
	    'post_type' => 'courses',
	    
	    'meta_query' => array( 
            
            'relation' => 'OR',

            array( 
                'key' => 'nd_learning_meta_box_teacher', 
                'value' => array($nd_learning_teacher_id)
            ),
            array( 
                'key' => 'nd_learning_meta_box_teachers', 
                'value' => $nd_learning_teacher_slug,
                'compare' => 'LIKE'
            )
        )
	);

  	$nd_learning_the_query = new WP_Query( $nd_learning_args );

  	$nd_learning_teacher_number_courses = 0;

  	while ( $nd_learning_the_query->have_posts() ) : $nd_learning_the_query->the_post();

  		$nd_learning_teacher_number_courses = $nd_learning_teacher_number_courses + 1;

  	endwhile;

  	wp_reset_postdata();


	
	return $nd_learning_teacher_number_courses;

}




function nd_learning_get_id_courses_by_teacher($nd_learning_teacher_id){

    $nd_learning_teacher_info = get_post($nd_learning_teacher_id);
    $nd_learning_teacher_slug = $nd_learning_teacher_info->post_name;

	$nd_learning_args = array(
	    'post_type' => 'courses',
	    
	    'meta_query' => array( 
            
            'relation' => 'OR',

            array( 
                'key' => 'nd_learning_meta_box_teacher', 
                'value' => array($nd_learning_teacher_id)
            ),
            array( 
                'key' => 'nd_learning_meta_box_teachers', 
                'value' => $nd_learning_teacher_slug,
                'compare' => 'LIKE'
            )
        )
	);

  	$nd_learning_the_query = new WP_Query( $nd_learning_args );

  	$nd_learning_teacher_id_courses = '';

  	while ( $nd_learning_the_query->have_posts() ) : $nd_learning_the_query->the_post();

  		$nd_learning_course_id = get_the_ID();
  		$nd_learning_teacher_id_courses .= $nd_learning_course_id.',';

  	endwhile;

  	wp_reset_postdata();


	
	return $nd_learning_teacher_id_courses;

}


/*ORDER INFORMATION*/
function nd_learning_check_if_order_is_present($nd_learning_transiction_order,$nd_learning_course_id,$nd_learning_user_id){

	global $wpdb;

	$nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';

	//START query
	if ($nd_learning_transiction_order == 0) {

		$nd_learning_action_type = "'free'";
		$nd_learning_order_ids = $wpdb->get_results( "SELECT id FROM $nd_learning_table_name WHERE id_course = $nd_learning_course_id AND id_user = $nd_learning_user_id AND action_type = $nd_learning_action_type" );

	}else{

		$nd_learning_order_ids = $wpdb->get_results( "SELECT id FROM $nd_learning_table_name WHERE paypal_tx = '$nd_learning_transiction_order'" );

	}


	

	//no results
	if ( empty($nd_learning_order_ids) ) { 

	return 0;

	}else{

	return 1;

	}

}


function nd_learning_get_all_orders_by_id($nd_learning_course_id){

  global $wpdb;

  $nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';

  if ( nd_learning_get_course_price($nd_learning_course_id) == 0 ) {
    $nd_learning_action_type = "'free'";
  }else{
    $nd_learning_action_type = "'paypal'";
  }
  

  //START select for items
  $nd_learning_order_ids = $wpdb->get_results( "SELECT qnt FROM $nd_learning_table_name WHERE id_course = $nd_learning_course_id AND action_type = $nd_learning_action_type");

  //no results
  if ( empty($nd_learning_order_ids) ) { 

    return 0;
    
  }else{

    $nd_learning_result = 0;

    foreach ( $nd_learning_order_ids as $nd_learning_order_id ) 
    {
      $nd_learning_result = $nd_learning_order_id->qnt + $nd_learning_result;
    }

    return $nd_learning_result;

  }
  //END select for items 

}




/*REVIEW INFORMATION*/
function nd_learning_check_if_review_is_present($nd_learning_review_order_id,$nd_learning_review_course_id,$nd_learning_review_user_id){

	global $wpdb;

	$nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';


	$nd_learning_action_type = "'review'";
	$nd_learning_order_ids = $wpdb->get_results( "SELECT id FROM $nd_learning_table_name WHERE id_course = $nd_learning_review_course_id AND id_user = $nd_learning_review_user_id AND course_price = $nd_learning_review_order_id AND action_type = $nd_learning_action_type" );


	//no results
	if ( empty($nd_learning_order_ids) ) { 

	return 0;

	}else{

	return 1;

	}

}



function nd_learning_course_review_qnt($nd_learning_course_id){


	global $wpdb;

	$nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';


	$nd_learning_action_type = "'review'";
	$nd_learning_review_ids = $wpdb->get_results( "SELECT id FROM $nd_learning_table_name WHERE id_course = $nd_learning_course_id AND action_type = $nd_learning_action_type" );


	//no results
	if ( empty($nd_learning_review_ids) ) { 

	return 0;

	}else{

	return count($nd_learning_review_ids);

	}


}



function nd_learning_course_review_average($nd_learning_course_id){


	global $wpdb;

	$nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';


	$nd_learning_action_type = "'review'";
	$nd_learning_review_ids = $wpdb->get_results( "SELECT qnt FROM $nd_learning_table_name WHERE id_course = $nd_learning_course_id AND action_type = $nd_learning_action_type" );


	//no results
	if ( empty($nd_learning_review_ids) ) { 

	return 0;

	}else{

		$nd_learning_review_sum = 0;
		foreach ( $nd_learning_review_ids as $nd_learning_review_id ) 
	    {
			$nd_learning_review_sum = $nd_learning_review_sum+$nd_learning_review_id->qnt; 
	    }

	    $nd_learning_course_review_average = number_format($nd_learning_review_sum/nd_learning_course_review_qnt($nd_learning_course_id),1);


	    $nd_learning_zero = strpos($nd_learning_course_review_average, '0');
		if ($nd_learning_zero == true) {
			return number_format($nd_learning_course_review_average,0);
		}else{
			return $nd_learning_course_review_average;
		}
	     
	}


}




function nd_learning_get_rating_average_by_teacher($nd_learning_teacher_id){

	$nd_learning_courses_average = 0;
	$nd_learning_courses_total_average = 0;
	$nd_learning_qnt_average_courses = 0;


	$nd_learning_all_courses_teacher_id = nd_learning_get_id_courses_by_teacher($nd_learning_teacher_id);
  
	$nd_learning_courses_id_array = explode(',', $nd_learning_all_courses_teacher_id);

	

	for ($nd_learning_courses_id_array_i = 0; $nd_learning_courses_id_array_i < count($nd_learning_courses_id_array)-1; $nd_learning_courses_id_array_i++) {

		$nd_learning_courses_id = $nd_learning_courses_id_array[$nd_learning_courses_id_array_i];
		$nd_learning_course_average_rating = nd_learning_course_review_average($nd_learning_courses_id);
		 
		if ( $nd_learning_course_average_rating != 0 ) {

			$nd_learning_courses_total_average = $nd_learning_courses_total_average + $nd_learning_course_average_rating;
			$nd_learning_qnt_average_courses = $nd_learning_qnt_average_courses + 1;

		}

	}


	if ( $nd_learning_qnt_average_courses == 0 ) {

		$nd_learning_courses_average = 0;

	}else{

		$nd_learning_courses_average = number_format($nd_learning_courses_total_average/$nd_learning_qnt_average_courses,1);

	}
	

  	return $nd_learning_courses_average;

}




function nd_learning_get_qnt_rating_by_teacher($nd_learning_teacher_id){

	$nd_learning_qnt_rating = 0;


	$nd_learning_all_courses_teacher_id = nd_learning_get_id_courses_by_teacher($nd_learning_teacher_id);
  
	$nd_learning_courses_id_array = explode(',', $nd_learning_all_courses_teacher_id);

	

	for ($nd_learning_courses_id_array_i = 0; $nd_learning_courses_id_array_i < count($nd_learning_courses_id_array)-1; $nd_learning_courses_id_array_i++) {

		$nd_learning_courses_id = $nd_learning_courses_id_array[$nd_learning_courses_id_array_i];
		
		//START db query
		global $wpdb;
		$nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';
		$nd_learning_action_type = "'review'";
		$nd_learning_review_ids = $wpdb->get_results( "SELECT id FROM $nd_learning_table_name WHERE id_course = $nd_learning_courses_id AND action_type = $nd_learning_action_type" );	
		//no results
		if ( empty($nd_learning_review_ids) ){  }else{

			$nd_learning_qnt_rating = $nd_learning_qnt_rating + count($nd_learning_review_ids);

		}
		//END db query

	}

	
  	return $nd_learning_qnt_rating;

}




function nd_learning_course_review_number_qnt($nd_learning_course_id,$nd_learning_review_number){


	global $wpdb;

	$nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';


	$nd_learning_action_type = "'review'";
	$nd_learning_review_ids = $wpdb->get_results( "SELECT id FROM $nd_learning_table_name WHERE id_course = $nd_learning_course_id AND qnt = $nd_learning_review_number AND action_type = $nd_learning_action_type" );


	//no results
	if ( empty($nd_learning_review_ids) ) { 

	return 0;

	}else{

		return count($nd_learning_review_ids);

	}


}




function nd_learning_course_review_number_percentage($nd_learning_course_id,$nd_learning_review_number){

	return 100*nd_learning_course_review_number_qnt($nd_learning_course_id,$nd_learning_review_number)/nd_learning_course_review_qnt($nd_learning_course_id);

}





function nd_learning_course_review_star($nd_learning_review_number,$nd_learning_star_size,$nd_learning_star_color,$nd_learning_star_margin){


	//full star
	$nd_learning_review_i = 1;
	$nd_learning_review_images = '';
	while ( $nd_learning_review_i <= $nd_learning_review_number ) {

		$nd_learning_review_images .= '<img alt="" style="margin:'.$nd_learning_star_margin.';" width="'.$nd_learning_star_size.'" height="'.$nd_learning_star_size.'" src="'.esc_url(plugins_url('icon-star-full-'.$nd_learning_star_color.'.svg', __FILE__ )).'">' ;

		$nd_learning_review_i++;
	
	}


	//half star
	$nd_learning_dot = strpos($nd_learning_review_number, '.');
	if ($nd_learning_dot == true) {
		$nd_learning_review_images .= '<img alt="" style="margin:'.$nd_learning_star_margin.';" width="'.$nd_learning_star_size.'" height="'.$nd_learning_star_size.'" src="'.esc_url(plugins_url('icon-star-half-'.$nd_learning_star_color.'.svg', __FILE__ )).'">' ;
	}

	//empty star
	$nd_learning_review_i = 1;
	$nd_learning_review_number_empty = 5 - $nd_learning_review_number;

	while ( $nd_learning_review_i <= $nd_learning_review_number_empty ) {

		$nd_learning_review_images .= '<img alt="" style="margin:'.$nd_learning_star_margin.';" width="'.$nd_learning_star_size.'" height="'.$nd_learning_star_size.'" src="'.esc_url(plugins_url('icon-star-empty-'.$nd_learning_star_color.'.svg', __FILE__ )).'">' ;

		$nd_learning_review_i++;
	
	}


	return $nd_learning_review_images;

}



/*FOLLOWER INFORMATION*/
function nd_learning_follower_qnt_by_teacher($nd_learning_teacher_id){


	global $wpdb;

	$nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';


	$nd_learning_action_type = "'followers'";
	$nd_learning_qnt_followers = $wpdb->get_results( "SELECT id FROM $nd_learning_table_name WHERE id_course = $nd_learning_teacher_id AND action_type = $nd_learning_action_type" );


	//no results
	if ( empty($nd_learning_qnt_followers) ) { 

	return 0;

	}else{

		return count($nd_learning_qnt_followers);

	}


}



/*WORDPRESS INFORMATION*/

//function for get color profile admin
function nd_learning_get_profile_bg_color($nd_learning_color){
	
	global $_wp_admin_css_colors;
	$nd_learning_admin_color = get_user_option( 'admin_color' );
	
	$nd_learning_profile_bg_colors = $_wp_admin_css_colors[$nd_learning_admin_color]->colors; 


	if ( $nd_learning_profile_bg_colors[$nd_learning_color] == '#e5e5e5' ) {

		return '#6b6b6b';

	}else{

		return $nd_learning_profile_bg_colors[$nd_learning_color];
		
	}

	
}
      

    

