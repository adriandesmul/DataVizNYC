<?php
/*
Template Name: Team member page
 */


 get_template_part('templates/top','page'); ?>

<section id="layout">
    <div class="row">

        <?php
        set_layout('pages');

        get_template_part('templates/content', 'page');

        set_layout('pages', false);

        ?>
    </div>
    </div>
</section>