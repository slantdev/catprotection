<?php

add_action('init', 'register_custom_post_types');

function register_custom_post_types()
{
    register_post_type('cats', array(
        'public' => true,
        'menu_icon' => 'dashicons-image-filter',
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
        'has_archive' => false,
        'exclude_from_search' => false,
        'rewrite' => array(
            'slug' => 'cats'
        ),
        'labels'              => array(
            'name'               => 'Cats',
            'singular_name'      => 'Cat',
            'add_new'            => 'Add Cat',
            'add_new_item'       => 'Add Cat',
            'edit_item'          => 'Edit Cat',
            'view_item'          => 'View Cat',
            'search_items'       => 'Search Cats',
            'not_found'          => 'No Cats Found',
            'not_found_in_trash' => 'No Cats Found',
        ),
    ));

    register_post_type('cat-entrants', array(
        'public' => true,
        'menu_icon' => 'dashicons-awards',
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
        'has_archive' => false,
        'exclude_from_search' => false,
        'rewrite' => array(
            'slug' => 'cat-entrants'
        ),
        'labels'              => array(
            'name'               => 'Cat Entrants',
            'singular_name'      => 'Cat Entrant',
            'add_new'            => 'Add Cat Entrant',
            'add_new_item'       => 'Add Cat Entrant',
            'edit_item'          => 'Edit Cat Entrant',
            'view_item'          => 'View Cat Entrant',
            'search_items'       => 'Search Cat Entrants',
            'not_found'          => 'No Cat Entrants Found',
            'not_found_in_trash' => 'No Cat Entrants Found',
        ),
    ));

    register_post_type('video-entrants', array(
        'public' => true,
        'menu_icon' => 'dashicons-video-alt3',
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
        'has_archive' => false,
        'exclude_from_search' => false,
        'rewrite' => array(
            'slug' => 'video-entrants'
        ),
        'labels'              => array(
            'name'               => 'Video Entrants',
            'singular_name'      => 'Video Entrant',
            'add_new'            => 'Add Video Entrant',
            'add_new_item'       => 'Add Video Entrant',
            'edit_item'          => 'Edit Video Entrant',
            'view_item'          => 'View Video Entrant',
            'search_items'       => 'Search Video Entrants',
            'not_found'          => 'No Video Entrants Found',
            'not_found_in_trash' => 'No Video Entrants Found',
        ),
    ));

    register_post_type('reports', array(
        'public' => true,
        'menu_icon' => 'dashicons-admin-page',
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
        'has_archive' => false,
        'exclude_from_search' => false,
        'rewrite' => array(
            'slug' => 'reports'
        ),
        'labels'              => array(
            'name'               => 'Annual Reports',
            'singular_name'      => 'Report',
            'add_new'            => 'Add Report',
            'add_new_item'       => 'Add Report',
            'edit_item'          => 'Edit Report',
            'view_item'          => 'View Report',
            'search_items'       => 'Search Reports',
            'not_found'          => 'No Reports Found',
            'not_found_in_trash' => 'No Reports Found',
        ),
    ));

    register_post_type('policies', array(
        'public' => true,
        'menu_icon' => 'dashicons-admin-page',
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
        'has_archive' => false,
        'exclude_from_search' => false,
        'rewrite' => array(
            'slug' => 'policies'
        ),
        'labels'              => array(
            'name'               => 'Governance and Policies',
            'singular_name'      => 'Policy',
            'add_new'            => 'Add Policy',
            'add_new_item'       => 'Add Policy',
            'edit_item'          => 'Edit Policy',
            'view_item'          => 'View Policy',
            'search_items'       => 'Search Policy',
            'not_found'          => 'No Policy Found',
            'not_found_in_trash' => 'No Policy Found',
        ),
    ));
}
