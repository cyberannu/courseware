<?php

///////////////////////////////////////////////////METABOX ///////////////////////////////////////////////////////////////


add_action( 'add_meta_boxes', 'nd_learning_box_add' );
function nd_learning_box_add() {
    add_meta_box( 'my-meta-box-id', __('Course Options','nd-learning'), 'nd_learning_meta_box', 'courses', 'normal', 'high' );
}

function nd_learning_meta_box()
{

    //date picker
    wp_enqueue_script('jquery-ui-datepicker'); 
    wp_enqueue_style( 'jquery-ui-datepicker-css', esc_url(plugins_url('jquery-ui-datepicker.css', __FILE__ )) );

    //jquery-ui-autocomplete
    wp_enqueue_script('jquery-ui-autocomplete'); 

    //iris color picker
    wp_enqueue_script('iris');

    // $post is already set, and contains an object: the WordPress post
    global $post;
    $nd_learning_values = get_post_custom( $post->ID );
     
    $nd_learning_meta_box_price = get_post_meta( get_the_ID(), 'nd_learning_meta_box_price', true );
    $nd_learning_meta_box_max_availability = get_post_meta( get_the_ID(), 'nd_learning_meta_box_max_availability', true );
    $nd_learning_meta_box_teacher = get_post_meta( get_the_ID(), 'nd_learning_meta_box_teacher', true );
    $nd_learning_meta_box_teachers = get_post_meta( get_the_ID(), 'nd_learning_meta_box_teachers', true );
    $nd_learning_meta_box_form = get_post_meta( get_the_ID(), 'nd_learning_meta_box_form', true );
    $nd_learning_meta_box_date = get_post_meta( get_the_ID(), 'nd_learning_meta_box_date', true );
    $nd_learning_meta_box_color = get_post_meta( get_the_ID(), 'nd_learning_meta_box_color', true ); 

    //layout
    $nd_learning_meta_box_course_page_layout = get_post_meta( get_the_ID(), 'nd_learning_meta_box_course_page_layout', true );
    if ( $nd_learning_meta_box_course_page_layout == '' ) { $nd_learning_meta_box_course_page_layout = 'layout-1'; }

    ?>


    <p><strong><?php _e('Price ( set 0 for free )','nd-learning'); ?></strong></p>
    <p><input type="text" name="nd_learning_meta_box_price" id="nd_learning_meta_box_price" value="<?php echo $nd_learning_meta_box_price; ?>" /></p>

    <p><strong><?php _e('Max Availability','nd-learning'); ?></strong></p>
    <p><input type="text" name="nd_learning_meta_box_max_availability" id="nd_learning_meta_box_max_availability" value="<?php echo $nd_learning_meta_box_max_availability; ?>" /></p>

    <p><strong><?php _e('Main Teacher','nd-learning'); ?></strong></p>
    <p>
      <select name="nd_learning_meta_box_teacher">
          <?php 

            $nd_learning_meta_box_teacher = get_post_meta( get_the_ID(), 'nd_learning_meta_box_teacher', true );
            $nd_learning_teachers_args = array( 'posts_per_page' => -1, 'post_type'=> 'teachers' );
            $nd_learning_teachers = get_posts($nd_learning_teachers_args); 

            ?>
          <?php foreach ($nd_learning_teachers as $nd_learning_teacher) : ?>
              <option 

              <?php 
                if( $nd_learning_meta_box_teacher == $nd_learning_teacher->ID ) { 
                  echo 'selected="selected"';
                } 
              ?>

              value="<?php echo $nd_learning_teacher->ID; ?>">
                  <?php echo $nd_learning_teacher->post_title; ?>
              </option>
          <?php endforeach; ?>
        </select>
    </p>


    <p><strong><?php _e('Other Teachers','nd-learning'); ?></strong></p>
    <p><input class="regular-text" type="text" name="nd_learning_meta_box_teachers" id="nd_learning_meta_box_teachers" value="<?php echo $nd_learning_meta_box_teachers; ?>" /></p>
    <p class="description"><?php _e('Start writing your teacher\'s name, this is an intuitive field','nd-learning'); ?></p>

    <script type="text/javascript">
      //<![CDATA[

      jQuery(document).ready(function($){
        var nd_learning_available_teachers = [ 

          //start all teachers list
          <?php 

            $nd_learning_teachers_args = array( 'posts_per_page' => -1, 'post_type'=> 'teachers' );
            $nd_learning_teachers = get_posts($nd_learning_teachers_args); 

            foreach ($nd_learning_teachers as $nd_learning_teacher) :
              echo '"'.$nd_learning_teacher->post_name.'",'; 
            endforeach;
            
          ?>
          //end all teachers list

        ];
        function split( val ) {
          return val.split( /,\s*/ );
        }
        function extractLast( term ) {
          return split( term ).pop();
        }
     
        $( "#nd_learning_meta_box_teachers" )
          // don't navigate away from the field on tab when selecting an item
          .on( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
              event.preventDefault();
            }
          })
          .autocomplete({
            minLength: 0,
            source: function( request, response ) {
              // delegate back to autocomplete, but extract the last term
              response( $.ui.autocomplete.filter(
                nd_learning_available_teachers, extractLast( request.term ) ) );
            },
            focus: function() {
              // prevent value inserted on focus
              return false;
            },
            select: function( event, ui ) {
              var terms = split( this.value );
              // remove the current input
              terms.pop();
              // add the selected item
              terms.push( ui.item.value );
              // add placeholder to get the comma-and-space at the end
              terms.push( "" );
              this.value = terms.join( "," );
              return false;
            }
          });
      } );

      //]]>
    </script>




    <p><strong><?php _e('Start Date','nd-learning'); ?></strong></p>
    <p><input id="nd_learning_datepicker" type="text" name="nd_learning_meta_box_date" id="nd_learning_meta_box_date" value="<?php echo $nd_learning_meta_box_date; ?>" /></p>
    
    <script type="text/javascript">
      //<![CDATA[
      
      jQuery(document).ready(function() {
          jQuery('#nd_learning_datepicker').datepicker({
              dateFormat : 'dd-mm-yy'
          });
      });

      //]]>
    </script>



    <p><strong><?php _e('Color','nd-learning'); ?></strong></p>
    <p><input id="nd_learning_colorpicker" type="text" name="nd_learning_meta_box_color" id="nd_learning_meta_box_color" value="<?php echo $nd_learning_meta_box_color; ?>" /></p>
    
    <script type="text/javascript">
      //<![CDATA[
      
      jQuery(document).ready(function($){
          $('#nd_learning_colorpicker').iris();
      });

      //]]>
    </script>





    <p><strong><?php _e('CF7 Form','nd-learning'); ?></strong></p>
    <p>
      <select name="nd_learning_meta_box_form">
          <?php 

            $nd_learning_meta_box_form = get_post_meta( get_the_ID(), 'nd_learning_meta_box_form', true );
            $nd_learning_forms_args = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
            $nd_learning_forms = get_posts($nd_learning_forms_args); 

            ?>
          <?php foreach ($nd_learning_forms as $nd_learning_form) : ?>
              <option 

              <?php 
                if( $nd_learning_meta_box_form == $nd_learning_form->ID ) { 
                  echo 'selected="selected"';
                } 
              ?>

              value="<?php echo $nd_learning_form->ID; ?>">
                  <?php echo $nd_learning_form->post_title; ?>
              </option>
          <?php endforeach; ?>
        </select>
    </p>



    <!--******************************POSITION******************************-->
    <p><strong><?php _e('Course Layout','nd-learning'); ?></strong></p>
    <p>
      <select name="nd_learning_meta_box_course_page_layout" id="nd_learning_meta_box_course_page_layout">
        
        <option <?php if( $nd_learning_meta_box_course_page_layout == 'layout-1' ) { echo 'selected="selected"'; } ?> value="layout-1"><?php _e('Layout 1','nd-learning'); ?></option>
        <option <?php if( $nd_learning_meta_box_course_page_layout == 'layout-2' ) { echo 'selected="selected"'; } ?> value="layout-2"><?php _e('Layout 2','nd-learning'); ?></option>
         
      </select>
    </p>




    <?php    
}

