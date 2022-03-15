<?php 

require("../config.php");

if(isset($_POST['login']))
{
    // users.table
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
        if(password_verify($password, $row['password']))
        {
            $_SESSION['user'] = $row['email'];
            redirect("../dashboard/");
        }
        else
        {
            set_message_alert("alert-danger", "fa-times", "Incorrect Password.");
            redirect("../?login");
        }
    }
}

?>