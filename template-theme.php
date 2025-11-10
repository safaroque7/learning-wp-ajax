<?php
/*
Template Name: Theme
*/
get_header();
include_once('include/breadcrumb-design.php');
?>
<!-- *****Header Section End***** -->

<div class="container-fluid">
    <div class="container">
        <div class="row">


            <?php
            $args = array(
                'post_type'         => 'themes', // if you want to further filter by post_type
                'order'             => 'ASC',
                'posts_per_page'    =>  -1
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
</div>
<?php get_footer(); ?>