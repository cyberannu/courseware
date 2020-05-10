//START function
function nd_learning_remove_to_bookmark(course_id,user_id,action_type){

  //variables
  var nd_learning_course_id = course_id;
  var nd_learning_user_id = user_id;
  var nd_learning_action_type = action_type;


  //START post method
  jQuery.get(
    
  
    //ajax
    nd_learning_my_vars_remove_to_bookmark.nd_learning_ajaxurl_remove_to_bookmark,
    {
      action : 'nd_learning_remove_bookmark_php_function',         
      nd_learning_course_id: nd_learning_course_id,
      nd_learning_user_id: nd_learning_user_id,
      nd_learning_action_type: nd_learning_action_type,
      nd_learning_remove_to_bookmark_security : nd_learning_my_vars_remove_to_bookmark.nd_learning_ajaxnonce_remove_to_bookmark,
    },
    //end ajax


    //START success
    function( nd_learning_bookmark_result ) {
    
      //alert( nd_learning_bookmark_result );
      location.reload(); 

    }
    //END

    

  );
  //END

  
}
//END function
