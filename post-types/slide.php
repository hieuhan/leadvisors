<?php 
/* Register post type */
add_action('init', 'post_type_banner_register');
function post_type_banner_register() {
   $labels = array(
        'name' => __('Slides','leadvisors'),
        'singular_name' => __('Slide','leadvisors'),
        'all_items' => __('All Slides','leadvisors'),
        'add_new' => __('Add New','leadvisors'),
        'add_new_item' => __('Add New Slide','leadvisors'),
        'edit_item' => __('Edit Slide','leadvisors'),
        'new_item' => __('New Slide','leadvisors'),
        'view_item' => __('View Details','leadvisors'),
        'search_items' => __('Search Slide','leadvisors'),
        'not_found' =>  __('No Slide was found with that criteria','leadvisors'),
        'not_found_in_trash' => __('No Slide found in the Trash with that criteria','leadvisors'),
        'view' =>  __('View Slide','leadvisors')
    );

    $args = array(
        'labels' => $labels,
        'description' => 'Slide manager',
        'public' => false,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'show_ui' => true,
        'menu_position' => 6,
        'menu_icon' => 'dashicons-images-alt2',
        'supports' => array('title')
    );

    register_post_type('slide', $args);

    register_taxonomy('slide_language', 'slide', array(
    'label' => __('Language','leadvisors'),
    'singular_label' => __('Language','leadvisors'),
    'public' => true,
    'show_in_nav_menus' => true,
    'show_admin_column' => true,
    'hierarchical' => true,
    ));
}

//Metabox chon anh slide
add_action( 'add_meta_boxes_slide', 'slide_image_meta_box' );
function slide_image_meta_box() {
    add_meta_box(
        'slide_image_meta_box',
        __('Click to select the picture as a slide','leadvisors'),
        'slide_image_meta_box_callback',
        'slide',
        'normal',
        'core'
    );

    function slide_image_meta_box_callback( $post ) {
        wp_enqueue_media(); 
        wp_nonce_field( 'slide_meta_box', 'slide_meta_box_nonce' );
        $SlideImage = get_post_meta( $post->ID, 'slide_image', true ); ?>
        
        <div style="padding-top:6px;">
            <img id="slide_image_display" src="<?php echo get_image_attachment_src( $SlideImage, 'full' );?>" title="<?php __('Change image','leadvisors');?>" style="display:block; max-width:100%; max-height:483px; margin:0 auto; cursor:pointer;">
            <input id="slide_image_value" name="slide_image" type="hidden"  value="<?php echo $SlideImage ;?>" />
        </div>

        <script>
            jQuery(document).ready(function($) {
                $('#slide_image_display').click(function(event) {
                    var thisImage = $(this);
                    var fileFrame = wp.media.frames.fileFrame = wp.media({
                        title: '<?php _e('Select image','leadvisors');?>',
                        library: {type: 'image'},
                        button: {text: '<?php _e('Select','leadvisors');?>'},   
                        multiple: false
                    });

                    var thisImageID = $('#slide_image_value').val();

                    if( thisImageID ) {
                        fileFrame.on('open', function() {
                            var selection = fileFrame.state().get('selection');
                            var attachment = wp.media.attachment( thisImageID );
                            attachment.fetch();
                            selection.add( attachment ? [ attachment ] : [] );
                        });
                    }

                    fileFrame.on( 'select', function() {
                        attachment = fileFrame.state().get('selection').first().toJSON();

                        $.ajax({
                            url: ajaxurl,
                            data: {
                                action: 'get_attachment_src',
                                attachment: attachment.id,
                                size: 'full'
                            },
                            success: function(response) {
                                if(response) {
                                    $(thisImage).attr('src', response);
                                    $('#slide_image_value').val( attachment.id );
                                }
                            }
                        });
                    });

                    fileFrame.open();
                });
            });
        </script>
        <?php
    }
}