add_action( 'save_post', 'nd_learning_meta_box_save' );
function nd_learning_meta_box_save( $post_id )
{

    $nd_learning_meta_box_price = sanitize_meta('nd_learning_meta_box_price',$_POST['nd_learning_meta_box_price'],'post');
    if ( isset( $nd_learning_meta_box_price ) ) { 

      if ( $nd_learning_meta_box_price != '' ) {
        update_post_meta( $post_id, 'nd_learning_meta_box_price' , $nd_learning_meta_box_price ); 
      }else{
        delete_post_meta( $post_id,'nd_learning_meta_box_price');
      }

    }

    $nd_learning_meta_box_max_availability = sanitize_meta('nd_learning_meta_box_max_availability',$_POST['nd_learning_meta_box_max_availability'],'post');
    if ( isset( $nd_learning_meta_box_max_availability ) ) { 

      if ( $nd_learning_meta_box_max_availability != '' ) {
        update_post_meta( $post_id, 'nd_learning_meta_box_max_availability' , $nd_learning_meta_box_max_availability ); 
      }else{
        delete_post_meta( $post_id,'nd_learning_meta_box_max_availability');
      }
      
    }

    $nd_learning_meta_box_teacher = sanitize_meta('nd_learning_meta_box_teacher',$_POST['nd_learning_meta_box_teacher'],'post');
    if ( isset( $nd_learning_meta_box_teacher ) ) { 

      if ( $nd_learning_meta_box_teacher != '' ) {
        update_post_meta( $post_id, 'nd_learning_meta_box_teacher' , $nd_learning_meta_box_teacher ); 
      }else{
        delete_post_meta( $post_id,'nd_learning_meta_box_teacher');
      }
      
    }

    $nd_learning_meta_box_teachers = sanitize_meta('nd_learning_meta_box_teachers',$_POST['nd_learning_meta_box_teachers'],'post');
    if ( isset( $nd_learning_meta_box_teachers ) ) { 

      if ( $nd_learning_meta_box_teachers != '' ) {
        update_post_meta( $post_id, 'nd_learning_meta_box_teachers' , $nd_learning_meta_box_teachers );
      }else{
        delete_post_meta( $post_id,'nd_learning_meta_box_teachers');
      }
   
    }

    $nd_learning_meta_box_form = sanitize_meta('nd_learning_meta_box_form',$_POST['nd_learning_meta_box_form'],'post');
    if ( isset( $nd_learning_meta_box_form ) ) { 

      if ( $nd_learning_meta_box_form != '' ) {
        update_post_meta( $post_id, 'nd_learning_meta_box_form' , $nd_learning_meta_box_form ); 
      }else{
        delete_post_meta( $post_id,'nd_learning_meta_box_form');
      }

    }

    $nd_learning_meta_box_color = sanitize_hex_color( $_POST['nd_learning_meta_box_color'] );
    if ( isset( $nd_learning_meta_box_color ) ) { 

      if ( $nd_learning_meta_box_color != '' ) {
        update_post_meta( $post_id, 'nd_learning_meta_box_color' , $nd_learning_meta_box_color ); 
      }else{
        delete_post_meta( $post_id,'nd_learning_meta_box_color');
      }
      
    }

    $nd_learning_meta_box_date = sanitize_meta('nd_learning_meta_box_date',$_POST['nd_learning_meta_box_date'],'post');
    if ( isset( $nd_learning_meta_box_date ) ) { 

      if ( $nd_learning_meta_box_date != '' ) {
        update_post_meta( $post_id, 'nd_learning_meta_box_date' , $nd_learning_meta_box_date ); 
      }else{
        delete_post_meta( $post_id,'nd_learning_meta_box_date');
      }

    }

    $nd_learning_meta_box_course_page_layout = sanitize_option( 'nd_learning_meta_box_course_page_layout', $_POST['nd_learning_meta_box_course_page_layout'] );
    if ( isset( $nd_learning_meta_box_course_page_layout ) ) { 

      if ( $nd_learning_meta_box_course_page_layout != '' ) {
        update_post_meta( $post_id, 'nd_learning_meta_box_course_page_layout' , $nd_learning_meta_box_course_page_layout );
      }else{
        delete_post_meta( $post_id,'nd_learning_meta_box_course_page_layout');
      }
       
    }
         
}









