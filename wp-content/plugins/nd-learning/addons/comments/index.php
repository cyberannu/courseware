<?php

$nd_learning_comments_enable = get_option('nd_learning_comments_enable');
if ( $nd_learning_comments_enable == 1 and get_option('nicdark_theme_author') == 1 ) {

//add comments tab list in the custom hook
add_action('nd_learning_single_course_tab_list_2','nd_learning_single_course_add_comments_tab_list');
function nd_learning_single_course_add_comments_tab_list(){

  $nd_learning_comments_tab = '';


  $nd_learning_comments_tab .= '
    <li class="nd_learning_display_inline_block">
    <h4>
      <a class="nd_learning_outline_0 nd_learning_padding_20_15 nd_learning_display_inline_block nd_options_first_font nd_options_color_greydark" href="#nd_learning_single_course_comments">
        '.__('Comments','nd-learning').'
      </a>
    </h4>
  </li>
    ';

    echo $nd_learning_comments_tab;

}


//add shortcode in the custom hook
add_action('nd_learning_single_course_tab_list_content','nd_learning_shortcode_comments');

//START  nd_learning_attendees
function nd_learning_shortcode_comments() {


  echo '<div class="nd_learning_section" id="nd_learning_single_course_comments">';

    comments_template();
  
  echo '</div>';


  echo '

    <!--START  for post-->
    <style type="text/css">

        /*comment list*/
        #nd_learning_single_course_comments #nd_options_comments { margin-top: 40px; }
        #nd_learning_single_course_comments .nd_options_comments_ul { margin:0px; margin-top:30px; padding: 0px; list-style: none; }
        #nd_learning_single_course_comments .nd_options_comments_ul li { padding:40px 20px; margin:0px; float: left; width: 100%; border-top:1px solid #f1f1f1; box-sizing:border-box; }
        #nd_learning_single_course_comments .nd_options_comments_ul li:last-child { border-bottom:1px solid #f1f1f1; }
        #nd_learning_single_course_comments .nd_options_comments_ul li .children { margin:0px; padding: 10px 40px; list-style: none; }
        #nd_learning_single_course_comments .nd_options_comments_ul li .reply a.comment-reply-link { color: #fff; margin-top: 10px; display: inline-block; line-height: 8px; border-radius: 3px; padding: 8px; font-size: 13px; text-transform: uppercase; }
        #nd_learning_single_course_comments .nd_options_comments_ul li .comment-author .fn, 
        #nd_learning_single_course_comments .nd_options_comments_ul li .comment-author .fn a { font-weight: bold; font-style: normal; }
        #nd_learning_single_course_comments .nd_options_comments_ul li .comment-author img { border-radius: 100%; }
        #nd_learning_single_course_comments .nd_options_comments_ul li .comment-author { display: table; }
        #nd_learning_single_course_comments .nd_options_comments_ul li .comment-author .fn { display: table-cell; vertical-align: middle; padding: 0px 10px; }
        #nd_learning_single_course_comments .nd_options_comments_ul li .comment-author .says { display: table-cell; vertical-align: middle; }
        #nd_learning_single_course_comments .nd_options_comments_ul li .comment-author img { display: inline; vertical-align: middle; }

        /*comment form*/
        #nd_learning_single_course_comments #nd_options_comments_form h3.comment-reply-title, 
        #nd_learning_single_course_comments #nd_options_comments_form #respond.comment-respond h3.comment-reply-title { font-weight: bolder; margin-bottom: 10px; }
        #nd_learning_single_course_comments #nd_options_comments_form #respond.comment-respond h3.comment-reply-title { margin-top: 20px; }
        #nd_learning_single_course_comments #nd_options_comments_form label, 
        #nd_learning_single_course_comments #nd_options_comments_form input[type="text"], 
        #nd_learning_single_course_comments #nd_options_comments_form textarea { float: left; width: 100%; }
        #nd_learning_single_course_comments #nd_options_comments_form input[type="submit"] { border: 0px; color: #fff; border-radius: 3px; margin-top: 10px; }
        #nd_learning_single_course_comments #nd_options_comments_form p { margin: 10px 0px; float: left; width: 100%; }
        #nd_learning_single_course_comments #nd_options_comments_form #commentform.comment-form label, 
        #nd_learning_single_course_comments #nd_options_comments_form #commentform.comment-form input[type="text"], 
        #nd_learning_single_course_comments #nd_options_comments_form #commentform.comment-form textarea { float: left; width: 100%; }
        #nd_learning_single_course_comments #nd_options_comments_form #commentform.comment-form input[type="submit"] { border: 0px; color: #fff; border-radius: 3px; margin-top: 10px; }
        #nd_learning_single_course_comments #nd_options_comments_form #commentform.comment-form p { margin: 10px 0px; float: left; width: 100%; }

        /*font and color*/
        #nd_learning_single_course_comments .nd_options_comments_ul li .reply a.comment-reply-link { background-color: '.nd_learning_get_course_color().'; }
        #nd_learning_single_course_comments #nd_options_comments_form input[type="submit"] { background-color: '.nd_learning_get_course_color().'; }
        #nd_learning_single_course_comments #nd_options_comments_form #commentform.comment-form input[type="submit"] { background-color: '.nd_learning_get_course_color().'; }


    </style>
    <!--END css for post-->

  ';



}


}