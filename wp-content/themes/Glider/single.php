<?php get_template_part('templates/top', 'page'); ?>

<section id="layout">
    <div class="row">

    <?php

        set_layout('single', true);

        get_template_part('templates/content', 'single');

        set_layout('single', false);

    ?>

    </div>
</section>

