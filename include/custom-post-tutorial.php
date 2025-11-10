<?php
function custom_post_type_tutorial() {
    register_post_type('tutorial', array(
        'labels' => array(
            'name'               => __('Tutorial Post'),
            'singular_name'      => __('Tutorial'),
            'add_new'            => __('Add New'),
            'add_new_item'       => __('Add New Tutorial'),
            'edit_item'          => __('Edit Tutorial'),
            'view_item'          => __('View Tutorial'),
            'new_item'           => __('New Tutorial'),
            'not_found'          => __('No tutorials found'),
        ),
        'label'               => __('Tutorial Post'),
        'public'              => true,
        'menu_position'       => 8,
        'rewrite'             => array('slug' => 'tutorial'),
        'supports'            => array('title'),
        'show_in_rest'        => true // for Gutenberg support
    ));
}
add_action('init', 'custom_post_type_tutorial');