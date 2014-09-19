<?php

class crum_about_me_widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'about_author_widget', // Base ID
            'Box: About author', // Name
            array( 'description' => __( 'Block with author info / pic', 'crum' ), 'classname' => 'about-me-block' ) // Args
        );
    }


    public function widget( $args, $instance ) {
        extract( $args );
        $title = $instance['title'];
        $html = $instance['html'];
        $link = $instance['link'];

        $author = $instance[ 'author' ];
        $author_add = $instance[ 'author_add' ];
        $add_link = $instance[ 'add_link' ];
        $add_link2 = $instance[ 'add_link2' ];


        echo $before_widget;

        if ($title) {

            echo $before_title;
            echo $title;

            if ($link) { echo '<span class="extra-links"><a href="'.$link.'"></a></span>';}
            echo $after_title;

        }

        ?>
<div class="about_author_widget">
    <div class="avatar">

        <?php
        $img = esc_url($instance['image_uri']);
        $article_image = aq_resize($img, 111, 111, true);
        ?>

        <img src="<?php echo $article_image ?>" alt="<?php the_title(); ?>">
    </div>


    <div class="text">
        <?php echo $html ?>
    </div>
	<div class="cl"></div>
    <span class="quote-author"><?php echo $author ?></span>
    <span class="quote-sub"><?php echo $author_add ?></span>

        <span class="additional-links">
            <?php
                if ($add_link) echo $add_link;
                if ($add_link2) echo '<span>/</span>' . $add_link2
            ?>
        </span>

</div>
    <?php
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = strip_tags( $new_instance['title'] );

        $instance['html'] = $new_instance['html'];
        $instance['link'] = $new_instance['link'];

        $instance['image_uri'] = esc_url($new_instance['image_uri']);

        $instance['author'] = $new_instance['author'];
        $instance['author_add'] = $new_instance['author_add'];
        $instance['add_link'] = $new_instance['add_link'];
        $instance['add_link2'] = $new_instance['add_link2'];

        return $instance;
    }

    /**
     * Back-end widget form.
     */
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }

        if ( isset( $instance[ 'html' ] ) ) {
            $html = $instance[ 'html' ];
        }
        if ( isset( $instance[ 'link' ] ) ) {
            $link = $instance[ 'link' ];
        }
        if ( isset( $instance[ 'author' ] ) ) {
            $author = $instance[ 'author' ];
        }
        if ( isset( $instance[ 'author_add' ] ) ) {
            $author_add = $instance[ 'author_add' ];
        }
        if ( isset( $instance[ 'add_link' ] ) ) {
            $author_add_link = $instance[ 'add_link' ];
        }
        if ( isset( $instance[ 'add_link2' ] ) ) {
            $author_add_link2 = $instance[ 'add_link2' ];
        }

        ?>
    <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'crum' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'html' ); ?>"><?php _e( 'Text', 'crum' ); ?>:</label>
        <textarea  class="widefat" cols="40" rows="10" id="<?php echo $this->get_field_id( 'html' ); ?>" name="<?php echo $this->get_field_name( 'html' ); ?>"><?php echo esc_attr( $html ); ?></textarea>
    </p>

    <p>
        <label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Link to full page', 'crum' ); ?>:</label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>" />
    </p>

    <p>
        <label for="<?php echo $this->get_field_id('image_uri'); ?>"><?php _e( 'Image', 'crum' ); ?></label><br />
        <input type="text" class="img" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php echo $instance['image_uri']; ?>" />
        <input type="button" class="select-img" value="<?php _e( 'Select Image', 'crum' ); ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'author' ); ?>"><?php _e( 'Author name', 'crum' ); ?>:</label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'author' ); ?>" name="<?php echo $this->get_field_name( 'author' ); ?>" type="text" value="<?php echo esc_attr( $author ); ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'author_add' ); ?>"><?php _e( 'Author additional', 'crum' ); ?>:</label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'author_add' ); ?>" name="<?php echo $this->get_field_name( 'author_add' ); ?>" type="text" value="<?php echo esc_attr( $author_add ); ?>" />
    </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'add_link' ); ?>"><?php _e( 'Additional link', 'crum' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'add_link' ); ?>" name="<?php echo $this->get_field_name( 'add_link' ); ?>" type="text" value="<?php echo esc_attr( $author_add_link ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'add_link2' ); ?>"><?php _e( 'Additional link', 'crum' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'add_link2' ); ?>" name="<?php echo $this->get_field_name( 'add_link2' ); ?>" type="text" value="<?php echo esc_attr( $author_add_link2 ); ?>" />
        </p>

    <?php
    }

}

function abm_enqueue()
{
    wp_enqueue_media();

    wp_enqueue_script('hrw', get_template_directory_uri() . '/assets/js/widget-image.js', null, null, true);
};

add_action('admin_enqueue_scripts', 'abm_enqueue');

add_action( 'widgets_init', create_function( '', 'register_widget("crum_about_me_widget");' ) );