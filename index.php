<?php get_header(); ?>
<section id="home">
 <div class="row-fluid hidden-phone">
  <div class="flexslider">
   <ul class="slides">
    <?php
    if(!$lang)
      $lang = pll_current_language('slug');
    $slides = get_posts( array( 'post_type' => 'slide', 'slide_language' => $lang, 'posts_per_page' => -1 ) ); 
    foreach ($slides as $key => $slide) {
      $imageURI = get_post_meta( $slide->ID, 'slide_image_url', true);
      $imageID = get_post_meta( $slide->ID, 'slide_image', true);
      if($imageURI) { ?>
      <li>
        <img src="<?php echo get_image_attachment_src( $imageID, 'full' ); ?>" alt="<?php echo get_the_title( $slide ); ?>" />
        <div class="slide-centered">
          <div class="white-bg">
            <h1><?php echo get_the_title( $slide ); ?></h1>
          </div>
          <a href="<?php echo $imageURI; ?>" <?php echo ((get_post_meta($slide->ID, 'slide_target', true) == 'blank') ? 'target="blank"':'') ?> ><?php _e('Read more', 'leadvisors'); ?></a>
        </div>
      </li>
      <?php } } ?>
    </ul>
  </div>
  <div class="custom-navigation">
   <a href="#" class="flex-prev"></a>
   <div class="custom-controls-container"></div>
   <a href="#" class="flex-next"></a>
 </div>
</div>
<div class="row-fluid visible-phone">
  <div>
   <ul>
    <?php $i = 0;
    foreach ($slides as $key => $slide) {
      $imageURI = get_post_meta( $slide->ID, 'slide_image_url', true);
      $imageID = get_post_meta( $slide->ID, 'slide_image', true);
      if($imageURI) { ?>
      <li class="<?php echo 'panel' . $i; ?>">
       <div>
        <div class="white-bg">
         <h1><?php echo get_the_title( $slide ); ?></h1>
       </div>
       <img src="<?php echo get_image_attachment_src( $imageID, 'full' ); ?>" alt="<?php echo get_the_title( $slide ); ?>" />
       <a href="<?php echo $imageURI; ?>" <?php echo ((get_post_meta($slide->ID, 'slide_target', true) == 'blank') ? 'target="blank"':'') ?> ><?php _e('Read more', 'leadvisors'); ?></a>
     </div>
   </li>
   <?php } $i++; } ?>
 </ul>
</div>
</div>
</section>
<section id="scripts">
 <script type="text/javascript">
  $('.flexslider').flexslider({
    animation: "slide",
    controlsContainer: ".flex-container",
    prevText: "",
    nextText: "",
    start: function (slider) {

      $('.total-slides').text(slider.count);
    },
    after: function (slider) {
      $('.current-slide').text(slider.currentSlide);
    }
  });

</script>
</section>
<?php get_footer(); ?>