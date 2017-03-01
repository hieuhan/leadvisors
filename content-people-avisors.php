<?php

$tax_slug = get_query_var( 'taxonomy' );

$term_slug = get_query_var( 'term' );

$term = get_term_by( 'slug', $term_slug, $tax_slug );

$ancestors = get_ancestors( $term->term_id, $tax_slug );

$root = count( $ancestors ) <= 0 ? $term : get_term( $ancestors[count( $ancestors ) - 1], $tax_slug );

$child_terms = get_terms( $tax_slug, array( 'hide_empty' => false, 'parent' => $root->term_id, 'orderby' => 'slug', 'order' => 'ASC' ) );

// $location = new WP_Query('post_type=location');

// $regions = new WP_Query('post_type=regions');

// $sector = new WP_Query('post_type=sector');

?>

<div class='visible-phone' id='page-title'><?php echo $root->name; ?></div>

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

                <?php

                if (is_array($child_terms) || is_object($child_terms))
                {
                    foreach ($child_terms as $child) { ?>

                    <a class='box-nav-item <?php echo $child->term_id == $term->term_id ? "active" : "" ?>' data-pjax href='<?php echo get_term_link( $child->name, $tax_slug ) ?>'>

                        <div class='box-border-wrap'>

                            <div class='box-nav-wrap'>

                                <span><?php echo $child->name ?></span>

                            </div>

                            <div class='box-nav-arrow'></div>

                        </div>

                    </a>

                    <?php } }?>

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



<!--                     <div class='mobile-box-nav-item' data-nav='#people-nav-location'>

                        <div class='mobile-box-border-wrap'>

                            <div class='mobile-box-nav-wrap'>

                                <span data-filter-label='r'><?php _e('Filter by Location', 'leadvisors') ?></span>

                            </div>

                            <div class='mobile-box-nav-arrow'></div>

                        </div>

                    </div>

                    <div class='mobile-box-nav-item' data-nav='#people-nav-region'>

                        <div class='mobile-box-border-wrap'>

                            <div class='mobile-box-nav-wrap'>

                                <span data-filter-label='r'><?php _e('Filter by Region', 'leadvisors') ?></span>

                            </div>

                            <div class='mobile-box-nav-arrow'></div>

                        </div>

                    </div>

                    <div class='mobile-box-nav-item' data-nav='#people-nav-sector'>

                        <div class='mobile-box-border-wrap'>

                            <div class='mobile-box-nav-wrap'>

                                <span data-filter-label='s'><?php _e('Filter by Sector', 'leadvisors') ?></span>

                            </div>

                            <div class='mobile-box-nav-arrow'></div>

                        </div>

                    </div> -->

                    <div class='mobile-box-nav-options' id='people-nav-teams'>

                        <?php foreach ($child_terms as $child) { ?>

                        <div class='mobile-box-nav-option'><a data-pjax href="<?php echo get_term_link($child->name, $tax_slug); ?>"><?php echo $child->name ?></a>

                        </div>

                        <?php } ?>

                    </div>



<!--                     <div class='mobile-box-nav-options' id='people-nav-location'>

                        <div class='mobile-box-nav-option' data-trigger-pjax data-filter='l' value='' data-active="true">

                            <a href='<?php echo esc_url(home_url('/') . "?s=&post_type=people&_location=0") ?>'>

                                <?php _e('All Locations','leadvisors');?></a>

                            </div>

                            <?php if ($location->have_posts()) {

                                while ($location->have_posts()) {

                                    $location->the_post(); ?>

                                    <div class='mobile-box-nav-option' data-trigger-pjax data-filter='l'

                                    data-value='' data-active='false'>

                                    <a href='<?php echo esc_url(home_url('/') . "?s=&post_type=people&_location=" . $post->post_title) ?>'><?php echo $post->post_title; ?></a>

                                </div>

                                <?php }

                            } ?>

                        </div>

                        <div class='mobile-box-nav-options' id='people-nav-region'>

                            <div class='mobile-box-nav-option' data-trigger-pjax data-filter='r' data-value=''

                            data-active="true"><a

                            href='<?php echo esc_url(home_url('/')) . "?s=&post_type=people&_regions=0" ?>'><?php _e('All Regions','leadvisors');?></a></div>

                            <?php if ($regions->have_posts()) {

                                while ($regions->have_posts()) {

                                    $regions->the_post(); ?>

                                    <div class='mobile-box-nav-option' data-trigger-pjax data-filter='r'

                                    data-value='' data-active="false"><a

                                    href='<?php echo esc_url(home_url('/')) . "?s=&post_type=people&_regions=" . $post->post_title ?>'><?php echo $post->post_title; ?></a>

                                </div>



                                <?php }

                            } ?>

                        </div>

                        <div class='mobile-box-nav-options' id='people-nav-sector'>

                            <div class='mobile-box-nav-option' data-trigger-pjax data-filter='s' data-value=''

                            data-active="true"><a

                            href='<?php echo esc_url(home_url('/')) . "?s=&post_type=people&_sector=0" ?>'><?php _e('All Sectors','leadvisors');?></a></div>

                            <?php if ($sector->have_posts()) {

                                while ($sector->have_posts()) {

                                    $sector->the_post(); ?>

                                    <div class='mobile-box-nav-option' data-trigger-pjax data-filter='s'

                                    data-value='<?php echo $post->ID ?>' data-active="false"><a

                                    href='<?php echo esc_url(home_url('/')) . "?s=&post_type=people&_sector=" . $post->post_title ?>'><?php echo $post->post_title; ?></a>

                                </div>

                                <?php }

                            } ?>

                        </div> -->

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


                    <?php

                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

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

                    if ($people->have_posts()) {

                        ?>

                        <div class='people-table'>

                            <div class='row-fluid people-row hidden-phone'>

                                <div class='span3'>

                                    <strong><?php _e('Name', 'leadvisors') ?></strong>

                                </div>

                                <div class='span3'>

                                    <strong><?php _e('Title', 'leadvisors') ?></strong>

                                </div>

                                <div class='span3'>

                                    <strong><?php _e('Region', 'leadvisors') ?></strong>

                                </div>

                                <div class='span3'>

                                    <strong><?php _e('Location', 'leadvisors') ?></strong>

                                </div>

                            </div>



                            <?php while ($people->have_posts()) {

                                $people->the_post();

                                global $post; ?>



                                <div class='row-fluid people-row'>

                                    <div class='span3 name'><a href='<?php echo get_permalink(get_the_id()); ?>'><?php the_title() ?> </a></div>

                                    <div class='span3 title'><?php echo get_post_meta($post->ID, '_chevron', true); ?></div>

                                    <div class='span3 location'><?php echo get_post_meta($post->ID, '_regions', true); ?> </div>

                                    <div class='span3 location'><?php echo get_post_meta($post->ID, '_location', true); ?></div>

                                </div>

                                <?php

                            }

                            wp_reset_postdata();

                            ?>

                        </div>

                        <?php

                    } else {

                        echo '<p class="tac">' . __('Data is updated...', 'leadvisors') . '</p>';

                    } ?>


                </div>

            </div>

        </section>

