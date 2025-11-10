<?php
function custom_post_type_project()
{

    register_post_type('project', array(
        'label'              => 'project',
        'labels'             => array(
            'name'              => __('project'),
            'singular_name'     => __('project'),
            'menu_name'         => __('Project Post'),
            'name_admin_bar'    => __('project4'),
            'add_new'           => __('Add New Project'),
            'add_new_item'      => __('Add New Project'),
            'new_item'          => __('New Project'),
            'edit_item'         => __('Edit Project'),
            'view_item'         => __('View Project'),
            'all_items'         => __('All Project'),
            'search_items'      => __('Search Project'),
            'not_found'         => __('No project found.'),
            'not_found_in_trash' => __('No project found in Trash.')
        ),
        'public'             => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive'        => true,
        'menu_position'      => 8,
        'menu_icon'          => 'dashicons-star-filled',
        'rewrite'            => array('slug' => 'project'),
        'supports'           => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'show_in_rest'       => true,
        'capability_type'    => 'post',
        'hierarchical'       => false,
    ));
}
add_action('init', 'custom_post_type_project');
