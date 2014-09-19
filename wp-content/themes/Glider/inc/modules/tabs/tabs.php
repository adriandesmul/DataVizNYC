<?php

class crum_tabwidget extends WP_Widget {
    /** constructor */
    function __construct() {
        parent::WP_Widget( /* Base ID */'crum_tabwidget', /* Name */'Box: Tabs', array( 'description' => '4 Tabs block' ) );
    }

    /** @see WP_Widget::widget */
    function widget( $args, $instance ) {
        extract( $args );

        $block_title =  $instance['block_title'] ;


        echo $before_widget;
        if ($block_title) {

            echo $before_title;
            echo $block_title;
            echo $after_title;

        }
        ?>
        <dl class="tabs horisontal">

            <dd class="active">
                <a href="#tab-crum-1"><?php
                    if ($instance['tabicon1']) echo '<i class="'.$instance['tabicon1'].'"></i>';
                    echo esc_attr($instance['title1']);
                    ?></a>
            </dd>
            <?php if ($instance['title2']) {

                echo '<dd><a href="#tab-crum-2">';
                if ($instance['tabicon2']) echo '<i class="'.$instance['tabicon2'].'"></i>';
                echo esc_attr($instance['title2']).'</a></dd>';

            }if ($instance['title3']) {

                echo '<dd><a href="#tab-crum-3">';
                if ($instance['tabicon3']) echo '<i class="'.$instance['tabicon3'].'"></i>';
                echo esc_attr($instance['title3']).'</a></dd>';

            }if ($instance['title4']) {

                echo '<dd><a href="#tab-crum-4">';
                if ($instance['tabicon4']) echo '<i class="'.$instance['tabicon4'].'"></i>';
                echo esc_attr($instance['title4']).'</a></dd>';

            } ?>
        </dl>


        <ul class="tabs-content">
            <ul class="tabs-content">

                <li class="active" id="tab-crum-1Tab">
                    <?php echo ($instance['content1']);?>
                </li>

                <?php if ($instance['content2']) {
                    echo '<li id="tab-crum-2Tab">'. $instance['content2'].'</li>';
                }if ($instance['content3']) {
                    echo '<li id="tab-crum-3Tab">'. $instance['content3'].'</li>';
                }if ($instance['content4']) {
                    echo '<li id="tab-crum-4Tab">'. $instance['content4'].'</li>';
                }?>

            </ul>
        </ul>


        <?php
        echo $after_widget;
    }

    function update($new, $old)
    {
        $new = wp_parse_args($new, array(
            'block_title'   => '',
            'title1'         => '',
            'content1'      => '',
            'title2'         => '',
            'content2'      => '',
            'title3'         => '',
            'content3'      => '',
            'title4'         => '',
            'content4'      => '',
            'tabicon1'      => '',
            'tabicon2'      => '',
            'tabicon3'      => '',
            'tabicon4'      => '',
        ));
        return $new;
    }

    function form($instance)
    {
        $instance = wp_parse_args($instance, array(
            'block_title'   => '',
            'title1'         => '',
            'content1'      => '',
            'title2'         => '',
            'content2'      => '',
            'title3'         => '',
            'content3'      => '',
            'title4'         => '',
            'content4'      => '',
            'tabicon1'      => '',
            'tabicon2'      => '',
            'tabicon3'      => '',
            'tabicon4'      => '',
        ));
        ?>

        <div id="tabpane">

            <p>
                <label for="<?php echo $this->get_field_id( 'block_title' ); ?>"><?php _e( 'Title:', 'crum' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'block_title' ); ?>" name="<?php echo $this->get_field_name( 'block_title' ); ?>" type="text" value="<?php echo esc_attr($instance['block_title']) ?>" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('title1'); ?>"><?php _e('Section Title:', 'crum'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title1'); ?>" name="<?php echo $this->get_field_name('title1'); ?>" type="text" value="<?php echo esc_attr($instance['title1']) ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('tabicon1'); ?>"><?php _e('Section icon:', 'crum'); ?></label>
                <input class="iconname" id="<?php echo $this->get_field_id('tabicon1'); ?>" name="<?php echo $this->get_field_name('tabicon1'); ?>" type="text" value="<?php echo esc_attr($instance['tabicon1']) ?>" />
                <a href="#" class="button crum-icon-add" title="Add Icon">Add Icon</a>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('content1'); ?>"><?php _e('Content:', 'crum'); ?></label>
                <textarea class="widefat" id="<?php echo $this->get_field_id('content1'); ?>" name="<?php echo $this->get_field_name('content1'); ?>" ><?php echo esc_attr($instance['content1']) ?></textarea>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('title2'); ?>"><?php _e('Section Title:', 'crum'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title2'); ?>" name="<?php echo $this->get_field_name('title2'); ?>" type="text" value="<?php echo esc_attr($instance['title2']) ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('tabicon2'); ?>"><?php _e('Section icon:', 'crum'); ?></label>
                <input class="iconname" id="<?php echo $this->get_field_id('iconname'); ?>" name="<?php echo $this->get_field_name('tabicon2'); ?>" type="text" value="<?php echo esc_attr($instance['tabicon2']) ?>" />
                <a href="#" class="button crum-icon-add" title="Add Icon">Add Icon</a>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('content2'); ?>"><?php _e('Content:', 'crum'); ?></label>
                <textarea class="widefat" id="<?php echo $this->get_field_id('content2'); ?>" name="<?php echo $this->get_field_name('content2'); ?>" ><?php echo esc_attr($instance['content2']) ?></textarea>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('title3'); ?>"><?php _e('Section Title:', 'crum'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title3'); ?>" name="<?php echo $this->get_field_name('title3'); ?>" type="text" value="<?php echo esc_attr($instance['title3']) ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('tabicon3'); ?>"><?php _e('Section icon:', 'crum'); ?></label>
                <input class="iconname" id="<?php echo $this->get_field_id('tabicon3'); ?>" name="<?php echo $this->get_field_name('tabicon3'); ?>" type="text" value="<?php echo esc_attr($instance['tabicon3']) ?>" />
                <a href="#" class="button crum-icon-add" title="Add Icon">Add Icon</a>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('content3'); ?>"><?php _e('Content:', 'crum'); ?></label>
                <textarea class="widefat" id="<?php echo $this->get_field_id('content3'); ?>" name="<?php echo $this->get_field_name('content3'); ?>" ><?php echo esc_attr($instance['content3']) ?></textarea>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('title4'); ?>"><?php _e('Section Title:', 'crum'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title4'); ?>" name="<?php echo $this->get_field_name('title4'); ?>" type="text" value="<?php echo esc_attr($instance['title4']) ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('tabicon4'); ?>"><?php _e('Section icon:', 'crum'); ?></label>
                <input class="iconname" id="<?php echo $this->get_field_id('tabicon4'); ?>" name="<?php echo $this->get_field_name('tabicon4'); ?>" type="text" value="<?php echo esc_attr($instance['tabicon4']) ?>" />
                <a href="#" class="button crum-icon-add" title="Add Icon">Add Icon</a>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('content4'); ?>"><?php _e('Content:', 'crum'); ?></label>
                <textarea class="widefat" id="<?php echo $this->get_field_id('content4'); ?>" name="<?php echo $this->get_field_name('content4'); ?>" ><?php echo esc_attr($instance['content4']) ?></textarea>
            </p>

        </div>
    <?php
    }

} // class Foo_Widget

add_action( 'widgets_init', create_function( '', 'register_widget("crum_tabwidget");' ) );