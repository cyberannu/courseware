//START function
function nd_learning_import_settings(){

  //variables
  var nd_learning_value_import_settings = jQuery( "#nd_learning_import_settings").val();

  //empty result div
  jQuery( "#nd_learning_import_settings_result_container").empty();

  //START post method
  jQuery.get(
    
  
    //ajax
    nd_learning_my_vars_import_settings.nd_learning_ajaxurl_import_settings,
    {
      action : 'nd_learning_import_settings_php_function',         
      nd_learning_value_import_settings: nd_learning_value_import_settings,
      nd_learning_import_settings_security : nd_learning_my_vars_import_settings.nd_learning_ajaxnonce_import_settings
    },
    //end ajax


    //START success
    function( nd_learning_import_settings_result ) {
    
      jQuery( "#nd_learning_import_settings").val('');
      jQuery( "#nd_learning_import_settings_result_container").append(nd_learning_import_settings_result);

    }
    //END
  

  );
  //END

  
}
//END function
