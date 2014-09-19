<?php

/*
Plugin Name: Posts row
Plugin URI: #
Description: Display posts row from some category
Author: Crumina
Version: 1
Author URI: #
*/



class crum_news_row extends WP_Widget {

    function crum_news_row() {

        /* Widget settings. */

        $widget_ops = array( 'classname' => 'latest-news-block', 'description' => __( 'Display postsrow from some category','crum') );

        /* Widget control settings. */

        $control_ops = array( 'id_base' => 'crum_news_row' );

        /* Create the widget. */

        $this->WP_Widget( 'crum_news_row', 'Box: Posts row', $widget_ops, $control_ops );

    }

    function widget( $args, $instance ) {

        //get theme options

        if ( isset( $instance[ 'title' ] ) ) {

            $title = $instance[ 'title' ];

        } else {

            $title = __( 'Latest articles', 'crum' );

        }

        extract( $args );

        $link = $instance['link'];
        $post_order = $instance['post_order'];
        $post_order_by = $instance['post_order_by'];
        $numb_col = $instance['numb_col'];
        $cat_selected = $instance['cat_sel'];


        /* show the widget content without any headers or wrappers */

        echo $before_widget;

        if ($title) {

            echo $before_title;
            echo $title;
            if ($link) { echo '<span class="extra-links"><a href="'.$link.'"></a></span>';}
            echo $after_title;


        }

        /*
         * Number of columns
         */

        if ($numb_col == '1'){
            $class="twelve";
        }if ($numb_col == '2'){
            $class="six";
        }if ($numb_col == '3'){
            $class="four";
        }if ($numb_col == '4'){
            $class="three";
        }


        $the_query = null;
        $args = array(
            'category__in' => $cat_selected,
            'posts_per_page' => $numb_col,
            'order'      => $post_order,
            'orderby'      => $post_order_by,
            'ignore_sticky_posts' => 1

        );

        $the_query = new WP_Query( $args );

        echo '<div class="row">';

            while ( $the_query->have_posts() ) :
            $the_query->the_post();

                $format = get_post_format();
                if ( false === $format ) {
                    $format = 'standard';
                }
                ?>

        <div class="<?php echo $class . ' format-' . $format ?> columns">


            <article class="hnews hentry small-news <?php echo $format ?>">

                <?php
                if( has_post_thumbnail() ){
                    $thumb = get_post_thumbnail_id();
                    $img_url = wp_get_attachment_url($thumb, 'medium'); //get img URL
                    $article_image = aq_resize($img_url, 380, 220, true);
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

        </div>

        <?php
        endwhile;

        echo '</div>';

        /* Restore original Post Data
        */
        wp_reset_postdata();

        echo $after_widget;

    }

    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );

        $instance['link'] = $new_instance['link'];

        $instance['post_order'] = $new_instance['post_order'];

        $instance['numb_col'] = $new_instance['numb_col'];

        $instance['cat_sel'] = $new_instance['cat_sel'];

        return $instance;

    }

    function form( $instance ) {

        $title = apply_filters( 'widget_title', $instance['title'] );

        $cat_selected = $instance['cat_sel'];


        /* Set up some default widget settings. */

        $link = $instance['link'];

        $post_order = $instance['post_order'];

        $post_order_by = $instance['post_order_by'];

        $numb_col = $instance['numb_col'];


        ?>


    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'crum'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
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
        <label for="<?php echo $this->get_field_id( 'numb_col' ); ?>"><?php _e( 'Number of columns', 'crum' ); ?></label>
        <select class="widefat" id="<?php echo $this->get_field_id( 'numb_col' ); ?>" name="<?php echo $this->get_field_name( 'numb_col' );?>"  >

            <option class="widefat"  value="1" <?php if( esc_attr( $numb_col ) == '1' ) echo 'selected'; ?>><?php _e('1 column','crum'); ?></option>
            <option class="widefat"  value="2" <?php if( esc_attr( $numb_col ) == '2' ) echo 'selected'; ?>><?php _e('2 columns','crum'); ?></option>
            <option class="widefat"  value="3" <?php if( esc_attr( $numb_col ) == '3' ) echo 'selected'; ?>><?php _e('3 columns','crum'); ?></option>
            <option class="widefat"  value="4" <?php if( esc_attr( $numb_col ) == '4' ) echo 'selected'; ?>><?php _e('4 columns','crum'); ?></option>

        </select>

    </p>






    <?php

    }

}

add_action( 'widgets_init', create_function( '', 'register_widget("crum_news_row");' ) );