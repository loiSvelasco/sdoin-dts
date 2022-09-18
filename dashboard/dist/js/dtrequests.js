
$(document).ready(function(){


    // * START :: dashboard/?users
    $('#adminUserTable').DataTable({
        dom: 'lBfrtip',
        processing: true,
        serverSide: true,
        ajax: requestsFolder + 'getUsers.php',
        buttons: [
            {extend: 'pdfHtml5', orientation: 'landscape', pageSize: 'A4',},
            {extend: 'copyHtml5', orientation: 'landscape', pageSize: 'A4',},
            {extend: 'excelHtml5', orientation: 'landscape', pageSize: 'A4',},
        ],
        "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
        "responsive": true,
        "ordering": false,
        "autoWidth": false,
        "columnDefs": [
            { "targets": [0,9], "className": "align-middle text-center" },
            { "targets": [1,5,7,8], "className": "d-none" },
            { "targets": "_all", "className": "align-middle"}
        ],
    });

    $('#adminUserTable').on('click','.modifyUser', function() {
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
    // * END :: dashboard/?users


    // * START :: dashboard/?myDocs
    $('#myCreatedDocs').DataTable({
        dom: 'lBfrtip',
        processing: true,
        serverSide: true,
        ajax: requestsFolder + 'getMyDocs.php',
        buttons: [
            {extend: 'pdfHtml5', orientation: 'landscape', pageSize: 'A4',},
            {extend: 'copyHtml5', orientation: 'landscape', pageSize: 'A4',},
            {extend: 'excelHtml5', orientation: 'landscape', pageSize: 'A4',},
        ],
        "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
        "responsive": true,
        "ordering": false,
        "autoWidth": false,
        "columnDefs": [
            { "targets": "_all", "className": "align-middle"}
        ],
    });
    // * END :: dashboard/?myDocs


});