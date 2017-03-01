<?php get_header();
$cat_id = get_query_var( 'cat' );
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
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args_post = array( 'cat' => $cat_id, 'posts_per_archive_page' => 100, 'posts_per_page' => 100, 'paged' => $paged );
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
    <div id='press-archive-rows'>
    	<?php if($posts->have_posts()) {
    		while($posts->have_posts()) {
    			$posts->the_post(); global $post;
    			?>
        <div class='row-fluid archive-row'>
        <div class='span12'>
            <div class='archive-item'>
            <div class='archive-item-title'>
                <a class='archive-link' href='<?php echo get_permalink( get_the_id() ); ?>' target='_blank'>
                <?php the_title() ?>
                <img alt='' class='external-link' src='<?php echo get_template_directory_uri() .'/images/press_open.png'; ?>'>
                </a>
            </div>
            <div class='archive-item-date'><?php echo get_the_time( 'd.m.Y', $post ); ?></div>
            </div>
        </div>
        </div>
        <?php } } ?>
    </div>
    </div>
</section>


<?php get_footer();?>