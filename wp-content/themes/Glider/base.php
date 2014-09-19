<?php $options = get_option('maestro'); ?>

<?php get_header(); ?>

<body <?php body_class(''); ?> >


<div id="change_wrap_div" class="  <?php if ($options["site_boxed"]) {
    echo ' boxed_lay';
} ?>">

    <?php
    if ($options["top_panel"]) {
        get_template_part('templates/section', 'panel');
    } ?>

    <?php get_template_part('templates/section', 'header'); ?>

    <?php include crum_template_path(); ?>

    <?php
    if ($options["footer_tw_disp"]) {
        get_template_part('templates/section', 'top-footer');
    }
    echo '<section id="footer">';
    get_footer();

    get_template_part('templates/section', 'bott-footer');

    echo '</section>';

    ?>



    <a href="#" id="linkTop" class="backtotop"></a>

</div>

<?php
if (isset($options["custom_js"])) {
    echo $options["custom_js"];
}

wp_footer();?>
</body>
</html>
