<?php get_header();

$cat = get_the_category( get_the_id() );

$ancestors = get_ancestors( $cat[0]->term_id, 'category' );

$root_id = $cat[0]->term_id; 

if(!empty($ancestors))

    $root_id = $ancestors[count( $ancestors ) - 1];

$root = get_category( $root_id );  

$cats_child = get_categories( array( 'parent' => $root->term_id, 'hide_empty' => 0 ) );

?>

<div class='visible-phone' id='page-title'>

    <?php echo $root->cat_name; ?>

    &nbsp;

    <?php  if( $cats_child != null ){

     foreach ($cats_child as $child) {

        ?>

        <a class='press-nav-mobile <?php echo ($child->cat_ID==$cat[0]->cat_ID)?'active':''; ?>' href='<?php echo get_category_link( $child->cat_ID );?>'><?php echo $child->cat_name; ?></a>

        <?php }}?>

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

            <div class='row-fluid'>

                <div class='span12'>

                    <div class='press-byline pad-bottom-50 pad-bottom-20-mobile'>

                        <?php echo get_the_time('d.m.Y', $post);?>

                    </div>

                </div>

            </div>

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


        </div>

    </section>





    <?php get_footer();?>