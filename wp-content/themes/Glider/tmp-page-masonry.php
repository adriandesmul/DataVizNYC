<?php
/*
Template Name: Posts grid 3 columns
*/
?>

<?php get_template_part('templates/top', 'page'); ?>

<section id="layout">

    <div class="row">
        <div class="twelve rows">
            <?php while (have_posts()) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; ?>
        </div>
    </div>

    <div class="row">
        <div class="twelve columns">
            <?php

            if (is_front_page()) {
                $paged = (get_query_var('page')) ? get_query_var('page') : 1;
            } else {
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            }

            $number_per_page = get_post_meta($post->ID, 'blog_number_to_display', true);
            $number_per_page = ($number_per_page) ? $number_per_page : '12';

			$selected_custom_categories = wp_get_object_terms($post->ID, 'category');
			if(!empty($selected_custom_categories)){
				if(!is_wp_error( $selected_custom_categories )){
					foreach($selected_custom_categories as $term){
						$blog_cut_array[] = $term->term_id;
					}
				}
			}

			$blog_custom_categories = ( get_post_meta(get_the_ID(), 'blog_sort_category',true)) ?  $blog_cut_array : '';

			if ($blog_custom_categories){

				$args = array('post_type' => 'post',
							  'posts_per_page' => $number_per_page,
							  'paged' => $paged,
							  'category__in' => $blog_custom_categories
				);

				$query = new WP_Query( $args );

			}else{
				$query = new WP_Query( 'post_type=post&posts_per_page=' . $number_per_page . '&paged=' . $paged );

			}

                if (!$query->have_posts()) : ?>

                <div class="alert">
                    <?php _e('Sorry, no results were found.', 'crum'); ?>
                </div>
                <?php get_search_form(); ?>
            <?php endif; ?>

            <div id="grid-posts">

                <?php while ($query->have_posts()) : $query->the_post();

                    get_template_part('templates/content', 'grid');

                endwhile; ?>

            </div>



            <?php wp_reset_postdata(); ?>

        </div>
    </div>
	<div class="row">
		<?php crum_select_pagination();?>
	</div>
</section>

<?php
wp_enqueue_script('cr-masonry');
?>


<script type="text/javascript">
    jQuery(window).load(function () {


        var columns = 3,
            setColumns = function () {
                columns = jQuery(window).width() > 640 ? 3 : jQuery(window).width() > 320 ? 2 : 1;
            };

        setColumns();
        jQuery(window).resize(setColumns);

        jQuery('#grid-posts').masonry(
            {
                itemSelector: 'article.small-news',
                isAnimated: true,
                columnWidth: function (containerWidth) {
                    return containerWidth / columns;
                }
            });
    });
</script>