<?php 

require("../config.php");

if(isset($_POST['recover']))
{
    // users.table
    $email = escape_string($_POST['email']);
    $hash = escape_string($_POST['hash']);
    $password = escape_string($_POST['password']);

    $options = [
        'cost' => 12,
    ];

    $sql = query("SELECT * FROM users WHERE email = '{$email}' and reset = '{$hash}' LIMIT 1");
    confirm($sql);

    if(row_count($sql) == 0)
    {
        set_message_alert("alert-danger", "fa-times", "An error occured. Try again later.");
        redirect("../?login");
    }
    else
    {
        $hashed_pwd = password_hash($password, PASSWORD_BCRYPT, $options);
        $reset = random_str(10);
        $update_password = query("UPDATE users SET password = '{$hashed_pwd}', reset = '{$reset}' WHERE email = '{$email}'");
        confirm($update_password);
        set_message_alert("alert-success", "fa-check", "Password set! Try logging in below.");
        redirect("../?login");
    }
}

?>