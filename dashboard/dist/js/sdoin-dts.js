function hideLoader() {
  $('#loading').hide();
}

function accompRemarks() {
  $('#accomp-remarks').submit();
}

$(window).ready(hideLoader);

// Strongly recommended: Hide loader after 20 seconds, even if the page hasn't finished loading
setTimeout(hideLoader, 15 * 1000);

$(function () {
  $('#received_drpicker').daterangepicker({
    locale: {
      format: 'YYYY-MM-DD'
    },
  });

  $('#startDate').val($('#received_drpicker').data('daterangepicker').startDate.format('YYYY-MM-DD'));
  $('#endDate').val($('#received_drpicker').data('daterangepicker').endDate.format('YYYY-MM-DD'));

  $('#received_drpicker').on('apply.daterangepicker', function(ev, picker) {
    $('input[name="startDate"]').val(picker.startDate.format('YYYY-MM-DD'));
    $('input[name="endDate"]').val(picker.endDate.format('YYYY-MM-DD'));
  });
})

$(document).ready(function() {

  $('#toPersonnel').hide();
  $('input[name=forPersonnel]').click(function() {
    if (this.checked) {
      $('#toPersonnel').show();
      $('#toUnit').hide();
      // console.log('checked!');
    } else {
      $('#toPersonnel').hide();
      $('#toPersonnel').val("");
      $('#toUnit').show();
      // console.log('unchecked!');
    }
  });

  $('#toPersonnelMulti').hide();
  $('input[name=forPersonnelMulti]').click(function() {
    if (this.checked) {
      $('#toPersonnelMulti').show();
      $('#toUnitMulti').hide();
      // console.log('checked!');
    } else {
      $('#toPersonnelMulti').hide();
      $('#toPersonnelMulti').val("");
      $('#toUnitMulti').show();
      // console.log('unchecked!');
    }
  });

  $('[data-toggle="popover"]').popover();
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
  "autoWidth": false,
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
    "autoWidth": false,
  });

  $('#releaseTable').DataTable({
    // "paging": false,
    // "lengthChange": false,
    "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
    "searching": true,
    "ordering": false,
    "info": true,
    "autoWidth": false,
    "responsive": true,
  });

  $('#reportTable').DataTable({
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
    "autoWidth": false,
  });

  $('#adminTables').DataTable({
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
    "autoWidth": false,
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
    // "paging": false,
    // "lengthChange": false,
    "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
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
      $('.tracking_placeholder').val(data[1]);
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
  // $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
  $(this).find('#acc_tracking').attr('value', $(e.relatedTarget).data('tracking'));
  $(this).find('#acc_refer').attr('value', $(e.relatedTarget).data('refer'));
  $(this).find('#acc_manipulate').attr('value', $(e.relatedTarget).data('manipulate'));
  // $('.debug-url').html('Debug URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
});

$('#modal-release-doc').on('show.bs.modal', function(e) {
  $(this).find('#doc_tracking').attr('value', $(e.relatedTarget).data('tracking'));
});

$('#purge-doc').on('show.bs.modal', function(e) {
  $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
  $('.debug-url').html('<strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
});

$(document).ready(function() {
  $('#adminTables').on('click','.modifyUser', function() {
      $('#modify-user').modal('show');
      $tr = $(this).closest('tr');
      var data = $tr.children("td").map(function() {
          return $(this).text();
      }).get();
      console.log(data);
      
      $('#userID').val(data[1]);
      $('#userMail').val(data[2]);
      $('#userFname').val(data[3]);
      $('#userRole').val(data[5]);
      $('#userUnit').val(data[7]);
      
      $('#locked').attr('checked', false);
      if(data[8] == 1) {
        $('#locked').attr('checked', true);
      }

  });
});

$('.flexdatalist').flexdatalist({
  selectionRequired: 1,
  minLength: 0
});
