<?php
require_once("../../config.php");

if(isset($_POST))
{
    $getCount = query("SELECT COUNT(*) AS lastcount FROM doctypes");
    confirm($getCount);

    $row = fetch_assoc($getCount);
    $doc_id = $row['lastcount'] + 201;
    $doctype = escape_string($_POST['doc-type']);
    $referer = escape_string($_POST['referer']);

    $insert = query("INSERT INTO doctypes(doc_id, doc_type) VALUES('{$doc_id}', '{$doctype}')");
    confirm($insert);

    set_message_alert("alert-success", "fa-check", "Document Type Added.");
    redirect($referer);
}

?>