<?php
class Dbh
{
    // Variables
    protected $host = 'localhost';
    protected $user = 'root';
    protected $pass = 'Khanh123';
    protected $name = 'uncletetsu';

    // public connection
    public $conn = null;

    public function __construct()
    {
        $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
        if ($this
            ->conn
            ->connect_error) die("Connection failed: " . $this
            ->conn
            ->connect_error);
    }
}
define('SALT_MD5', '$1$asdfghjk$');
?>
