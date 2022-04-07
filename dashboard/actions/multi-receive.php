<?php
require_once("../../config.php");

if(isset($_POST['rec-selected']))
{
    if(isset($_POST['rec-check']))
    {
        foreach($_POST['rec-check'] AS $tracking)
        {
            receive($tracking);
        }
        set_message_alert("alert-success", "fa-check", "Document received.");
        redirect("../?documents");
    }
    else
    {
        set_message_alert("alert-warning", "fa-exclamation", "No document selected.");
        redirect("../?documents");
    }
}

?>