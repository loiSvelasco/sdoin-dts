<?php
require_once("../../config.php");

if(isset($_POST['rel-selected']))
{
    if(isset($_POST['rel-check']))
    {
        foreach($_POST['rec-check'] AS $tracking)
        {
            $unit = $_SESSION['unit'];
            // $by = $_SESSION['user_id'];
            // receive($tracking, $unit, $by);
            echo "release(".$tracking.", ".$unit.", ".$by.");";
        }
        // set_message_alert("alert-success", "fa-check", "Document received.");
        // redirect("../?documents");
    }
    else
    {
        // set_message_alert("alert-warning", "fa-exclamation", "No document selected.");
        // redirect("../?documents");
    }
}

?>