<?php

//create Menu
add_action('nd_learning_add_menu_settings','nd_learning_add_free_orders_page');
function nd_learning_add_free_orders_page(){

  add_submenu_page( 'nd-learning-settings','ND Free Orders', __('Free Orders','nd-learning'), 'manage_options', 'nd-learning-free-orders-page', 'nd_learning_free_orders_page' );

}


//call library
if (!class_exists('WP_List_Table')) {
 require_once(ABSPATH.'wp-admin/includes/class-wp-list-table.php');
}
 


//nd_learning_free_orders
class nd_learning_free_orders extends WP_List_Table
{
  


  //prepare all orders
  function nd_learning_prepare_free_orders()
  {
    
    global $wpdb;
    $nd_learning_table_name = $wpdb->prefix.'nd_learning_courses';
    
    //pagination
    $nd_learning_per_page = 10;

    $nd_learning_action_type = "'free'";
    $nd_learning_columns  = $this->get_columns();
    $nd_learning_hidden   = $this->get_columns_hidden();
    $nd_learning_sortable = $this->get_columns_sortable();
 
    $this->_column_headers = array($nd_learning_columns,$nd_learning_hidden,$nd_learning_sortable);
 
    if (!isset($_REQUEST['paged'])) $nd_learning_paged = 0;
      else $nd_learning_paged = max(0,(intval($_REQUEST['paged'])-1)*10);
 
    if (isset($_REQUEST['orderby'])
        and in_array($_REQUEST['orderby'],array_keys($nd_learning_sortable)))
    $nd_learning_orderby = sanitize_text_field($_REQUEST['orderby']); else $nd_learning_orderby = 'id';
 
    if (isset($_REQUEST['order'])
        and in_array($_REQUEST['order'],array('asc','desc')))
    $nd_learning_order = sanitize_text_field($_REQUEST['order']); else $nd_learning_order = 'asc';
 

    $nd_learning_all_orders = $wpdb->get_var(
      "SELECT COUNT(id) FROM $nd_learning_table_name WHERE action_type = $nd_learning_action_type");
 
    
    $this->items = $wpdb->get_results($wpdb->prepare(
            "SELECT * FROM $nd_learning_table_name ".
            "WHERE action_type = $nd_learning_action_type".
            "ORDER BY $nd_learning_orderby $nd_learning_order ".
            "LIMIT %d OFFSET %d",$nd_learning_per_page, $nd_learning_paged), ARRAY_A);


    //pagination
    $this->set_pagination_args( 
      array(
        'total_items' => $nd_learning_all_orders,                  
        'per_page'    => $nd_learning_per_page                     
      ) 
    );
    


  }
 

 

  //get columns
  function get_columns()
  {
    $nd_learning_columns = array(
      'id' => __('ID Order','nd-learning'),
      'id_course' => __('ID Course','nd-learning'),
      #'course_price' => 'Price',
      'date' => __('Date','nd-learning'),
      #'qnt' => 'qnt',
      #'paypal_payment_status' => 'Payment Status',
      #'paypal_currency' => 'paypal_currency',
      'paypal_email' => __('Email','nd-learning'),
      #'paypal_tx' => 'paypal_tx',
      'id_user' => __('ID User','nd-learning'),
      #'user_country' => 'user_country',
      #'user_address' => 'user_address',
      'user_first_name' => __('Name','nd-learning'),
      'user_last_name' => __('Surname','nd-learning'),
      #'user_city' => 'user_city',
      #'action_type' => 'action_type',
    );
    return $nd_learning_columns;
  }
 



  //get_columns_sortable
  function get_columns_sortable()
  {
    $nd_learning_sortable_columns = array(
      'id'       => array('id',true),
      'id_course'       => array('id_course',true),
    );
    return $nd_learning_sortable_columns;
  }
 
  


  //get_columns_hidden column_default
  function get_columns_hidden() { return array(); }
  function column_default($nd_learning_item,$nd_learning_column_name) {  
    return $nd_learning_item[$nd_learning_column_name]; 
  }


  
  //column_id
  function column_id($nd_learning_item)
  {
   
    $nd_learning_actions = array(
      'edit'   => 
        sprintf('<a href="?page=%s&action=%s&id=%s">'.__('Edit','nd-learning').'</a>',
           $_REQUEST['page'],'edit',$nd_learning_item['id']),
   
      'delete' => 
        sprintf('<a href="?page=%s&action=%s&id=%s">'.__('Delete','nd-learning').'</a>',
           $_REQUEST['page'],'delete',$nd_learning_item['id']),
    );

    return sprintf('%1$s %2$s',$nd_learning_item['id'],
      $this->row_actions($nd_learning_actions));
  }


 
}





