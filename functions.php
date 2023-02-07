<?php

defined('WP_ENV') || define('WP_ENV', 'production');

if (class_exists('ACF')) {
  require_once dirname(__FILE__) . '/assets/inc/_debug-acf.php';
}

// set locale and timezone
setlocale(LC_ALL, 'en_AU');
define('GOOGLE_API_KEY', 'AIzaSyA_MeLDkPc2-D_Fu-5DhIrKpJDWzCkN86s');
define('GOOGLE_SERVER_API_KEY', 'AIzaSyDq18fUK0WeEIypyHvcAILPjTpkFKcZNao');
// Google Maps API Key for ACF
add_filter('acf/settings/google_api_key', function () {
  return GOOGLE_API_KEY;
});

// remove unwanted functionality
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // index link
remove_action('wp_head', 'parent_post_rel_link', 10, 3); // prev link
remove_action('wp_head', 'start_post_rel_link', 10, 3); // start link
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 3); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version

add_theme_support('post-thumbnails');
add_theme_support('menus');
add_post_type_support('post', 'excerpt');

// define image sizes that aren't defined in the WP settings
// thumbnail, medium, and large are defined in WP settings

// Contributors should just upload a single 3840 x 2160 image
// which will be utilised using the 'full' image name
add_image_size('hd', 1920, 1080, true);
add_image_size('banner_interior', 3840, 1240, true);
add_image_size('hero', 1920, 900, true);
add_image_size('banner_interior_mobile', 2000, 720, true);
add_image_size('banner', 1920, 600, true);
add_image_size('gallery_tiles', 580, 580, true);
add_image_size('slider_images', 944, 944, true);
add_image_size('slider_entrants_images', 1200, 900, true);
add_image_size('slider_entrants_thumbnails', 570, 430, true);

// Add custom image upload mime types
add_filter('upload_mimes', 'catpro_upload_mime_types');

// Add the custom sizes to the media library insertion menu
add_filter('image_size_names_choose', 'add_custom_sizes_to_media_insert');


function add_custom_sizes_to_media_insert($sizes)
{
  return array_merge($sizes, array(
    'hd' => __('Full HD - 1920 x 1080'),
  ));
}

add_filter('max_srcset_image_width', 'increase_max_srcset_image_width', 10, 2);

function increase_max_srcset_image_width()
{
  return 3840;
}

function catpro_upload_mime_types($mimes)
{
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}

// function wrapper for responsive image markup
function get_responsive_image($image_id, $image_size, $max_width, $class, $alt)
{
  if ($image_id != '') {
    $image_src = wp_get_attachment_image_url($image_id, $image_size);
    $image_srcset = wp_get_attachment_image_srcset($image_id, $image_size);
    echo '<img class="' . esc_attr($class) . '" data-lazy-src="' . esc_url($image_src) . '" src="' . esc_url($image_src) . '" srcset="' . esc_attr($image_srcset) . '" sizes="(max-width: ' . esc_attr($max_width) . ') 100vw, ' . esc_attr($max_width) . '" alt="' . esc_attr($alt) . '">';
  }
}

// Standard includes
require_once(dirname(__FILE__) . '/assets/inc/enqueue.php');
require_once(dirname(__FILE__) . '/assets/inc/shortcodes.php');
require_once(dirname(__FILE__) . '/assets/inc/custom-post-types.php');
require_once(dirname(__FILE__) . '/assets/inc/custom-taxonomies.php');
require_once(dirname(__FILE__) . '/assets/inc/ajax-process.php');
require_once(dirname(__FILE__) . '/assets/inc/acf.php');
require_once(dirname(__FILE__) . '/assets/inc/gravity-forms-hooks.php');
require_once(dirname(__FILE__) . '/assets/inc/woocommerce.php');

/**
 * Wrap printr Development
 */
function preint_r($array)
{
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}

if (!function_exists('dBug')) {
  function dBug($var)
  {
    echo '<pre>';
    print_r($var);
    echo '</pre>';
  }
}

if (!function_exists('eLog')) {
  function eLog($var)
  {
    if (is_array($var) || is_object($var)) {
      error_log(print_r($var, true));
    } else {
      error_log($var);
    }
  }
}

// Disable the ridiculous emoji code that was rolled into core WP
add_filter('emoji_svg_url', '__return_false');

function disable_emojicons_tinymce($plugins)
{
  if (is_array($plugins)) {
    return array_diff($plugins, array('wpemoji'));
  } else {
    return array();
  }
}


add_filter('regenerate_thumbs_cap', function ($capability) {
  // See https://codex.wordpress.org/Roles_and_Capabilities
  return 'upload_files';
});

function disable_wp_emojicons()
{

  // all actions related to emojis
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');

  // filter to remove TinyMCE emojis
  add_filter('tiny_mce_plugins', 'disable_emojicons_tinymce');
}
add_action('init', 'disable_wp_emojicons');



if (function_exists('acf_add_options_page')) {
  acf_add_options_page(array(
    'page_title' => 'Site Settings',
    'menu _title' => 'Site Settings',
    'menu_slug' => 'site-settings',
    'capability' => 'edit_posts',
    'redirect' => false,
    'icon_url' => 'dashicons-admin-site'
  ));
}


/*
 * Add columns to exhibition post list
 */
function add_acf_columns($columns)
{
  return array_merge($columns, array(
    'cat_details_id'        => __('ID'),
    'cat_details_age'       => __('AGE'),
    'cat_details_cat_status' => __('Cat Status'),
    'cat_details_application_required' => __('Application Required'),
  ));
}
add_filter('manage_cats_posts_columns', 'add_acf_columns');

function add_entrant_acf_columns($columns)
{
  return array_merge($columns, array(
    'cat_entrants_vote_count' => __('Vote Count')
  ));
}
add_filter('manage_cat-entrants_posts_columns', 'add_entrant_acf_columns');


/*
 * Add columns to exhibition post list
 */
