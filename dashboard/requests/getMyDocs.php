<?php

require_once("../../config.php");
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
// DB table to use
$table = <<<LALAQT
    (
        SELECT * FROM documents 
        WHERE document_owner = {$_SESSION['user_id']} 
        ORDER BY id DESC 
    ) temp
LALAQT;

// Where Clause
$whereAll = "";


// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = [
    ['db' => 'document_tracking', 'dt' => 0,
     'formatter' => function ($d, $row) {
        return '
        <a href="?tracking='.$d.'" target="_blank" data-toggle="tooltip" data-placement="top" title="Track"><i class="fa fa-search"></i></a>&nbsp;&nbsp;
        <a href="?print='.$d.'" target="_blank" data-toggle="tooltip" data-placement="top" title="Print Tracking no."><i class="fa fa-print"></i></a>&nbsp;&nbsp;
        <a href="?modifyMyDoc='.$d.'" target="_blank" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
        ' . $d;
     }
    ],

    ['db' => 'document_title', 'dt' => 1],
    ['db' => 'document_purpose', 'dt' => 2],

    ['db' => 'document_type', 'dt' => 3, 
     'formatter' => function ($d, $row) {
        return get_doctype_name($d);
     }
    ],

    ['db' => 'date_created', 'dt' => 4,
     'formatter' => function ($d, $row ) {
        return format_date($d);
     }
    ],

    ['db' => 'document_tracking', 
     'dt' => 5,
     'formatter' => function ($d, $row) {
        return get_doc_current_location($d);
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