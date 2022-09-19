
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
        "ordering": true,
        "order": [[0, 'asc']],
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
        "ordering": true,
        "order": [[4, 'desc']],
        "autoWidth": false,
        "columnDefs": [
            { "targets": "_all", "className": "align-middle"}
        ],
    });
    // * END :: dashboard/?myDocs


    // * START :: dashboard/?searchDocs
    $('#searchDocs').DataTable({
        dom: 'lBfrtip',
        processing: true,
        serverSide: true,
        ajax: requestsFolder + 'getSearchDocs.php',
        buttons: [
            {extend: 'pdfHtml5', orientation: 'landscape', pageSize: 'A4',},
            {extend: 'copyHtml5', orientation: 'landscape', pageSize: 'A4',},
            {extend: 'excelHtml5', orientation: 'landscape', pageSize: 'A4',},
        ],
        "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
        "responsive": true,
        "ordering": true,
        "order": [[4, 'desc']],
        "autoWidth": false,
        "columnDefs": [
            { "targets": "_all", "className": "align-middle"}
        ],
    });
    // * END :: dashboard/?searchDocs


    // * START :: dashboard/?received
    document.getElementById('drReceived').addEventListener('submit', function (event) {
        event.preventDefault();
        const form = event.target;
        const formFields = form.elements;
        const startDate = formFields[1];
        const endDate = formFields[2];    
        // console.log('start:' + startDate.value);
        // console.log('end:' + endDate.value);

        if(startDate.value != '' && endDate.value != '')
        {
            $('#reportsReceived').DataTable().destroy();
            fetch_received_data('no', startDate.value, endDate.value);
        }
        else
        {
            const date = new Date();
            let day = date.getDate();
            let month = date.getMonth() + 1;
            let year = date.getFullYear();
            // This arrangement can be altered based on how we want the date's format to appear.
            let currentDate = `${year}-${month}-${day}`;
            console.log(currentDate); // "17-6-2022"
            $('#reportsReceived').DataTable().destroy();
            fetch_received_data('yes', currentDate, currentDate);
        }
    }, false);

    function fetch_received_data(today, startDate = '', endDate = '') {
        $('#reportsReceived').DataTable({
            dom: 'lBfrtip',
            processing: true,
            serverSide: true,
            ajax: {
                url: requestsFolder + 'getReportReceived.php',
                type: 'POST',
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
            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            "responsive": true,
            "ordering": true,
            "order": [[4, 'desc']],
            "autoWidth": false,
            "columnDefs": [
                { "targets": "_all", "className": "align-middle"}
            ],
        });
    }
    // * END :: dashboard/?received


});