
$(document).ready(function(){


    // * START :: dashboard/?users
    $('#adminUserTable').DataTable({
        dom: 'lBfrtip',
        processing: true,
        language: {
            processing: '<div class="spinner-border text-success" role="status"><span class="sr-only"></span></div>'
        },
        serverSide: true,
        ajax: requestsFolder + 'getUsers.php',
        buttons: [
            {extend: 'pdfHtml5', orientation: 'landscape', pageSize: 'A4',},
            {extend: 'copyHtml5', orientation: 'landscape', pageSize: 'A4',},
            {extend: 'excelHtml5', orientation: 'landscape', pageSize: 'A4',},
        ],
        "lengthMenu": [ [15, 35, 50, -1], [15, 35, 50, "All"] ],
        "responsive": true,
        "ordering": true,
        "order": [[0, 'asc']],
        "autoWidth": false,
        "columnDefs": [
            { "targets": [0,9], "className": "align-middle text-center" },
            { "targets": [1,5,7,8], "className": "d-none" },
            { "targets": "_all", "className": "align-middle"}
        ],
        "drawCallback": function( settings ) {
            $('[data-toggle="tooltip"]').tooltip();
            $('[data-toggle="popover"]').popover();
        },
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
        language: {
            processing: '<div class="spinner-border text-success" role="status"><span class="sr-only"></span></div>'
        },
        serverSide: true,
        ajax: requestsFolder + 'getMyDocs.php',
        buttons: [
            {extend: 'pdfHtml5', orientation: 'landscape', pageSize: 'A4',},
            {extend: 'copyHtml5', orientation: 'landscape', pageSize: 'A4',},
            {extend: 'excelHtml5', orientation: 'landscape', pageSize: 'A4',},
        ],
        "lengthMenu": [ [15, 35, 50, -1], [15, 35, 50, "All"] ],
        "responsive": true,
        "ordering": true,
        "order": [[4, 'desc']],
        "autoWidth": false,
        "columnDefs": [
            { "targets": "_all", "className": "align-middle"}
        ],
        "drawCallback": function( settings ) {
            $('[data-toggle="tooltip"]').tooltip();
            $('[data-toggle="popover"]').popover();
        },
    });
    // * END :: dashboard/?myDocs


    // * START :: dashboard/?searchDocs
    $('#searchDocs').DataTable({
        dom: 'lBfrtip',
        processing: true,
        language: {
            processing: '<div class="spinner-border text-success" role="status"><span class="sr-only"></span></div>'
        },
        serverSide: true,
        ajax: requestsFolder + 'getSearchDocs.php',
        buttons: [
            {extend: 'pdfHtml5', orientation: 'landscape', pageSize: 'A4',},
            {extend: 'copyHtml5', orientation: 'landscape', pageSize: 'A4',},
            {extend: 'excelHtml5', orientation: 'landscape', pageSize: 'A4',},
        ],
        "lengthMenu": [ [15, 35, 50, -1], [15, 35, 50, "All"] ],
        "responsive": true,
        "ordering": true,
        "order": [[4, 'desc']],
        "autoWidth": false,
        "columnDefs": [
            { "targets": "_all", "className": "align-middle"}
        ],
        "drawCallback": function( settings ) {
            $('[data-toggle="tooltip"]').tooltip();
            $('[data-toggle="popover"]').popover();
        },
    });
    // * END :: dashboard/?searchDocs


    // * START :: dashboard/?received
    const date = new Date();
    let day = date.getDate();
    let month = date.getMonth() + 1;
    let year = date.getFullYear();
    // This arrangement can be altered based on how we want the date's format to appear.
    let currentDate = `${year}-${month}-${day}`;
    $('#reportsReceived').DataTable().destroy();
    fetch_received_data('yes', currentDate, currentDate);

    document.getElementById('drReceived').addEventListener('submit', function (event) {
        event.preventDefault();
        const form = event.target;
        const formFields = form.elements;
        const startDate = formFields[1];
        const endDate = formFields[2];    


        if(startDate.value != '' && endDate.value != '')
        {
            $('#reportsReceived').DataTable().destroy();
            fetch_received_data('no', startDate.value, endDate.value);
        }
    }, false);

    function fetch_received_data(today, startDate = '', endDate = '') {
        $('#reportsReceived').DataTable({
            dom: 'lBfrtip',
            processing: true,
            language: {
                processing: '<div class="spinner-border text-warning" role="status"><span class="sr-only"></span></div>'
            },
            serverSide: true,
            ajax: {
                url: requestsFolder + 'getReportReceived.php',
                type: "GET",
                data: {
                    today: today,
                    startDate: startDate,
                    endDate: endDate
                }
            },
            buttons: [
                {extend: 'pdfHtml5', orientation: 'landscape', pageSize: 'A4',},
                {extend: 'copyHtml5', orientation: 'landscape', pageSize: 'A4',},
                {extend: 'excelHtml5', orientation: 'landscape', pageSize: 'A4',},
            ],
            "lengthMenu": [ [15, 35, 50, -1], [15, 35, 50, "All"] ],
            "responsive": true,
            "ordering": true,
            "order": [[4, 'desc']],
            "autoWidth": false,
            "columnDefs": [
                { "targets": "_all", "className": "align-middle"}
            ],
            "drawCallback": function( settings ) {
                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="popover"]').popover();
            },
        });
    }
    // * END :: dashboard/?received

});

