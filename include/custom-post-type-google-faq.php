<?php

function create_faq_post_type()
{
    $labels = array(
        'name'                  => _x('FAQs', 'Post type general name', 'textdomain'),
        'singular_name'         => _x('FAQ', 'Post type singular name', 'textdomain'),
        'menu_name'             => _x('FAQs', 'Admin Menu text', 'textdomain'),
        'name_admin_bar'        => _x('FAQ', 'Add New on Toolbar', 'textdomain'),
        'add_new'               => __('Add New', 'textdomain'),
        'add_new_item'          => __('Add New FAQ', 'textdomain'),
        'new_item'              => __('New FAQ', 'textdomain'),
        'edit_item'             => __('Edit FAQ', 'textdomain'),
        'view_item'             => __('View FAQ', 'textdomain'),
        'all_items'             => __('All FAQs', 'textdomain'),
        'search_items'          => __('Search FAQs', 'textdomain'),
        'parent_item_colon'     => __('Parent FAQs:', 'textdomain'),
        'not_found'             => __('No FAQs found.', 'textdomain'),
        'not_found_in_trash'    => __('No FAQs found in Trash.', 'textdomain'),
        'featured_image'        => _x('FAQ Cover Image', 'Overrides the “Featured Image” phrase.', 'textdomain'),
        'set_featured_image'    => _x('Set cover image', 'textdomain'),
        'remove_featured_image' => _x('Remove cover image', 'textdomain'),
        'use_featured_image'    => _x('Use as cover image', 'textdomain'),
        'archives'              => _x('FAQ archives', 'textdomain'),
        'insert_into_item'      => _x('Insert into FAQ', 'textdomain'),
        'uploaded_to_this_item' => _x('Uploaded to this FAQ', 'textdomain'),
        'filter_items_list'     => _x('Filter FAQs list', 'textdomain'),
        'items_list_navigation' => _x('FAQs list navigation', 'textdomain'),
        'items_list'            => _x('FAQs list', 'textdomain'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'faq'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-editor-help',
        'supports'           => array('title', 'editor', 'thumbnail'),
        'show_in_rest'       => true, // for Gutenberg support
    );

    register_post_type('faq', $args);
}
add_action('init', 'create_faq_post_type');
