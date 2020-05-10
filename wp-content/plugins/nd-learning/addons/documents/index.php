<?php


$nd_learning_documents_enable = get_option('nd_learning_documents_enable');
if ( $nd_learning_documents_enable == 1 and get_option('nicdark_theme_author') == 1 ) {


///////////////////////////////////////////////////DOCUMENTS CPT///////////////////////////////////////////////////////////////
function nd_learning_create_post_type_documents() {
    register_post_type('nd_learning_docs',
        array(
            'labels' => array(
                'name' => __('Documents', 'nd-learning'),
                'singular_name' => __('Documents', 'nd-learning')
            ),
            'public' => true,
            'has_archive' => false,
            'exclude_from_search' => true,
            'rewrite' => array('slug' => 'documents'),
            'menu_icon'   => 'dashicons-paperclip',
            'supports' => array('title', 'editor', 'thumbnail')
        )
    );
}
add_action('init', 'nd_learning_create_post_type_documents');







///////////////////////////////////////////////////METABOX ON CPT///////////////////////////////////////////////////////////////


add_action( 'add_meta_boxes', 'nd_learning_meta_box_document' );
function nd_learning_meta_box_document() {
    add_meta_box( 'nd-learning-meta-box-documents', __('Document Options','nd-learning'), 'nd_learning_meta_box_documents', 'nd_learning_docs', 'normal', 'high' );
}

function nd_learning_meta_box_documents()
{


    //iris color picker
    wp_enqueue_script('iris');

    // $post is already set, and contains an object: the WordPress post
    global $post;
    $nd_learning_values = get_post_custom( $post->ID );
     
    $nd_learning_meta_box_document_subtitle = get_post_meta( get_the_ID(), 'nd_learning_meta_box_document_subtitle', true ); 
    $nd_learning_meta_box_document_color = get_post_meta( get_the_ID(), 'nd_learning_meta_box_document_color', true );
    $nd_learning_meta_box_document_icon = get_post_meta( get_the_ID(), 'nd_learning_meta_box_document_icon', true );
    $nd_learning_meta_box_document_visibility = get_post_meta( get_the_ID(), 'nd_learning_meta_box_document_visibility', true );
    
    ?>

    <p><strong><?php _e('Sub Title','nd-learning'); ?></strong></p>
    <p><input type="text" name="nd_learning_meta_box_document_subtitle" id="nd_learning_meta_box_document_subtitle" value="<?php echo $nd_learning_meta_box_document_subtitle; ?>" /></p>

    <p><strong><?php _e('Button Color Preview','nd-learning'); ?></strong></p>
    <p><input id="nd_learning_colorpicker" type="text" name="nd_learning_meta_box_document_color" value="<?php echo $nd_learning_meta_box_document_color; ?>" /></p>
    
    <script type="text/javascript">
      //<![CDATA[
      
      jQuery(document).ready(function($){
          $('#nd_learning_colorpicker').iris();
      });

      //]]>
    </script>


    <p><strong><?php _e('Icon Document','nd-learning'); ?></strong></p>
    <p><input class="regular-text" type="text" name="nd_learning_meta_box_document_icon" id="nd_learning_meta_box_document_icon" value="<?php echo $nd_learning_meta_box_document_icon; ?>" /></p>
    <p>
      <input class="button nd_learning_meta_box_document_icon_button" type="button" name="nd_learning_meta_box_document_icon_button" id="nd_learning_meta_box_document_icon_button" value="<?php _e('Upload','nd-learning'); ?>" />
    </p>


    <script type="text/javascript">
      //<![CDATA[
      
    jQuery(document).ready(function() {

      jQuery( function ( $ ) {

        var file_frame = [],
        $button = $( '.nd_learning_meta_box_document_icon_button' );


        $('#nd_learning_meta_box_document_icon_button').click( function () {


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

            $('#nd_learning_meta_box_document_icon').val(attachment.url);

          } );

          // Finally, open the modal
          file_frame[ id ].open();


        } );

      });

    });

      //]]>
    </script>




    <p><strong><?php _e('Visibility','nd-learning'); ?></strong></p>
    <p>
      <select name="nd_learning_meta_box_document_visibility" id="nd_learning_meta_box_document_visibility">
        
        <option <?php if( $nd_learning_meta_box_document_visibility == 'nd_learning_meta_box_document_visibility_public' ) { echo 'selected="selected"'; } ?> value="nd_learning_meta_box_document_visibility_public"><?php _e('Public Document','nd-learning'); ?></option>
        <option <?php if( $nd_learning_meta_box_document_visibility == 'nd_learning_meta_box_document_visibility_private' ) { echo 'selected="selected"'; } ?> value="nd_learning_meta_box_document_visibility_private"><?php _e('Private Document','nd-learning'); ?></option>
         
      </select>
    </p>


    <?php    
}



