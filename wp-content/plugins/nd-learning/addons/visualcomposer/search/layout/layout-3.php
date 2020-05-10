<?php



//START get qnt courses
$nd_learning_posttype = 'courses';
$nd_learning_args = array(
  'post_type' => ''.$nd_learning_posttype.''
);
$the_query = new WP_Query( $nd_learning_args );
$nd_learning_qnt_results_posts = $the_query->found_posts;
//END get qnt courses



$nd_learning_str .= '

  <div class="'.$nd_learning_class.' nd_learning_section">




    <div class="nd_learning_section nd_learning_bg_white nd_learning_border_1_solid_grey">

      <div class="nd_learning_section nd_learning_padding_20 nd_learning_box_sizing_border_box nd_learning_bg_grey nd_learning_border_bottom_1_solid_grey nd_learning_text_align_center">
        <h6 style="background-color:'.$nd_learning_label_bg_color.';" class="nd_options_second_font nd_learning_padding_5 nd_learning_border_radius_3 nd_learning_color_white_important nd_learning_display_inline_block">'.$nd_learning_qnt_results_posts.' '.__('COURSES','nd-learning').'</h6>
        <div class="nd_learning_section nd_learning_height_5"></div>
        <h1 class=""><strong>'.$nd_learning_title.'</strong></h1>
      </div>
    
      <div class="nd_learning_section nd_learning_padding_20_25 nd_learning_box_sizing_border_box">

        <form class="" action="'.$nd_learning_action.'" method="GET">

          <input type="hidden" value="true" name="nd_learning_arrive_from_advsearch">';



          //get all taxonmies
          $nd_learning_taxonomies = get_object_taxonomies($nd_learning_posttype);
    
          //call the functions for each tax
          $nd_learning_i = 0;
          foreach($nd_learning_taxonomies as $nd_learning_tax){

            $nd_learning_str .= nd_learning_build_select($nd_learning_tax,$nd_learning_i,'',$nd_learning_layout,$nd_learning_width);
            $nd_learning_i = $nd_learning_i + 1;

          }

          $nd_learning_str .= '

            <div class="'.$nd_learning_width.' nd_learning_float_left nd_learning_width_100_percentage_all_iphone nd_learning_padding_15 nd_learning_box_sizing_border_box">
              <input class="nd_learning_section" type="submit" value="'.__('Search','nd-learning').'">
            </div>


          </form>

      </div>';




      $nd_learning_str .= '</div>  

    </div>';









    

    
