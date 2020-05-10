//START function
function nd_learning_add_follower(teacher_id,user_id,action_type){

  //variables
  var nd_learning_teacher_id = teacher_id;
  var nd_learning_user_id = user_id;
  var nd_learning_action_type = action_type;


  jQuery( '#nd_learning_follow_me_btn' ).prepend('<div id="nd_learning_follow_me_btn_loader" class="nd_learning_bg_white_alpha nd_learning_position_absolute nd_learning_width_100_percentage nd_learning_height_100_percentage nd_learning_cursor_progress"></div>');


  //START post method
  jQuery.get(
    
  
    //ajax
    nd_learning_my_vars_add_follower.nd_learning_ajaxurl_add_follower,
    {
      action : 'nd_learning_followers_php_function',         
      nd_learning_teacher_id: nd_learning_teacher_id,
      nd_learning_user_id: nd_learning_user_id,
      nd_learning_action_type: nd_learning_action_type,
      nd_learning_add_follower_security : nd_learning_my_vars_add_follower.nd_learning_ajaxnonce_add_follower,
    },
    //end ajax


    //START success
    function() {
    
      jQuery('#nd_learning_follow_me_btn_loader').remove(); //remove the loader

      location.reload(); 

    }
    //END

    

  );
  //END

  
}
//END function
