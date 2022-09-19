
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


    // * START :: dashboard/?received :: NOT FINISHED
    document.getElementById('drReceived').addEventListener('submit', function (event) {
        // event.preventDefault();
        const form = event.target;
        const formFields = form.elements;
        const startDate = formFields[1];
        const endDate = formFields[2];    
        console.log('start:' + startDate.value);
        console.log('end:' + endDate.value);

    }, false);

    $('#received_dr').daterangepicker();
    $('#received_dr').on('apply.daterangepicker', function(ev, picker) {
        var startDate = picker.startDate.format('YYYY-MM-DD');
        var endDate = picker.endDate.format('YYYY-MM-DD');
      });

    $.fn.dataTableExt.afnFiltering.push(
    function( oSettings, aData, iDataIndex ) {
        var iFini = document.getElementById('startDate').value;
        var iFfin = document.getElementById('endDate').value;
        var iStartDateCol = 6;
        var iEndDateCol = 7;
    
        iFini=iFini.substring(6,10) + iFini.substring(3,5)+ iFini.substring(0,2);
        iFfin=iFfin.substring(6,10) + iFfin.substring(3,5)+ iFfin.substring(0,2);
    
        var datofini=aData[iStartDateCol].substring(6,10) + aData[iStartDateCol].substring(3,5)+ aData[iStartDateCol].substring(0,2);
        var datoffin=aData[iEndDateCol].substring(6,10) + aData[iEndDateCol].substring(3,5)+ aData[iEndDateCol].substring(0,2);
    
        if ( iFini === "" && iFfin === "" )
        {
            return true;
        }
        else if ( iFini <= datofini && iFfin === "")
        {
            return true;
        }
        else if ( iFfin >= datoffin && iFini === "")
        {
            return true;
        }
        else if (iFini <= datofini && iFfin >= datoffin)
        {
            return true;
        }
        return false;
    }
);

    var reportsReceived = $('#reportsReceived').DataTable({
        dom: 'lBfrtip',
        processing: true,
        serverSide: true,
        ajax: requestsFolder + 'getReportReceived.php',
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

    $('#received_dr').on('change', function () {
        table.draw();
    });
    // * END :: dashboard/?received


});