add_action( 'save_post', 'nd_learning_meta_box_documents_save' );
function nd_learning_meta_box_documents_save( $post_id )
{

    $nd_learning_meta_box_document_subtitle = sanitize_meta('nd_learning_meta_box_document_subtitle',$_POST['nd_learning_meta_box_document_subtitle'],'post');
    if ( isset( $nd_learning_meta_box_document_subtitle ) ) { 

      if ( $nd_learning_meta_box_document_subtitle != '' ) {
        update_post_meta( $post_id, 'nd_learning_meta_box_document_subtitle' , $nd_learning_meta_box_document_subtitle ); 
      }else{
        delete_post_meta( $post_id,'nd_learning_meta_box_document_subtitle');
      }

    }

    $nd_learning_meta_box_document_color = sanitize_hex_color( $_POST['nd_learning_meta_box_document_color'] );
    if ( isset( $nd_learning_meta_box_document_color ) ) { 

      if ( $nd_learning_meta_box_document_color != '' ) {
        update_post_meta( $post_id, 'nd_learning_meta_box_document_color' , $nd_learning_meta_box_document_color ); 
      }else{
        delete_post_meta( $post_id,'nd_learning_meta_box_document_color');
      }
      
    }

    $nd_learning_meta_box_document_icon = esc_url_raw( $_POST['nd_learning_meta_box_document_icon'] );
    if ( isset( $nd_learning_meta_box_document_icon ) ) { 

      if ( $nd_learning_meta_box_document_icon != '' ) {
        update_post_meta( $post_id, 'nd_learning_meta_box_document_icon' , $nd_learning_meta_box_document_icon ); 
      }else{
        delete_post_meta( $post_id,'nd_learning_meta_box_document_icon');
      }
      
    }

    $nd_learning_meta_box_document_visibility = sanitize_option( 'nd_learning_meta_box_document_visibility', $_POST['nd_learning_meta_box_document_visibility'] );
    if ( isset( $nd_learning_meta_box_document_visibility ) ) { 

      if ( $nd_learning_meta_box_document_visibility != '' ) {
        update_post_meta( $post_id, 'nd_learning_meta_box_document_visibility' , $nd_learning_meta_box_document_visibility ); 
      }else{
        delete_post_meta( $post_id,'nd_learning_meta_box_document_visibility');
      }
      
    }
         
}



///////////////////////////////////////////////////METABOX ON COURSES///////////////////////////////////////////////////////////////
add_action( 'add_meta_boxes', 'nd_learning_add_meta_box_documents_courses' );
function nd_learning_add_meta_box_documents_courses() {
    add_meta_box( 'nd-learning-meta-box-documents-courses', __('Document Options','nd-learning'), 'nd_learning_meta_box_documents_courses', 'courses', 'normal', 'default' );
}

