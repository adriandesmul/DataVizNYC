<?php

class crum_block_fetures_box extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'crum_block_fetures_box',
            'Box: Features block', // Name
            array('description' => __('Block with icon', 'crum'),
            )
        );
    }

    /**
     * @param array $args
     * @param array $instance
     */
    function widget($args, $instance)
    {

        extract($args);
        $title = $instance['title'];
        $html = $instance['html'];
        if ( isset( $instance['link'] ) ) {
            $link = $instance['link'];
        } else {
            $link ='';
        }
        $icon = $instance['icon'];
        $img = esc_url($instance['image_uri']);
        $article_image = aq_resize($img, 180, 180, false);
        $text_align = $instance['alignment'];

        echo $before_widget;

        ?>

		<a class="link clickable" href="<?php echo $link ?>">
			<div class="feature-box <?php echo $text_align; ?>">
				<?php if ($icon) { ?>

					<div class="icon">
						<i class="<?php echo $icon; ?>"></i>
					</div>

				<?php } elseif ($article_image) { ?>

					<div class="image">
						<img src="<?php echo $article_image; ?>" alt="<?php echo $title ?>"/>
					</div>

				<?php } ?>

				<div class="feat-block-content">

					<h3><?php echo $title ?></h3>

					<p><?php echo $html ?></p>

				</div>


			</div>
		</a>

        <?php
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['html'] = $new_instance['html'];
        $instance['icon'] = $new_instance['icon'];
        $instance['alignment'] = $new_instance['alignment'];
        $instance['link'] = $new_instance['link'];
        $instance['image_uri'] = $new_instance['image_uri'];


        return $instance;
    }

    function form($instance)
    {

        $align = $instance['align'];

        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'crum'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']) ?>"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('html'); ?>"><?php _e('Text', 'crum'); ?>:</label>
            <textarea class="widefat" cols="40" rows="10" id="<?php echo $this->get_field_id('html'); ?>" name="<?php echo $this->get_field_name('html'); ?>"><?php echo esc_attr($instance['html']) ?></textarea>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link', 'crum'); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo esc_attr($instance['link']) ?>"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('alignment'); ?>"><?php _e('Text alignment', 'crum'); ?></label>

            <select class="widefat" id="<?php echo $this->get_field_id('alignment'); ?>" name="<?php echo $this->get_field_name('alignment'); ?>">

                <option class="widefat" value="al-left" <?php if (esc_attr($align) == 'al-left') echo 'selected'; ?>><?php _e('Align left', 'crum'); ?></option>
                <option class="widefat" value="al-center" <?php if (esc_attr($align) == 'al-center') echo 'selected'; ?>><?php _e('Align center', 'crum'); ?></option>

            </select>

        </p>

        <p>
            <label for="<?php echo $this->get_field_id('icon'); ?>"><?php _e('Type Icon name', 'crum'); ?>:</label>
            <input class="iconname" id="<?php echo $this->get_field_id('icon'); ?>" name="<?php echo $this->get_field_name('icon'); ?>" type="text" value="<?php echo esc_attr($instance['icon']) ?>"/>
            <a href="#" class="button crum-icon-add" title="<?php _e('Add Icon', 'crum'); ?>"><?php _e('Add Icon', 'crum'); ?></a>

            <label for="<?php echo $this->get_field_id('image_uri'); ?>"><?php _e('Or Image', 'crum'); ?>:</label>
            <input type="text" class="img" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php echo $instance['image_uri']; ?>"/>
            <input type="button" class="button select-img" value="<?php _e('Select Image', 'crum'); ?>"/>
        </p>


    <?php
    }
}


add_action('widgets_init', create_function('', 'register_widget("crum_block_fetures_box");'));