<?php 
// SELECT DATEDIFF(CURDATE(), DATE(dl_receiveddate)); get date from today and from date received

function isLapsed()
{
    // 117 - osds; 121 - records, 113- ict
    if($_SESSION['unit'] == 117 ||
       $_SESSION['unit'] == 121 ||
       $_SESSION['unit'] == 113)
    {
        return false;
    }

    $babyElla = query("SELECT *, DATE(dl_receiveddate) AS 'receiveddate' FROM docs_location WHERE dl_unit = '{$_SESSION['unit']}' AND DATEDIFF(CURDATE(), DATE(dl_receiveddate)) >= 15 AND dl_forwarded = 0");
    love($babyElla);

    $lapsedDocs = row_count($babyElla);
    if($lapsedDocs >= 1)
        return true;
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
        $active = true;
        $rStmt = "SELECT *, DATE(dl_receiveddate) AS 'receiveddate' FROM docs_location WHERE dl_unit = '{$_SESSION['unit']}' ";
        $rStmt .= "AND DATEDIFF(CURDATE(), DATE(dl_receiveddate)) >= 10 ";
        $rStmt .= "AND DATEDIFF(CURDATE(), DATE(dl_receiveddate)) < 15 AND dl_forwarded = 0";
        $princessElla = query($rStmt);
        love($princessElla); // QUERY FOR WARNING ISSUE
        $babyElla = query("SELECT *, DATE(dl_receiveddate) AS 'receiveddate' FROM docs_location WHERE dl_unit = '{$_SESSION['unit']}' AND DATEDIFF(CURDATE(), DATE(dl_receiveddate)) >= 15 AND dl_forwarded = 0");
        love($babyElla); // QUERY FOR LAPSED DOCS
    
        $warningDocs = row_count($princessElla);
        if($warningDocs >= 1)
        {
            issueReminder($princessElla);
        }
    
        $lapsedDocs = row_count($babyElla);
        if($lapsedDocs >= 1)
        {
            issueWarning($babyElla);
        }
    }
}

function issueReminder($query)
{
    echo '<div class="col-lg-6"><blockquote class="quote-warning"><h5><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;Reminders</h5>';
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

function issueWarning($query)
{
    echo '<div class="col-lg-6"><blockquote class="quote-red"><h5><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;Warning</h5>';
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