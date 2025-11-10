<?php
function custom_post_type_themes() {

    // Register custom post type
    register_post_type('themes', array(
        'label'               => 'Themes Post',
        'labels'              => array(
            'name'               => __('Themes'),
            'singular_name'      => __('Theme'),
            'add_new'            => __('Add New'),
            'add_new_item'       => __('Add New Theme'),
            'edit_item'          => __('Edit Theme'),
            'view_item'          => __('View Theme'),
            'new_item'           => __('New Theme'),
            'not_found'          => __('Sorry, we couldn\'t find anything you are looking for'),
        ),
        'public'              => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => false,
        'has_archive'         => true,
        'menu_position'       => 5,
        'rewrite'             => array('slug' => 'themes'),
        'supports'            => array('title', 'editor', 'thumbnail'),
        'show_in_rest'        => true, // Gutenberg support
    ));

    // Register custom taxonomy
    register_taxonomy('theme_category', 'themes', array(
        'labels' => array(
            'name'              => __('Themes Category'),
            'singular_name'     => __('Theme Category'),
            'search_items'      => __('Search Categories'),
            'all_items'         => __('All Categories'),
            'parent_item'       => __('Parent Category'),
            'parent_item_colon' => __('Parent Category:'),
            'edit_item'         => __('Edit Category'),
            'update_item'       => __('Update Category'),
            'add_new_item'      => __('Add New Category'),
            'new_item_name'     => __('New Category Name'),
            'menu_name'         => __('Themes Categories'),
        ),
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'rewrite'           => array('slug' => 'theme-category'),
        'show_in_rest'      => true,
    ));
}
add_action('init', 'custom_post_type_themes');