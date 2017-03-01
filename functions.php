<?php

include_once(get_template_directory() . '/includes/init.php');

//[1] Thiết lập chiều rộng nội dung tối đa 620px
if (!isset($content_width)) {
    $content_width = 620;
}

//[2] Khai báo các chức năng trong theme
if (!function_exists('leadvisors_theme_setup')) {

    function leadvisors_theme_setup()
    {
        //Thiết lập textdomain
        $language_folder = get_template_directory() . '/languages';
        load_theme_textdomain('leadvisors', $language_folder);

        //Thêm ảnh đại diện thumbnail cho post
        add_theme_support('post-thumbnails');

        //Post Format
        add_theme_support('post-formats', 
            array(
                'image',
                'video',
                'gallery',
                'quote',
                'link'
                )
            );

        //Thêm thẻ title
        add_theme_support('title-tag');

        //Custom background
        $default_background = array(
            'default-color' => '#e8e8e8'
            );
        add_theme_support('custom-background', $default_background);

        //Tạo ra vị trí hiển thị menu
        register_nav_menu('primary-menu', __('Primary Menu', 'leadvisors'));
        register_nav_menu('footer-menu', __('Footer Menu', 'leadvisors'));

        //Sidebar
        $sidebar = array(
            'name' => __('Main Sidebar', 'leadvisors'),
            'id' => 'main-sidebar',
            'description' => __('Default sidebar'),
            'class' => 'main-sidebar',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>'
            );
        register_sidebar($sidebar);
    }
    add_action('init', 'leadvisors_theme_setup');
}

//[4] Styles
function leadvisors_style()
{
    wp_register_style('main-style', get_template_directory_uri() . '/style.css', 'all');
    wp_enqueue_style('main-style');

    wp_register_style('bootstrap-style', get_template_directory_uri() . '/styles/bootstrap.css', 'all');
    wp_enqueue_style('bootstrap-style');

    wp_register_style('home-style', get_template_directory_uri() . '/styles/main.css', 'all');
    wp_enqueue_style('home-style');

    /*wp_register_style('print-style' , get_template_directory_uri() . '/styles/print.css' , 'all');
    wp_enqueue_style('print-style');
    */

    wp_register_script('modernizr-2.6.2.min', get_template_directory_uri() . '/scripts/modernizr-2.6.2.min.js', false, '2.6.2');
    wp_enqueue_script('modernizr-2.6.2.min');

    wp_register_script('jquery-1.9.1.min', get_template_directory_uri() . '/scripts/jquery-1.9.1.min.js', false, '1.9.1');
    wp_enqueue_script('jquery-1.9.1.min');

    wp_register_script('vjz4fex', get_template_directory_uri() . '/scripts/vjz4fex.js', false, '1.9.1');
    wp_enqueue_script('vjz4fex');

    wp_register_script('jquery-ui-1.10.2.min', get_template_directory_uri() . '/scripts/jquery-ui-1.10.2.min.js', false, '1.9.1');
    wp_enqueue_script('jquery-ui-1.10.2.min');

    wp_register_script('jquery.ui.touch-punch.min', get_template_directory_uri() . '/scripts/jquery.ui.touch-punch.min.js', false, '1.9.1');
    wp_enqueue_script('jquery.ui.touch-punch.min');

    wp_register_script('skrollr.min', get_template_directory_uri() . '/scripts/skrollr.min.js', false, '1.9.1');
    wp_enqueue_script('skrollr.min');

    wp_register_script('categorizr', get_template_directory_uri() . '/scripts/categorizr.js', false, '1.9.1');
    wp_enqueue_script('categorizr');

    wp_register_script('skrollr.menu', get_template_directory_uri() . '/scripts/skrollr.menu.js', false, '1.9.1');
    wp_enqueue_script('skrollr.menu');

    wp_register_script('bootstrap-transition', get_template_directory_uri() . '/scripts/bootstrap-transition.js', false, '1.9.1');
    wp_enqueue_script('bootstrap-transition');

    wp_register_script('bootstrap-collapse', get_template_directory_uri() . '/scripts/bootstrap-collapse.js', false, '1.9.1');
    wp_enqueue_script('bootstrap-collapse');

    wp_register_script('jquery.pjax', get_template_directory_uri() . '/scripts/jquery.pjax.js', false, '1.9.1');
    wp_enqueue_script('jquery.pjax');

    wp_register_script('jquery.jscroll', get_template_directory_uri() . '/scripts/jquery.jscroll.js', false, '1.9.1');
    wp_enqueue_script('jquery.jscroll');

    wp_register_script('jquery.ba-bbql', get_template_directory_uri() . '/scripts/jquery.ba-bbq.js', false, '1.9.1');
    wp_enqueue_script('jquery.ba-bbq');

    wp_register_script('main', get_template_directory_uri() . '/scripts/main.js', false, '1.9.1');
    wp_enqueue_script('main');

    wp_register_script('jquery.flexslider-min', get_template_directory_uri() . '/scripts/jquery.flexslider-min.js', false, '1.9.1');
    wp_enqueue_script('jquery.flexslider-min');
}
add_action('wp_enqueue_scripts', 'leadvisors_style');


