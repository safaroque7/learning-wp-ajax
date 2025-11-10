<!-- Testimonial Start -->
<div class="container-fluid mb-5">
    <div class="container">
        <div class="row">
            <!-- Facebook Review Part Start -->
            <div class="col-md-6 col-12 mb-md-0 mb-4 testimonial">

                <?php
                $post_type      =  'review';
                $count_posts    =   wp_count_posts($post_type);
                $total_post     =   $count_posts->publish;
                ?>
                <h3 class="mb-md-4 mb-2 review">
                    <a class="text-dark" href="<?php echo esc_url('https://www.facebook.com/webnewsdesign/reviews'); ?>"
                        target="_blank"> Facebook Reviews (<?php echo esc_html($total_post); ?>)
                    </a>
                </h3>

                <div class="flexslider flexslider-facebook carousel">
                    <ul class="slides">

                        <?php
                        $custom_post = new WP_Query(array(
                            'post_type'         =>  $post_type,
                            'posts_per_page'    =>  -1,
                            'order'             =>  'ASC'
                        ));

                        while ($custom_post->have_posts()): $custom_post->the_post(); { ?>

                                <!-- per item start -->
                                <li class="row d-flex align-items-center bg-white rounded-wnd">
                                    <div class="col-12 p-md-4 p-md-2 p-3 text-align-justify-wnd">
                                        <div>
                                            <?php $image_url = get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>
                                            <div class="d-flex align-items-center justify-content-between mb-md-4 mb-2">
                                                <div class="review-image rounded-circle pl-0 ml-0 mr-md-3 mb-2">
                                                    <?php if (has_post_thumbnail()) { ?>
                                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title(); ?>"
                                                            class="img-fluid">
                                                    <?php } else { ?>
                                                        <img src="<?php echo esc_url(get_template_directory_uri() . '/images/alter-user.png'); ?>"
                                                            alt="">
                                                    <?php } ?>
                                                </div>
                                                <div class="reviewer-name-address">
                                                    <h5> <?php the_title(); ?> </h5>
                                                    <?php
                                                    // address
                                                    $address = get_field('address');
                                                    if (!empty($address)) { ?>
                                                        <p class="mb-0"> <?php echo $address; ?> </p>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <?php
                                            $review_content = get_the_content();
                                            if (trim($review_content) === '') {
                                                echo '⭐⭐⭐⭐⭐';
                                            } else {
                                                echo $review_content;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </li>
                                <!-- per item end -->

                        <?php }
                        endwhile;
                        wp_reset_postdata();
                        ?>

                        <!-- items mirrored twice, total of 12 -->
                    </ul>
                </div>
            </div>
            <!-- Facebook Review Part End -->


            <!-- Google Review Part Start -->
            <div class="col-md-6 col-12 testimonial">

                <?php
                $post_type      =   'google_review';
                $count_posts    =   wp_count_posts($post_type);
                $total_post     =   $count_posts->publish;
                ?>
                <h3 class="mb-md-4 mb-2 review">
                    <a class="text-dark"
                        href="<?php echo esc_url('https://www.google.com/search?num=10&sca_esv=013e97f74595d706&rlz=1C1BNSD_enBD1033BD1033&sxsrf=AE3TifOZ3IRi0xbPr5y-KB7vtI1gqrnRNg:1748083525364&si=AMgyJEtREmoPL4P1I5IDCfuA8gybfVI2d5Uj7QMwYCZHKDZ-EwDVTQYeOr66FxKEUvydA7Higs1rccvhLDYWsAiTZR1dw9bRCCT3vU3qlSKW-EeIjSdAuKc54DlYFPgjvXLHYOx4XSeQdSSpYP0VQd-NvQ6p-kbF1g%3D%3D&q=webnewsdesign.com+Reviews&sa=X&ved=2ahUKEwiGrsTM9ruNAxW8S2wGHf9uAR8Q0bkNegQIPxAD&biw=1920&bih=919&dpr=1'); ?>"
                        target="_blank"> Google Reviews (<?php echo esc_html($total_post); ?>)
                    </a>
                </h3>

                <div class="flexslider flexslider-google carousel">
                    <ul class="slides">

                        <?php
                        $custom_post = new WP_Query(array(
                            'post_type'         =>  $post_type,
                            'posts_per_page'    =>  -1,
                            'order'             =>  'ASC'
                        ));

                        while ($custom_post->have_posts()): $custom_post->the_post(); { ?>

                                <!-- per item start -->
                                <li class="row d-flex align-items-center bg-white rounded-wnd">
                                    <div class="col-12 p-md-4 p-md-2 p-3 text-align-justify-wnd">
                                        <div>
                                            <?php $image_url = get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>
                                            <div class="d-flex align-items-center justify-content-between mb-md-4 mb-2">
                                                <div class="review-image rounded-circle pl-0 ml-0 mr-md-3 mb-2">
                                                    <?php if (has_post_thumbnail()) { ?>
                                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title(); ?>"
                                                            class="img-fluid">
                                                    <?php } else { ?>
                                                        <img src="<?php echo esc_url(get_template_directory_uri() . '/images/alter-user.png'); ?>"
                                                            alt="">
                                                    <?php } ?>

                                                </div>
                                                <div class="reviewer-name-address">
                                                    <h5> <?php the_title(); ?> </h5>
                                                    <?php
                                                    // address
                                                    $address = get_field('address');
                                                    if (!empty($address)) { ?>
                                                        <p class="mb-0"> <?php echo $address; ?> </p>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <?php
                                            $review_content = get_the_content();
                                            if (trim($review_content) === '') {
                                                echo '⭐⭐⭐⭐⭐';
                                            } else {
                                                echo $review_content;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </li>
                                <!-- per item end -->

                        <?php }
                        endwhile;
                        wp_reset_postdata();
                        ?>

                        <!-- items mirrored twice, total of 12 -->
                    </ul>
                </div>
            </div>
            <!-- Google Review Part End -->
        </div>
    </div>
</div>
<!-- Testimonial End -->