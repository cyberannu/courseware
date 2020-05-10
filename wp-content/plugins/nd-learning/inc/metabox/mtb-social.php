<?php

///////////////////////////////////////////////////METABOX ///////////////////////////////////////////////////////////////


add_action( 'add_meta_boxes', 'nd_learning_meta_box_teacher_social' );
function nd_learning_meta_box_teacher_social() {
    add_meta_box( 'nd-learning-meta-box-teachers-social', __('Teacher Social','nd-learning'), 'nd_learning_meta_box_teachers_social', 'teachers', 'normal', 'low' );
}

function nd_learning_meta_box_teachers_social()
{


    // $post is already set, and contains an object: the WordPress post
    global $post;
    $nd_learning_values = get_post_custom( $post->ID );
     
    $nd_learning_meta_box_teacher_social_facebook = get_post_meta( get_the_ID(), 'nd_learning_meta_box_teacher_social_facebook', true );
    $nd_learning_meta_box_teacher_social_twitter = get_post_meta( get_the_ID(), 'nd_learning_meta_box_teacher_social_twitter', true );
    $nd_learning_meta_box_teacher_social_instagram = get_post_meta( get_the_ID(), 'nd_learning_meta_box_teacher_social_instagram', true );
    $nd_learning_meta_box_teacher_social_pinterest = get_post_meta( get_the_ID(), 'nd_learning_meta_box_teacher_social_pinterest', true );
    $nd_learning_meta_box_teacher_social_googleplus = get_post_meta( get_the_ID(), 'nd_learning_meta_box_teacher_social_googleplus', true );
    $nd_learning_meta_box_teacher_social_youtube = get_post_meta( get_the_ID(), 'nd_learning_meta_box_teacher_social_youtube', true );
    $nd_learning_meta_box_teacher_social_linkedin = get_post_meta( get_the_ID(), 'nd_learning_meta_box_teacher_social_linkedin', true );
    $nd_learning_meta_box_teacher_social_vimeo = get_post_meta( get_the_ID(), 'nd_learning_meta_box_teacher_social_vimeo', true );
    $nd_learning_meta_box_teacher_social_behance = get_post_meta( get_the_ID(), 'nd_learning_meta_box_teacher_social_behance', true );
    $nd_learning_meta_box_teacher_social_dribbble = get_post_meta( get_the_ID(), 'nd_learning_meta_box_teacher_social_dribbble', true );
    $nd_learning_meta_box_teacher_social_github = get_post_meta( get_the_ID(), 'nd_learning_meta_box_teacher_social_github', true );

    ?>


    <p><strong><?php _e('Facebook Url','nd-learning'); ?></strong></p>
    <p><input class="regular-text" type="text" name="nd_learning_meta_box_teacher_social_facebook" id="nd_learning_meta_box_teacher_social_facebook" value="<?php echo $nd_learning_meta_box_teacher_social_facebook; ?>" /></p>

    <p><strong><?php _e('Twitter Url','nd-learning'); ?></strong></p>
    <p><input class="regular-text" type="text" name="nd_learning_meta_box_teacher_social_twitter" id="nd_learning_meta_box_teacher_social_twitter" value="<?php echo $nd_learning_meta_box_teacher_social_twitter; ?>" /></p>

    <p><strong><?php _e('Instagram Url','nd-learning'); ?></strong></p>
    <p><input class="regular-text" type="text" name="nd_learning_meta_box_teacher_social_instagram" id="nd_learning_meta_box_teacher_social_instagram" value="<?php echo $nd_learning_meta_box_teacher_social_instagram; ?>" /></p>

    <p><strong><?php _e('Pinterest Url','nd-learning'); ?></strong></p>
    <p><input class="regular-text" type="text" name="nd_learning_meta_box_teacher_social_pinterest" id="nd_learning_meta_box_teacher_social_pinterest" value="<?php echo $nd_learning_meta_box_teacher_social_pinterest; ?>" /></p>

    <p><strong><?php _e('GooglePlus Url','nd-learning'); ?></strong></p>
    <p><input class="regular-text" type="text" name="nd_learning_meta_box_teacher_social_googleplus" id="nd_learning_meta_box_teacher_social_googleplus" value="<?php echo $nd_learning_meta_box_teacher_social_googleplus; ?>" /></p>

    <p><strong><?php _e('Youtube Url','nd-learning'); ?></strong></p>
    <p><input class="regular-text" type="text" name="nd_learning_meta_box_teacher_social_youtube" id="nd_learning_meta_box_teacher_social_youtube" value="<?php echo $nd_learning_meta_box_teacher_social_youtube; ?>" /></p>

    <p><strong><?php _e('Linkedin Url','nd-learning'); ?></strong></p>
    <p><input class="regular-text" type="text" name="nd_learning_meta_box_teacher_social_linkedin" id="nd_learning_meta_box_teacher_social_linkedin" value="<?php echo $nd_learning_meta_box_teacher_social_linkedin; ?>" /></p>

    <p><strong><?php _e('Vimeo Url','nd-learning'); ?></strong></p>
    <p><input class="regular-text" type="text" name="nd_learning_meta_box_teacher_social_vimeo" id="nd_learning_meta_box_teacher_social_vimeo" value="<?php echo $nd_learning_meta_box_teacher_social_vimeo; ?>" /></p>

    <p><strong><?php _e('Behance Url','nd-learning'); ?></strong></p>
    <p><input class="regular-text" type="text" name="nd_learning_meta_box_teacher_social_behance" id="nd_learning_meta_box_teacher_social_behance" value="<?php echo $nd_learning_meta_box_teacher_social_behance; ?>" /></p>

    <p><strong><?php _e('Dribbble Url','nd-learning'); ?></strong></p>
    <p><input class="regular-text" type="text" name="nd_learning_meta_box_teacher_social_dribbble" id="nd_learning_meta_box_teacher_social_dribbble" value="<?php echo $nd_learning_meta_box_teacher_social_dribbble; ?>" /></p>

    <p><strong><?php _e('Github Url','nd-learning'); ?></strong></p>
    <p><input class="regular-text" type="text" name="nd_learning_meta_box_teacher_social_github" id="nd_learning_meta_box_teacher_social_github" value="<?php echo $nd_learning_meta_box_teacher_social_github; ?>" /></p>

    <?php
}



