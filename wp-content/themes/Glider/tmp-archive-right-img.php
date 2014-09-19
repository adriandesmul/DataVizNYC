<?php
/*
Template Name: Posts with right img
*/

$options = get_option('maestro');

get_template_part('templates/top', 'page');  ?>

<section id="layout">

    <div class="row">
        <div class="twelve rows">
            <?php while (have_posts()) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; ?>
        </div>
    </div>

    <div class="row">

        <div class="blog-section sidebar-right">
            <section id="main-content" role="main" class="nine columns">

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
					$query = new WP_Query('post_type=post&posts_per_page=' . $number_per_page . '&paged=' . $paged);

				}

                if (!$query->have_posts()) : ?>

                    <div class="alert">
                        <?php _e('Sorry, no results were found.', 'crum'); ?>
                    </div>
                    <?php get_search_form(); ?>
                <?php endif; ?>

                <?php while ($query->have_posts()) : $query->the_post(); ?>

                    <article <?php post_class(); ?>>

                        <div class="row some-aligned-post right-thumbed">

                            <div class="six columns">

                                <div class="clearfif cl">
                                    <header>
                                        <time class="updated" datetime="<?php echo get_the_time('c'); ?>">
                                            <span class="day"><?php echo get_the_date('d'); ?></span>
                                            <span class="month"><?php echo get_the_date('M'); ?></span>
                                        </time>

                                        <span class="icon-format"></span>

                                        <div class="header-wrap ovh">
                                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            <?php get_template_part('templates/entry-meta'); ?>
                                        </div>
                                    </header>
                                    <div class="entry-content">
                                        <?php the_excerpt();  ?>
                                    </div>
                                </div>
                            </div>

                            <div class="post-media six columns">
                                <?php

                                if (has_post_format('video')) {
                                    get_template_part('templates/post', 'video');
                                } elseif (has_post_format('audio')) {
                                    get_template_part('templates/post', 'audio');
                                } elseif (has_post_format('gallery')) {
                                    get_template_part('templates/post', 'gallery');
                                } else {

                                    if (has_post_thumbnail()) {
                                        $thumb = get_post_thumbnail_id();
                                        $img_url = wp_get_attachment_url($thumb, 'full'); //get img URL
                                        $article_image = aq_resize($img_url, 430, 220, true);


                                        ?>

                                        <div class="entry-thumb">
                                            <img src="<?php echo $article_image ?>" style="margin:0 0;"
                                                 alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
                    <span class="hover-box">
                        <a href="<?php the_permalink(); ?>" class="more-link"> </a>
                        <a href="<?php echo $img_url; ?>" class="zoom-link"> </a>
                    </span>
                                        </div>

                                    <?php
                                    }
                                } ?>

                            </div>

                        </div>

                    </article>

                <?php endwhile; ?>

				<?php crum_select_pagination();?>

                <?php wp_reset_postdata(); ?>

            </section>
            <?php get_template_part('templates/sidebar', 'right'); ?>

        </div>
</section>