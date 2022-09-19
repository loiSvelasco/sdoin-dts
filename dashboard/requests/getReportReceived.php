<?php

require_once("../../config.php");

// DB table to use
// $table = <<<LALAQT
//     (
//         SELECT * FROM docs_location WHERE 
//         DATE(dl_receiveddate) = '" . currentdate() . "' 
//         AND dl_unit = {$_SESSION['unit']} 
//         ORDER BY dl_id DESC
//     ) temp
// LALAQT;

// if(isset($_POST['startDate']) && isset($_POST['endDate']))
// {
//     $start = escape_string($_GET['startDate']);
//     $end = escape_string($_GET['endDate']);
//     $table =
//             "(
//             SELECT * FROM docs_location
//             WHERE DATE(dl_receiveddate) BETWEEN '{$start}' AND '{$end}' 
//             AND dl_unit = {$_SESSION['unit']} 
//             ORDER BY dl_id DESC
//             ) temp";
// }
// else
// {
//     $table = 
//             "(
//             SELECT * FROM docs_location WHERE 
//             DATE(dl_receiveddate) = '" . currentdate() . "' 
//             AND dl_unit = {$_SESSION['unit']} 
//             ORDER BY dl_id DESC
//             ) temp";
// }

$table = 
"(
SELECT * FROM docs_location WHERE 
DATE(dl_receiveddate) != ''
AND dl_unit = {$_SESSION['unit']} 
AND dl_receivedby != ''
ORDER BY dl_id DESC
) temp";


// Where Clause
$whereAll = "";


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