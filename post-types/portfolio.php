<?php

/* Register Product Post Types */

add_action('init', 'reg_post_type_portfolio');

function reg_post_type_portfolio() {

    $labels = array(

        'name' => __('Portfolio','leadvisors'),

        'singular_name' => __('Portfolio','leadvisors'),

        'menu_name' => __('Portfolio','leadvisors'),

        'all_items' => 'All Portfolio',

        'add_new' => 'Add New',

        'add_new_item' => 'Add New Portfolio',

        'edit_item' => 'Edit Portfolio',

        'new_item' => 'New Portfolio',

        'view_item' => 'View Details',

        'search_items' => 'Search',

        'not_found' => 'No Portfolio Found',

        'not_found_in_trash' => 'No Portfolio Found In Trash',

        'view' => 'View'

    );



    $args = array(

        'labels' => $labels,

        'description' => 'Leadvisors Portfolio',

        'public' => true,

        'publicly_queryable' => true,

        'exclude_from_search' => false,

        'show_in_nav_menus' => true,

        'show_ui' => true,

        'rewrite' => array('slug' => 'portfolio'),

        'menu_position' => 5,

        'menu_icon' => 'dashicons-list-view',

        'supports' => array('title', 'editor', 'thumbnail'),

        'has_archive' => 'portfolios'

    );



    register_post_type('portfolio', $args);

    

    /* Register taxonomy */

    register_taxonomy('portfolio_categories', 'portfolio', array(

        'labels' => array('name' => 'Portfolio Categories', 'singular_label' => 'Portfolio Category'),

        'show_ui' => true,

        'hierarchical' => true,

        'rewrite' => array('slug' => 'portfolios', 'hierarchical' => true, 'with_front' => true),

        'show_admin_column' => true,

        'show_in_nav_menus' => true,

    ));

}





