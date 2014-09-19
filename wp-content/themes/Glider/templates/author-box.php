<?php
/**
 * Author Box
 *
 * Displays author box with author description and thumbnail on single posts
 *
 * @package WordPress
 * @subpackage OneTouch theme, for WordPress
 * @since OneTouch theme 1.9
 */
?>

<?php $options = get_option('maestro'); ?>

<div class="about-author">
    <figure class="author-photo">
        <?php echo get_avatar( get_the_author_meta('ID') , 80 ); ?>
    </figure>
    <div class="ovh">
        <div class="author-description">
            <h6><?php the_author_posts_link(); ?></h6>
            <p><?php the_author_meta('description'); ?></p>
        </div>

        <?php if ($options["links_box_disp"]) {?>

        <div class="post-links">
            <ul>
                <li><a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php _e('All posts', 'crum'); ?></a></li>
                <li><a href="<?php the_author_meta('user_url'); ?>" rel="author" ><?php _e('Website', 'crum'); ?></a></li>
                <li><a href="mailto:<?php echo antispambot(get_the_author_email()); ?>" title="E-mail"><?php _e('Email', 'crum');?></a></li>
            </ul>
        </div>

        <?php } ?>

        <div class="share-icons">
            <?php if (get_the_author_meta('twitter')) {  echo '<a href="',the_author_meta('twitter'),'"><i class="icon-twitter-bird"></i></a>';  } ?>
            <?php if (get_the_author_meta('cr_facebook')) {  echo '<a href="',the_author_meta('cr_facebook'),'"><i class="icon-facebook-rect"></i></a>';  } ?>
            <?php if (get_the_author_meta('googleplus')) {  echo '<a href="',the_author_meta('googleplus'),'"><i class="icon-googleplus-rect"></i></a>';  } ?>
            <?php if (get_the_author_meta('linkedin')) {  echo '<a  href="',the_author_meta('linkedin'),'"><i class="icon-linkedin-rect"></i></a>';  } ?>
            <?php if (get_the_author_meta('vimeo')) {  echo '<a  href="',the_author_meta('vimeo'),'"><i class="icon-vimeo"></i></a>';  } ?>
            <?php if (get_the_author_meta('lastfm')) {  echo '<a  href="',the_author_meta('lastfm'),'"><i class="icon-lastfm"></i></a>';  } ?>
            <?php if (get_the_author_meta('tumblr')) {  echo '<a  href="',the_author_meta('tumblr'),'"><i class="icon-tumblr"></i></a>';  } ?>
            <?php if (get_the_author_meta('skype')) {  echo '<a  href="',the_author_meta('skype'),'"><i class="icon-skype"></i></a>';  } ?>
            <?php if (get_the_author_meta('vkontakte')) {  echo '<a  href="',the_author_meta('vkontakte'),'"><i class="icon-vkontakte-rect"></i></a>';  } ?>
            <?php if (get_the_author_meta('deviantart')) {  echo '<a  href="',the_author_meta('deviantart'),'"><i class="icon-deviantart"></i></a>';  } ?>
            <?php if (get_the_author_meta('picasa')) {  echo '<a  href="',the_author_meta('picasa'),'"><i class="icon-picasa"></i></a>';  } ?>
            <?php if (get_the_author_meta('wordpress')) {  echo '<a  href="',the_author_meta('wordpress'),'"><i class="icon-wordpress"></i></a>';  } ?>
            <?php if (get_the_author_meta('instagram')) {  echo '<a  href="',the_author_meta('instagram'),'"><i class="icon-instagram"></i></a>';  } ?>

        </div>
    </div>
</div>