<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

    <?php

    $options = get_option('maestro');

    $tile_color = (isset ($options["main_site_color"])) ? $options["main_site_color"] : '#26bdef';
    ?>

    <meta charset="utf-8">

	<title><?php wp_title('|', true, 'right'); ?></title>
    <?php if (isset($options["custom_favicon"])) { ?>
        <link rel="icon" type="image/png" href="<?php echo $options["custom_favicon"] ?>">
    <?php
    }
    if (isset($options['responsive_mode']) &&(($options['responsive_mode'] == 'on')||($options['responsive_mode'] == ''))) {
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    } else {
        echo '<style type="text/css"> body {min-width:1200px;} </style>';
    }
    ?>


    <!--[if lte IE 9]>
    <script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->


	<?php if(isset($options['touch-device-icon']) && $options['touch-device-icon']):

		$img_url = $options['touch-device-icon'];

		?>

		<link href="<?php echo aq_resize($img_url, 152, 152, true); ?>" rel="apple-touch-icon" sizes='152x152'/>
		<link href="<?php echo aq_resize($img_url, 76, 76, true); ?>" rel="apple-touch-icon" sizes='76x76'/>
		<link href="<?php echo aq_resize($img_url, 120, 120, true); ?>" rel="apple-touch-icon" sizes='120x120'/>
		<link href="<?php echo aq_resize($img_url, 60, 60, true); ?>" rel="apple-touch-icon" sizes='60x60'/>

		<meta name="msapplication-square150x150logo" content="<?php echo aq_resize($img_url, 150, 150, true); ?>"/>
		<meta name="msapplication-TileImage" content="<?php echo aq_resize($img_url, 150, 150, true); ?>">
		<meta name="msapplication-TileColor" content="<?php echo $tile_color; ?>"/>
		<meta name="application-name" content="<?php bloginfo('name'); ?>" />

	<?php endif; ?>


    <?php wp_head(); ?>

    <?php  if (is_page()) {

    global $post;
    $p_bg_color = get_post_meta($post->ID, 'crum_page_custom_bg_color', true);
    $p_bg_image = get_post_meta($post->ID, 'crum_page_custom_bg_image', true);
    $p_bg_fixed = get_post_meta($post->ID, 'crum_page_custom_bg_fixed', true);
    $p_bg_repeat = get_post_meta($post->ID, 'crum_page_custom_bg_repeat', true);
    ?>

    <style type="text/css">
        body {
            <?php if ($p_bg_color && ($p_bg_color !='#ffffff') && ($p_bg_color !='#')){ ?> background-color: <?php echo $p_bg_color; ?>; <?php } ?>
            <?php if ($p_bg_image) { ?> background-image: <?php echo 'url("'.$p_bg_image.'") !important'?>;
            background-position: center 0  !important;
            background-repeat: <?php echo $p_bg_repeat; ?>  !important;
            <?php } if ($p_bg_fixed) { echo 'background-attachment: fixed  !important;'; } ?>
        }

        <?php if ($p_bg_color && $p_bg_image) { ?>
                #change_wrap_div {
                    background: #fff;
                    max-width: 1220px;
                    margin: 0 auto;
                    box-shadow: 0 0 6px 0 rgba(0, 0, 0, 0.2);
                }
        <?php } ?>

            </style>
        <?php } ?>

</head>

