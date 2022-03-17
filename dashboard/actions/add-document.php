<?php
require_once("../../config.php");

function insert($title, $desc, $type, $purpose, $owner, $tracking)
{
    $query = "INSERT INTO documents(document_title, document_desc, document_type, document_purpose, document_owner, document_tracking) "; 
    $query .= "VALUES('{$title}', '{$desc}', '{$type}', '{$purpose}', '{$owner}', '{$tracking}')";
    $insert = query($query);
    confirm($insert);
}

if(isset($_POST['add-document']))
{
    $title   = $_POST['doc-title'];
    $desc    = $_POST['doc-desc'];
    $type    = $_POST['doc-type'];
    $purpose = $_POST['doc-remarks'];
    $owner   = $_SESSION['unit'];

    $date       = date("ynj-");
    $identifier = random_num(6);
    $tracking   = strtoupper($date . $identifier);

    // check if tracking # exists
    $check = query("SELECT * FROM documents WHERE document_tracking = '{$tracking}'");
    confirm($check);

    if(row_count($check) == 0)
    {
        insert($title, $desc, $type, $purpose, $owner, $tracking);
        set_message_alert("alert-success", "fa-check", "Document added! Tracking # is: <strong>" . $tracking . "</strong>");
        redirect("../?reports");
    }
    else
    {
        $identifier = random_num(6);
        $tracking   = strtoupper($date . $identifier);
        insert($title, $desc, $type, $purpose, $owner, $tracking);
        set_message_alert("alert-success", "fa-check", "Document added! Tracking # is: <strong>" . $tracking . "</strong>");
        redirect("../?reports");

    }
}

?>