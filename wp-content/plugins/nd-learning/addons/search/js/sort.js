//START function
function nd_learning_courses_sorting(paged){

  //variables passed on function
  var nd_learning_paged = paged;
  if(typeof nd_learning_paged === 'undefined'){
    nd_learning_paged = jQuery( ".nd_learning_btn_sorting_pagination_active" ).text();
  }
  var nd_learning_layout = jQuery( "#nd_learning_btn_sorting_layout .nd_learning_btn_sorting_layout_active").attr('title');


  //variables on page
  var nd_learning_term_taxonomy_1 = jQuery( "#nd_learning_term_taxonomy_hidden_1").val();
  var nd_learning_term_taxonomy_2 = jQuery( "#nd_learning_term_taxonomy_hidden_2").val();
  var nd_learning_term_taxonomy_3 = jQuery( "#nd_learning_term_taxonomy_hidden_3").val();
  var nd_learning_term_taxonomy_4 = jQuery( "#nd_learning_term_taxonomy_hidden_4").val();
  var nd_learning_term_taxonomy_5 = jQuery( "#nd_learning_term_taxonomy_hidden_5").val();
  var nd_learning_term_taxonomy_6 = jQuery( "#nd_learning_term_taxonomy_hidden_6").val();

  var nd_learning_archive_courses_layoutt = jQuery( "#nd_learning_archive_courses_layoutt").val();

  //START post method
  jQuery.get(
    
  
    //ajax
    nd_learning_my_vars_courses_sorting.nd_learning_ajaxurl_courses_sorting,
    {
      action : 'nd_learning_courses_sorting_php',
      nd_learning_paged: nd_learning_paged,
      nd_learning_layout: nd_learning_layout,
      nd_learning_term_taxonomy_1: nd_learning_term_taxonomy_1,
      nd_learning_term_taxonomy_2: nd_learning_term_taxonomy_2,
      nd_learning_term_taxonomy_3: nd_learning_term_taxonomy_3,
      nd_learning_term_taxonomy_4: nd_learning_term_taxonomy_4,
      nd_learning_term_taxonomy_5: nd_learning_term_taxonomy_5,
      nd_learning_term_taxonomy_6: nd_learning_term_taxonomy_6,
      nd_learning_archive_courses_layoutt: nd_learning_archive_courses_layoutt,
       nd_learning_search_courses_security : nd_learning_my_vars_courses_sorting.nd_learning_ajaxnonce_courses_sorting,
    },
    //end ajax


    //START success
    function( nd_learning_courses_sorting_result ) {


      jQuery("#nd_learning_hidden_pagination_value").val(nd_learning_paged);
      jQuery("#nd_learning_hidden_layout_value").val(nd_learning_layout);
    
      jQuery( "body" ).append('<div id="nd_learning_courses_sorting_result_loader" class="nd_learning_position_fixed nd_learning_bg_greydark_alpha_4 nd_learning_cursor_progress nd_learning_height_100_percentage nd_learning_width_100_percentage"></div>');

      jQuery( ".nd_learning_masonry_content" ).remove();
      jQuery( "#nd_learning_archive_search_masonry_container" ).append(nd_learning_courses_sorting_result);

      jQuery( "#nd_learning_courses_sorting_result_loader" ).remove();

    }
    //END

    

  );
  //END

  
}
//END function