<?php
require_once '../config.php';

global $maintenance;

if($maintenance)
{
    include(dirname(__DIR__) . DIRECTORY_SEPARATOR . "maintenance.php");
    exit();
}

if(isset($_SESSION['user_id']))
{
    if(accountIsLocked($_SESSION['user_id']))
    {
        unset($_SESSION);
        session_destroy();
        session_write_close();
        session_start();
        redirect("../?login");
    }
}

include("includes/header.php");
include("includes/sidebar.php");

// !  Role Assignment
// *  1 = superadmin
// *  2 = admin / special accounts
// *  3 = regular user

// if(isset($_SESSION['timestamp']))
// {
//     if(time() - $_SESSION['timestamp'] > 5400)
//     {
//         redirect("?logout");
//     }
//     else
//     {
//         $_SESSION['timestamp'] = time();
//     }
// }

if ($_SERVER['REQUEST_URI'] == SUBDIRECTORY . "dashboard/")
{
    include("includes/documents.php");
}

else if (isset($_GET['print'])) 
{
    redirect("print/barcode.php?tracking=" . escape_string($_GET['print']));
}

else if (isset($_GET['view']) && isset($_GET['file'])) 
{
    redirect("uploads/".escape_string($_GET['file']));
}

else if (isset($_GET['manipulate']))
{
    include("actions/manipulate.php");
}

else if (isset($_GET['tracking']))
{
    include("includes/tracking.php");
}

else if (isset($_GET['logout']))
{
    include("actions/logout.php");
}

else if (isset($_GET['editDoc']))
{
    include("includes/editDoc.php");
}

else if (isset($_GET['documents']))
{
    include("includes/documents.php");
}

else if (isset($_GET['updates']))
{
    include("includes/updates.php");
}

else if (isset($_GET['upload']))
{
    if($_SESSION['role'] == 2 || 
    $_SESSION['role'] == 1 || 
    $_SESSION['unit'] == 117 || 
    $_SESSION['unit'] == 127 || 
    $_SESSION['unit'] == 128)
    {   
        include("includes/upload.php");   
    } else {
        set_message_alert("alert-warning", "fa-exclamation", "Access Denied.");
        redirect("./?documents");
    }
}

else if (isset($_GET['upForwarded']))
{
    if($_SESSION['role'] == 2 || 
    $_SESSION['role'] == 1 || 
    $_SESSION['unit'] == 117 || 
    $_SESSION['unit'] == 127 || 
    $_SESSION['unit'] == 128)
    {   
        include("includes/uploadedForUnit.php");   
    } else {
        set_message_alert("alert-warning", "fa-exclamation", "Access Denied.");
        redirect("./?documents");
    }
}

else if (isset($_GET['debug']))
{
    if($_SESSION['role'] == 1) {
        include("includes/debug.php");
    } else {
        set_message_alert("alert-warning", "fa-exclamation", "Access Denied.");
        redirect("./?documents");
    }
}

else if (isset($_GET['admin']))
{
    if($_SESSION['role'] == 1)
    {
        include("includes/admin.php");
    }
    else {
        set_message_alert("alert-warning", "fa-exclamation", "Access Denied.");
        redirect("./?documents");
    }
}

else if (isset($_GET['allReceived']))
{
    if($_SESSION['role'] != 1)
        redirect("./?documents");
    include("includes/allReceived.php");
}

else if (isset($_GET['allReleased']))
{
    if($_SESSION['role'] != 1)
        redirect("./?documents");
    include("includes/allReleased.php");
}

else if (isset($_GET['allDocs']))
{
    if($_SESSION['role'] != 1)
        redirect("./?documents");
    include("includes/allDocs.php");
}

else if (isset($_GET['lapsedDocs']))
{
    if($_SESSION['role'] != 1)
        redirect("./?documents");
    include("includes/lapsedDocs.php");
}

else if (isset($_GET['users']))
{
    if($_SESSION['role'] != 1)
        redirect("./?documents");
    include("includes/users.php");
}

else if (isset($_GET['reports']))
{
    include("includes/reports.php");
}

else if (isset($_GET['received']))
{
    include("includes/received.php");
}

else if (isset($_GET['released']))
{
    include("includes/released.php");
}

else if (isset($_GET['accomplished']))
{
    include("includes/accomplished.php");
}

else if (isset($_GET['profile']))
{
    include("includes/profile.php");
}

else if (isset($_GET['scanrec']))
{
    include("includes/scanrec.php");
}

else if (isset($_GET['404']))
{
    include("includes/404.php");
}

else 
{
    redirect("./?404");
}

include("includes/modals.php");
include("includes/footer.php");
