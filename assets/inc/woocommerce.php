<?php
function wc_before_shop_loop_start()
{
  echo '<div class="flex justify-end mb-2 md:mb-4">';
  if (is_shop()) {
?>
    <select id="filter-product-cat" name="orderby" class="w-1/2 md:w-auto mr-2 md:mr-4 border border-gray-200 border-solid rounded-lg bg-white text-gray-700 font-normal focus:border-gray-200 focus:bg-white">
      <option value="all">Category</option>

      <?php
      $cat_args = array(
        'orderby'    => 'name',
        'order'      => 'asc',
        'hide_empty' => true,
      );
      $product_categories = get_terms('product_cat', $cat_args);

      if (!empty($product_categories)) {
        foreach ($product_categories as $key => $category) {
          echo '<option value="' . $category->slug . '">' . $category->name . '</option>';
        }
      }
      ?>

    </select>
<?php
  }
}
add_action('woocommerce_before_shop_loop', 'wc_before_shop_loop_start', 15);

function wc_before_shop_loop_end()
{
  echo '</div>';
}
add_action('woocommerce_before_shop_loop', 'wc_before_shop_loop_end', 35);


function shop_filter_category()
{
  $product_cat = $_POST['product_cat'];
  if (isset($_POST['postsperpage'])) {
    $postsPerPage = $_POST['postsperpage'];
  } else {
    $postsPerPage = -1;
  }

  if ($product_cat == 'all') {
    $ajaxposts = new WP_Query([
      'post_type' => 'product',
      'posts_per_page' => $postsPerPage,
      'post_status' => 'publish',
    ]);
  } else {
    $ajaxposts = new WP_Query([
      'post_type' => 'product',
      'posts_per_page' => $postsPerPage,
      'post_status' => 'publish',
      'tax_query' => array(
        array(
          'taxonomy' => 'product_cat',
          'field'    => 'slug',
          'terms'    => $product_cat,
        ),
      ),
    ]);
  }

  $response = '';

  if ($ajaxposts->have_posts()) {

    //$response .= '<div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 md:gap-6 lg:gap-8 2xl:gap-10">';

    while ($ajaxposts->have_posts()) : $ajaxposts->the_post();
      $response .= wc_get_template_part('content', 'product');
    endwhile;

    //$response .= '</div>';
    //$response .= '<div class="blocker absolute inset-0 bg-white bg-opacity-40" style="display: none;"></div>';
  } else {
    $response = '<div class="text-center py-4 px-8">No Products Found</div>';
  }

  echo $response;
  exit;
}
add_action('wp_ajax_shop_filter_category', 'shop_filter_category');
add_action('wp_ajax_nopriv_shop_filter_category', 'shop_filter_category');
