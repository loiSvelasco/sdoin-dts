<?php
require_once("../../config.php");

function insert($title, $desc, $type, $purpose, $origin, $owner, $tracking)
{
    $date = date('Y-m-d H:i:s');
    $insert = query(
        "INSERT INTO documents(document_title, 
                               document_desc, 
                               document_type, 
                               document_purpose, 
                               document_origin, 
                               document_owner, 
                               document_tracking, 
                               date_created)
         VALUES(
            '{$title}', 
            '{$desc}', 
            '{$type}', 
            '{$purpose}', 
            '{$origin}', 
            '{$owner}', 
            '{$tracking}', 
            '{$date}'
            )"
    );
    confirm($insert);
}

if(isset($_POST['add-document']))
{
    $title   = escape_string($_POST['doc-title']);
    $type    = $_POST['doc-type'];
    $to      = $_POST['doc-to'];
    $refer   = $_POST['referer'];
    
    $owner   = escape_string($_POST['owner']);
    $origin  = escape_string($_POST['origin']);

    $desc    = (trim(escape_string($_POST['doc-desc'])) == "") ? "N/A" : escape_string($_POST['doc-desc']);
    $purpose = (trim(escape_string($_POST['doc-remarks'])) == "") ? "N/A" : escape_string($_POST['doc-remarks']);
    
    $date       = date("njy-");
    $identifier = random_num(6);
    $tracking   = strtoupper($date . $identifier);

    if(trim($title) == '')
        die(redirect('../?err=8'));

    if( ! isset($_SESSION['user']))
    {
        set_message_alert(
            "alert-warning",
            "fa-exclamation",
            "Adding a document while logged out is not allowed. Log-in and try again."
        );
        redirect("../../../?login");
        die();
    }
    else
    {
        // check if tracking # exists
        $check = query("SELECT * FROM documents WHERE document_tracking = '{$tracking}'");
        confirm($check);

        if(row_count($check) == 0)
        {
            insert($title, $desc, $type, $purpose, $origin, $owner, $tracking);
            release($tracking, $to);
            set_message_alert(
                "alert-success", 
                "fa-check", 
                "
                Document added! 
                Tracking # is: &nbsp;&nbsp;&nbsp;<strong><a href='?print={$tracking}' target='_blank' class='text-decoration-none strong'
                data-toggle='tooltip' title='Print'>
                <i class='fas fa-print'></i>&nbsp;&nbsp;{$tracking}</a></strong>
                &nbsp;&nbsp;&nbsp;you can also right click and copy the image here &nbsp;&nbsp;&nbsp;
                <img src=\"data:image/png;base64," . base64_encode($generatorIMG->getBarcode($tracking, $generatorIMG::TYPE_CODE_128, 1, 20)) . "\">
                "
            );
            redirect($refer);
        }
        else
        {
            $identifier = random_num(6);
            $tracking   = strtoupper($date . $identifier);
            insert($title, $desc, $type, $purpose, $origin, $owner, $tracking);
            release($tracking, $to);
            set_message_alert(
                "alert-success", 
                "fa-check", 
                "
                Document added! 
                Tracking # is: &nbsp;&nbsp;&nbsp;<strong><a href='?print={$tracking}' target='_blank' class='text-decoration-none strong'
                data-toggle='tooltip' title='Print'>
                <i class='fas fa-print'></i>&nbsp;&nbsp;{$tracking}</a></strong>
                &nbsp;&nbsp;&nbsp;you can also right click and copy the image here &nbsp;&nbsp;&nbsp;
                <img src=\"data:image/png;base64," . base64_encode($generatorIMG->getBarcode($tracking, $generatorIMG::TYPE_CODE_128, 1, 20)) . "\">
                "
            );
            redirect($refer);

        }
    }

}

?>