//[5] Main menu
function leadvisors_custom_menus($slug)
{
    $menu_name = $slug;
    if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
        $menu = wp_get_nav_menu_object($locations[$menu_name]);
        $menu_items = wp_get_nav_menu_items($menu->term_id);
        $menu_list = '<nav>' . "\n";
        $menu_list .= "\t\t\t\t" . '<div class="container">' . "\n";

        foreach ((array)$menu_items as $key => $menu_item) 
        {
            $title = $menu_item->title;
            $url = $menu_item->url;
            $menu_list .= "\t\t\t\t\t" . '<a href="' . $url . '" class="">' . $title . '</a>' . "\n";
        }

        $menu_list .= "\t\t\t\t" . '</ul>' . "\n";
        $menu_list .= "\t\t\t" . '</nav>' . "\n";
    } 
    else 
    {
        $menu_list = '';
    }
    echo $menu_list;
}

//[6]
function leadvisors_custom_menus_footer($slug)
{
    $menu_name = $slug;

    if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {

        $menu = wp_get_nav_menu_object($locations[$menu_name]);

        $menu_items = wp_get_nav_menu_items($menu->term_id);

        $menu_list = '<p class="no-margin privacy-legal">' . "\n";

        $num_ = count($menu_items);

        $i_ = 0;

        foreach ((array)$menu_items as $key => $menu_item) {

            $i_++;

            $title = $menu_item->title;

            $url = $menu_item->url;

            $menu_list .= "\t\t\t\t\t" . '<a class="underline" href="' . $url . '">' . $title . '</a>' . "\n" . ($i_ < $num_ ? '&nbsp;&nbsp;' : '');

        }

        $menu_list .= '</p>' . "\n";

    } else {

        $menu_list = '';

    }

    echo $menu_list;
}

//[7]
function leadvisors_custom_menus_footer_mobile($slug)
{
    $menu_name = $slug;

    if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {

        $menu = wp_get_nav_menu_object($locations[$menu_name]);

        $menu_items = wp_get_nav_menu_items($menu->term_id);

        $menu_list = '';

        $num_ = count($menu_items);

        $i_ = 0;

        foreach ((array)$menu_items as $key => $menu_item) {

            $i_++;

            $title = $menu_item->title;

            $url = $menu_item->url;

            $menu_list .= '<a class="underline" href="' . $url . '">' . $title . '</a>' . "\n" . ($i_ < $num_ ? '&nbsp;&nbsp;|&nbsp;&nbsp;' : '');

        }

    } else {

        $menu_list = '';

    }

    echo $menu_list;
}