//nd_learning_free_orders_page
function nd_learning_free_orders_page()
{
  
  $nd_learning_table = new nd_learning_free_orders();
  $nd_learning_table->nd_learning_prepare_free_orders();
 
  $nd_learning_page  = filter_input(INPUT_GET,'page' ,FILTER_SANITIZE_STRIPPED);
  $nd_learning_paged = filter_input(INPUT_GET,'paged',FILTER_SANITIZE_NUMBER_INT);


  //declare
  if ( isset($_GET['action']) ) {} else { $_GET['action'] = ''; }


  //DELETE
  if ( $_GET['action'] == 'delete' ) {


    $nd_learning_record_to_delete = sanitize_text_field($_GET['id']);

    

    //START delete query
    if ( isset($_POST['nd_learning_delete_record']) ) {

      global $wpdb;

      $nd_learning_table_name = $wpdb->prefix.'nd_learning_courses';

      $wpdb->delete( 
        $nd_learning_table_name, 
        array( 
          'id' => sanitize_text_field($_POST['nd_learning_delete_record_id'])
        ) 
      );

      echo '

        <div id="setting-error-settings_updated" class="error settings-error notice is-dismissible"> 
          <p>
            <strong>'.__('Record Deleted','nd-learning').'</strong>
          </p>
          <button type="button" class="notice-dismiss">
            <span class="screen-reader-text">'.__('Dismiss this notice.','nd-learning').'</span>
          </button>
        </div>

      ';

    }else{

      $nd_learning_edit_page_result = '';

      $nd_learning_edit_page_result .= '

        <div class="wrap">

          <h2>'.__('Delete Record with ID : ','nd-learning').' '.$nd_learning_record_to_delete.'</h2>

          <form method="POST">
            <table class="form-table">
              <tbody>
                <tr>
                  <th scope="row">
                    <label>'.__('ID','nd-learning').'</label>
                  </th>
                  <td>
                    <input name="nd_learning_delete_record_id" readonly value="'.$nd_learning_record_to_delete.'" type="text" class="regular-text">
                    <input type="hidden" name="nd_learning_delete_record" value="nd_learning_delete_record" >
                  </td>
                </tr>
              </tbody>
            </table>

            <p class="submit">
              <input type="submit" class="button button-primary" value="'.__('Confirm Delete','nd-learning').'">
            </p>

          </form>

        </div>';


      echo $nd_learning_edit_page_result;

    }
    //END



  }
  //EDIT
  elseif ( $_GET['action'] == 'edit' ){


    if ( isset($_POST['nd_learning_edit_record']) ) {

      global $wpdb;
      $nd_learning_table_name = $wpdb->prefix . 'nd_learning_courses';

      //START INSERT DB
      $nd_learning_edit_record = $wpdb->update( 
        
        $nd_learning_table_name, 
        
        array( 
          'id_course' => sanitize_text_field($_POST['nd_learning_order_info_id_course']),
          'date' => sanitize_text_field($_POST['nd_learning_order_info_date']),
          'id_user' => sanitize_text_field($_POST['nd_learning_order_info_id_user']),
          'user_country' => sanitize_text_field($_POST['nd_learning_order_info_user_country']),
          'user_address' => sanitize_text_field($_POST['nd_learning_order_info_user_address']),
          'user_first_name' => sanitize_text_field($_POST['nd_learning_order_info_user_first_name']),
          'user_last_name' => sanitize_text_field($_POST['nd_learning_order_info_user_last_name']),
          'user_city' => sanitize_text_field($_POST['nd_learning_order_info_user_city']),
        ),
        array( 'ID' => sanitize_text_field($_POST['nd_learning_order_info_id']) )

      );
      
      if ($nd_learning_edit_record){

        echo '

          <div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"> 
            <p>
              <strong>'.__('Settings saved.','nd-learning').'</strong>
            </p>
            <button type="button" class="notice-dismiss">
              <span class="screen-reader-text">'.__('Dismiss this notice.','nd-learning').'</span>
            </button>
          </div>

        ';

      }else{

        #$wpdb->show_errors();
        #$wpdb->print_error();

      }

    }



    $nd_learning_record_to_edit = sanitize_text_field($_GET['id']);

    global $wpdb;

    $nd_learning_table_name = $wpdb->prefix.'nd_learning_courses';

    $nd_learning_order_info = $wpdb->get_row( "SELECT * FROM $nd_learning_table_name WHERE id = ".$nd_learning_record_to_edit." " );


    $nd_learning_edit_page_result = '';


    $nd_learning_edit_page_result .= '

      <div class="wrap">

        <h2>'.__('Edit Record with ID : ','nd-learning').' '.$nd_learning_order_info->id.'</h2>


        <form method="POST">
          <table class="form-table">
            <tbody>
              <tr>
                <th scope="row">
                  <label>'.__('ID','nd-learning').'</label>
                </th>
                <td>
                  <input name="nd_learning_order_info_id" readonly value="'.$nd_learning_order_info->id.'" type="text" class="regular-text">
                  <input type="hidden" name="nd_learning_edit_record" value="edit-record" >
                </td>
              </tr>


              <tr>
                <th scope="row">
                  <label>'.__('Id Course','nd-learning').'</label>
                </th>
                <td>
              <input name="nd_learning_order_info_id_course" class="regular-text" type="text" value="'.$nd_learning_order_info->id_course.'">
              </td>
              </tr>

              <tr>
                <th scope="row">
                  <label>'.__('Date','nd-learning').'</label>
                </th>
                <td>
              <input name="nd_learning_order_info_date" class="regular-text" type="text" value="'.$nd_learning_order_info->date.'">
              </td>
              </tr>

              <tr>
                <th scope="row">
                  <label>'.__('Id User','nd-learning').'</label>
                </th>
                <td>
              <input name="nd_learning_order_info_id_user" class="regular-text" type="text" value="'.$nd_learning_order_info->id_user.'">
              </td>
              </tr>


              <tr>
                <th scope="row">
                  <label>'.__('User Country','nd-learning').'</label>
                </th>
                <td>
              <input name="nd_learning_order_info_user_country" class="regular-text" type="text" value="'.$nd_learning_order_info->user_country.'">
              </td>
              </tr>


              <tr>
                <th scope="row">
                  <label>'.__('User Address','nd-learning').'</label>
                </th>
                <td>
              <input name="nd_learning_order_info_user_address" class="regular-text" type="text" value="'.$nd_learning_order_info->user_address.'">
              </td>
              </tr>


              <tr>
                <th scope="row">
                  <label>'.__('User First Name','nd-learning').'</label>
                </th>
                <td>
              <input name="nd_learning_order_info_user_first_name" class="regular-text" type="text" value="'.$nd_learning_order_info->user_first_name.'">
              </td>
              </tr>


              <tr>
                <th scope="row">
                  <label>'.__('User Last Name','nd-learning').'</label>
                </th>
                <td>
              <input name="nd_learning_order_info_user_last_name" class="regular-text" type="text" value="'.$nd_learning_order_info->user_last_name.'">
              </td>
              </tr>


              <tr>
                <th scope="row">
                  <label>'.__('User City','nd-learning').'</label>
                </th>
                <td>
              <input name="nd_learning_order_info_user_city" class="regular-text"  type="text" value="'.$nd_learning_order_info->user_city.'">
  </td>
              </tr>



            </tbody>
          </table>



          <p class="submit">
            <input type="submit" class="button button-primary" value="'.__('Save Changes','nd-learning').'">
          </p>

        </form>

      </div>

    ';



    echo $nd_learning_edit_page_result;


  }
  //DISPLAY ALL ORDERS
  else{

    echo '<div class="wrap">';
    echo '<h2>'.__('Free Orders','nd-learning').'</h2>';   
    echo '<form id="personale-table" method="GET">';
    echo '<input type="hidden" name="paged" value="'.$nd_learning_paged.'"/>';
      $nd_learning_table->display();
    echo '</form>';
    echo '</div>';

  }


}