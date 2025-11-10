<?php
function portfolio_menu()
{
    register_nav_menus(array(
        'primary-menu'      => __('Primary Menu', 'portfolio'),
        'legal-menu'        => __('Legal Menu', 'portfolio'),
        'useful-link-menu'  => __('Useful Links Menu', 'portfolio'),
        'get-in-touch'      => __('Get In Touch Menu', 'portfolio'),
    ));
}
add_action('init', 'portfolio_menu');
