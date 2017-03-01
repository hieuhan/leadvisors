<?php

$tax_slug = get_query_var('taxonomy');

$term_slug = get_query_var('term');

$term = get_term_by('slug', $term_slug, $tax_slug);

$ancestors = get_ancestors($term->term_id, $tax_slug);

$root = count($ancestors) <= 0 ? $term : get_term($ancestors[count($ancestors) - 1], $tax_slug);

$child_terms = get_terms($tax_slug, array('hide_empty' => false, 'parent' => $root->term_id, 'orderby' => 'slug', 'order' => 'ASC'));

//$location = new WP_Query('post_type=location');

//$regions = new WP_Query('post_type=regions');

//$sector = new WP_Query('post_type=sector');

?>

<div class="visible-phone" id="page-title"><?php echo $root->name; ?></div>

<section id='people'>

    <div class='container'>

        <div class='row-fluid'>

            <div class='people-title hidden-phone'>

                <h1><?php echo $root->name; ?></h1>

            </div>

            <div class='people-title-text'>

                <?php echo $root->description; ?>

            </div>

        </div>

        <div data-pjax-container>

            <div class='box-nav hidden-phone'>

                <div class='box-nav-left-border'></div>

                <?php if (is_array($child_terms) || is_object($child_terms)) {

                    foreach ($child_terms as $child) { ?>

                        <a class='box-nav-item <?php echo $child->term_id == $term->term_id ? "active" : "" ?>'

                           data-pjax href='<?php echo get_term_link($child->name, $tax_slug) ?>'>

                            <div class='box-border-wrap'>

                                <div class='box-nav-wrap'>

                                    <span><?php echo $child->name ?></span>

                                </div>

                                <div class='box-nav-arrow'></div>

                            </div>

                        </a>

                    <?php }

                } ?>

            </div>



            <div class='mobile-box-nav visible-phone'>

                <div class='mobile-box-nav-left-border'></div>

                <div class='mobile-box-nav-item' data-nav='#people-nav-teams'>

                    <div class='mobile-box-border-wrap'>

                        <div class='mobile-box-nav-wrap'>

                            <span><?php echo $term->name ?></span>

                        </div>

                        <div class='mobile-box-nav-arrow'></div>

                    </div>

                </div>

                <div class='mobile-box-nav-options' id='people-nav-teams'>

                    <?php foreach ($child_terms as $child) { ?>

                        <div class='mobile-box-nav-option'><a data-pjax

                                                              href="<?php echo get_term_link($child->name, $tax_slug); ?>"><?php echo $child->name ?></a>

                        </div>

                    <?php } ?>

                </div>

                <div class='clearfix'></div>

            </div>



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
                'post_type' => 'people',
                'posts_per_page' => -1,
                'posts_per_archive_page' => -1,
                'showposts' => -1,
                //'meta_key' => 'location',
                //'meta_value' => '',
                $tax_slug => $term_slug,
                'paged' => $paged
            );

            $people = new WP_Query($args);

            if ($people->have_posts())
            {

            $count_people = 1;

            $close_div = false;

            while ($people->have_posts()){

            $people->the_post();

            global $post;

            if ($count_people == 1) { ?>


            <div class='row-fluid pad-top-70 no-pad-top-mobile border-top'>

                <?php } else if ($close_div == true) {

                $close_div = false; ?>

                <div class='row-fluid'>

                    <?php } ?>

                    <a class='span3 people-item' href='<?php echo get_permalink(get_the_id()); ?>'>

                        <img alt='' class='people-img'

                             src='<?php if (has_post_thumbnail()) echo the_post_thumbnail_url(); ?>'>

                        <img alt='' class='people-img-rope'

                             src='<?php echo get_template_directory_uri() . "/images/people_border.png"; ?>'>

                        <div class='vertical-center'>

                            <div class='people-item-text'>

                                <strong><?php the_title() ?><br/></strong>

                                <?php echo get_post_meta($post->ID, '_chevron', true); ?> <br>

                                <?php echo get_post_meta($post->ID, '_regions', true); ?> <br>

                                <em><?php echo get_post_meta($post->ID, '_location', true); ?></em>

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

