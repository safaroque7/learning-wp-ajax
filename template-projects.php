<?php
/*
Template Name: Projects
*/
get_header();
include_once('include/breadcrumb-design.php');
?>
<!-- *****Header Section End***** -->



<div class="container-fluid">
    <div class="container">
        <div class="row">
            <?php
            $custom_post = new WP_Query(array(
                'post_type'         =>  'project',
                'posts_per_page'    =>  -1,
                'order'             =>  'ASC'
            ));

            while ($custom_post->have_posts()): $custom_post->the_post(); {
                    $image_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
            ?>

                    <div class="col-md-6 col-12 mb-md-4 mb-3">
                        <div class="border border-wnd p-md-3 p-2 rounded">
                            <?php if (has_post_thumbnail()) { ?>
                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title(); ?>"
                                    class="img-fluid rounded">
                            <?php } ?>
                        </div>
                    </div>
            <?php }
            endwhile;
            wp_reset_postdata(); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>