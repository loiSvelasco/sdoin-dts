<?php
require_once("../../config.php");

if(isset($_POST['to']))
{
    $to = escape_string($_POST['to']);
    $tracking = escape_string($_POST['tracking']);
    $referer = escape_string($_POST['referer']);

    if(get_doc_current_location($tracking) != $to)
    {
        $checkReceive = query(
            "SELECT * FROM docs_location 
             WHERE dl_tracking = '{$tracking}' 
             ORDER BY dl_id DESC LIMIT 1"
        );

        $row = fetch_array($checkReceive);

        if($row['dl_receivedby'] == 0)
        {
            $updateLoc = query(
                "UPDATE docs_location 
                 SET dl_unit = $to 
                 WHERE dl_tracking = '{$tracking}' 
                 ORDER BY dl_id DESC LIMIT 1"
            );
            confirm($updateLoc);
            set_message_alert("alert-success", "fa fa-check", "Successfully forwarded to " . get_unit_name($to));
        }
        else
        {
            $received = get_unit_name($row['dl_unit']);
            set_message_alert("alert-warning", "fa fa-exclamation", "You cannot edit the location when the document is already received by " . $received . ".");
        }

    }
    else
    {
        set_message_alert("alert-info", "fa fa-info", "No changes were made.");
    }

    redirect($referer);

}

?>