(() => {
  // resources/js/cp_app.js
  jQuery(function($) {
    $("#filter-product-cat").on("change", function(event) {
      console.log(this.value);
      event.preventDefault();
      $.ajax({
        type: "POST",
        url: "/wp-admin/admin-ajax.php",
        dataType: "html",
        data: {
          action: "shop_filter_category",
          product_cat: this.value
        },
        success: function(res) {
          $(".shop-product-grid").html(res);
        }
      });
    });
  });
})();
