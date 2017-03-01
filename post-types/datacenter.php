<?php

/* Register Datacenter Post Types */
add_action('init', 'post_type_datacenter_register');
function post_type_datacenter_register() {

    $labels = array(

        'name' => __('Data Center','leadvisors'),

        'singular_name' => __('Datas Center','leadvisors'),

        'menu_name' => __('Data center','leadvisors'),

        'all_items' => __('All Data center','leadvisors'),

        'add_new' => __('Add New','leadvisors'),

        'add_new_item' => __('Add New Data center','leadvisors'),

        'edit_item' => __('Edit Data center','leadvisors'),

        'new_item' => __('New Data center','leadvisors'),

        'view_item' => __('View Details','leadvisors'),

        'search_items' => __('Search','leadvisors'),

        'not_found' => __('No Data center Found','leadvisors'),

        'not_found_in_trash' => __('No Data center Found In Trash','leadvisors'),

        'view' => __('View','leadvisors')

        );



    $args = array(

        'labels' => $labels,

        'description' => __('Leadvisors Data center','leadvisors'),

        'public' => true,

        'publicly_queryable' => true,

        'exclude_from_search' => false,

        'show_in_nav_menus' => true,

        'show_ui' => true,

        'rewrite' => array('slug' => 'datacenter'),

        'menu_position' => 9,

        'menu_icon' => 'dashicons-cloud',

        'supports' => array('title', 'editor', 'thumbnail'),

        'has_archive' => 'datacenters'

        );

    register_post_type('datacenter', $args);

    register_taxonomy('datacenter_categories', 'datacenter', array(

        'labels' => array('name' => 'Datacenter Categories', 'singular_label' => 'Datacenter Category'),

        'show_ui' => true,

        'hierarchical' => true,

        'rewrite' => array('slug' => 'datacenters', 'hierarchical' => true, 'with_front' => true),

        'show_admin_column' => true,

        'show_in_nav_menus' => true,

        ));

}





