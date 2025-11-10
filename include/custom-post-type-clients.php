<?php

function clients_post_type()
{
    $labels = array(
        'name'                  => _x('Clients', 'Post type general name', 'portfolio'),
        'singular_name'         => _x('Clients', 'Post type singular name', 'portfolio'),
        'menu_name'             => _x('Clients', 'Admin Menu text', 'portfolio'),
        'name_admin_bar'        => _x('Clients', 'Add New on Toolbar', 'portfolio'),
        'add_new'               => __('Add New', 'portfolio'),
        'add_new_item'          => __('Add New Client', 'portfolio'),
        'new_item'              => __('New Clients', 'portfolio'),
        'edit_item'             => __('Edit Clients', 'portfolio'),
        'view_item'             => __('View Clients', 'portfolio'),
        'all_items'             => __('All Clients', 'portfolio'),
        'search_items'          => __('Search Clients', 'portfolio'),
        'parent_item_colon'     => __('Parent Clients:', 'portfolio'),
        'not_found'             => __('No Clients found.', 'portfolio'),
        'not_found_in_trash'    => __('No Clients found in Trash.', 'portfolio'),
        'featured_image'        => _x('Clients Cover Image', 'Overrides the “Featured Image” phrase.', 'portfolio'),
        'set_featured_image'    => _x('Set cover image', 'portfolio'),
        'remove_featured_image' => _x('Remove cover image', 'portfolio'),
        'use_featured_image'    => _x('Use as cover image', 'portfolio'),
        'archives'              => _x('Clients archives', 'portfolio'),
        'insert_into_item'      => _x('Insert into Clients', 'portfolio'),
        'uploaded_to_this_item' => _x('Uploaded to this Clients', 'portfolio'),
        'filter_items_list'     => _x('Filter Clients list', 'portfolio'),
        'items_list_navigation' => _x('Clients list navigation', 'portfolio'),
        'items_list'            => _x('Clients list', 'portfolio'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'Clients'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-editor-help',
        'supports'           => array('title', 'custom-fields', 'thumbnail'),
        'show_in_rest'       => true, // for Gutenberg support
    );

    register_post_type('clients', $args);
}
add_action('init', 'clients_post_type');
