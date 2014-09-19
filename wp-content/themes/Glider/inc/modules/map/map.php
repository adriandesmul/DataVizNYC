<?php

class crum_map_widget extends WP_Widget {


    function __construct() {
        parent::__construct(
            'crum_map_widget',
            __( 'Box: Google Map', 'crum' ), // Name
            array( 'description' => __( 'Display address on map','crum')
            )
        );
    }


    function crum_map_widget() {

        /* Widget settings. */

        $widget_ops = array( 'classname' => 'shortcode-widget',  );

        /* Widget control settings. */

        $control_ops = array( 'id_base' => '' );

        /* Create the widget. */

        $this->WP_Widget( 'crum_shortcode_widget', '', $widget_ops, $control_ops );

    }

    function widget( $args, $instance ) {

        //get theme options

        if ( isset( $instance[ 'title' ] ) ) {

            $title = $instance[ 'title' ];

        } else {

            $title = __( 'On map', 'crum' );

        }

        extract( $args );

        $text = stripcslashes($instance['text']);

        $height = $instance['height'];


        /* show the widget content without any headers or wrappers */

        echo $before_widget;

        if ($title) {

            echo $before_title;
            echo $title;
            echo $after_title;

        } ?>


 <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>


        <div id="map-<?php echo $args['widget_id']; ?>" style="height: <?php echo $height; ?>px;"></div>

        <script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery("#map-<?php echo $args['widget_id']; ?>").gmap3({

                    marker: {
                        address: "<?php echo $text; ?>"
                    },
                    map: {
                        options: {
                            zoom: 14,
                            navigationControl: true,
                            scrollwheel: false,
                            streetViewControl: true
                        }
                    }
                });
            });
        </script>

     <?php
        echo $after_widget;

    }

    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );

        $instance['text'] = $new_instance['text'];

        $instance['height'] = $new_instance['height'];

        return $instance;

    }

    function form( $instance ) {

        $title = apply_filters( 'widget_title', $instance['title'] );

        /* Set up some default widget settings. */

        $defaults = array( 'text' => '', 'height' => '350' );

        $instance = wp_parse_args( (array) $instance, $defaults ); ?>


    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'crum'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Address', 'crum'); ?></label><br/>
        <input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo stripcslashes($instance['text']); ?>"/>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height (in px)', 'crum'); ?></label><br/>
        <input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $instance['height']; ?>"/>
    </p>

    <?php

    }

}

add_action( 'widgets_init', create_function( '', 'register_widget("crum_map_widget");' ) );

