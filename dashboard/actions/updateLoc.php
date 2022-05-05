<?php
require_once("../../config.php");

if(isset($_POST['to']))
{
    $to = escape_string($_POST['to']);
    $tracking = escape_string($_POST['tracking']);
    $referer = escape_string($_POST['referer']);

    if(get_doc_current_location($tracking) != $to)
    {
        $updateLoc = query("UPDATE docs_location SET dl_unit = " . $to . " WHERE dl_tracking = '{$tracking}' ORDER BY dl_id DESC LIMIT 1");
        confirm($updateLoc);
        set_message_alert("alert-success", "fa fa-check", "Successfully forwarded to " . get_unit_name($to));
    }
    else
    {
        set_message_alert("alert-info", "fa fa-info", "No changes were made.");
    }

    redirect($referer);

}

?>