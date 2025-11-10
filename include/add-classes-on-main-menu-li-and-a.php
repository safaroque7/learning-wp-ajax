<?php

/**
 * 
 * 
 * 
 * 
 * 
 * 
 * for adding classes on main menu li
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 */
function add_classes_on_main_menu_li($classes, $item, $args)
{
    // Check if the menu location is 'mainMenu'
    if ($args->theme_location === 'primary-menu') {
        // Add a custom class to the menu item
        $classes[] = 'nav-item'; // Add your custom class here
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_classes_on_main_menu_li', 10, 3);

//add_classes_on_main_menu_li a
function add_classes_on_main_menu_a($atts, $item, $args)
{
    // Check if the menu location is 'mainMenu'
    if ($args->theme_location === 'primary-menu') {
        // Add a custom class to the anchor tag
        $atts['class'] = 'nav-link link-padding-bottom'; // Add your custom class here
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_classes_on_main_menu_a', 10, 3);


/**
 * 
 * 
 * 
 * 
 * 
 * 
 * add classes on legal-menu li 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 */


function add_classes_on_legal_menu($classes, $item, $args)
{
    if ($args->theme_location === 'legal-menu') {
        $classes[] = 'nav-item';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_classes_on_legal_menu', 10, 3);


//add classes on legal-menu li a
function add_classes_on_legal_menu_li_a($atts, $item, $args)
{
    if ($args->theme_location === 'legal-menu') {
        $atts['class'] = 'nav-link text-dark link-padding-bottom';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_classes_on_legal_menu_li_a', 10, 3);



/**
 * 
 * 
 * 
 * 
 * 
 * 
 * add clsses on get-in-touch li
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 */



function add_classes_on_get_in_touch($classes, $item, $args)
{
    if ($args->theme_location === 'get-in-touch') {
        $classes[] = 'nav-item';
    }
    return $classes;
}
add_filter('nav_menu_css_classes', 'add_classes_on_get_in_touch', 10, 3);

//add classes on get-in-touch li a
function add_classes_on_get_in_touch_li_a($atts, $item, $args)
{

    if ($args->theme_location === 'get-in-touch') {
        $atts['class'] = 'nav-link text-dark link-padding-bottom';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_classes_on_get_in_touch_li_a', 10, 3);



/**
 * 
 * 
 * 
 * 
 * 
 * 
 * add classes on useful-link-menu li
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 */


function add_classes_on_useful_link_menu_li($classes, $item, $args)
{
    if ($args->theme_location === 'useful-link-menu') {
        $classes[] = 'nav-item';
    }
    return $classes;
}
add_filter('nav_menu_css_classes', 'add_classes_on_useful_link_menu_li', 10, 3);



//add classes on useful-link-menu li a
function add_classes_on_useful_link_menu_li_a($atts, $item, $args)
{
    if ($args->theme_location === 'useful-link-menu') {
        $atts['class'] = 'nav-link text-dark link-padding-bottom';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_classes_on_useful_link_menu_li_a', 10, 3);
