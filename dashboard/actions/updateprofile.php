<?php

require_once("../../config.php");

if(isset($_POST['updateProfile']))
{
    $target_dir = "../uploads/";
    $pfImage = $_FILES['pfimage']['tmp_name'];
    $referer  = escape_string($_POST['referer']);


    if(trim($_POST['fullName']) == '' || trim($_POST['userEmail']) == '')
    {
        $fullName = $_SESSION['usrname'];
        $emailAdd = $_SESSION['user'];
    }
    else
    {
        $fullName = properName(escape_string($_POST['fullName']));
        $emailAdd = escape_string($_POST['userEmail']);
    }

    $imageOK = true;
    
	if(!empty($_FILES["pfimage"]["tmp_name"]))
    {
		$fileinfo = PATHINFO($_FILES["pfimage"]["name"]);
        $type = mime_content_type($_FILES['pfimage']['tmp_name']);
        if( ! in_array($type, ['image/jpeg', 'image/png', 'image/gif']))
        {
            $imageOK = false;
        }
        else
        {
            if($_FILES['pfimage']['size'] < 2000000)
            {
                // $newFilename = file_get_contents($_FILES['pfimage']['tmp_name']);
                $newFilename = $fileinfo['filename'] ."_". time() . "." . $fileinfo['extension'];
                move_uploaded_file($_FILES["pfimage"]["tmp_name"], $target_dir.$newFilename);
                // var_dump($_FILES); die();
            }
            else
            {
                $imageOK = false;
            }
        }
	}
    else
    {
        $get_img = query("SELECT ud_img FROM user_details WHERE id = {$_SESSION['user_id']}");
        confirm($get_img);
        $row = fetch_assoc($get_img);
        $imgName = $row['ud_img'];
        
        if($imgName != '')
        {
            $newFilename = $imgName;
        }
        else
        {
            $newFilename = '';
        }
	}
 


    // update Script
    $updateUser = query(
        "UPDATE users 
         SET email = '{$emailAdd}' 
         WHERE id = '{$_SESSION['user_id']}'"
    );
    confirm($updateUser);

    $updateUserDetails = query(
        "UPDATE user_details 
         SET ud_name = '{$fullName}', ud_img = '{$newFilename}'
         WHERE id = '{$_SESSION['user_id']}'"
    );
    confirm($updateUserDetails);
    
    $_SESSION['user'] = $emailAdd;

    if( ! $imageOK)
    {
        set_message_alert("alert-warning", "fa-exclamation", "Profile updated, but errors are encountered with the image you are trying to upload. It must be a valid image file under 2MB.");
    }
    else
    {
        set_message_alert("alert-success", "fa-check", "Profile updated successfully.");
    }
    redirect("../?profile");
}

?>