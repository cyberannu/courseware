<?php

$nd_learning_googlecalendar_enable = get_option('nd_learning_googlecalendar_enable');
if ( $nd_learning_googlecalendar_enable == 1 and get_option('nicdark_theme_author') == 1 ) {

//add shortcode in the custom hook
add_action('nd_learning_sidebar_single_course_page','nd_learning_shortcode_google_calendar_button');

//START  nd_learning_googlecalendar_button
function nd_learning_shortcode_google_calendar_button() {

  $nd_learning_title_course = get_the_title();
  $nd_learning_meta_box_date = get_post_meta( get_the_ID(), 'nd_learning_meta_box_date', true );
  $nd_learning_excerpt_course = get_the_excerpt();
  
  //location
  $nd_learning_terms_location_course_results = '';
  $nd_learning_terms_location_course = wp_get_post_terms( get_the_ID(), 'location-course', array("fields" => "all"));
  foreach($nd_learning_terms_location_course as $nd_learning_term_location_course) { $nd_learning_terms_location_course_results .= $nd_learning_term_location_course->name.' '; }


  echo '

    <div class="nd_learning_section nd_learning_text_align_center">
      <a id="nd_learning_single_course_page_calendar_btn" target="_blank" href="https://calendar.google.com/calendar/render?action=TEMPLATE&text='.$nd_learning_title_course.'&dates=20110206T190000Z/20110206T200000Z&details='.$nd_learning_excerpt_course.'&location='.$nd_learning_terms_location_course_results.'&trp=false&sprop=&sprop=&sf=true&output= target="_blank" rel="nofollow" class="nd_learning_bg_red nd_options_first_font nd_learning_font_size_13 nd_learning_cursor_pointer nd_learning_display_inline_block nd_learning_color_white_important nd_learning_text_decoration_none nd_learning_padding_8 nd_learning_border_radius_3">'.__('ADD TO MY CALENDAR','nd-learning').'</a>
    </div>

    <div class="nd_learning_section nd_learning_height_20"></div>

  ';

}
add_shortcode('nd_learning_google_calendar_button', 'nd_learning_shortcode_google_calendar_button');
//END nd_learning_login


}