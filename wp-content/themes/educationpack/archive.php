<?php get_header(); ?>

<?php if( function_exists('nicdark_archive_content')){ do_action( "nicdark_archive_nd" ); }else{ ?>

<!--start section-->
<div class="nicdark_section nicdark_bg_grey nicdark_border_bottom_1_solid_grey">

    <!--start nicdark_container-->
    <div class="nicdark_container nicdark_clearfix">

    	<div class="nicdark_grid_12">

    		<div class="nicdark_section nicdark_height_80"></div>

    		<?php if (is_category()): ?>
				<h1 class="nicdark_font_size_60 nicdark_font_size_40_all_iphone nicdark_line_height_40_all_iphone"><strong><?php esc_html_e('Category','educationpack'); ?></strong></h1>
				<div class="nicdark_section nicdark_height_10"></div>
				<h3 class="nicdark_color_grey"><?php single_cat_title(); ?></h3>
			<?php elseif (is_tag()): ?>
				<h1 class="nicdark_font_size_60 nicdark_font_size_40_all_iphone nicdark_line_height_40_all_iphone"><strong><?php esc_html_e('Tag','educationpack'); ?></strong></h1>
				<div class="nicdark_section nicdark_height_10"></div>
				<h3 class="nicdark_color_grey"><?php single_tag_title() ?></h3>
			<?php elseif (is_month()): ?>
				<h1 class="nicdark_font_size_60 nicdark_font_size_40_all_iphone nicdark_line_height_40_all_iphone"><strong><?php esc_html_e('Archive for','educationpack'); ?></strong></h1>
				<div class="nicdark_section nicdark_height_10"></div>
				<h3 class="nicdark_color_grey"><?php single_month_title(' '); ?></h3>
			<?php elseif (is_author()): ?>
				<h1 class="nicdark_font_size_60 nicdark_font_size_40_all_iphone nicdark_line_height_40_all_iphone"><strong><?php esc_html_e('Author','educationpack'); ?></strong></h1>
				<div class="nicdark_section nicdark_height_10"></div>
				<h3 class="nicdark_color_grey"><?php the_author(); ?></h3>
			<?php elseif (is_search()): ?>
				<h1 class="nicdark_font_size_60 nicdark_font_size_40_all_iphone nicdark_line_height_40_all_iphone"><strong><?php esc_html_e('Search for','educationpack'); ?></strong></h1>
				<div class="nicdark_section nicdark_height_10"></div>
				<h3 class="nicdark_color_grey">" <?php the_search_query(); ?> "</h3>
			<?php else: ?>
				<h1 class="nicdark_font_size_60 nicdark_font_size_40_all_iphone nicdark_line_height_40_all_iphone"><strong><?php esc_html_e('Archive','educationpack'); ?></strong></h1>
			<?php endif ?>

    		<div class="nicdark_section nicdark_height_80"></div>

    	</div>

    </div>
    <!--end container-->

</div>
<!--end section-->


<div class="nicdark_section nicdark_height_50"></div>


<!--start section-->
<div class="nicdark_section">

    <!--start nicdark_container-->
    <div class="nicdark_container nicdark_clearfix">

    	
    	<!--start all posts previews-->
    	<?php if ( is_active_sidebar( 'nicdark_sidebar' ) ) { ?>  
    		<div class="nicdark_grid_8"> 
    	<?php }else{ ?>

    		<div class="nicdark_grid_12">
    	<?php } ?>
	

    		<?php if(have_posts()) : ?>
				
				<?php while(have_posts()) : the_post(); ?>
					
					

					<!--post-->
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<!--START PREVIEW-->
						<?php if (has_post_thumbnail()): ?>
							<div class="nicdark_section nicdark_image_archive">
								<?php the_post_thumbnail(); ?>
							</div>
						<?php endif ?>

						<div class="nicdark_section ">
							<div id="nicdark_bg_date_archive" class="nicdark_width_15_percentage nicdark_width_100_percentage_all_iphone nicdark_float_left nicdark_bg_orange nicdark_text_align_center">
								<div class="nicdark_section nicdark_height_30"></div>
								<h1 class="nicdark_font_size_40 nicdark_color_white"><?php the_time('j') ?></h1>
								<h4 class="nicdark_color_white"><?php the_time('M') ?></h4>
								<div class="nicdark_section nicdark_height_30"></div>
							</div>
							<div class="nicdark_width_85_percentage nicdark_width_100_percentage_all_iphone nicdark_float_left nicdark_padding_20 nicdark_box_sizing_border_box">
								<h2>
									<a class="nicdark_color_greydark nicdark_first_font" href="<?php the_permalink(); ?>">
										<?php the_title(); ?>
										<?php if ( has_post_format( 'video' )) { esc_html_e(' - Video','educationpack'); } ?>
									</a>
								</h2>

								<div class="nicdark_section nicdark_margin_top_20 nicdark_margin_bottom_20 nicdark_padding_8 nicdark_bg_grey nicdark_border_1_solid_grey nicdark_border_radius_3 nicdark_box_sizing_border_box">
									<p class="nicdark_font_size_13"><strong><?php esc_html_e('Author','educationpack'); ?> : </strong><?php the_author_posts_link(); ?><strong class="nicdark_margin_left_10"><?php esc_html_e('Comments','educationpack'); ?> : </strong> <?php comments_number(esc_html__('No Comments','educationpack'),esc_html__('One Comment','educationpack'),esc_html__( '% Comments','educationpack') );?></p>	
								</div>

								<?php the_excerpt(); ?>
							</div>
						</div>
						<!--END PREVIEW-->

					</div>
					<!--post-->

					<div class="nicdark_section nicdark_height_50"></div>


						
				<?php endwhile; ?>
			<?php endif; ?>



			<!--START pagination-->
			<div class="nicdark_section">

				<?php

		    	the_posts_pagination( array(
					'prev_text'          => esc_html__( 'Prev', 'educationpack' ),
					'next_text'          => esc_html__( 'Next', 'educationpack' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'educationpack' ) . ' </span>',
				) );

				?>

				<div class="nicdark_section nicdark_height_50"></div>
			</div>
			<!--END pagination-->


    	</div>
    	<!--end all posts previews-->

 
    	
    	<!--sidebar-->
    	<?php if ( is_active_sidebar( 'nicdark_sidebar' ) ) { ?>  
    		
	    	<div class="nicdark_grid_4">
	    		<?php if ( ! get_sidebar( 'nicdark_sidebar' ) ) : ?><?php endif ?>
	    		<div class="nicdark_section nicdark_height_50"></div>
	    	</div>
	    	
    	<?php } ?>
    	<!--end sidebar-->

    	
	</div>
	<!--end container-->

</div>
<!--end section-->

<?php } ?>

<?php get_footer(); ?>