function nd_learning_meta_box_documents_courses()
{


    //jquery-ui-autocomplete
    wp_enqueue_script('jquery-ui-autocomplete'); 


    // $post is already set, and contains an object: the WordPress post
    global $post;
    $nd_learning_values = get_post_custom( $post->ID );
     
    $nd_learning_meta_box_title_tab = get_post_meta( get_the_ID(), 'nd_learning_meta_box_title_tab', true );
    $nd_learning_meta_box_title_tab_content = get_post_meta( get_the_ID(), 'nd_learning_meta_box_title_tab_content', true );
    $nd_learning_meta_box_docs_courses = get_post_meta( get_the_ID(), 'nd_learning_meta_box_docs_courses', true );

    ?>


    <p><strong><?php _e('Title Tab','nd-learning'); ?></strong></p>
    <p><input type="text" name="nd_learning_meta_box_title_tab" id="nd_learning_meta_box_title_tab" value="<?php echo $nd_learning_meta_box_title_tab; ?>" /></p>

    <p><strong><?php _e('Title Tab Content','nd-learning'); ?></strong></p>
    <p><input type="text" name="nd_learning_meta_box_title_tab_content" id="nd_learning_meta_box_title_tab_content" value="<?php echo $nd_learning_meta_box_title_tab_content; ?>" /></p>

    <p><strong><?php _e('Documents','nd-learning'); ?></strong></p>
    <p><input class="regular-text" type="text" name="nd_learning_meta_box_docs_courses" id="nd_learning_meta_box_docs_courses" value="<?php echo $nd_learning_meta_box_docs_courses; ?>" /></p>
    <p class="description"><?php _e('Start writing your document\'s name, this is an intuitive field','nd-learning'); ?></p>

    <script type="text/javascript">
      //<![CDATA[

      jQuery(document).ready(function($){
        var nd_learning_available_documents = [ 

          //start all documents list
          <?php 

            $nd_learning_documents_args = array( 'posts_per_page' => -1, 'post_type'=> 'nd_learning_docs' );
            $nd_learning_documents = get_posts($nd_learning_documents_args); 

            foreach ($nd_learning_documents as $nd_learning_teacher) :
              echo '"'.$nd_learning_teacher->post_name.'",'; 
            endforeach;
            
          ?>
          //end all documents list

        ];
        function split( val ) {
          return val.split( /,\s*/ );
        }
        function extractLast( term ) {
          return split( term ).pop();
        }
     
        $( "#nd_learning_meta_box_docs_courses" )
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
                nd_learning_available_documents, extractLast( request.term ) ) );
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


    <?php    
}

add_action( 'save_post', 'nd_learning_meta_box_docs_courses_save' );
function nd_learning_meta_box_docs_courses_save( $post_id )
{

    $nd_learning_meta_box_title_tab = sanitize_meta('nd_learning_meta_box_title_tab',$_POST['nd_learning_meta_box_title_tab'],'post');
    if ( isset( $nd_learning_meta_box_title_tab ) ) { 

      if ( $nd_learning_meta_box_title_tab != '' ) {
        update_post_meta( $post_id, 'nd_learning_meta_box_title_tab' , $nd_learning_meta_box_title_tab );
      }else{
        delete_post_meta( $post_id,'nd_learning_meta_box_title_tab');
      }

    }

    $nd_learning_meta_box_title_tab_content = sanitize_meta('nd_learning_meta_box_title_tab_content',$_POST['nd_learning_meta_box_title_tab_content'],'post');
    if ( isset( $nd_learning_meta_box_title_tab_content ) ) { 

      if ( $nd_learning_meta_box_title_tab_content != '' ) {
        update_post_meta( $post_id, 'nd_learning_meta_box_title_tab_content' , $nd_learning_meta_box_title_tab_content ); 
      }else{
        delete_post_meta( $post_id,'nd_learning_meta_box_title_tab_content');
      }

    }

    $nd_learning_meta_box_docs_courses = sanitize_meta('nd_learning_meta_box_docs_courses',$_POST['nd_learning_meta_box_docs_courses'],'post');
    if ( isset( $nd_learning_meta_box_docs_courses ) ) { 

      if ( $nd_learning_meta_box_docs_courses != '' ) {
        update_post_meta( $post_id, 'nd_learning_meta_box_docs_courses' , $nd_learning_meta_box_docs_courses ); 
      }else{
        delete_post_meta( $post_id,'nd_learning_meta_box_docs_courses');
      }
      
    }
         
}





///////////////////////////////////////////////////ADD CONTENT IN SINGLE COURSE PAGE///////////////////////////////////////////////////////////////

