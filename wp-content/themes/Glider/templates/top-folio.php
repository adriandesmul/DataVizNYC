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
                    <?php $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));

                    $page = $options["portfolio_page_select"];
                    $title = get_the_title($page);

                    if ($term) {
                        echo $term->name;
                    } elseif (is_post_type_archive()) {
                        echo get_queried_object()->labels->name;
                    } else {
                        the_title();
                    } ?>
                    </h1>

                <div class="breadcrumbs">
                    <nav id="crumbs" xmlns:v="http://rdf.data-vocabulary.org/#"><span typeof="v:Breadcrumb"><a rel="v:url" property="v:title"  href="<?php echo home_url(); ?>/"><?php _e('Home', 'crum') ?></a></span> <span class="del">·</span> <span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="<?php echo home_url() . '/' . the_slug($page); ?>/"><?php echo $title; ?></a></span> <span class="del">·</span> <?php the_title(); ?></nav>

                </div>
            </div>

                <?php while (have_posts()) : the_post(); ?>
                <nav class="page-nav">
                    <?php
                    ob_start();
                    previous_post_link( '%link');
                    $link = ob_get_clean();
                    echo str_replace('<a ','<a class="older" ', $link);

                    ob_start();
                    next_post_link( '%link');
                    $link = ob_get_clean();
                    echo str_replace('<a ','<a class="newer" ', $link);
                    ?>
                </nav>
                <?php endwhile; ?>
        </div>
    </div>
</div>
<?php if ($options['stan_header']) {echo '</div>';} ?>