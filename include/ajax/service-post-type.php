<?php
function Service_post_type() {
    register_post_type('services', array(
        'labels' => array(
            'name'               => __('Services', 'portfolio'),
            'singular_name'      => __('Service', 'portfolio'),
            'menu_name'          => __('Services', 'portfolio'),
            'name_admin_bar'     => __('Service', 'portfolio'),
            'add_new'            => __('Add New', 'portfolio'),
            'add_new_item'       => __('Add New Service', 'portfolio'),
            'edit_item'          => __('Edit Service', 'portfolio'),
            'new_item'           => __('New Service', 'portfolio'),
            'view_item'          => __('View Service', 'portfolio'),
            'search_items'       => __('Search Services', 'portfolio'),
            'not_found'          => __('No services found', 'portfolio'),
            'not_found_in_trash' => __('No services found in Trash', 'portfolio'),
        ),
        'public'              => true,
        'has_archive'         => true,
        'menu_position'       => 11,
        'rewrite'             => array('slug' => 'service'),
        'supports'            => array('title', 'thumbnail', 'custom-fields'),
    ));
}
add_action('init', 'Service_post_type');
