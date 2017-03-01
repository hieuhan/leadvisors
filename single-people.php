<?php get_header(); ?>

    <div class='visible-phone' id='page-title'><?php _e('People','leadvisors');?></div>

    <section class='hidden-phone' id='bio'>

        <div class='container'>

            <div class='row-fluid pad-bottom-40'>

                <div class='span12 rope-bottom'>

                    <img alt='' id='print' src='<?php echo get_template_directory_uri() . '/images/print.png'; ?>'>

                </div>

            </div>

            <div class='row-fluid rope-bottom'>

                <div class='span8'>

                    <h1><?php the_title(); ?></h1>

                    <h5><?php echo get_post_meta($post->ID, '_chevron', true); ?></h5>

                    <h5><?php echo get_post_meta($post->ID, '_regions', true); ?></h5>

                    <div class='bio-copy'>

                        <div class='bio-container'>

                            <img alt='' class='bio-img print-only'

                                 src='<?php if (has_post_thumbnail()) echo the_post_thumbnail_url(); ?>'>

                            <?php echo apply_filters('the_content', $post->post_content); ?>

                        </div>

                    </div>

                    <div class='bio-toggle'></div>

                </div>

                <div class='span3 offset1'>

                    <img alt='' class='bio-img' src='<?php if (has_post_thumbnail()) echo the_post_thumbnail_url(); ?>'>

                </div>

            </div>

            <!-- <div class='row-fluid'>

                <div class='span12 pad-top-50'>

                    <h2><?php _e('Info', 'leadvisors') ?></h2>

                </div>

            </div>

            <div class='row-fluid rope-bottom' id='bio-info'>

                <div class='span3'>

                    <h4><?php _e('Location', 'leadvisors') ?></h4>

                    <?php echo get_post_meta($post->ID, '_location', true); ?>

                    <hr>

                    <h4><?php _e('Education', 'leadvisors') ?></h4>

                    <?php echo get_post_meta($post->ID, '_education', true); ?>

                    <hr>

                </div>

                <div class='span4 offset1 pad-right-15'>

                </div>

                <div class='span4'>

                </div>

            </div> -->


            <?php  

                $People_Relationship_Portfolio = new WP_Query(array(

                    'connected_type' => 'People_Relationship_Portfolio',

                    'connected_items' => get_queried_object(),

                    'nopaging' => false,

                )); 

            if($People_Relationship_Portfolio->have_posts()) {?>

            <div class='row-fluid' id='bio-board-affiliations'>

                <div class='span12 pad-top-50'>

                    <h2><?php _e('Board Affiliations', 'leadvisors'); ?></h2>

                </div>

            </div>

            <div class="rope-bottom" id="bio-board-logos">

                <?php

                    $count_portfolio = 1;

                    while ($People_Relationship_Portfolio->have_posts()) {

                        $People_Relationship_Portfolio->the_post();

                        if ($count_people == 1 || $count_people % 5 == 0) { ?>

                            <div class='row-fluid'>

                        <?php } ?>



                        <div class='span3 match-height'>

                            <div class='bio-table'>

                                <div class='bio-cell'>

                                    <a href="<?php the_permalink(); ?>"><img alt='<?php the_title() ?>'

                                                                             src='<?php if (has_post_thumbnail()) echo the_post_thumbnail_url(); ?>'/></a>

                                </div>

                            </div>

                        </div>



                        <?php if ($count_people % 4 == 0) { ?>

                            </div>

                        <?php }

                    }

                    wp_reset_postdata();

                 ?>

            </div>
            <?php } ?>





            <div class='row-fluid pad-top-20' id='people-back'>

                <div class='span12'>

                    <a href='javascript:window.history.back();'>

                        <img alt='' class='pad-top-40'

                             src='<?php echo get_template_directory_uri() . "/images/people_back.png"; ?>'>

                    </a>

                </div>

            </div>

        </div>

    </section>

    <section class='visible-phone' id='bio'>

        <div class='container'>

            <div class='row-fluid'>

                <div class='span12'>

                    <img alt='' class='bio-img match-height' src='<?php if (has_post_thumbnail()) echo the_post_thumbnail_url(); ?>'/>

                    <div class='bio-titles match-height'>

                        <div class='bio-table'>

                            <div class='bio-cell'>

                                <h1><?php the_title(); ?></h1>

                                <h4><?php echo get_post_meta($post->ID, '_chevron', true); ?></h4>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class='row-fluid'>

                <div class='span12'>

                    <div class='bio-copy'>

                        <div class='bio-container'>

                            <?php echo apply_filters('the_content', $post->post_content); ?>

                        </div>

                    </div>

                    <div class='bio-toggle'></div>

                </div>

            </div>



            <div class='row-fluid border-top-bottom'>

                <div class='span2 bio-row'>

                    <h2><?php _e('Info', 'leadvisors') ?></h2>

                </div>

                <div class='span2 bio-row border-top'>

                    <div class='bio-label'><?php _e('Location', 'leadvisors') ?></div>

                    <div class='bio-item'><?php echo get_post_meta($post->ID, '_location', true); ?></div>

                </div>

                <div class='span2 bio-row border-top'>

                    <div class='bio-label'><?php _e('Regions', 'leadvisors') ?></div>

                    <div class='bio-item'>

                        <?php echo get_post_meta($post->ID, '_regions', true); ?>



                    </div>

                </div>

                <div class='span2 bio-row border-top'>

                    <div class='bio-label'><?php _e('Sectors', 'leadvisors') ?></div>

                    <div class='bio-item'>

                        <?php echo get_post_meta($post->ID, '_sector', true); ?>

                    </div>

                </div>

                <div class='span2 bio-row border-top'>

                    <div class='bio-label'><?php _e('Education', 'leadvisors') ?></div>

                    <div class='bio-item'>

                        <?php echo get_post_meta($post->ID, '_education', true); ?>

                    </div>

                </div>

<!--                <div class='span2 bio-row border-top'>-->

<!--                    <div class='bio-label'>Board Affiliations</div>-->

<!--                    <div class='bio-item'>-->

<!--                        IHS Markit, Oak Hill Advisors, Tory Burch, Axel Springer SE-->

<!--                    </div>-->

<!--                </div>-->

            </div>

            <div class='row-fluid'>

                <div class='span12 pad-top-40'>

                    <a href='javascript:window.history.back();'>

                        <img alt='' class='bio-back' src='<?php echo get_template_directory_uri() . "/images/mobile_back.png"; ?>'>

                    </a>

                </div>

            </div>

        </div>

    </section>

<?php get_footer(); ?>