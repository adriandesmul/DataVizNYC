<?php

class crum_block_fetures_list extends WP_Widget {
    function __construct() {
        parent::__construct(
            'block-fetures-box',
            __( 'Box: Features list', 'crum' ), // Name
            array( 'description' => __( 'every line - list element', 'crum' ),
            )
        );
    }

    /**
     * @param array $args
     * @param array $instance
     */
    function widget( $args, $instance ) {
        extract( $args );
        $title = $instance['title'];
        $html = $instance['html'];
        $link = $instance['link'];
        $icon = $instance['icon'];
        $align = $instance['align'];
        $text_align = $instance['text-align'];

        $html = '<li>'.str_replace(array("\r","\n\n","\n"),array('',"\n","</li>\n<li>"),trim($html,"\n\r")).'</li>';

        echo $before_widget;

        ?>

    <div class="crum_features_list <?php echo $text_align; ?>">

        <?php if ($icon) { ?>

            <div class="icon <?php echo $align; ?>">

                <span class="blue-circle">  <span class="<?php echo $icon; ?>"></span> </span>

            </div>

        <?php } ?>



        <div class="feat-block-content">

            <h3><?php echo $title ?></h3>

            <div class="ovh">
                <ul class="styled-list">
                    <?php echo $html ?>
                </ul>


                <?php if ($link) ?>
                    <a href="<?php echo $link ?>" class="button"> <?php _e('Read more', 'crum'); ?></a>

            </div>

        </div>

    </div>




    <?php
        echo $after_widget;
    }


    function update($new, $old){
        $new = wp_parse_args($new, array(
            'title' => '',

            'html' => '',
            'link' => '',
            'icon' => '',
            'align' => '',
            'text-align' => '',
            'image_uri' => '',
            'image_uri_hov' => '',
        ));
        return $new;
    }

    function form( $instance ) {
        $instance = wp_parse_args($instance, array(
            'title' => '',
            'html' => '',
            'link' => '',
            'icon' => '',
            'align' => '',
            'text-align' => '',
            'image_uri' => '',
            'image_uri_hov' => '',
        ));

        $align = $instance['align'];

        ?>

    <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'crum' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr($instance['title']) ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'html' ); ?>"><?php _e( 'Text', 'crum' ); ?>:</label>
        <textarea  class="widefat" cols="40" rows="20" id="<?php echo $this->get_field_id( 'html' ); ?>" name="<?php echo $this->get_field_name( 'html' ); ?>"><?php echo esc_attr($instance['html']) ?></textarea>
    </p>

    <p>
        <label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Link', 'crum' ); ?>:</label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr($instance['link']) ?>" />
    </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'icon' ); ?>"><?php _e( 'Type Icon name', 'crum' ); ?>:</label>
            <input class="iconname"  id="<?php echo $this->get_field_id( 'icon' ); ?>" name="<?php echo $this->get_field_name( 'icon' ); ?>" type="text" value="<?php echo esc_attr($instance['icon']) ?>" />
            <a href="#" class="button crum-icon-add" title="<?php _e('Add Icon','crum'); ?>"><?php _e('Add Icon','crum'); ?></a>
        </p>

    <?php
    }
}


add_action( 'widgets_init', create_function( '', 'register_widget("crum_block_fetures_list");' ) );