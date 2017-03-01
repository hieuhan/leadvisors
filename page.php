<?php get_header();?>
<div class='visible-phone' id='page-title'>
    <?php the_title() ?>  
</div>
<section id='press-detail'>

    <div class='container'>

    <div class='row-fluid pad-bottom-5'>

        <div class='span9'>

        <h1><?php the_title() ?></h1>

        </div>

        <div class='span3 press-detail-logo hidden-phone'>

        </div>

    </div>

<!--     <div class='row-fluid'>

        <div class='span12'>

        <div class='press-byline pad-bottom-50 pad-bottom-20-mobile'>

            <?php echo get_the_time('d.m.Y', $post);?>        </div>

        </div>

    </div> -->

    <div class='row-fluid rope-bottom hidden-phone'>

        <div class='span12 pad-bottom-30'>

            <?php echo apply_filters( 'the_content', $post->post_content ); ?>

        </div>

    </div>

    <div class='row-fluid visible-phone'>

        <div class='span12'>

        <div class='press-body'>

            <?php echo apply_filters( 'the_content', $post->post_content ); ?>

        </div>

        <div class='press-toggle'></div>

        </div>

    </div>

</section>

<?php get_footer(); ?>