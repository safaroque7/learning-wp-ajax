<?php

function service_post_type()
{
    $labels = array(
        'name'                  => _x('Service', 'Post type general name', 'portfolio'),
        'singular_name'         => _x('Service', 'Post type singular name', 'portfolio'),
        'menu_name'             => _x('Service', 'Admin Menu text', 'portfolio'),
        'name_admin_bar'        => _x('Service', 'Add New on Toolbar', 'portfolio'),
        'add_new'               => __('Add New', 'portfolio'),
        'add_new_item'          => __('Add New Service', 'portfolio'),
        'new_item'              => __('New Service', 'portfolio'),
        'edit_item'             => __('Edit Service', 'portfolio'),
        'view_item'             => __('View Service', 'portfolio'),
        'all_items'             => __('All Service', 'portfolio'),
        'search_items'          => __('Search Service', 'portfolio'),
        'parent_item_colon'     => __('Parent Service:', 'portfolio'),
        'not_found'             => __('No Service found.', 'portfolio'),
        'not_found_in_trash'    => __('No Service found in Trash.', 'portfolio'),
        'featured_image'        => _x('Service Cover Image', 'Overrides the “Featured Image” phrase.', 'portfolio'),
        'set_featured_image'    => _x('Set cover image', 'portfolio'),
        'remove_featured_image' => _x('Remove cover image', 'portfolio'),
        'use_featured_image'    => _x('Use as cover image', 'portfolio'),
        'archives'              => _x('Service archives', 'portfolio'),
        'insert_into_item'      => _x('Insert into Service', 'portfolio'),
        'uploaded_to_this_item' => _x('Uploaded to this Service', 'portfolio'),
        'filter_items_list'     => _x('Filter Service list', 'portfolio'),
        'items_list_navigation' => _x('Service list navigation', 'portfolio'),
        'items_list'            => _x('Service list', 'portfolio'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'Service'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 21,
        'menu_icon'          => 'dashicons-editor-help',
        'supports'           => array('title', 'custom-fields', 'thumbnail'),
        'show_in_rest'       => true, // for Gutenberg support
    );

    register_post_type('Service', $args);
}
add_action('init', 'service_post_type');
