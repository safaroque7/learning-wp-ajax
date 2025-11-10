<?php
//for default
include_once('include/default.php');

//for adding classes on main menu li
include_once('include/add-classes-on-main-menu-li-and-a.php');

//for portfolio css and js
include_once('include/portfolio-css-js.php');

//for main slider
include_once('include/custom-post-english.php');

//for main menu
include_once('include/menu.php');

//for tutorial
include_once('include/custom-post-tutorial.php');

//for themes
include_once('include/custom-post-type-themes.php');

//for custom-post-type-review
include_once('include/custom-post-type-review.php');

//for custom-post-type-google-review
include_once('include/custom-post-type-google-review.php');

//for themes
include_once('include/content-below-tag.php');

//for viewer_counter
include_once('include/viewer-counter.php');

//for ustom-post-type-google-projects
include_once('include/custom-post-type-google-projects.php');

//for custom-post-type-google-faq
include_once('include/custom-post-type-google-faq.php');

//for select pages
include_once('include/customizer/select-pages.php');

//for custom-post-type-clients
include_once('include/custom-post-type-clients.php');

//for title-name
include_once('include/title-name.php');

//for custom-post-type-service.php
include_once('include/custom-post-type-service.php');

//for validation-file.php
include_once('include/validation-file.php');

add_action('init', 'gp_register_taxonomy_for_object_type');
function gp_register_taxonomy_for_object_type()
{
    register_taxonomy_for_object_type('post_tag', 'themes');
};