function cats_custom_column($column, $post_id)
{
  switch ($column) {
    case 'cat_details_id':
      echo get_post_meta($post_id, 'id', true);
      break;
    case 'cat_details_age':
      $age_option = get_age_option();
      $age = get_post_meta($post_id, 'age', true);
      if ($age) {
        echo $age_option[$age];
      }
      break;
    case 'cat_details_cat_status':
      $cat_status = get_cat_status_option();
      $status = get_post_meta($post_id, 'cat_status', true);
      if ($status) {
        echo $cat_status[$status];
      }
      break;
    case 'cat_details_application_required':
      $application_required = get_field('application_required', $post_id);
      if ($application_required) {
        echo 'Yes';
      }
      break;
  }
}

add_action('manage_cats_posts_custom_column', 'cats_custom_column', 10, 2);

function cat_entrants_custom_column($column, $post_id)
{
  switch ($column) {
    case 'cat_entrants_vote_count':
      $vote_count = get_post_meta($post_id, 'vote_count', true);
      if ($vote_count) {
        echo $vote_count;
      } else {
        echo '0';
      }
      break;
  }
}

add_action('manage_cat-entrants_posts_custom_column', 'cat_entrants_custom_column', 10, 2);

function cat_entrant_list($query)
{
  if (!is_admin() || !$query->is_main_query()) {
    return;
  }
  if ($query->query_vars['post_type'] === 'cat-entrants' && empty($query->get('orderby'))) {
    $query->set('orderby', 'meta_value_num');
    $query->set('meta_key', "vote_count");
    $query->set('order', 'DESC');
  }
}
add_action('pre_get_posts', 'cat_entrant_list', 5);


// add_action( 'admin_menu', 'cats_menu' );
// function cats_menu() {
//   add_submenu_page(
//     'edit.php?post_type=cats',
//     __( 'Lost Cats', 'textdomain' ),
//     __( 'Lost Cats', 'textdomain' ),
//     'manage_options',
//     'edit.php?post_type=cats&cat_status=lost'
//   );

//   add_submenu_page(
//     'edit.php?post_type=cats',
//     __( 'Found Cats', 'textdomain' ),
//     __( 'Found Cats', 'textdomain' ),
//     'manage_options',
//     'edit.php?post_type=cats&cat_status=found'
//   );
// }


// Formatting function for media block titles
// only used if we have a 'heading' custom field value for the media block element
function get_media_block_title_prefix($media_block_type)
{
  switch ($media_block_type) {
    case 'audio':
      return 'Audio: ';
      break;
    case 'gallery':
      return 'Gallery: ';
      break;
    case 'featured_image':
      return 'Image: ';
      break;
    case 'featured_video':
      return 'Video: ';
      break;
    case 'pull_quote':
      return 'Quote: ';
      break;
  }
}

// Function to display social profile links.
function display_social($url, $type)
{
  if ($url && $type) {
    echo '<a class="' . esc_attr($type) . '" href="' . esc_url($url) . '" target="_blank"></a>';
  }
}


// Move the Yoast SEO box to below any advanced custom fields
add_filter('wpseo_metabox_prio', 'change_yoast_meta_priority_callback');
function change_yoast_meta_priority_callback()
{
  return 'low';
}


/**
 *	Give an id and an image size, return the featured image src
 *
 *	@param $post_id, $image_size
 *	@return string
 */
function get_thumbnail_src($post_id, $image_size = 'full')
{
  $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $image_size);
  $thumbnail = $thumb[0];

  return $thumbnail;
}


/**
 *	Stop the 'Insert Link' popup from inserting the full url
 *
 *	@param $results
 *	@return array
 */
add_filter('wp_link_query', 'change_url_paths_callback');
function change_url_paths_callback($results)
{
  foreach ($results as $key => $res) {
    $url = parse_url($res['permalink']);
    $results[$key]['permalink'] = $url['path'];
  }

  return $results;
}


function current_user_role()
{
  if (is_user_logged_in()) {
    global $current_user;
    $tmp = $current_user->roles;
    $user_role = array_shift($tmp);
    unset($tmp);
    return $user_role;
  }
  return false;
}

// Grant access to the gravity forms section for editors
function add_grav_forms()
{
  $role = get_role('editor');
  $role->add_cap('gform_full_access');
}
add_action('admin_init', 'add_grav_forms');


function admin_js($hook)
{
  wp_enqueue_script('admin_js', get_template_directory_uri() . '/assets/js/admin.js');
}
add_action('admin_enqueue_scripts', 'admin_js');


function get_media_block_classes($block_type, $custom_classes, $remove_padding, $image_filter)
{
  $class = $block_type;
  if ($custom_classes && !empty($custom_classes)) {
    $class .= ' ' . $custom_classes;
  }
  if ($remove_padding && !empty($remove_padding)) {
    $class .= ' no-padding';
  }
  if ($image_filter && !empty($image_filter) && !($image_filter == 'none')) {
    $class .= ' images-' . $image_filter;
  }
  return cssify($class);
}

function cssify($string)
{
  return str_replace('_', '-', $string);
}

// Function to strip the http:// or https:// prefix from a URL
function strip_http_prefix($url)
{
  if ($url) {
    return str_replace('http://', '', str_replace('https://', '', $url));
  }
  return $url;
}


// Function to get related articles when there are no articles set in the custom field
function get_related_articles($article, $article_count = 2)
{
  if (!$article) {
    return;
  }

  // get some basic information about this post
  // $terms = get_the_tags( $article );

  // Lets get similar posts using tags/categories and author/photographer
  $args = array(
    'post__not_in' => array($article->ID), // don't get the article we're using as a source
    'posts_per_page' => $article_count,
    'caller_get_posts' => 1,
    'orderby' => 'rand'
  );

  $tag_ids = wp_list_pluck(get_the_terms($article->ID, 'post_tag'), 'term_id'); // phpcs
  $categories = get_the_category($article->ID);
  $author = get_the_author($article->ID);

  // Do we have any attached categories?
  if (!empty($categories)) {
    $category_ids = array();
    foreach ($categories as $individual_category) {
      $category_ids[] = $individual_category->term_id;
    }
  }

  // Get the author of the article
  $authors = array();
  if (!empty($author)) {
    $authors[] = $author->ID;
  }

  if (!empty($authors)) {
    $args['author__in'] = $authors;
  }

  if (!empty($tag_ids)) {
    $args['tag__in'] = $tag_ids;
  }

  if (!empty($category_ids)) {
    $args['category__in'] = $category_ids;
  }

  $related = get_posts($args);

  // If we've got no results, remove the author__in condition
  if (empty($related)) {
    $args['author__in'] = '';
    $related = get_posts($args);
  }

  // If we still have no results, remove the tag__in condition
  if (empty($related)) {
    $args['tag__in'] = '';
    $related = get_posts($args);
  }

  // If we still have no results, remove the category__in condition
  if (empty($related)) {
    $args['category__in'] = '';
    $related = get_posts($args);
  }

  return $related;
}


