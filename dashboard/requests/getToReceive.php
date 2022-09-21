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
    SELECT 
        documents.id,
        documents.document_tracking,
        documents.document_accomplished,
        documents.document_title,
        docs_location.dl_tracking,
        docs_location.dl_receivedby,
        docs_location.dl_releaseddate
    FROM documents
        JOIN docs_location ON documents.document_tracking = docs_location.dl_tracking
    WHERE docs_location.dl_unit = 122 
    AND docs_location.dl_receivedby = 0
    AND documents.document_accomplished = 0
    ORDER BY docs_location.dl_releaseddate ASC
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
    // ['db' => 'document_tracking', 'dt' => 0,
    //  'formatter' => function ($d, $row) {
    //     return '<input style="transform: scale(1)" type="checkbox" name="rec-check[]" value="'.$d.'" class="receiveBox" form="receive">';
    //  }
    // ],
    ['db' => 'document_tracking', 'dt' => 0],

    ['db' => 'document_tracking', 'dt' => 1,
     'formatter' => function ($d, $row) {
       return '<a href="?tracking='.$d.'" target="_blank" class="btn-link text-small" data-toggle="tooltip" data-placement="top" title="View Track">
       '.$d.'</a>';
     }],

    ['db' => 'document_tracking', 'dt' => 2,
     'formatter' => function($d, $row) {
        return '
            <a tabindex="0" 
            class="btn btn-link btn-sm text-left rounded-0 popover-dismiss" 
                role="button" data-toggle="popover" 
                data-html="true" 
                data-trigger="focus" title="Document Details"
            data-content="
                Type: '.get_doctype_name(get_document_detail($d, 'document_type')).'
                <br>Origin: '.get_unit_name(get_document_detail($d, 'document_origin')).'
                <br>Owner: '.get_user_name(get_document_detail($d, 'document_owner')).'
                <br>Purpose: '.get_document_detail($d, 'document_purpose').'
                <br>Description: '.get_document_detail($d, 'document_desc').'
                <hr>Date Created:<br>'.format_date(get_document_detail($d, 'date_created')).'">
                '.get_document_detail($d, 'document_title').'
                <strong class="small text-muted"> | '.get_doctype_name(get_document_detail($d, 'document_type')).'</strong></a>
        ';
     }],

    ['db' => 'document_tracking', 'dt' => 3, 
     'formatter' => function ($d, $row) {
        return '
        <a href="?manipulate=receive&tracking='.$d.'&refer=/dashboard/?documents" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="left" title="Receive"><i class="fa fa-file-import"></i></a>
        ';
     }]
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