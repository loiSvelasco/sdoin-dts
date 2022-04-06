<?php

// if(isset($_GET['manipulate']) && isset($_GET['tracking']) && isset($_GET['unit']))
if(isset($_GET['manipulate']) && isset($_GET['tracking']))
{
    $action = escape_string($_GET['manipulate']);
    $tracking = escape_string($_GET['tracking']);

    if($action == 'receive')
    {   
        $by = escape_string($_GET['by']);
        // receive($tracking, $unit, $by);
        receive($tracking);
        set_message_alert("alert-success", "fa-check", "Document received.");
        // redirect("?documents");
        redirect($_SERVER['HTTP_REFERER']);
    }
    if($action == 'release')
    {
        $to = escape_string($_GET['to']);
        // $by = $_SESSION['unit'];
        release($tracking, $to);
        $to_name = get_unit_name($to);
        set_message_alert("alert-success", "fa-check", "Document released to " . $to_name);
        // redirect("?documents");
        redirect($_SERVER['HTTP_REFERER']);
    }
    if($action == 'accomplish')
    {
        accomplish($tracking, $unit);
        set_message_alert("alert-success", "fa-check", "Document accomplished.");
        redirect($_SERVER['HTTP_REFERER']);
    }
}

?>