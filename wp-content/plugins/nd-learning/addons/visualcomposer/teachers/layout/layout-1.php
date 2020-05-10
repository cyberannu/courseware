<?php


wp_enqueue_script('masonry');

$str .= '


	<script type="text/javascript">
    //<![CDATA[
    
    jQuery(document).ready(function() {

      //START masonry
      jQuery(function ($) {
        
        //Masonry
		var $nd_learning_masonry_content = $(".nd_learning_masonry_content").imagesLoaded( function() {
		  // init Masonry after all images have loaded
		  $nd_learning_masonry_content.masonry({
		    itemSelector: ".nd_learning_masonry_item"
		  });
		});


      });
      //END masonry

    });

    //]]>
  </script>


';


$str .= '<div class="nd_learning_section nd_learning_masonry_content '.$nd_learning_class.' ">';

while ( $the_query->have_posts() ) : $the_query->the_post();

//info
$nd_learning_id = get_the_ID(); 
$nd_learning_title = get_the_title();
$nd_learning_excerpt = get_the_excerpt();
$nd_learning_permalink = get_permalink( $nd_learning_id );

//image
$nd_learning_image_id = get_post_thumbnail_id( $nd_learning_id );
$nd_learning_image_attributes = wp_get_attachment_image_src( $nd_learning_image_id, 'large' );
if ( $nd_learning_image_attributes[0] == '' ) { $nd_learning_output_image = ''; }else{
  $nd_learning_output_image = '<img class="nd_learning_section" alt="" src="'.$nd_learning_image_attributes[0].'">';
}

//metabox
$nd_learning_meta_box_teacher_color = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_teacher_color', true );
if ( $nd_learning_meta_box_teacher_color == '' ) { $nd_learning_meta_box_teacher_color = '#000'; }

$nd_learning_meta_box_teacher_role = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_teacher_role', true );
if ( $nd_learning_meta_box_teacher_role == '' ) { $nd_learning_meta_box_teacher_role = __('TEACHER','nd-learning'); }


//social
$nd_learning_social_teacher_output = '<div class="nd_learning_position_absolute nd_learning_bottom_20"><div class="nd_learning_display_inline_block">';

//facebook
$nd_learning_meta_box_teacher_social_facebook = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_teacher_social_facebook', true );
if ( $nd_learning_meta_box_teacher_social_facebook == '' ) { 
	$nd_learning_meta_box_teacher_social_facebook = ''; 
}else{
	$nd_learning_social_teacher_output .= '<a target="_blank" href="'.$nd_learning_meta_box_teacher_social_facebook.'"><img alt="" width="15" height="15" class="nd_learning_margin_right_10 nd_learning_float_left" src="'.esc_url(plugins_url('facebook.svg', __FILE__ )).'"></a>';
}
//twitter
$nd_learning_meta_box_teacher_social_twitter = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_teacher_social_twitter', true );
if ( $nd_learning_meta_box_teacher_social_twitter == '' ) { 
	$nd_learning_meta_box_teacher_social_twitter = ''; 
}else{
	$nd_learning_social_teacher_output .= '<a target="_blank" href="'.$nd_learning_meta_box_teacher_social_twitter.'"><img alt="" width="15" height="15" class="nd_learning_margin_right_10 nd_learning_float_left" src="'.esc_url(plugins_url('twitter.svg', __FILE__ )).'"></a>';
}

//instagram
$nd_learning_meta_box_teacher_social_instagram = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_teacher_social_instagram', true );
if ( $nd_learning_meta_box_teacher_social_instagram == '' ) { 
	$nd_learning_meta_box_teacher_social_instagram = ''; 
}else{
	$nd_learning_social_teacher_output .= '<a target="_blank" href="'.$nd_learning_meta_box_teacher_social_instagram.'"><img alt="" width="15" height="15" class="nd_learning_margin_right_10 nd_learning_float_left" src="'.esc_url(plugins_url('instagram.svg', __FILE__ )).'"></a>';
}

//pinterest
$nd_learning_meta_box_teacher_social_pinterest = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_teacher_social_pinterest', true );
if ( $nd_learning_meta_box_teacher_social_pinterest == '' ) { 
	$nd_learning_meta_box_teacher_social_pinterest = ''; 
}else{
	$nd_learning_social_teacher_output .= '<a target="_blank" href="'.$nd_learning_meta_box_teacher_social_pinterest.'"><img alt="" width="15" height="15" class="nd_learning_margin_right_10 nd_learning_float_left" src="'.esc_url(plugins_url('pinterest.svg', __FILE__ )).'"></a>';
}

//googleplus
$nd_learning_meta_box_teacher_social_googleplus = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_teacher_social_googleplus', true );
if ( $nd_learning_meta_box_teacher_social_googleplus == '' ) { 
	$nd_learning_meta_box_teacher_social_googleplus = ''; 
}else{
	$nd_learning_social_teacher_output .= '<a target="_blank" href="'.$nd_learning_meta_box_teacher_social_googleplus.'"><img alt="" width="15" height="15" class="nd_learning_margin_right_10 nd_learning_float_left" src="'.esc_url(plugins_url('googleplus.svg', __FILE__ )).'"></a>';
}

