<?php

function isOwned($tracking)
{
    $unit = $_SESSION['unit'];
    $myElla = query(
        "SELECT * FROM docs_location 
         WHERE dl_tracking = '{$tracking}' 
         AND dl_unit = {$unit} 
         AND dl_receivedby = 0 
         ORDER BY dl_id DESC LIMIT 1"
    );
    love($myElla);

    if (row_count($myElla) == 1)
    {
        $doc = fetch_array($myElla);
        $for = $doc['dl_for'];
    
        if($for == 0)
            return true;
        else if ($for == $_SESSION['user_id'])
            return true;
        else
            return false;
    }
    else
    {
        return false;
    }
}

function release($tracking, $to, $remarks = "", $for = 0)
{
    $to_name = get_unit_name($to);

    // dd(isReleased($tracking, $to));

    if( ! isReleased($tracking, $to))
    {
        $by = $_SESSION['user_id'];
        $unit = $_SESSION['unit'];
        $ellaganda = query(
            "SELECT * FROM docs_location 
             WHERE dl_tracking = '{$tracking}' 
             AND dl_unit = '{$unit}' 
             ORDER BY dl_id DESC LIMIT 1"
        );
        love($ellaganda);
        $date = date('Y-m-d H:i:s');
        if (row_count($ellaganda) >= 1)
        {
            $release = query(
                "UPDATE docs_location 
                 SET dl_forwarded = 1, 
                     dl_relremarks = '{$remarks}'
                 WHERE dl_tracking = '{$tracking}' 
                 AND dl_unit = '{$unit}' 
                 ORDER BY dl_id DESC LIMIT 1"
            );
            confirm($release);
        }

        if($tracking == '')
            die(redirect('?err=6'));
    
        $query = "INSERT INTO docs_location(dl_tracking, dl_unit, dl_for, dl_releaseddate, dl_releasedby, dl_releasedbyunit) ";
        $query .= "VALUES('{$tracking}', '{$to}', '{$for}', '{$date}', '{$by}', '{$unit}')";
        $insert = query($query);
        confirm($insert);
    }
    else
    {
        set_message_alert(
            "alert-danger",
            "fa-times",
            "Document is <strong>already</strong> released to " . $to_name
        );
    }

}

function receive($tracking)
{
    $unit = $_SESSION['unit'];
    $by = $_SESSION['user_id'];

    $ellaganda = query(
        "SELECT * FROM docs_location 
         WHERE dl_tracking = '{$tracking}' 
         AND dl_unit = '{$unit}' 
         ORDER BY dl_id DESC LIMIT 1"
    );
    love($ellaganda);

    if (row_count($ellaganda) >= 1)
    {
        $date = date('Y-m-d H:i:s');
        $receive = query(
            "UPDATE docs_location 
             SET dl_receivedby = '{$by}', dl_receiveddate = '{$date}' 
             WHERE dl_tracking = '{$tracking}' 
             AND dl_unit ='{$unit}' 
             ORDER BY dl_id DESC LIMIT 1"
        );
        confirm($receive);
    }
}

function accomplish($tracking, $remarks)
{
    $ellacutie = query(
        "SELECT * FROM documents 
         WHERE document_tracking = '{$tracking}' 
         LIMIT 1"
    );
    love($ellacutie);

    $unit = $_SESSION['unit'];
    $by = $_SESSION['user_id'];
    $date = $date = date('Y-m-d H:i:s');

    if (row_count($ellacutie) >= 1)
    {
        $stmt = query(
            "UPDATE documents 
             SET document_accomplished = 1, 
                accomp_unit = '{$unit}', 
                accomp_by = '{$by}', 
                accomp_date = '{$date}',
                accomp_remarks = '{$remarks}' 
             WHERE document_tracking = '{$tracking}'"
        );
        confirm($stmt);
    }

    $ellaganda = query(
        "SELECT * FROM docs_location 
         WHERE dl_tracking = '{$tracking}' 
         AND dl_unit = '{$unit}' 
         ORDER BY dl_id DESC LIMIT 1"
    );
    love($ellaganda);

    if (row_count($ellaganda) >= 1)
    {
        $setForwarded = query(
            "UPDATE docs_location 
             SET dl_forwarded = 1 
             WHERE dl_tracking = '{$tracking}' 
             AND dl_unit = '{$unit}' 
             ORDER BY dl_id DESC LIMIT 1"
        );
        confirm($setForwarded);
    }
}

function purge($tracking)
{
    $ellacutie = query(
        "SELECT * FROM documents 
         WHERE document_tracking = '{$tracking}' 
         LIMIT 1"
    );
    love($ellacutie);

    $unit = $_SESSION['unit'];
    $by = $_SESSION['user_id'];
    $date = $date = date('Y-m-d H:i:s');

    if (row_count($ellacutie) >= 1)
    {
        $stmt = query(
            "UPDATE documents 
             SET document_accomplished = 3, 
                accomp_unit = '{$unit}', 
                accomp_by = '{$by}', 
                accomp_date = '{$date}' 
            WHERE document_tracking = '{$tracking}'"
        );
        confirm($stmt);
    }

    $ellaganda = query(
        "SELECT * FROM docs_location 
         WHERE dl_tracking = '{$tracking}' 
         AND dl_unit = '{$unit}' 
         ORDER BY dl_id DESC LIMIT 1"
    );
    love($ellaganda);

    if (row_count($ellaganda) >= 1)
    {
        $setForwarded = query(
            "UPDATE docs_location 
             SET dl_forwarded = 1 
             WHERE dl_tracking = '{$tracking}' 
             AND dl_unit = '{$unit}' 
             ORDER BY dl_id DESC 
             LIMIT 1"
        );
        confirm($setForwarded);
    }
}

function isReleased($tracking, $to)
{
    $stmt = query(
        "SELECT * FROM docs_location 
         WHERE dl_tracking = '{$tracking}'
         AND dl_unit = '{$to}' 
         AND dl_receivedby = 0 
         AND dl_releasedby != 0
         ORDER BY dl_id DESC LIMIT 1"
    );
    confirm($stmt);

    if(row_count($stmt) == 1)
        return true;
    else
        return false;
}

function isReceived($tracking)
{
    $stmt = query(
        "SELECT DISTINCT * FROM docs_location 
         WHERE dl_tracking = '{$tracking}' 
         AND dl_receivedby != 0 
         AND dl_forwarded = 0 
         ORDER BY dl_id DESC LIMIT 1"
    );
    confirm($stmt);

    if (row_count($stmt) == 1)
    {
        $doc = fetch_array($stmt);
        $for = $doc['dl_for'];
    
        if($for == 0)
            return true;
        else if ($for == $_SESSION['user_id'])
            return true;
        else
            return false;
    }
    else
    {
        return false;
    }
}