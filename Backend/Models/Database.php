<?php

class Database{
    private $host;
    private $user;
    private $pass;
    private $dbms;
    private $conn;
    private $stat;

    function __construct()
    {
        $this->host = "localhost";
        $this->user = "root";
        $this->pass = "";
        $this->dbms = "upholster";
        $this->stat = false;
        
        $this->conn = $this->init();
    }

    public function getStat(){
        return $this->stat;
    }
    public function getCon(){
        return $this->conn;
    }
    public function closeCon(){
        $this->conn = null;
    }

    private function init()
    {
        try {
            $conn = new PDO("mysql:host=$this->host;dbname=" . $this->dbms, $this->user, $this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->stat = true;
            return $conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
?>