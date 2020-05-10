//START function
function nd_learning_remove_follower(teacher_id,user_id,action_type){

  //variables
  var nd_learning_teacher_id = teacher_id;
  var nd_learning_user_id = user_id;
  var nd_learning_action_type = action_type;


  //START post method
  jQuery.get(
    
  
    //ajax
    nd_learning_my_vars_remove_follower.nd_learning_ajaxurl_remove_follower,
    {
      action : 'nd_learning_remove_follower_php_function',         
      nd_learning_teacher_id: nd_learning_teacher_id,
      nd_learning_user_id: nd_learning_user_id,
      nd_learning_action_type: nd_learning_action_type,
      nd_learning_remove_follower_security : nd_learning_my_vars_remove_follower.nd_learning_ajaxnonce_remove_follower,
    },
    //end ajax


    //START success
    function() {
    
      location.reload(); 

    }
    //END

    

  );
  //END

  
}
//END function
