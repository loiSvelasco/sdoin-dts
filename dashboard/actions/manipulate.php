<?php

if(isset($_GET['manipulate']) && isset($_GET['tracking']) && isset($_GET['unit']))
{
    $action = escape_string($_GET['manipulate']);
    $tracking = escape_string($_GET['tracking']);
    $unit = escape_string($_GET['unit']);

    if($action == 'receive')
    {   
        $by = escape_string($_GET['by']);
        receive($tracking, $unit, $by);
        set_message_alert("alert-success", "fa-check", "Document received.");
        redirect("?documents");
    }
    if($action == 'release')
    {
        $to = escape_string($_GET['to']);
        $by = $unit;
        release($tracking, $unit, $to);
        $to_name = get_unit_name($to);
        set_message_alert("alert-success", "fa-check", "Document released to " . $to_name);
        redirect("?documents");
    }
    if($action == 'accomplish')
    {

    }
}

?>