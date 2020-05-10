<?php


$nd_learning_str .= '

  <div class="'.$nd_learning_class.' nd_learning_section">

    '.$nd_learning_title_output.'


    <form class="" action="'.$nd_learning_action.'" method="GET">

      <input type="hidden" value="true" name="nd_learning_arrive_from_advsearch">

    ';

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

</div>
';