//[8] Đăng ký post-type
include_once(get_template_directory() . '/post-types/slide.php');
include_once(get_template_directory() . '/post-types/people.php');
include_once(get_template_directory() . '/post-types/portfolio.php');
include_once(get_template_directory() . '/post-types/location.php');
include_once(get_template_directory() . '/post-types/regions.php');
include_once(get_template_directory() . '/post-types/sector.php');
include_once(get_template_directory() . '/post-types/datacenter.php');

//[9] lay anh dinh kem theo Id
function get_image_attachment_src($attachmentID, $size = 'thumbnail')
{
    $imageSrc = get_template_directory_uri() . '/images/default-'. $size .'.png';

    if( wp_attachment_is_image( $attachmentID ) ) {
        $imageInfo = wp_get_attachment_image_src( $attachmentID, $size);
        $imageSrc = $imageInfo[0];
    }

    return $imageSrc;
}

//[10] lay duong dan anh dinh kem theo id ajax
add_action('wp_ajax_get_attachment_src', 'get_attachment_src_ajax');
add_action('wp_ajax_nopriv_get_attachment_src', 'get_attachment_src_ajax');
function get_attachment_src_ajax() {
    echo get_image_attachment_src( $_GET['attachment'], $_GET['size'] );
    exit;
}





///////////////////////
//add extra fields to custom taxonomy edit form callback function

function extra_tax_fields($tag)

{

    //check for existing taxonomy meta for term ID

    $t_id = $tag->term_id;

    $term_meta = get_option("taxonomy_$t_id");

    ?>



    <tr class="form-field">

        <th scope="row" valign="top"><label for="avisors"><?php _e('Avisors', 'leadvisors'); ?></label></th>

        <td>

            <select name="term_meta[avisors]" id="term_meta[avisors]">

                <option

                value="0" <?php echo $term_meta['avisors'] == 0 ? 'selected' : ''; ?>><?php _e('No', 'leadvisors'); ?></option>

                <option

                value="1" <?php echo $term_meta['avisors'] == 1 ? 'selected' : ''; ?>><?php _e('Yes', 'leadvisors'); ?></option>

            </select>

        </td>

    </tr>

    <?php }



// save extra taxonomy fields callback function

    function save_extra_taxonomy_fields($term_id)

    {

        if (isset($_POST['term_meta'])) {

            $t_id = $term_id;

            $term_meta = get_option("taxonomy_$t_id");

            $cat_keys = array_keys($_POST['term_meta']);

            foreach ($cat_keys as $key) {

                if (isset($_POST['term_meta'][$key])) {

                    $term_meta[$key] = $_POST['term_meta'][$key];

                }

            }

            update_option("taxonomy_$t_id", $term_meta);

        }

    }





    add_action('people_categories_add_form_fields', 'extra_tax_fields', 10, 2);

    add_action('created_people_categories', 'save_extra_taxonomy_fields', 10, 2);



    add_action('people_categories_edit_form_fields', 'extra_tax_fields', 10, 2);

    add_action('edited_people_categories', 'save_extra_taxonomy_fields', 10, 2);





//Add custom field kiểu hiển thị chuyên mục

    function extra_category_fields($tag)

    {

        $t_id = $tag->term_id;

        $cat_meta = get_option("category_$t_id");

        ?>

        <tr class="form-field">

            <th scope="row" valign="top"><label for="cat_meta['archive']"><?php _e('Archive'); ?></label></th>

            <td>

                <select name="cat_meta[archive]" id="cat_meta[archive]">

                    <option

                    value="0" <?php echo $cat_meta['archive'] == 0 ? 'selected' : ''; ?>><?php _e('No', 'leadvisors'); ?></option>

                    <option

                    value="1" <?php echo $cat_meta['archive'] == 1 ? 'selected' : ''; ?>><?php _e('Yes', 'leadvisors'); ?></option>

                </select>

            </td>

        </tr>



        <?php

    }



    function save_extra_category_fileds($term_id)

    {

        if (isset($_POST['cat_meta'])) {

            $t_id = $term_id;

            echo $t_id;

            $cat_meta = get_option("category_$t_id");

            $cat_keys = array_keys($_POST['cat_meta']);

            foreach ($cat_keys as $key) {

                if (isset($_POST['cat_meta'][$key])) {

                    $cat_meta[$key] = $_POST['cat_meta'][$key];

                }

            }

            update_option("category_$t_id", $cat_meta);

        }

    }



    add_action('category_add_form_fields', 'extra_category_fields', 10, 2);

    add_action('created_category', 'save_extra_category_fileds', 10, 2);

    add_action('category_edit_form_fields', 'extra_category_fields', 10, 2);

    add_action('edited_category', 'save_extra_category_fileds', 10, 2);