/*******************************HEADER IMG******************************/

add_action( 'add_meta_boxes', 'nd_learning_metabox_courses_header_img' );
function nd_learning_metabox_courses_header_img() {
    add_meta_box( 'nd-learning-meta-box-course-header-img-id', __('Header Image','nd-learning'), 'nd_learning_metabox_course_header_img', 'courses', 'normal', 'high' );
}

function nd_learning_metabox_course_header_img()
{


    // $post is already set, and contains an object: the WordPress post
    global $post;
    $nd_learning_values = get_post_custom( $post->ID );
     
    $nd_learning_meta_box_course_header_img = get_post_meta( get_the_ID(), 'nd_learning_meta_box_course_header_img', true );
    $nd_learning_meta_box_course_header_img_title = get_post_meta( get_the_ID(), 'nd_learning_meta_box_course_header_img_title', true );
    $nd_learning_meta_box_course_header_img_position = get_post_meta( get_the_ID(), 'nd_learning_meta_box_course_header_img_position', true );


    ?>


    <!--******************************IMAGE******************************-->
    <p><strong><?php _e('Header Image','nd-learning'); ?></strong></p>
    <p><input class="regular-text" type="text" name="nd_learning_meta_box_course_header_img" id="nd_learning_meta_box_course_header_img" value="<?php echo $nd_learning_meta_box_course_header_img; ?>" /></p>
    <p>
      <input class="button nd_learning_meta_box_course_header_img_button" type="button" name="nd_learning_meta_box_course_header_img_button" id="nd_learning_meta_box_course_header_img_button" value="<?php _e('Upload','nd-learning'); ?>" />
    </p>


    <!--******************************POSITION******************************-->
    <p><strong><?php _e('Image Position','nd-learning'); ?></strong></p>
    <p>
      <select name="nd_learning_meta_box_course_header_img_position" id="nd_learning_meta_box_course_header_img_position">
        
        <option <?php if( $nd_learning_meta_box_course_header_img_position == 'nd_learning_background_position_center_top' ) { echo 'selected="selected"'; } ?> value="nd_learning_background_position_center_top">Position Top</option>
        <option <?php if( $nd_learning_meta_box_course_header_img_position == 'nd_learning_background_position_center_bottom' ) { echo 'selected="selected"'; } ?> value="nd_learning_background_position_center_bottom">Position Bottom</option>
        <option <?php if( $nd_learning_meta_box_course_header_img_position == 'nd_learning_background_position_center' ) { echo 'selected="selected"'; } ?> value="nd_learning_background_position_center">Position Center</option>
         
      </select>
    </p>


    <!--******************************TITLE******************************-->
    <p><strong><?php _e('Title','nd-learning'); ?></strong></p>
    <p><input id="nd_learning_meta_box_course_header_img_title" type="text" name="nd_learning_meta_box_course_header_img_title" id="nd_learning_meta_box_course_header_img_title" value="<?php echo $nd_learning_meta_box_course_header_img_title; ?>" /></p>
    <p class="description"><?php _e('Insert the title/slogan over the image','nd-learning'); ?></p>




    <script type="text/javascript">
      //<![CDATA[
      
    jQuery(document).ready(function() {

      jQuery( function ( $ ) {

        var file_frame = [],
        $button = $( '.nd_learning_meta_box_course_header_img_button' );


        $('#nd_learning_meta_box_course_header_img_button').click( function () {


          var $this = $( this ),
            id = $this.attr( 'id' );

          // If the media frame already exists, reopen it.
          if ( file_frame[ id ] ) {
            file_frame[ id ].open();

            return;
          }

          // Create the media frame.
          file_frame[ id ] = wp.media.frames.file_frame = wp.media( {
            title    : $this.data( 'uploader_title' ),
            button   : {
              text : $this.data( 'uploader_button_text' )
            },
            multiple : false  // Set to true to allow multiple files to be selected
          } );

          // When an image is selected, run a callback.
          file_frame[ id ].on( 'select', function() {

            // We set multiple to false so only get one image from the uploader
            var attachment = file_frame[ id ].state().get( 'selection' ).first().toJSON();

            $('#nd_learning_meta_box_course_header_img').val(attachment.url);

          } );

          // Finally, open the modal
          file_frame[ id ].open();


        } );

      });

    });

      //]]>
    </script>


    <?php    
}