add_action( 'save_post', 'nd_learning_meta_box_teachers_social_save' );
function nd_learning_meta_box_teachers_social_save( $post_id )
{

    // Make sure your data is set before trying to save it
    $nd_learning_meta_box_teacher_social_facebook = esc_url_raw( $_POST['nd_learning_meta_box_teacher_social_facebook'] );
    if ( isset( $nd_learning_meta_box_teacher_social_facebook ) ) { 

        if ( $nd_learning_meta_box_teacher_social_facebook != '' ) {
            update_post_meta( $post_id, 'nd_learning_meta_box_teacher_social_facebook' , $nd_learning_meta_box_teacher_social_facebook ); 
        }else{
            delete_post_meta( $post_id,'nd_learning_meta_box_teacher_social_facebook');
        }

    }

    $nd_learning_meta_box_teacher_social_twitter = esc_url_raw( $_POST['nd_learning_meta_box_teacher_social_twitter'] );
    if ( isset( $nd_learning_meta_box_teacher_social_twitter ) ) { 

        if ( $nd_learning_meta_box_teacher_social_twitter != '' ) {
            update_post_meta( $post_id, 'nd_learning_meta_box_teacher_social_twitter' , $nd_learning_meta_box_teacher_social_twitter ); 
        }else{
            delete_post_meta( $post_id,'nd_learning_meta_box_teacher_social_twitter');
        }
        
    }

    $nd_learning_meta_box_teacher_social_instagram = esc_url_raw( $_POST['nd_learning_meta_box_teacher_social_instagram'] );
    if ( isset( $nd_learning_meta_box_teacher_social_instagram ) ) { 

        if ( $nd_learning_meta_box_teacher_social_instagram != '' ) {
            update_post_meta( $post_id, 'nd_learning_meta_box_teacher_social_instagram' , $nd_learning_meta_box_teacher_social_instagram ); 
        }else{
            delete_post_meta( $post_id,'nd_learning_meta_box_teacher_social_instagram');
        }
 
    }

    $nd_learning_meta_box_teacher_social_pinterest = esc_url_raw( $_POST['nd_learning_meta_box_teacher_social_pinterest'] );
    if ( isset( $nd_learning_meta_box_teacher_social_pinterest ) ) {

        if ( $nd_learning_meta_box_teacher_social_pinterest != '' ) {
            update_post_meta( $post_id, 'nd_learning_meta_box_teacher_social_pinterest' , $nd_learning_meta_box_teacher_social_pinterest );
        }else{
            delete_post_meta( $post_id,'nd_learning_meta_box_teacher_social_pinterest');
        }
  
    }

    $nd_learning_meta_box_teacher_social_googleplus = esc_url_raw( $_POST['nd_learning_meta_box_teacher_social_googleplus'] );
    if ( isset( $nd_learning_meta_box_teacher_social_googleplus ) ) { 

        if ( $nd_learning_meta_box_teacher_social_googleplus != '' ) {
            update_post_meta( $post_id, 'nd_learning_meta_box_teacher_social_googleplus' , $nd_learning_meta_box_teacher_social_googleplus );
        }else{
            delete_post_meta( $post_id,'nd_learning_meta_box_teacher_social_googleplus');
        }
   
    }

    $nd_learning_meta_box_teacher_social_youtube = esc_url_raw( $_POST['nd_learning_meta_box_teacher_social_youtube'] );
    if ( isset( $nd_learning_meta_box_teacher_social_youtube ) ) { 

        if ( $nd_learning_meta_box_teacher_social_youtube != '' ) {
            update_post_meta( $post_id, 'nd_learning_meta_box_teacher_social_youtube' , $nd_learning_meta_box_teacher_social_youtube );
        }else{
            delete_post_meta( $post_id,'nd_learning_meta_box_teacher_social_youtube');
        }
         
    }

    $nd_learning_meta_box_teacher_social_linkedin = esc_url_raw( $_POST['nd_learning_meta_box_teacher_social_linkedin'] );
    if ( isset( $nd_learning_meta_box_teacher_social_linkedin ) ) { 

        if ( $nd_learning_meta_box_teacher_social_linkedin != '' ) {
            update_post_meta( $post_id, 'nd_learning_meta_box_teacher_social_linkedin' , $nd_learning_meta_box_teacher_social_linkedin ); 
        }else{
            delete_post_meta( $post_id,'nd_learning_meta_box_teacher_social_linkedin');
        }
        
    }

    $nd_learning_meta_box_teacher_social_vimeo = esc_url_raw( $_POST['nd_learning_meta_box_teacher_social_vimeo'] );
    if ( isset( $nd_learning_meta_box_teacher_social_vimeo ) ) { 

        if ( $nd_learning_meta_box_teacher_social_vimeo != '' ) {
            update_post_meta( $post_id, 'nd_learning_meta_box_teacher_social_vimeo' , $nd_learning_meta_box_teacher_social_vimeo );
        }else{
            delete_post_meta( $post_id,'nd_learning_meta_box_teacher_social_vimeo');
        }
         
    }

    $nd_learning_meta_box_teacher_social_behance = esc_url_raw( $_POST['nd_learning_meta_box_teacher_social_behance'] );
    if ( isset( $nd_learning_meta_box_teacher_social_behance ) ) { 

        if ( $nd_learning_meta_box_teacher_social_behance != '' ) {
            update_post_meta( $post_id, 'nd_learning_meta_box_teacher_social_behance' , $nd_learning_meta_box_teacher_social_behance );
        }else{
            delete_post_meta( $post_id,'nd_learning_meta_box_teacher_social_behance');
        }
  
    }

    $nd_learning_meta_box_teacher_social_dribbble = esc_url_raw( $_POST['nd_learning_meta_box_teacher_social_dribbble'] );
    if ( isset( $nd_learning_meta_box_teacher_social_dribbble ) ) { 

        if ( $nd_learning_meta_box_teacher_social_dribbble != '' ) {
            update_post_meta( $post_id, 'nd_learning_meta_box_teacher_social_dribbble' , $nd_learning_meta_box_teacher_social_dribbble ); 
        }else{
            delete_post_meta( $post_id,'nd_learning_meta_box_teacher_social_dribbble');
        }
        
    }

    $nd_learning_meta_box_teacher_social_github = esc_url_raw( $_POST['nd_learning_meta_box_teacher_social_github'] );
    if ( isset( $nd_learning_meta_box_teacher_social_github ) ) { 

        if ( $nd_learning_meta_box_teacher_social_github != '' ) {
            update_post_meta( $post_id, 'nd_learning_meta_box_teacher_social_github' , $nd_learning_meta_box_teacher_social_github );
        }else{
            delete_post_meta( $post_id,'nd_learning_meta_box_teacher_social_github');
        }
         
    }

}