$(document).ready(function() {
    // * START :: dashboard/?released
    const date = new Date();
    let day = date.getDate();
    let month = date.getMonth() + 1;
    let year = date.getFullYear();
    // This arrangement can be altered based on how we want the date's format to appear.
    let currentDate = `${year}-${month}-${day}`;
    $('#reportsReleased').DataTable().destroy();
    fetch_released_data('yes', currentDate, currentDate);

    document.getElementById('drReleased').addEventListener('submit', function (event) {
        event.preventDefault();
        const form = event.target;
        const formFields = form.elements;
        const startDate = formFields[1];
        const endDate = formFields[2];    
        // console.log('start:' + startDate.value);
        // console.log('end:' + endDate.value);

        if(startDate.value != '' && endDate.value != '')
        {
            $('#reportsReleased').DataTable().destroy();
            fetch_released_data('no', startDate.value, endDate.value);
        }
    }, false);

    function fetch_released_data(today, startDate = '', endDate = '') {
        $('#reportsReleased').DataTable({
            dom: 'lBfrtip',
            processing: true,
            language: {
                processing: '<div class="spinner-border text-info" role="status"><span class="sr-only"></span></div>'
            },
            serverSide: true,
            ajax: {
                url: requestsFolder + 'getReportReleased.php',
                type: "GET",
                data: {
                    today: today,
                    startDate: startDate,
                    endDate: endDate
                }
            },
            buttons: [
                {extend: 'pdfHtml5', orientation: 'landscape', pageSize: 'A4',},
                {extend: 'copyHtml5', orientation: 'landscape', pageSize: 'A4',},
                {extend: 'excelHtml5', orientation: 'landscape', pageSize: 'A4',},
            ],
            "lengthMenu": [ [15, 35, 50, -1], [15, 35, 50, "All"] ],
            "responsive": true,
            "ordering": true,
            "order": [[4, 'desc']],
            "autoWidth": false,
            "columnDefs": [
                { "targets": "_all", "className": "align-middle"}
            ],
            "drawCallback": function( settings ) {
                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="popover"]').popover();
            },
        });
    }
    // * END :: dashboard/?released
});


$(document).ready(function (){
    // * START :: dashboard/?documents :: receiving table
    var receiveTable = $('#receiveTable').DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="spinner-border text-warning" role="status"><span class="sr-only"></span></div>'
        },
        "serverSide": true,
        "ajax": requestsFolder + 'getToReceive.php',
        "lengthMenu": [ [15, 35, 50, -1], [15, 35, 50, "All"] ],
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "columnDefs": [
            { "targets": 2, "className": "d-none" },
            { "targets": [0,1,4], "className": "align-middle text-center"},
            { "targets": "_all", "className": "align-middle"},
            { "targets": 0, "checkboxes": { "selectRow": true } }
        ],
        "select": { "style": "multi" },
        "responsive": true,
        "drawCallback": function( settings ) {
            $('[data-toggle="tooltip"]').tooltip();
            $('[data-toggle="popover"]').popover();
        },
        "rowCallback": function( row, data, index ) {
            if (data[2] === "yes") {
                $(row).addClass('table-danger');
            }
        },
      });

    
      $(document).on('submit','#receive', function(e){
        var form = this;

        var rows_selected = receiveTable.column(0).checkboxes.selected();
        $.each(rows_selected, function(index, rowId){
            $(form).append(
                $('<input>')
                   .attr('type', 'hidden')
                   .attr('name', 'rec-check[]')
                   .val(rowId)
            );
         });
      });
    // * END :: dashboard/?documents :: receiving table
});