//Metabox Thông tin thêm - postype People

    add_action('add_meta_boxes', 'add_people_more_infomation_metaboxes');



    function add_people_more_infomation_metaboxes()

    {



        add_meta_box('people_more_infomation_location', __('More information', 'leadvisors'), 'people_more_infomation', 'people', 'side', 'default');



    }



    function people_more_infomation()

    {



        global $post;



        echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' .



        wp_create_nonce(plugin_basename(__FILE__)) . '" />';



        $chevron = get_post_meta($post->ID, '_chevron', true);

        $education = get_post_meta($post->ID, '_education', true);

        $locations_value = get_post_meta($post->ID, '_location', true);

        $regions_value = get_post_meta($post->ID, '_regions', true);

        $sector_value = get_post_meta($post->ID, '_sector', true);



        echo '<p><b>' . __('Chevron', 'leadvisors') . ' :</b></p>' .

        '<input type="text" name="_chevron" value="' . $chevron . '" class="widefat" />' .

        '<p><b>' . __('Education', 'leadvisors') . ' :</b></p>' .

        '<input type="text" name="_education" value="' . $education . '" class="widefat" />';



        $locations = new WP_Query('post_type=location');

        if ($locations->have_posts()) {

            echo '<p><b>' . __('Location', 'leadvisors') . ' :</b></p><select name="_location">';



            while ($locations->have_posts()) {

                $locations->the_post();

                echo '<option value="' . $post->post_title . '" ' . ($locations_value == $post->post_title ? "selected" : "") . '>' . $post->post_title . '</option>';

            }

            echo '</select>';

        }



        $regions = new WP_Query('post_type=regions');

        if ($regions->have_posts()) {

            echo '<p><b>' . __('Regions', 'leadvisors') . ' :</b></p><select name="_regions">';

            while ($regions->have_posts()) {

                $regions->the_post();

                echo '<option value="' . $post->post_title . '" ' . ($regions_value == $post->post_title ? "selected" : "") . '>' . $post->post_title . '</option>';

            }

            echo '</select>';

        }



        $sector = new WP_Query('post_type=sector');

        if ($sector->have_posts()) {

            echo '<p><b>' . __('Sector', 'leadvisors') . ' :</b></p><select name="_sector">';

            while ($sector->have_posts()) {

                $sector->the_post();

                echo '<option value="' . $post->post_title . '" ' . ($sector_value == $post->post_title ? "selected" : "") . '>' . $post->post_title . '</option>';

            }

            echo '</select>';



        }





    }



// Save the Metabox Data



    function metabox_save_people_meta($post_id, $post)

    {

        if (!wp_verify_nonce($_POST['eventmeta_noncename'], plugin_basename(__FILE__))) {



            return $post->ID;

        }



    // Is the user allowed to edit the post or page?

        if (!current_user_can('edit_post', $post->ID))



            return $post->ID;



        $chevron = sanitize_text_field($_POST['_chevron']);

        update_post_meta($post->ID, '_chevron', $chevron);



        $education = sanitize_text_field($_POST['_education']);

        update_post_meta($post->ID, '_education', $education);



        $location = $_POST['_location'];

        update_post_meta($post->ID, '_location', $location);



        $regions = $_POST['_regions'];

        update_post_meta($post->ID, '_regions', $regions);



        $sector = $_POST['_sector'];

        update_post_meta($post->ID, '_sector', $sector);



    }



    add_action('save_post', 'metabox_save_people_meta', 1, 2);





