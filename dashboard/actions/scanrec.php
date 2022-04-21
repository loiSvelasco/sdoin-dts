<?php
require_once("../../config.php");

if (isset($_POST['scanrec'])) {
    $tracking = escape_string($_POST['tracking']);
    if (isOwned($tracking))
    {
        receive($tracking);
        set_message_alert("alert-success", "fa-check", "Document received.");
    }
    else
    {
        set_message_alert("alert-warning", "fa-exclamation-triangle", "No document found, or document not currently in your unit.");
    }
    redirect("../?scanrec");
}
