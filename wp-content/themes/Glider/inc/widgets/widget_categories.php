<?php
/**
 * Duplicated and tweaked WP core Categories widget class
 */
class crum_icon_categories extends WP_Widget {

    function __construct() {
        $widget_ops = array( 'description' => __( 'A list of categories', 'crum'  ) );
        parent::__construct( 'crum_icon_categories', __( 'Cr: Categories with icons', 'crum' ), $widget_ops );
    }

    function widget( $args, $instance ) {
        extract( $args );

        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Blog categories', 'crum'  ) : $instance['title'], $instance, $this->id_base);

        echo $before_widget;

        if ($title) {



            echo $before_title;
            echo $title;
            echo $after_title;

        } ?>

    <ul class="category-widget">

    <?php

        $categ = $instance['cat_sel'];

        $categ = str_replace(array('["', '"]'),'',$categ);

        $args = array(
            'orderby'   => 'id',
            'hierarchical'   => 'false',
            'taxonomy'       => $categ
        );
            $categories = get_terms($categ, $args );
            foreach($categories as $category){

                if ($categ == 'product_cat'){
                $image 			= '';
                $thumbnail_id 	= absint( get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true ) );
                if ($thumbnail_id) :
                    $image = wp_get_attachment_url( $thumbnail_id );
                else :
                    $image = woocommerce_placeholder_img_src();
                endif;
                }
                  $saved_data = get_tax_meta($category->term_id, 'crum_cat_ico_img');
                ?>

            <li>

                    <a href="<?php echo $category_link = get_term_link($category->slug, $categ); ?>">

                    <?php if ($categ == 'product_cat'){ ?>
                        <span class="styled-icon" style="background: url('<?php echo $image; ?>')"></span>
                    <?php } else{ ?>
                        <span class="styled-icon <?php echo $saved_data; ?>" ></span>
                    <?php } ?>
                    <span class="category-border"><?php echo $category->name; ?></span>
                </a>
            </li>



    <?php
            }
    ?>
    </ul>
            <?php

        echo $after_widget;

    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['cat_sel'] = $new_instance['cat_sel'];

        return $instance;
    }

    function form( $instance ) {
        //Defaults
        $instance = wp_parse_args( (array) $instance, array( 'title' => '') );
        $title = esc_attr( $instance['title'] );
        $cat_selected = $instance['cat_sel'];

        ?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'crum' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
    </p>

        <?php

        $args=array(
        );

        $output = 'objects'; // or objects
        $taxonomies=get_taxonomies($args,$output);
        if  ($taxonomies) { ?>

    <label for="<?php echo $this->get_field_id( 'cat_sel' ); ?>"><?php _e( 'Select Taxonomy', 'crum' ); ?></label>
    <select class="widefat" id="<?php echo $this->get_field_id( 'cat_sel' ); ?>" name="<?php echo $this->get_field_name( 'cat_sel' );?>"  >

        <?php
        foreach ($taxonomies as $taxonomy ) {
            if($cat_selected == $taxonomy->name){$cat_sel =' selected="selected"';} else { $cat_sel ='';}
            echo '<option class="widefat" value="'.$taxonomy->name.'"'.$cat_sel.'>'.$taxonomy->label.'</option>';
        }?>

    </select>

    <?php
    }}


}