<?php 
// SELECT DATEDIFF(CURDATE(), DATE(dl_receiveddate)); get date from today and from date received

function isLapsed()
{
    // 117 - osds; 121 - records, 113- ict
    if($_SESSION['unit'] == 117 ||
       $_SESSION['unit'] == 121 ||
       $_SESSION['unit'] == 113)
    {
        return false; // always return false for these units to bypass permission blocking
    }

    $babyElla = query("SELECT *, DATE(dl_receiveddate) AS 'receiveddate' FROM docs_location WHERE dl_unit = '{$_SESSION['unit']}' AND DATEDIFF(CURDATE(), DATE(dl_receiveddate)) >= " . DOC_LAPSED_DAYS . " AND dl_forwarded = 0");
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

function issueNotice()
{
    if(isset($_SESSION['unit']))
    {
        $active = false;
        $rStmt = "SELECT *, DATE(dl_receiveddate) AS 'receiveddate' FROM docs_location WHERE dl_unit = '{$_SESSION['unit']}' ";
        $rStmt .= "AND DATEDIFF(CURDATE(), DATE(dl_receiveddate)) >= " . DOC_REMIND_DAYS . " ";
        $rStmt .= "AND DATEDIFF(CURDATE(), DATE(dl_receiveddate)) < " . DOC_LAPSED_DAYS . " AND dl_forwarded = 0";
        $princessElla = query($rStmt);
        love($princessElla); // QUERY FOR WARNING ISSUE
        
        $wStmt = "SELECT DISTINCT dl_tracking, dl_forwarded, DATE(dl_receiveddate) AS 'receiveddate', document_accomplished FROM docs_location, documents ";
        $wStmt .= "WHERE dl_unit = '{$_SESSION['unit']}' AND DATEDIFF(CURDATE(), DATE(dl_receiveddate)) >= 15 ";
        $wStmt .= "AND document_accomplished = 0 AND dl_forwarded = 0";
        $babyElla = query($wStmt);
        love($babyElla); // QUERY FOR LAPSED DOCS
    
        $warningDocs = row_count($princessElla);
        if($warningDocs >= 1)
        {
            issueReminder($princessElla);
            $active = true;
        }
    
        $lapsedDocs = row_count($babyElla);
        if($lapsedDocs >= 1)
        {
            issueWarning($babyElla);
            $active = true;
        }
    }

    if($active)
    {
        echo '<div class="col-12">
                <blockquote class="quote-info">
                  <h5>Notice</h5>
                    <p>The system detected that you have documents unreleased for a long period of time.
                    If it reaches 15 days, you will not be able to add or create documents unless you release or accomplish said documents.
                    This is to ensure that the documents reach their proper destination. This notice will persist until all concerned documents are released or accomplished.</p>
                    </p>
                </blockquote>
              </div>';
    }
}

function issueReminder($query)
{
    echo '<div class="col-lg-6">
    <blockquote class="quote-warning">
    <h5><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;Reminders</h5>';
    while($row = fetch_array($query))
    {
        $tracking = $row['dl_tracking'];
        $days = countDays($row['receiveddate']);
        $title = get_document_detail($tracking, 'document_title');
        $myLove = <<<ELLA
        Document <strong>#{$tracking}</strong> titled <strong>{$title}</strong> has not been released for <strong>{$days}</strong> days.<br>
ELLA;
        echo $myLove;
    }
    echo '</div>
    </blockquote>';
}

function issueWarning($query)
{
    echo '<div class="col-lg-6">
    <blockquote class="quote-red">
    <h5><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;Warning</h5>';
    while($row = fetch_array($query))
    {
        $tracking = $row['dl_tracking'];
        $days = countDays($row['receiveddate']);
        $title = get_document_detail($tracking, 'document_title');
        $myLove = <<<ELLA
        Document <strong>#{$tracking}</strong> titled <strong>{$title}</strong> has not been released for <strong>{$days}</strong> days.<br>
ELLA;
        echo $myLove;
    }
    echo '</div></blockquote>';
}


?>