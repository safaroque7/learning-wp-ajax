<?php
function english() {
    register_post_type('english', array(
        'labels' => array(
            'name'               => __('English Post'),
            'singular_name'      => __('English'),
            'add_new'            => __('Add New'),
            'add_new_item'       => __('Add New English'),
            'edit_item'          => __('Edit English'),
            'view_item'          => __('View English'),
            'new_item'           => __('New English'),
            'not_found'          => __('Sorry, we couldn\'t find anything you are looking for'),
        ),
        'label'               => __('English Post'),
        'public'              => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => false,
        'has_archive'         => true,
        'menu_position'       => 5,
        'rewrite'             => array('slug' => 'english'),
        'supports'            => array('title', 'editor', 'thumbnail'),
        'show_in_rest'        => true // Enables Gutenberg editor
    ));
}
add_action('init', 'english');