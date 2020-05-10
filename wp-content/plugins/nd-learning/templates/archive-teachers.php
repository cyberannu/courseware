<?php


get_header( );


wp_enqueue_script('masonry');


//display
$nd_learning_customizer_archive_teachers_header_image_display = get_option( 'nd_learning_customizer_archive_teachers_header_image_display' );
if ( $nd_learning_customizer_archive_teachers_header_image_display == '' ) { $nd_learning_customizer_archive_teachers_header_image_display = 0;  }
$nd_learning_customizer_nd_learning_archive_header_image_title = get_post_type_object(get_post_type())->labels->singular_name;

if ( $nd_learning_customizer_archive_teachers_header_image_display != 1 ) { ?>



	<?php

		//header image
		$nd_learning_customizer_archive_teachers_header_image = get_option( 'nd_learning_customizer_archive_teachers_header_image' );
		if ( $nd_learning_customizer_archive_teachers_header_image == '' ) { 
		    $nd_learning_customizer_archive_teachers_header_image = '';  
		}else{
		    $nd_learning_customizer_archive_teachers_header_image = wp_get_attachment_url($nd_learning_customizer_archive_teachers_header_image);
		}


		//position
		$nd_learning_customizer_archive_teachers_header_image_position = get_option( 'nd_learning_customizer_archive_teachers_header_image_position' );
		if ( $nd_learning_customizer_archive_teachers_header_image_position == '' ) { 
		    $nd_learning_customizer_archive_teachers_header_image_position = 'nd_learning_background_position_center_top';  
		}

	?>


	<div class="nd_learning_section nd_learning_background_size_cover <?php echo $nd_learning_customizer_archive_teachers_header_image_position; ?> nd_learning_bg_greydark" style="background-image:url(<?php echo $nd_learning_customizer_archive_teachers_header_image; ?>);">

        <div class="nd_learning_section nd_learning_bg_greydark_alpha_gradient_2">
            
            <!--start nd_learning_container-->
            <div class="nd_learning_container nd_learning_clearfix">

                <div class="nd_learning_section nd_learning_height_200"></div>

                <div class="nd_learning_section nd_learning_padding_15 nd_learning_box_sizing_border_box">
                    <strong class="nd_learning_color_white_important nd_learning_font_size_60 nd_learning_font_size_40_all_iphone nd_learning_line_height_40_all_iphone nd_options_first_font"><?php echo $nd_learning_customizer_nd_learning_archive_header_image_title; ?></strong>
                </div>

                <div class="nd_learning_section nd_learning_height_20"></div>

            </div>
            <!--end container-->

        </div>

    </div>



    <?php do_action('nd_learning_end_header_img_archive_teachers_hook'); ?>


<?php }



//add conteiner
$nd_learning_container = get_option('nd_learning_container');
if ($nd_learning_container != 1) { echo '<div class="nd_learning_container nd_learning_clearfix">'; }


//teachers archive
if (is_post_type_archive('teachers')){


	$nd_learning_paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1 ;

	$args = array(
		'post_type' => 'teachers',
	  	'paged' => $nd_learning_paged
	);	

}

//taxonomy archive
if (is_tax()){

	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	$termname = $term->name;
	$taxmname = $term->taxonomy;

	$args = array(
		'post_type' => 'teachers',
		'posts_per_page' => -1,
		''.$taxmname.'' => $termname
	);	

}


//loop
$the_query = new WP_Query( $args );

$nd_learning_archive_result = '';

$nd_learning_archive_result .= '


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

$nd_learning_archive_result .= '
<div class="nd_learning_section nd_learning_height_50"></div>
<div class="nd_learning_section nd_learning_masonry_content">

';


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


	$nd_learning_archive_result .= '

		<div class=" nd_learning_width_33_percentage nd_learning_padding_15 nd_learning_box_sizing_border_box nd_learning_masonry_item nd_learning_width_100_percentage_responsive">

	        <div class="nd_learning_section">
	            
	            <!--start preview-->
	            <div class="nd_learning_section nd_learning_border_1_solid_grey">
	                
	                <!--image-->
	                <div class="nd_learning_section nd_learning_position_relative">
	                    '.$nd_learning_output_image.'
	                </div>
	                <!--image-->

	                <div class="nd_learning_section nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_bg_white">
	                
	                    <h3><a class="nd_options_color_greydark nd_options_first_font" href="'.$nd_learning_permalink.'">'.$nd_learning_title.'</a></h3>
	                    <div class="nd_learning_section nd_learning_height_20"></div> 
	                    <p><a class="" href="'.$nd_learning_permalink.'">'.$nd_learning_excerpt.'</a></p>
	                    <div class="nd_learning_section nd_learning_height_20"></div>
	                    <a class="nd_learning_bg_green nd_learning_display_inline_block nd_learning_color_white_important nd_options_first_font nd_learning_padding_8 nd_learning_border_radius_3 nd_learning_font_size_13" href="'.$nd_learning_permalink.'">'.__('READ MORE','nd-learning').'</a>

	                </div>

	            </div>
	            <!--start preview-->

	        </div> 

	    </div>


	  ';


endwhile;
//end loop


$nd_learning_archive_result .= '</div><div class="nd_learning_section nd_learning_height_50"></div>';


echo $nd_learning_archive_result;


$nd_learning_archive_result = '
<!--START pagination-->

<div class="nd_learning_section">';


	the_posts_pagination( array(
		'prev_text'          => __( 'Prev', 'nd-learning' ),
		'next_text'          => __( 'Next', 'nd-learning' ),
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'nd-learning' ) . ' </span>',
	) );


	$nd_learning_archive_result .= '</div><div class="nd_learning_section nd_learning_height_50"></div>
<!--END pagination-->';


echo $nd_learning_archive_result;


//close container
$nd_learning_container = get_option('nd_learning_container');
if ($nd_learning_container != 1) { echo '</div>'; }


get_footer( ); ?>