$(document).ready(function (){
    // * START :: dashboard/?documents :: release table
    var releaseTable = $('#releaseTable').DataTable({
        processing: true,
        language: {
            processing: '<div class="spinner-border text-info" role="status"><span class="sr-only"></span></div>'
        },
        serverSide: true,
        ajax: requestsFolder + 'getToRelease.php',
        "lengthMenu": [ [15, 35, 50, -1], [15, 35, 50, "All"] ],
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "columnDefs": [
            { "targets": [2], "className": "d-none" },
            { "targets": [0,1,4], "className": "align-middle text-center"},
            { "targets": "_all", "className": "align-middle"},
            { "targets": 0, "checkboxes": { "selectRow": true } }
        ],
        "select": { "style": "multi" },
        "responsive": true,
        "drawCallback": function( settings ) {
            $('[data-toggle="tooltip"]').tooltip();
            $('[data-toggle="popover"]').popover();
        },
        "rowCallback": function( row, data, index ) {
            if (data[2] === "yes") {
                $(row).addClass('table-danger');
            }
        },
      });
    
    
      $(document).on('submit','#release', function(e){
        var form = this;

        var rows_selected = releaseTable.column(0).checkboxes.selected();
        $.each(rows_selected, function(index, rowId){
            $(form).append(
                $('<input>')
                   .attr('type', 'hidden')
                   .attr('name', 'rel-check[]')
                   .val(rowId)
            );
         });
      });
    // * END :: dashboard/?documents :: release table
});


$(document).ready(function() {
    // * START :: dashboard/?allReceived
    const date = new Date();
    let day = date.getDate();
    let month = date.getMonth() + 1;
    let year = date.getFullYear();
    // This arrangement can be altered based on how we want the date's format to appear.
    let currentDate = `${year}-${month}-${day}`;
    $('#adminAllReceived').DataTable().destroy();
    fetch_all_received_data('yes', currentDate, currentDate);

    document.getElementById('adminAllRec').addEventListener('submit', function (event) {
        event.preventDefault();
        const form = event.target;
        const formFields = form.elements;
        const startDate = formFields[1];
        const endDate = formFields[2];    
        console.log('start:' + startDate.value);
        console.log('end:' + endDate.value);

        if(startDate.value != '' && endDate.value != '')
        {
            $('#adminAllReceived').DataTable().destroy();
            fetch_all_received_data('no', startDate.value, endDate.value);
        }
    }, false);

    function fetch_all_received_data(today, startDate = '', endDate = '') {
        $('#adminAllReceived').DataTable({
            dom: 'lBfrtip',
            processing: true,
            language: {
                processing: '<div class="spinner-border text-warning" role="status"><span class="sr-only"></span></div>'
            },
            serverSide: true,
            ajax: {
                url: requestsFolder + 'getAllReportReceived.php',
                type: "GET",
                data: {
                    today: today,
                    startDate: startDate,
                    endDate: endDate
                }
            },
            buttons: [
                {extend: 'pdfHtml5', orientation: 'landscape', pageSize: 'A4',},
                {extend: 'copyHtml5', orientation: 'landscape', pageSize: 'A4',},
                {extend: 'excelHtml5', orientation: 'landscape', pageSize: 'A4',},
            ],
            "lengthMenu": [ [15, 35, 50, -1], [15, 35, 50, "All"] ],
            "responsive": true,
            "ordering": true,
            "order": [[4, 'desc']],
            "autoWidth": false,
            "columnDefs": [
                { "targets": "_all", "className": "align-middle"}
            ],
            "drawCallback": function( settings ) {
                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="popover"]').popover();
            },
        });
    }
    // * END :: dashboard/?allReceived
});



$(document).ready(function() {
    // * START :: dashboard/?allReleased
    const date = new Date();
    let day = date.getDate();
    let month = date.getMonth() + 1;
    let year = date.getFullYear();
    // This arrangement can be altered based on how we want the date's format to appear.
    let currentDate = `${year}-${month}-${day}`;
    $('#adminAllReleased').DataTable().destroy();
    fetch_all_released_data('yes', currentDate, currentDate);

    document.getElementById('adminAllRel').addEventListener('submit', function (event) {
        event.preventDefault();
        const form = event.target;
        const formFields = form.elements;
        const startDate = formFields[1];
        const endDate = formFields[2];    
        console.log('start:' + startDate.value);
        console.log('end:' + endDate.value);

        if(startDate.value != '' && endDate.value != '')
        {
            $('#adminAllReleased').DataTable().destroy();
            fetch_all_released_data('no', startDate.value, endDate.value);
        }
    }, false);

    function fetch_all_released_data(today, startDate = '', endDate = '') {
        $('#adminAllReleased').DataTable({
            dom: 'lBfrtip',
            processing: true,
            language: {
                processing: '<div class="spinner-border text-info" role="status"><span class="sr-only"></span></div>'
            },
            serverSide: true,
            ajax: {
                url: requestsFolder + 'getAllReportReleased.php',
                type: "GET",
                data: {
                    today: today,
                    startDate: startDate,
                    endDate: endDate
                }
            },
            buttons: [
                {extend: 'pdfHtml5', orientation: 'landscape', pageSize: 'A4',},
                {extend: 'copyHtml5', orientation: 'landscape', pageSize: 'A4',},
                {extend: 'excelHtml5', orientation: 'landscape', pageSize: 'A4',},
            ],
            "lengthMenu": [ [15, 35, 50, -1], [15, 35, 50, "All"] ],
            "responsive": true,
            "ordering": true,
            "order": [[4, 'desc']],
            "autoWidth": false,
            "columnDefs": [
                { "targets": "_all", "className": "align-middle"}
            ],
            "drawCallback": function( settings ) {
                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="popover"]').popover();
            },
        });
    }
    // * END :: dashboard/?allReleased
});

