<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> >
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="robots" content="noodp,index,follow" />
	<meta name='revisit-after' content='1 days' />
	<meta http-equiv="content-language" content="<?php echo get_bloginfo("language") ?>" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link type="image/x-icon" rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico">
	<?php wp_head();?>
</head>
<body <?php body_class(); ?>>
  <div id='skrollr-body'>
    <div class='hidden-desktop' id='fixed-navbar-padding'></div>
    <div class='navbar-top visible-desktop'>
      <header>
        <div class='container'>
          <a href='<?php echo home_url( '/' ); ?>'>
            <img alt='' class='logo' src='<?php echo get_template_directory_uri() .'/images/logo_leadvisors_t.png'; ?>'>
          </a>
          <form class='search-form pull-right' action='<?php echo home_url( '/' ); ?>' method="get">
            <input class='search-input placeholder' data-placeholder='<?php _e('Search...','leadvisors');?>' type='text' name="s" id="s">
            <button class='search-submit' type='submit'></button>
          </form>
          <ul class="lang-wrap-top">
            <?php pll_the_languages( array(
            'show_names' => 0,
            'show_flags' => 1,
            'hide_if_empty' => 0,
            ) ); ?>
          </ul>
        </div>
      </header>
      <?php leadvisors_custom_menus('primary-menu');  ?>
    </div> 
