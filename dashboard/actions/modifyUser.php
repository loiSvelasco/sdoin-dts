<?php 
require_once("../../config.php");

if(isset($_POST['userID']))
{
    $referer = escape_string($_POST['referer']);
    // users.table
    $id = escape_string($_POST['userID']);
    $email = escape_string($_POST['email']);
    $role = escape_string($_POST['role']);
    // user_details.table
    $unit = escape_string($_POST['unit']);
    $fullname = escape_string($_POST['fullname']);

    dd($_POST);

    if(exists($id, 'users') && exists($id, 'user_details'))
    {
        $updateUser = query("UPDATE users SET email = '{$email}', role = '{$role}' WHERE id = '{$id}'");
        confirm($updateUser);
    
        $updateUserDetails = query("UPDATE user_details SET ud_name = '{$fullname}', ud_unit = '{$unit}' WHERE id = '{$id}'");
        confirm($updateUserDetails);
        
        set_message_alert("alert-success", "fa fa-check", "Successfully updated user.");
    }
    else
    {
        set_message_alert("alert-danger", "fa fa-times", "Something went wrong. Please try again.");
    }

    redirect($referer);
}

?>