// Additional classes to add to the body_classes() function

function enhanced_body_classes($classes)
{
  global $post;

  // add interior class to all non-home pages
  if (!is_front_page()) {
    $classes[] = 'interior';
  }

  if (is_category()) {
    $cat = get_category(get_query_var('cat'));
    $classes[] = $cat->slug;

    if ($cat->parent > 0) {
      // add 'sub-category' class, but also add parent category class
      $classes[] = 'sub-category';

      $parent =  get_category(getHighestCategoryID($cat->parent));
      if ($parent) {
        $classes[] = $parent->slug;
      }
    }
  } elseif (is_single()) {
    $category = get_the_category($post->ID);
    if ($category) {
      $cat =  get_category(getHighestCategoryID($category[0]->cat_ID));

      if ($cat) {
        $classes[] = $cat->slug;
      }
    }
  } elseif (is_page()) {
    $classes[] = $post->post_name;
  }
  return $classes;
}

add_filter('body_class', 'enhanced_body_classes');


// Function to get the highest category slug of a post
function getHighestCategoryID($category_id)
{
  $cat = get_category($category_id);

  if ($cat->category_parent == 0) {
    return $cat->cat_ID;
  } else {
    return getHighestCategoryID($cat->category_parent);
  }
}


// Function to detect if a post is wihin a particular category or one of it's child categories
function isWithinCategory($category_name, $post)
{
  if (!$category_name || !$post) {
    return false;
  }

  // Get all the child categories
  $categories = get_term_children(get_cat_ID($category_name), 'category');

  // Append the parent category
  $categories[] = $category_name;

  if (in_category($categories, $post)) {
    return true;
  }
}



// Function to return the posts for a particular author, or across all categories
// add any excluded post IDs to the function call
function getAuthorPosts($return_ids_only = false, $num = 1, $author = 0, $exclude = array())
{
  $result = array();

  $args = array(
    'numberposts' => $num,
    'post_type' => array('post'),
    'post_status' => 'publish',
    'order' => 'DESC',
    'orderby' => 'publish_date',
    'author' => $author,
    'post__not_in' => $exclude
  );

  $author_posts = get_posts($args);

  // we may only want the IDs of the author posts to use in other exclusion statements
  if ($return_ids_only) {
    foreach ($author_posts as $author_post) {
      $result[] = $author_post->ID;
    }
  } else {
    $result = $author_posts;
  }

  return $result;
}


// Function to get the latest News tagged posts
function getNewsPosts($return_ids_only = false, $num = 6, $category = null, $exclude = array(), $offset = 0)
{
  $result = array();

  $args = array(
    'numberposts' => $num,
    'offset' => $offset,
    'post_type' => array('post'),
    'post_status' => 'publish',
    'order' => 'DESC',
    'orderby' => 'date',
    'meta_key' => 'is_news',
    'meta_value' => true,
    'post__not_in' => $exclude
  );

  if (isset($category)) {
    $args['category'] = $category;
  }

  $news = get_posts($args);

  // we may only want the IDs of the news posts to use in other exclusion statements
  if ($return_ids_only) {
    foreach ($news as $news_post) {
      $result[] = $news_post->ID;
    }
  } else {
    $result = $news;
  }

  return $result;
}


// Get more news posts via ajax
add_action('wp_ajax_nopriv_get_more_news', 'get_more_news');
add_action('wp_ajax_get_more_news', 'get_more_news');

function get_more_news()
{
  global $post;

  // only allow ajax requests
  if (wp_doing_ajax()) {
    $offset = filter_var($_REQUEST['offset'], FILTER_SANITIZE_NUMBER_INT);
    $num_posts = filter_var($_REQUEST['posts'], FILTER_SANITIZE_NUMBER_INT);

    // Do we have an offset?
    if (!$offset) {
      $offset = 0;
    }

    // Get the news posts
    $news = getNewsPosts(false, $num_posts, null, array(), $offset);

    // // Open the output buffer so we can catch template part elements
    ob_start();

    foreach ($news as $post) {
      setup_postdata($post);
      get_template_part('assets/inc/template-parts/post-card');
    }

    $output = ob_get_contents();
    ob_end_clean();

    // add a new target container to the end of the html
    if ($output != '') {
      $output .= '<div id="view-more-container"></div>';
    }

    wp_reset_query();

    echo $output;

    die();
  }
}



// Get more news posts via ajax
add_action('wp_ajax_nopriv_get_more_posts', 'get_more_posts');
add_action('wp_ajax_get_more_posts', 'get_more_posts');

function get_more_posts()
{
  global $post;

  // only allow ajax requests
  if (wp_doing_ajax()) {
    $category = filter_var($_REQUEST['category'], FILTER_SANITIZE_NUMBER_INT);
    $offset = filter_var($_REQUEST['offset'], FILTER_SANITIZE_NUMBER_INT);
    $num_posts = filter_var($_REQUEST['posts'], FILTER_SANITIZE_NUMBER_INT);
    $exclude = $_REQUEST['exclude'];

    // Do we have an offset?
    if (!$offset) {
      $offset = 0;
    }

    // Get the news posts
    $posts = getRecentPosts(false, $num_posts, $category, $exclude, $offset);

    // // Open the output buffer so we can catch template part elements
    ob_start();

    foreach ($posts as $post) {
      setup_postdata($post);
      get_template_part('assets/inc/template-parts/post-card');
    }

    $output = ob_get_contents();
    ob_end_clean();

    // add a new target container to the end of the html
    if ($output != '') {
      $output .= '<div id="view-more-container"></div>';
    }

    wp_reset_query();

    echo $output;

    die();
  }
}


