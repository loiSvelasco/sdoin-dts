<?php

if(isset($_GET['manipulate']) && isset($_GET['tracking']))
{
    $action = escape_string($_GET['manipulate']);
    $tracking = escape_string($_GET['tracking']);
    $referer = escape_string($_GET['refer']);

    if($action == 'receive')
    {   
        $by = escape_string($_GET['by']);
        receive($tracking);
        set_message_alert("alert-success", "fa-check", "Document received.");
        redirect($referer);
    }
    if($action == 'release')
    {
        dd($_GET);
        $for = 0;
        if(isset($_GET['toPersonnel']))
        {
            $to = $_SESSION['unit'];
            $for = escape_string($_GET['toPersonnel']);
        }
        else
        {
            $to = escape_string($_GET['to']);
        }
        $remarks = escape_string($_GET['rel-remarks']);
        release($tracking, $to, $remarks, $for);
        $to_name = get_unit_name($to);
        set_message_alert("alert-success", "fa-check", "Document released to " . $to_name);
        redirect($referer);
    }
    if($action == 'accomplish')
    {
        // dd($_GET);
        $remarks = escape_string($_GET['accomp-remarks']);
        accomplish($tracking, $remarks);
        set_message_alert("alert-success", "fa-check", "Document accomplished.");
        redirect($referer);
    }
    if($action == 'purge')
    {
        purge($tracking);
        set_message_alert("alert-success", "fa-check", "Document purged.");
        redirect($referer);
    }
}

?>