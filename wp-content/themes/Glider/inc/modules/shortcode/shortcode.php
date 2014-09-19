<?php

/*
Plugin Name: Shortcode
Plugin URI: #
Description: Any shortcode can be added here
Author: Crumina
Version: 1
Author URI: #
*/



class crum_shortcode_widget extends WP_Widget {

    function crum_shortcode_widget() {

        /* Widget settings. */

        $widget_ops = array( 'classname' => 'shortcode-widget', 'description' => __( 'Any shortcode can be added here','crum') );

        /* Widget control settings. */

        $control_ops = array( 'id_base' => 'crum_shortcode_widget' );

        /* Create the widget. */

        $this->WP_Widget( 'crum_shortcode_widget', 'Theme: do Shortcode', $widget_ops, $control_ops );

    }

    function widget( $args, $instance ) {

        //get theme options

        if ( isset( $instance[ 'title' ] ) ) {

            $title = $instance[ 'title' ];

        } else {

            $title = __( 'Some shortcode', 'crum' );

        }

        extract( $args );

        $text = stripcslashes($instance['text']);



        /* show the widget content without any headers or wrappers */

        echo $before_widget;

        if ($title) {

            echo $before_title;
            echo $title;
            echo $after_title;

        }

        echo do_shortcode(''.$text.'');

        echo $after_widget;

    }

    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );

        $instance['text'] = $new_instance['text'];


        return $instance;

    }

    function form( $instance ) {

        $title = apply_filters( 'widget_title', $instance['title'] );

        /* Set up some default widget settings. */

        $defaults = array( 'text' => '' );

        $instance = wp_parse_args( (array) $instance, $defaults ); ?>


    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'crum'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
    </p>

    <p>
        <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Shortcode', 'crum'); ?></label><br/>
        <textarea class="widefat" rows="10" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo stripcslashes($instance['text']); ?></textarea>
    </p>


    <?php

    }

}

add_action( 'widgets_init', create_function( '', 'register_widget("crum_shortcode_widget");' ) );