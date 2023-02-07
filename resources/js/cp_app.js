jQuery(function ($) {
  // News Filter
  $('#filter-product-cat').on('change', function (event) {
    //$('.filter-news-buttons .filter-news').removeClass('filter-active');
    //$(this).addClass('filter-active');
    // $('.filter-news-loader .spinner-border')
    //   .removeClass('opacity-0')
    //   .addClass('opacity-100');
    // $('.news-grid .blocker').show();
    console.log(this.value);
    event.preventDefault();
    $.ajax({
      type: 'POST',
      url: '/wp-admin/admin-ajax.php',
      dataType: 'html',
      data: {
        action: 'shop_filter_category',
        product_cat: this.value,
      },
      success: function (res) {
        $('.shop-product-grid').html(res);
        // $('.filter-news-loader .spinner-border')
        //   .removeClass('opacity-100')
        //   .addClass('opacity-0');
      },
    });
  });
});
