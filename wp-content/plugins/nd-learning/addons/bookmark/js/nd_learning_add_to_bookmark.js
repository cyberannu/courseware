//START function
function nd_learning_add_to_bookmark(course_id,user_id,action_type,text,link,img){

  //variables
  var nd_learning_course_id = course_id;
  var nd_learning_user_id = user_id;
  var nd_learning_action_type = action_type;
  var nd_learning_text_to_return = text;
  var nd_learning_link_to_return = link;
  var nd_learning_img_to_return = img;


  jQuery( '.nd_learning_add_to_bookmark_btn_'+nd_learning_course_id ).prepend('<div class="nd_learning_add_to_bookmark_ajax_loader_'+nd_learning_course_id+' nd_learning_bg_white_alpha nd_learning_position_absolute nd_learning_width_100_percentage nd_learning_height_100_percentage nd_learning_cursor_progress"></div>');


  //START post method
  jQuery.get(
    
  
    //ajax
    nd_learning_my_vars_add_to_bookmark.nd_learning_ajaxurl_add_to_bookmark,
    {
      action : 'nd_learning_bookmark_php_function',         
      nd_learning_course_id: nd_learning_course_id,
      nd_learning_user_id: nd_learning_user_id,
      nd_learning_action_type: nd_learning_action_type,
      nd_learning_text_to_return: nd_learning_text_to_return,
      nd_learning_link_to_return: nd_learning_link_to_return,
      nd_learning_img_to_return: nd_learning_img_to_return,
      nd_learning_add_to_bookmark_security : nd_learning_my_vars_add_to_bookmark.nd_learning_ajaxnonce_add_to_bookmark,
    },
    //end ajax


    //START success
    function( nd_learning_bookmark_result ) {
    
      jQuery( ".nd_learning_add_to_bookmark_link_"+nd_learning_bookmark_result ).remove();
      
      jQuery( ".nd_learning_add_to_bookmark_btn_"+nd_learning_bookmark_result ).append( jQuery( "<div class='nd_learning_display_inline_block'><a title='"+nd_learning_text_to_return+"' href="+nd_learning_link_to_return+" class='nd_learning_margin_right_20 nd_learning_cursor_pointer  nd_learning_display_inline_block  nd_learning_text_decoration_none '><img width='20' height='20' src='"+nd_learning_img_to_return+"'></a></div>" ) );

      jQuery( '.nd_learning_add_to_bookmark_ajax_loader_'+nd_learning_course_id ).remove(); //remove the loader

    }
    //END

    

  );
  //END

  
}
//END function
