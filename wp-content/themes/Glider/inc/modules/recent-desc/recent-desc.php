<?php

/*
Plugin Name: Recent works + description
Plugin URI: #
Description: Recent works from portfolio
Author: Crumina
Version: 1
Author URI: #
*/

class crum_recent_desc extends WP_Widget {
    function __construct() {
        parent::__construct(
            'crum_recent_desc',
            'Box: Recent folio + description', // Name
            array( 'description' => __( '3 recent portfolio items + description ', 'crum' ),
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
        $post_order = $instance['post_order'];
        $post_order_by = $instance['post_order_by'];


        echo $before_widget;




        echo '<div class="row">';
        echo '<div class="three columns widget">';

        if ($title) {

            echo $before_title;
            echo $title;
            if ($link) { echo '<span class="extra-links"><a href="'.$link.'"></a></span>';}
            echo $after_title;

        }

        echo '<span class="desc-text">'.$html.'</span>';
        echo '</div>';

        global $post;

        $args = array(
            'post_type' => 'my-product',
            'posts_per_page' => '3',
            'orderby'=> $post_order_by,
            'order' => $post_order

        );
            $the_query = new WP_Query( $args );

        while ( $the_query->have_posts() ) :
        $the_query->the_post(); ?>

        <div class="three columns">

            <?php

            $thumb = get_post_thumbnail_id();

            if( has_post_thumbnail() ){
                $img_url = wp_get_attachment_url($thumb, 'medium'); //get img URL
                $article_image = aq_resize($img_url, 280, 195, true);
            } else {
                $article_image = $no_image;
            } ?>

                <div class="entry-thumb">
                    <img src="<?php echo $article_image ?>" alt="<?php the_title(); ?>"/>
                    <span class="hover-box">
                        <a href="<?php the_permalink(); ?>" class="more-link"> </a>
                        <a href="<?php echo $img_url; ?>" class="zoom-link"> </a>
                    </span>
                </div>

                <h4 class="box-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

                <span class="dopinfo"><?php get_template_part('templates/folio', 'terms'); ?></span>

        </div>

        <?php endwhile;

        wp_reset_query();


        echo '</div>';
        echo $after_widget;
    }


    function update($new, $old){
        $new = wp_parse_args($new, array(
            'title' => '',
            'html' => '',
            'link' => '',
            'post_order' => '',
            'post_order_by' => ''

        ));
        return $new;
    }

    function form( $instance ) {
        $instance = wp_parse_args($instance, array(
            'title' => '',
            'html' => '',
            'link' => '',
            'post_order' => '',
            'post_order_by' => ''

        ));

        $post_order = $instance['post_order'];
        $post_order_by = $instance['post_order_by'];

        ?>

    <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'crum' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr($instance['title']) ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Link', 'crum' ); ?>:</label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr($instance['link']) ?>" />
    </p>

    <p>
        <label for="<?php echo $this->get_field_id( 'html' ); ?>"><?php _e( 'Text', 'crum' ); ?>:</label>
        <textarea  class="widefat" cols="40" rows="20" id="<?php echo $this->get_field_id( 'html' ); ?>" name="<?php echo $this->get_field_name( 'html' ); ?>"><?php echo esc_attr($instance['html']) ?></textarea>
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




    <?php
    }
}

add_action( 'widgets_init', create_function( '', 'register_widget("crum_recent_desc");' ) );