<?php
require_once("../../config.php");

if(isset($_POST['scanrec']))
{
    $tracking = escape_string($_POST['tracking']);
    $unit = $_SESSION['unit'];
    $by = $_SESSION['user_id'];

    receive($tracking, $unit, $by);
    set_message_alert("alert-success", "fa-check", "Document received.");
    redirect("../?scanrec");
}

?>