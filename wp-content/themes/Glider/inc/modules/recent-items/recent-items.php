<?php

class crum_recent_works extends WP_Widget
{


    function __construct()
    {
        parent::__construct(
            'crum_recent_works',
            __('Box: Recent from portfolio', 'crum'), // Name
            array('description' => __('Must be placed in 1 column row ', 'crum'),
            )
        );
    }

    function widget($args, $instance)
    {

        //get theme options

        if (isset($instance['title'])) {

            $title = $instance['title'];

        } else {

            $title = __('Recent items', 'crum');

        }

        $link = $instance['link'];

        extract($args);


        global $options;

        ?>

        <div class="recent-block">


            <?php

            if ($title) {

                echo $before_title;
                echo $title;
                if ($link) {
                    echo '<span class="extra-links"><a href="' . $link . '"></a></span>';
                }
                echo $after_title;

            }
            ?>

            <div class="row">
                <div class="twelve columns">
                    <dl class="tabs contained horisontal">

                        <dd class="active"><a href="#recent-all"><?php echo __('All', 'crum') ?></a></dd>

                        <?php

                        $taxonomy = 'my-product_category';
                        $categories = get_terms($taxonomy);

                        foreach ($categories as $category) {

                            echo '<dd><a href="#' . str_replace('-', '', $category->slug) . '">' . $category->name . '</a></dd>';
                        }

                        ?>

                    </dl>


                    <ul class="tabs-content contained folio-wrap clearfix cl">

                        <li id="recent-allTab" class="active">

                            <?php
                            $args = array(
                                'post_type' => 'my-product',
                                'posts_per_page' => '4'
                            );
                            $the_query = new WP_Query($args);
                            while ($the_query->have_posts()) : $the_query->the_post();

                                if (has_post_thumbnail()) {
                                    $thumb = get_post_thumbnail_id();
                                    $img_url = wp_get_attachment_url($thumb, 'full'); //get img URL
                                } else {
                                    $img_url = get_template_directory_uri() . '/img/no-image-large.jpg';
                                }

                                $article_image = aq_resize($img_url, 371, 253, true);

                                ?>

                                <div class="folio-item">
                                    <div class="entry-thumb">
                                        <img src="<?php echo $article_image ?>" alt="<?php the_title(); ?>"/>
                                    <span class="hover-box">
                                        <a href="<?php the_permalink(); ?>" class="more-link"> </a>
                                        <a href="<?php echo $img_url; ?>" class="zoom-link"> </a>
                                    </span>
                                    </div>

                                    <h4 class="box-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h4>

                                    <span class="dopinfo"><?php get_template_part('templates/folio', 'terms'); ?></span>
                                </div>



                            <?php endwhile; // END the Wordpress Loop ?>

                        </li>

                        <?php

                        $first = true;
                        // List the Portfolio Categories
                        foreach ($categories as $category) {


                            echo '<li id="' . str_replace('-', '', $category->slug) . 'Tab" >';

                            $args = array(
                                'tax_query' => array(

                                    array(
                                        'taxonomy' => 'my-product_category',
                                        'field' => 'slug',
                                        'terms' => $category->slug
                                    )
                                ),
                                'post_type' => 'my-product',
                                'posts_per_page' => '4'
                            );
                            $the_query = new WP_Query($args);
                            while ($the_query->have_posts()) : $the_query->the_post();

                                if (has_post_thumbnail()) {
                                    $thumb = get_post_thumbnail_id();
                                    $img_url = wp_get_attachment_url($thumb, 'full'); //get img URL
                                } else {
                                    $img_url = get_template_directory_uri() . '/img/no-image-large.jpg';
                                }

                                $article_image = aq_resize($img_url, 371, 253, true);

                                ?>

                                <div class="folio-item">
                                    <div class="entry-thumb">
                                        <img src="<?php echo $article_image ?>" alt="<?php the_title(); ?>"/>
                                    <span class="hover-box">
                                        <a href="<?php the_permalink(); ?>" class="more-link"> </a>
                                        <a href="<?php echo $img_url; ?>" class="zoom-link"> </a>
                                    </span>
                                    </div>

                                    <h4 class="box-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h4>

                                    <span class="dopinfo"><?php get_template_part('templates/folio', 'terms'); ?></span>
                                </div>

                            <?php endwhile;

                            echo '</li>';

                            wp_reset_query();
                        } ?>

                    </ul>
                </div>
            </div>
        </div>
    <?php
    }

    function update($new_instance, $old_instance)
    {

        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);

        $instance['link'] = $new_instance['link'];

        $instance['text'] = $new_instance['text'];


        return $instance;

    }

    function form($instance)
    {

        $title = apply_filters('widget_title', $instance['title']);

        /* Set up some default widget settings. */

        $instance = wp_parse_args((array)$instance, $defaults); ?>


        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'crum'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link', 'crum'); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo esc_attr($instance['link']) ?>"/>
        </p>



    <?php

    }

}

add_action('widgets_init', create_function('', 'register_widget("crum_recent_works");'));