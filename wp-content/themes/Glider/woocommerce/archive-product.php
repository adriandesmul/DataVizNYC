<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author         WooThemes
 * @package     WooCommerce/Templates
 * @version     2.0.0
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

?>
<section id="layout">

<?php $options = get_option('maestro');

    if ($options['stan_header']) {echo '<div id="stuning-header" style="';
        if
        ($options['stan_header_color']) { echo ' background-color: '.$options['stan_header_color'].'; ';}

        if
        ($options['stan_header_image']) { echo 'background-image: url('.$options['stan_header_image'].');  background-position: center;';}

        echo '">';
    } ?>

    <div class="row">
        <div class="twelve columns">
            <div id="page-title">
                <a href="javascript:history.back()" class="back"></a>

                <div class="page-title-inner">
                    <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

                    <div class="breadcrumbs">
                        <?php woocommerce_breadcrumb() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if ($options['stan_header']) {echo '</div>';} ?>

    <div class="row">
        <div class="nine columns">

            <?php
            global $post;
            $shop_page_id = woocommerce_get_page_id( 'shop' );
            $shop_page    = get_post( $shop_page_id );


            if ( is_post_type_archive() ){
                echo '<div class="shop__main_desc">';
                $content = apply_filters('the_content', $shop_page->post_content);
                echo $content;
                echo '</div>';
            }

            ?>

            <?php if (have_posts()) : ?>

            <?php
            /**
             * woocommerce_before_shop_loop hook
             *
             * @hooked woocommerce_result_count - 20
             * @hooked woocommerce_catalog_ordering - 30
             */

            remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

            do_action('woocommerce_before_shop_loop');

            ?>

            <?php woocommerce_product_loop_start(); ?>

            <?php woocommerce_product_subcategories(); ?>

            <?php while (have_posts()) : the_post(); ?>

                <?php woocommerce_get_template_part('content', 'product'); ?>

                <?php endwhile; // end of the loop. ?>

            <?php woocommerce_product_loop_end(); ?>

            <?php
            /**
             * woocommerce_after_shop_loop hook
             *
             * @hooked woocommerce_pagination - 10
             */
            do_action('woocommerce_after_shop_loop');
            ?>

            <?php elseif (!woocommerce_product_subcategories(array('before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false)))) : ?>

            <?php woocommerce_get_template('loop/no-products-found.php'); ?>

            <?php endif; ?>

			 </div>

		
        <div class="three columns">
            <?php dynamic_sidebar('shop-sidebar'); ?>
        </div>


    </div>
</section>

