//START function
function nd_learning_add_to_compare(course_id,user_id,action_type,text,link,img_none,img_full){

  //variables
  var nd_learning_course_id = course_id;
  var nd_learning_user_id = user_id;
  var nd_learning_action_type = action_type;
  var nd_learning_text_to_return = text;
  var nd_learning_link_to_return = link;
  var nd_learning_img_to_return_none = img_none;
  var nd_learning_img_to_return_full = img_full;


  jQuery( '.nd_learning_add_to_compare_btn_'+nd_learning_course_id ).prepend('<div class="nd_learning_add_to_compare_ajax_loader_'+nd_learning_course_id+' nd_learning_bg_white_alpha nd_learning_position_absolute nd_learning_width_100_percentage nd_learning_height_100_percentage nd_learning_cursor_progress"></div>');


  //START post method
  jQuery.get(
    
  
    //ajax
    nd_learning_my_vars_add_to_compare.nd_learning_ajaxurl_add_to_compare,
    {
      action : 'nd_learning_compare_php_function',         
      nd_learning_course_id: nd_learning_course_id,
      nd_learning_user_id: nd_learning_user_id,
      nd_learning_action_type: nd_learning_action_type,
      nd_learning_text_to_return: nd_learning_text_to_return,
      nd_learning_link_to_return: nd_learning_link_to_return,
      nd_learning_img_to_return_none: nd_learning_img_to_return_none,
      nd_learning_img_to_return_full: nd_learning_img_to_return_full,
      nd_learning_add_to_compare_security : nd_learning_my_vars_add_to_compare.nd_learning_ajaxnonce_add_to_compare,
    },
    //end ajax


    //START success
    function( nd_learning_compare_result ) {
    
      var nd_learning_array_result = nd_learning_compare_result.split(",");

      jQuery( ".nd_learning_add_to_compare_link_"+nd_learning_array_result[0] ).remove();

      if( typeof nd_learning_array_result[1] != 'undefined' ){

        jQuery( ".nd_learning_add_to_compare_btn_"+nd_learning_array_result[0] ).append( jQuery( "<div class='nd_learning_display_inline_block'><a title='"+nd_learning_array_result[1]+"' href="+nd_learning_link_to_return+" class='nd_learning_cursor_pointer nd_learning_display_inline_block nd_learning_text_decoration_none'><img width='20' height='20' src='"+nd_learning_img_to_return_none+"'></a></div>" ) );  

      }else{

        jQuery( ".nd_learning_add_to_compare_btn_"+nd_learning_array_result[0] ).append( jQuery( "<div class='nd_learning_display_inline_block'><a title='"+nd_learning_text_to_return+"' href="+nd_learning_link_to_return+" class='nd_learning_cursor_pointer nd_learning_display_inline_block nd_learning_text_decoration_none'><img width='20' height='20' src='"+nd_learning_img_to_return_full+"'></a></div>" ) ); 

      }
      
      jQuery( '.nd_learning_add_to_compare_ajax_loader_'+nd_learning_course_id ).remove(); //remove the loader

    }
    //END

    

  );
  //END

  
}
//END function
