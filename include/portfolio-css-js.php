<?php
function portfolio_css_js()
{
    wp_register_style('font-awesome-min-css', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.3.0', 'all');
    wp_register_style('bootstrap-icons-min-css', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.12.1/font/bootstrap-icons.min.css', array(), '1.12.1', 'all');
    wp_register_style('bootstrap-min', get_template_directory_uri() . '/css/bootstrap.min.css', array(), null, 'screen');
    wp_register_style('flexslider-css', get_template_directory_uri() . '/css/flexslider.css', array(), null, 'screen');
    wp_register_style('maincss', get_stylesheet_uri(), array(), null, 'all');

    wp_enqueue_style('font-awesome-min-css');
    wp_enqueue_style('bootstrap-icons-min-css');
    wp_enqueue_style('bootstrap-min');
    wp_enqueue_style('flexslider-css');
    wp_enqueue_style('wnd-office-stylesheet', get_stylesheet_uri());

    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap-min-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '4.0.0', true);
    wp_enqueue_script('jquery-flexslider-min-js', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'), null, true);
    wp_enqueue_script('my-js', get_template_directory_uri() . '/js/my-js.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'portfolio_css_js');