add_action( 'save_post', 'nd_learning_meta_box_course_header_img_save' );
function nd_learning_meta_box_course_header_img_save( $post_id )
{

    $nd_learning_meta_box_course_header_img = esc_url_raw( $_POST['nd_learning_meta_box_course_header_img'] );
    if ( isset( $nd_learning_meta_box_course_header_img ) ) { 

      if ( $nd_learning_meta_box_course_header_img != '' ) {
        update_post_meta( $post_id, 'nd_learning_meta_box_course_header_img' , $nd_learning_meta_box_course_header_img ); 
      }else{
        delete_post_meta( $post_id,'nd_learning_meta_box_course_header_img');
      }
      
    }

    $nd_learning_meta_box_course_header_img_position = sanitize_option( 'nd_learning_meta_box_course_header_img_position', $_POST['nd_learning_meta_box_course_header_img_position'] );
    if ( isset( $nd_learning_meta_box_course_header_img_position ) ) { 

      if ( $nd_learning_meta_box_course_header_img_position != '' ) {
        update_post_meta( $post_id, 'nd_learning_meta_box_course_header_img_position' , $nd_learning_meta_box_course_header_img_position );
      }else{
        delete_post_meta( $post_id,'nd_learning_meta_box_course_header_img_position');
      }
       
    }

    $nd_learning_meta_box_course_header_img_title = sanitize_meta('nd_learning_meta_box_course_header_img_title',$_POST['nd_learning_meta_box_course_header_img_title'],'post');
    if ( isset( $nd_learning_meta_box_course_header_img_title ) ) { 

      if ( $nd_learning_meta_box_course_header_img_title != '' ) {
        update_post_meta( $post_id, 'nd_learning_meta_box_course_header_img_title' , $nd_learning_meta_box_course_header_img_title );
      }else{
        delete_post_meta( $post_id,'nd_learning_meta_box_course_header_img_title');
      }

    }

}



