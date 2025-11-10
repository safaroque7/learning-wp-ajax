<?php
/*
Template Name: Contact
*/
get_header();
include_once('include/breadcrumb-design.php');
?>

<!-- *****Header Section End***** -->



<!--*** Contact information & Get in touch Section Start *** -->


<div class="container mb-md-5 mb-2">
    <div class="row">
        <div class="col-md-5" style="background-color:#8a171a">
            <div class="py-5 px-4">
                <div class="mb-5">
                    <h4 class="mb-2 text-white mb-md-5 mb-2">Contact Information</h4>

                    <div class="text-decoration-none d-block mb-2">
                        <div class="d-flex">
                            <span> <i class="bi bi-geo-alt text-white pr-md-3 pr-2"></i> </span>
                            <span class="text-white"> 89/A (3rd floor), Anarkoli Super Market (behind the Mouchak market), 77/1 Shiddheswari Ln, Dhaka 1217 </span>
                        </div>
                    </div>
                    <a href="tel:01915344418" class="text-decoration-none d-block text-white mb-2">
                        <span> <i class="bi bi-phone-vibrate text-white pr-md-3 pr-2"></i> </span>
                        01915344418
                    </a>
                    <a href="mailto:info@webnewsdesign.com" class="text-decoration-none d-block text-white mb-2">
                        <span> <i class="bi bi-envelope-at text-white pr-md-3 pr-2"></i> </span>
                        info@webnewsdesign.com
                    </a>
                </div>

                <h4 class="mb-3 text-white">Follow Us</h4>
                <div class="social-logo">
                    <ul class="d-flex pl-0 list-unstyled">
                        <li class="mr-2">
                            <a href="https://www.facebook.com/webnewsdesign" target="_blank"
                                class="text-decoration-none text-white"><i
                                    class="bi bi-facebook "></i> </a>
                        </li>

                        <li class="mr-2">
                            <a href="https://www.youtube.com/@faroque001" target="_blank"
                                class="text-decoration-none text-white"><i
                                    class="bi bi-youtube "></i> </a>
                        </li>
                        <li class="mr-2">
                            <a href="https://github.com/safaroque7" target="_blank"
                                class="text-decoration-none text-white"><i
                                    class="bi bi-github "></i> </a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>

        <!-- Get In Touch part start  -->
        <div class="col-md-7 mt-md-0 mt-3 border border-white">
            <?php
            //echo do_shortcode('[contact-form-7 id="3245df7" title="Contact form 1"]');
            echo do_shortcode('[contact-form-7 id="2c90d70" title="Contact form for webnewsdesign.com"]');
            ?>


        </div>
        <!-- Get In Touch part end  -->
    </div>
</div>

<!--*** Contact information & Get in touch Section End *** -->

<!-- Location Map Start  -->


<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-5">
            <div class="mapouter" style="position:relative; text-align:right;  height:450px;">
                <div class="gmap_canvas" style="overflow:hidden; background:none!important;  height:450px;">
                    <iframe height="450px" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3652.0747415344645!2d90.40919777533577!3d23.744713978674273!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c79e9e166e75%3A0xe8bfc6d579d79114!2swebnewsdesign.com!5e0!3m2!1sen!2sbd!4v1752068040502!5m2!1sen!2sb"></iframe>





                </div>
                <a href="https://norsumediagroup.com/embed-google-map-website-free" target="_blank"
                    rel="noopener noreferrer" class="gme-generated-link">Embed Map on Website for Free</a>
                <style>
                    .mapouter {
                        position: relative;
                        text-align: right;
                    }

                    .gmap_canvas {
                        overflow: hidden;
                        background: none !important;
                    }

                    .gmap_canvas iframe {
                        width: 100%;
                        height: 100%;
                    }

                    .mapouter a {
                        display: block;
                        font-size: 0.85em;
                        text-align: center;
                        padding: 5px 0;
                        color: #6c757d;
                        text-decoration: none;
                    }

                    .gme-generated-link {
                        display: none !important;
                    }
                </style>
            </div>

        </div>
    </div>
</div>


<!-- Location Map End -->


<?php get_footer();
