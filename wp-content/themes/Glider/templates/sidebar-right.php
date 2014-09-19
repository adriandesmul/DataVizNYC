<aside class="three columns" id="right-sidebar">

    <?php

    if(is_single()){
        global $post;
        $page_id = $post->ID;
    } else {
        $page_id     = get_queried_object_id();
    }

    $selected_sidebar = get_post_meta($page_id, 'crum_sidebars_sidebar_2', true);

    if ($selected_sidebar && (function_exists('smk_sidebar'))) {

        smk_sidebar($selected_sidebar);

    } else {

        dynamic_sidebar('sidebar-right');

    }
    ?>


  </aside>