// Function to return the popular posts for a particular category, or across all categories
// add any excluded post IDs to the function call
function getPopularPosts($return_ids_only = false, $num = 6, $category = null, $exclude = array())
{
  $result = array();

  $args = array(
    'numberposts' => $num,
    'post_type' => array('post'),
    'post_status' => 'publish',
    'order' => 'DESC',
    'orderby' => 'meta_value',
    'meta_key' => 'post_views',
    'post__not_in' => $exclude
  );

  if (isset($category)) {
    $args['category'] = $category;
  }

  $popular = get_posts($args);

  // we may only want the IDs of the popular posts to use in other exclusion statements
  if ($return_ids_only) {
    foreach ($popular as $popular_post) {
      $result[] = $popular_post->ID;
    }
  } else {
    $result = $popular;
  }

  return $result;
}


// Function to return the most recent posts for a particular category, or across all categories
// add any excluded post IDs to the function call
function getRecentPosts($return_ids_only = false, $num = 6, $category = null, $exclude = array())
{
  $result = array();

  $args = array(
    'numberposts' => $num,
    'post_type' => array('post'),
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'post__not_in' => $exclude
  );

  if (isset($category)) {
    $args['category'] = $category;
  }

  $recent = get_posts($args);

  // we may only want the IDs of the recent posts to use in other exclusion statements
  if ($return_ids_only) {
    foreach ($recent as $recent_post) {
      $result[] = $recent_post->ID;
    }
  } else {
    $result = $recent;
  }

  return $result;
}


// Function to return contributor authored posts
// No need to exclude any posts at this point
function getContributorPosts($return_ids_only = false, $num = 3, $contributor_id = 0)
{
  $result = array();

  $args = array(
    'numberposts' => $num,
    'post_type' => array('post'),
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'author' => $contributor_id
  );

  $contributor_posts = get_posts($args);

  // we may only want the IDs of the recent posts to use in other exclusion statements
  if ($return_ids_only) {
    foreach ($contributor_posts as $contributor_post) {
      $result[] = $contributor_post->ID;
    }
  } else {
    $result = $contributor_posts;
  }

  return $result;
}


// Get all contributors
// Can designate a contributor type by using array('photographer').
function getContributors($return_ids_only = false, $roleType = array('contributor', 'photographer'), $contributor_ids = null, $contributor_level = null)
{
  $result = array();

  $args = array(
    'role__in' => $roleType,
    'orderby' => 'post_count',
    'order' => 'DESC'
  );

  // Do we only want to retrieve a certain rank?  i.e. primary, secondary, tertiary
  if ($contributor_level && !empty($contributor_level)) {
    $args['meta_key'] = 'contributor_level';
    $args['meta_value'] = $contributor_level;
  }

  // If we want to limit who we return, we can do so using an array of user IDs
  if (!empty($contributor_ids) && is_array($contributor_ids)) {
    $args['include'] = $contributor_ids;
  }

  $contributors = get_users($args);

  // we may only want the IDs of the recent posts to use in other exclusion statements
  if ($return_ids_only) {
    foreach ($contributors as $contributor) {
      $result[] = $contributor->ID;
    }
  } else {
    $result = $contributors;
  }

  return $result;
}

// Manage the excluded post IDs for a particular page render
function addExclusion($target, $a_post_or_post_id)
{
  if (!is_array($target)) {
    return false;
  }

  if (is_numeric($a_post_or_post_id)) {
    $value = $a_post_or_post_id;
  } elseif (isset($a_post_or_post_id->ID)) {
    $value = $a_post_or_post_id->ID;
  }

  if (isset($value) && array_search($value, $target, true) === false) {
    $target[] = $value;
  }

  // always returns an array of post IDs
  return $target;
}


// Get a list of sub categories, in order, of a parent category
function getSubCategories($parent_id)
{

  // Do we have a parent ID?
  if (!isset($parent_id)) {
    return false;
  }

  $args = array('parent'  => $parent_id, 'hide_empty' => 0);  // REMOVE the hide_empty part when live

  $sub_categories = get_categories($args);

  // sort the sub categories according to the custom field order value
  usort($sub_categories, function ($a, $b) {
    return get_field('category_order', 'category_' . $a->term_id) - get_field('category_order', 'category_' . $b->term_id);
  });

  return $sub_categories;
}


// Post view tracking functions
// only track views from non-logged in users
add_action('wp_ajax_nopriv_intrepid_track_view', 'arb_track_view');
add_action('wp_ajax_intrepid_track_view', 'arb_track_view');  // REMOVE

function arb_track_view()
{

  // only allow ajax requests
  if (wp_doing_ajax()) {
    if (!is_user_logged_in()) {
      $post_views = get_post_meta(filter_var($_REQUEST['post_id'], FILTER_SANITIZE_NUMBER_INT), 'post_views', true);
      $post_views++;
      update_post_meta(filter_var($_REQUEST['post_id'], FILTER_SANITIZE_NUMBER_INT), 'post_views', $post_views);
    }
  }

  die();
}

// Get authors by name
function get_authors_by_name($search_term)
{
  $args = array(
    'order' => 'ASC',
    'orderby' => 'display_name',
    'meta_query' => array(
      'relation' => 'OR',
      array(
        'key'     => 'first_name',
        'value'   => $search_term,
        'compare' => 'LIKE'
      ),
      array(
        'key'     => 'last_name',
        'value'   => $search_term,
        'compare' => 'LIKE'
      ),
    )
  );

  $wp_user_query = new WP_User_Query($args);
  $authors = $wp_user_query->get_results();

  if (!empty($authors)) {
    return $authors;
  } else {
    return false;
  }
}

// Function to determine if an image is in portrait or landscape mcrypt_list_mode
function is_portrait($image)
{
  // do we have a width and a height?
  if (isset($image['height']) && isset($image['width'])) {
    if ($image['height'] > $image['width']) {
      return true;
    }
  }
  // by default, assume a landscape image
  return false;
}


/**
 **  Function to return a shortened URL from the bit.ly service
 **  See wp-config.php for variable definitions.
 **/