add_action('nd_learning_single_course_tab_list_2','nd_learning_single_course_add_documents_list');
function nd_learning_single_course_add_documents_list(){

	$nd_learning_course_id = get_the_ID();

	//metabox
	$nd_learning_meta_box_docs_courses = get_post_meta( $nd_learning_course_id, 'nd_learning_meta_box_docs_courses', true );
	$nd_learning_meta_box_title_tab = get_post_meta( $nd_learning_course_id, 'nd_learning_meta_box_title_tab', true );


	if ( $nd_learning_meta_box_docs_courses == '' ) {

		$nd_learning_docs_tab = '';

	}else{

		$nd_learning_docs_tab = '';


		$nd_learning_docs_tab .= '
		<li class="nd_learning_display_inline_block">
		<h4>
		  <a class="nd_learning_outline_0 nd_learning_padding_20_15 nd_learning_display_inline_block nd_options_first_font nd_options_color_greydark" href="#nd_learning_single_course_documents">
		    '.$nd_learning_meta_box_title_tab.'
		  </a>
		</h4>
		</li>
		';

	}

  
    echo $nd_learning_docs_tab;

}



add_action('nd_learning_single_course_tab_list_content','nd_learning_single_course_add_documents_list_content');
function nd_learning_single_course_add_documents_list_content() {

	//script
	wp_enqueue_script('jquery-ui-dialog');
	wp_enqueue_script('jquery-effects-fade');
	wp_enqueue_style( 'jquery-ui-dialog-css', esc_url(plugins_url('jquery-ui-dialog.css', __FILE__ )) );

	$nd_learning_course_id = get_the_ID();

	//metabox
	$nd_learning_meta_box_docs_courses = get_post_meta( $nd_learning_course_id, 'nd_learning_meta_box_docs_courses', true );
	$nd_learning_meta_box_title_tab_content = get_post_meta( $nd_learning_course_id, 'nd_learning_meta_box_title_tab_content', true );


	if ( $nd_learning_meta_box_docs_courses == '' ) {

		$nd_learning_docs_tab_content = '';

	}else{

		$nd_learning_docs_tab_content = '';


		$nd_learning_docs_tab_content .= '


			<style>
		    	.nd_learning_dialog_filter_bg:after{
		    		width: 100% !important;
				    height: 100% !important;
				    background-color: rgba(101, 100, 96, 0.9);
				    content: "";
				    position: fixed;
				    top: 0;
				    left: 0;
		    	}
		    </style>


			<div class="nd_learning_section" id="nd_learning_single_course_documents">
		    	

				<div class="nd_learning_section nd_learning_height_40"></div>
				<h3><strong>'.$nd_learning_meta_box_title_tab_content.'</strong></h3>
				<div class="nd_learning_section nd_learning_height_30"></div>';


				//explode the string
        		$nd_learning_meta_box_docs_courses_array = explode(',', $nd_learning_meta_box_docs_courses);

        		//START CICLE
        		for ($nd_learning_meta_box_docs_courses_array_i = 0; $nd_learning_meta_box_docs_courses_array_i < count($nd_learning_meta_box_docs_courses_array)-1; $nd_learning_meta_box_docs_courses_array_i++) {
				    
				    $nd_learning_page_by_path = get_page_by_path($nd_learning_meta_box_docs_courses_array[$nd_learning_meta_box_docs_courses_array_i],OBJECT,'nd_learning_docs');
				    
				    //info document
				    $nd_learning_document_id = $nd_learning_page_by_path->ID;
				    $nd_learning_document_name = get_the_title($nd_learning_document_id);
				    $nd_learning_document_content = get_post_field('post_content', $nd_learning_document_id);;
				    $nd_learning_document_permalink = get_permalink($nd_learning_document_id);


				    //metabox doc
				    $nd_learning_meta_box_document_subtitle = get_post_meta( $nd_learning_document_id, 'nd_learning_meta_box_document_subtitle', true );
					if ( $nd_learning_meta_box_document_subtitle == '' ) { $nd_learning_meta_box_document_subtitle = ''; }
					$nd_learning_meta_box_document_color = get_post_meta( $nd_learning_document_id, 'nd_learning_meta_box_document_color', true );
					if ( $nd_learning_meta_box_document_color == '' ) { $nd_learning_meta_box_document_color = '#000'; }
					$nd_learning_meta_box_document_icon = get_post_meta( $nd_learning_document_id, 'nd_learning_meta_box_document_icon', true );
					if ( $nd_learning_meta_box_document_icon == '' ) { $nd_learning_meta_box_document_icon = ''; }
					$nd_learning_meta_box_document_visibility = get_post_meta( $nd_learning_document_id, 'nd_learning_meta_box_document_visibility', true );

					//image
					$nd_learning_document_image = '';
				    if ( has_post_thumbnail() ) {

					  $nd_learning_image_id = get_post_thumbnail_id($nd_learning_document_id);
					  $nd_learning_image_attributes = wp_get_attachment_image_src( $nd_learning_image_id, 'large' );
					  $nd_learning_image_src = $nd_learning_image_attributes[0];

				      $nd_learning_document_image .= '

				      	<div class="nd_learning_section nd_learning_position_relative">
                    
						    <img class="nd_learning_section" alt="" src="'.$nd_learning_image_src.'">

						    <div class="nd_learning_bg_greydark_alpha_gradient_3 nd_learning_position_absolute nd_learning_left_0 nd_learning_height_100_percentage nd_learning_width_100_percentage nd_learning_box_sizing_border_box">
						        
						        <div class="nd_learning_position_absolute nd_learning_bottom_30 nd_learning_width_100_percentage nd_learning_box_sizing_border_box nd_learning_text_align_center">
						            
						        	<h3 class="nd_learning_color_white_important"><strong>'.$nd_learning_meta_box_document_subtitle.'</strong></h3>

						        </div>

						    </div>

						</div>

				      ';

				    }else{
				    	$nd_learning_document_image .= '';	
				    }
				    //end image



				    //start visibility
				    $nd_learning_document_visibility = '';
				    if ( $nd_learning_meta_box_document_visibility == 'nd_learning_meta_box_document_visibility_private' AND !is_user_logged_in() ) {

				    	$nd_learning_document_visibility .= '<a style="background-color:'.$nd_learning_meta_box_document_color.';" class="nd_learning_display_inline_block nd_learning_color_white_important nd_options_first_font nd_learning_padding_8 nd_learning_cursor_no_drop nd_learning_border_radius_3 nd_learning_font_size_13">'.__('PRIVATE','nd-learning').'</a>';

				    }else{

				    	$nd_learning_document_visibility .= '<a id="nd_learning_dialog_open_'.$nd_learning_document_id.'" style="background-color:'.$nd_learning_meta_box_document_color.';" class="nd_learning_display_inline_block nd_learning_color_white_important nd_options_first_font nd_learning_padding_8 nd_learning_cursor_pointer nd_learning_border_radius_3 nd_learning_font_size_13">'.__('PREVIEW','nd-learning').'</a>';
	
				    }
				    //end visibility


				    

				    $nd_learning_docs_tab_content .= '

	            	<!--START-->
	                <div class="nd_learning_section nd_learning_border_top_1_solid_grey nd_learning_padding_15 nd_learning_box_sizing_border_box">
					    <div class="nd_learning_width_20_percentage nd_learning_width_100_percentage_responsive nd_learning_float_left">
					        <table>
					            <tbody><tr>
					                <td><img class="nd_learning_float_left" alt="" width="30" src="'.$nd_learning_meta_box_document_icon.'"></td>
					                <td><span class="nd_options_color_grey nd_learning_float_left nd_options_first_font nd_learning_font_size_14 nd_learning_margin_left_10">'.$nd_learning_meta_box_document_subtitle.'</span></td>
					            </tr>
					        </tbody></table>
					    </div>
					    <div class="nd_learning_width_70_percentage nd_learning_width_100_percentage_responsive nd_learning_float_left">
					        <h4 class="nd_learning_padding_7 nd_options_second_font">'.$nd_learning_document_name.'</h4>
					    </div>
					    <div class="nd_learning_width_10_percentage nd_learning_width_100_percentage_responsive nd_learning_float_left nd_learning_text_align_right nd_learning_text_align_left_responsive nd_learning_margin_top_5_responsive">
					        '.$nd_learning_document_visibility.'
					    </div>
					</div>
	                <!--END-->';



	                //START popup
				    if ( $nd_learning_meta_box_document_visibility == 'nd_learning_meta_box_document_visibility_private' AND !is_user_logged_in() ) {

				    	$nd_learning_docs_tab_content .= '';

				    }else{



				    	$nd_learning_docs_tab_content .= '

						<div id="nd_learning_dialog_'.$nd_learning_document_id.'">

					      <div class="nd_learning_bg_white nd_learning_border_radius_3 nd_learning_position_relative nd_learning_section nd_learning_box_sizing_border_box">

					      	<div style="background-color:'.$nd_learning_meta_box_document_color.';" class="nd_learning_position_relative nd_learning_section nd_learning_box_sizing_border_box nd_learning_padding_20 nd_learning_border_radius_top_3">
					      		<h3 class="nd_learning_color_white_important"><strong>'.$nd_learning_document_name.'</strong></h3>
					      		<a style="background-image:url('.esc_url(plugins_url('icon-close-white.svg', __FILE__ )).'" id="nd_learning_dialog_btn_close_'.$nd_learning_document_id.'" class="nd_learning_width_60 nd_learning_height_100_percentage nd_learning_right_0 nd_learning_top_0 nd_learning_position_absolute nd_learning_background_position_center nd_learning_background_size_25 nd_learning_background_repeat_no_repeat nd_learning_cursor_pointer nd_learning_display_inline_block nd_learning_border_radius_3"></a>
					      	</div>

					      	'.$nd_learning_document_image.'

					      	<div class="nd_learning_section nd_learning_box_sizing_border_box nd_learning_padding_30">
					      		'.do_shortcode($nd_learning_document_content).'	
					      	</div>

					 
					      </div>

					    </div>


						<script type="text/javascript">
					    //<![CDATA[
					    
					    jQuery(document).ready(function() {

					      jQuery( "#nd_learning_dialog_'.$nd_learning_document_id.'" ).dialog({
					        autoOpen: false,
					        draggable: false,
					        width: 800,
					        modal: false,
					        resizable: false,
					        dialogClass: "nd_learning_dialog",
					        show: {
					          effect: "fade",
					          duration: 800
					        },
					        hide: {
					          effect: "fade",
					          duration: 800
					        }
					      });
					   
					      jQuery( "#nd_learning_dialog_open_'.$nd_learning_document_id.'" ).click(function() {
					        jQuery( "#nd_learning_dialog_'.$nd_learning_document_id.'" ).dialog( "open" );
					        jQuery( ".nd_learning_dialog" ).addClass( "nd_learning_dialog_filter_bg" );
					      });

					      jQuery( "#nd_learning_dialog_btn_close_'.$nd_learning_document_id.'" ).click(function() {
					        jQuery( "#nd_learning_dialog_'.$nd_learning_document_id.'" ).dialog( "close" );
					      });

					    });

					    //]]>
					  </script>




            <style>
              @media only screen and (min-width: 768px) and (max-width: 959px) {
                .nd_learning_dialog_filter_bg { width: 100% !important; }
                #nd_learning_dialog_'.$nd_learning_document_id.' { width:758px !important; margin-left: -379px; left: 50%; }  
              }

              @media only screen and (min-width: 480px) and (max-width: 767px) {
                .nd_learning_dialog_filter_bg { width: 100% !important; }
                #nd_learning_dialog_'.$nd_learning_document_id.' { width:470px !important; margin-left: -235px; left: 50%; }    
              }

              @media only screen and (min-width: 320px) and (max-width: 479px){
                .nd_learning_dialog_filter_bg { width: 100% !important; }
                #nd_learning_dialog_'.$nd_learning_document_id.' { width:310px !important; margin-left: -155px; left: 50%; }   
              }
            </style>


            ';

	
				    }
				    //END popup



				}
				//END CICLE



		   $nd_learning_docs_tab_content .= '</div>';

	}


    echo $nd_learning_docs_tab_content;


}


}
