
<?php while (have_posts()) : the_post(); ?>
  <?php the_content(); ?>
  <?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
<?php endwhile; ?>

<?php    if ((isset($options["autor_box_disp"]))&&( $options["autor_box_disp"] =='1')){

    get_template_part('templates/author-box');

} ?>

