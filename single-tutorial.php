<?php get_header();
?>

<!--*** Contact us Section-1 Start *** -->
<div class="container-fluid vig-bg-photo position-relative px-0 mb-md-5 mb-2">
    <div class="vig-bg-color position-absolute d-flex align-items-center">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-6">
                    <p class="text-white display-4 font-weight-bold text-center mb-0 font-size-for-mobile">
                        Tutorial
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--*** Contact us Section-1 End *** -->

<div class="container mb-3">
    <div class="row">
        <div class="col-md-3 bg-white vl d-none d-md-block pb-md-3">
            <?php
            $args = array(
                'post_type'         => 'tutorial',
                'order'             => 'ASC',
                'posts_per_page'    => -1
            );
            $query = new WP_Query($args);
             
            $tutorial_serial_number = 1;
            while ($query->have_posts()) : $query->the_post(); ?>
            <h5 class="border-bottom py-2">
                <h5> <?php echo $tutorial_serial_number;?> </h5>
                <a class="text-dark" href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h5>
            <?php 
        $tutorial_serial_number++;    
        endwhile;
            wp_reset_postdata(); ?>
        </div>

        <div class="col-md-9">
            <!-- Mobile Dropdown for Tutorial Selection -->
            <div class="w-100 mb-2 d-block d-md-none">
                <select class="form-control" lang="bn" onchange="if(this.value) window.location.href=this.value;">
                    <option value="" disabled hidden selected>-- ভিডিও টিউটোরিয়াল সিলেক্ট করুন --</option>
                    <?php
                    $tutorial_serial_number = 1;
                    $main_query = new WP_Query($args);
                    if ($main_query->have_posts()) :
                        while ($main_query->have_posts()) : $main_query->the_post(); ?>
                    <option value="<?php the_permalink(); ?>"><?php echo $tutorial_serial_number . '. '; the_title(); ?>
                    </option>

                    <?php
                    $tutorial_serial_number++;
                        endwhile;
                        wp_reset_postdata();
                    else : ?>
                    <option disabled>কোনো আইটেম পাওয়া যায়নি।</option>
                    <?php endif; ?>
                </select>
            </div>

            <!-- Show the Latest Video -->
            <?php
            // ইউটিউব ভিডিও লিংককে embed URL এ কনভার্ট করার ফাংশন
            function convert_to_embed_url($url)
            {
                if (strpos($url, 'watch?v=') !== false) {
                    return str_replace('watch?v=', 'embed/', $url);
                } elseif (strpos($url, 'youtu.be/') !== false) {
                    return str_replace('youtu.be/', 'www.youtube.com/embed/', $url);
                }
                return $url;
            }

            if (have_posts()) :
                while (have_posts()) : the_post();
                    $video_url = get_field('youtubeVideoLink');
                    $embed_url = convert_to_embed_url($video_url);
                    if ($embed_url) :
            ?>
            <div class="embed-responsive embed-responsive-16by9 mb-md-3 mb-1">
                <iframe src="<?php echo esc_url($embed_url); ?>?rel=0&autoplay=1&autohide=1&showinfo=0" frameborder="0"
                    allowfullscreen loading="lazy"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share">
                </iframe>
            </div>
            <h6><?php the_title(); ?></h6>
            <?php
                    endif;
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</div>

<?php get_footer();