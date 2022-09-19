<?php

require_once("../../config.php");

if($_POST['today'] == 'no')
{
   $start = escape_string($_POST['startDate']);
   $end = escape_string($_POST['endDate']);
   $table = "docs_location";
   // Where Clause
   $whereAll = "DATE(dl_receiveddate) BETWEEN '{$start}' AND '{$end}' AND dl_unit = {$_SESSION['unit']}";
}

// Table's primary key
$primaryKey = 'dl_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = [
    ['db' => 'dl_tracking', 'dt' => 0,
     'formatter' => function ($d, $row) {
        return '
        <a href="?tracking='.$d.'" target="_blank" data-toggle="tooltip" data-placement="top" title="Track"><i class="fa fa-search"></i></a>&nbsp;&nbsp;
        <a href="?print='.$d.'" target="_blank" data-toggle="tooltip" data-placement="top" title="Print Tracking no."><i class="fa fa-print"></i></a>&nbsp;&nbsp;
        ' . $d;
     }
    ],

    ['db' => 'dl_tracking', 'dt' => 1,
     'formatter' => function ($d, $row) {
        return get_document_detail($d, 'document_title');
     }
    ],
    ['db' => 'dl_tracking', 'dt' => 2,
     'formatter' => function ($d, $row) {
        return get_document_detail($d, 'document_purpose');
     }
    ],

    ['db' => 'dl_tracking', 'dt' => 3, 
     'formatter' => function ($d, $row) {
        return get_doctype_name(get_document_detail($d, 'document_type'));
     }
    ],

    ['db' => 'dl_receiveddate', 'dt' => 4,
    'formatter' => function ($d, $row) {
        return format_date($d);
     }
    ],

    ['db' => 'dl_receivedby', 
     'dt' => 5,
     'formatter' => function ($d, $row) {
        return get_user_name($d);
     }
    ]
];
 
// SQL server connection information
$sql_details = array(
    'user' => DB_USER,
    'pass' => DB_PASS,
    'db'   => DB_NAME,
    'host' => DB_HOST
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.class.php' );
echo json_encode(
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, $whereAll )
);