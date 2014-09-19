<?php

class crum_partners_widget extends WP_Widget {


    function __construct() {
        parent::__construct(
            'crum_partners_widget',
            'Box: Partners / Clients list', // Name
            array( 'description' => __( 'Display clients / partners logos', 'crum' ),
            )
        );
    }


    function widget( $args, $instance ) {

        //get theme options

        if ( isset( $instance[ 'title' ] ) ) {

            $title = $instance[ 'title' ];

        } else {

            $title = __( 'Partners list', 'crum' );

        }

        extract( $args );

        $link = $instance['link'];
        $display_link = $instance['display_link'];
        $post_order_by = (isset($instance['post_order_by'])) ? $instance['post_order_by'] : '';
        $limit_number = (isset($instance['limit_number'])) ? $instance['limit_number'] : '';
        $slide_autoscroll = $instance ['slide_autoscroll'];



        /* show the widget content without any headers or wrappers */

        echo $before_widget;

        if ($title) {

            echo $before_title;
            echo $title;
            if ($link) { echo '<span class="extra-links"><a href="'.$link.'"></a></span><div class="list-blocks"></div>';}
            echo $after_title;

        } ?>


<div class="clients-list-wrap" id="<?php echo ($args['widget_id']);?>">
  <?php      echo '<ul class="clients-list">';

        $post_order = (isset($post_order)) ? $post_order : 'ASC';
        $limit_number = (isset($limit_number)) ? $limit_number : '-1';
        $the_query = new WP_Query( 'posts_per_page= '.$limit_number.'&post_type= clients&orderby='.$post_order_by.'&order='.$post_order.'' );

        $i = 1;

        while ( $the_query->have_posts() ) :
            $the_query->the_post();

                if( has_post_thumbnail() ){
                $thumb = get_post_thumbnail_id();
                $img_url = wp_get_attachment_url($thumb, 'medium'); //get img URL
                $article_image = aq_resize($img_url, 200, 200, false);
                ?>

            <li class="clients-item">
              <?php if ($display_link == 'yes') {
                    echo '<a href="'.get_permalink().'" class="">';
                } ?>
                <div class="clients-image">
                <img src="<?php echo $article_image ?>" alt="<?php the_title(); ?>" />
                </div>
                <?php
                if ($display_link == 'yes') {
                    echo '</a>';
                }
                ?>
            </li>

            <?php }

            if (!($limit_number == '')) {
                if (!($i % $limit_number)) {
                    echo '</div>';
                    echo '<div class="clients-list">';
                }
            }

            $i++;
        endwhile;

        echo '</ul>';

?>
</div>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery('#<?php echo ($args['widget_id']);?>').flexslider({
                    selector: ".clients-list > li",
                    animation: "slide",
                    animationLoop: true,
                    direction: "horizontal",
                    pauseOnAction: true,
                    itemWidth: 235,
                    minItems: 2,                    //{NEW} Integer: Minimum number of carousel items that should be visible. Items will resize fluidly when below this.
                    maxItems: 5,
                    <?php if ($slide_autoscroll == 'Disable') {?>
                    slideshow: false,
                    <?php }else {?>
                    slideshow: true,
                    <?php }?>
                    controlsContainer: ".list-blocks",
                    controlNav: false,
                    directionNav: true,
                    prevText: "",                 //String: Set the text for the "previous" directionNav item
                    nextText: ""

                });
            });
        </script>
        <?php
        /* Restore original Post Data
        */
        wp_reset_postdata();

        echo $after_widget;

    }

    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );

        $instance['link'] = $new_instance['link'];

        $instance['post_order_by'] = $new_instance ['post_order_by'];

        $instance['limit_number'] = $new_instance['limit_number'];

        $instance['display_link'] = $new_instance['display_link'];

        $instance['slide_autoscroll'] = $new_instance ['slide_autoscroll'];

        return $instance;

    }

    function form( $instance ) {

        $title = apply_filters( 'widget_title', $instance['title'] );

        /* Set up some default widget settings. */

        $link = $instance['link'];

        $display_link = $instance['display_link'];

        $post_order_by = $instance['post_order_by'];

        $limit_number = $instance ['limit_number'];

        $slide_autoscroll = $instance ['slide_autoscroll'];

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
            <label for="<?php echo $this->get_field_id( 'limit_number' ); ?>"><?php _e( 'Limit number of items', 'crum' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('limit_number'); ?>" name="<?php echo $this->get_field_name('limit_number'); ?>" type="text" value="<?php echo esc_attr($limit_number); ?>"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'slide_autoscroll' ); ?>"><?php _e( 'Enable/disable autoscroll', 'crum' ); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id( 'slide_autoscroll' ); ?>" name="<?php echo $this->get_field_name( 'slide_autoscroll' );?>"  >

                <option class="widefat"  value="Disable" <?php if( esc_attr( $slide_autoscroll ) == 'Disable' ) echo 'selected'; ?>><?php _e('Disable autoscroll','crum'); ?></option>
                <option class="widefat"  value="Enable" <?php if( esc_attr( $slide_autoscroll ) == 'Enable' ) echo 'selected'; ?>><?php _e('Enable autoscroll','crum'); ?></option>


            </select>

        </p>

    <?php


    }

}

add_action( 'widgets_init', create_function( '', 'register_widget("crum_partners_widget");' ) );