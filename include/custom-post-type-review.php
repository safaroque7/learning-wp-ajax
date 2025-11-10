<?php
function custom_post_type_review() {

    // Register custom post type
    register_post_type('review', array(
        'label'               => 'Review Post',
        'labels'              => array(
            'name'               => __('Facebook Review'),
            'singular_name'      => __('review'),
            'add_new'            => __('Add New'),
            'add_new_item'       => __('Add New review'),
            'edit_item'          => __('Edit review'),
            'view_item'          => __('View review'),
            'new_item'           => __('New review'),
            'not_found'          => __('Sorry, we couldn\'t find anything you are looking for'),
        ),
        'public'              => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => false,
        'has_archive'         => true,
        'menu_position'       => 6,
        'menu_icon'           => 'dashicons-star-filled',
        'rewrite'             => array('slug' => 'review'),
        'supports'            => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'show_in_rest'        => true, // Gutenberg support
    ));
}
add_action('init', 'custom_post_type_review');