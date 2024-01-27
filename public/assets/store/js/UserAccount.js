function fetchOrderListing() {
  event.preventDefault();
  $.ajax({
    url: '/order-listing',
    type: 'GET', // Specify the request method
    data: {},
    success: function(response) {
    $('#load-account-wrapper').html(response.html);
    $('#account-loader').addClass('d-none');
    },
    error: function(data) {
      // Handle error if needed
    }
  });
}


