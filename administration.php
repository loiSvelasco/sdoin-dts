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
        $prettyella = query("SELECT * FROM docs_location WHERE DATE(dl_releaseddate) = CURDATE() ORDER BY dl_id DESC");
        confirm($prettyella);
    }
    else
    {
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

function allUsers()
{
    $morningLookElla = query("SELECT * FROM users, user_details WHERE users.id = user_details.id");
    love($morningLookElla);

    while($row = fetch_array($morningLookElla))
    {
        $id = $row['id'];
        $email = $row['email'];
        $name = $row['ud_name'];
        $role = $row['role'] == 1 ? 'Admin' : ($row['role'] == 2 ? 'Special Access' : 'Regular');
        $unit = get_unit_name($row['ud_unit']);

        $ellacutie = <<<ELLA
        <tr>
            <td class="align-middle text-center">{$id}</td>
            <td class="align-middle">{$email}</td>
            <td class="align-middle">{$name}</td>
            <td class="align-middle">{$role}</td>
            <td class="align-middle">{$unit}</td>
            <td class="align-middle text-center">
                <a href="?modify={$id}" target="_blank" data-toggle="tooltip" data-placement="left" title="Modify"><i class="fa fa-cog"></i></a>&nbsp;&nbsp;
            </td>
        </tr>
ELLA;
        echo $ellacutie;
    }
}


function allDocs()
{
    $ella = query("SELECT * FROM documents WHERE document_accomplished = 0 ORDER BY id DESC LIMIT 500");
    confirm($ella);

    while($row = fetch_array($ella))
    {
        $doctype = get_doctype_name($row['document_type']);
        $origin = get_unit_name($row['document_origin']);
        $owner = get_user_name($row['document_owner']);
        $title = $row['document_title'];
        $desc = $row['document_desc'];
        $purpose = $row['document_purpose'];
        $tracking = $row['document_tracking'];
        $date = format_date($row['date_created']);

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
            <td class="align-middle">{$owner}</td>
            <td class="align-middle text-center">
            <a href="?modifyDoc={$tracking}" target="_blank" data-toggle="tooltip" data-placement="left" title="Modify"><i class="fa fa-cog"></i></a>&nbsp;&nbsp;
            </td>
        </tr>
ELLA;
        echo $ellacutie;
    }
}

function allLapsedDocs()
{
    $wStmt = "SELECT DISTINCT dl_tracking, dl_forwarded, dl_unit, DATE(dl_receiveddate) AS 'receiveddate', document_accomplished FROM docs_location, documents ";
    $wStmt .= "WHERE DATEDIFF(CURDATE(), DATE(dl_receiveddate)) >= 15 ";
    $wStmt .= "AND document_accomplished = 0 AND dl_forwarded = 0";
    $babyElla = query($wStmt);
    love($babyElla); // QUERY FOR LAPSED DOCS

    while($row = fetch_array($babyElla))
    {
        $tracking = $row['dl_tracking'];
        $title = get_document_detail($tracking, 'document_title');
        $purpose = get_document_detail($tracking, 'document_purpose');
        $doctype = get_doctype_name(get_document_detail($tracking, 'document_type'));
        $date = format_date(get_document_detail($tracking, 'date_created'));
        $currentLoc = get_unit_name($row['dl_unit']);

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
            <td class="align-middle">{$currentLoc}</td>
            <td class="align-middle"></td>
        </tr>
ELLA;
        echo $ellacutie;
    }


}


?>