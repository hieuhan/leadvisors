<?php

/* Register Product Post Types */
add_action('init', 'post_type_people_register');
function post_type_people_register() {

    $labels = array(

        'name' => __('Persion','leadvisors'),

        'singular_name' => __('People','leadvisors'),

        'menu_name' => __('Persion','leadvisors'),

        'all_items' => __('All Persion','leadvisors'),

        'add_new' => __('Add New','leadvisors'),

        'add_new_item' => __('Add New Persion','leadvisors'),

        'edit_item' => __('Edit Persion','leadvisors'),

        'new_item' => __('New Persion','leadvisors'),

        'view_item' => __('View Details','leadvisors'),

        'search_items' => __('Search','leadvisors'),

        'not_found' => __('No Persion Found','leadvisors'),

        'not_found_in_trash' => __('No Persion Found In Trash','leadvisors'),

        'view' => __('View','leadvisors')

        );



    $args = array(

        'labels' => $labels,

        'description' => __('Leadvisors Persion','leadvisors'),

        'public' => true,

        'publicly_queryable' => true,

        'exclude_from_search' => false,

        'show_in_nav_menus' => true,

        'show_ui' => true,

        'rewrite' => array('slug' => 'people'),

        'menu_position' => 4,

        'menu_icon' => 'dashicons-id-alt',

        'supports' => array('title', 'editor', 'thumbnail'),

        'has_archive' => 'persion'

        );

    register_post_type('people', $args);

    
    /* Register taxonomy */

    register_taxonomy('people_categories', 'people', array(

        'labels' => array('name' => 'People Categories', 'singular_label' => 'People Category'),

        'show_ui' => true,

        'hierarchical' => true,

        'rewrite' => array('slug' => 'persion', 'hierarchical' => true, 'with_front' => true),

        'show_admin_column' => true,

        'show_in_nav_menus' => true,

        ));

}





