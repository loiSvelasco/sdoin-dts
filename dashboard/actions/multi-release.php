<?php
require_once("../../config.php");

$referer = escape_string($_GET['refer']);

if(isset($_POST['rel-check']))
{
    $remarks = isset($_POST['rel-remarks']) ? escape_string($_POST['rel-remarks']) : "";
    $for = 0;

    if(isset($_POST['forPersonnelMulti']))
    {
        $for = escape_string($_POST['toPersonnelMulti']);
        $to = $_SESSION['unit'];
    }
    else
    {
        $to = $_POST['to'];
    }
    foreach($_POST['rel-check'] AS $tracking)
    {
        release($tracking, $to, $remarks, $for);
    }
    set_message_alert("alert-success", "fa-check", "Documents released to " . get_unit_name($to));
    redirect($referer);
}
else
{
    set_message_alert("alert-warning", "fa-exclamation", "No document selected.");
    redirect($referer);
}

?>