/*******************************ATTENDEES******************************/

add_action( 'add_meta_boxes', 'nd_learning_metabox_courses_attendees' );
function nd_learning_metabox_courses_attendees() {
    add_meta_box( 'nd-learning-meta-box-course-attendees', __('Course Attendees','nd-learning'), 'nd_learning_metabox_course_attendees', 'courses', 'normal', 'high' );
}

function nd_learning_metabox_course_attendees()
{ 


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


  if ( empty($nd_learning_attendees) ) { 

    $nd_learning_result .= '
    <div class="nd_learning_position_relative  nd_learning_width_100_percentage nd_learning_box_sizing_border_box nd_learning_display_inline_block">           
      <p class=" nd_learning_margin_0 nd_learning_padding_0">'.__('Still no participant','nd-learning').'</p>
    </div>';              


  }else{

    foreach ( $nd_learning_attendees as $nd_learning_attendee ) 
    {
      
      $nd_learning_attendees_avatar_url_args = array(
        'size'   => 300
      );
      
      $nd_learning_attendees_avatar_url = get_avatar_url($nd_learning_attendee->id_user, $nd_learning_attendees_avatar_url_args);
      $nd_learning_attendee_id = $nd_learning_attendee->id_user;

      $nd_learning_result .= '
                                 
          <!--START preview-->
          <div class="nd_learning_position_relative nd_learning_padding_10 nd_learning_width_100_percentage nd_learning_box_sizing_border_box nd_learning_display_inline_block nd_learning_border_bottom_1_solid_eee">           
            <img width="35" alt="" class="nd_learning_top_10 nd_learning_left_0 nd_learning_position_absolute" src="'.$nd_learning_attendees_avatar_url.'">
            <p class="nd_learning_margin_left_35 nd_learning_margin_0 nd_learning_padding_0"><strong>'.get_userdata($nd_learning_attendee_id)->user_login.'</strong> '.get_userdata($nd_learning_attendee_id)->first_name.' '.get_userdata($nd_learning_attendee_id)->last_name.'</p>
            <p class="nd_learning_margin_left_35 nd_learning_margin_0 nd_learning_padding_0"><a class="nd_learning_text_decoration_initial" href="mailto:'.get_userdata($nd_learning_attendee_id)->user_email.'">'.get_userdata($nd_learning_attendee_id)->user_email.'</a> -> <a href="user-edit.php?user_id='.$nd_learning_attendee_id.'" target="_blank" class="nd_learning_text_decoration_initial">'.__('View Profile','nd-learning').'</a></p>
          </div>               
          <!--END preview-->

      ';


    }

  }

  echo $nd_learning_result;

}