function get_short_url($url)
{
  if (ENVIRONMENT && ENVIRONMENT != 'dev' && BITLY_URL && BITLY_USER && BITLY_API_KEY) {
    $bitly = file_get_contents(BITLY_URL . '?login=' . BITLY_USER . '&apiKey=' . BITLY_API_KEY . '&longUrl=' . $url . '%2F&format=txt');
    return $bitly;
  } else {
    return $url;
  }
}


/**
 **  Function to dynamically populate the title of the flexible content blocks for easier content management
 **/
//   function custom_acf_layout_title( $title, $field, $layout, $i ) {

//   $title = '';
//   $layout_name = $layout['name'];

//   switch ( $layout_name ) {
//     case 'media_item' :

//       // if it's a featured image, use a thumbnail
//       switch ( $type = get_sub_field('media_block_type') ) {
//         case 'gallery':
//           if ( $gallery = get_sub_field('gallery') ) {
//             foreach ( $gallery as $image ) {
//               $title .= '<img src="' . $image['sizes']['thumbnail'] . '" height="36px" style="margin-right: 5px;" />';
//             }
//           }
//           $title .= '';
//           break;
//         case 'featured_image':
//           if( $image = get_sub_field('featured_image') ) {
//             $title .= '<img src="' . $image['sizes']['thumbnail'] . '" height="36px" style="margin-right: 5px;" />';
//           }
//           break;
//         case 'featured_video':
//           $title .= 'Video: ' . get_sub_field('video_provider');
//           break;
//         case 'audio':
//           $title .= 'Audio: ' . get_sub_field('audio_provider');
//           break;
//       }

//       break;
//     case 'general_content' :
//       $heading = get_sub_field('heading');
//       $content = get_sub_field('content');
//       if ( $heading ) {
//         $title .= $heading;
//       } else {
//         $title .= strip_tags(substr($content, 0, 128)) . '... ';
//       }
//       break;
//     case 'columns' :
//       $heading = get_sub_field('heading');
//       if ( $heading ) {
//         $title .= $heading;
//       } else {
//         $title .= 'Columns';
//       }
//       break;
//     case 'pull_quote' :
//       $title = 'Quote: <i>' . strip_tags(substr(get_sub_field('quote'), 0, 128)) . '</i>';
//       break;
//     case 'contributor' :
//       $contributor = get_sub_field('contributor');
//       $title = 'Contributor: ' . $contributor['display_name'];
//       break;
//     case 'form':
//       $title .= 'Form: ' . get_sub_field('heading');
//       break;
//     case 'products':
//       $title .= 'Product Listing: ' . get_sub_field('products_to_show');
//       break;
//     case 'sku_listing':
//       $title .= 'SKU listing for ' . get_the_title(get_sub_field('vehicle'));
//       break;
//     case 'interactive_features':
//       $title .= 'Interactive Features for ' . get_sub_field('product');
//       break;
//     default:
//       $title = 'Content Block: ';
//       break;
//   }

// 	// return
// 	return $title;

// }

// add the content block titles
// add_filter('acf/fields/flexible_content/layout_title/name=content_block', 'custom_acf_layout_title', 10, 4);


// only search post types
function only_search_posts($query)
{
  if ($query->is_search) {
    $query->set('post_type', 'post');
  }
  return $query;
}
// add_filter('pre_get_posts','only_search_posts');


function is_blog()
{
  if (is_home()) {  // Blog home page
    return true;
  }

  if (is_singular('post')) {    // Single blog page
    return true;
  }

  if (is_category()) {    // Category archive page
    return true;
  }

  if (is_tag()) {    // Tag archive page
    return true;
  }

  return false;
}



function excerpt_from_content($content, $num_words = 30)
{
  $content = strip_tags(strip_shortcodes($content));
  $ex = explode(" ", $content);
  $split = array_slice($ex, 0, $num_words);
  $excerpt = implode(" ", $split);

  return $excerpt;
}


function sort_by($key)
{
  return function ($a, $b) use ($key) {
    return ($a['priority'] < $b['priority']) ? 1 : -1;
  };
}


// check for the existance of a post
function post_exists_by_slug($slug, $type)
{
  $post = get_posts(array(
    'name' => $slug,
    'posts_per_page' => 1,
    'post_type' => $type,
    'post_status' => 'publish'
  ));

  if (!$post || is_wp_error($post)) {
    return false;
  }

  return $post[0]->ID;
}


/*
//////////////////////////
// ACF Custom Functions //
//////////////////////////

// load select option values from a database or other source
function acf_load_select_values($field)
{
    $field['choices'] = array();

    $options = array('Option');

    foreach ($options as $option) {
        $field['choices'][$option] = $option;
    }

    return $field;
}
// add_filter('acf/load_field/name=make', 'acf_load_select_values');


function vnm_admin_enqueue_scripts()
{
    wp_enqueue_script('acf-custom-js', get_template_directory_uri() . '/assets/js/acf.js', array('jquery'), null, true);
}

add_action('acf/input/admin_enqueue_scripts', 'vnm_admin_enqueue_scripts');
*/

/* Register navigations */
function wpb_custom_new_menu()
{
  register_nav_menus(
    array(
      'main-navigation' => __('Main Navigation'),
      'adopt-secondary-navigation' => __('Adopt - Secondary Navigation For Cats Post Type'),
      'shop-secondary-navigation' => __('Shop - Secondary Navigation'),
      'footer-navigation' => __('Footer Navigation')
    )
  );
}
add_action('init', 'wpb_custom_new_menu');

// add_filter( 'nav_menu_css_class', 'menu_item_classes', 10, 4 );

// function menu_item_classes( $classes, $item, $args, $depth ) {

//     //unset($classes);

//     $classes[] = 'nav-main__item';

//     return $classes;
// }

// function add_link_atts($atts) {
//   $atts['class'] = 'nav-main__link';
//   return $atts;
// }
// add_filter( 'nav_menu_link_attributes', 'add_link_atts');

function add_additional_class_on_li($classes, $item, $args)
{
  if ($args->li_class) {
    $classes[] = $args->li_class;
  }
  return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 10, 3);


