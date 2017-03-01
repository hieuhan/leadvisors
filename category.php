<?php get_header(); 
$cat_id = get_query_var( 'cat' );
//lay metadata Category Archive
$CatMeta = get_option( 'category_' . $cat_id );
$cat = get_category( $cat );
$cat_parent=$cat;
$cats_child = null;
if( $cat->parent != 0 ){
	$cat_parent = get_category( $cat->parent );
	$args = array( 'parent' => $cat_parent->cat_ID, 'hide_empty' => 0);
	$cats_child = get_categories( $args );
}else{

	$args = array( 'parent' => $cat->cat_ID, 'hide_empty' => 0);
	$cats_child = get_categories( $args );
	if(!empty($cats_child))
	{
	   wp_redirect( get_category_link( $cats_child[0]->cat_ID ) );
	   exit;
	}
}

if($CatMeta[archive] == 1)
{
    get_template_part('content','archive'); 
}else 
{
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
//order by theo media nổi bật
$args_post = array(
        'post_type' => 'post',
        'meta_key' => '_is_media_highlights',
        'orderby'   => 'meta_value',
        'order' => 'DESC',
        'posts_per_page' => 100,
        'paged' => $paged,
        'cat' => $cat_id
        //'meta_query' => array(
            //array(
                //'key' => '_is_media_highlights',
                //'value' => 1,
                //'compare' => '=' 
                //)
            //)
        );
    $posts = new WP_Query( $args_post );

?>

<div class='visible-phone' id='page-title'>
	<?php echo $cat_parent->cat_name; ?>
	&nbsp;
	<?php  if( $cats_child != null ){
			foreach ($cats_child as $child) {
				?>
				<a class='press-nav-mobile <?php echo ($child->cat_ID==$cat_id)?'active':''; ?>' href='<?php echo get_category_link( $child->cat_ID );?>'><?php echo $child->cat_name; ?></a>
			<?php }}?>
</div>
<section id='press'>
	<div class='container'>
		<div class='row-fluid hidden-phone'>
			<div class='span12'>
				<h1>
					<?php echo $cat_parent->cat_name; ?>
					<span class='press-nav'>
						<?php  if( $cats_child != null ){
							$i=0;
							$num_ = count((array)$cats_child);
							foreach ($cats_child as $child) {
								$i++;
								?>
								<a class='<?php echo ($child->cat_ID==$cat_id)?'active':''; ?>' href='<?php echo get_category_link( $child->cat_ID );?>'><?php echo $child->cat_name; ?></a>
								<?php echo($i<$num_)?"/":'';?>
							<?php }}?>
					</span>
				</h1>
			</div>
		</div>
		<div data-pjax-container>

<!-- <div class='box-nav hidden-phone'>
    <div class='box-nav-left-border'></div>
    <a class='box-nav-item box-nav-item-3 active' data-pjax href='/media/general-atlantic/'>
    <div class='box-border-wrap'>
        <div class='box-nav-wrap'>
        <span>General Atlantic</span>
        </div>
        <div class='box-nav-arrow'></div>
    </div>
    </a>
</div -->
<div class='visible-phone'>
<?php if($posts->have_posts()) { 
	$post_first = $posts->post;
	$post_thumbnail_id = get_post_thumbnail_id( $post_first->ID );?>

	<a class='press-item-main-mobile' href='<?php echo get_permalink( $post_first->ID ); ?>'>
	<?php if($post_thumbnail_id) { ?>
		<img alt='' class='press-item-main-img-mobile match-height' src='<?php echo wp_get_attachment_image_url( $post_thumbnail_id, 'post-thumbnail') ?>'>
	<?php } ?>
		<div class='press-item-main-content-mobile match-height'>
			<div class='press-item-table'>
				<div class='press-item-cell'>
					<h2><?php echo get_the_title($post_first->ID); ?></h2>
				</div>
			</div>
		</div>
	</a>
	<?php } ?>
</div>
<!-- <div class='mobile-box-nav pad-bottom-20 visible-phone'>
	<div class='mobile-box-nav-left-border'></div>
	<a class='mobile-box-nav-item' data-pjax href='/media/general-atlantic/'>
		<div class='mobile-box-border-wrap'>
			<div class='mobile-box-nav-wrap'>
				<span>General Atlantic</span>
			</div>
			<div class='mobile-box-nav-arrow'></div>
		</div>
	</a>
	<div class='clearfix'></div>
</div> -->

<?php frontend__display_category_post_items($posts, $cat->cat_name, $cat_id, $paged ); ?>

</div>
</div>
</section>


<?php } get_footer(); ?>