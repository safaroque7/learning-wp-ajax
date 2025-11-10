<?php
get_header();
get_template_part('include/breadcrumb-design');
?>
<!--start wrap-->
<div class="container">
    <!--start category_and_other-->
    <div class="row mb-2 mb-md-5">
        <!--start per_templat_matter-->
        <div class="col-12 bg-white pt-3 pages-ul-li">
            <?php
            while (have_posts()): the_post();
                the_content();
            endwhile;
            ?>
        </div>

    </div>
    <!--.endcategory_and_other-->
</div>
<!--.end wrap-->
<?php get_footer(); ?>