<?php global $NHP_Options;

    if (!have_posts()) : ?>

    <article id="post-0" class="post no-results not-found">
        <header class="entry-header">
            <h1><?php _e( 'Nothing Found', 'crum' ); ?></h1>
        </header><!-- .entry-header -->

        <div class="entry-content">
            <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'crum' ); ?></p>
            <?php get_search_form(); ?>
        </div><!-- .entry-content -->


    <header class="entry-header">
        <h2><?php _e('Tags also can be used', 'crum'); ?></h2>
    </header><!-- .entry-header -->

    <div class="tags-widget">
        <?php wp_tag_cloud('smallest=10&largest=10&number=30'); ?>
    </div>

    </article><!-- #post-0 -->
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>

<article <?php post_class(); ?>>

       <header>
            <?php get_template_part('templates/entry-meta'); ?>

            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        </header>
        <div class="entry-content">
            <?php the_excerpt(); ?>
        </div>
</article>

<?php endwhile; ?>

<?php if ($wp_query->max_num_pages > 1) : ?>

<nav class="page-nav">
    <?php if (get_next_posts_link()) : ?>
        <span class="older"><?php next_posts_link(__('Older', 'crum')); ?></span>
    <?php endif; ?>
    <?php if (get_previous_posts_link()) : ?>
        <span class="newer"><?php previous_posts_link(__('Newer', 'crum')); ?></span>
    <?php endif; ?>
</nav>

<?php endif; ?>
