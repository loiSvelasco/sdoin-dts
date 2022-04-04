<?php

require_once("../../config.php");

if(isset($_POST['submit']))
{
    // * upload details
    $title  = escape_string($_POST['doc_title']);
    $toUnit = escape_string($_POST['doc_unit']);
    $action = escape_string($_POST['doc_action']);
    $by     = $_SESSION['user_id'];
    $byUnit = $_SESSION['unit'];

    // * file manipulation
    $pname = $_SESSION['unit'].'-'.$_FILES['file']['name'];
    $tname = $_FILES['file']['tmp_name'];

    // * file upload
    $dir = '../uploads';
    $allowed = array('application/pdf');

    if(in_array($_FILES['file']['type'], $allowed))
    {
        if($_FILES['file']['size'] < 10000000)
        {
            move_uploaded_file($tname, $dir.'/'.$pname);
            set_message_alert("alert-success", "fa-check", "File successfully uploaded!");

            // * insert to db if successful
            $stmt = "INSERT INTO uploads(up_filename, up_title, up_action, up_receivingunit, up_by, up_unit)";
            $stmt .= "VALUES('{$pname}', '{$title}', '{$action}', '{$toUnit}', '{$by}', '{$byUnit}')";
            $babyella = query($stmt);
            confirm($babyella);
        }
        else
        {
            set_message_alert("alert-warning", "fa-exclamation", "File size exceeds 10MB.");
        }
    }
    else
    {
        set_message_alert("alert-warning", "fa-exclamation", "File type not allowed.");
    }
    redirect("../?upload");
}

?>