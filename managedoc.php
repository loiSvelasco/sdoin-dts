<?php

function release($tracking, $to)
{
    $unit = $_SESSION['unit'];
    $ellaganda = query("SELECT * FROM docs_location WHERE dl_tracking = '{$tracking}' AND dl_unit = '{$unit}' ORDER BY dl_id DESC LIMIT 1");
    confirm($ellaganda);
    $by = $_SESSION['user_id'];
    $byUnit = $_SESSION['unit'];
    if(row_count($ellaganda) >= 1)
    {
        $receive = query("UPDATE docs_location SET dl_forwarded = 1, dl_releasedby = {$by} WHERE dl_tracking = '{$tracking}' AND dl_unit = '{$unit}'");
        confirm($receive);
    }

    $query = "INSERT INTO docs_location(dl_tracking, dl_unit, dl_releasedby, dl_releasedbyunit) "; 
    $query .= "VALUES('{$tracking}', '{$to}', '{$by}', '{$byUnit}')";
    $insert = query($query);
    confirm($insert);
}

function receive($tracking)
{
    $unit = $_SESSION['unit'];
    $by = $_SESSION['user_id'];

    $ellaganda = query("SELECT * FROM docs_location WHERE dl_tracking = '{$tracking}' AND dl_unit = '{$unit}' ORDER BY dl_id DESC LIMIT 1");
    confirm($ellaganda);

    if(row_count($ellaganda) >= 1)
    {
        $date = date('Y-m-d H:i:s');
        $receive = query("UPDATE docs_location SET dl_receivedby = '{$by}', dl_receiveddate = '{$date}' WHERE dl_tracking = '{$tracking}' AND dl_unit ='{$unit}' ORDER BY dl_id DESC LIMIT 1");
        confirm($receive);
    }
}

function accomplish($tracking)
{
    $ellacutie = query("SELECT * FROM documents WHERE document_tracking = '{$tracking}' LIMIT 1");
    love($ellacutie);

    $unit = $_SESSION['unit'];
    $by = $_SESSION['user_id'];
    $date = $date = date('Y-m-d H:i:s');

    if(row_count($ellacutie) >= 1)
    {
        $stmt = query("UPDATE documents SET document_accomplished = 1, accomp_unit = '{$unit}', accomp_by = '{$by}', accomp_date = '{$date}' WHERE document_tracking = '{$tracking}'");
        confirm($stmt);
    }
}

?>