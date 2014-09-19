<?php

/**
 * Notice Class
 */
class crum_promoblock extends WP_Widget {
    /** constructor */
    function __construct() {
        parent::WP_Widget('crum_promoblock', 'Box: Promo block', array( 'description' => 'Box with icons' ) );
    }

    /** @see WP_Widget::widget */
    function widget( $args, $instance ) {

        extract( $args );

        $title = apply_filters( 'widget_title', $instance['title'] );

    ?>

    <div class=" info-box al-<?php echo $instance['alignment'];?>">

        <?php
        if(!empty($instance['icon'])){
            echo '<i style="font-size:'.$instance['button_fontsize'].'" class="icon '.$instance['icon'].'"></i>';
        }?>

        <div class="ovh">
            <?php if ( !empty( $title ) ) { echo "<div class='title'>" .  html_entity_decode($title) . "</div>"; } ?>
            <p><?php echo $instance['desc']; ?></p>
        </div>
    </div>

    <?php

    }

    /** @see WP_Widget::update */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance[ 'title' ] = strip_tags($new_instance['title']);
        $instance[ 'desc' ] = strip_tags($new_instance['desc']);
        $instance[ 'alignment' ] =  $new_instance[ 'alignment' ] ;
        $instance[ 'icon' ] =  $new_instance[ 'icon' ] ;
        $instance[ 'button_fontsize' ] =  $new_instance[ 'button_fontsize' ];

        return $instance;
    }

    /** @see WP_Widget::form */
    function form( $instance ) {
        if ( $instance ) {
            $title = esc_attr( $instance[ 'title' ] );
            $desc =  $instance[ 'desc' ] ;
            $alignment =  $instance[ 'alignment' ] ;
            $icon =  $instance[ 'icon' ];
            $button_fontsize =  $instance[ 'button_fontsize' ];
        }
        else {
            $title = 'Title';
        }
        ?>
    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'crum'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        <label for="<?php echo $this->get_field_id('title-tag'); ?>"><?php _e('Title Tag:', 'crum'); ?></label>

        <label for="<?php echo $this->get_field_id('desc_label'); ?>"><?php _e('Description:', 'crum'); ?></label>
        <textarea id="<?php echo $this->get_field_id('desc'); ?>" name="<?php echo $this->get_field_name('desc'); ?>" cols="20" rows="4" style="width: 100%"><?php echo $desc; ?></textarea>

        <label for="<?php echo $this->get_field_id('alignment-label'); ?>"><?php _e('Alignment:', 'crum'); ?></label>
        <select class="widefat" id="<?php echo $this->get_field_id('alignment'); ?>" name="<?php echo $this->get_field_name('alignment'); ?>">
            <option value="left" <?php if($alignment=='left') echo 'selected=selected'; ?>>Left</option>
            <option value="right" <?php if($alignment=='right') echo 'selected=selected'; ?>>Right</option>
            <option value="center" <?php if($alignment=='center') echo 'selected=selected'; ?>>Center</option>
        </select>


        <p>
            <label for="<?php echo $this->get_field_id( 'icon' ); ?>"><?php _e( 'Type Icon name', 'crum' ); ?>:</label>
            <input class="iconname"  id="<?php echo $this->get_field_id( 'icon' ); ?>" name="<?php echo $this->get_field_name( 'icon' ); ?>" type="text" value="<?php echo $icon; ?>" />
            <a href="#" class="button crum-icon-add" title="Add Icon">Add Icon</a>
        </p>

        <label for="<?php echo $this->get_field_id('button-font-size'); ?>"><?php _e('Icon Size:', 'crum'); ?></label>
        <input class="mytext" id="<?php echo $this->get_field_id('button_fontsize'); ?>" name="<?php echo $this->get_field_name('button_fontsize'); ?>" type="text" value="<?php echo $button_fontsize; ?>" />


    </p>
    <?php
    }

}

add_action( 'widgets_init', create_function( '', 'register_widget("crum_promoblock");' ) );