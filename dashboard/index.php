<?php

include("includes/header.php");
include("includes/sidebar.php");

// !  Role Assignment
// *  1 = superadmin
// *  2 = admin / special accounts
// *  3 = regular user

extract($_GET, EXTR_PREFIX_ALL, "g");

if(isset($_SESSION['timestamp']))
{
    if(time() - $_SESSION['timestamp'] > 900)
    {
        redirect("?logout");
    }
    else
    {
        $_SESSION['timestamp'] = time();
    }
}

if(isset($_GET['upload']))
{
    if($_SESSION['role'] == 2 || 
    $_SESSION['role'] == 1 || 
    $_SESSION['unit'] == 117 || 
    $_SESSION['unit'] == 127 || 
    $_SESSION['unit'] == 128)
    {   
        include("includes/upload.php");   
    }
    else
    {
        set_message_alert("alert-warning", "fa-exclamation", "Access Denied.");
        redirect("./?documents");
    }
}

if(isset($g_debug))
{
    if($_SESSION['role'] == 1)
    {   
        include("includes/debug.php");   
    }
    else
    {
        set_message_alert("alert-warning", "fa-exclamation", "Access Denied.");
        redirect("./?documents");
    }    
}

if(isset($g_admin))
{
    if($_SESSION['role'] == 1)
    {   
        include("includes/admin.php");   
    }
    else
    {
        set_message_alert("alert-warning", "fa-exclamation", "Access Denied.");
        redirect("./?documents");
    }    
}

if(isset($g_allReceived) && $_SESSION['role'] == 1)
{
    include("includes/allReceived.php");
}

if(isset($g_allReleased) && $_SESSION['role'] == 1)
{
    include("includes/allReleased.php");
}

if(isset($g_users))
{
    include("includes/users.php");
}

if($_SERVER['REQUEST_URI'] == "/sdoin-dts/dashboard/")
{
    include("includes/documents.php");
}

if(isset($g_documents))
{
    include("includes/documents.php");
}

if(isset($g_reports))
{
    include("includes/reports.php");
}

if(isset($g_received))
{
    include("includes/received.php");
}

if(isset($g_released))
{
    include("includes/released.php");
}

if(isset($g_accomplished))
{
    include("includes/accomplished.php");
}

if(isset($g_tracking))
{
    include("includes/tracking.php");
}

if(isset($g_profile))
{
    include("includes/profile.php");
}

if(isset($g_scanrec))
{
    include("includes/scanrec.php");
}

if(isset($g_logout))
{
    include("actions/logout.php");
}

if(isset($g_manipulate))
{
    include("actions/manipulate.php");
}

if(isset($g_print))
{
    redirect("print/barcode.php?tracking=" . escape_string($_GET['print']));
}

if(isset($g_view) && isset($g_file))
{
    redirect("uploads/".escape_string($_GET['file']));
}

include("includes/modals.php");
include("includes/footer.php"); 

?>
