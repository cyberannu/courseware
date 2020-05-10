<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
 
    <meta charset="<?php bloginfo('charset'); ?>"> 
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        	
<?php wp_head(); ?>	  
</head>  
<body id="start_nicdark_framework" <?php body_class(); ?>>


<!--START theme-->
<div class="nicdark_site nicdark_bg_white <?php if ( is_front_page() ) { echo esc_html("nicdark_front_page"); } ?> ">	
	
<?php if( function_exists('nicdark_headers')){ do_action("nicdark_header_nd"); }else{ ?>

<!--START section-->
<div class="nicdark_section nicdark_bg_greydark">
    
    <!--start container-->
    <div class="nicdark_container nicdark_clearfix">

        
        <!--START LOGO OR TAGLINE-->
        <?php
            
            $nicdark_customizer_logo_img = get_option( 'nicdark_customizer_logo_img' );
            if ( $nicdark_customizer_logo_img == '' or $nicdark_customizer_logo_img == 0 ) { ?>
                
            <div class="nicdark_grid_3 nicdark_text_align_center_responsive">
                <div class="nicdark_section nicdark_height_10"></div>
                <a class="" href="<?php echo esc_url(home_url()); ?>"><h3 class="nicdark_color_white"><?php echo esc_html(get_bloginfo( 'name' )); ?></h3></a>
                <div class="nicdark_section nicdark_height_10"></div>
                <a href="<?php echo esc_url(home_url()); ?>"><p class="nicdark_font_size_13"><?php echo esc_html(get_bloginfo( 'description' )); ?></p></a>
                <div class="nicdark_section nicdark_height_10"></div>
            </div>

        <?php

            }else{ 

                $nicdark_customizer_logo_img = wp_get_attachment_url($nicdark_customizer_logo_img);

            ?>

            <div class="nicdark_grid_3 nicdark_text_align_center_responsive">
                <a class="" href="<?php echo esc_url(home_url()); ?>">
                    <img class="nicdark_section" src="<?php echo esc_url($nicdark_customizer_logo_img); ?>">
                </a>
            </div>

        <?php } ?>
        <!--END LOGO OR TAGLINE-->
        


        <div class="nicdark_grid_9 nicdark_text_align_center_responsive">

        	<div class="nicdark_section nicdark_height_10"></div>
               
        	<div class="nicdark_section nicdark_navigation_1">        
        		<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>       
        	</div>

        	<div class="nicdark_section nicdark_height_10"></div>

        </div>

    </div>
    <!--end container-->

</div>
<!--END section-->


<?php } ?>

