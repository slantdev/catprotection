<?php

/*
*	Add all scripts in here, including their dependencies
*	The final true/false parameter determines whether to put the script in the header or footer. Nothing or false = header, true = footer.
*	Modernizr must run in the header. jQuery and the other scripts will be in the footer.
*/
function enqueue_scripts()
{
  global $post;
  $version = md5('20220815.3'); // uniqid();
  wp_enqueue_script('modernizr', get_bloginfo('template_url') . '/assets/js/modernizr.js', '', true);
  wp_enqueue_script('all', get_bloginfo('template_url') . '/assets/js/all.js', array('jquery', 'modernizr'), $version, true);
  wp_enqueue_style('all', get_bloginfo('template_url') . '/assets/css/app.css', null, $version);
  wp_localize_script('all', 'template', array('url' => get_bloginfo('template_url')));
  wp_enqueue_style('typography', 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,800', false);

  // Localizing php variables for javascript use
  wp_localize_script('all', 'volAjax', array('ajaxurl' => admin_url('admin-ajax.php')));

  wp_enqueue_style('dashicons');
  wp_enqueue_style('gforms_ready_class_css');

  wp_enqueue_script('cpvs', get_bloginfo('template_url') . '/assets/js/cp_app.js', array('jquery'), $version, true);
  wp_enqueue_style('cpvs', get_bloginfo('template_url') . '/assets/css/cp_app.css', null, $version);
}
add_action('wp_enqueue_scripts', 'enqueue_scripts');

/* add_action('gform_enqueue_scripts', 'enqueue_custom_script'); */
/* function enqueue_custom_script() */
/* { */
/*     $min = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG || isset($_GET['gform_debug']) ? '' : '.min'; */
/*     wp_enqueue_style('gforms_rtl_css', GFCommon::get_base_url() . "/css/rtl{$min}.css", null, GFCommon::$version); */
/* } */


// Custom admin script and styles
function custom_admin_scripts()
{
  wp_register_script('vnm-admin-scripts', get_bloginfo('template_url') . '/assets/js/admin.js', array('jquery'), null, false);
  wp_enqueue_style('admin-css', get_bloginfo('template_url') . '/assets/css/admin.css');
  wp_enqueue_script('vnm-admin-scripts');
}
add_action('admin_enqueue_scripts', 'custom_admin_scripts');

add_filter('woocommerce_enqueue_styles', '__return_empty_array');
