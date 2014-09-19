<?php
/*
Template Name: Contacts page
*/

$options = get_option('maestro');
get_template_part('templates/top', 'page'); ?>

<section id="layout">

    <?php

    if ($options["cont_m_disp"]) {
        ?>

        <script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=false"></script>

        <div id="map"></div>

        <script type="text/javascript">
            jQuery(window).load(function () {
                jQuery("#map")<?php if ($options["cont_m_height"]) echo '.height("' . $options["cont_m_height"] . 'px")'; ?>.gmap3({
                    marker: {
                        address: "<?php echo $options["map_address"]; ?>"
                    },
                    map: {
                        options: {
                            zoom: 14,
                            navigationControl: true,
                            scrollwheel: false,
                            streetViewControl: true
                        }
                    }
                });
            });
        </script>

    <?php } ?>


    <div class="row">


        <?php
        global $post;

        $i = 0;
        $mypages = get_pages(array('child_of' => $post->ID, 'sort_column' => 'menu_order', 'sort_order' => 'asc', ));
        foreach ($mypages as $page) {

            $imgs = get_the_post_thumbnail($page->ID, 'post-thumbnails');
            $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $imgs, $matches);
            $img_url = $matches [1] [0];
            $article_image = aq_resize($img_url, 80, 80, true);

            $team_add = get_post_meta($page->ID, 'crum_page_custom_team_text', true);
            $team_desc = get_post_meta($page->ID, 'crum_page_custom_team_desc', true);

            if ($i % 3 == 0) {
                echo '</div><div class="row">';
            }

            ?>

            <div class="team-brick four columns <?php if (!next($mypages)) {echo 'end';} ?>">

                <div class="team-photo">
                    <a href="<?php echo get_page_link($page->ID); ?>">
                        <img src="<?php echo $article_image ?>" alt="<?php echo $page->post_title; ?>"/>
                    </a>

                    <h4><a href="<?php echo get_page_link($page->ID); ?>"><?php echo $page->post_title; ?></a></h4>
                    <span class="team-value"><?php echo $team_add; ?></span>
                </div>

                <div class="ovh">
                    <div class="team-desc">
                        <p><?php echo $team_desc ?></p>
                    </div>
                </div>

            </div>

            <?php
            $i++;
        } ?>

    </div>

    <div class="row">
        <div class="twelve columns contacts-text">

            <?php while (have_posts()) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; ?>

        </div>
    </div>

    <div class="row">
        <div class="four columns">
            <?php
            $ctf1 = get_post_meta($post->ID, 'contacts_page_f_1', true);
            echo $ctf1;
            ?>
        </div>

        <div class="two columns">
            <?php
            $ctf2 = get_post_meta($post->ID, 'contacts_page_f_2', true);
            echo $ctf2;
            ?>
        </div>

        <div class="six columns">

            <div class="page-block-title">
                <h2><?php _e('Leave reply', 'crum'); ?></h2>
            </div>

            <?php

            if ($options["custom_form_shortcode"]) {

                echo do_shortcode($options["custom_form_shortcode"]);

            } else {
                $admin_email = $options["contacts_form_mail"];


                if (empty($admin_email)) {
                    echo __('You need enter email in options panel', 'crum');
                } else {
                    if (isset($_POST['sender_name'])) {

                        if ($options["antispam_answer"] == $_POST['antispam_answer']) {
                            if (wp_mail($admin_email, "Subject: " . $_POST['letter_subject'] . "\tAuthor: " . $_POST['sender_name'] . "/" . $_POST['sender_email'], $_POST['letter_text']))
                                echo '<h2>' . __('Thank you for your message!' . '</h2>', 'crum');
                            else
                                echo '<h2>' . __('Unknown error, during message sending' . '</h2>', 'crum');
                        } else {
                            echo '<h2>' . __('Wrong check code. Please try again' . '</h2>', 'crum');
                        }

                    } else {
                        ?>
                        <form action="" method="POST" name="page_feedback" id="page_feedback">
                            <div class="commentform-inner">
                                <input id="sender_name" name="sender_name" type="text" required="required" placeholder="<?php _e('Enter your name', 'crum'); ?>">
                                <input id="sender_email" name="sender_email" type="email" required="required" placeholder="<?php _e('Your email', 'crum'); ?>">
                                <input id="letter_subject" name="letter_subject" type="text" required="required" placeholder="<?php _e('Mail subject', 'crum'); ?>">
                            </div>
                            <textarea id="letter_text" name="letter_text" required="required"></textarea>

                            <div class="row">
                                <div class="six columns">
                                    <p class="anti-spam-question"><?php echo $options["antispam_question"]; ?></p>
                                </div>
                                <div class="three columns">
                                    <input type="text" required="required" name="antispam_answer" class="text" id="antispam_answer">
                                </div>
                                <div class="three columns" style="text-align: right">
                                    <button class="button" name="submit"><?php _e('Leave reply', 'crum'); ?></button>
                                </div>
                            </div>
                        </form>

                    <?php
                    }
                }
            } ?>

        </div>

    </div>
</section>