function AddToCart(type) {
  var qty = $('.product-qty').val();
  var productId = $('.product-qty').data('product-id');
  var productPrice = $('.product-qty').data('product-price');
  
  // Get the CSRF token from the meta tag in your HTML
  var csrfToken = $('meta[name="csrf-token"]').attr('content');
  $.ajax({
    url: urls.addToCart,
    type: 'POST', // Specify the request method
    data: {
      'product_price': productPrice,
      'product_id': productId,
      'product_qty': qty,
      'cart_type':type
    },
    headers: {
      'X-CSRF-TOKEN': csrfToken // Include CSRF token in headers
    },
    success: function(response) {
    var cartCount = response.data.total_cart_product;
    if(cartCount>0){
      $('.e-cart-count').addClass('icon-header-noti');
      $('.e-cart-count').attr('data-notify', cartCount);
      swal('Successfully Product Add Into Cart')
    }
    
    },
    error: function(data) {
      // Handle error if needed
    }
  });
}
function removeToCart(itemId){
$.ajax({
  url: urls.removeToCart,
  type: 'POST', // Specify the request method
  data: {
    'item_id': itemId,
  },
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token in headers
  },
  success: function(response) {
    location.href = $('.cart-url').attr('data-url');
  },
  error: function(data) {
    // Handle error if needed
  }
});
}
function updateCartItemQty(itemId){
  var qty = $('#product_qty_'+itemId).val();
  $.ajax({
    url: urls.updateToQty,
    type: 'POST', // Specify the request method
    data: {
      'item_id': itemId,
      'qty':qty
    },
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token in headers
    },
    success: function(response) {
    var cartCount = response.data.total_cart_product;
    if(cartCount>0){
      $('.e-cart-count').addClass('icon-header-noti');
      $('.e-cart-count').attr('data-notify', cartCount);
      $('.total').text('$ '+response.data.total);
      $('.sub-total').text('$ '+response.data.sub_total);
      $('.item-total-price-'+itemId).text('$ '+response.data.item_sub_total);
    }
    },
    error: function(data) {
      // Handle error if needed
    }
  });
}