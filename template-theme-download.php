<?php
/*
Template Name: Template Theme Download
*/
get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <?php echo do_shortcode('[contact-form-7 id="c6b9e8b" title="theme-download"]');?>
        </div>

        <script>
            document.addEventListener('wpcf7mailsent', function (event) {
                window.location.href = "https://yourwebsite.com/your-theme.zip";
            }, false);
        </script>
    </div>
</div>


<?php
//footer
get_footer();