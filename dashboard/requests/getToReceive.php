<?php

require_once("../../config.php");
$table = <<<LALAQT
    (
    SELECT
        documents.id,
        documents.document_tracking,
        documents.document_accomplished,
        documents.document_title,
        docs_location.dl_tracking,
        docs_location.dl_receivedby,
        docs_location.dl_for,
        docs_location.dl_releaseddate
    FROM documents
        JOIN docs_location ON documents.document_tracking = docs_location.dl_tracking
    WHERE docs_location.dl_unit = {$_SESSION['unit']}
    AND docs_location.dl_receivedby = 0
    AND documents.document_accomplished = 0
    AND
        (
            (docs_location.dl_for = 0)
            OR
            (docs_location.dl_for = {$_SESSION['user_id']})
        )
    ORDER BY docs_location.dl_releaseddate ASC
    ) temp
LALAQT;

$whereAll = "";
$primaryKey = 'id';
 
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
        global $receivable;
        return $receivable = ($d == $_SESSION['user_id'] ? "yes" : ($d == 0 ? "possible" : "no"));
     }],

    ['db' => 'document_tracking', 'dt' => 3,
     'formatter' => function($d, $row) {
        global $receivable;
        $dot = '';
        if($receivable == "yes") {
            $dot = '<small><span class="badge badge-pill badge-danger">&ensp;</span></small>&nbsp;';
        }
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
                '. $dot . " " . get_document_detail($d, 'document_title').'
                <strong class="small text-muted"> | '.get_doctype_name(get_document_detail($d, 'document_type')).'</strong></a>
        ';
     }],

    ['db' => 'document_tracking', 'dt' => 4, 
     'formatter' => function ($d, $row) {
        return '
        <a href="?manipulate=receive&tracking='.$d.'&refer=/dashboard/?documents" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="left" title="Receive"><i class="fa fa-file-import"></i></a>
        ';
     }]
];
 
$sql_details = array(
    'user' => DB_USER,
    'pass' => DB_PASS,
    'db'   => DB_NAME,
    'host' => DB_HOST
);
 
require( 'ssp.class.php' );
echo json_encode(
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, $whereAll )
);