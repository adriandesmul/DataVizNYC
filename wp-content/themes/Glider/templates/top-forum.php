<?php $options = get_option('maestro');

global $post;
$custom_head_img = get_post_meta( $post->ID, 'crum_headers_bg_img', true );
$custom_head_color = get_post_meta( $post->ID, 'crum_headers_bg_color', true );


if ($options['stan_header']) {echo '<div id="stuning-header" style="';

	if ($custom_head_img) { echo 'background-image: url('.$custom_head_img.');  background-position: center;';}
    elseif
	($custom_head_color && ($custom_head_color !='#ffffff')) { echo ' background-color: '.$custom_head_color.'; ';}

	if ($options['stan_header_image']) { echo 'background-image: url('.$options['stan_header_image'].');  background-position: center;';}
    elseif
	($options['stan_header_color']) { echo ' background-color: '.$options['stan_header_color'].'; ';}

    echo '">';
} ?>

<div class="row">
    <div class="twelve columns">
        <div id="page-title">
            <a href="javascript:history.back()" class="back"></a>
            <div class="page-title-inner">
                <h1 class="page-title">
                    <?php the_title()  ?>
                </h1>
                <div class="breadcrumbs">

                    <?php

                    function custom_bbp_breadcrumb() {
                        $args['before']  = '<nav id="crumbs" xmlns:v="http://rdf.data-vocabulary.org/#">';
                        $args['after']   = '</nav>';
                        $args['sep']     = '<span class="del">·</span>';
                        $args['home_text'] = __( 'Home', 'crum' );
                        return $args;
                    }
                    add_filter('bbp_before_get_breadcrumb_parse_args', 'custom_bbp_breadcrumb' );

                    bbp_breadcrumb();
                    ?>

                </div>
            </div>


        </div>
    </div>
</div>
<?php if ($options['stan_header']) {echo '</div>';} ?>