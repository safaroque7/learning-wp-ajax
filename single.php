<?php
/*
Template Name: Blog
*/

get_header();
include_once('include/breadcrumb-design.php');
?>

<div class="container mb-3">
    <div class="row">

        <div class="col-md-9 col-12">
            <?php while (have_posts()): the_post(); ?>

            <div class="bg-white p-md-3 p-2">
                <div class="mb-md-3 mb-2">
                    <?php
                        if (has_post_thumbnail()) {
                            the_post_thumbnail('full', array('class' => 'img-fluid'));
                        } else { ?>
                    <img src="<?php echo get_template_directory_uri() . '/images/alter-image-1200x630.png' ?>" alt="">
                    <?php }
                        ?>
                </div>
                <?php setPostViews(get_the_ID()); ?>
                <h1> <?php the_title(); ?> </h1>

                <div class="border-bottom border-top mb-md-3 mb-2 py-1">
                    Posted: <?php the_time('l, j F Y'); ?>
                    | পড়া হয়েছে
                    <?php echo getPostViews(get_the_ID()); ?> বার
                </div>

                <?php the_content(); ?>
            </div>

            <?php endwhile;
            wp_reset_postdata(); ?>
        </div>

        <div class="col-md-3 col-12">
            <?php

            if (is_single()) {
                $current_post = get_the_ID();
            }

            $related_post = new WP_Query(array(
                'post_type'         =>  'post',
                'posts_per_page'    =>  10,
                'post__not_in'      =>  array($current_post),
                'order'             =>  'DESC'
            ));
            while ($related_post->have_posts()): $related_post->the_post();
            ?>
            <div class="bg-white mb-md-4 mb-2 p-md-3 p-2">
                <div class="mb-md-2 mb-1">
                    <a href="<?php the_permalink();?>">
                        <?php
                        if (has_post_thumbnail()) {
                            the_post_thumbnail('alter_blog_image_600_315', array('class' => 'img-fluid'));
                        } else { ?>
                        <img src="<?php echo get_template_directory_uri() . '/images/alter_blog_image_600_315.png'; ?>"
                            alt="<?php esc_html(get_the_title()); ?>">
                        <?php } ?>
                    </a>
                </div>
                <h6 class="lh-lg mb-0"> <a href="<?php the_permalink();?>" class="text-decoration-none text-dark">
                        <?php the_title(); ?> </a> </h6>
            </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </div>





    </div>
</div>

<?php get_footer(); ?>