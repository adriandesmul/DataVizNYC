<?php
class Redux_Options_social {

    /**
     * Field Constructor.
     *
     * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
     *
     * @since Redux_Options 1.0.0
    */
    function __construct($field = array(), $value ='', $parent) {
        $this->field = $field;
		$this->value = $value;
		$this->args = $parent->args;
    }

    /**
     * Field Render Function.
     *
     * Takes the vars and outputs the HTML for the field in the settings
     *
     * @since Redux_Options 1.0.0
    */
    function render() {
        $class = (isset($this->field['class'])) ? $this->field['class'] : 'regular-text';
        echo '<ul id="' . $this->field['id'] . '-ul">';

        if(isset($this->value) && is_array($this->value)) {
            foreach($this->value as $k => $value) {
                if($value != '') {
                    echo '<li>
                        <input type="text" id="' . $this->field['id'] . '-' . $k . '" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][]" value="' . esc_attr($value) . '" class="' . $class . '" />
                        <input type="text" id="' . $this->field['id'] . '-' . $k . '" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][]" value="' . esc_attr($value) . '" class="' . $class . '" /> ';?>
                        <input name="<?php echo $name; ?>" id="<?php echo $id; ?>" class="<?php echo $class; ?>" value="1" <?php echo checked( $this->value, '1', false ); ?> type="checkbox" />
                        <?php echo ' <a href="javascript:void(0);" class="redux-opts-multi-text-remove">' . __('Remove', Redux_TEXT_DOMAIN) . '</a>
                    </li>';
                }
            }
        } else {
            echo '<li><input type="text" id="' . $this->field['id'] . '" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][]" value="" class="' . $class . '" />
                  <input type="text" id="' . $this->field['id'] . '-' . $k . '" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][]" value="' . esc_attr($value) . '" class="' . $class . '" /> ';?>
                  <input name="<?php echo $name; ?>" id="<?php echo $id; ?>" class="<?php echo $class; ?>" value="1" <?php echo checked( $this->value, '1', false ); ?> type="checkbox" />
      <?php echo '<a href="javascript:void(0);" class="redux-opts-multi-text-remove">' . __('Remove', Redux_TEXT_DOMAIN) . '</a>
                 </li>';
        }

        echo '<li style="display:none;"><input type="text" id="' . $this->field['id'] . '" name="" value="" class="' . $class . '" /> <a href="javascript:void(0);" class="redux-opts-multi-text-remove">' . __('Remove', Redux_TEXT_DOMAIN) . '</a></li>';
        echo '</ul>';
        echo '<a href="javascript:void(0);" class="redux-opts-multi-text-add" rel-id="' . $this->field['id'] . '-ul" rel-name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][]">' . __('Add More', Redux_TEXT_DOMAIN) . '</a><br/>';
        echo (isset($this->field['desc']) && !empty($this->field['desc'])) ? ' <span class="description">' . $this->field['desc'] . '</span>' : '';
    }
    
    /**
     * Enqueue Function.
     *
     * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
     *
     * @since Redux_Options 1.0.0
    */
    function enqueue() {
        wp_enqueue_script(
            'crum-social-js',
            Redux_OPTIONS_URL . 'fields/social/field_social.js',
            array('jquery'),
            time(),
            true
        );
    }    
}
