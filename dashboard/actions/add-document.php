<?php
require_once("../../config.php");

function insert($title, $desc, $type, $purpose, $origin, $tracking)
{
    $owner = $_SESSION['user_id'];
    $date = date('Y-m-d H:i:s');
    $query = "INSERT INTO documents(document_title, document_desc, document_type, document_purpose, document_origin, document_owner, document_tracking, date_created) "; 
    $query .= "VALUES('{$title}', '{$desc}', '{$type}', '{$purpose}', '{$origin}','{$owner}', '{$tracking}', '{$date}')";
    $insert = query($query);
    confirm($insert);
}

if(isset($_POST['add-document']))
{
    $title   = escape_string($_POST['doc-title']);
    $type    = $_POST['doc-type'];
    $to      = $_POST['doc-to'];
    $refer   = $_POST['referer'];
    $origin  = $_SESSION['unit'];

    $desc    = (trim(escape_string($_POST['doc-desc'])) == "") ? "N/A" : $_POST['doc-desc'];
    $purpose = (trim(escape_string($_POST['doc-remarks'])) == "") ? "N/A" : $_POST['doc-remarks'];
    
    $date       = date("njy-");
    $identifier = random_num(6);
    $tracking   = strtoupper($date . $identifier);

    // check if tracking # exists
    $check = query("SELECT * FROM documents WHERE document_tracking = '{$tracking}'");
    confirm($check);

    if(row_count($check) == 0)
    {
        insert($title, $desc, $type, $purpose, $origin, $tracking);
        release($tracking, $to);
        set_message_alert("alert-success", "fa-check", "Document added! Tracking # is: <strong><a href='?print={$tracking}' target='_blank' class='text-decoration-none btn btn-success' data-toggle='tooltip' data-placement='right' title='Print'><i class='fas fa-print'></i>&nbsp;&nbsp;&nbsp;" . $tracking . "</a></strong>");
        redirect($refer);
    }
    else
    {
        $identifier = random_num(6);
        $tracking   = strtoupper($date . $identifier);
        insert($title, $desc, $type, $purpose, $origin, $tracking);
        release($tracking, $to);
        set_message_alert("alert-success", "fa-check", "Document added! Tracking # is: <strong><a href='?print={$tracking}' target='_blank' class='text-decoration-none btn btn-success' data-toggle='tooltip' data-placement='right' title='Print'><i class='fas fa-print'></i>&nbsp;&nbsp;&nbsp;" . $tracking . "</a></strong>");
        redirect($refer);

    }
}

?>