function add_additional_class_on_a($atts, $item, $args)
{
  if ($args->a_class) {
    $atts['class'] = $args->a_class;
  }
  return $atts;
}
add_filter('nav_menu_link_attributes', 'add_additional_class_on_a', 10, 3);

function change_submenu_class($menu)
{
  $menu = preg_replace('/ class="sub-menu"/', '/ class="menu vertical nested" /', $menu);
  return $menu;
}
add_filter('wp_nav_menu', 'change_submenu_class');

/* Navigation Submenu */
add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects_sub_menu', 10, 2);

function my_wp_nav_menu_objects_sub_menu($sorted_menu_items, $args)
{
  if (isset($args->sub_menu)) {
    $root_id = 0;

    foreach ($sorted_menu_items as $menu_item) {
      if ($menu_item->current) {
        $root_id = ($menu_item->menu_item_parent) ? $menu_item->menu_item_parent : $menu_item->ID;
        break;
      }
    }

    if (!isset($args->direct_parent)) {
      $prev_root_id = $root_id;
      while ($prev_root_id != 0) {
        foreach ($sorted_menu_items as $menu_item) {
          if ($menu_item->ID == $prev_root_id) {
            $prev_root_id = $menu_item->menu_item_parent;
            if ($prev_root_id != 0) {
              $root_id = $menu_item->menu_item_parent;
            }
            break;
          }
        }
      }
    }

    $menu_item_parents = array();
    foreach ($sorted_menu_items as $key => $item) {
      if ($item->ID == $root_id) {
        $menu_item_parents[] = $item->ID;
      }
      if (in_array($item->menu_item_parent, $menu_item_parents)) {
        $menu_item_parents[] = $item->ID;
      } elseif (!(isset($args->show_parent) && in_array($item->ID, $menu_item_parents))) {
        unset($sorted_menu_items[$key]);
      }
    }

    return $sorted_menu_items;
  } else {
    return $sorted_menu_items;
  }
}

/* Hide GF Labels */
add_filter('gform_enable_field_label_visibility_settings', '__return_true');

/* Allow SVGs */
function cc_mime_types($mimes)
{
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/**
 * Join posts and postmeta tables
 */

function acf_search_join($join)
{
  global $wpdb;

  if (is_search()) {
    $join .= ' LEFT JOIN ' . $wpdb->postmeta . ' ON ' . $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
  }

  return $join;
}
add_filter('posts_join', 'acf_search_join');


/**
 * Modify the search query with posts_where
 */
function acf_search_where($where)
{
  global $wpdb;

  if (is_search()) {
    $where = preg_replace(
      "/\(\s*" . $wpdb->posts . ".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
      "(" . $wpdb->posts . ".post_title LIKE $1) OR (" . $wpdb->postmeta . ".meta_value LIKE $1)",
      $where
    );
  }

  return $where;
}
add_filter('posts_where', 'acf_search_where');


/**
 * Prevent duplicates
 */
function acf_search_distinct($where)
{
  global $wpdb;

  if (is_search()) {
    return "DISTINCT";
  }

  return $where;
}
add_filter('posts_distinct', 'acf_search_distinct');

add_filter('woocommerce_thankyou_order_received_text', function () {
  return
    'Thank you for ordering your cat-care items from The Cat Protection Society of Victoria and helping to support the work of our Society to care for cats in need.' . '<br/>' .
    'A member of our team will prepare your order and contact you when your goods are available for collection.' . '<br/>' .
    'On arrival to our Shelter, please contact our retail store on 8457 6500 and our team will bring your order to the front gate for contact free pick up.';
});

add_action('after_setup_theme', 'woocommerce_support');
function woocommerce_support()
{
  add_theme_support('woocommerce');
}

function strippedExcerpt()
{
  $myExcerpt = get_the_excerpt();
  $tags = array("<p>", "</p>");
  $myExcerpt = str_replace($tags, "", $myExcerpt);
  echo $myExcerpt;
}

function get_excerpt()
{
  $excerpt = get_the_excerpt();
  $excerpt = preg_replace(" ([.*?])", '', $excerpt);
  $excerpt = strip_shortcodes($excerpt);
  $excerpt = strip_tags($excerpt);
  $excerpt = substr($excerpt, 0, 135);
  $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
  $excerpt = trim(preg_replace('/\s+/', ' ', $excerpt));
  $excerpt = $excerpt . '...';
  return $excerpt;
}

/** Woocommerce **/
// Show empty sub cats in woocommerce
add_filter('woocommerce_product_subcategories_hide_empty', '__return_false');

// Remove the result count from WooCommerce
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

// Remove Add to Cart
add_action('woocommerce_after_shop_loop_item', 'remove_add_to_cart_buttons', 1);

function remove_add_to_cart_buttons()
{
  if (is_product_category() || is_shop()) {
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
  }
}

// Remove related products output
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

// Remove excerpt from single product
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
add_action('woocommerce_single_product_summary', 'the_content', 20);

// Remove tabbed content
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);

// Remove meta categories
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

