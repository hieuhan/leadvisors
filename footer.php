<?php wp_footer(); ?>
<div class='navbar-fixed-top hidden-desktop'>
   <header>
      <div class='container'>
         <a href='<?php echo home_url( '/' ); ?>'>
         <img alt='' style="top: 40%;" class='logo' src='<?php echo get_template_directory_uri() . "/images/logo_leadvisors_t.png"; ?>'>
         </a>
         <ul class="lang-wrap-top" style="right: 50px;">
            <?php pll_the_languages( array(
               'show_names' => 0,
               'show_flags' => 1,
               'hide_if_empty' => 0,
               ) ); ?>
         </ul>
         <form class='search-form hidden-phone pull-right' action='/search' method="get">
            <input class='search-input placeholder' data-placeholder='Search...' type='text' name='q'>
            <button class='search-submit' type='submit'></button>
         </form>
         <div class='visible-phone'>
            <img alt='' id='phone-nav-open' src='<?php echo get_template_directory_uri() . "/images/phone_nav.png'"; ?>>
               <img alt='' id='phone-nav-close' src='<?php echo get_template_directory_uri() . "/images/phone_nav_close.png'"; ?>'>
            <img alt='' id='phone-search-open' src='<?php echo get_template_directory_uri() . "/images/phone_search.png'"; ?>'>
            <img alt='' id='phone-search-close' src='<?php echo get_template_directory_uri() . "/images/phone_nav_close.png'"; ?>'>
         </div>
      </div>
   </header>
   <?php leadvisors_custom_menus('primary-menu');  ?>
</div>
<footer class=&#39;fixedFooter&#39;>
   <div class='container'>
      <div class='hidden-phone' id='footer-desktop'>
         <div class='row-fluid' id='footer-links'>
            <div class='myspan3 request-links'>
               <p class='no-margin'>
               <div class='pdf-downloads'></div>
               </p>
            </div>
            <div class='myspan9 legal-links'>
               <p class='copyright'><?php _e('Copyright &copy; 2017 Leadvisors Capital Management. All Rights Reserved.','leadvisors');?></p>
               <?php leadvisors_custom_menus_footer('footer-menu');  ?>
            </div>
            <div class='myspan4 social-imgs'>
               <a class='social-img' href='http://twitter.com/generalatlantic' target='_blank'>
               <img alt='' src='<?php echo get_template_directory_uri() . "/images/social_twitter.png"; ?>'>
               </a>
               <a class='social-img' href='http://www.linkedin.com/company/general-atlantic' target='_blank'>
               <img alt='' src='<?php echo get_template_directory_uri() . "/images/social_linkedin.png"; ?>'>
               </a>
            </div>
         </div>
      </div>
      <div class='row-fluid visible-phone' id='footer-phone'>
         <div class='span12'>
            <?php leadvisors_custom_menus_footer_mobile('footer-menu');  ?>
            <p class='copyright'><?php _e('Copyright &copy; 2017 Leadvisors Capital Management. All Rights Reserved.','leadvisors');?></p>
         </div>
         <div class='span12 social-imgs'>
            <a class='social-img' href='http://twitter.com/generalatlantic' target='_blank'>
            <img alt='' src='<?php echo get_template_directory_uri() . "/images/social_twitter.png"; ?>'>
            </a>
            <a class='social-img' href='http://www.linkedin.com/company/general-atlantic' target='_blank'>
            <img alt='' src='<?php echo get_template_directory_uri() . "/images/social_linkedin.png"; ?>'>
            </a>
         </div>
      </div>
   </div>
</footer>
</div>
</body>
</html>