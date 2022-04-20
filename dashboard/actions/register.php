<?php

require_once("../../config.php");

if(isset($_POST['register']))
{
    // users.table
    $email      = escape_string($_POST['email']);
    $password   = escape_string($_POST['password']);
    // user_details.table
    $fullname   = escape_string($_POST['fullname']);
    $unit       = escape_string($_POST['unit']);
    $reset      = random_str(8);
    $role       = escape_string($_POST['role']);
    $options = [
        'cost' => 12,
    ];

    $check = query("SELECT * FROM users WHERE email = '{$email}'");
    confirm($check);

    if(row_count($check) >= 1)
    {
        set_message_alert("alert-danger", "fa-info-circle", "Email already in use.");
        redirect("../?users");
    }
    else
    {
        $hashed_pwd = password_hash($password, PASSWORD_BCRYPT, $options);

        $insert_users = query("INSERT INTO users (email, password, role, reset) VALUES ('{$email}', '{$hashed_pwd}', '$role','{$reset}')");
        $last_id = last_id();
        confirm($insert_users);

        $insert_user_d = query("INSERT INTO user_details (ud_unit, ud_name) VALUES ('{$unit}', '{$fullname}')");
        confirm($insert_user_d);

        set_message_alert("alert-success", "fa-check", "Account created!");
        redirect("../?users");
    }
}

?>