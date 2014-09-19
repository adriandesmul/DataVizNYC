<?php $options = get_option('maestro'); ?>

<div id="top-panel" class="open">
    <div class="row">
        <div class="top-panel-inner">

            <?php if ($options["top_panel_login"] !='off') { ?>

            <div class="three columns">
                <div class="top-login">
                    <?php

                    if (!is_user_logged_in()) {

                        $args = array(
                            'redirect' => admin_url(),//Your url here
                            'form_id' => 'loginform-custom',
                        );
                        wp_login_form( $args );

                    } else {
                        global $user_login;
                        get_currentuserinfo();
                        $current_user = wp_get_current_user(); ?>

                        <h3><?php _e('Welcome', 'crum'); echo ', ' . $user_login . '!'; ?></h3>
                        <div class="top-avatar">
                            <?php if (($current_user instanceof WP_User)) {
                                echo get_avatar($current_user->user_email, 80);
                            }
                            ?>
                        </div>

                        <div class="links">
                            <?php wp_loginout(); ?> &nbsp;&nbsp; <?php  wp_register('', ''); ?>
                        </div>


                    <?php } ?>
                </div>
            </div>
            <div class="eight columns offset-by-one top-text">
                <?php } else { ?>
            <div class="twelve columns top-text">
                <?php } ?>

                <i class="icon <?php
                    if (isset($options["top_panel_icon"])) {
                        echo $options["top_panel_icon"];
                    } else {
                        echo 'awesome-list';
                    } ?>">
                </i>
                <div class="title"><?php echo $options["top_panel_title"]; ?></div>
                <?php echo $options["top_panel_text"]; ?>

                <div class="soc-icons">
                    <?php
                    $social_networks = array(
                        "fb"=>"Facebook",
                        "gp"=>"Google +",
                        "tw"=>"Twitter",
                        "in"=>"Instagram",
                        "vi"=>"Vimeo",
                        "lf"=>"Last FM",
                        "vk"=>"Vkontakte",
                        "yt"=>"YouTube",
                        "de"=>"Devianart",
                        "li"=>"LinkedIN",
                        "pi"=>"Picasa",
                        "pt"=>"Pinterest",
                        "wp"=>"Wordpress",
                        "db"=>"Dropbox",
                        "rss"=>"RSS",
                    );
                    foreach($social_networks as $short=>$original){
                        $link = $options[$short."_link"];
                        $icon = $options[$short."_icon"];
                        if( $link  !='' && $link  !='http://' )
                            echo '<a href="'.$link .'" class="'.$icon.'" title="'.$original.'"></a>';
                    }
                    ?>

                </div>
            </div>
        </div>
        <a id="open-top-panel" href="#"></a>
    </div>
</div>