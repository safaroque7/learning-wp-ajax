<?php

/**
 * Template Name: Blog
 */
get_header();
include_once('include/breadcrumb-design.php');
?>


<!-- Main container start -->
<div class="container py-4">

    <!-- Page header -->
    <div class="d-flex justify-content-between align-items-center mb-4 bg-white d-block p-md-3 p-2">
        <h1 class="h3 mb-0"><?php single_post_title('সাম্প্রতিক ব্লগ পোস্ট'); ?></h1>
        <div>
            <!-- Sort / filter buttons (static for now, can be linked later) -->
            <div class="btn-group" role="group" aria-label="Sort">
                <button class="btn btn-outline-secondary btn-sm">সর্বশেষ</button>
                <button class="btn btn-outline-secondary btn-sm">জনপ্রিয়</button>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Blog grid (main) -->
        <div class="col-lg-8">
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <?php
                // WP Query (Main Loop)
                if (have_posts()) :
                    while (have_posts()) : the_post(); ?>
                        <div class="col">
                            <article class="card card-post h-100 overflow-hidden">
                                <div class="position-relative">
                                    <?php
                                    if (has_post_thumbnail()) :
                                        the_post_thumbnail('large', array('class' => 'card-img-top'));
                                    else : ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/main-logo.png" class="card-img-top" alt="<?php the_title(); ?>">
                                    <?php endif; ?>

                                    <?php
                                    $categories = get_the_category();
                                    if (!empty($categories)) :
                                        $cat_name = esc_html($categories[0]->name);
                                        $cat_color = 'primary'; // চাইলে ক্যাটাগরিভিত্তিক রঙ দিতে পারেন
                                    ?>
                                        <span class="badge bg-<?php echo $cat_color; ?> text-white badge-cat">
                                            <?php echo $cat_name; ?>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div class="card-body d-flex flex-column">
                                    <h2 class="h5 card-title mb-2">
                                        <a href="<?php the_permalink(); ?>" class="stretched-link text-decoration-none">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>

                                    <p class="card-text post-excerpt mb-2">
                                        <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                    </p>

                                    <div class="mt-auto d-flex justify-content-between align-items-center">
                                        <div class="post-meta">
                                            লেখক: <strong><?php the_author(); ?></strong> • <?php echo get_the_date('j M, Y'); ?>
                                        </div>
                                        <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline-primary">আরও পড়ুন</a>
                                    </div>
                                </div>
                            </article>
                        </div>
                <?php
                    endwhile;
                else :
                    echo '<p>কোনো পোস্ট পাওয়া যায়নি।</p>';
                endif;
                ?>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                <?php
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => 'আগে',
                    'next_text' => 'পরবর্তী',
                ));
                ?>
            </div>
        </div>

        <!-- Sidebar -->
        <aside class="col-lg-4">
            <div class="sticky-top" style="top:80px">

                <!-- Search -->
                <div class="mb-4">
                    <?php get_search_form(); ?>
                </div>

                <!-- Categories -->
                <div class="mb-4">
                    <h6 class="mb-2">ক্যাটাগরি</h6>
                    <ul class="list-group list-group-flush">
                        <?php
                        $categories = get_categories(array(
                            'orderby' => 'name',
                            'order'   => 'ASC'
                        ));
                        foreach ($categories as $category) :
                        ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="<?php echo get_category_link($category->term_id); ?>">
                                    <?php echo esc_html($category->name); ?>
                                </a>
                                <span class="badge bg-secondary"><?php echo $category->count; ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Recent posts -->
                <div class="mb-4 bg-white p-md-3 p-2">
                    <h6 class="mb-2">সর্বশেষ পোস্ট</h6>
                    <ul class="list-unstyled">
                        <?php
                        $recent_posts = wp_get_recent_posts(array(
                            'numberposts' => 4,
                            'post_status' => 'publish'
                        ));
                        foreach ($recent_posts as $post) :
                        ?>
                            <li class="d-flex mb-3">
                                <?php if (has_post_thumbnail($post['ID'])) : ?>
                                    <img src="<?php echo get_the_post_thumbnail_url($post['ID'], 'thumbnail'); ?>" class="me-2 rounded img-fluid" alt="<?php echo esc_attr($post['post_title']); ?>">
                                <?php else : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/default-thumb.jpg" class="me-2 rounded img-fluid" alt="default">
                                <?php endif; ?>
                                <div>
                                    <a href="<?php echo get_permalink($post['ID']); ?>" class="d-block text-truncate">
                                        <?php echo esc_html($post['post_title']); ?>
                                    </a>
                                    <small class="d-block text-muted">
                                        <?php echo get_the_date('j M, Y', $post['ID']); ?>
                                    </small>
                                </div>
                            </li>
                        <?php endforeach;
                        wp_reset_query(); ?>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div class="card">
                    <div class="card-body">
                        <h6>নিউজলেটার সাবস্ক্রাইব</h6>
                        <form action="#" method="post">
                            <div class="mb-2">
                                <input type="email" name="newsletter_email" class="form-control form-control-sm" placeholder="তোমার ইমেইল" required>
                            </div>
                            <button class="btn btn-sm btn-primary w-100" type="submit">সাবস্ক্রাইব</button>
                        </form>
                    </div>
                </div>

            </div>
        </aside>
    </div>
</div>
<!-- Main container end -->





<?php get_footer(); ?>