//Metabox Thông tin thêm - postype Portfolio

    add_action('add_meta_boxes', 'add_portfolio_more_infomation_metaboxes');



    function add_portfolio_more_infomation_metaboxes()

    {



        add_meta_box('portfolio_more_infomation_location', __('More information', 'leadvisors'), 'portfolio_more_infomation', 'portfolio', 'side', 'default');



    }



    function portfolio_more_infomation()

    {



        global $post;



        echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' .



        wp_create_nonce(plugin_basename(__FILE__)) . '" />';



        $website_url = get_post_meta($post->ID, '_website_url', true);

        $headquarters = get_post_meta($post->ID, '_headquarters', true);

        $regions_value = get_post_meta($post->ID, '_regions', true);

        $sector_value = get_post_meta($post->ID, '_sector', true);



        echo '<p><b>' . __('Headquarters', 'leadvisors') . ' :</b></p>' .

        '<input type="text" name="_headquarters" value="' . $headquarters . '" class="widefat" />' .

        '<p><b>' . __('Website Url', 'leadvisors') . ' :</b></p>' .

        '<input type="text" name="_website_url" value="' . $website_url . '" class="widefat" />';



        $regions = new WP_Query('post_type=regions');

        if ($regions->have_posts()) {

            echo '<p><b>' . __('Regions', 'leadvisors') . ' :</b></p><select name="_regions">';

            while ($regions->have_posts()) {

                $regions->the_post();

                echo '<option value="' . $post->post_title . '" ' . ($regions_value == $post->ID ? "selected" : "") . '>' . $post->post_title . '</option>';

            }

            echo '</select>';

        }



        $sector = new WP_Query('post_type=sector');

        if ($sector->have_posts()) {

            echo '<p><b>' . __('Sector', 'leadvisors') . ' :</b></p><select name="_sector">';

            while ($sector->have_posts()) {

                $sector->the_post();

                echo '<option value="' . $post->post_title . '" ' . ($sector_value == $post->ID ? "selected" : "") . '>' . $post->post_title . '</option>';

            }

            echo '</select>';



        }





    }



// Save the Metabox Data



    function metabox_save_portfolio_meta($post_id, $post)

    {

        if (!wp_verify_nonce($_POST['eventmeta_noncename'], plugin_basename(__FILE__))) {



            return $post->ID;

        }



    // Is the user allowed to edit the post or page?

        if (!current_user_can('edit_post', $post->ID))



            return $post->ID;



        $headquarters = sanitize_text_field($_POST['_headquarters']);

        update_post_meta($post->ID, '_headquarters', $headquarters);



        $website_url = sanitize_text_field($_POST['_website_url']);

        update_post_meta($post->ID, '_website_url', $website_url);



        $regions = $_POST['_regions'];

        update_post_meta($post->ID, '_regions', $regions);



        $sector = $_POST['_sector'];

        update_post_meta($post->ID, '_sector', $sector);



    }



    add_action('save_post', 'metabox_save_portfolio_meta', 1, 2);





//Metabox Media nổi bật - post

    add_action('add_meta_boxes', 'add_media_highlights_metaboxes');



    function add_media_highlights_metaboxes()

    {



        add_meta_box('media_highlights_location', __('More information', 'leadvisors'), 'media_highlights', 'post', 'side', 'default');



    }



    function media_highlights()

    {



        global $post;



        echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' .



        wp_create_nonce(plugin_basename(__FILE__)) . '" />';



        $is_media_highlights = get_post_meta($post->ID, '_is_media_highlights', true);



        echo '<p><b>' . __('Media Highlights', 'leadvisors') . ' :</b></p>' .

        '<select name="_is_media_highlights">' .

        '<option value="0" ' . ($is_media_highlights == 0 ? "selected" : "") . ' >' . __('No', 'leadvisors') . '</option>' .

        '<option value="1" ' . ($is_media_highlights == 1 ? "selected" : "") . ' >' . __('Yes', 'leadvisors') . '</option>' .

        '</select>';



    }



