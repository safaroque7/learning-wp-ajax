<?php
/*
Template Name: Blog
*/

get_header();
include_once('include/breadcrumb-design.php');
?>

<div class="container mb-3">
    <div class="row">

        <?php
        // Pagination জন্য page number
        $paged = max(1, get_query_var('paged'), get_query_var('page'));

        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => 10,
            'order'          => 'DESC',
            'paged'          => $paged
        );

        $query = new WP_Query($args);

        while ($query->have_posts()) : $query->the_post(); ?>
            <div class="col-md-6 col-12 mb-md-4 mb-2">
                <div class="bg-white p-md-3 p-2">
                    <div class="mb-md-3 mb-2">
                        <?php
                        if (has_post_thumbnail()) {
                            the_post_thumbnail('alter_blog_image_600_315', array('class' => 'img-fluid'));
                        } else { ?>
                            <img src="<?php echo get_template_directory_uri() . '/images/alter_blog_image_600_315.png'; ?>"
                                alt="<?php esc_html(get_the_title()) ?>">
                        <?php } ?>
                    </div>
                    <h3><a href="<?php the_permalink(); ?>" class="text-dark"><?php the_title(); ?></a></h3>
                    <div class="border-bottom border-top mb-md-3 mb-2 py-1">
                        <?php the_time('l, j F Y'); ?>
                    </div>
                    <?php echo wp_trim_words(get_the_content(), 25, '...'); ?>
                </div>
            </div>
        <?php endwhile; ?>

        <!-- Bootstrap 4 Pagination -->
        <div class="col-12">
            <?php
            $big = 999999999; // unlikely integer
            $pagination = paginate_links(array(
                'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format'    => '?paged=%#%',
                'current'   => $paged,
                'total'     => $query->max_num_pages,
                'prev_text' => '&laquo; Prev',
                'next_text' => 'Next &raquo;',
                'type'      => 'array' // array হিসেবে নিলে Bootstrap styling সহজ
            ));

            if (is_array($pagination)) {
                echo '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">';
                foreach ($pagination as $page) {
                    // active page এবং disabled class handle করা
                    if (strpos($page, 'current') !== false) {
                        echo '<li class="page-item active">' . str_replace('page-numbers', 'page-link', $page) . '</li>';
                    } else {
                        echo '<li class="page-item">' . str_replace('page-numbers', 'page-link', $page) . '</li>';
                    }
                }
                echo '</ul></nav>';
            }
            ?>
        </div>

        <?php wp_reset_postdata(); ?>

    </div>
</div>

<?php get_footer(); ?>