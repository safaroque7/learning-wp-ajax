<?php
function custom_post_type_google_review() {

    register_post_type('google_review', array(
        'label'               => 'Google Review',
        'labels'              => array(
            'name'               => __('Google Reviews'),
            'singular_name'      => __('Google Review'),
            'menu_name'          => __('Google Reviews'),
            'name_admin_bar'     => __('Google Review'),
            'add_new'            => __('Add New'),
            'add_new_item'       => __('Add New Google Review'),
            'new_item'           => __('New Google Review'),
            'edit_item'          => __('Edit Google Review'),
            'view_item'          => __('View Google Review'),
            'all_items'          => __('All Google Reviews'),
            'search_items'       => __('Search Google Reviews'),
            'not_found'          => __('No reviews found.'),
            'not_found_in_trash' => __('No reviews found in Trash.')
        ),
        'public'              => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => false,
        'has_archive'         => true,
        'menu_position'       => 7,
        'menu_icon'           => 'dashicons-star-filled',
        'rewrite'             => array('slug' => 'google-review'),
        'supports'            => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'show_in_rest'        => true,
        'capability_type'     => 'post',
        'hierarchical'        => false,
    ));
}
add_action('init', 'custom_post_type_google_review');