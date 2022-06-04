<?php
require_once "setting.php";

class User extends Dbh
{
    // Check admin login
    public function checkLogin($email, $passwd)
    {
        $query = "SELECT * FROM tbl_account WHERE email='$email' AND password='$passwd'";
        $result = $this->conn->query($query) or die("Error checkLogin: " . $this->conn->error);
        return $result;
    }

    // Get user information from id
    public function getUserInfo($id)
    {
        $query = "SELECT * FROM tbl_account WHERE id='$id'";
        $result = $this->conn->query($query) or die("Error getUserInfo: " . $this->conn->error);
        $rows = mysqli_fetch_array($result);
        return $rows;
    }

    // Get user information from name
    public function getUserInfoWithName($name)
    {
        $query = "SELECT * FROM tbl_account WHERE name='$name'";
        $result = $this->conn->query($query) or die("Error getUserInfoWithName: " . $this->conn->error);
        $rows = mysqli_fetch_array($result);
        return $rows;
    }

    // Check number of username (mostly use for check existed)
    public function checkNumberUsername($username)
    {
        $query = "SELECT id FROM tbl_account WHERE username='$username'";
        $result = $this->conn->query($query) or die("Error checkNumberUsername: " . $this->conn->error);
        $num_row = mysqli_num_rows($result);
        return $num_row;
    }

    // Check email existed
    public function checkNumberEmail($email)
    {
        $query = "SELECT id FROM tbl_account WHERE email='$email'";
        $result = $this->conn->query($query) or die("Error checkNumberEmail: " . $this->conn->error);
        $num_row = mysqli_num_rows($result);
        return $num_row;
    }

    // Add user to db
    public function addUser($username, $email, $password, $address, $name, $type)
    {
        $query = "INSERT INTO tbl_account (username, email, password, address, name,type) VALUES ('$username','$email','$password','$address','$name','$type')";
        $result = $this->conn->query($query) or die("Error addUser: " . $this->conn->error);
        return $result;
    }

    // Encrypt password
    public function encryptPassword($password)
    {
        $password = crypt($password, SALT_MD5);
        $password = md5($password);
        return $password;
    }

    // Update user password
    public function updateUserPasswd($email, $passwd)
    {
        $query = "UPDATE tbl_account SET password='$passwd' WHERE email='$email'";
        $result = $this->conn->query($query) or die("updateUserPasswd :" . $this->conn->error);
        return $result;
    }
}
?>
