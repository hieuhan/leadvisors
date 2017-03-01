<?php /* Template Name: Giới thiệu - About Us */
get_header(); 
$page_child = get_pages( array( 'parent' => $post->ID, 'sort_column' => 'menu_order' ) );
if( !empty( $page_child ) ){
   wp_redirect( get_page_link( $page_child[0]->ID ) );
   exit;
}

$parent_post_id = $post->post_parent;
$parent_post_title = get_post_field('post_title', $parent_post_id );
$menus = get_pages( array( 'parent' => $parent_post_id, 'sort_column' => 'menu_order' ) ); ?>

<div class="visible-phone" id="page-title"><?php echo $parent_post_title; ?></div>

<section class="hidden-phone" id="about">
    <div class="container">
        <h1>
            <?php echo $parent_post_title; ?>
            <span id="about-subheader"></span>
        </h1>

        <div data-pjax-container="">

            <div class="box-nav hidden-phone">

                <div class="box-nav-left-border"></div>

                <?php foreach ($menus as $menu) {?>

                <a class="box-nav-item <?php echo $menu->ID == $post->ID ? 'active' : '' ?>" data-pjax="" href="<?php echo get_permalink( $menu->ID ); ?>" title="<?php echo $menu->post_title; ?>">

                    <div class="box-border-wrap">

                        <div class="box-nav-wrap">

                            <span><?php echo $menu->post_title; ?></span>

                        </div>

                        <div class="box-nav-arrow"></div>

                    </div>

                </a>
                <?php } ?>

            </div>

            <div class="row-fluid">
                <?php echo apply_filters( 'the_content', $post->post_content ); ?>
            </div>

        </div>

    </div>

</section>

<section class="visible-phone" id="about-mobile">

    <div class="container" data-pjax-container="about-mobile">

        <h1 id="collapse-1185"></h1>

        <div class="accordion" id="accordion">

            <div class="accordion-group" id="collapse-1185">

                <div class="accordion-heading">

                    <div class="accordion-toggle" data-pjax="about-mobile" data-url="/about-us/a-proud-legacy/?mobile=true#collapse-1185">

                        <?php echo $post->post_title; ?>

                    </div>

                </div>

                <div class="accordion-body collapse active">

                    <div class="accordion-inner">

                        <!-- <div class="box-nav hidden-phone">

                            <div class="box-nav-left-border"></div>

                            <a class="box-nav-item active" data-pjax="" href="http://www.generalatlantic.com/about-us/a-proud-legacy/">

                                <div class="box-border-wrap">

                                    <div class="box-nav-wrap">

                                        <span><?php echo $post->post_title; ?></span>

                                    </div>

                                    <div class="box-nav-arrow"></div>

                                </div>

                            </a>

                            <a class="box-nav-item" data-pjax="" href="http://www.generalatlantic.com/about-us/thematic-approach/">

                                <div class="box-border-wrap">

                                    <div class="box-nav-wrap">

                                        <span>Thematic Approach</span>

                                    </div>

                                    <div class="box-nav-arrow"></div>

                                </div>

                            </a>

                            <a class="box-nav-item" data-pjax="" href="http://www.generalatlantic.com/about-us/the-ga-difference/">

                                <div class="box-border-wrap">

                                    <div class="box-nav-wrap">

                                        <span>The GA Difference</span>

                                    </div>

                                    <div class="box-nav-arrow"></div>

                                </div>

                            </a>

                            <a class="box-nav-item" data-pjax="" href="http://www.generalatlantic.com/about-us/ga-value-add/">

                                <div class="box-border-wrap">

                                    <div class="box-nav-wrap">

                                        <span>GA Value Add</span>

                                    </div>

                                    <div class="box-nav-arrow"></div>

                                </div>

                            </a>

                            <a class="box-nav-item" data-pjax="" href="http://www.generalatlantic.com/about-us/philanthropy/">

                                <div class="box-border-wrap">

                                    <div class="box-nav-wrap">

                                        <span>Philanthropy</span>

                                    </div>

                                    <div class="box-nav-arrow"></div>

                                </div>

                            </a>

                        </div> -->

                        <div class="row-fluid">
                            <?php echo apply_filters( 'the_content', $post->post_content ); ?>

                        </div>            
                    </div>

                </div>

            </div>



            <?php foreach ($menus as $menu) {

                if($menu->ID != $post->ID) {?>

                <div class="accordion-group" id="collapse-<?php echo $menu->ID ?>">

                    <div class="accordion-heading">

                        <div class="accordion-toggle collapsed" data-pjax="about-mobile" data-url="<?php echo get_permalink( $menu->ID ); ?>">

                            <a href="<?php echo get_permalink( $menu->ID ); ?>" title="<?php echo $menu->post_title; ?>"><?php echo $menu->post_title; ?></a>

                        </div>

                    </div>

                    <div class="accordion-body collapse">

                        <div class="accordion-inner">

                            Loading...

                        </div>

                    </div>

                </div>

                <?php } } ?>

            </div>

        </div>

    </section>

    <?php get_footer(); ?>