<?php 

require("../config.php");

if(isset($_POST['register']))
{
    // users.table
    $email      = escape_string($_POST['email']);
    $password   = escape_string($_POST['password']);
    // user_details.table
    $fullname   = escape_string($_POST['fullname']);
    $unit       = escape_string($_POST['unit']);
    $reset      = random_str(8);
    $options = [
        'cost' => 12,
    ];

    $hashed_pwd = password_hash($password, PASSWORD_BCRYPT, $options);

    $insert_users = query("INSERT INTO users (email, password, reset) VALUES ('{$email}', '{$hashed_pwd}', '{$reset}')");
    $last_id = last_id();
    confirm($insert_users);

    $insert_user_d = query("INSERT INTO user_details (ud_id, ud_unit, ud_name) VALUES ('{$last_id}', '{$unit}', '{$fullname}')");
    confirm($insert_user_d);

    set_message_alert("alert-success", "fa-check", "Account created! sign in below.");
    redirect("../../?login");
}
?>