<?php
/*
Template Name: faq
*/
get_header();
include_once('include/breadcrumb-design.php');

$faq = new WP_Query(array(
    'post_type'         => 'faq',
    'posts_per_page'    => -1,
    'order'             => 'ASC'
));
?>

<div class="container mb-md-5 mb-0">
    <div class="row mb-md-3 mb-3">
        <div class="col-md-8 mx-auto accordion" id="accordion">
            <?php while ($faq->have_posts()) : $faq->the_post(); ?>
                <div class="card">
                    <?php $post_id =  get_the_ID(); ?>
                    <div class="card-header" id="heading<?php echo $post_id; ?>">
                        <h5 class="mb-0">
                            <button class="btn btn-link text-dark accordion-content" data-toggle="collapse" data-target="#collapse<?php echo $post_id; ?>" aria-expanded="true" aria-controls="collapse<?php echo $post_id; ?>">
                                <?php the_title(); ?>
                            </button>
                        </h5>
                    </div>

                    <div id="collapse<?php echo $post_id; ?>" class="collapse" aria-labelledby="heading<?php echo $post_id; ?>" data-parent="#accordion">
                        <div class="card-body text-dark">
                            <?php
                            the_content();
                            ?>
                        </div>
                    </div>
                </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </div>
    </div>

    <!-- Facebook Share Button -->
    <div class="fb-share-button d-flex justify-content-center mb-md-0 mb-3"
        data-href="<?php echo esc_url(get_permalink()); ?>"
        data-layout="button_count"
        data-size="large"
        data-mobile-iframe="true">
        <a class="fb-xfbml-parse-ignore" target="_blank"
            href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode(get_permalink()); ?>&amp;src=sdkpreparse">Share</a>
    </div>
</div>

<?php get_footer();
