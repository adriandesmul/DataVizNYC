<?php

/**
 * Subscribe To RSS via feedburner
 */
class crum_rss_mail extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'rss_mail_subscribe', // Base ID
            'Widget: Email Subscribe', // Name
            array( 'description' => __( 'Displays a form for users to subscribe to your Feedburner feed via email', 'crum' ), ) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );
        $feedburner = $instance['feedburner'];
        $label = $instance['label'];
        $facebook_page = $instance['facebook'] ;
        $youtube_url = $instance['youtube'] ;
        $twitter_id =  $instance['twitter'] ;


        $counter = 0;
        if( $twitter_id ) $counter ++ ;
        if( $youtube_url ) $counter ++ ;
        if( $facebook_page ) $counter ++ ;

        echo $before_widget;
        if ( ! empty( $title ) )
            echo $before_title . $title . $after_title; ?>



        <form id="feedburner_subscribe" class="subscribe" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feedburner; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">

            <div class="row collapse">
                <div class="nine mobile-three columns">
                    <input class="text" type="text" name="email" id="subsmail" placeholder="<?php echo $label; ?>">
                </div>
                <div class="three mobile-one columns">
                    <input type="submit" class="expand postfix" value="<?php _e('Join Us','crum'); ?>">
                </div>
            </div>

            <input type="hidden" value="<?php echo $feedburner; ?>" name="uri"/>
        	<input type="hidden" name="loc" value="en_US"/>

        </form>

        <?php _e('By subscribing to our mailing list you will always be update with the latest news from us.','crum'); ?>

<div class="feedb-follows">

        <?php if( $twitter_id ):
            $twitter = tie_followers_count(); ?>
            <div class="item item-tw">
                <img class="icon" src="<?php echo get_template_directory_uri();?>/assets/img/subs-count-tw.png" alt="ico">

                <span class="number"><?php echo @number_format($twitter['followers_count']) ?></span>
                <span class="text"><?php _e('followers' , 'crum' ) ?></span>
            </div>
        <?php endif; ?>

    <?php if( $youtube_url ):
        $youtube = tie_youtube_subs( $youtube_url ); ?>
            <div class="item item-yt">
                <img class="icon" src="<?php echo get_template_directory_uri();?>/assets/img/subs-count-yt.png" alt="ico">

                <span class="number"><?php echo @number_format( $youtube ) ?></span>
                <span class="text"><?php _e('followers' , 'crum' ) ?></span>
            </div>
    <?php endif; ?>


        <?php if( $facebook_page ):
            $facebook = tie_facebook_fans( $facebook_page ); ?>
            <div class="item item-fb">
                <img class="icon" src="<?php echo get_template_directory_uri();?>/assets/img/subs-count-fb.png" alt="ico">

                <span class="number"><?php echo @number_format( $facebook ) ?></span>
                <span class="text"><?php _e('fans' , 'crum' ) ?></span>


            </div>
        <?php endif; ?>

</div>
        <?php echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['feedburner'] = strip_tags( $new_instance['feedburner'] );
        $instance['label'] = strip_tags( $new_instance['label'] );
        $instance['facebook'] = $new_instance['facebook'] ;
        $instance['youtube'] = $new_instance['youtube'] ;
        $instance['twitter'] =  strip_tags($new_instance['twitter']) ;

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Subscribe Via Email', 'crum' );
        } if ( isset( $instance[ 'label' ] ) ) {
            $label = $instance[ 'label' ];
        }
        else {
            $label = __( 'Enter your email address', 'crum' );
        }        ?>

    <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','crum' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'feedburner' ); ?>"><?php _e( 'Feedburner Feed Name:','crum' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'feedburner' ); ?>" name="<?php echo $this->get_field_name( 'feedburner' ); ?>" type="text" value="<?php echo $instance['feedburner']; ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'label' ); ?>"><?php _e( 'Textbox Label:','crum' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'label' ); ?>" name="<?php echo $this->get_field_name( 'label' ); ?>" type="text" value="<?php echo esc_attr( $label ); ?>" />
    </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'youtube' ); ?>">Youtube Channel URL : </label>
            <input id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo $instance['youtube']; ?>" class="widefat" type="text" />
            <small>Link must be like http://www.youtube.com/user/username </small>

        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'facebook' ); ?>">Facebook Page URL : </label>
            <input id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo $instance['facebook']; ?>" class="widefat" type="text" />
            <small>Link must be like http://www.facebook.com/username/ or http://www.facebook.com/PageID/</small>

        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'twitter' ); ?>">Enable Twitter : </label>
            <input id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>"  value="true" <?php if( $instance['twitter'] ) echo 'checked="checked"'; ?> type="checkbox"  />
            <small><em style="color:red;">Make sure you Setup Twitter API OAuth settings under Theme options > Twitter panel </em></small>
        </p>

    <?php
    }

}