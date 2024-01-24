$(function(){
  $("#load-all-products").trigger("click");
})
function loadProducts(category){
  $('#product-loader').removeClass('d-none');
  
  $.ajax({
    url: 'get-products?category='+category,
    type: "get",
    success: function(response) {
      $('#product-loader').addClass('d-none');
      $('#product-wrapper').html(response.html);
    },
    error: function(data) {
    }
  });
}
$("#load-all-products").on("click", function() {
  loadProducts('all');
});