$(document).ready(function(){
    // * START :: dashboard/?reports :: created docs under unit
    $('#myUnitDocs').DataTable({
        dom: 'lBfrtip',
        processing: true,
        language: {
            processing: '<div class="spinner-border text-success" role="status"><span class="sr-only"></span></div>'
        },
        serverSide: true,
        ajax: requestsFolder + 'getUnitDocs.php',
        buttons: [
            {extend: 'pdfHtml5', orientation: 'landscape', pageSize: 'A4',},
            {extend: 'copyHtml5', orientation: 'landscape', pageSize: 'A4',},
            {extend: 'excelHtml5', orientation: 'landscape', pageSize: 'A4',},
        ],
        "lengthMenu": [ [15, 35, 50, -1], [15, 35, 50, "All"] ],
        "responsive": true,
        "ordering": true,
        "order": [[4, 'desc']],
        "autoWidth": false,
        "columnDefs": [
            { "targets": "_all", "className": "align-middle"}
        ],
        "drawCallback": function( settings ) {
            $('[data-toggle="tooltip"]').tooltip();
            $('[data-toggle="popover"]').popover();
        },
    });
    // * END :: dashboard/?reports :: created docs under unit
});


$(document).ready(function(){
    // * START :: dashboard/?reports :: accomlished docs under unit
    $('#myUnitDocsAccomp').DataTable({
        dom: 'lBfrtip',
        processing: true,
        language: {
            processing: '<div class="spinner-border text-success" role="status"><span class="sr-only"></span></div>'
        },
        serverSide: true,
        ajax: requestsFolder + 'getUnitAccomp.php',
        buttons: [
            {extend: 'pdfHtml5', orientation: 'landscape', pageSize: 'A4',},
            {extend: 'copyHtml5', orientation: 'landscape', pageSize: 'A4',},
            {extend: 'excelHtml5', orientation: 'landscape', pageSize: 'A4',},
        ],
        "lengthMenu": [ [15, 35, 50, -1], [15, 35, 50, "All"] ],
        "responsive": true,
        "ordering": true,
        "order": [[4, 'desc']],
        "autoWidth": false,
        "columnDefs": [
            { "targets": "_all", "className": "align-middle"}
        ],
        "drawCallback": function( settings ) {
            $('[data-toggle="tooltip"]').tooltip();
            $('[data-toggle="popover"]').popover();
        },
    });
    // * END :: dashboard/?reports :: accomlished docs under unit
});



$(document).ready(function(){
    // * START :: dashboard/?reports :: accomlished docs under unit
    $('#issuesTable').DataTable({
        dom: 'lBfrtip',
        // processing: true,
        language: {
            processing: '<div class="spinner-border text-success" role="status"><span class="sr-only"></span></div>'
        },
        // serverSide: true,
        // ajax: requestsFolder + 'getUnitAccomp.php',
        buttons: [
            {extend: 'pdfHtml5', orientation: 'landscape', pageSize: 'A4',},
            {extend: 'copyHtml5', orientation: 'landscape', pageSize: 'A4',},
            {extend: 'excelHtml5', orientation: 'landscape', pageSize: 'A4',},
        ],
        "lengthMenu": [ [15, 35, 50, -1], [15, 35, 50, "All"] ],
        "responsive": true,
        "ordering": true,
        "order": [[4, 'desc']],
        "autoWidth": false,
        "columnDefs": [
            { "targets": "_all", "className": "align-middle"}
        ],
        "drawCallback": function( settings ) {
            $('[data-toggle="tooltip"]').tooltip();
            $('[data-toggle="popover"]').popover();
        },
    });
    // * END :: dashboard/?reports :: accomlished docs under unit
});