//youtube
$nd_learning_meta_box_teacher_social_youtube = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_teacher_social_youtube', true );
if ( $nd_learning_meta_box_teacher_social_youtube == '' ) { 
	$nd_learning_meta_box_teacher_social_youtube = ''; 
}else{
	$nd_learning_social_teacher_output .= '<a target="_blank" href="'.$nd_learning_meta_box_teacher_social_youtube.'"><img alt="" width="15" height="15" class="nd_learning_margin_right_10 nd_learning_float_left" src="'.esc_url(plugins_url('youtube.svg', __FILE__ )).'"></a>';
}

//linkedin
$nd_learning_meta_box_teacher_social_linkedin = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_teacher_social_linkedin', true );
if ( $nd_learning_meta_box_teacher_social_linkedin == '' ) { 
	$nd_learning_meta_box_teacher_social_linkedin = ''; 
}else{
	$nd_learning_social_teacher_output .= '<a target="_blank" href="'.$nd_learning_meta_box_teacher_social_linkedin.'"><img alt="" width="15" height="15" class="nd_learning_margin_right_10 nd_learning_float_left" src="'.esc_url(plugins_url('linkedin.svg', __FILE__ )).'"></a>';
}

//vimeo
$nd_learning_meta_box_teacher_social_vimeo = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_teacher_social_vimeo', true );
if ( $nd_learning_meta_box_teacher_social_vimeo == '' ) { 
	$nd_learning_meta_box_teacher_social_vimeo = ''; 
}else{
	$nd_learning_social_teacher_output .= '<a target="_blank" href="'.$nd_learning_meta_box_teacher_social_vimeo.'"><img alt="" width="15" height="15" class="nd_learning_margin_right_10 nd_learning_float_left" src="'.esc_url(plugins_url('vimeo.svg', __FILE__ )).'"></a>';
}

//behance
$nd_learning_meta_box_teacher_social_behance = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_teacher_social_behance', true );
if ( $nd_learning_meta_box_teacher_social_behance == '' ) { 
	$nd_learning_meta_box_teacher_social_behance = ''; 
}else{
	$nd_learning_social_teacher_output .= '<a target="_blank" href="'.$nd_learning_meta_box_teacher_social_behance.'"><img alt="" width="15" height="15" class="nd_learning_margin_right_10 nd_learning_float_left" src="'.esc_url(plugins_url('behance.svg', __FILE__ )).'"></a>';
}

//dribbble
$nd_learning_meta_box_teacher_social_dribbble = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_teacher_social_dribbble', true );
if ( $nd_learning_meta_box_teacher_social_dribbble == '' ) { 
	$nd_learning_meta_box_teacher_social_dribbble = ''; 
}else{
	$nd_learning_social_teacher_output .= '<a target="_blank" href="'.$nd_learning_meta_box_teacher_social_dribbble.'"><img alt="" width="15" height="15" class="nd_learning_margin_right_10 nd_learning_float_left" src="'.esc_url(plugins_url('dribbble.svg', __FILE__ )).'"></a>';
}

//github
$nd_learning_meta_box_teacher_social_github = get_post_meta( $nd_learning_id, 'nd_learning_meta_box_teacher_social_github', true );
if ( $nd_learning_meta_box_teacher_social_github == '' ) { 
	$nd_learning_meta_box_teacher_social_github = ''; 
}else{
	$nd_learning_social_teacher_output .= '<a target="_blank" href="'.$nd_learning_meta_box_teacher_social_github.'"><img alt="" width="15" height="15" class="nd_learning_margin_right_10 nd_learning_float_left" src="'.esc_url(plugins_url('github.svg', __FILE__ )).'"></a>';
}
  
$nd_learning_social_teacher_output .= '</div></div>';


$str .= '

	<div class=" '.$nd_learning_width.' nd_learning_padding_15 nd_learning_box_sizing_border_box nd_learning_masonry_item nd_learning_width_100_percentage_responsive">

	    <div class="nd_learning_section">
	        
	        <!--start preview-->
	        <div class="nd_learning_section ">
	            
	            <!--START image-->
	            <div class="nd_learning_section nd_learning_position_relative">
	                
	                '.$nd_learning_output_image.'

	                <div class="nd_learning_bg_greydark_alpha_gradient nd_learning_position_absolute nd_learning_left_0 nd_learning_height_100_percentage nd_learning_width_100_percentage nd_learning_padding_20 nd_learning_box_sizing_border_box">'.$nd_learning_social_teacher_output.'</div>

	            </div>
	            <!--END image-->


	            <div class="nd_learning_section nd_learning_padding_20 nd_learning_box_sizing_border_box">
	            
	                <h2><strong>'.$nd_learning_title .'</strong></h2>
	                <div class="nd_learning_section nd_learning_height_10"></div> 
	                <h6 class="nd_learning_text_transform_uppercase nd_options_color_grey">'.$nd_learning_meta_box_teacher_role.'</h6>
	                <div class="nd_learning_section nd_learning_height_20"></div> 
	                <p>'.$nd_learning_excerpt.'</p>
	                <div class="nd_learning_section nd_learning_height_20"></div> 
	                <a style="background-color: '.$nd_learning_meta_box_teacher_color.';" class="nd_learning_display_inline_block nd_learning_color_white_important nd_options_first_font nd_learning_padding_8 nd_learning_border_radius_3 nd_learning_font_size_13" href="'.$nd_learning_permalink.'">'.__('VIEW PROFILE','nd-learning').'</a>

	            </div>

	        </div>
	        <!--start preview-->

	    </div> 

	</div>


  ';

endwhile;

$str .= '</div>';