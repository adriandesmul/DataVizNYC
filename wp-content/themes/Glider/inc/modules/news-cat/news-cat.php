<?php
class crum_news_cat extends WP_Widget {

    function crum_news_cat() {

        /* Widget settings. */

        $widget_ops = array( 'classname' => 'block-news-feature', 'description' => __( 'Display news/articles from some category','crum') );

        /* Widget control settings. */

        $control_ops = array( 'id_base' => 'crum_news_cat' );

        /* Create the widget. */

        $this->WP_Widget( 'crum_news_cat', 'Box: News / Articles', $widget_ops, $control_ops );

    }

    function widget( $args, $instance ) {

        //get theme options

        if ( isset( $instance[ 'title' ] ) ) {

            $title = $instance[ 'title' ];

        } else {

            $title = __( 'Latest articles', 'crum' );

        }


        extract( $args );

        $number = $instance['number'];
        $link = $instance['link'];
        $post_order = $instance['post_order'];
        $post_order_by = $instance['post_order_by'];
        $h_slide = $instance['h_slide'];
        $cat_selected = $instance['cat_sel'];


        /* show the widget content without any headers or wrappers */

        echo $before_widget;

        if ($title) {

            echo $before_title;
            echo $title;
            if ($link) { echo '<span class="extra-links"><a href="'.$link.'"></a></span>';}
            echo $after_title;


        }
        ?>
    <?php if ($h_slide == 'yes') { ?>

        <script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery('.widget_crum_news_cat').flexslider({
                    animation: "slide",
                    controlsContainer: ".list-blocks",
                    selector: ".post-slider > article",
                    controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
                    prevText: "",           //String: Set the text for the "previous" directionNav item
                    nextText: "",
                    slideshow: false
                });
            });
        </script>

        <div class="list-blocks">
        </div>


        <div class="post-slider">

