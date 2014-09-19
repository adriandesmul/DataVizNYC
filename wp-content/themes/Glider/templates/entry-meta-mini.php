<div class="entry-meta post-info">
    <span class="entry-date"><?php echo get_the_date(); ?></span>

    <span class="byline author vcard"><?php echo __('By', 'crum'); ?> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?php echo get_the_author(); ?></a></span>

    <span class="post-tags">, <?php echo __('in', 'crum') . ' '; the_tags('',', ',''); ?></span>

</div>