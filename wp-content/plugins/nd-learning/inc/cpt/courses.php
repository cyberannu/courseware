<?php

///////////////////////////////////////////////////COURSES///////////////////////////////////////////////////////////////
function nd_learning_create_post_type_courses() {
    register_post_type('courses',
        array(
            'labels' => array(
                'name' => __('Courses', 'nd-learning'),
                'singular_name' => __('Courses', 'nd-learning')
            ),
            'public' => true,
            'has_archive' => true,
            'exclude_from_search' => true,
            'rewrite' => array('slug' => 'courses'),
            'menu_icon'   => 'dashicons-megaphone',
            'taxonomies' => array('post_tag'),
            'supports' => array('title', 'editor', 'thumbnail' , 'excerpt', 'comments')
        )
    );
}
add_action('init', 'nd_learning_create_post_type_courses');


///////////////////////////////////////////////////TAXONOMIES COURSES///////////////////////////////////////////////////////////////

//difficulty levels
function nd_learning_create_taxonomy_courses_difficulty_levels() {
    register_taxonomy(
        'difficulty-level-course',
        'post',
        array(
            'label'=>__('Levels', 'nd-learning'),
            'rewrite'=>array('slug'=>'difficulty-levels-courses'),
            'hierarchical'=>true
        )
    );
}
add_action('init','nd_learning_create_taxonomy_courses_difficulty_levels');

//categories
function nd_learning_create_taxonomy_courses_categories() {
    register_taxonomy(
        'category-course',
        'post',
        array(
            'label'=>__('Categories', 'nd-learning'),
            'rewrite'=>array('slug'=>'categories-courses'),
            'hierarchical'=>true
        )
    );
}
add_action('init','nd_learning_create_taxonomy_courses_categories');

//locations
function nd_learning_create_taxonomy_courses_locations() {
    register_taxonomy(
        'location-course',
        'post',
        array(
            'label'=>__('Locations', 'nd-learning'),
            'rewrite'=>array('slug'=>'locations-courses'),
            'hierarchical'=>true
        )
    );
}
add_action('init','nd_learning_create_taxonomy_courses_locations');

//typologies
function nd_learning_create_taxonomy_courses_typologies() {
    register_taxonomy(
        'typology-course',
        'post',
        array(
            'label'=>__('Typologies', 'nd-learning'),
            'rewrite'=>array('slug'=>'typologies-courses'),
            'hierarchical'=>true
        )
    );
}
add_action('init','nd_learning_create_taxonomy_courses_typologies');

//Durations
function nd_learning_create_taxonomy_courses_durations() {
    register_taxonomy(
        'duration-course',
        'post',
        array(
            'label'=>__('Durations', 'nd-learning'),
            'rewrite'=>array('slug'=>'durations-courses'),
            'hierarchical'=>true
        )
    );
}
add_action('init','nd_learning_create_taxonomy_courses_durations');


///////////////////////////////////////////////////ADD TAXONOMIES TO CPT///////////////////////////////////////////////////////////////
function nd_learning_add_taxonomy_courses(){ 

    register_taxonomy_for_object_type('difficulty-level-course', 'courses');
    register_taxonomy_for_object_type('category-course', 'courses'); 
    register_taxonomy_for_object_type('location-course', 'courses'); 
    register_taxonomy_for_object_type('typology-course', 'courses'); 
    register_taxonomy_for_object_type('duration-course', 'courses'); 

}
add_action('init', 'nd_learning_add_taxonomy_courses');




//HIDE TAXONOMY IN POST
function nd_learning_hide_taxonomy_courses_in_post() {
  echo '
    <style> 

        .post-type-post #difficulty-level-coursediv,
        .post-type-post #category-coursediv,
        .post-type-post #location-coursediv,
        .post-type-post #typology-coursediv,
        .post-type-post #duration-coursediv
        { 
            display:none; 
        } 

    </style>';
}
add_action('admin_head', 'nd_learning_hide_taxonomy_courses_in_post');

