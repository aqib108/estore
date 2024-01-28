$(function(){
  fetchAccountSetting();
});
function fetchOrderListing() {
  event.preventDefault();
  $.ajax({
    url: urls.orderListing,
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

function fetchAccountSetting() {
  // event.preventDefault();
  $.ajax({
    url: urls.accountSettingPage,
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
function updateAccountSetting() {
  var name = $('#name').val();
  var email = $('#email').val();
  // Get the CSRF token from the meta tag in your HTML
  var csrfToken = $('meta[name="csrf-token"]').attr('content');
  $.ajax({
    url: urls.saveAccountSetting,
    type: 'POST', // Specify the request method
    data: {
      'name': name,
      'email': email,
    },
    headers: {
      'X-CSRF-TOKEN': csrfToken // Include CSRF token in headers
    },
    success: function(response) {
     if(response.is_logout){
      location.reload();
     }
     swal(response.message);
    },
    error: function(data) {
      // Handle error if needed
    }
  });
}


