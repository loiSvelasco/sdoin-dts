<?php 

require("../config.php");

if(isset($_POST['login']))
{
    $email      = escape_string($_POST['email']);
    $password   = escape_string($_POST['password']);

    $sql = query("SELECT * FROM users WHERE email = '{$email}'");
    confirm($sql);

    if(row_count($sql) == 0)
    {
        set_message_alert("alert-danger", "fa-times", "Email not registered.");
        redirect("../?login");
    }
    else
    {
        $row = fetch_assoc($sql);
        
        $sql_ud = query("SELECT * FROM user_details WHERE id = {$row['id']}");
        confirm($sql_ud);
        $udRow = fetch_assoc($sql_ud);

        if(accountIsLocked($row['id']))
        {
            set_message_alert("alert-danger", "fa-times", "Your account is locked.");
            redirect("../?login");
        }
        else
        {
            if(password_verify($password, $row['password']))
            {
                $_SESSION['user']    = $row['email'];
                $_SESSION['user_id'] = $udRow['id'];
                $_SESSION['unit']    = $udRow['ud_unit'];
                $_SESSION['role']    = $row['role'];
                $_SESSION['timestamp'] = time();
                redirect("../dashboard/");
            }
            else
            {
                set_message_alert("alert-danger", "fa-times", "Incorrect Password.");
                redirect("../?login&try={$email}");
            }
        }
    }
}

?>