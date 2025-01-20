<?php

namespace app\Config;

class Database
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'l5_swapi';

    public function __construct()
    {
        $this->conn = new \mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_errno . ' - ' . $this->conn->connect_error);
        }

        $this->conn->set_charset("utf8mb4");
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
