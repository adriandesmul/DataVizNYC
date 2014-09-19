<?php
/*
Template Name: Page with Large right aside
*/

$page_id = get_queried_object_id();

$stun_header = get_post_meta($page_id, 'crum_stun_head', true);

if ( $stun_header == 'on' ) {
	get_template_part( 'templates/top', 'page' );
}

?>


<section id="layout" class="no-title magazine">

    <div class="row">
        <div class="eight columns">
            <?php get_template_part('templates/content', 'page'); ?>
        </div>
        <div class="four columns" style="overflow-x: hidden">
            <?php



            $selected_sidebar = get_post_meta($page_id, 'crum_sidebars_sidebar_2', true);
            if ($selected_sidebar) {

                crum_custom_dynamic_sidebar($selected_sidebar);

            } else {

                crum_custom_dynamic_sidebar('For Magazine Layout');

            } ?>
        </div>
    </div>
</section>