// Save the Metabox Data

    function metabox_media_highlights($post_id, $post)

    {

        if (!wp_verify_nonce($_POST['eventmeta_noncename'], plugin_basename(__FILE__))) {



            return $post->ID;

        }



    // Is the user allowed to edit the post or page?

        if (!current_user_can('edit_post', $post->ID))



            return $post->ID;



        $is_media_highlights = sanitize_text_field($_POST['_is_media_highlights']);

        update_post_meta($post->ID, '_is_media_highlights', $is_media_highlights);

    }



    add_action('save_post', 'metabox_media_highlights', 1, 2);



//Metabox Media color title

    add_action('add_meta_boxes', 'add_media_colortitle_metaboxes');



    function add_media_colortitle_metaboxes()

    {



        add_meta_box('media_colortitle_location', __('More information', 'leadvisors'), 'media_colortitle', 'post', 'side', 'default');

    }



    function media_colortitle()

    {



        global $post;



        echo '<input type="hidden" name="eventmeta_noncename_colortitle" id="eventmeta_noncename_colortitle" value="' .



        wp_create_nonce(plugin_basename(__FILE__)) . '" />';



        $is_media_colortitle = get_post_meta($post->ID, '_is_media_colortitle', true);



        echo '<p><b>' . __('Color Title', 'leadvisors') . ' :</b></p>' .

        '<select name="_is_media_colortitle">' .

        '<option value="0" ' . ($is_media_colortitle == 0 ? "selected" : "") . ' >' . __('Blue', 'leadvisors') . '</option>' .

        '<option value="1" ' . ($is_media_colortitle == 1 ? "selected" : "") . ' >' . __('White', 'leadvisors') . '</option>' .

        '</select>';



    }



// Save the Metabox Data

    function metabox_media_colortitle($post_id, $post)

    {

        if (!wp_verify_nonce($_POST['eventmeta_noncename_colortitle'], plugin_basename(__FILE__))) {



            return $post->ID;

        }



    // Is the user allowed to edit the post or page?

        if (!current_user_can('edit_post', $post->ID))



            return $post->ID;



        $is_media_colortitle = sanitize_text_field($_POST['_is_media_colortitle']);

        update_post_meta($post->ID, '_is_media_colortitle', $is_media_colortitle);

    }



    add_action('save_post', 'metabox_media_colortitle', 1, 2);





//Post Relationship

function People_Relationship_Portfolio()

{

    p2p_register_connection_type(array(

        'name' => 'People_Relationship_Portfolio',

        'from' => 'people',

        'to' => 'portfolio'

        ));

}



add_action('p2p_init', 'People_Relationship_Portfolio');


