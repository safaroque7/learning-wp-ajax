<?php
function client_post_type() {
    register_post_type('clients', array(
        'labels' => array(
            'name'                  => __('Clients', 'portfolio'),
            'singular_name'         => __('Client', 'portfolio'),
            'menu_name'             => __('Clients', 'portfolio'),
            'name_admin_bar'        => __('Client', 'portfolio'),
            'add_new'               => __('Add New', 'portfolio'),
            'add_new_item'          => __('Add New Client', 'portfolio'),
            'edit_item'             => __('Edit Client', 'portfolio'),
            'view_item'             => __('View Client', 'portfolio'),
            'new_item'              => __('New Client', 'portfolio'),
            'search_items'          => __('Search Clients', 'portfolio'),
            'not_found'             => __('No clients found', 'portfolio'),
            'not_found_in_trash'    => __('No clients found in Trash', 'portfolio'),
            'all_items'             => __('All Clients', 'portfolio'),
        ),
        'public'                => true,
        'publicly_queryable'    => true,
        'exclude_from_search'   => false,
        'has_archive'           => true,
        'hierarchical'          => false,
        'capability_type'       => 'page',
        'menu_position'         => 10,
        'menu_icon'             => 'dashicons-businessperson', // 👤 সুন্দর আইকন
        'rewrite'               => array('slug' => 'client'),
        'supports'              => array('title', 'custom-fields', 'thumbnail'),
        'show_in_rest'          => true, // ✅ Gutenberg ও REST API সাপোর্ট
    ));
}
add_action('init', 'client_post_type');
