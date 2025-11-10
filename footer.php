<div class="container-fluid bg-light">
    <div class="container">
        <div class="row py-5">
            <!-- Address start -->
            <div class="col-md-4 col-12">
                <div class="mb-md-4 mb-2">
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/main-logo.png" alt="<?php bloginfo('name'); ?>" style=width:200px>
                    </a>
                </div>

                <div class="mt-3 address-link-hover-text-decoration-underline">
                    <div class="pb-md-3 pb-1">
                        <a href="https://maps.app.goo.gl/d5iYeJ1SG3cPWbxD8" target="_blank" class="text-decoration-none text-dark">
                            <div class="d-flex">
                                <i class="bi bi-geo-alt pr-2"></i>
                                <p class="link-padding-bottom mb-0"> 89/A (3rd floor), Anarkoli Super Market (behind the Mouchak market), 77/1 Shiddheswari Ln, Dhaka 1217 </p>
                            </div>
                        </a>
                    </div>
                    <div class="pb-md-3 pb-1">
                        <a href="tel:+8801915344418" class="text-decoration-none d-block text-dark link-padding-bottom">
                            <div class="d-flex">
                                <i class="bi bi-phone-vibrate pr-2"></i>
                                <p class="link-padding-bottom mb-0"> 01915344418 </p>
                            </div>
                        </a>
                    </div>
                    <a href="mailto:faroque.computer@gmail.com" class="text-decoration-none d-block text-dark link-padding-bottom">
                        <div class="d-flex">
                            <i class="bi bi-envelope-at pr-2"></i>
                            <p class="link-padding-bottom mb-0"> faroque.computer@gmail.com </p>
                        </div>
                    </a>
                </div>

            </div>
            <!-- Address End -->

            <!-- Useful Links Start -->
            <div class="col-md-3 col-12 mt-md-0 mt-4">
                <h6 class="mb-md-3 mb-2 font-weight-bold">Useful Links</h6>
                <?php
                wp_nav_menu(array(
                    'theme_location'    =>  'useful-link-menu',
                    'menu_class'        =>  'navbar-nav navbar-hover-text-decoration-underline',
                    'container'         =>  false,
                    'fallback_cb'       =>  false
                ));
                ?>
            </div>
            <!-- Useful Links End -->

            <!-- Legal Information Start -->
            <div class="col-md-3 col-12 footer-company mt-md-0 mt-4">
                <h6 class="mb-md-3 mb-2 font-weight-bold">Legal Information</h6>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'legal-menu',
                    'menu_class'     => 'navbar-nav navbar-hover-text-decoration-underline',
                    'container'      => false,
                    'fallback_cb'    => false,
                ));
                ?>
            </div>
            <!-- Legal Information End -->

            <!-- Get In Touch Start -->
            <div class="col-md-2 col-12 mt-md-0 mt-4">
                <h6 class="mb-md-3 mb-2 font-weight-bold">Get In Touch</h6>
                <?php
                wp_nav_menu(array(
                    'theme_location'    =>  'get-in-touch',
                    'menu_class'        =>  'navbar-nav navbar-hover-text-decoration-underline',
                    'container'         =>  false,
                    'fallback_cb'       =>  false,
                ));
                ?>
            </div>
            <!-- Get In Touch End -->
        </div>
    </div>
</div>
<div class="container-fluid bg-dark text-white">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Copyright Notice Start -->
                <p class="mb-0 py-md-2 py-1"> © 2013 - <?php echo date('Y'); ?> webnewsdesign.com. All Rights Reserved. </p>
            </div>
        </div>
    </div>
    <!-- Copyright Notice End -->
</div>
<?php wp_footer(); ?>
</body>

</html>