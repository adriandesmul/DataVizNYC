<?php $options = get_option('maestro');

if (is_page() || is_single() || is_singular() ) {
    global $post;
    $custom_head_img = get_post_meta( $post->ID, 'crum_headers_bg_img', true );
    $custom_head_color = get_post_meta( $post->ID, 'crum_headers_bg_color', true );
}



if (isset($options['stan_header']) && $options['stan_header']) {echo '<div id="stuning-header" style="';
    if ($custom_head_img) { echo 'background-image: url('.$custom_head_img.');  background-position: center;';}
	elseif ($custom_head_color && !($custom_head_color =='#ffffff') && !($custom_head_color == '#')) { echo ' background-color: '.$custom_head_color.'; ';}
	elseif (isset($options['stan_header_image']) && $options['stan_header_image']) { echo 'background-image: url('.$options['stan_header_image'].');  background-position: center;';}
	elseif (isset($options['stan_header_color']) && $options['stan_header_color']) { echo ' background-color: '.$options['stan_header_color'].'; ';}
    echo '">';
}  ?>

<div class="row">
    <div class="twelve columns">
        <div id="page-title">
            <a href="javascript:history.back()" class="back"></a>
            <div class="page-title-inner">
                <h1 class="page-title">
                    <?php 
                    if (is_home()) {
                        if (get_option('page_for_posts', true)) {
                            echo get_the_title(get_option('page_for_posts', true));
                        } else {
                            _e('Latest Posts', 'crum');
                        }

                    } elseif (is_archive()) {
                        $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                        if ($term) {
                            echo $term->name;
                        } elseif (is_post_type_archive()) {
                            echo get_queried_object()->labels->name;
                        } elseif (is_day()) {
                            printf(__('Daily Archives: %s', 'crum'), get_the_date());
                        } elseif (is_month()) {
                            printf(__('Monthly Archives: %s', 'crum'), get_the_date('F Y'));
                        } elseif (is_year()) {
                            printf(__('Yearly Archives: %s', 'crum'), get_the_date('Y'));
                        } elseif (is_author()) {
                            global $post;
                            $author_id = $post->post_author;

                            $curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
                            $google_profile = get_the_author_meta('google_profile', $curauth->ID);
                            if ($google_profile) {
                                printf(__('Author Archives:', 'crum'));
                                echo '<a href="' . esc_url($google_profile) . '" rel="me">' . $curauth->display_name . '</a>'; ?></a>
                                <?php } else {
                                printf(__('Author Archives: %s', 'crum'), get_the_author_meta('display_name', $author_id));
                            }

                        } else {
                            single_cat_title();
                        }
                    } elseif (is_search()) {
                        printf(__('Search Results for %s', 'crum'), get_search_query());
                    } elseif (is_404()) {
                        _e('File Not Found', 'crum');
                    } else {
                        the_title();
                    } 
                    ?>
                </h1>
                <div class="breadcrumbs">
                    <?php if (function_exists('crumina_breadcrumbs')) crumina_breadcrumbs(); ?>
                </div>
            </div>

        </div>
    </div>
</div>
<?php if ($options['stan_header']) {echo '</div>';} ?>
