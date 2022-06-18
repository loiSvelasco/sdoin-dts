<?php 

require("../config.php");

if(isset($_POST['forgot']))
{
    $email = escape_string($_POST['email']);

    $sql = query("SELECT * FROM users WHERE email = '{$email}'");
    confirm($sql);

    if(row_count($sql) == 0)
    {
        set_message_alert("alert-warning", "fa-info-circle", "Email not found. <a href='?register' class='alert-link'>Register</a> instead.");
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
        $sub = SUBDIRECTORY;

        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
            $protocol = 'https://';
        else
            $protocol = 'http://';

        $txt = <<<ELLA
        Good day! We received your request to reset your password at SDOIN's Enhanced DTS, please follow the link below to set a new password for your account.
        
        {$protocol}{$_SERVER["HTTP_HOST"]}{$sub}?recover&hash={$reset}&for={$email}

        in case you are unable to click on the link, please copy and paste it on your web browser's address bar.

        if you did not request this, just ignore this message.
        This email is auto-generated. Do not reply to this email.

        For questions, please contact Louis Velasco @ louis.velasco@deped.gov.ph
ELLA;
        $headers = "From: {$from_name} {$fr_email}";
        dd(mail($to, $subject, $txt, $headers));
        die();
        if(mail($to, $subject, $txt, $headers))
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