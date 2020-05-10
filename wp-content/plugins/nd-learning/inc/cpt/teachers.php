<?php


///////////////////////////////////////////////////TEACHERS///////////////////////////////////////////////////////////////
function nd_learning_create_post_type_teachers() {
    register_post_type('teachers',
        array(
            'labels' => array(
                'name' => __('Teachers', 'nd-learning'),
                'singular_name' => __('Teachers', 'nd-learning')
            ),
            'public' => true,
            'has_archive' => true,
            'exclude_from_search' => true,
            'rewrite' => array('slug' => 'teachers'),
            'menu_icon'   => 'dashicons-welcome-learn-more',
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt')
        )
    );
}
add_action('init', 'nd_learning_create_post_type_teachers');



///////////////////////////////////////////////////TAXONOMIES TEACHERS///////////////////////////////////////////////////////////////

//categories
function nd_learning_create_taxonomy_teachers_categories() {
    register_taxonomy(
        'category-teacher',
        'post',
        array(
            'label'=>__('Categories', 'nd-learning'),
            'rewrite'=>array('slug'=>'categories-teachers'),
            'hierarchical'=>true
        )
    );
}
add_action('init','nd_learning_create_taxonomy_teachers_categories');


///////////////////////////////////////////////////ADD TAXONOMIES TO CPT///////////////////////////////////////////////////////////////

function nd_learning_add_taxonomy_teachers(){ 

    register_taxonomy_for_object_type('category-teacher', 'teachers'); 

}
add_action('init', 'nd_learning_add_taxonomy_teachers');



//HIDE TAXONOMY IN POST
function nd_learning_hide_taxonomy_teachers_in_post() {
  echo '
    <style> 

        .post-type-post #category-teacherdiv
        { 
            display:none; 
        } 

    </style>';
}
add_action('admin_head', 'nd_learning_hide_taxonomy_teachers_in_post');

