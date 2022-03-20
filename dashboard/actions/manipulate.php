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

    }
    if($action == 'accomplish')
    {

    }
}
// function release($tracking, $to)
// function receive($tracking, $unit, $by)
?>