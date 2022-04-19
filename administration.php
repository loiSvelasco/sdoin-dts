<?php

function allReceived($today, $start = 0, $end = 0)
{
    if($today == true)
    {
        $prettyella = query("SELECT * FROM docs_location WHERE DATE(dl_receiveddate) = CURDATE() ORDER BY dl_id DESC");
        confirm($prettyella);
    }
    else
    {
        $prettyella = query("SELECT * FROM docs_location WHERE DATE(dl_receiveddate) BETWEEN '{$start}' AND '{$end}' ORDER BY dl_id DESC");
        confirm($prettyella);
    }
    while($row = fetch_array($prettyella))
    {
        $tracking = $row['dl_tracking'];
        $title = get_document_detail($tracking, 'document_title');
        $purpose = get_document_detail($tracking, 'document_purpose');
        $doctype = get_doctype_name(get_document_detail($tracking, 'document_type'));
        $date = format_date(get_document_detail($tracking, 'date_created'));

        $receivedBy = get_user_name($row['dl_receivedby']);

        $ellacutie = <<<ELLA
        <tr>
            <td class="align-middle">
            <a href="?tracking={$tracking}" target="_blank" data-toggle="tooltip" data-placement="top" title="Track"><i class="fa fa-search"></i></a>&nbsp;&nbsp;
            <a href="?print={$tracking}" target="_blank" data-toggle="tooltip" data-placement="top" title="Print Tracking no."><i class="fa fa-print"></i></a>&nbsp;&nbsp;
                {$tracking}
            </td>
            <td class="align-middle">{$title}</td>
            <td class="align-middle">{$purpose}</td>
            <td class="align-middle">{$doctype}</td>
            <td class="align-middle">{$date}</td>
            <td class="align-middle">{$receivedBy}</td>
        </tr>
ELLA;
        echo $ellacutie;
    }
}

function allReleased($today, $start = 0, $end = 0)
{
    if($today == true)
    {
        $unit = $_SESSION['unit'];
        $prettyella = query("SELECT * FROM docs_location WHERE DATE(dl_releaseddate) = CURDATE() ORDER BY dl_id DESC");
        confirm($prettyella);
    }
    else
    {
        $unit = $_SESSION['unit'];
        $prettyella = query("SELECT * FROM docs_location WHERE DATE(dl_releaseddate) BETWEEN '{$start}' AND '{$end}' ORDER BY dl_id DESC");
        confirm($prettyella);
    }
    while($row = fetch_array($prettyella))
    {
        $tracking = $row['dl_tracking'];
        $title = get_document_detail($tracking, 'document_title');
        $purpose = get_document_detail($tracking, 'document_purpose');
        $doctype = get_doctype_name(get_document_detail($tracking, 'document_type'));
        $date = format_date(get_document_detail($tracking, 'date_created'));

        $releasedBy = get_user_name($row['dl_releasedby']);

        $ellacutie = <<<ELLA
        <tr>
            <td class="align-middle">
            <a href="?tracking={$tracking}" target="_blank" data-toggle="tooltip" data-placement="top" title="Track"><i class="fa fa-search"></i></a>&nbsp;&nbsp;
            <a href="?print={$tracking}" target="_blank" data-toggle="tooltip" data-placement="top" title="Print Tracking no."><i class="fa fa-print"></i></a>&nbsp;&nbsp;
                {$tracking}
            </td>
            <td class="align-middle">{$title}</td>
            <td class="align-middle">{$purpose}</td>
            <td class="align-middle">{$doctype}</td>
            <td class="align-middle">{$date}</td>
            <td class="align-middle">{$releasedBy}</td>
        </tr>
ELLA;
        echo $ellacutie;
    }
}

?>