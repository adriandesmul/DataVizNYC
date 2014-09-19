<?php
/*
Template Name: Galleries 4 columns
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

    <?php

    $number_per_page = (get_post_meta($post->ID, 'portfolio_number_to_display', true)) ? get_post_meta($post->ID, 'portfolio_number_to_display', true) : '16';

    if (is_front_page()) {
        $paged = (get_query_var('page')) ? get_query_var('page') : 1;
    } else {
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    }

    ?>

    <div class="row">

        <div id="portfolio-page">

            <div class="works-list">

                <?php

                $args = array(
                    'post_type' => 'galleries',
                    'posts_per_page' => $number_per_page,
                    'paged' => $paged
                );
                $the_query = new WP_Query($args);

                while ($the_query->have_posts()) : $the_query->the_post();

                    if (has_post_thumbnail()) {
                        $thumb = get_post_thumbnail_id();
                        $img_url = wp_get_attachment_url($thumb, 'full'); //get img URL
                    } else {
                        $img_url = get_template_directory_uri() . '/img/no-image-large.jpg';
                    }

                    $article_image = aq_resize($img_url, 280, 280, true); ?>

                    <div class="three columns project">
                        <div class="entry-thumb">
                            <img src="<?php echo $article_image ?>" alt="<?php the_title(); ?>"/>
                        <span class="hover-box">
                            <a href="<?php the_permalink(); ?>" class="more-link"> </a>
                            <a href="<?php echo $img_url; ?>" class="zoom-link"> </a>
                        </span>
                        </div>
                    </div>

                <?php endwhile; // END the Wordpress Loop ?>

            </div>

            <nav class="page-nav">

                <?php next_posts_link('', $the_query->max_num_pages); ?>
                <?php previous_posts_link('', $the_query->max_num_pages); ?>

            </nav>

            <?php wp_reset_postdata(); // Reset the Query Loop ?>

        </div>
    </div>
</section>