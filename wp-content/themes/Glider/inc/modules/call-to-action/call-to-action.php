<?php
/**
 * Notice Class
 */
class crum_callinaction extends WP_Widget {
    /** constructor */
    function __construct() {
        parent::WP_Widget('crum_callinaction', 'Box: Call to Action', array( 'description' => 'Call to Action Block' ) );
    }

    /** @see WP_Widget::widget */
    function widget( $args, $instance ) {

        extract( $args );

        $title = apply_filters( 'widget_title', $instance['title'] );
        $icon =  $instance[ 'icon' ];


        ?>

    <div class="to-action-block al-<?php echo $instance['alignment'];?>">
        <div class="ovh">
            <h5><?php echo $instance['desc']; ?></h5>
            <?php if ( !empty( $title ) ) { echo "<".$instance['title_tag'].">" .  html_entity_decode($title) . "</".$instance['title_tag'].">"; } ?>
        </div>
		
        <?php
        if(!empty($instance['button_label'])){
            if(!empty($instance['icon'])){
                echo '<a class="action-button" href="'.$instance['button_url'].'"> <span class="icon '.$icon.'"></span> '.$instance["button_label"].'</a>';
            } else {
                echo '<a class="action-button" href="'.$instance['button_url'].'"> <span class="icon"><img src="'.get_template_directory_uri().'/assets/img/cart-icon.png" alt=""></span> '.$instance["button_label"].'</a>';
            }
        }?>
    </div>

    <?php

    }

    /** @see WP_Widget::update */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['title_tag'] = strip_tags($new_instance['title_tag']);
        $instance['desc'] = strip_tags($new_instance['desc']);
        $instance[ 'alignment' ] =  $new_instance[ 'alignment' ] ;
        $instance[ 'icon' ] =  $new_instance[ 'icon' ];
        $instance['button_label'] = $new_instance['button_label'];
		$instance['button_url'] = $new_instance['button_url'];

        return $instance;
    }

    /** @see WP_Widget::form */
    function form( $instance ) {
        if ( $instance ) {
            $title = esc_attr( $instance[ 'title' ] );
            $title_tag = esc_attr( $instance[ 'title_tag' ] );
            $desc =  $instance[ 'desc' ] ;
            $alignment =  $instance[ 'alignment' ] ;
            $button_label =  $instance[ 'button_label' ];
            $button_url =  $instance[ 'button_url' ];
            $icon =  $instance[ 'icon' ];
        }
        else {
            $title = 'Title';
            $icon = '';
        }
        ?>
    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'crum'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        <label for="<?php echo $this->get_field_id('title-tag'); ?>"><?php _e('Title Tag:', 'crum'); ?></label>
    </p>
        <select class="widefat" id="<?php echo $this->get_field_id('title_tag'); ?>" name="<?php echo $this->get_field_name('title_tag'); ?>">
            <option value="h1" <?php if($title_tag=='h1') echo 'selected=selected'; ?>>h1</option>
            <option value="h2" <?php if($title_tag=='h2') echo 'selected=selected'; ?>>h2</option>
            <option value="h3" <?php if($title_tag=='h3') echo 'selected=selected'; ?>>h3</option>
            <option value="h4" <?php if($title_tag=='h4') echo 'selected=selected'; ?>>h4</option>
        </select>
        <label for="<?php echo $this->get_field_id('desc_label'); ?>"><?php _e('Description:', 'crum'); ?></label>
        <textarea id="<?php echo $this->get_field_id('desc'); ?>" name="<?php echo $this->get_field_name('desc'); ?>" cols="20" rows="4" style="width: 100%"><?php echo $desc; ?></textarea>

        <label for="<?php echo $this->get_field_id('alignment-label'); ?>"><?php _e('Alignment:', 'crum'); ?></label>
        <select class="widefat" id="<?php echo $this->get_field_id('alignment'); ?>" name="<?php echo $this->get_field_name('alignment'); ?>">
            <option value="left" <?php if($alignment=='left') echo 'selected=selected'; ?>>Left</option>
            <option value="right" <?php if($alignment=='right') echo 'selected=selected'; ?>>Right</option>
            <option value="center" <?php if($alignment=='center') echo 'selected=selected'; ?>>Center</option>
        </select>

        <p>
            <label for="<?php echo $this->get_field_id('button-label'); ?>"><?php _e('Button Label:', 'crum'); ?></label>
           	<input class="widefat" id="<?php echo $this->get_field_id('button_label'); ?>" name="<?php echo $this->get_field_name('button_label'); ?>" type="text" value="<?php echo $button_label; ?>" />
        </p>

        <p><label for="<?php echo $this->get_field_id('button-url'); ?>"><?php _e('Button URL:', 'crum'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('button_url'); ?>" name="<?php echo $this->get_field_name('button_url'); ?>" type="text" value="<?php echo $button_url; ?>" /></p>
        <p>
            <label for="<?php echo $this->get_field_id( 'icon' ); ?>"><?php _e( 'Type Icon name', 'crum' ); ?>:</label>
            <input class="iconname"  id="<?php echo $this->get_field_id( 'icon' ); ?>" name="<?php echo $this->get_field_name( 'icon' ); ?>" type="text" value="<?php echo $icon; ?>" />
            <a href="#" class="button crum-icon-add" title="Add Icon">Add Icon</a>
        </p>



    <?php
    }

}

add_action( 'widgets_init', create_function( '', 'register_widget("crum_callinaction");' ) );