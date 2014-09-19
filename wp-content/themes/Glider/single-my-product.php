<?php $options = get_option('maestro'); ?>
<?php global $data;
$is_full = ($options["portfolio_single_style"] == 'full');

get_template_part('templates/top', 'folio'); ?>

    <section id="layout">

    <div class="row project one-photo">

        <div class="<?php echo ($is_full) ? 'twelve' : 'eight'; ?> columns">

            <?php

            $folio_video = false;

            if (!post_password_required(get_the_id())) {
            $custom = get_post_custom($post->ID);

            if (get_post_meta($post->ID, 'folio_vimeo_video_url', true)): ?>

                <div class="flex-video widescreen vimeo">
                    <iframe src='https://player.vimeo.com/video/<?php echo get_post_meta($post->ID, 'folio_vimeo_video_url', true); ?>?portrait=0' width='640' height='460' frameborder='0'></iframe>
                </div>

                <?php $folio_video = true; endif;

            if (get_post_meta($post->ID, 'folio_youtube_video_url', true)): ?>

                <div class="flex-video  widescreen">
                    <iframe width="640" height="460" src="https://www.youtube.com/embed/<?php echo get_post_meta($post->ID, 'folio_youtube_video_url', true); ?>?wmode=transparent" frameborder="0" class="youtube-video" allowfullscreen></iframe>
                </div>

                <?php $folio_video = true; endif;

            if ((get_post_meta($post->ID, 'folio_self_hosted_mp4', true) != '') || (get_post_meta($post->ID, 'folio_self_hosted_webm', true) != '')) {

                if (has_post_thumbnail()) {
                    $thumb = get_post_thumbnail_id();
                    $img_url = wp_get_attachment_url($thumb, 'full'); //get img URL
                    $article_image = aq_resize($img_url, 640, 460, true); ?>

                <?php } ?>

                <link href="https://vjs.zencdn.net/c/video-js.css" rel="stylesheet">
                <script src="https://vjs.zencdn.net/c/video.js"></script>


                <video id="video-post<?php the_ID(); ?>" class="video-js vjs-default-skin" controls
                       preload="auto"
                       width="640"
                       height="460"
                       poster="<?php echo $article_image ?>"
                       data-setup="{}">


                    <?php if (get_post_meta($post->ID, 'folio_self_hosted_mp4', true)): ?>
                        <source src="<?php echo get_post_meta($post->ID, 'folio_self_hosted_mp4', true) ?>" type='video/mp4'>
                    <?php endif; ?>
                    <?php if (get_post_meta($post->ID, 'folio_self_hosted_webm"', true)): ?>
                        <source src="<?php echo get_post_meta($post->ID, 'folio_self_hosted_webm"', true) ?>" type='video/webm'>
                    <?php endif; ?>
                </video>


                <?php
                $folio_video = true;

            }?>
			<?php
			if (metadata_exists('post', $post->ID, '_my_product_image_gallery')) {
				$my_product_image_gallery = get_post_meta($post->ID, '_my_product_image_gallery', true);
			} else {
				// Backwards compat
				$attachment_ids = get_posts('post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids');
				$attachment_ids = array_diff($attachment_ids, array(get_post_thumbnail_id()));
				$my_product_image_gallery = implode(',', $attachment_ids);
			}

			$attachments = array_filter(explode(',', $my_product_image_gallery));

			if ($attachments) {


				echo '<div id="my-work-slider" class="loading"><ul class="slides">';

				foreach ($attachments as $attachment_id) {

					$image_attributes = wp_get_attachment_image_src($attachment_id); // returns an array

					$thumb_image = aq_resize($image_attributes[0], 63, 63, true);

					echo '<li data-thumb="' . $thumb_image . '">';

					echo wp_get_attachment_image($attachment_id, 'full');

					echo '</li>';
				}
				echo '  </ul></div>';
			} elseif (has_post_thumbnail() && (!$embed_url)) {

				$thumb = get_post_thumbnail_id();
				echo wp_get_attachment_image($thumb, 'full');
			}
			?>

    </div>

    <div class="folio-info <?php echo $is_full ? 'twelve' : 'four'; ?> columns">

        <?php while (have_posts()) : the_post(); ?>

            <div class="dopinfo">
                <?php if ($options["folio_date"] != '') {
                    echo '<time>' . get_the_date() . '</time>';
                } ?>

                <?php get_template_part('templates/folio', 'terms'); ?></span>

                <?php the_tags('<span class="delim">&nbsp;</span> <span class="tags">', ', ', '</span>'); ?>

            </div>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>

            <ul class="person-list">

                <?php
                if (function_exists('get_field_object')) {

                    $fields = get_post_custom_keys(get_the_id());
                    foreach ($fields as $key => $field) {
                        substr($field, 0, 1);
                        if (substr($field, 0, 1) == '_')
                            unset($fields[$key]);
                    }

                    $fields = array_flip($fields);
                    foreach ($fields as $key => $field) {
                        $fields[$key] = get_post_meta($post->ID, $key, true);
                    }
                    //var_dump($fields);
                    if ($fields) {
                        foreach ($fields as $field_name => $value) {

                            $field = get_field_object($field_name, false, array('load_value' => false));

                            if ($field_name == 'website_link') {

                                echo '<li class="field-link"><a href="http://' . $value . '">';
                                echo $value;
                                echo '</a></li>';
                            } else {
                                if ($field['label'] != '') {
                                    echo '<li><strong>';
                                    echo $field['label'] . ':</strong> ';
                                    echo $value;
                                    echo '</li>';
                                }
                            }
                        }
                    }
                } ?>
            </ul>
        <?php endwhile; ?>

        <?php

        if ($options["post_share_button"]) {
            ; ?>

            <!--social share buttons start-->
            <?php get_template_part('templates/project', 'social'); ?>
            <!--social share ends-->
        <?php } ?>

    </div>
    </div>

    <?php
    } else the_content();


    if ($options["recent_items_disp"]) { ?>

        <div class="row">
            <div class="twelve columns">

                <?php the_widget('crum_recent_works', '', 'before_title=<h3 class="widget-title">&after_title=</h3>'); ?>

            </div>

        </div>
    <?php } ?>


    </section>

<?php if ($options['portfolio_single_slider']  != 'full') { ?>
	<script type="text/javascript">
		jQuery(window).load(function () {
			var target_flexslider = jQuery('#my-work-slider');
			target_flexslider.flexslider({
				namespace: "my-work-",
				animation: "slide",
				controlNav: "thumbnails",
				smoothHeight: true,
				directionNav: false,

				start: function (slider) {
					slider.removeClass('loading');
				}

			});
		});

	</script>
<?php } ?>

