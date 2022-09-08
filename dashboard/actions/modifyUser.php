<?php 
require_once("../../config.php");

if(isset($_POST['userID']))
{
    $referer = escape_string($_POST['referer']);

    if(isset($_POST['update']))
    {
        // users.table
        $id = escape_string($_POST['userID']);
        $email = escape_string($_POST['email']);
        $role = escape_string($_POST['role']);
        $lock = escape_string($_POST['lockacct']);
    
        // user_details.table
        $unit = escape_string($_POST['unit']);
        $fullname = escape_string($_POST['fullname']);
    
        // dd($_POST);
    
        if(exists($id, 'users') && exists($id, 'user_details'))
        {
            if($lock == 1 && $_SESSION['user_id'] == $id)
            {
                set_message_alert("alert-danger", "fa fa-times", "You cannot lock your own account.");
                redirect($referer);
            }
            else
            {
                $name = get_user_name($id);
                
                $updateUser = query("UPDATE users SET email = '{$email}', role = '{$role}', locked = '{$lock}' WHERE id = '{$id}'");
                confirm($updateUser);
            
                $updateUserDetails = query("UPDATE user_details SET ud_name = '{$fullname}', ud_unit = '{$unit}' WHERE id = '{$id}'");
                confirm($updateUserDetails);
                
                set_message_alert("alert-success", "fa fa-check", "Successfully updated user $name.");
            }
        }
        else
        {
            set_message_alert("alert-danger", "fa fa-times", "Something went wrong. Please try again.");
        }
    
        redirect($referer);
    }
    else if (isset($_POST['reset']))
    {
        $id = escape_string($_POST['userID']);
        $email = escape_string($_POST['email']);

        $options = [
            'cost' => 12,
        ];

        $check = query("SELECT * FROM users WHERE email = '{$email}' LIMIT 1");
        confirm($check);

        if(row_count($check) >= 1)
        {
            $hashed_pwd = password_hash($email, PASSWORD_BCRYPT, $options);
            $updateUser = query("UPDATE users SET password = '{$hashed_pwd}' WHERE id = '{$id}'");
            confirm($updateUser);
            set_message_alert("alert-success", "fa fa-check", "Password reset for user $email is successful.");
            redirect($referer);
        }
    }
    else
    {
        die(redirect('?err'));
    }
}
else
{
    die(redirect('?err'));
}



?>