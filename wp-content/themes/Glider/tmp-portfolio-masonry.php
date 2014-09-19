<?php
/*
Template Name: Portfolio grid
*/
$options = get_option('maestro');

get_template_part('templates/top', 'page'); ?>

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

            $number_per_page = (get_post_meta($post->ID, 'portfolio_number_to_display', true)) ? get_post_meta($post->ID, 'portfolio_number_to_display', true) : '12';

            $selected_custom_categories = wp_get_object_terms($post->ID, 'my-product_category');
            if(!empty($selected_custom_categories)){
                if(!is_wp_error( $selected_custom_categories )){
                    foreach($selected_custom_categories as $term){
                        $blog_cut_array[] = $term->term_id;
                    }
                }
            }

            $folio_custom_categories = ( get_post_meta(get_the_ID(), 'folio_sort_category',true)) ?  $blog_cut_array : '';


            ?>


            <div id="grid-folio" class="col-3 row">

                <?php if ($folio_custom_categories) {
                    $args = array(
                        'post_type' => 'my-product',
                        'posts_per_page' => $number_per_page,
                        'paged' => $paged,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'my-product_category',
                                'field' => 'id',
                                'terms' => $folio_custom_categories
                            )
                        )
                    );
                } else {
                    $args = array(
                        'post_type' => 'my-product',
                        'posts_per_page' => $number_per_page,
                        'paged' => $paged
                    );
                }

                $temp = $wp_query;
                $wp_query = null;
                $wp_query = new WP_Query($args);

                while ($wp_query->have_posts()) : $wp_query->the_post();

                    if (has_post_thumbnail()) {
                        $thumb = get_post_thumbnail_id();
                        $img_url = wp_get_attachment_url($thumb, 'full'); //get img URL
                    } else {
                        $img_url = get_template_directory_uri() . '/img/no-image-large.jpg';
                    }
                    $article_image = aq_resize($img_url, 400, 999, false); //resize & crop img

                    ?>

                    <div class="four columns project">
                        <div class="entry-thumb">
                            <img src="<?php echo $article_image ?>" alt="<?php the_title(); ?>"/>

                        <span class="hover-box">
                            <a href="<?php the_permalink(); ?>" class="more-link"> </a>
                            <a href="<?php echo $img_url; ?>" class="zoom-link"> </a>
                        </span>
                        </div>

                        <h4 class="box-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

                        <span class="dopinfo"><?php get_template_part('templates/folio', 'terms'); ?></span>
                    </div>

                <?php endwhile; ?>

                <?php if ($wp_query->max_num_pages > 1) : ?>

                    <nav class="page-nav">

                        <?php next_posts_link() ?>
                        <?php previous_posts_link() ?>

                    </nav>

                <?php endif; ?>

                <?php
                $wp_query = null;
                $wp_query = $temp;
                wp_reset_query();
                ?>
            </div>

        </div>
    </div>
</section>


<?php wp_enqueue_script('cr-masonry');?>


<script type="text/javascript">
    jQuery(window).load(function () {


        var columns = 3,
            setColumns = function () {
                columns = jQuery(window).width() > 640 ? 3 : jQuery(window).width() > 320 ? 2 : 1;
            };

        setColumns();
        jQuery(window).resize(setColumns);

        jQuery('#grid-folio').masonry(
            {
                itemSelector: '.project',
                isAnimated: true,
                columnWidth: function (containerWidth) {
                    return containerWidth / columns;
                }
            });
    });
</script>