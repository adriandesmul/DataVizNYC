<?php

/*
Plugin Name: Features blocks
Plugin URI: #
Description: Display Features with icons
Author: Crumina
Version: 1
Author URI: #
*/



class crum_widget_features extends WP_Widget {

    /** constructor */
    function __construct() {
        parent::WP_Widget(
        /* Base ID */ 'crum_widget_features',
            /* Name */'Box: Features', array( 'description' => __( 'Boxes from "Features" section','crum') )
        );
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
        $display_link = $instance['display_link'];
        $post_order_by = $instance['post_order_by'];
        $numb_col = $instance['numb_col'];


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


        global $post;

        $post_order = (isset($post_order)) ? $post_order : '';

        $the_query = new WP_Query( 'posts_per_page= -1&post_type=features&orderby='.$post_order_by.'&order='.$post_order.'' );

        echo '<div class="row  service-box">';

        if ($numb_col == '3') {
            $i = 1;
        }
        while ( $the_query->have_posts() ) :
            $the_query->the_post() ?>

        <div class="<?php echo $class; ?> columns feature-item-box">



                <div class="service-icon">

                <?php if (get_post_meta(get_the_ID(), 'crum_features_feat_icon', true)) {

                    $article_image = '<span class="'.get_post_meta(get_the_ID(), 'crum_features_feat_icon', true).'"></span>';

                    }

                    if  ($display_link == 'yes') { ?>

                    <a href="<?php the_permalink(); ?>">

                        <?php echo $article_image; ?>

                    </a>
                    <?php } else {

                        echo $article_image; ?>

                    <?php } ?>
                </div>


            <div class="service-content">
                <?php if ($display_link == 'yes') { ?>

                <a href="<?php the_permalink(); ?>" >

                    <h3><?php the_title(); ?></h3>

                </a>
                <?php } else { ?>

                <h3><?php the_title(); ?></h3>

                <?php } ?>

                <?php the_content(); ?>

            </div>

        </div>

    <?php

            if ($numb_col == '3') {
                // if multiple of 3 close div and open a new div
                if(($i % 3 == 0) && ($i != 6)) {echo '</div><div class="row  service-box">';}

                $i++;
            }
             endwhile;

        if ($numb_col == '3') {
            echo '</div>';
        }

        /* Restore original Post Data
        */
        wp_reset_postdata();

        echo $after_widget;

    }

    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );

        $instance['post_order'] = $new_instance['post_order'];

        $instance['numb_col'] = $new_instance['numb_col'];

        $instance['display_link'] = $new_instance['display_link'];

        return $instance;

    }

    function form( $instance ) {

        $title = apply_filters( 'widget_title', $instance['title'] );

        $display_link = $instance['display_link'];

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
        <label for="<?php echo $this->get_field_id( 'display_link' ); ?>"><?php _e( 'Link for details page', 'crum' ); ?></label>
        <select class="widefat" id="<?php echo $this->get_field_id( 'display_link' ); ?>" name="<?php echo $this->get_field_name( 'display_link' );?>"  >

            <option class="widefat" <?php if( esc_attr( $display_link ) == 'yes' ) echo 'selected'; ?> value="yes"><?php _e('Yes','crum'); ?></option>
            <option class="widefat" <?php if( esc_attr( $display_link ) == 'no' ) echo 'selected'; ?> value="no"><?php _e('No','crum'); ?></option>

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

add_action( 'widgets_init', create_function( '', 'register_widget("crum_widget_features");' ) );