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
        docs_location.dl_receiveddate,
        docs_location.dl_for,
        docs_location.dl_id
    FROM documents
        JOIN docs_location ON documents.document_tracking = docs_location.dl_tracking
    WHERE docs_location.dl_unit = {$_SESSION['unit']} 
    AND docs_location.dl_receivedby != 0
    AND docs_location.dl_forwarded = 0
    AND docs_location.dl_for = 0
    OR docs_location.dl_for = {$_SESSION['user_id']} 
    AND documents.document_accomplished = 0
    ORDER BY docs_location.dl_receiveddate DESC
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

    ['db' => 'dl_for', 'dt' => 2,
     'formatter' => function($d, $row) {
        global $releasable;
        return $releasable = ($d == $_SESSION['user_id'] ? "yes" : ($d == 0 ? "possible" : "no"));
     }],

    ['db' => 'document_tracking', 'dt' => 3,
     'formatter' => function($d, $row) {
        global $releasable;
        $dot = '';
        if($releasable == "yes") {
            $dot = '<small><span class="badge badge-pill badge-danger">&ensp;</span></small>&nbsp;';
        }
        return '
            <a tabindex="0" 
            class="btn btn-link btn-sm text-left rounded-0 popover-dismiss" 
                role="button" data-toggle="popover" 
                data-html="true" 
                data-trigger="focus" title="Document Details"l
            data-content="
                Type: '.get_doctype_name(get_document_detail($d, 'document_type')).'
                <br>Origin: '.get_unit_name(get_document_detail($d, 'document_origin')).'
                <br>Owner: '.get_user_name(get_document_detail($d, 'document_owner')).'
                <br>Purpose: '.get_document_detail($d, 'document_purpose').'
                <br>Description: '.get_document_detail($d, 'document_desc').'
                <hr>Date Created:<br>'.format_date(get_document_detail($d, 'date_created')).'">
                '. $dot . " " . get_document_detail($d, 'document_title').'
                <strong class="small text-muted"> | '.get_doctype_name(get_document_detail($d, 'document_type')).'</strong></a>
        ';
     }],

    ['db' => 'document_tracking', 'dt' => 4, 
     'formatter' => function ($d, $row) {
        return '
        <span data-toggle="tooltip" data-placement="left" title="Release"><button data-toggle="modal" data-target="#modal-release-doc" class="btn btn-sm btn-info release_doc mb-1"><i class="fa fa-file-export white"></i></button></span>
        <span data-toggle="tooltip" data-placement="right" title="Mark as accomplished">
            <a href="#" class="btn btn-sm btn-success mb-1"
            data-tracking='.$d.'
            data-refer="/dashboard/?documents"
            data-manipulate="accomplish"
            data-toggle="modal" 
            data-target="#complete-doc"><i class="fa fa-check"></i></a>
        </span>
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