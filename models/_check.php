<?php
session_start();
require_once "dpd.php";

//Set up for session user
$session_user_id = 0;
$session_user_type;
$session_user_email;
$session_user_name;

//Check for an user in the session
if (isset($_SESSION["session_user_email"]) && isset($_SESSION["session_user_passwd"]))
{
    $session_user_email = $_SESSION["session_user_email"];
    $session_user_passwd = $_SESSION["session_user_passwd"];

    // Get object from saved
    echo $session_user_passwd;
    $crypt_pass = $userObj->encryptPassword($session_user_passwd);
    $result = $userObj->checkLogin($session_user_email, $crypt_pass);
    echo $crypt_pass;
    echo mysqli_num_rows($result);
    $rows = mysqli_fetch_array($result);

	// Already existed user
    if (isset($rows['id']))
    {
        $user_type = $rows['type'];
        echo $user_type;
        $_SESSION["session_user_id"] = $rows['id'];
        $_SESSION["session_user_name"] = $rows['name'];
        $_SESSION["session_user_email"] = $rows['email'];
        $_SESSION["session_user_type"] = $rows['type'];

        // Navigation if role
        if ($user_type == "admin")
        {
            header("Location:../admin");
        }
        else if ($user_type == "staff")
        {
            header("Location:../staff");
        }
        else if ($user_type == "member")
        {
            header("Location:../index.php");
        }
    }
}

