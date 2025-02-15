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
        $dbname = "Sarii";
        $user = "postgres";
        $pass = "Admin";

        try {
            $this->connection = new \PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $pass);
        } catch(\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            // echo 'work';
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