/* Slide meta box info */
add_action( 'add_meta_boxes_slide', 'slide_info_meta_box' );
function slide_info_meta_box() {
    add_meta_box(
        'slide_info_meta_box',
        __('Slide more infomation','leadvisors'),
        'slide_info_meta_box_callback',
        'slide',
        'normal',
        'core'
    );

    function slide_info_meta_box_callback( $post ) { ?>
        <table class="form-table banner-general">
            <tr>
                <th><?php _e('Image URL','leadvisors') ?></th>
                <td><input name="slide_image_url" class="large-text code" type="text" value="<?php echo get_post_meta($post->ID, 'slide_image_url', true);?>" /></td>
            </tr>   
            <tr>
                <th><?php _e('Title','leadvisors') ?></th>
                <td>
                    <input name="slide_title" class="large-text code" type="text" value="<?php echo get_post_meta($post->ID, 'slide_title', true);?>" />
                </td>
            </tr>           
            <tr>
                <th>Target</th>
                <td>
                    <input <?php checked( get_post_meta($post->ID, 'slide_target', true), 'blank' );?> id="slide_target" name="slide_target" type="checkbox" value="blank" />
                    <label for="slide_target"><?php _e('Open the link in a new window','leadvisors') ?></label>
                </td>
            </tr>
        </table>
        <?php
    }
}

/* Save slide meta-box */
add_action( 'save_post', 'slide_save_meta_box_data' );
function slide_save_meta_box_data( $postID ) {
    if ( ! isset( $_POST['slide_meta_box_nonce'] ) )
    return;
    
    if ( ! wp_verify_nonce( $_POST['slide_meta_box_nonce'], 'slide_meta_box' ) )
    return;

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
    return;     

    $slideAttrs = array(
        'slide_image',
        'slide_image_url',
        'slide_title',
        'slide_target',
    );

    foreach ( $slideAttrs as $slideAttr ) {
        $attrValue = sanitize_text_field( $_POST[$slideAttr] );
        update_post_meta( $postID, $slideAttr, $attrValue );
    }
}


/* them cot hien thi anh */
add_filter( 'manage_edit-slide_columns', 'leadvisors_custom_slide_columns' );
function leadvisors_custom_slide_columns( $columns ) {
    $newCollumns = array();
    foreach ( $columns as $key => $column ) {
        $newCollumns[$key] = $column;

        if( $key == 'title' ) {
            $preview = __('Preview','leadvisors');
            $title = __('Slide title','leadvisors');
            $newCollumns = array_merge( $newCollumns, array('slide_preview' => $preview));
            $newCollumns = array_merge( $newCollumns, array('slide_title' => $title) );
        }
    }

    return $newCollumns;
}


/* Them noi dung cho cot hien thi them thong tin slide */
add_action( 'manage_slide_posts_custom_column', 'leadvisors_manage_slide_columns', 10, 2 );
function leadvisors_manage_slide_columns( $column, $postID ) {
    if( $column == 'slide_preview' ) {
        $imageID = get_post_meta( $postID, 'slide_image', true);
        echo '<img width="100%" src="'. get_image_attachment_src( $imageID, 'small' ) .'"/>';
    }

    if( $column == 'slide_title' ) {
        echo get_post_meta( $postID, 'slide_title', true);
    }
}


function frontend__display_home_slide($lang = ''){
    if(!$lang)
        $lang = pll_current_language('slug');

    $html = '';
    $classes = array('slide-wrap', 'posr', 'slideshow', 'control');

    $class_str = implode(' ', $classes);
    $html = '<div class="'. $class_str .'"><ul class="slides lsn clearfix">';
    $slides = get_posts( array( 'post_type' => 'slide', 'slide_language' => $lang, 'posts_per_page' => -1 ) );
    foreach ($slides as $skey => $slide) {
        $imageURI = get_post_meta( $slide->ID, 'slide_image_url', true);
        $imageID = get_post_meta( $slide->ID, 'slide_image', true);

        $html .= '<li>';
        if($imageURI) $html .= '<a href="'. $imageURI .'" title="'. get_the_title( $slide ) .'" '. ((get_post_meta($slide->ID, 'slide_target', true) == 'blank') ? 'target="blank"':'') .'>';
        $html .= '<img width="100%" src="'. get_image_attachment_src( $imageID, 'full' ) .'"/>';
        if($imageURI) $html .= '</a>';
        $html .= '</li>';
    }
    $html .= '</ul></div>';

    echo $html;
}
