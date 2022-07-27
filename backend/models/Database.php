<?php

class Database
{
    private string $host;
    private string $user;
    private string $pass;
    private string $db;
    private PDO $conn;
    private static Database $instance;

    private function __construct()
    {
        $config = new Config();
        $this->host = $config->getHost();
        $this->user = $config->getUser();
        $this->pass = $config->getPass();
        $this->db = $config->getDB();
    }

    static function getInstance(): Database
    {
        if (!isset(Database::$instance)) {
            Database::$instance = new Database();
        }
        return Database::$instance;
    }


    public function connect(): PDO
    {
        $options = array(
            PDO::MYSQL_ATTR_SSL_CA => "/etc/ssl/certs/ca-certificates.crt",
        );
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass, $options);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch
        (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return $this->conn;
    }

}