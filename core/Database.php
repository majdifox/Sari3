<?php
namespace Core;
$config = require_once 'C:\laragon\www\SARI3\config\config.php';




class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        global $config; 
        $host = "localhost";
        $port = "5432";
        $dbname = "Sarri";
        $user = "postgres";
        $pass = "Youness";

        try {
            $this->conn = new \PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $pass);
            var_dump($this->conn);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            echo 'work';
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}
