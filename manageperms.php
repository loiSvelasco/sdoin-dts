<?php 

function isLapsed()
{
    // 117 - osds
    // 121 - records
    // 113 - ict
    // 101 - accounting
    // 119 - personnel
    // 105 - BAC
    // 114 - Legal
    $exempted = [117, 121, 113, 101, 119, 105, 114];
    if(in_array($_SESSION['unit'], $exempted))
    {
        return false; // always return false for these units to bypass permission blocking
    }

    $babyElla = query(
        "SELECT *, DATE(dl_receiveddate) AS 'receiveddate' 
         FROM docs_location WHERE dl_unit = '{$_SESSION['unit']}' 
         AND DATEDIFF(CURDATE(), 
         DATE(dl_receiveddate)) >= " . DOC_LAPSED_DAYS . " AND dl_forwarded = 0"
    );

    love($babyElla);

    $lapsedDocs = row_count($babyElla);
    if($lapsedDocs >= 1)
    {
        while($row = fetch_array($babyElla))
        {
            $tracking = $row['dl_tracking'];
            if(get_document_detail($tracking, 'document_accomplished') == 0) // check if document is accomplished.
            {
                return true;
            }
        }
    }
    return false;
}

function countDays($fromReceived)
{
    $bebiElla = query("SELECT DATEDIFF(CURDATE(), DATE('{$fromReceived}')) AS 'days'");
    love($bebiElla);

    $row = fetch_assoc($bebiElla);
    return $row['days'];
}

function checkWarning($col)
{
    $rStmt =
    "SELECT *, DATE(dl_receiveddate) AS 'receiveddate' 
     FROM docs_location WHERE {$col} = '{$_SESSION['unit']}' 
     AND DATEDIFF(CURDATE(), DATE(dl_receiveddate)) >= " . DOC_REMIND_DAYS . " 
     AND DATEDIFF(CURDATE(), DATE(dl_receiveddate)) < " . DOC_LAPSED_DAYS . " 
     AND dl_forwarded = 0
    ";

    return $rStmt;
}

function checkLapsed($col)
{
    $wStmt =
    "SELECT DISTINCT dl_tracking, dl_forwarded, 
     DATE(dl_receiveddate) AS 'receiveddate', document_accomplished 
     FROM docs_location, documents
     WHERE {$col} = '{$_SESSION['unit']}' 
     AND DATEDIFF(CURDATE(), DATE(dl_receiveddate)) >= " . DOC_LAPSED_DAYS . "
     AND document_accomplished = 0
     AND dl_forwarded = 0
    ";

    return $wStmt;
}

function issueNotice()
{
    if(isset($_SESSION['unit']))
    {
        $active = false;

        $warningQuery = checkWarning('dl_unit');
        $princessElla = query($warningQuery);
        love($princessElla);
        
        $lapsedQuery = checkLapsed('dl_unit');
        $babyElla = query($lapsedQuery);
        love($babyElla);
    
        if(row_count($princessElla) >= 1)
        {
            issueReminder($princessElla);
            $active = true;
        }
    
        if(row_count($babyElla) >= 1)
        {
            issueWarning($babyElla);
            $active = true;
        }

        $notifyQuery = checkLapsed('dl_releasedbyunit');
        $notifyExec = query($notifyQuery);
        confirm($notifyExec);

        if(row_count($notifyExec) >= 1)
        {
            notifyOwner($notifyExec);
        }
    }

    if($active)
    {
        echo "<div class='col-12'>
                <blockquote class='quote-info'>
                  <h5>Notice</h5>
                    <p>The system detected that you have documents unreleased 
                    for a long period of time. If it reaches " . DOC_LAPSED_DAYS . "
                    days, you will not be able to add or create documents 
                    unless you release or accomplish said documents.
                    This is to ensure that the documents reach their proper destination. 
                    This notice will persist until all concerned documents are released or accomplished.</p>
                </blockquote>
              </div>";
    }
}

function issueReminder($query)
{
    echo '<div class="col-lg-12">
    <blockquote class="quote-warning">
    <h5><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;Reminders</h5>';
    while($row = fetch_array($query))
    {
        $tracking = $row['dl_tracking'];
        $days = countDays($row['receiveddate']);
        $title = get_document_detail($tracking, 'document_title');
        $link = '?tracking=' . $tracking;
        $myLove = <<<ELLA
        Document <strong><a href="{$link}" target="_blank">#{$tracking}</a></strong> 
        titled <strong>{$title}</strong> has not been released for <strong>{$days}</strong> days.<br>
ELLA;
        echo $myLove;
    }
    echo '</div>
    </blockquote>';
}

function issueWarning($query)
{
    echo '<div class="col-lg-12">
    <blockquote class="quote-red">
    <h5><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;Warning</h5>';

    while($row = fetch_array($query))
    {
        $tracking = $row['dl_tracking'];
        $days = countDays($row['receiveddate']);
        $title = get_document_detail($tracking, 'document_title');
        $link = '?tracking=' . $tracking;

        $myLove = <<<ELLA
        Document <strong><a href="{$link}" target="_blank">#{$tracking}</a></strong> 
        titled <strong>{$title}</strong> has not been released for <strong>{$days}</strong> days.<br>
ELLA;
        echo $myLove;
    }

    echo '</div></blockquote>';
}

function notifyOwner($query)
{
    echo '<div class="col-lg-12">
    <blockquote class="quote-warning">
    <h5><i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp;Warning</h5>';

    while($row = fetch_array($query))
    {
        $tracking = $row['dl_tracking'];
        $days = countDays($row['receiveddate']);
        $title = get_document_detail($tracking, 'document_title');
        $link = '?tracking=' . $tracking;
        $currentLoc = get_unit_name(get_doc_current_location_edit($tracking));

        $myLove = <<<ELLA
        Document <strong><a href="{$link}" target="_blank">#{$tracking}</a></strong> 
        titled <strong>{$title}</strong> has been at the {$currentLoc} unit for <strong>{$days}</strong> days.<br>
ELLA;
        echo $myLove;
    }

    echo '</div></blockquote>';
}

?>
