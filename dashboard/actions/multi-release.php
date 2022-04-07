<?php
require_once("../../config.php");

if(isset($_POST['rel-check']))
{
    foreach($_POST['rel-check'] AS $tracking)
    {
        $unit = $_SESSION['unit'];
        // $by = $_SESSION['unit'];
        $to = $_POST['to'];
        release($tracking, $to);
        echo "release(".$tracking.", ".$unit.", ".$to.");<br>";
    }
    set_message_alert("alert-success", "fa-check", "Documents released to " . get_unit_name($to));
    // redirect("../?documents");
    redirect($_SERVER['HTTP_REFERER']);
}
else
{
    set_message_alert("alert-warning", "fa-exclamation", "No document selected.");
    // redirect("../?documents");
    redirect($_SERVER['HTTP_REFERER']);
}

?>