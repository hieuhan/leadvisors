<?php 

/** Đăng ký post-type sector **/

function post_type_sector_register()

{

/*

     * Biến $label để chứa các text liên quan đến tên hiển thị của Post Type trong Admin

     */

    $labels = array(

        'name' => __('Sector','leadvisors'),

        'singular_name' => __('Sector','leadvisors'),

        'menu_name' => __('Sector','leadvisors'),

        'all_items' => __('All Sector','leadvisors'),

        'add_new' => __('Add New','leadvisors'),

        'add_new_item' => __('Add New Sector','leadvisors'),

        'edit_item' => __('Edit Sector','leadvisors'),

        'new_item' => __('New Sector','leadvisors'),

        'view_item' => __('View Details','leadvisors'),

        'search_items' => __('Search','leadvisors'),

        'not_found' => __('No Post Found','leadvisors'),

        'not_found_in_trash' => __('No Post Found In Trash','leadvisors'),

        'view' => __('View','leadvisors')

    );



    $args = array(

        'labels' => $labels,

        'description' => __('Leadvisors Sector','leadvisors'),

        'public' => true,

        'publicly_queryable' => true,

        'exclude_from_search' => true,

        'show_in_nav_menus' => false,

        'show_ui' => true,

        'rewrite' => array('slug' => 'sector'),

        'menu_position' => 9,

        'menu_icon' => 'dashicons-groups',

        'supports' => array('title', 'editor','thumbnail'),

    );



    register_post_type('sector', $args); //Tạo post type với slug tên là slide và các tham số trong biến $args ở trên

}

add_action('init','post_type_sector_register');



?>