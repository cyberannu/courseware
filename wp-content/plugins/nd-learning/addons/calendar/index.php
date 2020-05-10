<?php


$nd_learning_calendar_enable = get_option('nd_learning_calendar_enable');
if ( $nd_learning_calendar_enable == 1 and get_option('nicdark_theme_author') == 1 ) {


add_action('nd_learning_sidebar_single_course_page_2','nd_learning_single_course_calendar');

function nd_learning_single_course_calendar() {

  wp_enqueue_script('jquery-ui-datepicker');

  //metabox
  $nd_learning_meta_box_date = get_post_meta( get_the_ID(), 'nd_learning_meta_box_date', true );
  $nd_learning_meta_box_color = get_post_meta( get_the_ID(), 'nd_learning_meta_box_color', true );

  $nd_learning_result = '';

  if ( $nd_learning_meta_box_date != '' ) { 

    //course date
    $nd_learning_course_date_year = date("Y", strtotime($nd_learning_meta_box_date));
    $nd_learning_course_date_month = ( date("m", strtotime($nd_learning_meta_box_date)) -1 );
    $nd_learning_course_date_days = date("d", strtotime($nd_learning_meta_box_date));

    //final date
    $nd_learning_course_date = $nd_learning_course_date_year.','.$nd_learning_course_date_month.','.$nd_learning_course_date_days;

  
    $nd_learning_result .= '

      <style>

        #nd_learning_calendar_single_course { float: left; width: 100%; text-align: center; }
        #nd_learning_calendar_single_course .ui-datepicker { float: left; width: 100%; }
        #nd_learning_calendar_single_course .ui-datepicker-header { float: left; width: 100%; }
        #nd_learning_calendar_single_course .ui-datepicker-calendar { display: inline-table; width: 95%; margin-top: 15px; margin-bottom: 15px; }
        #nd_learning_calendar_single_course .ui-datepicker-prev { display: none; }
        #nd_learning_calendar_single_course .ui-datepicker-next { display: none; }
        #nd_learning_calendar_single_course .ui-datepicker-header .ui-datepicker-title { background-color: #F9F9F9; padding: 20px; font-size: 20px; font-weight: bolder; border-bottom: 1px solid #f1f1f1; }
        #nd_learning_calendar_single_course .ui-datepicker-calendar { margin-top: 10px; }
        #nd_learning_calendar_single_course .ui-datepicker-calendar th,#nd_learning_calendar_single_course .ui-datepicker-calendar td { padding: 10px 5px; }
        #nd_learning_calendar_single_course .ui-datepicker-unselectable span { background-color: #fff; }
        #nd_learning_calendar_single_course a.ui-state-default { color:#fff; padding: 5px; border-radius: 3px; }
        #nd_learning_calendar_single_course a.ui-state-default { background-color: '.$nd_learning_meta_box_color.'; }

      </style>


      <script type="text/javascript">
      <!--//--><![CDATA[//><!--
      jQuery(document).ready(function($) {
        $( "#nd_learning_calendar_single_course" ).datepicker({ 
          minDate: new Date('.$nd_learning_course_date.'), 
          maxDate: new Date('.$nd_learning_course_date.') 
        });
      });
      //--><!]]>
      </script>


      <div id="nd_learning_calendar_single_course"></div>

    ';

  }


  


  echo $nd_learning_result;


}

  

}