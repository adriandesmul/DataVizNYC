<?php

class crum_widget_v_accordion extends WP_Widget
{


    function __construct()
    {
        parent::__construct(
            'crum_widget_v_accordion',
            __('Box: Vertical tab', 'crum'), // Name
            array('description' => __('Vertical tabs block', 'crum'),
            )
        );
    }


    /**
     * @param array $args
     * @param array $instance
     */
    function widget($args, $instance)
    {

        $block_title = $instance['block_title'];

        extract($args);

        echo $before_widget;

        if ($block_title) {

            echo $before_title;
            echo $block_title;
            echo $after_title;

        }


        ?>

        <div class="row">
            <div class="five columns">
                <dl class="vertical tabs">

                    <dd class="active">
                        <a href="#tab-v-crum-1">
                            <i class="icon <?php echo $instance['icon1']; ?>"></i>
                            <span class="tab-title"><?php echo esc_attr($instance['title1']); ?></span>
                        </a>
                    </dd>
                    <?php if ($instance['title2'] || $instance['icon2'] || $instance['content2']) { ?>
                        <dd>
                            <a href="#tab-v-crum-2">
                                <i class="icon <?php echo $instance['icon2']; ?>"></i>
                                <span class="tab-title"><?php echo esc_attr($instance['title2']); ?></span>
                            </a>
                        </dd>
                    <?php }
                    if ($instance['title3'] || $instance['icon3'] || $instance['content3']) { ?>
                        <dd>
                            <a href="#tab-v-crum-3">
                                <i class="icon <?php echo $instance['icon3']; ?>"></i>
                                <span class="tab-title"><?php echo esc_attr($instance['title3']); ?></span>
                            </a>
                        </dd>
                    <?php }
                    if ($instance['title4'] || $instance['icon4'] || $instance['content4']) { ?>
                        <dd>
                            <a href="#tab-v-crum-4">
                                <i class="icon <?php echo $instance['icon4']; ?>"></i>
                                <span class="tab-title"><?php echo esc_attr($instance['title4']); ?></span>
                            </a>
                        </dd>
                    <?php } ?>

                </dl>
            </div>
            <div class="seven columns">
                <ul class="tabs-content">

                    <li class="active" id="tab-v-crum-1Tab">
                        <?php echo($instance['content1']); ?>
                    </li>

                    <?php if ($instance['content2']) {
                        echo '<li id="tab-v-crum-2Tab">' . $instance['content2'] . '</li>';
                    }
                    if ($instance['content3']) {
                        echo '<li id="tab-v-crum-3Tab">' . $instance['content3'] . '</li>';
                    }
                    if ($instance['content4']) {
                        echo '<li id="tab-v-crum-4Tab">' . $instance['content4'] . '</li>';
                    }?>

                </ul>
            </div>
        </div>

        <?php

        echo $after_widget;
    }


    function update($new, $old)
    {
        $new = wp_parse_args($new, array(
            'block_title' => '',

            'title1' => '',
            'content1' => '',
            'title2' => '',
            'content2' => '',
            'title3' => '',
            'content3' => '',
            'title4' => '',
            'content4' => '',
            'icon1' => '',
            'icon2' => '',
            'icon3' => '',
            'icon4' => '',

        ));
        return $new;
    }

