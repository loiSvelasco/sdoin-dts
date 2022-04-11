
$(document).ready(function() {

  $('[data-toggle="popover"]').popover()
  $('[data-toggle="tooltip"]').tooltip();

  table = $('#doctables').DataTable({
  dom: 'lBfrtip',
  buttons: [
    {extend: 'pdfHtml5', pageSize: 'A4',},
    {extend: 'copyHtml5', pageSize: 'A4',},
    {extend: 'excelHtml5', pageSize: 'A4',},
    {extend: 'print',
      customize: function(win)
      {
          var last = null;
          var current = null;
          var bod = [];
          var css = '@page { size: landscape; }',
              head = win.document.head || win.document.getElementsByTagName('head')[0],
              style = win.document.createElement('style');

          style.type = 'text/css';
          style.media = 'print';

          if (style.styleSheet)
          {
            style.styleSheet.cssText = css;
          }
          else
          {
            style.appendChild(win.document.createTextNode(css));
          }
          head.appendChild(style);
      }
    },
  ],
  "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
  "responsive": true,
  "ordering": false,
  });

  $('#accdoctables').DataTable({
    dom: 'lBfrtip',
    buttons: [
      {extend: 'pdfHtml5',orientation: 'landscape',pageSize: 'A4',},
      {extend: 'copyHtml5',orientation: 'landscape',pageSize: 'A4',},
      {extend: 'excelHtml5',orientation: 'landscape',pageSize: 'A4',},
      {extend: 'print',
        customize: function(win)
        {
            var last = null;
            var current = null;
            var bod = [];
            var css = '@page { size: landscape; }',
                head = win.document.head || win.document.getElementsByTagName('head')[0],
                style = win.document.createElement('style');
  
            style.type = 'text/css';
            style.media = 'print';
  
            if (style.styleSheet)
            {
              style.styleSheet.cssText = css;
            }
            else
            {
              style.appendChild(win.document.createTextNode(css));
            }
            head.appendChild(style);
        }
      },
    ],
    "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
    "responsive": true,
    "ordering": false,
  });

  $('#releaseTable').DataTable({
    "paging": false,
    "lengthChange": false,
    "searching": true,
    "ordering": false,
    "info": true,
    "autoWidth": false,
    "responsive": true,
  });

  $('#uploadedDocsTable').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": false,
    "info": true,
    "autoWidth": false,
    "responsive": true,
  });

  $('#receiveTable').DataTable({
    "paging": false,
    "lengthChange": false,
    "searching": true,
    "ordering": false,
    "info": true,
    "autoWidth": false,
    "responsive": true,
  });



});




  


$(document).ready(function() {
      $('#releaseTable').on('click','.release_doc', function() {
      $('#modal-release-doc').modal('show');

      $tr = $(this).closest('tr');
      var data = $tr.children("td").map(function() {
          return $(this).text();
      }).get();
      console.log(data);
      
      $('#doc_tracking').val(data[1]);
  });
});



$('.popover-dismiss').popover({
  trigger: 'focus'
})

$(document).ready(function(){
  $("#receive").on('click','#select-all-rec',function(){
    $(".receiveBox").prop('checked', this.checked);
  });
});

$(document).ready(function(){
  $("#release").on('click', '#select-all-rel', function(){
    $(".releaseBox").prop('checked', this.checked);
  });
});

//Get the button:
mybutton = document.getElementById("myBtn");

// When the user scrolls down 150px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 150 || document.documentElement.scrollTop > 150) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

$('#complete-doc').on('show.bs.modal', function(e) {
  $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
  $('.debug-url').html('Debug URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
});