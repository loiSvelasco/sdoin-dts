<?php 

require("../config.php");

if(isset($_POST['forgot']))
{
    $email = escape_string($_POST['email']);

    $sql = query("SELECT * FROM users WHERE email = '{$email}'");
    confirm($sql);

    if(row_count($sql) == 0)
    {
        set_message_alert("alert-warning", "fa-info-circle", "Email not found. Register instead.");
        redirect("../?forgot");
    }
    else
    {
        $row = fetch_assoc($sql);
        $email = $row['email'];
        $reset = $row['reset'];

        $to = $email;
        $subject = "Password Reset Request";
        $from_name = "SDOIN.eDTS Developer";
        $fr_email  = "loisuperficialvelasco.sdoin@gmail.com";
        $txt = <<<ELLA
        Good day! We received your request to reset your password at SDOIN's Enhanced DTS, please follow the link below to set a new password for your account.
        
        http://localhost/sdoin-dts/?recover&hash={$reset}&for={$email}

        in case you are unable to click on the link, please copy and paste it to your web browser's address bar.

        if you did not request this, just ignore this message.
        This email is auto-generated. Do not reply to this email.

        For questions, please contact Louis Velasco @ loisuperficialvelasco@gmail.com
ELLA;
        $headers = "From: {$from_name} {$fr_email}";
        $result = mail($to, $subject, $txt, $headers);
        if($result)
        {
            set_message_alert("alert-info", "fa-info-circle", "Check your email for instructions.");
            redirect("../?forgot");
        }
        else
        {
            set_message_alert("alert-danger", "fa-times", "An error occured, try again later.");
            redirect("../?forgot");
        }
    }
}

?>