    function form($instance)
    {
        $instance = wp_parse_args($instance, array(
            'block_title' => '',

            'title1' => '',
            'content1' => '',
            'title2' => '',
            'content2' => '',
            'title3' => '',
            'content3' => '',
            'title4' => '',
            'content4' => '',
            'icon1' => '',
            'icon2' => '',
            'icon3' => '',
            'icon4' => '',

        ));
        ?>

        <div id="tabpane">

            <p>
                <label for="<?php echo $this->get_field_id('block_title'); ?>"><?php _e('Title:', 'crum'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('block_title'); ?>" name="<?php echo $this->get_field_name('block_title'); ?>" type="text" value="<?php echo esc_attr($instance['block_title']) ?>"/>
            </p>


            <p>
                <label for="<?php echo $this->get_field_id('title1'); ?>"><strong><?php _e('Section Title:', 'crum'); ?></strong></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title1'); ?>" name="<?php echo $this->get_field_name('title1'); ?>" type="text" value="<?php echo esc_attr($instance['title1']) ?>"/>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('icon1'); ?>"><?php _e('Type Icon name', 'crum'); ?>:</label>
                <input class="iconname" id="<?php echo $this->get_field_id('icon1'); ?>" name="<?php echo $this->get_field_name('icon1'); ?>" type="text" value="<?php echo esc_attr($instance['icon1']) ?>"/>
                <a href="#" class="button crum-icon-add" title="<?php _e('Add Icon', 'crum'); ?>"><?php _e('Add Icon', 'crum'); ?></a>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('content1'); ?>"><?php _e('Content:', 'crum'); ?></label>
                <textarea class="widefat" rows="10" id="<?php echo $this->get_field_id('content1'); ?>" name="<?php echo $this->get_field_name('content1'); ?>"><?php echo esc_attr($instance['content1']) ?></textarea>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('title2'); ?>"><strong><?php _e('Section Title:', 'crum'); ?></strong></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title2'); ?>" name="<?php echo $this->get_field_name('title2'); ?>" type="text" value="<?php echo esc_attr($instance['title2']) ?>"/>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('icon2'); ?>"><?php _e('Type Icon name', 'crum'); ?>:</label>
                <input class="iconname" id="<?php echo $this->get_field_id('icon2'); ?>" name="<?php echo $this->get_field_name('icon2'); ?>" type="text" value="<?php echo esc_attr($instance['icon2']) ?>"/>
                <a href="#" class="button crum-icon-add" title="<?php _e('Add Icon', 'crum'); ?>"><?php _e('Add Icon', 'crum'); ?></a>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('content2'); ?>"><?php _e('Content:', 'crum'); ?></label>
                <textarea class="widefat" rows="10" id="<?php echo $this->get_field_id('content2'); ?>" name="<?php echo $this->get_field_name('content2'); ?>"><?php echo esc_attr($instance['content2']) ?></textarea>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('title3'); ?>"><strong><?php _e('Section Title:', 'crum'); ?></strong></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title3'); ?>" name="<?php echo $this->get_field_name('title3'); ?>" type="text" value="<?php echo esc_attr($instance['title3']) ?>"/>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('icon3'); ?>"><?php _e('Type Icon name', 'crum'); ?>:</label>
                <input class="iconname" id="<?php echo $this->get_field_id('icon3'); ?>" name="<?php echo $this->get_field_name('icon3'); ?>" type="text" value="<?php echo esc_attr($instance['icon3']) ?>"/>
                <a href="#" class="button crum-icon-add" title="<?php _e('Add Icon', 'crum'); ?>"><?php _e('Add Icon', 'crum'); ?></a>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('content3'); ?>"><?php _e('Content:', 'crum'); ?></label>
                <textarea class="widefat" rows="10" id="<?php echo $this->get_field_id('content3'); ?>" name="<?php echo $this->get_field_name('content3'); ?>"><?php echo esc_attr($instance['content3']) ?></textarea>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('title4'); ?>"><strong><?php _e('Section Title:', 'crum'); ?></strong></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title4'); ?>" name="<?php echo $this->get_field_name('title4'); ?>" type="text" value="<?php echo esc_attr($instance['title4']) ?>"/>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('icon4'); ?>"><?php _e('Type Icon name', 'crum'); ?>:</label>
                <input class="iconname" id="<?php echo $this->get_field_id('icon4'); ?>" name="<?php echo $this->get_field_name('icon4'); ?>" type="text" value="<?php echo esc_attr($instance['icon4']) ?>"/>
                <a href="#" class="button crum-icon-add" title="<?php _e('Add Icon', 'crum'); ?>"><?php _e('Add Icon', 'crum'); ?></a>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('content4'); ?>"><?php _e('Content:', 'crum'); ?></label>
                <textarea class="widefat" rows="10" id="<?php echo $this->get_field_id('content4'); ?>" name="<?php echo $this->get_field_name('content4'); ?>"><?php echo esc_attr($instance['content4']) ?></textarea>
            </p>

        </div>
    <?php
    }

} // class Foo_Widget

add_action('widgets_init', create_function('', 'register_widget("crum_widget_v_accordion");'));