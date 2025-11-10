<!-- Themes Start -->
<div class="container mb-5">
  <h3 class="mb-md-4 mb-2">

    <?php
    $select_themes_page_id = get_theme_mod('select_themes_page', 'থিম পেইজ সিলেক্ট হবে');
    $page_id = $select_themes_page_id;

    $page = get_post($page_id); // get_post() দিয়ে পেজ অবজেক্ট পাওয়া যায়
    ?>
    <a class="text-dark text-decoration-underline" href="<?php echo get_permalink($page_id); ?>">
      <?php echo esc_html($page->post_title); ?>
    </a>
  </h3>

  <div class="row">
    <?php
    $args = array(
      'post_type'         => 'themes', // if you want to further filter by post_type
      'order'             => 'ASC',
      'posts_per_page'    =>  6
    );
    $query = new WP_Query($args);

    //  start quering
    while ($query->have_posts()): $query->the_post();
      get_template_part('part/theme-query');
    endwhile;
    wp_reset_postdata();
    ?>
  </div>
</div>
<!-- Themes End -->