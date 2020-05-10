<?php
/*
Plugin Name:       Learning Courses
Description:       The plugin is used to manage your courses and teachers. To get started: 1) Click the "Activate" link to the left of this description. 2) Follow the documentation for installation for use the plugin in the better way.
Version:           4.9
Plugin URI:        https://nicdark.com
Author:            Nicdark
Author URI:        https://nicdark.com
License:           GPLv2 or later
*/


//translation
function nd_learning_load_textdomain()
{
  load_plugin_textdomain("nd-learning", false, dirname(plugin_basename(__FILE__)) . '/languages');
}
add_action('plugins_loaded', 'nd_learning_load_textdomain');


///////////////////////////////////////////////////DB///////////////////////////////////////////////////////////////
register_activation_hook( __FILE__, 'nd_learning_create_courses_db' );
function nd_learning_create_courses_db()
{
    global $wpdb;

    $nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';

    $nd_learning_sql = "CREATE TABLE $nd_learning_table_name (
      id int(11) NOT NULL AUTO_INCREMENT,
      id_course int(11) NOT NULL,
      course_price int(11) NOT NULL,
      date varchar(255) NOT NULL,
      qnt int(11) NOT NULL,
      paypal_payment_status varchar(255) NOT NULL,
      paypal_currency varchar(255) NOT NULL,
      paypal_email varchar(255) NOT NULL,
      paypal_tx varchar(255) NOT NULL,
      id_user int(11) NOT NULL,
      user_country varchar(255) NOT NULL,
      user_address varchar(255) NOT NULL,
      user_first_name varchar(255) NOT NULL,
      user_last_name varchar(255) NOT NULL,
      user_city varchar(255) NOT NULL,
      action_type varchar(255) NOT NULL,
      UNIQUE KEY id (id)
    );";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $nd_learning_sql );
}
//END

///////////////////////////////////////////////////IMAGE SIZE///////////////////////////////////////////////////////////////

//create custom size for courses post grid
if ( function_exists( 'add_image_size' ) ) { 
  add_image_size( 'nd_learning_img_740_501', 740, 501, true ); 
  add_image_size( 'nd_learning_img_740_416', 740, 416, true ); 
  add_image_size( 'nd_learning_img_350_465', 350, 465, true ); 
}


///////////////////////////////////////////////////CSS STYLE///////////////////////////////////////////////////////////////
//add custom css
function nd_learning_scripts() {
  
  //basic css plugin
  wp_enqueue_style( 'nd_learning_style', esc_url(plugins_url('assets/css/style.css', __FILE__ )) );

  wp_enqueue_script('jquery');
  
}
add_action( 'wp_enqueue_scripts', 'nd_learning_scripts' );


///////////////////////////////////////////////////GET TEMPLATE ///////////////////////////////////////////////////////////////

function nd_learning_get_courses_template($nd_learning_single_course_template) {
     global $post;

     if ($post->post_type == 'courses') {
          $nd_learning_single_course_template = dirname( __FILE__ ) . '/templates/single-course.php';
     }
     return $nd_learning_single_course_template;
}
add_filter( 'single_template', 'nd_learning_get_courses_template' );


//update theme options
function nd_learning_theme_setup_update(){
    update_option( 'nicdark_theme_author', 0 );
}
add_action( 'after_switch_theme' , 'nd_learning_theme_setup_update');


function nd_learning_get_teachers_template($nd_learning_single_teacher_template) {
     global $post;

     if ($post->post_type == 'teachers') {
          $nd_learning_single_teacher_template = dirname( __FILE__ ) . '/templates/single-teacher.php';
     }
     return $nd_learning_single_teacher_template;
}
add_filter( 'single_template', 'nd_learning_get_teachers_template' );

function nd_learning_get_archive_template($nd_learning_archive_template) {
     global $post; 

     if ( 

      is_post_type_archive('courses') or 
      is_post_type_archive('teachers') or 
      is_tax('category-teacher') or
      is_tax('difficulty-level-course') or
      is_tax('category-course') or
      is_tax('location-course') or
      is_tax('typology-course') or
      is_tax('duration-course')


       ) {
          $nd_learning_archive_template = dirname( __FILE__ ) . '/templates/archive.php';
     }
     return $nd_learning_archive_template;
}
add_filter( 'template_include', 'nd_learning_get_archive_template' );


///////////////////////////////////////////////////CPT///////////////////////////////////////////////////////////////
foreach ( glob ( plugin_dir_path( __FILE__ ) . "inc/cpt/*.php" ) as $file ){
  include_once $file;
}

///////////////////////////////////////////////////SHORTCODES ///////////////////////////////////////////////////////////////
foreach ( glob ( plugin_dir_path( __FILE__ ) . "inc/shortcodes/*.php" ) as $file ){
  include_once $file;
}

///////////////////////////////////////////////////ADDONS ///////////////////////////////////////////////////////////////
foreach ( glob ( plugin_dir_path( __FILE__ ) . "addons/*/index.php" ) as $file ){
  include_once $file;
}

///////////////////////////////////////////////////FUNCTIONS///////////////////////////////////////////////////////////////
require_once dirname( __FILE__ ) . '/inc/functions/functions.php';

///////////////////////////////////////////////////METABOX ///////////////////////////////////////////////////////////////
foreach ( glob ( plugin_dir_path( __FILE__ ) . "inc/metabox/*.php" ) as $file ){
  include_once $file;
}

///////////////////////////////////////////////////PLUGIN SETTINGS ///////////////////////////////////////////////////////////
require_once dirname( __FILE__ ) . '/inc/admin/plugin-settings.php';



//function for get plugin version
function nd_learning_get_plugin_version(){

    $nd_learning_plugin_data = get_plugin_data( __FILE__ );
    $nd_learning_plugin_version = $nd_learning_plugin_data['Version'];

    return $nd_learning_plugin_version;

}



