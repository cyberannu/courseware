<?php

$nd_learning_share_enable = get_option('nd_learning_share_enable');
if ( $nd_learning_share_enable == 1 and get_option('nicdark_theme_author') == 1 ) {

//add shortcode in the custom hook
add_action('nd_learning_single_course_end_default_tab','nd_learning_shortcode_social_share');

//START  nd_learning_social_share
function nd_learning_shortcode_social_share() {

  //recover datas
  $nd_learning_id_course = get_the_ID();
  $nd_learning_title_course = get_the_title($nd_learning_id_course);
  $nd_learning_permalink_course = get_permalink($nd_learning_id_course);

  //image src
  $nd_learning_image_id = get_post_thumbnail_id( $nd_learning_id_course );
  $nd_learning_image_attributes = wp_get_attachment_image_src( $nd_learning_image_id, 'large' );
  $nd_learning_image_src = $nd_learning_image_attributes[0];

  //domain
  $nd_learning_site_url = site_url();

  $nd_learning_result = '';



  $nd_learning_result .= '
    <div class="nd_learning_section nd_learning_height_40"></div>
    <div class="nd_learning_section">
        <a target="_blank" href="http://www.facebook.com/share.php?u='.urlencode($nd_learning_permalink_course).'&amp;title='.$nd_learning_title_course.'"><img alt="" width="40" height="40" class="nd_learning_margin_right_10" src="'.esc_url(plugins_url('img/facebook.svg', __FILE__ )).'"></a>
        <a target="_blank" href="http://twitter.com/intent/tweet?status='.$nd_learning_title_course.'+'.$nd_learning_permalink_course.'"><img alt="" width="40" height="40" class="nd_learning_margin_right_10" src="'.esc_url(plugins_url('img/twitter.svg', __FILE__ )).'"></a>
        <a target="_blank" href="http://pinterest.com/pin/create/bookmarklet/?media='.$nd_learning_image_src.'&url='.$nd_learning_permalink_course.'&is_video=false&description='.$nd_learning_title_course.'"><img alt="" width="40" height="40" class="nd_learning_margin_right_10" src="'.esc_url(plugins_url('img/pinterst.svg', __FILE__ )).'"></a>
        <a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url='.$nd_learning_permalink_course.'&title='.$nd_learning_title_course.'&source='.$nd_learning_site_url.'"><img alt="" width="40" height="40" class="nd_learning_margin_right_10" src="'.esc_url(plugins_url('img/linkedin.svg', __FILE__ )).'"></a>
        <a target="_blank" href="https://plus.google.com/share?url='.urlencode($nd_learning_permalink_course).'"><img alt="" width="40" height="40" class="nd_learning_margin_right_10" src="'.esc_url(plugins_url('img/googleplus.svg', __FILE__ )).'"></a>
        <a target="_blank" href="mailto:?subject='.$nd_learning_title_course.'&amp;body='.$nd_learning_permalink_course.'"><img alt="" width="40" height="40" class="nd_learning_margin_right_10" src="'.esc_url(plugins_url('img/mail.svg', __FILE__ )).'"></a>
    </div>
  ';



  echo $nd_learning_result;

}
add_shortcode('nd_learning_social_share', 'nd_learning_shortcode_social_share');
//END 

}