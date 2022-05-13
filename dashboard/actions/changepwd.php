<?php

require_once("../../config.php");

if(isset($_POST['changePass']))
{
    $currPass = escape_string($_POST['currPass']);
    $password = escape_string($_POST['newPass']);
    $referer  = escape_string($_POST['referer']);

    $options = [
        'cost' => 12,
    ];

    $sql = query("SELECT * FROM users WHERE id = '{$_SESSION['user_id']}'");
    confirm($sql);

    if(row_count($sql) == 1)
    {
        $row = fetch_assoc($sql);
        if(password_verify($currPass, $row['password']))
        {
            $hashed_pwd = password_hash($password, PASSWORD_BCRYPT, $options);
            $updateQuery = query("UPDATE users SET password = '{$hashed_pwd}' WHERE id = '{$_SESSION['user_id']}'");
            set_message_alert("alert-success", "fa-check", "Password successfully updated.");
        }
        else
        {
            set_message_alert("alert-danger", "fa-times", "Current password does not match.");
        }
    }
    redirect("../?profile");
}

?>