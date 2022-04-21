<?php

include("includes/header.php");
include("includes/sidebar.php");

// !  Role Assignment
// *  1 = superadmin
// *  2 = admin / special accounts
// *  3 = regular user

if(isset($_SESSION['timestamp']))
{
    if(time() - $_SESSION['timestamp'] > 1500)
    {
        redirect("?logout");
    }
    else
    {
        $_SESSION['timestamp'] = time();
    }
}

// if(isset($g_upload))
// {
//     if($_SESSION['role'] == 2 || 
//     $_SESSION['role'] == 1 || 
//     $_SESSION['unit'] == 117 || 
//     $_SESSION['unit'] == 127 || 
//     $_SESSION['unit'] == 128)
//     {   
//         include("includes/upload.php");   
//     }
//     else
//     {
//         set_message_alert("alert-warning", "fa-exclamation", "Access Denied.");
//         redirect("./?documents");
//     }
// }

// if(isset($g_debug))
// {
//     if($_SESSION['role'] == 1)
//     {   
//         include("includes/debug.php");   
//     }
//     else
//     {
//         set_message_alert("alert-warning", "fa-exclamation", "Access Denied.");
//         redirect("./?documents");
//     }    
// }

// if(isset($g_admin))
// {
//     if($_SESSION['role'] == 1)
//     {   
//         include("includes/admin.php");   
//     }
//     else
//     {
//         set_message_alert("alert-warning", "fa-exclamation", "Access Denied.");
//         redirect("./?documents");
//     }    
// }

// if(isset($g_allReceived))
// {
//     if($_SESSION['role'] != 1)
//         redirect("./?documents");
//     include("includes/allReceived.php");
// }

// if(isset($g_allReleased))
// {
//     if($_SESSION['role'] != 1)
//         redirect("./?documents");
//     include("includes/allReleased.php");
// }

// iF(isset($g_allDocs))
// {
//     if($_SESSION['role'] != 1)
//         redirect("./?documents");
//     include("includes/allDocs.php");
// }

// if(isset($g_lapsedDocs))
// {
//     if($_SESSION['role'] != 1)
//         redirect("./?documents");
//     include("includes/lapsedDocs.php");
// }

// if(isset($g_users))
// {
//     if($_SESSION['role'] != 1)
//         redirect("./?documents");
//     include("includes/users.php");
// }


// if(isset($g_documents))
// {
//     include("includes/documents.php");
// }

// if(isset($g_reports))
// {
//     include("includes/reports.php");
// }

// if(isset($g_received))
// {
//     include("includes/received.php");
// }

// if(isset($g_released))
// {
//     include("includes/released.php");
// }

// if(isset($g_accomplished))
// {
//     include("includes/accomplished.php");
// }

// if(isset($g_tracking))
// {
//     include("includes/tracking.php");
// }

// if(isset($g_profile))
// {
//     include("includes/profile.php");
// }

// if(isset($g_scanrec))
// {
//     include("includes/scanrec.php");
// }

// if(isset($g_logout))
// {
//     include("actions/logout.php");
// }

// if(isset($g_manipulate))
// {
//     include("actions/manipulate.php");
// }
if($_SERVER['REQUEST_URI'] == "/sdoin-dts/dashboard/") {
    include("includes/documents.php");
} else if (isset($_GET['print'])) {
    redirect("print/barcode.php?tracking=" . escape_string($_GET['print']));
} else if (isset($_GET['view']) && isset($_GET['file'])) {
    redirect("uploads/".escape_string($_GET['file']));
} else if (isset($_GET['manipulate'])) {
    include("actions/manipulate.php");
} else if (isset($_GET['tracking'])) {
    include("includes/tracking.php");
} else if (isset($_GET['logout'])) {
    include("actions/logout.php");
}
 // if needed, ad more else ifs here
else 
{
    switch($_SERVER['QUERY_STRING'])
    {
        case 'documents':
            include("includes/documents.php");
            break;
        case 'upload':
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
            break;
        case 'debug':
            if($_SESSION['role'] == 1) {
                include("includes/debug.php");
            } else {
                set_message_alert("alert-warning", "fa-exclamation", "Access Denied.");
                redirect("./?documents");
            }
            break;
        case 'admin':
            if($_SESSION['role'] == 1) {
                include("includes/admin.php");
            } else {
                set_message_alert("alert-warning", "fa-exclamation", "Access Denied.");
                redirect("./?documents");
            }
            break;
        case 'allReceived':
            if($_SESSION['role'] != 1)
                redirect("./?documents");
            include("includes/allReceived.php");
            break;
        case 'allReleased':
            if($_SESSION['role'] != 1)
                redirect("./?documents");
            include("includes/allReleased.php");
            break;
        case 'allDocs':
            if($_SESSION['role'] != 1)
                redirect("./?documents");
            include("includes/allDocs.php");
            break;
        case 'lapsedDocs':
            if($_SESSION['role'] != 1)
                redirect("./?documents");
            include("includes/lapsedDocs.php");
            break;
        case 'users':
            if($_SESSION['role'] != 1)
                redirect("./?documents");
            include("includes/users.php");
            break;
        case 'reports':
            include("includes/reports.php");
            break;
        case 'received':
            include("includes/received.php");
            break;
        case 'released':
            include("includes/released.php");
            break;
        case 'accomplished':
            include("includes/accomplished.php");
            break;
        case 'profile':
            include("includes/profile.php");
            break;
        case 'scanrec':
            include("includes/scanrec.php");
            break;
        default:
            set_message_alert("alert-warning", "fa-exclamation", "No page found. Redirected you to Receiving and Releasing.");
            redirect("./?documents");
            break;
    }
}

include("includes/modals.php");
include("includes/footer.php"); 

?>
