
let requestsFolder = './requests/';

// $.ajax({
//   type: 'GET',
//   url: requestsFolder + 'usercount.php',
//   success: function(data) {
//     $('#userCount').html(data);
//   }
// })

$.ajax({
  type: 'GET',
  url: requestsFolder + 'doctypes.php',
  success: function(data) {
    $('#availdoctypes').html(data);
  }
})