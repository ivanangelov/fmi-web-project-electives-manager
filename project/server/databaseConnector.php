<?php
require_once("../../config.php");
class DatabaseConnector
{
    
    private $servername = servername;
    private $username = username;
    private $password = password;
    private $dbname = dbname;
    public $connection;
    
    public function getConnection()
    {
        
        $this->connection = null;
        
        $this->connection = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
        
        if ($this->connection->connect_error) {
            die("Connection error occured. Please try again.");
        }
        
        return $this->connection;
    }
}
?>