// Update Cart total
add_filter('woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1);
function iconic_cart_count_fragments($fragments)
{
  $fragments['span.cart__count'] = '<span class="cart__count">' . WC()->cart->get_cart_contents_count() . '</span>';

  return $fragments;
}

// Add checkout button and get quantity
function add_content_after_addtocart()
{

  // get the current post/product ID
  $current_product_id = get_the_ID();

  // get the product based on the ID
  $product = wc_get_product($current_product_id);

  // get the "Checkout Page" URL
  $checkout_url = WC()->cart->get_checkout_url();

  // run only on simple products
  if ($product->is_type('simple')) { ?>

    <script>
      jQuery(function($) {
        <?php /* if our custom button is clicked, append the string "&quantity=", and also the quantitiy number to the URL */ ?>

        // if our custom button is clicked
        $(".summary").on("click", ".single_add_to_cart_button.alt", function() {

          // get the value of the "href" attribute
          $(this).attr("href", function() {
            // return the "href" value + the string "&quantity=" + the current selected quantity number
            return this.href + '&quantity=' + $('input.qty').val();
          });

        });
      });
    </script>

<?php echo '<a href="' . $checkout_url . '?add-to-cart=' . $current_product_id . '" class="single_add_to_cart_button button alt">Checkout</a>';
  }
}
add_action('woocommerce_after_add_to_cart_button', 'add_content_after_addtocart');

//clear notices on cart update
function clear_notices_on_cart_update()
{
  wc_clear_notices();
};

// add the filter
add_filter('woocommerce_update_cart_action_cart_updated', 'clear_notices_on_cart_update', 10, 1);

function get_age_array($age)
{
  switch ($age) {
    case 'kitten':
      $ages = array('1 mo', '2 mo', '3 mo', '4 mo ', '5 mo', '6 mo');
      break;
    case 'junior':
      $ages = array('7 mo', '8 mo', '9 mo', '10 mo', '11 mo', '1 yr', '2 yr');
      break;
    case 'prime':
      $ages = array('3 yr', '4 yr', '5 yr', '6 yr');
      break;
    case 'mature':
      $ages = array('7 yr', '8 yr', '9 yr', '10 yr');
      break;
    case 'senior':
      $ages = array('11 yr', '12 yr');
      break;
    default:
      $ages = false;
      break;
  }
  return $ages;
}

function cat_filter($args, $ages, $gender, $breed, $compatibility, $colour, $status, $location = '', $application_required = '')
{
  $args['meta_query'][] = array('relation' => 'AND');

  if ($ages) {
    $args['meta_query'][] = array(
      'key' => 'age',
      'value' => $ages,
      'compare'  => 'IN'
    );
  }

  if ($gender != '') {
    $args['meta_query'][] = array(
      'key' => 'gender',
      'value' => $gender
    );
  }

  if ($colour != '') {
    $args['meta_query'][] = array(
      'key' => 'colour',
      'value' => $colour
    );
  }

  if ($breed != '') {
    $args['meta_query'][] = array(
      'key' => 'breed',
      'value' => $breed
    );
  }

  if ($compatibility != '') {
    $args['meta_query'][] = array(
      'key' => 'compatibility',
      'value' => $compatibility,
      'compare'  => 'LIKE'
    );
  }

  if ($location != '') {
    $args['meta_query'][] = array(
      'key' => 'location',
      'value' => $location,
      'compare' => 'LIKE'
    );
  }

  if ($application_required != '') {
    $args['meta_query'][] = array(
      'key' => 'application_required',
      'value' => $application_required,
      'compare' => 'LIKE'
    );
  }


  $args['meta_query'][] = array(
    'key' => 'cat_status',
    'value' => $status,
    'compare'  => 'IN'
  );
  return $args;
}

// Filter adopt cats

function search_adopt_cats($ids, $age, $gender, $breed, $compatibility, $colour)
{
  $ages = get_age_array($age);
  $status = array('notadopted', 'adopted');
  $args = array(
    'post_type'      => 'cats',
    'post_status'    => 'publish',
    'orderby'        => 'title',
    'posts_per_page' => -1,
    'order'          => 'asc',
  );

  $args['meta_query'] = array();

  if ($ids != '') {
    $args['meta_query'][] = array(
      'relation' => 'OR',
      array(
        'key' => 'id',
        'value' => $ids,
        'compare'  => 'LIKE'
      ),
      array(
        'key' => 'cat_description',
        'value' => $ids,
        'compare'  => 'LIKE'
      )
    );
  }

  $args = cat_filter($args, $ages, $gender, $breed, $compatibility, $colour, $status);
  //dBug(array($args,$_POST));
  $posts = get_posts($args);

  return $posts;
}

// Filter found cats

function search_found_cats($search_term, $age, $gender, $breed, $compatibility, $colour, $suburb = '')
{
  $ages = get_age_array($age);
  $status = array('found');
  $args = array(
    'post_type'      => 'cats',
    'post_status'    => 'publish',
    'orderby'        => 'title',
    'posts_per_page' => -1,
    'order'          => 'asc',
  );

  $args['meta_query'] = array();

  if ($search_term != '') {
    $args['meta_query'][] = array(
      'relation' => 'OR',
      array(
        'key' => 'id',
        'value' => $search_term,
        'compare'  => 'LIKE'
      ),
      array(
        'key' => 'cat_description',
        'value' => $search_term,
        'compare'  => 'LIKE'
      ),
      array(
        'key' => 'microchip_number',
        'value' => $search_term,
      ),
      array(
        'key' => 'dab_number',
        'value' => $search_term,
      )
    );
  }

  $args = cat_filter($args, $age, $gender, $breed, $compatibility, $colour, $status, $suburb);

  $posts = get_posts($args);

  return $posts;
}

// Filter lost cats

function search_lost_cats($search_term, $age, $gender, $breed, $compatibility, $colour)
{
  $ages = get_age_array($age);
  $status = array('lost');
  $args = array(
    'post_type'      => 'cats',
    'post_status'    => 'publish',
    'orderby'        => 'title',
    'posts_per_page' => -1,
    'order'          => 'asc',
  );

  $args['meta_query'] = array();

  if ($search_term != '') {
    $args['meta_query'][] = array(
      'relation' => 'OR',
      array(
        'key' => 'id',
        'value' => $search_term,
        'compare'  => 'LIKE'
      ),
      array(
        'key' => 'cat_description',
        'value' => $search_term,
        'compare'  => 'LIKE'
      ),
      array(
        'key' => 'microchip_number',
        'value' => $search_term,
      ),
      array(
        'key' => 'dab_number',
        'value' => $search_term,
      )
    );
  }

  $args = cat_filter($args, $age, $gender, $breed, $compatibility, $colour, $status);

  $posts = get_posts($args);

  return $posts;
}




function get_breed_option()
{
  $field = get_field_object('field_5ca5877d23652');

  return $field['choices'];
}

function get_compatibility_option()
{
  $field = get_field_object('field_5cc66acd810ba');

  return $field['choices'];
}

function get_age_option()
{
  $field = get_field_object('field_5ca5878523653');

  return $field['choices'];
}

function get_cat_status_option()
{
  $field = get_field_object('field_5ca5860ae7c9c');

  return $field['choices'];
}

function get_gender_option()
{
  $field = get_field_object('field_5ca5873b23651');

  return $field['choices'];
}

function get_colour_option()
{
  $field = get_field_object('field_5ccb99fb50562');

  return $field['choices'];
}

//Remove WC notices
add_filter('wc_add_to_cart_message_html', 'remove_add_to_cart_message');

function remove_add_to_cart_message()
{
  return;
}

function get_cats_suburbs()
{
  $suburb = array();
  $cats = search_found_cats('', '', '', '', '', '');
  foreach ($cats as $key => $value) {
    $address = clean_google_address(get_field('location', $value));
    $suburb[] = $address['suburb'];
  }
  return $suburb;
}

function clean_google_address($location)
{
  $au = ', Australia';
  $location = str_replace($au, '', $location['address']);

  $location = explode(',', $location);

  $address['street'] = current($location);

  $address['suburb'] = trim(end($location));
  $address['suburb'] = preg_replace('/[0-9]+/', '', $address['suburb']);
  return $address;
}

function save_cats_meta($post_id, $post, $update)
{
  $post_type = get_post_type($post_id);
  if ("cats" != $post_type) {
    return;
  }

  if (isset($_POST['input_11'])) {
    $address = $_POST['input_11'];

    // Get JSON results from this request
    $geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=false&key=' . GOOGLE_SERVER_API_KEY);
    $geo = json_decode($geo, true); // Convert the JSON to an array

    if (isset($geo['status']) && ($geo['status'] == 'OK')) {
      $latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
      $longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
    }
    $location = array('address' => $_POST['input_11'], 'lat' => $latitude, 'lng' => $longitude);

    update_post_meta($post_id, 'location', $location);
  }
}
add_action('save_post', 'save_cats_meta', 10, 3);

/* Custom function to apply fancybox to product images */
function wc_get_gallery_image_fancybox_html($attachment_id, $main_image = false)
{
  $flexslider        = (bool) apply_filters('woocommerce_single_product_flexslider_enabled', get_theme_support('wc-product-gallery-slider'));
  $gallery_thumbnail = wc_get_image_size('gallery_thumbnail');
  $thumbnail_size    = apply_filters('woocommerce_gallery_thumbnail_size', array($gallery_thumbnail['width'], $gallery_thumbnail['height']));
  $image_size        = apply_filters('woocommerce_gallery_image_size', $flexslider || $main_image ? 'woocommerce_single' : $thumbnail_size);
  $full_size         = apply_filters('woocommerce_gallery_full_size', apply_filters('woocommerce_product_thumbnails_large_size', 'full'));
  $thumbnail_src     = wp_get_attachment_image_src($attachment_id, $thumbnail_size);
  $full_src          = wp_get_attachment_image_src($attachment_id, $full_size);
  $alt_text          = trim(wp_strip_all_tags(get_post_meta($attachment_id, '_wp_attachment_image_alt', true)));
  $image             = wp_get_attachment_image(
    $attachment_id,
    $image_size,
    false,
    apply_filters(
      'woocommerce_gallery_image_html_attachment_image_params',
      array(
        'title'                   => _wp_specialchars(get_post_field('post_title', $attachment_id), ENT_QUOTES, 'UTF-8', true),
        'data-caption'            => _wp_specialchars(get_post_field('post_excerpt', $attachment_id), ENT_QUOTES, 'UTF-8', true),
        'data-src'                => esc_url($full_src[0]),
        'data-large_image'        => esc_url($full_src[0]),
        'data-large_image_width'  => esc_attr($full_src[1]),
        'data-large_image_height' => esc_attr($full_src[2]),
        'class'                   => esc_attr($main_image ? 'wp-post-image' : ''),
      ),
      $attachment_id,
      $image_size,
      $main_image
    )
  );

  return '<div data-thumb="' . esc_url($thumbnail_src[0]) . '" data-thumb-alt="' . esc_attr($alt_text) . '" class="woocommerce-product-gallery__image"><a data-fancybox href="' . esc_url($full_src[0]) . '">' . $image . '</a></div>';
}

/* Disable scrolling on fund form */
add_filter('gform_confirmation_anchor_9', '__return_false');



add_filter('parse_query', 'prefix_parse_filter');
function prefix_parse_filter($query)
{
  global $pagenow;
  $current_page = isset($_GET['post_type']) ? $_GET['post_type'] : '';

  if (
    is_admin() &&
    'cats' == $current_page &&
    'edit.php' == $pagenow &&
    isset($_GET['cat_status']) &&
    $_GET['cat_status'] != ''
  ) {
    $cat_status = $_GET['cat_status'];
    if ($cat_status) {
      $query->query_vars['meta_key'] = 'cat_status';
      $query->query_vars['meta_value'] = $cat_status;
      $query->query_vars['meta_compare'] = '=';
    }
  }
}

function get_the_user_ip()
{
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    //check ip from share internet
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    //to check ip is pass from proxy
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}

add_action('save_post', 'save_cat_entants_meta');

function save_cat_entants_meta($post_id)
{
  $post_type = get_post_type($post_id);
  if ("cat-entrants" != $post_type) {
    return;
  }

  global $wpdb;

  if (!metadata_exists('post', $post_id, 'vote_count')) {
    $tableVotes = $wpdb->prefix . 'votes';
    $sql = 'SELECT COUNT(post_id) AS count FROM ' . $tableVotes . ' WHERE post_id = %s';
    $votes = $wpdb->get_row(
      $wpdb->prepare(
        $sql,
        $post_id
      )
    );

    update_post_meta($post_id, 'vote_count', $votes->count);
  }
}

add_action('after_setup_theme', 'yourtheme_setup');

function yourtheme_setup()
{
  add_theme_support('wc-product-gallery-zoom');
  add_theme_support('wc-product-gallery-lightbox');
  add_theme_support('wc-product-gallery-slider');
  add_theme_support('woocommerce', array('gallery_thumbnail_image_width' => 200));
}

add_filter('gform_field_value_cat', function ($value) {
  $post = get_post($value);
  if ($post) {
    return $post->post_title;
  }
  return '';
});

add_action('wp_footer', function () {
  if (get_field('popup_active', 'options')) {
    include(__DIR__ . '/assets/inc/template-parts/popup-modal.php');
  }
});
