<?php

class crum_one_gallery_widget extends WP_Widget {

    function crum_one_gallery_widget() {

        /* Widget settings. */

        $widget_ops = array( 'classname' => 'recent-projects-block', 'description' => __( 'Display Gallery thumbnails','crum') );

        /* Widget control settings. */

        $control_ops = array( 'id_base' => 'crum_galleries_widget' );

        /* Create the widget. */

        $this->WP_Widget( 'crum_galleries_widget', 'Box: One gallery', $widget_ops, $control_ops );

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
        $numb_col = $instance['numb_col'];
        $item = $instance['item'];


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


        echo '<div class="row"><ul>';

        $args = array(
            'order' => $post_order,
            'post_type' => 'attachment',
            'post_parent' => $item,
            'post_mime_type' => 'image',
            'post_status' => null,
            'numberposts' => $numb_col,
        );
        $attachments = get_posts($args);

        if ($attachments) {
            foreach ($attachments as $attachment) {
                $img_url =  wp_get_attachment_url($attachment->ID); //get img URL
                $article_image = aq_resize($img_url, 280, 195, true);



                ?>


                <li class="<?php echo $class ?> columns" style="position: relative"> <div class="hover">

                    <div class="entry-thumb">
                    <img src="<?php echo $article_image ?>" alt="<?php the_title(); ?>"/>
                    <span class="hover-box">
                        <a href="<?php echo get_permalink( $item ); ?>" class="more-link"> </a>
                        <a href="<?php echo $img_url; ?>" class="zoom-link"> </a>
                    </span>
                    </div>
                </div>

                </li>


            <?php  }
        }
        echo '</ul></div>';

        echo $after_widget;

    }

    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );

        $instance['link'] = $new_instance['link'];

        $instance['post_order'] = $new_instance['post_order'];

        $instance['numb_col'] = $new_instance['numb_col'];


        return $instance;

    }

    function form( $instance ) {

        $title = apply_filters( 'widget_title', $instance['title'] );

        /* Set up some default widget settings. */

        $link = $instance['link'];


        $post_order = $instance['post_order'];

        $numb_col = $instance['numb_col'];

        $txtId = isset($instance['txtId']) ? $instance['txtId'] : 0;

        $opts = '';
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
        <label for="<?php echo $this->get_field_id( 'post_order' ); ?>"><?php _e( 'Order posts', 'crum' ); ?></label>
        <select class="widefat" id="<?php echo $this->get_field_id( 'post_order' ); ?>" name="<?php echo $this->get_field_name( 'post_order' );?>"  >

            <option class="widefat" <?php if( esc_attr( $post_order ) == 'DESC' ) echo 'selected'; ?> value="DESC"><?php _e('Descending','crum'); ?></option>
            <option class="widefat" <?php if( esc_attr( $post_order ) == 'ASC' ) echo 'selected'; ?> value="ASC"><?php _e('Ascending','crum'); ?></option>

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

    <p>
        <label for="<?php echo $this->get_field_id( 'item' ); ?>"><?php _e( 'Select gallery', 'crum' ); ?></label>
        <select class="widefat" id="<?php echo $this->get_field_id( 'item' ); ?>" name="<?php echo $this->get_field_name( 'item' );?>"  >

            <?php
            wp_reset_query();
            $my_query = null;
            $my_query = new WP_Query(array(
            'post_type' => 'galleries',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'caller_get_posts'=> 1
            ));
            if( $my_query->have_posts() ) {
            while ($my_query->have_posts()) : $my_query->the_post();
            $sel = ($txtId == get_the_ID()) ? ' selected="selected" ' : '';
            $opts = $opts . '<option ' . $sel . ' value="' . get_the_ID() . '">' . get_the_title() . '</option>';
            endwhile;
            }
            wp_reset_query();

            echo '<option value="0">- select -</option>' . $opts . '
            ';

            ?>


        </select>

    </p>






    <?php

    }

}

add_action( 'widgets_init', create_function( '', 'register_widget("crum_one_gallery_widget");' ) );