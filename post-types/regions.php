<?php 

/** Đăng ký post-type regions **/

function post_type_regions_register()

{

/*

     * Biến $label để chứa các text liên quan đến tên hiển thị của Post Type trong Admin

     */

    $labels = array(

        'name' => __('Regions','leadvisors'),

        'singular_name' => __('Regions','leadvisors'),

        'menu_name' => __('Regions','leadvisors'),

        'all_items' => __('All Regions','leadvisors'),

        'add_new' => __('Add New','leadvisors'),

        'add_new_item' => __('Add New Regions','leadvisors'),

        'edit_item' => __('Edit Regions','leadvisors'),

        'new_item' => __('New Regions','leadvisors'),

        'view_item' => __('View Details','leadvisors'),

        'search_items' => __('Search','leadvisors'),

        'not_found' => __('No Post Found','leadvisors'),

        'not_found_in_trash' => __('No Post Found In Trash','leadvisors'),

        'view' => __('View','leadvisors')

    );



    $args = array(

        'labels' => $labels,

        'description' => __('Leadvisors Regions','leadvisors'),

        'public' => true,

        'publicly_queryable' => true,

        'exclude_from_search' => true,

        'show_in_nav_menus' => false,

        'show_ui' => true,

        'rewrite' => array('slug' => 'regions'),

        'menu_position' => 7,

        'menu_icon' => 'dashicons-location-alt',

        'supports' => array('title', 'editor','thumbnail'),

    );



    register_post_type('regions', $args); //Tạo post type với slug tên là slide và các tham số trong biến $args ở trên

}

add_action('init','post_type_regions_register');



?>