<?php $options = get_option('maestro'); ?>

<section id="header" class="horizontal">

    <div class="row">

        <div class="twelve columns">

	        <?php if ($options['logotype_style'] != 'no') {

		        echo '<div id="logo">';

		        if ($options['logotype_style'] == 'txt') {
			        ?>
			        <h1><a href="<?php echo home_url(); ?>/"><?php echo $options['custom_logo_text']; ?></a></h1>
		        <?php } else { ?>
			        <a href="<?php echo home_url(); ?>/">
				        <img class="normal" src="<?php echo $options['custom_logo_image']; ?>" alt="<?php bloginfo('name'); ?>">
				        <?php if ($options['custom_logo_retina']) : ?><img class="retina" src="<?php echo $options['custom_logo_retina']; ?>" alt="<?php bloginfo('name'); ?>"><?php endif ?>
			        </a>
		        <?php
		        }
		        echo '</div>';

	        } ?>


	        <form role="search" method="get" id="searchform" class="form-search" action="<?php echo home_url(); ?>/">
                <label class="hide" for="s">Search for:</label>
                <input type="text" value="" name="s" id="s" class="s-field" placeholder="Enter request...">
                <input type="submit" id="searchsubmit" value=" " class="s-submit">

                <div class="cl"></div>
            </form>

            <div class="soc-head-icons">

                <?php
                $social_networks = array(
                    "fb" => "Facebook",
                    "gp" => "Google +",
                    "tw" => "Twitter",
                    "in" => "Instagram",
                    "vi" => "Vimeo",
                    "lf" => "Last FM",
                    "vk" => "Vkontakte",
                    "yt" => "YouTube",
                    "de" => "Devianart",
                    "li" => "LinkedIN",
                    "pi" => "Picasa",
                    "pt" => "Pinterest",
                    "wp" => "Wordpress",
                    "db" => "Dropbox",
                    "rss" => "RSS",
                );
                foreach ($social_networks as $short => $original) {
                    if ($options[$short . "_link"]) {
                        $link = $options[$short . "_link"];
                    } else {
                        $link = false;
                    }

                    if ($options[$short . "_show"]) {
                        $show = $options[$short . "_show"];
                    } else {
                        $show = false;
                    }
                    if ($options[$short . "_icon"]) {
                        $icon = $options[$short . "_icon"];
                    } else {
                        $icon = false;
                    }
                    if ($link && $link != 'http://' && $show)
                        echo '<a href="' . $link . '" class="' . $icon . '" title="' . $original . '"></a>';
                }
                ?>
            </div>

            <?php

            if ($options["top_adress_block"] != 'off') {
                ?>

                <?php echo $options["top_adress_field"]; ?>

                <?php if (isset($options["lang_shortcode"])) { ?>

                    <?php echo do_shortcode($options["lang_shortcode"]); ?>

                <?php } ?>

                <?php if ($options["wpml_lang_show"]) { ?>

                    <div class="lang-sel">
                        <a href="#"><img src="http://dev.crumina.net/glider/wp-content/themes/maestro/assets/img/lang-icon.png" alt="GB"></a>

                        <ul>
                            <?php
                            function language_selector_flags()
                            {
                                $languages = icl_get_languages('skip_missing=0&orderby=code');
                                if (!empty($languages)) {
                                    foreach ($languages as $l) {
                                        echo '<li>';
                                        echo '<a href="' . $l['url'] . '">';
                                        echo $l['translated_name'];
                                        echo '</a>';
                                        echo '</li>';
                                    }
                                }
                            }

                            language_selector_flags();

                            ?>
                        </ul>
                    </div>

                <?php } ?>

            <?php } ?>
        </div>
    </div>
    <div class="header-navi-wrap">
        <div class="header-navi">
            <div class="header-navi-inner">

	            <?php if ($options['logotype_style'] != 'no') {

		            echo '<div id="small-logo">';

		            if ($options['logotype_style'] == 'txt') {
			            ?>
			            <h1><a href="<?php echo home_url(); ?>/"><?php echo $options['custom_logo_text']; ?></a></h1>
		            <?php } else { ?>
			            <a href="<?php echo home_url(); ?>/">
				            <img src="<?php echo $options['custom_logo_image']; ?>" alt="<?php bloginfo('name'); ?>">
			            </a>
		            <?php
		            }
		            echo '</div>';

	            } ?>

	            <?php $top_menu_args = array('theme_location' => 'primary_navigation',
	                                         'container'      => false,
	                                         'depth'          => 3,
	                                         'fallback_cb'    => 'crum_menu_fallback',
	                                         'menu_class'     => 'menu-primary-navigation',
	                                         'walker'         => new Crum_Nav_Menu_Walker());
	            ?>
	            <?php wp_nav_menu($top_menu_args); ?>
                <div class="cl"></div>
            </div>
        </div>
    </div>
</section>