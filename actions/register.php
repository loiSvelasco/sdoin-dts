<?php 
if(isset($_POST['register']))
{
    // users.table
    $email      = escape_string($_POST['email']);
    $password   = escape_string($_POST['password']);
    $role       = escape_string($_POST['role']);

    // user_details.table
    $fullname   = escape_string($_POST['fullname']);
    

    $options = [
        'cost' => 12,
    ];

    $hashed_pwd = password_hash($password, PASSWORD_BCRYPT, $options);

    $insert_users = query("INSERT INTO users (email, pass, role, status, activation_code, reset_code) VALUES ('{$email}', '{$hashed_pwd}', '{$role}', '{$acctstat}', '{$activCode}', '{$resetCode}')");
    $last_id = last_id();
    confirm($insert_users);

    $insert_user_d = query("INSERT INTO user_details (usr_id, fname, lname, contact, address) VALUES ('{$last_id}', '{$firstName}', '{$lastName}', '{$contact}', '{$address}')");
    confirm($insert_user_d);


    set_message("Account successfully created!");
    redirect("login.php");
}
?>