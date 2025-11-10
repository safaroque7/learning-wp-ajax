<?php
    $aboutMe = new WP_Query(array(
        'post_type'         =>  'aboutMe',
        'posts_per_page'    =>  1
    ));
?>


<!--service part-->
<?php while($aboutMe->have_posts()):$aboutMe->the_post();?>
    <div class="service">
        <div class="image_me">
            <?php the_post_thumbnail('about_me_image_size');?>
        </div>
        <div class="details_me">
            <h3>
               <?php the_content();?>
            </h3>
        </div>
    </div>
<?php endwhile;?>