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
        $for = 0;
        if(isset($_GET['toPersonnel']))
        {
            $to = $_SESSION['unit'];
            $for = escape_string($_GET['toPersonnel']);
            $to_name = get_user_name($for) . ", " . get_unit_name($to);
        }
        else
        {
            $to = escape_string($_GET['to']);
            $to_name = get_unit_name($to);
        }
        $remarks = escape_string($_GET['rel-remarks']);
        release($tracking, $to, $remarks, $for);
        set_message_alert("alert-success", "fa-check", "Document released to " . $to_name);
        redirect($referer);
    }
    if($action == 'accomplish')
    {
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