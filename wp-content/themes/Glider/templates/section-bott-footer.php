<?php $options = get_option('maestro'); ?>

<section id="sub-footer">
    <div class="row">
        <div class="six mobile-two columns copyr">

                <?php if (isset($options["logo_footer"])) ?> <img src = "<?php echo $options["logo_footer"]; ?>" alt="logo" class="foot-logo" />

                <?php echo $options["copyright_footer"]; ?>

        </div>
        <div class="six mobile-two columns">

            <?php wp_nav_menu(array('theme_location' => 'footer_menu', 'container' => 'nav', 'fallback_cb' => 'false', 'menu_class' => 'footer-menu')); ?>

        </div>
    </div>
</section>