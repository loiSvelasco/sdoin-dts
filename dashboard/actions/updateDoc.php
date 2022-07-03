<?php
require_once("../../config.php");

if(isset($_POST))
{
    $empty = false;

    foreach($_POST as $key => $val)
    {
        if(filter_has_var(INPUT_POST, $key))
        {
            if($val == "")
            {
                $empty = true;
            }
        }
    }

    $title = escape_string($_POST['title']);
    $desc = escape_string($_POST['desc']);
    $purpose = escape_string($_POST['purpose']);
    $doctype = escape_string($_POST['doctype']);
    $referer = escape_string($_POST['referer']);
    $tracking = escape_string($_POST['tracking']);
    
    if( ! $empty)
    {

        $updateLoc = query(
            "UPDATE documents 
             SET document_title = '{$title}',
                 document_desc = '{$desc}',
                 document_purpose = '{$purpose}',
                 document_type = '{$doctype}'
             WHERE document_tracking = '{$tracking}' ORDER BY id DESC LIMIT 1"
        );

        confirm($updateLoc);
        set_message_alert("alert-success", "fa fa-check", "Successfully updated document. ");
    }
    else
    {
        set_message_alert("alert-danger", "fa fa-times", "Please fill out all fields.");
    }

    redirect($referer);

}

?>