    <?php }


        global $post;

        $the_query = null;
        $args = array(
            'category__in' => $cat_selected,
            'posts_per_page' => $number,
            'order'      => $post_order,
            'orderby'      => $post_order_by,
            'ignore_sticky_posts' => 1

        );

        $the_query = new WP_Query( $args );

        while ( $the_query->have_posts() ) :
            $the_query->the_post();

            $format = get_post_format();
            if ( false === $format ) {
                $format = 'standard';
            }
            ?>


        <article class="hnews hentry small-news <?php echo 'format-' . $format ?>">

            <?php
            if( has_post_thumbnail() ){
                $thumb = get_post_thumbnail_id();
                $img_url = wp_get_attachment_url($thumb, 'medium'); //get img URL
                $article_image = aq_resize($img_url, 380, 140, true);
                ?>


                <div class="entry-thumb">
                    <img src="<?php echo $article_image ?>" alt="<?php the_title(); ?>"/>
                    <span class="hover-box">
                        <a href="<?php the_permalink(); ?>" class="text-button"> <?php _e('Read more','crum'); ?> </a>
                    </span>
                </div>

                <?php } ?>
            <span class="icon-format"></span>
            <div class="ovh">
                <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                <?php get_template_part('templates/entry-meta-mini'); ?>
            </div>
        </article>

        <?php
        endwhile;

        /* Restore original Post Data
        */
        wp_reset_postdata();

        if ($h_slide == 'yes') { ?>

            </div>

        <?php }

        echo $after_widget;

    }

    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );

        $instance['number'] = $new_instance['number'];

        $instance['link'] = $new_instance['link'];

        $instance['post_order'] = $new_instance['post_order'];

        $instance['h_slide'] = $new_instance['h_slide'];

        $instance['cat_sel'] = $new_instance['cat_sel'];

        return $instance;

    }

    function form( $instance ) {

        $title = apply_filters( 'widget_title', $instance['title'] );

        $cat_selected = $instance['cat_sel'];


        /* Set up some default widget settings. */

        $link = $instance['link'];

        $number = $instance['number'];

        $post_order = $instance['post_order'];

        $h_slide = $instance['h_slide'];

        $post_order_by = $instance['post_order_by'];



        ?>


    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'crum'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts', 'crum' ); ?>:</label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Link to full page', 'crum' ); ?>:</label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>" />
    </p>

    <p>
        <label for="<?php echo $this->get_field_id( 'cat_sel' ); ?>"><?php _e( 'Select category', 'crum' ); ?></label>
        <select class="widefat" id="<?php echo $this->get_field_id( 'cat_sel' ); ?>" name="<?php echo $this->get_field_name( 'cat_sel' );?>"   >

            <?php
            $cats = get_categories();

            foreach ( $cats as $cat ) {

                $cat_sel = (is_array($cat_selected) && array_key_exists($cat->term_id, $cat_selected))?' selected="selected"':'';
                echo '<option class="widefat" value="'.$cat->term_id.'"'.$cat_sel.'>'.$cat->name.'</option>';
            }?>

        </select>

    </p>

    <p>
        <label for="<?php echo $this->get_field_id( 'post_order' ); ?>"><?php _e( 'Order posts', 'crum' ); ?></label>
        <select class="widefat" id="<?php echo $this->get_field_id( 'post_order' ); ?>" name="<?php echo $this->get_field_name( 'post_order' );?>"  >

            <option class="widefat" <?php if( esc_attr( $post_order ) == 'DESC' ) echo 'selected'; ?> value="DESC"><?php _e('Descending','crum'); ?></option>
            <option class="widefat" <?php if( esc_attr( $post_order ) == 'ASC' ) echo 'selected'; ?> value="ASC"><?php _e('Ascending','crum'); ?></option>

        </select>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'post_order_by' ); ?>"><?php _e( 'Order posts by', 'crum' ); ?></label>
        <select class="widefat" id="<?php echo $this->get_field_id( 'post_order_by' ); ?>" name="<?php echo $this->get_field_name( 'post_order_by' );?>"  >

            <option class="widefat"  value="none" <?php if( esc_attr( $post_order_by ) == 'none' ) echo 'selected'; ?>><?php _e('No order','crum'); ?></option>
            <option class="widefat"  value="ID" <?php if( esc_attr( $post_order_by ) == 'ID' ) echo 'selected'; ?>><?php _e('Order by post id','crum'); ?></option>
            <option class="widefat"  value="title" <?php if( esc_attr( $post_order_by ) == 'title' ) echo 'selected'; ?>><?php _e('Order by title','crum'); ?></option>
            <option class="widefat"  value="name" <?php if( esc_attr( $post_order_by ) == 'name' ) echo 'selected'; ?>><?php _e('Order by post name (post slug)','crum'); ?></option>
            <option class="widefat"  value="date" <?php if( esc_attr( $post_order_by ) == 'date' ) echo 'selected'; ?>><?php _e('Order by date','crum'); ?></option>
            <option class="widefat"  value="modified" <?php if( esc_attr( $post_order_by ) == 'modified' ) echo 'selected'; ?>><?php _e('Order by last modified date','crum'); ?></option>
            <option class="widefat"  value="rand" <?php if( esc_attr( $post_order_by ) == 'rand' ) echo 'selected'; ?>><?php _e('Random order','crum'); ?></option>
            <option class="widefat"  value="comment_count" <?php if( esc_attr( $post_order_by ) == 'comment_count' ) echo 'selected'; ?>><?php _e('Order by number of comments','crum'); ?></option>

        </select>

    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'h_slide' ); ?>"><?php _e( 'Horizontal slide', 'crum' ); ?></label>
        <select class="widefat" id="<?php echo $this->get_field_id( 'h_slide' ); ?>" name="<?php echo $this->get_field_name( 'h_slide' );?>"  >

            <option class="widefat" <?php if( esc_attr( $h_slide ) == 'yes' ) echo 'selected'; ?> value="yes"><?php _e('Enable','crum'); ?></option>
            <option class="widefat" <?php if( esc_attr( $h_slide ) == 'no' ) echo 'selected'; ?> value="no"><?php _e('Disable','crum'); ?></option>

        </select>
    </p>






    <?php

    }

}

add_action( 'widgets_init', create_function( '', 'register_widget("crum_news_cat");' ) );