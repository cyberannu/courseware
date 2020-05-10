<?php


get_header( );


wp_enqueue_script('masonry');

//course archive
if ( 
		is_post_type_archive('courses') || 
		is_tax( 'category-course') || 
		is_tax( 'difficulty-level-course') ||
		is_tax( 'location-course') ||
		is_tax( 'typology-course') ||
		is_tax( 'duration-course')
	){

	include "archive-courses.php";

}


//teacher archive
if (

		is_post_type_archive('teachers') || 
		is_tax( 'category-teacher') 

	){

	include "archive-teachers.php";
	
}


get_footer( ); ?>
