<?php $options = get_option('maestro'); ?>

<?php

    if (has_post_thumbnail()) {
        $thumb = get_post_thumbnail_id();
        $img_url = wp_get_attachment_url($thumb, 'full'); //get img URL
    } else {
        $img_url = get_template_directory_uri() . '/img/no-image-large.jpg';
    }
    $article_image = aq_resize($img_url, 780, 320, true); //resize & crop img

$folio_video = false;

if (get_post_meta($post->ID, 'folio_vimeo_video_url', true) || get_post_meta($post->ID, 'folio_youtube_video_url', true) ||
    (get_post_meta($post->ID, 'folio_self_hosted_mp4', true) != '') || (get_post_meta($post->ID, 'folio_self_hosted_webm', true) != '')){
    $folio_video = true;
}
?>

<div class="project one-photo clearfix">
    <div class="eight columns">
        <div class="entry-thumb">
            <img src="<?php echo $article_image ?>" alt="<?php the_title(); ?>"/>
                                    <span class="hover-box">
                                        <a href="<?php the_permalink(); ?>" class="more-link"> </a>
                                        <a href="<?php echo $img_url; ?>" class="zoom-link"> </a>
                                    </span>
        </div>
    </div>
    <div class="four columns">
        <h4 class="box-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

        <span class="dopinfo"><?php get_template_part('templates/folio', 'terms'); ?></span>

        <div class="entry-content">
            <?php content(26);?>
        </div>
        <ul class="person-list">

            <?php
            if(function_exists('get_field_object')){

                $fields = get_post_custom_keys( get_the_id() );
                foreach( $fields as $key=>$field ){
                    substr( $field, 0, 1);
                    if(substr( $field, 0, 1) == '_')
                        unset($fields[$key]);
                }

                $fields = array_flip($fields);
                foreach($fields as $key=>$field){
                    $fields[$key] = get_post_meta($post->ID,$key, true);
                }
                //var_dump($fields);
                if( $fields ) {
                    foreach( $fields as $field_name => $value ) {

                        $field = get_field_object($field_name, false, array('load_value' => false));

                            if ($field_name == 'website_link'){

                                echo '<li class="field-link"><a href="http://'.$value.'">';
                                echo $value;
                                echo '</a></li>';
                            }else {
                                if($field['label'] != ''){
                                    echo '<li><strong>';
                                    echo $field['label'] . ':</strong> ';
                                    echo $value;
                                    echo '</li>';
                                }
                            }
                    }
                }} ?>
        </ul>
        <a href="<?php the_permalink();?>" class="button"><?php echo __('Read details', 'crum'); ?></a>
    </div>
</div>