// Display category post items

    function frontend__display_category_post_items($posts, $parrent_cat_name, $cat_id, $paged)
    {

    //$args = array( 'cat' => $cat_id, 'posts_per_archive_page' => 100, 'posts_per_page' => 100, 'paged' => $paged );

    //order by theo media nổi bật

        if ($posts->have_posts()) {

            $index = 0;

            while ($posts->have_posts()) {

                $posts->the_post();

                global $post;

                if ($index == 0 || $index % 3 == 0) { ?>

                <div class='row-fluid'>

                    <?php }


                    if ($index == 0) { ?>

                    <div class='span8 hidden-phone'>

                        <a class='press-item press-item-large' href='<?php echo get_permalink(get_the_id()); ?>'>

                            <?php if (has_post_thumbnail()) { ?>

                            <img alt='' class='press-item-img-large' src='<?php echo the_post_thumbnail_url(); ?>'>

                            <?php } ?>

                            <img alt='' class='press-item-img-large-rollover'

                            src='<?php echo get_template_directory_uri() . '/images/press_item_rollover_large.png'; ?>'>

                            <div class='press-item-content-large'>

                                <div class='press-item-date-large'>

                                    <em><?php echo get_the_time('d.m.Y', $post); ?></em>

                                    <span>- <?php echo $parrent_cat_name; ?></span>

                                </div>

                                <h2><?php echo wp_trim_words(get_the_title(), 8, '...'); ?></h2>

                            </div>

                        </a>

                    </div>

                    <?php } else {

                        $meta_colortitle = 0;

                        $meta_colortitle = get_post_meta(get_the_id(), '_is_media_colortitle', true);

                        if ($meta_colortitle) {

                            $meta_colortitle = $meta_colortitle;

                        } else {

                            $meta_colortitle = 0;

                        }

                        ?>

                        <div class='span4'>

                            <a class='press-item press-item-small blue' href='<?php echo get_permalink(get_the_id()); ?>'>

                                <?php if (has_post_thumbnail()) { ?>

                                <img alt='' class='press-item-img-small match-height-2'

                                src='<?php echo the_post_thumbnail_url(); ?>'>

                                <?php } ?>

                                <img alt='' class='press-item-img-small-rollover'

                                src='<?php echo get_template_directory_uri() . '/images/press_item_rollover_small.png'; ?>'>

                                <div class='press-item-content-small match-height-2'>

                                    <div class='press-item-table'>

                                        <div class='press-item-cell'>

                                            <div

                                            class='press-item-date-small <?php echo $meta_colortitle == 1 ? 'colorwhite_media' : ''; ?>'>

                                            <em><?php echo get_the_time('d.m.Y', $post); ?></em>

                                            <span>- <?php echo $parrent_cat_name; ?></span>

                                        </div>

                                        <h3 class='<?php echo $meta_colortitle == 1 ? 'colorwhite_media' : ''; ?>'><?php echo wp_trim_words(get_the_title(), 10, '...'); ?></h3>

                                    </div>

                                </div>

                            </div>

                        </a>

                    </div>

                    <?php } ?>



                    <?php if ($index>0&&$index % 3 == 2) { ?>

                </div>

                <?php }

                $index++;

            }

            wp_reset_postdata();

        }

    }

//Metabox Data center link

add_action('add_meta_boxes', 'add_datacenter_link_metaboxes');


function add_datacenter_link_metaboxes()
{
    add_meta_box('datacenter_link_location', __('More information', 'leadvisors'), 'datacenter_link', 'datacenter', 'side', 'default');
}


function datacenter_link()
{
    global $post;

    echo '<input type="hidden" name="eventmeta_noncename_datacenter_link" id="eventmeta_noncename_datacenter_link" value="' .
    wp_create_nonce(plugin_basename(__FILE__)) . '" />';

    $datacenter_link = get_post_meta($post->ID, '_datacenter_link', true); 
    echo '<p>'. __('Data center URI :', 'leadvisors'). '</p>'.
    '<input type="text" name="_datacenter_link" class="large-text code" value="'. get_post_meta($post->ID, '_datacenter_link', true) .'">';
}



// Save the Metabox Data
function metabox_datacenter_link_save($post_id, $post)
{
    if (!wp_verify_nonce($_POST['eventmeta_noncename_datacenter_link'], plugin_basename(__FILE__))) {
        return $post->ID;
    }
// Is the user allowed to edit the post or page?
    if (!current_user_can('edit_post', $post->ID))
        return $post->ID;

    $datacenter_link = sanitize_text_field($_POST['_datacenter_link']);

    update_post_meta($post->ID, '_datacenter_link', $datacenter_link);

}



add_action('save_post', 'metabox_datacenter_link_save', 1, 2);