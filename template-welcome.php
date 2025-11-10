<?php
/*
Template Name: Template Welcome
*/
get_header();

// themes
get_template_part('part/hero-section');

// themes
get_template_part('part/themes');

// testimonial
get_template_part('part/review');

// achievement-section
get_template_part('part/achievement-section');
?>



<div class="container mb-3">

    <h3 class="mb-md-4 mb-2">

        <?php
        $blog_themes_page_id = get_theme_mod('blog_themes_page', 'থিম পেইজ সিলেক্ট হবে');
        $page_id = $blog_themes_page_id;

        $page = get_post($page_id); // get_post() দিয়ে পেজ অবজেক্ট পাওয়া যায়
        ?>
        <a class="text-dark text-decoration-underline" href="<?php echo get_permalink($page_id); ?>">
            <?php echo esc_html($page->post_title); ?>
        </a>
    </h3>


    <div class="row">

        <?php

        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => 2,
            'order'          => 'DESC',
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
                        | পড়া হয়েছে
                        <?php echo getPostViews(get_the_ID()); ?> বার
                    </div>
                    <?php echo wp_trim_words(get_the_content(), 25, '...'); ?>
                </div>
            </div>
        <?php endwhile;
        wp_reset_postdata(); ?>

    </div>
</div>



<?php

//footer
get_footer();
