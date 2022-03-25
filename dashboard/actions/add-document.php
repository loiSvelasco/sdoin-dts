<?php
require_once("../../config.php");

function insert($title, $desc, $type, $purpose, $origin, $owner, $tracking)
{
    $query = "INSERT INTO documents(document_title, document_desc, document_type, document_purpose, document_origin, document_owner, document_tracking) "; 
    $query .= "VALUES('{$title}', '{$desc}', '{$type}', '{$purpose}', '{$origin}','{$owner}', '{$tracking}')";
    $insert = query($query);
    confirm($insert);
}

if(isset($_POST['add-document']))
{
    $title   = $_POST['doc-title'];
    $desc    = $_POST['doc-desc'];
    $type    = $_POST['doc-type'];
    $purpose = $_POST['doc-remarks'];
    $to      = $_POST['doc-to'];
    $origin  = $_SESSION['unit'];
    $owner   = $_SESSION['user_id'];

    $date       = date("njy-");
    $identifier = random_num(6);
    $tracking   = strtoupper($date . $identifier);

    // check if tracking # exists
    $check = query("SELECT * FROM documents WHERE document_tracking = '{$tracking}'");
    confirm($check);

    if(row_count($check) == 0)
    {
        insert($title, $desc, $type, $purpose, $origin, $owner, $tracking);
        release($tracking, $origin, $to);
        set_message_alert("alert-success", "fa-check", "Document added! Tracking # is: <strong><a href='?print={$tracking}' target='_blank' class='text-decoration-none btn btn-success' data-toggle='tooltip' data-placement='right' title='Print'><i class='fas fa-print'></i>&nbsp;&nbsp;&nbsp;" . $tracking . "</a></strong>");
        redirect($_SERVER['HTTP_REFERER']);
    }
    else
    {
        $identifier = random_num(6);
        $tracking   = strtoupper($date . $identifier);
        insert($title, $desc, $type, $purpose, $origin, $owner, $tracking);
        release($tracking, $origin, $to);
        set_message_alert("alert-success", "fa-check", "Document added! Tracking # is: <strong>" . $tracking . "</strong>");
        redirect($_SERVER['HTTP_REFERER']);

    }
}

?>