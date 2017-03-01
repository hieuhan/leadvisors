<?php 

/** Đăng ký post-type location **/

function post_type_location_register()

{

/*

     * Biến $label để chứa các text liên quan đến tên hiển thị của Post Type trong Admin

     */

    $labels = array(

        'name' => __('Location','leadvisors'),

        'singular_name' => __('Location','leadvisors'),

        'menu_name' => __('Location','leadvisors'),

        'all_items' => __('All Location','leadvisors'),

        'add_new' => __('Add New','leadvisors'),

        'add_new_item' => __('Add New Location','leadvisors'),

        'edit_item' => __('Edit Location','leadvisors'),

        'new_item' => __('New Location','leadvisors'),

        'view_item' => __('View Details','leadvisors'),

        'search_items' => __('Search','leadvisors'),

        'not_found' => __('No Post Found','leadvisors'),

        'not_found_in_trash' => __('No Post Found In Trash','leadvisors'),

        'view' => __('View','leadvisors')

    );



    $args = array(

        'labels' => $labels,

        'description' => __('Leadvisors Location','leadvisors'),

        'public' => true,

        'publicly_queryable' => true,

        'exclude_from_search' => true,

        'show_in_nav_menus' => false,

        'show_ui' => true,

        'rewrite' => array('slug' => 'location'),

        'menu_position' => 7,

        'menu_icon' => 'dashicons-location',

        'supports' => array('title', 'editor','thumbnail'),

    );



    register_post_type('location', $args); //Tạo post type với slug tên là slide và các tham số trong biến $args ở trên

}

add_action('init','post_type_location_register');



?>