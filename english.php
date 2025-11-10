<?php get_header();
/*
        Template Name: english_learning
    */

query_posts(array(
    'post_type'         =>  'english', //changeable
    'posts_per_page'    =>  -1,
    'order'             =>  'ASC'

));

?>

<?php
$id = get_the_ID();
?>

<div class="container">
    <div class="row">
        <div class="col-3">
            <div id="sticker">
                <div id="list-example" class="list-group">
                    <?php while (have_posts()) : the_post(); ?>

                        <a class="list-group-item list-group-item-action" href="#list-item-<?php echo $id; ?>">

                            <?php the_title(); ?>
                        </a>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>

        <div class="col-9">
            <?php while (have_posts()) : the_post(); ?>
                <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-offset="0" class="scrollspy-example bg-white p-2 mb-5" tabindex="0">
                    <h4 class="mb-3 border-bottom bg-success text-white px-2 py-1" id="list-item-<?php echo $id; ?>"> <?php the_title(); ?> </h4>
                    <?php the_content(); ?>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>