<?php
// Admin Login
add_filter( 'login_headerurl', 'loginpage_custom_link' );
function loginpage_custom_link() {
    return home_url('/');
}

add_filter( 'login_headertitle', 'change_title_on_logo' );
function change_title_on_logo() {
    return get_option('blogname');
}

add_action( 'login_enqueue_scripts', 'change_wp_admin_logo' );
function change_wp_admin_logo() { ?>
<style type="text/css">
body.login div#login{padding: 3% 0px 0px;}
body.login div#login h1 a{background: url("<?php echo get_template_directory_uri() .'/images/logo.jpg'; ?>") no-repeat center center / 100% 100%; width: 320px; height: 80px;}
</style>
<?php }

// Remove AdminBar 
// add_filter('show_admin_bar', '__return_false');

remove_action('wp_head', 'wp_generator'); 
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
add_action( 'wp_before_admin_bar_render', 'remove_edit_comments_admin_bar' );
function remove_edit_comments_admin_bar() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu( 'comments' );
}

//custom admin footer
function custom_admin_footer( $text )
{
    $text = '<p>Copyright © 2017 Leadvisors Capital Management. All rights reserved.</p>';
    return $text;
}
add_filter('admin_footer_text','custom_admin_footer');

//Xóa widget mặc định trang quản trị
function remove_default_admin_widget()
{
    //xóa widget Activity
    remove_meta_box( 'dashboard_primary' , 'dashboard' , 'side' );
    //xóa widget Phác thảo nhanh
    remove_meta_box( 'dashboard_quick_press' , 'dashboard' , 'side' );
    //xóa widget Tin nhanh
    remove_meta_box( 'dashboard_right_now' , 'dashboard' , 'normal' );
}
add_action('wp_dashboard_setup','remove_default_admin_widget');
//Xóa widget Xin chào
remove_action( 'welcome_panel', 'wp_welcome_panel' );