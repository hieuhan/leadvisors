<?php
get_header();
$tax_slug = get_query_var('taxonomy');

$term_slug = get_query_var('term');

$term = get_term_by('slug', $term_slug, $tax_slug);

$ancestors = get_ancestors($term->term_id, $tax_slug);

$root = count($ancestors) <= 0 ? $term : get_term($ancestors[count($ancestors) - 1], $tax_slug);

?>

<div class="visible-phone" id="page-title"><?php echo $root->name; ?></div>

<section id='people'>

    <div class='container'>

        <div class='row-fluid'>
            
            <div class='row-fluid hidden-phone'>

                <div class='span12'>

                    <h1><?php echo $root->name; ?></h1>

                </div>

            </div>

            <div class='datacenter-title-text'>

                <?php echo $root->description; ?>

            </div>

        </div>

        <div data-pjax-container>


            <div class='row-fluid hidden-phone'>

                <div class='span12'>

                    <p></p>

                </div>

            </div>


            <div class='row-fluid visible-phone'>

                <div class='span12'>

                    <p></p>

                </div>

            </div>



            <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            $args = array(
                'post_type' => 'datacenter',
                'posts_per_page' => -1,
                'posts_per_archive_page' => -1,
                'showposts' => -1,
                //'meta_key' => 'location',
                //'meta_value' => '',
                $tax_slug => $term_slug,
                'paged' => $paged
                );

            $datacenter = new WP_Query($args);

            if ($datacenter->have_posts())
            {

                $count_people = 1;

                $close_div = false;

                while ($datacenter->have_posts()){

                    $datacenter->the_post();

                    global $post;

                    if ($count_people == 1) { ?>


                    <div class='row-fluid pad-top-70 no-pad-top-mobile border-top'>

                        <?php } else if ($close_div == true) {

                            $close_div = false; ?>

                            <div class='row-fluid'>

                                <?php } ?>

                                <a class='span3 people-item' href='<?php echo get_post_meta($post->ID, '_datacenter_link', true); ?>'>

                                    <img alt='' class='people-img'

                                    src='<?php if (has_post_thumbnail()) echo the_post_thumbnail_url(); ?>'>

                                    <img alt='' class='people-img-rope'

                                    src='<?php echo get_template_directory_uri() . "/images/people_border.png"; ?>'>

                                    <div class='vertical-center'>

                                        <div class='people-item-text'>

                                            <strong><?php the_title() ?><br/></strong>
                                            
                                            <!-- <?php echo get_post_meta($post->ID, '_chevron', true); ?> <br>

                                            <?php echo get_post_meta($post->ID, '_regions', true); ?> <br>

                                            <em><?php echo get_post_meta($post->ID, '_location', true); ?></em> -->

                                        </div>

                                    </div>

                                </a>

                                <?php if ($count_people % 4 == 0) {

                                    $close_div = true; ?>

                                </div>



                                <?php }

                                $count_people++;

                            }

                            wp_reset_postdata();

                        } 
                        else 
                        {
                            echo '<p class="tac">' . __('Data is updated...', 'leadvisors') . '</p>';
                        } ?>

                    </div>

                </div>

            </section>
            <?php get_footer();?>

