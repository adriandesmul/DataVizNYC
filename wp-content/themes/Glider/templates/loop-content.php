<?php $options = get_option('maestro');

$image_crop = isset($options['thumb_image_crop']);
if ($image_crop == "") {$image_crop = true;}
?>

<article <?php post_class(); ?>>

    <div class="post-media">
        <?php

        if (has_post_format('video')) {
            get_template_part('templates/post', 'video');
        } elseif (has_post_format('audio')) {
            get_template_part('templates/post', 'audio');
        } elseif (has_post_format('gallery')) {
            get_template_part('templates/post', 'gallery');
        } else {

            if (has_post_thumbnail()) {
                $thumb = get_post_thumbnail_id();
                $img_url = wp_get_attachment_url($thumb, 'full'); //get img URL
                if ($options['post_thumbnails_width'] != '' && $options['post_thumbnails_height'] != '') {
                    $article_image = aq_resize($img_url, $options['post_thumbnails_width'], $options['post_thumbnails_height'], $image_crop);
                } else {
                    $article_image = aq_resize($img_url, 1200, 500, $image_crop);
                }

                ?>

                <div class="entry-thumb">
                    <img src="<?php echo $article_image ?>" style="margin:0 0;" alt="<?php the_title();?>" title="<?php the_title();?>">
                    <span class="hover-box">
                        <a href="<?php the_permalink(); ?>" class="more-link"> </a>
                        <a href="<?php echo $img_url; ?>" class="zoom-link"> </a>
                    </span>
                </div>

            <?php
            }
        } ?>

    </div>


    <div class="clearfif cl">
        <header>
            <time class="updated" datetime="<?php echo get_the_time('c'); ?>">
                <span class="day"><?php echo get_the_date('d'); ?></span>
                <span class="month"><?php echo get_the_date('M'); ?></span>
            </time>

            <span class="icon-format"></span>

            <div class="header-wrap ovh">
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <?php get_template_part('templates/entry-meta'); ?>
            </div>
        </header>
        <div class="entry-content">
            <?php the_excerpt();  ?>
        </div>
    </div>

</article>