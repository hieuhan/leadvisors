<?php get_header();

$tax_slug = get_query_var('taxonomy');

$term_slug = get_query_var('term');

$term = get_term_by('slug', $term_slug, $tax_slug);

$ancestors = get_ancestors($term->term_id, $tax_slug);

$root = count($ancestors) <= 0 ? $term : get_term($ancestors[count($ancestors) - 1], $tax_slug);

$current_year = date("Y");

// $regions = new WP_Query( 'post_type=regions' );

// $sector = new WP_Query( 'post_type=sector' );

?>

<div class='visible-phone' id='page-title'><?php echo $root->name; ?></div>

<section id='portfolio'>

    <div class='container'>

        <div class='row-fluid hidden-phone'>

            <div class='span12'>

                <h1><?php echo $root->name; ?></h1>

            </div>

        </div>

        <div class='row-fluid pad-bottom-50 hidden-phone'>

            <a class='span4 portfolio-callout' href=''>

                <img alt='' class='portfolio-callout-img' src=''>

                <img alt='' class='portfolio-callout-rope' src='<?php echo get_template_directory_uri() . "/images/portfolio_border_large.png'"; ?>'>

                <div class='portfolio-callout-table'>

                    <div class='portfolio-callout-cell'>

                    </div>

                </div>

            </a>

            <a class='span4 portfolio-callout' href=''>

                <img alt='' class='portfolio-callout-img' src=''>

                <img alt='' class='portfolio-callout-rope' src='/<?php echo get_template_directory_uri() . "/images/portfolio_border_large.png'"; ?>''>

                <div class='portfolio-callout-table'>

                    <div class='portfolio-callout-cell'>

                    </div>

                </div>

            </a>

            <a class='span4 portfolio-callout' href=''>

                <img alt='' class='portfolio-callout-img' src=''>

                <img alt='' class='portfolio-callout-rope' src='<?php echo get_template_directory_uri() . "/images/portfolio_border_large.png'"; ?>''>

                <div class='portfolio-callout-table'>

                    <div class='portfolio-callout-cell'>

                    </div>

                </div>

            </a>

        </div>



        <div data-pjax-container>

            <div class='row-fluid hidden-phone'>

                <div class='span12'>

                    <div class='portfolio-item'>

                        <div class='portfolio-year'><?php echo $current_year; ?> <span>&rsaquo;</span></div>

                    </div>

                    <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                    $args = array(

                        'post_type' => 'portfolio',

                        'posts_per_page' => -1,

                        'posts_per_archive_page' => -1,

                        'showposts' => -1,

                        $tax_slug => $term_slug,

                        'paged' => $paged

                    );

                    $portfolio = new WP_Query($args);

                    if ($portfolio->have_posts()) {

                        $portfolio_year = 0;

                        $count = 0;

                        while ($portfolio->have_posts()) {

                            $portfolio->the_post();

                            $portfolio_year = date('Y', strtotime($post->post_date));

                            if ($portfolio_year < $current_year && $count == 0) {

                                $count++; ?>

                                <div class='portfolio-item'>

                                    <div class='portfolio-year'><?php echo $portfolio_year; ?> <span>&rsaquo;</span>

                                    </div>

                                </div>

                            <?php } ?>

                            <a class='portfolio-item' href='<?php echo get_permalink(get_the_id()); ?>'>

                                <img alt='' class='portfolio-img'

                                     src='<?php if (has_post_thumbnail()) echo the_post_thumbnail_url(); ?>'>

                                <img alt='' class='portfolio-rope'

                                     src='<?php echo get_template_directory_uri() . "/images/portfolio_border.png"; ?>'>

                            </a>

                        <?php }

                        wp_reset_postdata();

                    } else {

                        echo '<p class="tac">' . __('Data is updated...', 'leadvisors') . '</p>';

                    } ?>

                </div>

            </div>

            <?php

            if ($portfolio->have_posts()) {

                $portfolio_year = 0;

                while ($portfolio->have_posts()) {

                    $portfolio->the_post();

                    $portfolio_year_ = date('Y', strtotime($post->post_date));

                    if ($portfolio_year != $portfolio_year_) {

                        $portfolio_year = $portfolio_year_;

                        ?>

                        <div class='row-fluid pad-top-20 visible-phone'>

                            <div class='portfolio-item match-height-2 span12'>

                                <div class='portfolio-year-table'>

                                    <div class='portfolio-year-cell'><?php echo $portfolio_year; ?>

                                        <span>&rsaquo;</span></div>

                                </div>

                            </div>

                        </div>

                        <?php

                    } ?>

                    <div class='row-fluid pad-top-20 visible-phone'>

                        <a class='portfolio-item match-height-2 span12'

                           href='<?php echo get_permalink(get_the_id()); ?>'>

                            <img alt='' class='portfolio-img'

                                 src='<?php if (has_post_thumbnail()) echo the_post_thumbnail_url(); ?>'>

                            <img alt='' class='portfolio-rope'

                                 src='<?php echo get_template_directory_uri() . "/images/portfolio_border.png"; ?>'>

                        </a>

                    </div>

                <?php

                }

                wp_reset_postdata();

            } else {

                echo '<p class="tac">' . __('Data is updated...', 'leadvisors') . '</p>';

            } ?>

        </div>

        <div><?php echo $root->description; ?></div>

    </div>

</section> 

<?php get_footer(); ?>

